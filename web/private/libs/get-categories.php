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

    $results = array_filter($categories, function($value) {
        return $value["parent_id"] == null;
    });

    $results = array_map(function($value) {
        return [
            "id" => $value["id"],
            "name" => $value["name"],
            "count" => $value["posts_count"],
            "children" => []
        ];
    }, $results);

    foreach ($categories as $category) {
        if ($category["parent_id"] != null) {

            $parent = null;
            $key = null;
            foreach ($results as $k => $result) {
                if ($result["id"] == $category["parent_id"]) {
                    $parent = $result;
                    $key = $k;
                    break;
                }
            }

            $results[$key]["children"][] = [
                "id" => $category["id"],
                "name" => $category["name"],
                "count" => $category["posts_count"]
            ];
        }    
    }

    return $results;
}

?>