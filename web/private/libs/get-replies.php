<?php

function get_replies(integer $task_id) {
    global $db;

	$stmt = $db->query("SELECT name FROM replies WHERE post_id = ?");
	$stmt->bind_param("s", $task_id);
	$stmt->execute();
	
	$result = $stmt->get_result();	

    $replies = $result->fetch_all(MYSQLI_ASSOC);
    return $replies;
}

?>