<?php
    require_once("../inc/config.inc.php");

    if($user){
      header("Location: ../dashboard.php?_loggedin"); exit();
    } else {
        $username = $functions->sanitize("alphanum", $_POST['username']);
        $password = md5($_POST['password']);
        $findUser = $database->query("SELECT * FROM admins WHERE username = '{$username}' AND `password` = '{$password}'");
        // print_r($findUser); echo $username . " | " . $password; exit();
        if($findUser['total'] === 1){
            $_SESSION['F_id'] = $findUser['data'][0]['id'];
            header("Location: ../dashboard.php?_loggedin");
        } else {
            header("Location: ../index.php?error=invalid");
        }
    }

    $database->close();
?>