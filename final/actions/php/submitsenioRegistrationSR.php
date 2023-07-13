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
$civil_status = $_POST["civil_status"];
$brgy = $_POST["brgy"];
$street_sitio = $_POST["street_sitio"];
$place_birth = $_POST["place_birth"];
$education = $_POST["education"];
$isSenior = $_POST["isSenior"];
$isPWD = $_POST["isPWD"];
$isPPPP = $_POST["is4P"];
$family = $_POST["family"];
$number = $_POST["number"];

$account = new user_login; 
$result = $account->submitApplication($first_name, $last_name, $middle_name,$date_birth, $age, $gender,  $civil_status, $brgy, $street_sitio, $place_birth, $education, $isSenior, $isPWD, $isPPPP, $family, $number);
echo json_encode($result);
?>

