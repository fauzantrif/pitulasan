<?php
    require_once("../inc/config.inc.php");

    if(!$user){
        header("Location: ../?error=unauthorized"); exit();
    } else {
        $allowed_action = array("edit_name", "change_pass");
        $action = (isset($_POST['tx_action'])) ? $_POST['tx_action'] : false;

        if(!in_array($action, $allowed_action)){
            header("Location: ../admins.php?error=invalid.argument&formdata={$encoded_formData}");
        } else {
            switch($action){
                case "edit_name":
                    $d_fullname = (isset($_POST['tx_fullname'])) ? $_POST['tx_fullname'] : "";
                    if(strlen($d_fullname) >= 5){
                        $d_fullname = ucwords($d_fullname);
                        $query = sprintf("UPDATE admins SET fullname='%s' WHERE id=%s",
                                $database->sanitizeInput( $d_fullname ),
                                $user['id']
                            );
                        // echo $query;
                        $database->query($query);
                        header("Location: ../account.php?_success");
                    } else {
                        header("Location: ../account.php?error=invalid.name");
                    }
                    break;
                case "change_pass":
                    $d_oldpass = (strlen($_POST['tx_oldpass'])) ? $_POST['tx_oldpass'] : "";
                    $d_newpass = (strlen($_POST['tx_newpass'])) ? $_POST['tx_newpass'] : "";
                    $endsession = (isset($_POST['tx_endsession']) && ($_POST['tx_endsession'] === "1"));
                    $d_newpass_verify = (strlen($_POST['tx_newpass_verify'])) ? $_POST['tx_newpass_verify'] : "";
                    if(md5($d_oldpass) === $user['password']){
                        if(md5($d_newpass) === md5($d_newpass_verify)){
                            if(strlen($d_newpass) >= 5){
                                $query = sprintf("UPDATE admins SET `password`='%s' WHERE id=%s",
                                    md5( $d_newpass ),
                                    $user['id']
                                );
                                // echo $query;
                                $database->query($query);
                                if($endsession)
                                    header("Location: ./logout.php?_");
                                    else header("Location: ../account.php?_success");
                            } else {
                                header("Location: ../account.php?error=weak.pass");
                            }
                            
                        } else {
                            header("Location: ../account.php?error=unmatched.pass");
                        }
                    } else {
                        header("Location: ../account.php?error=wrong.pass");
                    }
                    break;
            }
        }
    }

    $database->close();
?>