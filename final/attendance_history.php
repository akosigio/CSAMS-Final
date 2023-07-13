<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;
$attendance = $account->attendanceHistory();
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div style="float:left">Attendance History</div>
        </div>
        <div class="card-body mobile-card">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>DATE</th>
                        <th>DAY</th>
                        <th>SUBJECT</th>
                        <th>TEACHER</th>
                        <th>TIME-IN</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; while($row = $attendance->fetch_assoc()){ ++$counter?>
                    <tr>
                        <td><?php echo $counter; ?>.</td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><?php echo $row["day"]; ?></td>
                        <td><?php echo $row["subjectname"]; ?></td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["timein"]; ?></td>
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