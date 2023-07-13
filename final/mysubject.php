<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;

$d = $account->getacount();

$subject = $account->mySubject();
$subjectCount = mysqli_num_rows($subject);

?>
<style></style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4>My Subject - <?php echo $subjectCount; ?></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <?php while($row = $subject->fetch_assoc()){ ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2 shadow" style="border-left: 0.25rem solid #2abe85!important;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <h4 style="font-family: sans-serif;"><?php echo $row["subjectcode"] ?></h4>
                                    </div>
                                    <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#000000e8; font-size:12px">
                                        <?php echo $row["subjectname"] ?>
                                    </div>
                                    <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#000000b3; font-size:11px">
                                        <?php 
                                            $timefrom = date_create($row["timefrom"]);
                                            $timeto = date_create($row["timeto"]);
                                            echo $row["day"].' ('.date_format($timefrom,"H:s a").' to '.date_format($timeto,"H:s a").')'; 
                                        ?>
                                    </div>
                                    <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#000000e8; font-size:12px">
                                        <a href="view-student.php?sid=<?php echo $row["id"] ?>">View students <i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-check fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
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