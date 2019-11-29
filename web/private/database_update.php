<?php

function update_database(string $DB_HOST, int $DB_PORT, string $DB_USER, string $DB_PASS, string $DB_NAME) {
    $connection = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);

    if ($connection->connect_error) {
        echo 'Connect Error (' . $connection->connect_errno . ') ' . $connection->connect_error . PHP_EOL;
    } else {
        //$connection->query('CREATE TABLE IF NOT EXISTS Users (
        //    user_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
        //    user_login VARCHAR(50) NOT NULL,
        //    user_password VARCHAR(50) NOT NULL,
        //    user_name VARCHAR(50),
        //    user_surname VARCHAR(50),
        //    user_email VARCHAR(50),
        //    user_type_id INTEGER);');
    }
}

?>