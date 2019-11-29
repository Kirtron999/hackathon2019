<?php

require_once "../private/libs/api-util.php";
require_once "../private/configs/mysql.config.php";

function register() {

    //!!!CHANGE WHEN THE DATABASE IS READY!!!
    if ($_POST['login'] != "" && $_POST['email'] != "" && $_POST['password'] != "") {

        //Connect to database
        $db = new mysqli(db_host, db_username, db_password, db_name, db_port);

        //Checking for connection errors
        if ($db->connect_error) {
            return array('db-connection-error' => "Unable to connect database: $db->error");
        }
        else {
            //Get user fields from database associated with entered login
            $users = $db->query("SELECT * FROM users WHERE login=$login");

            //Checking if user with that login exists
            if ($users->field_count == 1) {
                return array('user-exist-error' => "");
            }
            else {
                //Initializing new user
                //!!!CHANGE WHEN THE DATABASE IS READY!!!
                $login = $_POST['login'];
                $email = $_POST['email'];

                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $db->query("INSERT INTO users (login, password, email) VALUES ($login, $email, $password);");

                //Getting new user id
                $users = $db->query("SELECT * FROM users WHERE login=$login");
                $user = $users->fetch_assoc();

                session_start();
                $_SESSION['id'] = $user['id'];

            }
        }
    }
    else {
        return array('null-fields-error' => "Fields cannot be empty");
    }
}

?>