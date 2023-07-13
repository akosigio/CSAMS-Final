<?php
include "../../classes/accounts.php";
$account = new accounts;

$result = $account->updateSettings($_POST["admin"], $_POST["nurse"], $_POST["guard"]);
echo $result;
?>