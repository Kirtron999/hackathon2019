<?php

function get_categories() {
    global $db;

    $result = $db->query("SELECT categories.id,
                   categories.name,
                   categories.parent_id,
                   COUNT(p.id) as 'posts_count'
                   FROM categories
                   LEFT JOIN posts AS p ON p.category_id = categories.id
                   GROUP BY categories.id;");

    $categories = $result->fetch_all(MYSQLI_ASSOC);
    return $categories;
}

?>