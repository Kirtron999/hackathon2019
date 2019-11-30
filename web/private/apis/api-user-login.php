<?php

require_once "../private/libs/api-util.php";

$username = http_post_param("username") ?? "";
$password = http_post_param("password") ?? "";

if (strlen($username) == 0) {
    error_response("Username is required");
}

if (strlen($password) == 0) {
    error_response("Password is required");
}

$stmt = $db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $hash = $user["hash_bcrypt"];

    if (password_verify($password, $hash)) {
        session_update($user);
        success_response("Successfully logged in!");
    }
}

error_response("Wrong password");