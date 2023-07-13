<?php   
include('includes/header.php'); 
include('includes/navbar.php');

$uid = $_GET["id"];
$type = "";
if ($_GET["type"] == 1){
    $type = "Admin";
}else if ($_GET["type"] == 2){
    $type = "Teacher";
}else if ($_GET["type"] == 3){
    $type = "Student";
}


$ut = $_GET["type"];


$account = new accounts;
$data = $account->getUserbyId($uid);
$d = $data->fetch_assoc()
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update <?php echo $type; ?> Account
                        <a href="account_list.php?type=<?php echo $ut; ?>" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" id="UpdateUser">
                        <div class="row">
                            <input type="hidden" class="type" value="<?php echo $_GET["type"]; ?>">
                            <input type="hidden" class="uid" value="<?php echo $_GET["id"]; ?>">
                            <div class="col-sm-6 col-sm-12 mb-3">
                                <label>ID Number : <span style="color:red">*</span></label>
                                <input type="number" onKeyPress="if(this.value.length==8) return false;" name="id" value="<?php echo $d["id_no"]; ?>"
                                    class="form-control idno" required>
                            </div>
                            <div class="col-sm-6 col-sm-12  mb-3">
                                <label>Name : <span style="color:red">*</span></label>
                                <input type="text" name="name" value="<?php echo $d["name"]; ?>"
                                    class="form-control name" pattern="[a-zA-Z][a-zA-Z ]{2,}" required>
                            </div>
                            <div class="mb-3">
                                <label>Contact Number : <span style="color:red">*</span></label>
                                <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;" name="contact" value="<?php echo $d["number"]; ?>"
                                    class="form-control number" required>
                            </div>
                            <?php if ($_GET["type"] == 3) { ?>
                            <div class="mb-3">
                                <label>Year : <span style="color:red">*</span></label>
                                <select class="form-control year" name="year">
                                    <option value=""> Select Year & Semester </option>
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
                                    <option value="Fourth year / First Semester"
                                        <?php echo $d["year"] == "Fourth year / First Semester" ? "" : "selected='selected'" ?>>
                                        Fourth year / First Semester</option>
                                    <option value="Fourth year / Second Semester"
                                        <?php echo $d["year"] == "Fourth year / Second Semester" ? "" : "selected='selected'" ?>>
                                        Fourth year / Second Semester</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Course : <span style="color:red">*</span></label>
                                <select class="form-control course" name="course">
                                    <option value="">Select Course</option>
                                    <option value="Bachelor in SECONDARY EDUCATION (BSEd)"
                                        <?php echo $d["year"] == "Bachelor in SECONDARY EDUCATION (BSEd)" ? "" : "selected='selected'" ?>>
                                        Bachelor in SECONDARY EDUCATION (BSEd)</option>
                                    <option value="Bachelor of TECHNICAL-VOCATIONAL TEACHER EDUCATION (BTVTEd)"
                                        <?php echo $d["year"] == "Bachelor of TECHNICAL-VOCATIONAL TEACHER EDUCATION (BTVTEd)" ? "" : "selected='selected'" ?>>
                                        Bachelor of TECHNICAL-VOCATIONAL TEACHER EDUCATION (BTVTEd)</option>
                                    <option value="Bachelor of EARLY CHILDHOOD EDUCATION (BECEd)"
                                        <?php echo $d["year"] == "Bachelor of EARLY CHILDHOOD EDUCATION (BECEd)" ? "" : "selected='selected'" ?>>
                                        Bachelor of EARLY CHILDHOOD EDUCATION (BECEd)</option>
                                    <option value="Bachelor of CULTURE AND ARTS EDUCATION (BCAEd)"
                                        <?php echo $d["year"] == "Bachelor of CULTURE AND ARTS EDUCATION (BCAEd)" ? "" : "selected='selected'" ?>>
                                        Bachelor of CULTURE AND ARTS EDUCATION (BCAEd)</option>
                                    <option value="Bachelor of PHYSICAL EDUCATION (BPE)"
                                        <?php echo $d["year"] == "Bachelor of PHYSICAL EDUCATION (BPE)" ? "" : "selected='selected'" ?>>
                                        Bachelor of PHYSICAL EDUCATION (BPE)</option>
                                    <option value="Bachelor of TECHNOLOGY AND LIVELIHOOD EDUCATION (BTLE)"
                                        <?php echo $d["year"] == "Bachelor of TECHNOLOGY AND LIVELIHOOD EDUCATION (BTLE)" ? "" : "selected='selected'" ?>>
                                        Bachelor of TECHNOLOGY AND LIVELIHOOD EDUCATION (BTLE)</option>
                                    <option value="Bachelor of Science in INFORMATION TECHNOLOGY (BSIT)"
                                        <?php echo $d["year"] == "Bachelor of Science in INFORMATION TECHNOLOGY (BSIT)" ? "" : "selected='selected'" ?>>
                                        Bachelor of Science in INFORMATION TECHNOLOGY (BSIT)</option>
                                    <option value="Associate in COMPUTER TECHNOLOGY (ACT)"
                                        <?php echo $d["year"] == "Associate in COMPUTER TECHNOLOGY (ACT)" ? "" : "selected='selected'" ?>>
                                        Associate in COMPUTER TECHNOLOGY (ACT)</option>
                                    <option value="Bachelor of Science IN BUSINESS ADMINISTRATION (BSBA)"
                                        <?php echo $d["year"] == "Bachelor of Science IN BUSINESS ADMINISTRATION (BSBA)" ? "" : "selected='selected'" ?>>
                                        Bachelor of Science IN BUSINESS ADMINISTRATION (BSBA)</option>
                                    <option value="Bachelor of Science IN OFFICE ADMINISTRATION (BSOA)"
                                        <?php echo $d["year"] == "Bachelor of Science IN OFFICE ADMINISTRATION (BSOA)" ? "" : "selected='selected'" ?>>
                                        Bachelor of Science IN OFFICE ADMINISTRATION (BSOA)</option>
                                    <option value="Bachelor of Science IN ACCOUNTING INFORMATION SYSTEM (BSAIS)"
                                        <?php echo $d["year"] == "Bachelor of Science IN ACCOUNTING INFORMATION SYSTEM (BSAIS)" ? "" : "selected='selected'" ?>>
                                        Bachelor of Science IN ACCOUNTING INFORMATION SYSTEM (BSAIS)</option>
                                    <option value="Bachelor of Science in ACCOUNTANCY (BSA)"
                                        <?php echo $d["year"] == "Bachelor of Science in ACCOUNTANCY (BSA)" ? "" : "selected='selected'" ?>>
                                        Bachelor of Science in ACCOUNTANCY (BSA)</option>
                                    <option value="Bachelor of Science in PSYCHOLOGY (Psych)"
                                        <?php echo $d["year"] == "Bachelor of Science in PSYCHOLOGY (Psych)" ? "" : "selected='selected'" ?>>
                                        Bachelor of Science in PSYCHOLOGY (Psych)</option>
                                    <option value="Bachelor in HUMAN SERVICES (BHS)"
                                        <?php echo $d["year"] == "Bachelor in HUMAN SERVICES (BHS)" ? "" : "selected='selected'" ?>>
                                        Bachelor in HUMAN SERVICES (BHS)</option>
                                    <option value="Bachelor of Science in HOSPITALITY MANAGEMENT (BSHM)"
                                        <?php echo $d["year"] == "Bachelor of Science in HOSPITALITY MANAGEMENT (BSHM)" ? "" : "selected='selected'" ?>>
                                        Bachelor of Science in HOSPITALITY MANAGEMENT (BSHM)</option>
                                    <option value="Bachelor of SCIENCE in TOURISM MANAGEMENT (BSTM)"
                                        <?php echo $d["year"] == "Bachelor of SCIENCE in TOURISM MANAGEMENT (BSTM)" ? "" : "selected='selected'" ?>>
                                        Bachelor of SCIENCE in TOURISM MANAGEMENT (BSTM)</option>
                                </select>
                            </div>
                            <?php } ?>

                            <div class="mb-3" style="padding-top:20px">
                                <div>User Account</div>
                                <hr class="">
                            </div>

                            <div class="mb-3">
                                <label>Username</label>
                                <input type="number" name="username" class="form-control uname"
                                    value="<?php echo $d["username"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" placeholder="Enter password (ex: Aaaa@123)" name="password"
                                        class="form-control pass" id="pass" autocomplete="new-password">
                                    <div class="input-group-append">
                                        <a href="" class="btn btn-success"><i class="fa fa-eye-slash"
                                                aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <span style="margin-top:5px; padding:3px 3%; width:100%; text-align:left"
                                    id="StrengthDisp" class="badge displayBadge">Weak</span>
                                <div>Leave blank if you don't want to change password!</div>
                            </div>
                            <div class= "col-sm-12 text-center">
                            <button type="submit" id="btnCreate" name="update_student" class="btn btn-success">Update
                                Account</button>
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