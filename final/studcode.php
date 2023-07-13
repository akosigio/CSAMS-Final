<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_student']))
{
    $id =mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM student WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: studentdashboard.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: studentdashboard.php");
        exit(0);
    }
}

if(isset($_POST['update_student']))
{
    $id =mysqli_real_escape_string($con, $_POST['id']);

    $name =mysqli_real_escape_string($con, $_POST['name']);
    $usertype =mysqli_real_escape_string($con, $_POST['usertype']);
    $contact =mysqli_real_escape_string($con, $_POST['contact']);
    $course =mysqli_real_escape_string($con, $_POST['course']);
    $username =mysqli_real_escape_string($con, $_POST['username']);
    $password =mysqli_real_escape_string($con, $_POST['password']);

    $query = "UPDATE student SET name='$name', usertype ='$usertype', contact ='$contact', course='$course',username='$username',password='$password' WHERE id ='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: studentdashboard.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: studentdashboard.php");
        exit(0);
    }

}


if(isset($_POST['save_student']))
{
    $id=mysqli_real_escape_string($con, $_POST['id']);
    $name =mysqli_real_escape_string($con, $_POST['name']);
    $usertype =mysqli_real_escape_string($con, $_POST['usertype']);
    $contact =mysqli_real_escape_string($con, $_POST['contact']);
    $course =mysqli_real_escape_string($con, $_POST['course']);
    $username =mysqli_real_escape_string($con, $_POST['username']);
    $password =mysqli_real_escape_string($con, $_POST['password']);

    $query = "INSERT INTO student (id, name, usertype, contact, course, username, password) 
    VALUES ('$id','$name','$usertype','$contact','$course','$username','$password')";


    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: studentdashboard.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: studentdashboard.php");
        exit(0);
    }
}

?>