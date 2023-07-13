<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;

$d = $account->getacount();

?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Profile : <?php echo $d["id_no"]; ?>
            <div class="card-body">
                <form method="POST" action="actions/php/updateInformationTeacher.php">
                    <div class="row">
                        <input type="hidden" class="uid" name="uid" value="<?php echo $d["id"]; ?>">
                        <div class="col-sm-4 mb-3">
                            <label>ID Number : <span style="color:red">*</span></label>
                            <input type="text" name="idno" readonly value="<?php echo $d["id_no"]; ?>"
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
                            <button type="submit" name="update_student" class="btn btn-primary" id="btnCreate">Update Account</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
<script>
$(document).ready(function() {
    setTimeout(() => {
        $(".pass").val("");
    }, 500);
})
</script>

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
   if (isset($_SESSION["teacher_information_success"])){
        echo "<script>swal('Success','Information successfully saved!','success');</script>";
   } 
?>