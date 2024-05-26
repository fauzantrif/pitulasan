<?php
    if(session_status() === PHP_SESSION_NONE) session_start();

    require_once(__DIR__ . "/Database.php");
    require_once(__DIR__ . "/Functions.php");

    date_default_timezone_set("Asia/Jakarta");

    $database = new Database();
    $functions = new Functions();

    // Get Logged In Admins //
    $activeAdmin = isset($_SESSION['F_id']) ? $_SESSION['F_id'] : 0;
    if($activeAdmin !== 0){
        $curAdmin = $database->query("SELECT * FROM admins WHERE id = {$activeAdmin}");
        if($curAdmin['total'] === 1)
            $user = $curAdmin['data'][0];
            else $user = false;
    } else {
        $user = false;
    }
    // End //

    $web_darkmode = (isset($_COOKIE['103_darkmode'])) ? ($_COOKIE['103_darkmode'] === "on") : false;
?>