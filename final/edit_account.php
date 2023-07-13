<?php
 session_start();
 require 'dbconfig.php';   
include('includes/header.php'); 
include('includes/navbar.php'); 
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5">



        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Student Information
                            <a href="studentdashboard.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                        if(isset($_GET['id']))
                        {
                            $id = mysqli_real_escape_string($connection, $_GET['id']);
                            $query = "SELECT * FROM student WHERE id='$id' ";
                            $query_run = mysqli_query($connection, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $student = mysqli_fetch_array($query_run);
                                ?>
                        <form action="studcode.php" method="POST">
                        <div class="mb-3">
                                <label>Student Name</label>
                                <input type="text" name="name" value="<?=$student['name'];?>"  class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Account Type</label>
                                <input type="text" name="usertype" value="<?=$student['usertype'];?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>ID Number</label>
                                <input type="text" name="id" value="<?=$student['id'];?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Contact Number</label>
                                <input type="text" name="contact" value="<?=$student['contact'];?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Course and Year</label>
                                <input type="text" name="course" value="<?=$student['course'];?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Username</label>
                                <input type="text" name="username" value="<?=$student['username'];?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="text" name="password" value="<?=$student['password'];?>" class="form-control">
                            </div>
                                <button type="submit" name="update_student" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                        <?php
                 }
                 else
                 {
                     echo "<h4>No Such Id Found</h4>";
                 }
             }
                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
                  