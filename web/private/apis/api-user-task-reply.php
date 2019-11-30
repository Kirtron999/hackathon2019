<?php

require_once "../private/libs/api-util.php";

if (!isset($_SESSION['id'])) {
    error_response("You need to log in to leave a reply");
}

$post_id = http_post_param("post_id") ?? "";
$message = http_post_param("message") ?? "";

if (strlen($message) == 0) {
    error_response("Message cannot be empty");
}

$stmt = $db->prepare("INSERT INTO replies (post_id, user_id, message) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $post_id, $_SESSION['id'], $message);
$stmt->execute();

?>