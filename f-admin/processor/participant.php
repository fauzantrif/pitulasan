<?php
    require_once("../inc/config.inc.php");

    if(!$user){
        header("Location: ../?error=unauthorized"); exit();
    } else {
        $allowed_action = array("add", "edit", "delete");
        $action = (isset($_POST['tx_action'])) ? $_POST['tx_action'] : false;
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        } else {
            $d_fullname = $_POST['tx_fullname'];
            $d_callname = $_POST['tx_callname'];
            $d_grouping = $_POST['tx_grouping'];
            $d_team = (isset($_POST['tx_team'])) ? $_POST['tx_team'] : false;

            $d_fullname = ucwords( $functions->sanitize("name", $d_fullname) );
            $d_callname = ucwords( $functions->sanitize("name", $d_callname) );
            $d_grouping = $functions->sanitize("name", $d_grouping);
        }

        // echo "Fullname: {$d_fullname}<br>";
        // echo "Callname: {$d_callname}<br>";
        // echo "Group: {$d_grouping}<br>";

        if(!in_array($action, $allowed_action)){
            header("Location: ../participant.php?error=invalid.argument");
        } else {
            switch($action){
                case "add":
                    $query = sprintf("INSERT INTO `participant` (fullname, callname, grouping, added_by) VALUES ('%s', '%s', '%s', %s)",
                                $database->sanitizeInput( $d_fullname ),
                                $database->sanitizeInput( $d_callname ),
                                $database->sanitizeInput( $d_grouping ),
                                $user['id']
                            );
                    // echo $query;
                    $database->query($query);
                    header("Location: ../participant.forms.php?action=add&_success");
                    break;
                case "edit":
                    $d_id = intval($_POST['tx_id']);
                    $verifyParticipant = $database->numRows("participant", "id={$d_id}");
                    $d_team = ($user['superuser']) ? intval($_POST['tx_team']) : false;
                    if($d_team){
                        $verifyTeam = $database->numRows("teams", "id = {$d_team}");
                        if($verifyTeam !== 1) $d_team = false;
                    }
                    if($verifyParticipant === 1){
                        $query = sprintf("UPDATE `participant` SET fullname='%s', callname='%s', grouping='%s', team=%s WHERE id=%s",
                                $database->sanitizeInput( $d_fullname ),
                                $database->sanitizeInput( $d_callname ),
                                $database->sanitizeInput( $d_grouping ),
                                ($d_team) ? $d_team : "NULL",
                                $database->sanitizeInput( $d_id )
                            );
                        // echo $query;
                        $database->query($query);
                        header("Location: ../participant.forms.php?action=edit&id={$d_id}&_success");
                    } else {
                        header("Location: ../participant.php?error=idnotfound");
                    }
                    break;
                case "delete":
                    $d_id = intval($_GET['id']);
                    $verifyParticipant = $database->query("SELECT * FROM participant WHERE id = {$d_id}");
                    $prev_link = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "../participant.php?_";
                    $prev_link = (strpos($prev_link, "?") === false) ? $prev_link . "?_" : $prev_link;
                    if($user['superuser']){
                        if($verifyParticipant['total'] === 1){
                            $data_participant = $verifyParticipant['data'][0];
                            $linkto = $prev_link . "&_deleted=" . urlencode( base64_encode( $data_participant['fullname'] ) );
                            $query = sprintf("DELETE FROM `participant` WHERE id=%s",
                                    $database->sanitizeInput( $d_id )
                                );
                            // echo $linkto;
                            $database->query($query);
                            header("Location: {$linkto}");
                        } else {
                            header("Location: " . $prev_link . "error=idnotfound");
                        }
                    } else {
                        header("Location: " . $prev_link . "&error=forbidden");
                    }
                    break;
            }
        }
    }

    $database->close();
?>