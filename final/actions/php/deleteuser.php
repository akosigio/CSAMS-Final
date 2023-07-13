<?php
include "../../classes/accounts.php";
$account = new accounts;
$id = $_POST["id"];
$ret["isSuccess"] = true;
$ret["errorMessage"] = "Success";
if (!$account->deleteUser($id)){
    $ret["isSuccess"] = false;
    $ret["errorMessage"] = "Something error!";
};

echo json_encode($ret);
?>