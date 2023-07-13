<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;

$d = $account->getacount();

$subject = $account->getSubjectByStudId($d["id"]);
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Profile : <?php echo $d["id_no"]; ?>
            <div class="card-body">
                <form method="POST" action="actions/php/updateInformation.php">
                    <div class="row">
                        <input type="hidden" class="uid" name="uid" value="<?php echo $d["id"]; ?>">
                        <div class="col-sm-4 mb-3">
                            <label>ID Number : <span style="color:red">*</span></label>
                            <input type="text" readonly name="idno" value="<?php echo $d["id_no"]; ?>" class="form-control idno"
                                required>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Name : <span style="color:red">*</span></label>
                            <input type="text" name="name" value="<?php echo $d["name"]; ?>" class="form-control name"
                                required>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Contact Number : <span style="color:red">*</span></label>
                            <input type="text" name="number" value="<?php echo $d["number"]; ?>" name="number"
                                class="form-control number" required>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Year : <span style="color:red">*</span></label>
                            <select class="form-control year" name="year">
                                <option value="">>> select year & semester << </option>
                                <option value="First year / First Semester"
                                    <?php echo $d["year"] == "First year / First Semester" ? "" : "selected='selected'" ?>>
                                    First year / First Semester</option>
                                <option value="First year / Second Semester"
                                    <?php echo $d["year"] == "First year / Second Semester" ? "" : "selected='selected'" ?>>
                                    First year / Second Semester</option>
                                <option value="Second year / First Semester"
                                    <?php echo $d["year"] == "Second year / First Semester" ? "" : "selected='selected'" ?>>
                                    Second year / First Semester</option>
                                <option value="Second year / Second Semester"
                                    <?php echo $d["year"] == "Second year / Second Semester" ? "" : "selected='selected'" ?>>
                                    Second year / Second Semester</option>
                                <option value="Third year / First Semester"
                                    <?php echo $d["year"] == "Third year / First Semester" ? "" : "selected='selected'" ?>>
                                    Third year / First Semester</option>
                                <option value="Third year / Second Semester"
                                    <?php echo $d["year"] == "Third year / Second Semester" ? "" : "selected='selected'" ?>>
                                    Third year / Second Semester</option>
                                <option value="Fourt year / First Semester"
                                    <?php echo $d["year"] == "Fourt year / First Semester" ? "" : "selected='selected'" ?>>
                                    Fourt year / First Semester</option>
                                <option value="Fourt year / Second Semester"
                                    <?php echo $d["year"] == "Fourt year / Second Semester" ? "" : "selected='selected'" ?>>
                                    Fourt year / Second Semester</option>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Course : <span style="color:red">*</span></label>
                            <select class="form-control course" name="course">
                                <option value="">>> select course << </option>
                                <option value="BSIT"
                                    <?php echo ($d["course"] == 'BSIT' ? "selected='selected'" : ""); ?>>BSIT</option>
                            </select>
                        </div>

                        <div class="col-sm-12 mb-3" style="padding-top:20px">
                            <div>User Account</div>
                            <hr class="">
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control uname" name="uname"
                                value="<?php echo $d["username"]; ?>" readonly>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control pass" name="pass">
                            <div>Leave blank if you don't want to change password!</div>
                        </div>

                       <div class="col-sm-12">
                            <button type="submit" name="update_student" class="btn btn-primary">Update Account</button>
                       </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div style="float:left">Subject List</div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CODE</th>
                        <th>SUBJECT</th>
                        <th>UNIT</th>
                        <th>DATE & TIME</th>
                        <th>TEACHER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; while($row = $subject->fetch_assoc()){ ++$counter?>
                    <tr>
                        <td><?php echo $counter; ?>.</td>
                        <td><?php echo $row["subjectcode"]; ?></td>
                        <td><?php echo $row["subjectname"]; ?></td>
                        <td><?php echo $row["unit"]; ?></td>
                        <td>
                            <?php
                                    $timefrom = date_create($row["timefrom"]);
                                    $timeto = date_create($row["timeto"]);
                                    echo $row["day"].' ('.date_format($timefrom,"H:s a").' to '.date_format($timeto,"H:s a").')'; 
                                ?>
                        </td>
                        <td><?php echo $row["name"]; ?></td>
                    </tr>
                    
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
<script>
   $(document).ready(function(){ setTimeout(() => {
    $(".pass").val("");
   }, 300); }) 
</script>