<?php

require_once "../private/libs/api-util.php";

if (!isset($_SESSION['id'])) {
    error_response("You need to log in to create task");
}

$title = http_post_param("title") ?? "";
$description = http_post_param("description") ?? "";
$category_id = http_post_param("category_id") ?? "";
$price = http_post_param("price") ?? "";
$is_task = 1;

if (strlen($title) == 0) {
    error_response("Task must have a title");
}

if ($price < 0) {
    error_response("Price cannot be negative");
}

$stmt = $db->prepare("INSERT INTO tasks (user_id, category_id, title, description, price, is_task) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iissdi", $_SESSION['id'], $category_id, $title, $description, $price, $is_task);
$stmt->execute();

?>