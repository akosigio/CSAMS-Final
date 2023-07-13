<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;
$classes = $account->classHistory();
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div style="float:left">Class History</div>
        </div>
        <div class="card-body mobile-card">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>DATE</th>
                        <th>SUBJECT</th>
                        <th>DAY</th>
                        <th>TIME</th>
                        <th>STUDENT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; while($row = $classes->fetch_assoc()){ ++$counter?>
                    <tr>
                        <td><?php echo $counter; ?>.</td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><?php echo $row["subjectname"]; ?></td>
                        <td><?php echo $row["day"]; ?></td>
                        <td>
                            <?php 
                                $timefrom = date_create($row["timefrom"]);
                                $timeto = date_create($row["timeto"]);
                                echo date_format($timefrom,"H:s a").' - '.date_format($timeto,"H:s a"); 
                            ?>
                        </td>
                        <td>
                            <a href='student_attend.php?sid=<?php echo $row["sid"] ?>'
                                class='btn btn-primary btn-sm'>Student <i class="fa fa-angle-right"></i></a>
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