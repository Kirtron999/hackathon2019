<?php

require_once "configs/mysql.config.php";

function json_api_response(array $data): void {
    $json = json_encode($data);
    ob_end_clean();
    header("Content-Type: application/json");
    echo $json;
    exit;
}

function http_get_param(string $key): ?string {
    if (isset($_GET[$key]) && is_string($_GET[$key])) {
        return $_GET[$key];
    }

    return null;
}

function http_post_param(string $key): ?string {
    if (isset($_POST[$key]) && is_string($_POST[$key])) {
        return $_POST[$key];
    }

    return null;
}

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
            $stmt = $db->prepare('SELECT * FROM users WHERE login = ?');
            $stmt->bind_param('s', $login);

            $stmt->execute();

            $users = $stmt->get_result();

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

                $stmt = $db->prepare('INSERT INTO users (login, password, email) VALUES (?, ?, ?);');
                $stmt->bind_param('sss', $login, $password, $email);

                $stmt->execute();

                //Getting new user id
                $stmt = $db->prepare('SELECT * FROM users WHERE login = ?');
                $stmt->bind_param('s', $login);

                $stmt->execute();

                $users = $stmt->get_result();
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
            $stmt = $db->prepare('SELECT * FROM users WHERE login = ?');
            $stmt->bind_param('s', $login);

            $stmt->execute();

            $users = $stmt->get_result();
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

function unauthorize() {

    if (isset($_SESSION['id']))
    {
        session_unset();
        session_destroy();
    }

}

?>