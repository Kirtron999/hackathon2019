<?php

# Show all errors, log errors to ./php-errors.log
error_reporting(E_ALL);
ini_set("log_errors", 1);
ini_set("error_log", __DIR__ . "./php-errors.log");
ini_set("log_errors_max_len", 0);
ini_set("display_startup_errors", 1);
ini_set("display_errors", 1);

# Require Smarty template engine
require_once "../private/deps/smarty-3.1.13/Smarty.class.php";
$smarty = new Smarty();
$smarty->setTemplateDir("../private/templates");
$smarty->setCompileDir("../private/templates_c");

# Setup session storage
ini_set("session.cookie_lifetime", 60 * 60 * 24 * 30);
ini_set("session.gc_maxlifetime", 60 * 60 * 24 * 30);
session_start();

# Get request URL
$request_uri = strtolower($_SERVER["REQUEST_URI"]);
$request_uri = preg_replace("{/+}", "/", $request_uri);
$request_path = parse_url($request_uri, PHP_URL_PATH);

# Front page requested
if ($request_uri === "/") {
    $smarty->assign("test_page", "Front page!");
    $smarty->display("index.tmpl.html");
}

# User API requested
else if ($request_uri === "/api/user/login") {
    require_once "../private/apis/api-user-login.php";
}

else if ($request_uri === "/api/user/register") {
    require_once "../private/apis/api-user-register.php";
}

else if ($request_uri === "/logout") {
    require_once "../private/pages/page-logout.php";
}


# Page not found
else {
    $smarty->assign("test_page", $request_path . " (404)");
    $smarty->display("index.tmpl.html");
}

?>