<?php
// include the class
include "../../classes/userLogin.php";

// Data from Admin create Player
$name = $_POST["name"];
$address = $_POST["address"];
$number = $_POST["number"];
$survey = array();
if (isset($_POST["survey"])){
    $survey = $_POST["survey"];
}

$account = new user_login; 
$result = $account->submitSurveyVisitor($name, $address, $number,$survey);
echo json_encode($result);
?>

