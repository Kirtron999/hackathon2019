<?php

require_once "../private/libs/api-util.php";
require_once "configs/mysql.config.php";

function login() {

    if ($_POST['login'] != "" && $_POST['password'] != "") {

        $login = $_POST['login'];
        $password = $_POST['password'];

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
                $user = $users->fetch_assoc();

                //Checking if the hashed entered password matches with the database password
                if (password_hash($password, PASSWORD_BCRYPT) == $user['password']) {

                    //Initializing user with id
                    //!!!CHANGE WHEN THE DATABASE IS READY!!!
                    session_start();
                    $_SESSION['id'] = $user['id'];
                }
                else {
                    return array('wrong-password-error' => "Wrong password");
                }
            }
            else {
                return array('login-error' => "User doesn't exist");
            }
        }
    }
    else {
        return array('null-fields-error' => "Fields cannot be empty");
    }
}

?>