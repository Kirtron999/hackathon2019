<?php

require_once "../private/libs/api-util.php";
require_once "../private/configs/mysql.config.php";

$username = http_post_param("username");
$password = http_post_param("password");

if (!$username || strlen($username) == 0) {
    error_response("Username is required");
}

if (!$password || strlen($password) == 0) {
    error_response("Password is required");
}

$db = new mysqli(db_host, db_username, db_password, db_name, db_port);
if ($db->connect_error) {
    error_response("Server error");
}

$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);

// ...
// ...

$hash = password_hash($password, PASSWORD_BCRYPT);