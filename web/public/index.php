<?php

include 'C:\Server\www\hackaton\web\private\database_update.php';

update_database('localhost', 3306, 'root', '', 'mysql');

# Show all errors, log errors to ./php-errors.log
error_reporting(E_ALL);
ini_set("log_errors", 1);
ini_set("error_log", __DIR__ . "/php-errors.log");
ini_set("log_errors_max_len", 0);
ini_set("display_startup_errors", 1);
ini_set("display_errors", 1);

# Require Smarty template engine
require_once "../private/deps/smarty-3.1.13/Smarty.class.php";
$smarty = new Smarty();
$smarty->setTemplateDir("../private/templates");
$smarty->setCompileDir("../private/templates_c");

# Load a sample template
$smarty->assign("greeting", "world");
$smarty->display("index.tmpl.html");

?>