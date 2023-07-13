<?php
include "../../classes/accounts.php";
$account = new accounts;

$id = $_POST["id"];
$subjectcode = str_replace("'","''",$_POST["subjectcode"]);
$subjectname = str_replace("'","''",$_POST["subjectname"]);
$unit = $_POST["unit"];
$teacher = $_POST["teacher"];
$timefrom = $_POST["timefrom"];
$timeto = $_POST["timeto"];
$day = $_POST["day"];

$account->addUpdatesubject($id, $subjectcode, $subjectname, $unit, $teacher, $timefrom, $timeto, $day);
header("Location: ../../subject.php");
?>