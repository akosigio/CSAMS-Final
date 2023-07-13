<?php
// include the class
include "../../classes/accounts.php";

$survey = array();
if (isset($_POST["survey"])){
    $survey = $_POST["survey"];
}

$account = new accounts; 
$result = $account->submitSurvey_student($survey);
echo json_encode($result);
?>

