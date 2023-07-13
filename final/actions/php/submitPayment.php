<?php
// include the class
include "../../classes/accounts.php";

// Data from Admin create Player
$sid = $_POST['id'];
$date = $_POST['date'];
$amount = $_POST['amount'];

$account = new accounts;
$result = $account->submitPayment($sid, $date, $amount);
echo $result;
?>

