<?php

require_once "../private/libs/api-util.php";
require_once "../private/configs/mysql.config.php";

$username = http_post_param("username") ?? "";
$email    = http_post_param("email") ?? "";
$password = http_post_param("password")  ?? "";

if (strlen($username) == 0) {
    error_response("Username is required");
}

if (strlen($email) == 0) {
    error_response("E-mail is required");
}

if (strlen($password) == 0) {
    error_response("Password is required");
}

$db = new mysqli(db_host, db_username, db_password, db_name, db_port);
if ($db->connect_error) {
    error_response("Server error");
}

$stmt = $db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();

if ($users->num_rows == 1) {
    error_response("User already exists");
}
else {
    $password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $db->prepare("INSERT INTO users (username, hash_bcrypt, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $email);
    $stmt->execute();

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $users = $stmt->get_result();
    $user = $users->fetch_assoc();

    $_SESSION["id"] = $user["id"];
    success_response("Registered successfully!");
}

?>