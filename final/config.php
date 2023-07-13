<?php

 $servername='localhost';
 $username='root';
 $password='';
 $dbname='adminpanel';
 $conn=mysqli_connect($servername, $username, $password, $dbname);
 if(isset($_POST['submit'])){
     $username=$_POST['email'];
     $password=$_POST['pass'];
     $query = 'SELECT * FROM user WHERE username=? and password=?';
     $stmt=mysqli_prepare($conn, $query);
     mysqli_stmt_bind_param($stmt, 'ss', $username, $password); 
     mysqli_stmt_execute($stmt);
     if(mysqli_stmt_fetch($stmt)){
         echo "<script type='text/javascript'>alert('you are login successfully');window.location.href='index.php';</script>";
     }else{
         echo 'error';
     }
 }
?>