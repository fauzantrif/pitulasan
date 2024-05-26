<?php
    require_once("../inc/config.inc.php");

    if(!$user){
        header("Location: ../?error=unauthorized"); exit();
    } else {
        if(!$user['superuser']){
            header("Location: ./error.php?type=403"); exit();
          }
        $allowed_action = array("add_group", "delete_group", "transact_individu", "transact_team");
        $action = (isset($_POST['tx_action'])) ? $_POST['tx_action'] : false;
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        } else {
            
        }

        // echo "Fullname: {$d_fullname}<br>";
        // echo "Callname: {$d_callname}<br>";
        // echo "Group: {$d_grouping}<br>";

        if(!in_array($action, $allowed_action)){
            header("Location: ../competitions.details.php?error=invalid.argument");
        } else {
            switch($action){
                case "add_group":
                    $d_id_comp = intval($_POST['tx_id_comp']);
                    $d_grouping = $database->sanitizeInput($_POST['tx_grouping']);
                    $checkComp = $database->query("SELECT * FROM competition_transactions WHERE id_comp = {$d_id_comp} AND grouping = '{$d_grouping}' ORDER BY `copy` DESC LIMIT 1");
                    if($checkComp['total']){
                        $copy = $checkComp['data'][0]['copy'] + 1;
                    } else {
                        $copy = 1;
                    }
                    $query = "INSERT INTO competition_transactions (id_comp, grouping, `copy`) VALUES ({$d_id_comp}, '{$d_grouping}', {$copy})";
                    // echo $query;
                    $database->query($query);
                    header("Location: ../competitions.details.php?id={$d_id_comp}");
                    break;
                case "delete_group":
                    $d_id_comp = intval($_GET['id']);
                    $d_grouping = base64_decode($_GET['grouping']);
                    $d_grouping = $database->sanitizeInput($d_grouping);
                    $d_copy = intval($_GET['copy']);
                    $delete_query = "DELETE FROM competition_transactions WHERE id_comp = {$d_id_comp} AND grouping = '{$d_grouping}' AND `copy` = {$d_copy}";
                    // echo $delete_query;
                    $database->query($delete_query);
                    header("Location: ../competitions.details.php?id={$d_id_comp}");
                    break;
                case "transact_individu":
                    $d_id_comp = intval($_POST['tx_id_comp']);
                    $d_grouping = $database->sanitizeInput($_POST['tx_grouping']);
                    $d_copy = intval($_POST['tx_copy']);
                    $d_participants = $_POST['tx_id_participant'];
                    $d_points = $_POST['tx_point'];
                    $d_teams = $_POST['tx_id_team'];
                    $query_master = "INSERT INTO competition_transactions (id_comp, id_participant, id_team, grouping, `copy`, `point`) VALUES ({$d_id_comp}, %s, %s, '{$d_grouping}', {$d_copy}, %s)";
                    $database->query("DELETE FROM competition_transactions WHERE id_comp = {$d_id_comp} AND grouping = '{$d_grouping}' AND `copy` = {$d_copy}");
                    for($i=0;$i<count($d_participants);$i++){
                        $point = (isset($d_points[$i])) ? $d_points[$i] : 0;
                        $query = sprintf($query_master, $d_participants[$i], $d_teams[$i], $point);
                        $database->query($query);
                        // echo $query . "<br>";
                    }
                    header("Location: ../competitions.details.php?id={$d_id_comp}");
                    break;
                case "transact_team":
                    $d_id_comp = intval($_POST['tx_id_comp']);
                    $d_teams = $_POST['tx_id_team'];
                    $d_points = $_POST['tx_point'];
                    $query_master = "INSERT INTO competition_transactions (id_comp, id_team, `point`) VALUES ({$d_id_comp}, %s, %s)";
                    $database->query("DELETE FROM competition_transactions WHERE id_comp = {$d_id_comp}");
                    for($i=0;$i<count($d_teams);$i++){
                        $point = (isset($d_points[$i])) ? $d_points[$i] : 0;
                        $query = sprintf($query_master, $d_teams[$i], $point);
                        $database->query($query);
                        // echo $query . "<br>";
                    }
                    header("Location: ../competitions.details.php?id={$d_id_comp}");
                    break;
            }
        }
    }

    $database->close();
?>