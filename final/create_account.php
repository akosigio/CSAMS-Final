<?php 
include('includes/header.php'); 
include('includes/navbar.php');

$type = "";
if ($_GET["type"] == 1){
    $type = "Admin";
}else if ($_GET["type"] == 2){
    $type = "Teacher";
}else if ($_GET["type"] == 3){
    $type = "Student";
}
$ut = $_GET["type"];

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create <?php echo $type; ?> Account
                        <a href="account_list.php?type=<?php echo $ut; ?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" id="createuser">
                        <div class="row">
                            <input type="hidden" class="type" value="<?php echo $_GET["type"]; ?>">
                            <div class="mb-3">
                                <label>ID Number : <span style="color:red">*</span></label>
                                <input type="number" name="id" onKeyPress="if(this.value.length==8) return false;" value="" placeholder="Enter ID Number"
                                    class="form-control idno" required>
                            </div>
                            <div class="mb-3">
                                <label>Name : <span style="color:red">*</span></label>
                                <input type="text" name="name" value="" placeholder="Enter Full Name"
                                    class="form-control name" pattern="[a-zA-Z][a-zA-Z ]{2,}" required>
                            </div>
                            <div class="mb-3">
                                <label><?php echo $_GET["type"] == 3 ? "Parent Contact number" : "Contact Number" ?> : <span style="color:red">*</span></label>
                                <input type="number" pattern="/^-?\d+\.?\d*$/" placeholder="<?php echo $_GET["type"] == 3 ? "Enter Parent Contact number" : "Enter Contact Number" ?>"
                                    onKeyPress="if(this.value.length==11) return false;" name="contact" value=""
                                    class="form-control number" required>
                            </div>
                            <?php if ($_GET["type"] == 3) { ?>
                            <div class="mb-3">
                                <label>Year : <span style="color:red">*</span></label>
                                <select class="form-control year" name="year">
                                    <option value="">Select Year & Semester</option>
                                    <option value="First year / First Semester">First year / First Semester</option>
                                    <option value="First year / Second Semester">First year / Second Semester</option>
                                    <option value="Second year / First Semester">Second year / First Semester</option>
                                    <option value="Second year / Second Semester">Second year / Second Semester</option>
                                    <option value="Third year / First Semester">Third year / First Semester</option>
                                    <option value="Third year / Second Semester">Third year / Second Semester</option>
                                    <option value="Fourth year / First Semester">Fourth year / First Semester</option>
                                    <option value="Fourth year / Second Semester">Fourth year / Second Semester</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Course : <span style="color:red">*</span></label>
                                <select class="form-control course" name="course">
                                    <option value="">Select Course </option>
                                    <option value="Bachelor in SECONDARY EDUCATION (BSEd)">Bachelor in SECONDARY EDUCATION (BSEd)</option>
                                    <option value="Bachelor of TECHNICAL-VOCATIONAL TEACHER EDUCATION (BTVTEd)">Bachelor of TECHNICAL-VOCATIONAL TEACHER EDUCATION (BTVTEd)</option>
                                    <option value="Bachelor of EARLY CHILDHOOD EDUCATION (BECEd)">Bachelor of EARLY CHILDHOOD EDUCATION (BECEd)</option>
                                    <option value="Bachelor of CULTURE AND ARTS EDUCATION (BCAEd)">Bachelor of CULTURE AND ARTS EDUCATION (BCAEd)</option>
                                    <option value="Bachelor of PHYSICAL EDUCATION (BPE)">Bachelor of PHYSICAL EDUCATION (BPE)</option>
                                    <option value="Bachelor of TECHNOLOGY AND LIVELIHOOD EDUCATION (BTLE)">Bachelor of TECHNOLOGY AND LIVELIHOOD EDUCATION (BTLE)</option>
                                    <option value="Bachelor of Science in INFORMATION TECHNOLOGY (BSIT)">Bachelor of Science in INFORMATION TECHNOLOGY (BSIT)</option>
                                    <option value="Associate in COMPUTER TECHNOLOGY (ACT)">Associate in COMPUTER TECHNOLOGY (ACT)</option>
                                    <option value="Bachelor of Science IN BUSINESS ADMINISTRATION (BSBA)">Bachelor of Science IN BUSINESS ADMINISTRATION (BSBA)</option>
                                    <option value="Bachelor of Science IN OFFICE ADMINISTRATION (BSOA)">Bachelor of Science IN OFFICE ADMINISTRATION (BSOA)</option>
                                    <option value="Bachelor of Science IN ACCOUNTING INFORMATION SYSTEM (BSAIS)">Bachelor of Science IN ACCOUNTING INFORMATION SYSTEM (BSAIS)</option>
                                    <option value="Bachelor of Science in ACCOUNTANCY (BSA)">Bachelor of Science in ACCOUNTANCY (BSA)</option>
                                    <option value="Bachelor of Science in PSYCHOLOGY (Psych)">Bachelor of Science in PSYCHOLOGY (Psych)</option>
                                    <option value="Bachelor in HUMAN SERVICES (BHS)">Bachelor in HUMAN SERVICES (BHS)</option>
                                    <option value="Bachelor of Science in HOSPITALITY MANAGEMENT (BSHM)">Bachelor of Science in HOSPITALITY MANAGEMENT (BSHM)</option>
                                    <option value="Bachelor of SCIENCE in TOURISM MANAGEMENT (BSTM)">Bachelor of SCIENCE in TOURISM MANAGEMENT (BSTM)</option>
                                </select>
                            </div>
                            <?php } ?>

                            <div class="mb-3" style="padding-top:20px">
                                <div>User Account</div>
                                <hr class="">
                            </div>

                            <div class="mb-3">
                                <label>Username</label>
                                <input type="text" name="username" placeholder="Enter Username"
                                    class="form-control uname">
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" placeholder="Enter Password (ex: Aaaa@123)" name="password"
                                        class="form-control pass" id="pass" autocomplete="new-password">
                                    <div class="input-group-append">
                                        <a href="" class="btn btn-success"><i class="fa fa-eye-slash"
                                                aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <span style="margin-top:5px; padding:3px 3%; width:100%; text-align:left"
                                    id="StrengthDisp" class="badge displayBadge">Weak</span>
                            </div>

                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" placeholder="Confirm password" name="password"
                                    class="form-control cpass">
                            </div>
                             <div class= "col-sm-12 text-center">
                            <button id="btnCreate" type="submit" name="update_student" class="btn btn-success"
                                disabled>CREATE
                                ACCOUNT</button>
                                </div>
                        </div>
                </div>

                </form>
            </div>
        </div>
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
            'Password must be 8 or more than character with Upper Case, Number and Special Character'

    }
}
</script>