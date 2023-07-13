<?php
// include the class
include "../../classes/accounts.php";

// Data from Admin create Player
$uid = $_POST['uid'];
$idno = $_POST['idno'];
$name = $_POST['name'];
$number = $_POST['number'];
$year = $_POST['year'];
$course = $_POST['course'];
$pass = $_POST['pass'];

$account = new accounts;
$result = $account->updateUser($pass, $name, $course, $year,  $number, $uid, $idno);
if (!isset($_SESSION)){ session_start(); }
$_SESSION["student_information_success"] = "1";
echo "<script>window.location.href = '../../student_information.php'</script>";
?>