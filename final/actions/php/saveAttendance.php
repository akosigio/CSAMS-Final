<?php
include "../../classes/accounts.php";
$account = new accounts;


if (isset($_POST["tid"]) && isset($_POST["sid"])){
    $tid = $_POST["tid"];
    $sid = $_POST["sid"];
    $result = $account->presentAttendance($sid, $tid);
    echo $result;
}else{
    $ret["isSuccess"] = false;
    $ret["errorMessage"] = "Invalid Class";
    echo json_encode($ret);
}
?>