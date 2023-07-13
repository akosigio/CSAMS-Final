<?php
// include the class
include "../../classes/accounts.php";

// Data from Admin create Player
$uid = $_POST['uid'];
$idno = $_POST['idno'];
$name = $_POST['name'];
$number = $_POST['number'];
$pass = $_POST['pass'];

$account = new accounts;
$result = $account->updateUser($pass, $name, '', '',  $number, $uid, $idno);
$_SESSION["teacher_information_success"] = "1";
echo "<script>window.location.href = '../../teacher_information.php'</script>";
?>