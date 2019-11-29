<?php

require_once "../private/libs/api-util.php";
require_once "../private/configs/mysql.config.php";

$username = http_post_param("username") ?? "";
$password = http_post_param("password") ?? "";

if (strlen($username) == 0) {
    error_response("Username is required");
}

if (strlen($username) == 0) {
    error_response("Password is required");
}

$db = new mysqli(db_host, db_username, db_password, db_name, db_port);
if ($db->connect_error) {
    error_response("Server error");
}

$stmt = $db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $hash = $user["password"];

    if (password_verify($password, $hash)) {
        $_SESSION["id"] = $user["id"];
        success_response("Successfully logged in!");
    }
}

error_response("Wrong password");