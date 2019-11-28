<?php

error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__.'/../logs/php-error.log');
ini_set('log_errors_max_len', 0);

1 / 0;

require_once "../private/library.php";

say_hello();
phpinfo();

?>