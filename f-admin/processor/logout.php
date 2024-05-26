<?php
    require_once("../inc/config.inc.php");
    unset($_SESSION['F_id']);
    session_unset();
    session_destroy();
    header("Location: ../?_loggedout");
    $database->close();
?>