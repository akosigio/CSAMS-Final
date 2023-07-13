<?php
include "../../classes/accounts.php";
$account = new accounts;
$id = $_POST["id"];
$type = $_POST["deletetype"];

$ret["isSuccess"] = true;
$ret["errorMessage"] = "Success";

if ($type == "user"){
    if (!$account->deleteUser($id)){
        $ret["isSuccess"] = false;
        $ret["errorMessage"] = "Something error!";
    };
}else if ($type == "survey"){
    if (!$account->deleteSurvey($id)){
        $ret["isSuccess"] = false;
        $ret["errorMessage"] = "Something error!";
    };
}else if ($type == "subject"){
    if (!$account->deleteSubject($id)){
        $ret["isSuccess"] = false;
        $ret["errorMessage"] = "Something error!";
    };
}

echo json_encode($ret);
?>