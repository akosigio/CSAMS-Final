<?php 
include('classes/accounts.php');  
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

    <title>Login Page</title>
</head>

<body>
    <div class="container">
        <form method="POST" id="login">
            <div class="row">

                <div class="col-sm-12 brand_logo">
                    <img src="csams.png" width="170" height="150" class="center">
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        Username
                        <input type="text" placeholder="Username" name="email" class="form-control uname">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        Password
                        <div class="input-group" id="show_hide_password">
                            <input type="password" placeholder="Password" name="password" class="form-control upass">
                            <div class="input-group-append">
                                <a href="" class="btn btn-success"><i class="fa fa-eye-slash"
                                        aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <form action="visitor.php" method="POST">
            <div class="row">
                <div class="col-sm-12">
                    <div style="text-align:center;padding-bottom:10px">--or--</div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <button name="submit" style="width:100%" class="btn btn-primary">I am a Visitor</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="actions/js/login.js"></script>
</body>

</html>