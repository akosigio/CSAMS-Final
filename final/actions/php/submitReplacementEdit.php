<?php
// include the class
include "../../classes/accounts.php";

// Data from Admin create Player
$last_name = $_POST["last_name"];
$first_name = $_POST["first_name"];
$middle_name = $_POST["middle_name"];
$date_birth = $_POST["date_birth"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$civil_status = $_POST["civil_status"];
$brgy = $_POST["brgy"];
$street_sitio = $_POST["street_sitio"];
$place_birth = $_POST["place_birth"];
$education = $_POST["education"];
$sid = $_POST["sid"];
$family = $_POST["family"];
$number = $_POST["number"];
$rid = $_POST["rid"];

$account = new accounts; 
$result = $account->submitApplicationEdit($first_name, $last_name, $middle_name,$date_birth, $age, $gender,  $civil_status, $brgy, $street_sitio, $place_birth, $education, $family, $number, $sid);
if ($result["isSuccess"]){
    $res = $account->updateSReplacementStatus($rid, 2);
}
echo json_encode($result);
?>

