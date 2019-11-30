<?php

require_once "../private/libs/api-util.php";

function get_categories() {

    $result = $db->query("SELECT categories.id,
                   categories.name,
                   categories.parent_id,
                   COUNT(p.id) as 'posts_count'
                   FROM categories
                   LEFT JOIN posts AS p ON p.category_id = categories.id
                   GROUP BY categories.id;");

    $categories = $result->fetch_assoc();

    return $categories;
}

?>