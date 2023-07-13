<?php
include "../../classes/accounts.php";
$account = new accounts;

$statusMsg = "";
if (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["url"]) && isset($_POST["description"])){
    $id = $_POST["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $url = $_POST["url"];
    $allowTypes = array('jpg','png','jpeg','gif'); 

    $statusMsg = "";
    if(!empty($_FILES["img"]["name"])) { 
        $fileName = basename($_FILES["img"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['img']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $account->addUpdateBanner($id, $title, $url, $description, $imgContent);
            header("Location: ../../administration/banner.php");
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            header("Location: ../../administration/banner.php?error=$statusMsg");
        } 
    }else{
        $account->addUpdateBanner($id, $title, $url, $description, "");
        header("Location: ../../administration/banner.php");
    }

    
    echo $statusMsg;
    // $account->addUpdateAnnoucement($id,$name, $description);
    // header("Location: ../../administration/announcement.php");
}

echo $statusMsg;
?>