<?php

require_once "../private/libs/api-util.php";

$username = http_post_param("username") ?? "";
$email    = http_post_param("email") ?? "";
$password = http_post_param("password")  ?? "";

//Checking for blank space
if (strlen($username) == 0) {
    error_response("Username is required");
}

if (strlen($email) == 0) {
    error_response("E-mail is required");
}

if (strlen($password) == 0) {
    error_response("Password is required");
}

//Register form checks
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    error_response("Wrong e-mail format");
}

if (strlen($username) > 32) {
    error_response("Username must be no longer than 32 characters");
}

if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
    error_response("Username can only contain latin letters and numbers");
}

if (strlen($password) > 32 && strlen($password) < 6) {
    error_response("Password must contain 6-32 characters");
}

$stmt = $db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
$stmt->bind_param("s", $username);
$stmt->execute();

$users = $stmt->get_result();
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