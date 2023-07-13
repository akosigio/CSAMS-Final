<?php
// include the class
include "../../classes/userLogin.php";

// Data from Admin create Player
$id_no = $_POST['id_no'];
$type = $_POST['type'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$suffix = $_POST['suffix'];
$date_birth = $_POST['date_birth'];
$gender = $_POST['gender'];
$civil_status = $_POST['civil_status'];
$number = $_POST['number'];
$brgy = $_POST['brgy'];
$street_sitio = $_POST['street_sitio'];
$place_birth = $_POST['place_birth'];
$occupation = $_POST['occupation'];
$typedisability = $_POST['typedisability'];
$cousedisability = $_POST['cousedisability'];
$flast_name = $_POST['flast_name'];
$ffirst_name = $_POST['ffirst_name'];
$fmiddle_name = $_POST['fmiddle_name'];
$mlast_name = $_POST['mlast_name'];
$mfirst_name = $_POST['mfirst_name'];
$mmiddle_name = $_POST['mmiddle_name'];
$glast_name = $_POST['glast_name'];
$gfirst_name = $_POST['gfirst_name'];
$gmiddle_name = $_POST['gmiddle_name'];


$account = new user_login; 
$ret["isSuccess"] = true;
$ret["errorMessage"] = "";
if ($type == 'Renewal'){
    if ($account->checkIfExistPWD($id_no)){
        $account->UpdatepwdStatus($id_no);
        echo json_encode($ret);
    }else{
        $ret["isSuccess"] = false;
        $ret["errorMessage"] = "ID not found, please check your PWD I.D no.";
        echo json_encode($ret);
    }
}else{
    $result = $account->submitPWD($last_name,$first_name,$middle_name,$suffix,$date_birth, $gender, $civil_status, $number, $brgy, $street_sitio,
                                           $place_birth, $occupation, $typedisability, $cousedisability, $flast_name, $ffirst_name, $fmiddle_name, $mlast_name,
                                           $mfirst_name, $mmiddle_name, $glast_name, $gfirst_name, $gmiddle_name);  
    echo json_encode($result);
}
?>

