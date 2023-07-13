<?php
    include "../../classes/userLogin.php";


    if (isset($_POST["un"]) && isset($_POST["pass"])){
        $user = new user_login;
        $data = $user->login($_POST["un"], $_POST["pass"]);
        $ret["total"] = count($data);
        if (count($data) > 0){
            if (!isset($_SESSION)){ session_start(); }
            $_SESSION["acount_user_name"] = $data[0]["username"];
            $_SESSION["acount_user_id"] = $data[0]["id"];
            $_SESSION["user_type"] = $data[0]["user_type"];
            $_SESSION["last_login_timestamp"] = time();
            $ret["user"] = $data[0];
        }   
        echo json_encode($ret);
        
    }
?>