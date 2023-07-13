<?php
include "../../classes/accounts.php";
$account = new accounts;

if (isset($_POST["studid"]) && isset($_POST["subject_id"])){
    $studid = $_POST["studid"];
    $subjectid = $_POST["subject_id"];
    
    $account->createStudentSubject($studid, $subjectid);
    header("Location: ../../student_subject.php?studid=$studid");
}

?>