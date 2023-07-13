<?php 
include('classes/userLogin.php');

$account = new user_login;
$data = $account->getAllSurvey(0);
$d = $account->getacount();

$admin = "";
$nurse = "";
$guard = "";
$settingData = $account->getsetting();
if (mysqli_num_rows($data) > 0){
    $setting = $settingData->fetch_assoc();
    $admin = $setting["admin"];
    $nurse = $setting["nurse"];
    $guard = $setting["guard"];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">

    <title>Student Survey</title>
    <style>
    .custom-container {
        width: 100%;
        margin: 0px 10%;
    }

    @media (max-width:768px) {
        .custom-container {
            margin: 0px 1%;
        }
    }

    .col-lg-6 {
        max-width: 49%;
        margin: 0.5%;
    }

    .col-lg-12 {
        max-width: 99%;
        margin: 0.5%;
    }

    @media (max-width:768px) {
        .col-lg-6 {
            max-width: 99%;
            margin: 0.5%;
        }
    }
    </style>
</head>

<body>
    <div class="custom-container" style="background:#fff;">
        <div class="card-body">
            <div style="text-align:center">
                <img src="cstc.png" style="width:200px" />
            </div>
            <div style="text-align:center; padding:10px; padding-bottom:25px">Are you experiencing or did you have any
                of the following in the last 14 days ? <b>Ikaw ba ay may nararanasan o nakaranas
                    ng mga sumusunod na sintomas sa nakaraang 14 na araw? </b>
                </b>
            </div>
            <div class="row surveycon" style="font-size:14px">
                <div id="contactnumber" style="display:none">
					<?php if ($admin != ''){ ?>
						<div data-value="<?php echo $admin ?>"><?php echo $admin ?></div>
					<?php } ?>
					<?php if ($nurse != ''){ ?>
						<div data-value="<?php echo $nurse ?>"><?php echo $nurse ?></div>
					<?php } ?>
					<?php if ($guard != ''){ ?>
					<div data-value="<?php echo $guard ?>"><?php echo $guard ?></div>
					<?php } ?>
				</div>
                <?php 
					$column = 0; 
					while($row = $data->fetch_assoc()){ 
						if ($row["column"] == 1){ $column += 1; }
						if ($row["column"] == 2) { 
				?>
                <div class="col-lg-6" style="background: #afefc9; border-radius: 5px; padding: 3%;">
                    <label for="s<?php echo $row["id"]; ?>">
                        <input type="checkbox" data-id="<?php echo $row["id"]; ?>" id="s<?php echo $row["id"]; ?>" />
                        <?php echo $row["description"].' <b>('.$row["descriptiontag"].')</b>'; ?>
                    </label>
                </div>
                <?php }else{  if ($column == 1) {?>
                <div class="col-lg-12" style="padding-top:30px"></div>
                <?php } ?>
                <div class="col-lg-12" style="background: #afefc9; border-radius: 5px; padding: 3%;">
                    <label for="s<?php echo $row["id"]; ?>">
                        <input type="checkbox" data-id="<?php echo $row["id"]; ?>" id="s<?php echo $row["id"]; ?>" />
                        <?php echo $row["description"].' <b>('.$row["descriptiontag"].')</b>'; ?>
                    </label>
                </div>
                <?php } } ?>
                <div class="col-sm-12">
                    <div class="form-group" style="text-align:center; padding-top:25px">
                        <div>I understand that by clicking the submit button</div>
                        <div>I agree to the CSAMS privacy policy</div>
                        <div class="form-group" style="text-align:center; padding-top:10px">
                            <input type="hidden" class="number" value="<?php echo $d["number"]; ?>" />
                            <input type="hidden" class="student" value="<?php echo $d["name"]  ?>" />
                            <button class="btn btn-primary submitStudentSurvey" style="padding:10px 100px">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/sweetalert2.min.js"></script>
<script src="actions/js/login.js"></script>

</html>