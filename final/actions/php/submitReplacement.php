<?php
// include the class
include "../../classes/userLogin.php";

// Data from Admin create Player
$last_name = $_POST["last_name"];
$first_name = $_POST["first_name"];
$middle_name = $_POST["middle_name"];
$date_birth = $_POST["date_birth"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$brgy = $_POST["brgy"];
$street_sitio = $_POST["street_sitio"];
$place_birth = $_POST["place_birth"];
$reason = $_POST["reason"];
$sr_id = $_POST["sr_id"];

$account = new user_login; 

$ret["isSuccess"] = true;
$ret["errorMessage"] = "";
if ($account->checkIfMember($sr_id)){
    $result = $account->submitReplacement($first_name, $last_name, $middle_name, $date_birth, $age, $place_birth, $brgy, $street_sitio, $gender, $sr_id, $reason);
    echo json_encode($result);
}else{
    $ret["isSuccess"] = false;
    $ret["errorMessage"] = "Senior Citizen ID not found!";
    echo json_encode($ret);
}
?>

