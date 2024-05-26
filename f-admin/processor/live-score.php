<?php
    require_once("../inc/config.inc.php");

    if(!$user){
        header("Location: ../?error=unauthorized"); exit();
    } else {
        $allowed_action = array("klasemen");
        $action = (isset($_POST['tx_action'])) ? $_POST['tx_action'] : false;
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }

        if(!in_array($action, $allowed_action)){
            header("Location: ../dashboard.php?error=invalid.argument");
        } else {
            $output = array();
            switch($action){
                case "klasemen":
                    $leaderboard_query = "SELECT teams.id AS team_id, teams.name AS team_name, teams.logo AS team_logo, SUM(`point`) AS total_points FROM `competition_transactions` AS ct LEFT JOIN teams ON teams.id = ct.id_team GROUP BY id_team ORDER BY total_points DESC";
                    $leaderboard = $database->query($leaderboard_query);
                    $output = $leaderboard['data'];
                    break;
            }
            echo json_encode($output, JSON_PRETTY_PRINT);
        }
    }

    $database->close();
?>