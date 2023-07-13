<?php
 include "../../classes/user.php";

 $res["success"] = 1;
 $res["message"] = "";

    if (isset($_POST["op"]) && isset($_POST["np"]) && isset($_POST["cp"])){
        $op = $_POST["op"];
        $np = $_POST["np"];
        $cp = $_POST["cp"];
        if ($np == $cp){
            if (!isset($_SESSION)){ session_start(); }
            if (isset($_SESSION["acount_user_id"])){
                $user = new User;
                $passHash = $user->getpassword($_SESSION["acount_user_id"]);
                if (password_verify($op, $passHash["password"])){
                    $updateres = $user->Updatepassword($np ,$_SESSION["acount_user_id"]);
                    $res["message"] = $updateres == "1" ? "Password updated!" : $updateres;
                    $res["success"] = $updateres == "1" ? 1 : 0;
                }else{
                    $res["message"] = "Incorect password";
                    $res["success"] = 0;
                }
            }
        }else{
            $res["success"] = 0;
            $res["message"] = "Password mistmatch!";
        }
    }else{
        $res["success"] = 0;
        $res["message"] = "parameter not set!";
    }
echo json_encode($res);
?>