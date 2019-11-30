<?php

function get_posts() {
    global $db;

    $result = $db->query("SELECT posts.id,
                                 posts.title,
                                 posts.description,
                                 posts.price,
                                 posts.user_id,
                                 posts.category_id,
                                 users.username
                                 FROM posts
                                 INNER JOIN users ON posts.user_id = users.id
                                 INNER JOIN categories ON posts.category_id = categories.id;");

    $posts = $result->fetch_all(MYSQLI_ASSOC);
    return $posts;
}

?>