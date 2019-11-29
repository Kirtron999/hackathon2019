<?php

require_once "../private/libs/api-util.php";
require_once "../private/configs/mysql.config.php";

$username = http_post_param("username");
$password = http_post_param("password");

if (empty($username)) {
    error_response("Username is required");
}

if (empty($password)) {
    error_response("Password is required");
}

$db = new mysqli(db_host, db_username, db_password, db_name, db_port);
if ($db->connect_error) {
    error_response("Server error");
}

$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);

$stmt->execute();

$users = $stmt->get_result();

if ($users->field_count == 1) {
    $user = $users->fetch_assoc();

    if (password_hash($password, PASSWORD_BCRYPT) == $user['password']) {
        session_start();
        $_SESSION['id'] = $user['id'];
    }
    else {
        error_response("Wrong password");
    }
}
else {
    error_response("User doesn't exist");
}

$hash = password_hash($password, PASSWORD_BCRYPT);