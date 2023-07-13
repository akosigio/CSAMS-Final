<?php
include "../../classes/accounts.php";
$account = new accounts;


if (isset($_POST["sid"]) && isset($_POST["stud_id"])){
    $stud_id = $_POST["stud_id"];
    $sid = $_POST["sid"];
    $result = $account->presentAttendanceManual($sid, $stud_id);
    header("Location: ../../start-class.php?sid=$sid");
}else{
    $ret["isSuccess"] = false;
    $ret["errorMessage"] = "Invalid Class";
    header("Location: ../../start-class.php?sid=$sid");
}
?>