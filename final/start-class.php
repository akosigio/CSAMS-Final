<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;
$totalPresent = 0;
$totalAbsent = 0;
$totalStudent = 0;
if (isset($_GET["sid"])){
    $sid = $_GET["sid"];
    if (!isset($_SESSION)){ session_start(); }
    $uid = $_SESSION["acount_user_id"];
    $account->startClasses($uid, $sid);

    $subject = $account->getAllsubject($sid);
    $srows = $subject->fetch_assoc();

    $myStudent = $account->getAllMyStudentBySubjectandTeacher($uid, $sid);
    $myStudentPresentAbsent = $account->getAllMyStudentBySubjectandTeacher($uid, $sid);

    while($present = $myStudentPresentAbsent->fetch_assoc()){
        ++$totalStudent;
        if ($present["status"] == '1'){
            ++$totalPresent;
        }else{
            ++$totalAbsent;
        }
    }
}else{
    echo "<script>window.location.href = 'attendance.php'</script>";
} 
?>
<style></style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div id="qrResult" style="text-align: center; width: 100%; display: grid; place-items: center;"></div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body mobile-card">
            <div style="padding-left:10px">
                <h5>Total Student: <span><?php echo $totalStudent; ?></span></h5>
                <h5>Total Present: <span id="present"><?php echo $totalPresent; ?></span></h5>
                <h5>Total Absent: <span id="absent"><?php echo $totalAbsent; ?></span></h5>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body mobile-card">
            <div style="padding:15px 0px 10px 10px;">
                <h3>
                    <?php 
                        $timefrom = date_create($srows["timefrom"]);
                        $timeto = date_create($srows["timeto"]);
                        echo $srows["subjectcode"].' - '.$srows["subjectname"].'  ('.date_format($timefrom,"H:s").'-'.date_format($timeto,"H:s").')'; 
                    ?>
                </h3>
            </div>
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>STUDENT</th>
                        <th>TIME-IN</th>
                        <th>TIME-OUT</th>
                        <th>STATUS</th>
                        <th class="notoExport">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; while($row = $myStudent->fetch_assoc()){ ++$counter?>
                    <tr>
                        <td><?php echo $counter; ?>.</td>
                        <td><?php echo $row["id_no"]; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["timein"]; ?></td>
                        <td><?php echo $row["timeout"]; ?></td>
                        <td>
                            <?php 
                                    if ($row["status"] == 0){
                                        echo "<span class='btn btn-danger btn-sm'>Absent</span>";
                                    }else if ($row["status"] == 1){
                                        echo "<span class='btn btn-success btn-sm'>Present</span>";
                                    }else if ($row["status"] == 2){
                                        echo "<span class='btn btn-primary btn-sm'>Late</span>";
                                    }   
                                ?>
                        </td>
                        <td>
                            <?php if ($row["status"] == 0){ ?>
                            <form action="actions/php/saveAttendanceManual.php" method="POST">
                                <input type="hidden" name="sid" value="<?php echo $_GET["sid"] ?>" />
                                <input type="hidden" name="stud_id" value="<?php echo $row["stud_id"] ?>" />
                                <button type="submit" class="btn btn-primary btn-sm" id="setPresent"
                                    title="set this student to present">set present</button>
                            </form>
                            <?php } ?>
                        </td>
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

<script type="text/javascript">
var qrcode = new QRCode(document.getElementById('qrResult'), {
    width: 300,
    height: 300
});

function generate() {
    qrcode.makeCode('<?php echo $sid.'a'.$uid; ?>');
}
generate();

$(document).ready(function() {
    function refresh() {
        var d = {
            uid: <?php echo $uid; ?>,
            sid: <?php echo $sid; ?>
        }
        $.ajax({
            url: 'actions/php/getMyStudent.php',
            type: 'POST',
            dataType: 'json',
            data: d,
            success: function(res) {
                $("#present").html("0");
                $("#absent").html("0");
                for (var i = 0; i < res.length; i++) {
                    if (res[i].status != 0) {
                        $("#present").html(Number($("#present").html()) + 1);
                        $('#datatable > tbody  > tr').each(function(index, tr) {
                            if (res[i].id_no == $(this).find("td:eq(1)").html()) {
                                if (res[i].status == 1) {
                                    if ($(this).find("td:eq(5) span").html() != "Present") {
                                        $(this).find("td:eq(5) span").removeClass();
                                        $(this).find("td:eq(5) span").addClass(
                                            "btn btn-success btn-sm");
                                        $(this).find("td:eq(5) span").html("Present");
                                        $(this).find("td:eq(3)").html(res[i].timein);
                                    }
                                } else {
                                    if ($(this).find("td:eq(5) span").html() != "Late") {
                                        $(this).find("td:eq(5) span").removeClass();
                                        $(this).find("td:eq(5) span").addClass(
                                            "btn btn-primary btn-sm");
                                        $(this).find("td:eq(5) span").html("Late")
                                    }

                                }
                            }
                        });
                    }else{
                        $("#absent").html(Number($("#absent").html()) + 1);
                    }
                }
                
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
    setInterval(() => {
        refresh();
    }, 1000);
})
</script>