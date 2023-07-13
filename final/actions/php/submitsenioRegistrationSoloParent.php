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
$education = $_POST["education"];
$occupation = $_POST["occupation"];
$income = $_POST["income"];
$mincome = $_POST["mincome"];
$family = $_POST["family"];
$number = $_POST["number"];
$classification = $_POST["classification"];
$problem = $_POST["problem"];
$resources = $_POST["resources"];

$account = new user_login; 
$result = $account->submitApplicationSoloParent($last_name, $first_name, $middle_name, $date_birth, $age, $gender, $brgy, $street_sitio, $place_birth,
                                      $education, $occupation, $income, $mincome, $family, $number, $classification, $problem, $resources);
echo json_encode($result);
?>

