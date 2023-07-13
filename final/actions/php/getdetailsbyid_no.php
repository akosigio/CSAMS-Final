<?php
    include "../../classes/userLogin.php";
    $account = new user_login;
    $pwdid = $_POST["id_no"];
    $data = $account->getAllPWDBYidno($pwdid);
    $rows = $data->fetch_assoc();
    echo json_encode($rows);
?>