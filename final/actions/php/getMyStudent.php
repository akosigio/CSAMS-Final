<?php
include "../../classes/accounts.php";
$account = new accounts;
$uid = $_POST["uid"];
$sid = $_POST["sid"];
$data = $account->getAllMyStudentBySubjectandTeacher($uid, $sid);
$return_arr = array();
while($row = $data->fetch_assoc()){
    $return_arr[] = $row;
}
echo json_encode($return_arr);
?>