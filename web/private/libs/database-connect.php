<?php

function database_connect(): mysqli {
    $host     = "localhost";
    $username = "root";
    $password = "";
    $name     = "hackathon";
    $port     = 3306;

    $db = new mysqli($host, $username, $password, $name, $port);
    if ($db->connect_errno) {
        die("Can't connect to database: " . $db->connect_error);
    }

    return $db;
}

?>