<?php
declare(strict_types=1);

# Establish database connection
require_once "../private/libs/database-connect.php";
$db = database_connect();

# Show all errors, log errors to ./php-errors.log
error_reporting(E_ALL);
ini_set("log_errors", "1");
ini_set("log_errors_max_len", "0");
ini_set("display_startup_errors", "1");
ini_set("display_errors", "1");

# Require Smarty template engine
require_once "../private/deps/smarty-3.1.13/Smarty.class.php";
$smarty = new Smarty();
$smarty->setTemplateDir("../private/templates");
$smarty->setCompileDir("../private/templates_c");

# Setup session storage
ini_set("session.cookie_lifetime", strval(60 * 60 * 24 * 30));
ini_set("session.gc_maxlifetime", strval(60 * 60 * 24 * 30));
session_start();

# Get request URL
$request_uri = strtolower($_SERVER["REQUEST_URI"]);
$request_uri = preg_replace("{/+}", "/", $request_uri);
$request_uri = parse_url($request_uri, PHP_URL_PATH);

$logged_in = isset($_SESSION["id"]);
$smarty->assign("logged_in", $logged_in);

require_once "../private/libs/get-categories.php";
$categories = get_categories();
$smarty->assign("categories", $categories);

if ($logged_in) {
    $smarty->assign("username", $_SESSION["username"]);
}

# Front page requested
if ($request_uri === "/") {
    $smarty->display("index.tmpl.html");
}

# User API requested
else if ($request_uri === "/api/user/login") {
    require_once "../private/apis/api-user-login.php";
}

else if ($request_uri === "/api/user/register") {
    require_once "../private/apis/api-user-register.php";
}

else if ($request_uri === "/login") {

    # Redirect user to front page if he's logged in
    if ($logged_in) {
        header("Location: /", true, 302);
        exit;
    }

    $smarty->display("login.tmpl.html");
}

else if ($request_uri === "/register") {

    # Redirect user to front page if he's logged in
    if ($logged_in) {
        header("Location: /", true, 302);
        exit;
    }

    $smarty->display("register.tmpl.html");
}

else if ($request_uri === "/logout") {
    require_once "../private/pages/page-logout.php";
}


# Page not found
else {
    $smarty->assign("title", "Page not found");
    $smarty->assign("description", "The page you have requested does not exist or have been removed.");
    $smarty->display("error.tmpl.html");
}

?>