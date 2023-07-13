<?php
include "../../classes/accounts.php";
$account = new accounts;

if (isset($_POST["id"]) && isset($_POST["descriptionTag"]) && isset($_POST["descriptionEng"]) && isset($_POST["column"])){
    $id = $_POST["id"];
    $column = $_POST["column"];
    $descriptionEng = str_replace("'","''",$_POST["descriptionEng"]);
    $descriptionTag = str_replace("'","''",$_POST["descriptionTag"]);
    
    $account->addUpdateSurvey($id, $descriptionEng, $descriptionTag, $column);
    header("Location: ../../surveycustom.php");
}

?>