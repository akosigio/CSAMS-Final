<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;

$d = $account->getacount();

$todaySubject = $account->mySubjectStudentCount();

$subject = $account->mySubjectToday();
$subjectCount = mysqli_num_rows($subject);

?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4> Take Attendance</h4>
        </div>
        <?php if ($todaySubject > 0) { ?>
        <div class="card-body">
            <div style="text-align:center">
                <button id="showreader" class="btn btn-success" style="margin-bottom:15px">SCAN QRCODE</button>
                <div id="reader" style="width:100%"> </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4><?php echo $todaySubject == 0 ? "" : "Your classes today"; ?></h4>
        </div>
        <div class="card-body">
            <?php if ($todaySubject == 0) {?>
            <div style="padding:30px; text-align:center">
                <H1>You have no class today</H1>
            </div>
            <?php } ?>
            <div class="row">
                <?php 
                    while($row = $subject->fetch_assoc()){ 
                    date_default_timezone_set('Asia/Manila');
                    if (strtoupper(date('l')) == strtoupper($row["day"])){ 
                ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2 shadow" style="border-left: 0.25rem solid #2abe85!important;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <h4 style="font-family: sans-serif;"><?php echo $row["subjectcode"] ?></h4>
                                    </div>
                                    <div class="text-xs font-weight-bold text-uppercase mb-1"
                                        style="color:#000000e8; font-size:12px">
                                        <?php echo $row["subjectname"] ?>
                                    </div>
                                    <div class="text-xs font-weight-bold text-uppercase mb-1"
                                        style="color:red; font-size:11px">
                                        <?php 
                                            $timefrom = date_create($row["timefrom"]);
                                            $timeto = date_create($row["timeto"]);
                                            echo date_format($timefrom,"H:s a").' to '.date_format($timeto,"H:s a"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-check fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } }?>
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
        }, 300);
    })
</script>
<script type = "text/javascript" >
    function onScanSuccess(qrCodeMessage) {
        var d = {
            sid: qrCodeMessage.split("a")[0],
            tid: qrCodeMessage.split("a")[1],
        }
        $.ajax({
                url  : 'actions/php/saveAttendance.php',
                type    : 'POST',
                dataType: 'json',
                data    : d,
                success : function(res){
                    console.log(res);
                    if (res.isSuccess){
                        swal("Success","successuly attend to the class","success");
                        html5QrcodeScanner.clear();
                        $("#reader").hide();
                    }else{
                        swal("Oops!",res.errorMessage, "warning");
                        html5QrcodeScanner.clear();
                        $("#reader").hide();
                    }
                }, error  : function(e){console.log(e);}
        });
    }

    function onScanError(errorMessage) {
        //handle scan error
    }
    var html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", { fps: 10, qrbox: 250 });
    
    $("#showreader").click(function(){
        //html5QrcodeScanner.clear();
        $("#reader").show();
        html5QrcodeScanner.render(onScanSuccess);
    })
</script>