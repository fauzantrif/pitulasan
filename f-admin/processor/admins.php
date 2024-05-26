<?php
    require_once("../inc/config.inc.php");

    if(!$user){
        header("Location: ../?error=unauthorized"); exit();
    } else {
        if(!$user['superuser']){
            header("Location: ./error.php?type=403"); exit();
          }
        $allowed_action = array("add", "delete");
        $action = (isset($_POST['tx_action'])) ? $_POST['tx_action'] : false;
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        } else {
            $d_fullname = $_POST['tx_fullname'];
            $d_username = $_POST['tx_username'];
            $d_password = (strlen($_POST['tx_password'])) ? $_POST['tx_password'] : "123456";
            $d_superuser = (isset($_POST['tx_superuser'])) ? intval($_POST['tx_superuser']) : 0;

            $encoded_formData = array(
                'tx_username' => $d_username,
                'tx_fullname' => $d_fullname,
                'tx_password' => $d_password,
                'tx_superuser' => $d_superuser
            );
            $encoded_formData = base64_encode( json_encode($encoded_formData) );

            $d_fullname = ucwords( $functions->sanitize("name", $d_fullname) );
            $d_username = strtolower( $functions->sanitize("alphanum", $d_username) );
            $d_password = md5( $d_password );
        }

        // echo "Fullname: {$d_fullname}<br>";
        // echo "Callname: {$d_callname}<br>";
        // echo "Group: {$d_grouping}<br>";

        if(!in_array($action, $allowed_action)){
            header("Location: ../admins.php?error=invalid.argument&formdata={$encoded_formData}");
        } else {
            switch($action){
                case "add":
                    $username_exist = $database->numRows("admins", "username = '{$d_username}'");
                    if(!$username_exist){
                        $query = sprintf("INSERT INTO `admins` (fullname, username, `password`, superuser) VALUES ('%s', '%s', '%s', %s)",
                                $database->sanitizeInput( $d_fullname ),
                                $database->sanitizeInput( $d_username ),
                                $database->sanitizeInput( $d_password ),
                                $d_superuser
                            );
                        // echo $query;
                        $database->query($query);
                        header("Location: ../admins.php?_success");
                    } else {
                        header("Location: ../admins.php?error=duplicate.username&formdata={$encoded_formData}");
                    }
                    break;
                case "delete":
                    $d_id = intval($_GET['id']);
                    $verifyAdmin = $database->query("SELECT * FROM admins WHERE id = {$d_id}");
                    $prev_link = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "../admins.php?_";
                    $prev_link = (strpos($prev_link, "?") === false) ? $prev_link . "?_" : $prev_link;
                    if(($user['superuser']) && ($d_id !== intval($user['id']))){
                        if($verifyAdmin['total'] === 1){
                            $data_admin = $verifyAdmin['data'][0];
                            $linkto = $prev_link . "&_deleted=" . urlencode( base64_encode( $data_admin['fullname'] ) );
                            $query = sprintf("DELETE FROM `admins` WHERE id=%s",
                                    $database->sanitizeInput( $d_id )
                                );
                            // echo $linkto;
                            // var_dump($user['id']);
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