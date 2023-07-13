<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;
$type = 0;
if (isset($_GET["type"])){
    $type = $_GET["type"];
}

$survey = $account->getAllSubmitSurvey($type);
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <?php
                if ($type == 1){
                    echo "<h4>Students Survey</h4>";
                }else if ($type == 2){
                    echo "<h4>Visitors Survey</h4>";
                }
            ?>
        </div>
        <div class="card-body mobile-card">

            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <?php if ($type == 1){ ?>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>STUDENT</th>
                        <th>COURSE</th>
                        <th>YEAR</th>
                        <th>NUMBER</th>
                        <th>DATE</th>
                        <th>SYMPTOMS</th>
                        <th class="notoExport">action</th>
                    </tr>
                    <?php } ?>
                    <?php if ($type == 2){ ?>
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>ADDRESS</th>
                        <th>NUMBER</th>
                        <th>DATE</th>
                        <th>SYMPTOMS</th>
                        <th class="notoExport">action</th>
                    </tr>
                    <?php } ?>
                </thead>
                <tbody>
                    <?php 
                        $student = 0;
                        $visitor = 0;
                        while($row = $survey->fetch_assoc()){ 
                            if ($type == 1) { ++$student;?>
                    <tr>
                        <td><?php echo $student; ?>.</td>
                        <td><?php echo $row["id_no"]; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["course"]; ?></td>
                        <td><?php echo $row["year"]; ?></td>
                        <td><?php echo $row["number"]; ?></td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><?php echo $row["survey"]; ?></td>
                        <td>
                            <a href="survey_symptoms.php?type=1&id=<?php echo $row["id"]; ?>" class="btn btn-success"> view <i class="fa fa-angle-right"></i></a>
                        </td>
                    </tr>

                    <?php }else if ($type == 2) { ++$visitor; ?>
                    <tr>
                        <td><?php echo $visitor; ?>.</td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["address"]; ?></td>
                        <td><?php echo $row["number"]; ?></td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><?php echo $row["survey"]; ?></td>
                        
                        <td>
                            <a href="survey_symptoms.php?type=2&id=<?php echo $row["id"]; ?>" class="btn btn-success"> view <i class="fa fa-angle-right"></i></a>
                        </td>
                    </tr>
                    <?php } } ?>
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
                for (var i = 0; i < res.length; i++) {
                    if (res[i].status != 0) {
                        $('#datatable > tbody  > tr').each(function(index, tr) {
                            if (res[i].id_no == $(this).find("td:eq(1)").html()) {
                                if (res[i].status == 1) {
                                    if ($(this).find("td:eq(5) span").html() != "Present") {
                                        $(this).find("td:eq(5) span").removeClass();
                                        $(this).find("td:eq(5) span").addClass(
                                            "btn btn-success btn-sm");
                                        $(this).find("td:eq(5) span").html("Present")
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