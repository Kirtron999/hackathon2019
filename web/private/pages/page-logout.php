<?php

if (isset($_SESSION["id"])) {
    session_destroy();
    header("Location: /", true, 302);
    exit;
}

?>
