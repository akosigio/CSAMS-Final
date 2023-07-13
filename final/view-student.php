<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;

$d = $account->getacount();

if (isset($_GET["sid"])){
    $subject = $account->getAllsubject($_GET["sid"]);
    $srows = $subject->fetch_assoc();

    $data = $account->getStudendBySubject($_GET["sid"]);
    $student = mysqli_num_rows($data);
}else{
    echo "<script>window.location.href = 'mysubject.php'</script>";
}
?>
<style></style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div style="padding:15px 0px 10px 0px;">
                <a href="mysubject.php" class="btn btn-primary"><i class="fa fa-angle-left"></i> My subject</a>
                <h3 style="float:right;">
                    <?php 
                        $timefrom = date_create($srows["timefrom"]);
                        $timeto = date_create($srows["timeto"]);
                        echo $srows["subjectcode"].' - '.$srows["subjectname"].'  ('.date_format($timefrom,"H:s").'-'.date_format($timeto,"H:s").')'; 
                    ?>
                </h3>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body mobile-card">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>STUDENT</th>
                        <th>COURSE</th>
                        <th>YEAR/SEMESTER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; while($row = $data->fetch_assoc()){ ++$counter?>
                    <tr>
                        <td><?php echo $counter; ?>.</td>
                        <td><?php echo $row["id_no"]; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["course"]; ?></td>
                        <td><?php echo $row["year"]; ?></td>
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
<script>
$(document).ready(function() {
    setTimeout(() => {
        $(".pass").val("");
    }, 300);
})
</script>