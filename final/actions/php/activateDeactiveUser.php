<?php
include "../../classes/accounts.php";

    if (isset($_POST["uid"]) && isset($_POST["status"])){
        $status = "";
        if ($_POST["status"] == 0){
            $status = 1;
        }else{
            $status = 0;
        }
        $account = new accounts;
        $result = $account->ActivateDeactivateUser($_POST["uid"],$status);
        echo $result;
    }
?>