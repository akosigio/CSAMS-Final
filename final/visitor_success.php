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

    <title>Visitor Page</title>
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

    .col-sm-6 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 49%;
        margin: 0.5%;
    }

    .col-sm-12 {
        max-width: 99%;
        margin: 0.5%;
    }
    </style>
</head>

<body>
    <div class="custom-container" style="background:#fff;">
        <div class="card-body">
            <div style="text-align:center">
                <img src="cstc.png" style="width:300px" />
            </div>
            <div style="text-align:center; padding:10px; padding-bottom:25px;">
                <h5>
                    <?php 
                        date_default_timezone_set('Asia/Manila');
                        $date = date('l jS \of F Y h:i:s A');
                        echo $date;
                    ?>
                </h5>
                <h4>CSTC Sariaya, Quezon</h4>
                <h4>Submitted!</h4>
                </br>
                <img src="activation.png" style="width:200px" />
                
                <h5 style="padding-top:20px">
                    <div>I HAVE FILLED OUT MY</div>
                    <div>HEALTH DECLARATION FORM</div>
                </h5>
            </div>
        </div>
    </div>
</body>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/sweetalert2.min.js"></script>
<script src="actions/js/login.js"></script>

</html>