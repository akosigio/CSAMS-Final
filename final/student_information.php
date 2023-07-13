<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;

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
                            <input type="text" readonly name="idno" value="<?php echo $d["id_no"]; ?>"
                                class="form-control idno" required>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Name : <span style="color:red">*</span></label>
                            <input type="text" name="name" value="<?php echo $d["name"]; ?>" class="form-control name"
                                required readonly>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Contact Number : <span style="color:red">*</span></label>
                            <input type="text" name="number" value="<?php echo $d["number"]; ?>" name="number"
                                class="form-control number" required>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Year : <span style="color:red">*</span></label>
                            <input type="text" class="form-control year" name="year" value="<?php echo $d["year"]; ?>" readonly>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label>Course : <span style="color:red">*</span></label>
                            <input type="text" class="form-control course" name="course" value="<?php echo $d["course"]; ?>" readonly>
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
                            <div class="input-group" id="show_hide_password">
                                <input type="password" placeholder="Enter password (ex: Aaaa@123)" name="pass"
                                    class="form-control pass" id="pass" autocomplete="new-password">
                                <div class="input-group-append">
                                    <a href="" class="btn btn-success"><i class="fa fa-eye-slash"
                                            aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <span style="margin-top:5px; padding:3px 3%; width:100%; text-align:left" id="StrengthDisp"
                                class="badge displayBadge">Weak</span>
                            <div>Leave blank if you don't want to change password!</div>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" name="update_student" class="btn btn-primary" id="btnCreate">Update
                                Account</button>
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
        <div class="card-body mobile-card">
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
$("#StrengthDisp").hide();
var password = document.getElementById("pass");
password.addEventListener("input", () => {
    var timeout;
    $("#StrengthDisp").hide();
    strengthBadge = document.getElementById("StrengthDisp");
    clearTimeout(timeout);
    timeout = setTimeout(() => StrengthChecker(password.value), 200);
    if (password.value.length !== 0) {
        strengthBadge.style.display != 'block';
    } else {
        strengthBadge.style.display = 'none';
    }
});


function StrengthChecker(PasswordParameter) {
    $("#StrengthDisp").show();
    strengthBadge = document.getElementById("StrengthDisp");
    let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{10,})')
    let mediumPassword = new RegExp(
        '((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))'
    );
    if (PasswordParameter == "") {
        $('#btnCreate').removeAttr('disabled');
        $("#StrengthDisp").hide();
    } else {
        if (strongPassword.test(PasswordParameter)) {
            strengthBadge.style.backgroundColor = "green"
            strengthBadge.textContent = 'Strong'
            $('#btnCreate').removeAttr('disabled');
        } else if (mediumPassword.test(PasswordParameter)) {
            $('#btnCreate').removeAttr('disabled');
            strengthBadge.style.backgroundColor = 'blue'
            strengthBadge.textContent = 'Medium'
        } else {
            $('#btnCreate').attr('disabled', 'disabled');
            strengthBadge.style.backgroundColor = 'red';
            strengthBadge.textContent =
                'Password must be 8 or morethan character with Upper Case, number and special character'

        }
    }

}
</script>

<?php 
   if (!isset($_SESSION)){ session_start(); }
   if (isset($_SESSION["student_information_success"])){
        echo "<script>swal('Success','Information successfully saved!','success');</script>";
   } 
?>