<?php
include "../../classes/accounts.php";


if (isset($_GET["q"])){
    $account = new accounts;
    $data = $account->searchByBrgy($_GET["q"]);
    echo json_encode($data);
}
?>