<?php
// include the class
include "../../classes/accounts.php";

// Data from Admin create Player
$type = $_POST['type'];
$idno = $_POST['idno'];
$name = $_POST['name'];
$number = $_POST['number'];
$year = $_POST['year'];
$course = $_POST['course'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];

$account = new accounts;
if ($account->checkIfExisting($uname)){
    $ret["isSuccess"] = false;
    $ret["errorMessage"] = "Username already exist!";
    echo json_encode($ret);
}else if ($account->checkIfIDExisting($idno)){
    $ret["isSuccess"] = false;
    $ret["errorMessage"] = "ID number already exist!";
    echo json_encode($ret);
}else{
    $result = $account->createUser($uname, $pass, $type, $name, $course, $year,  $number, $idno);
    echo $result;
}
?>

