<?php

require_once "configs/mysql.config.php";

function database_update() {

    $db = new mysqli(db_host, db_username, db_password, db_name, db_port);

    if ($db->connect_error) {
        echo "Can't update database: (" . $db->connect_errno . ") " . $db->connect_error;
    }
    else {
        //$connection->query('CREATE TABLE IF NOT EXISTS Users (
        //    user_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
        //    user_login VARCHAR(50) NOT NULL,
        //    user_password VARCHAR(50) NOT NULL,
        //    user_name VARCHAR(50),
        //    user_surname VARCHAR(50),
        //    user_email VARCHAR(50),
        //    user_type_id INTEGER);');

        echo "** Database updated **";
    }
}

?>