<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;

$d = $account->getacount();
$type = $_GET["type"];
$id = $_GET["id"];

$survey = $account->getdetailsurvey($type, $id);
$name = $survey->fetch_assoc();


$symptom = $account->getSymptoms($type, $id)
?>
<style></style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div style="padding:15px 0px 10px 0px;">
                <a href="survey_history.php?type=<?php echo $type; ?>" class="btn btn-primary"><i class="fa fa-angle-left"></i> Survey History</a>
                <h3 style="float:right;">
                    <?php echo $name["name"]; ?>
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
                        <th>Symptoms</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; while($row = $symptom->fetch_assoc()){ ++$counter?>
                    <tr>
                        <td><?php echo $counter; ?>.</td>
                        <td><?php echo $row["description"].' <b>('. $row["descriptiontag"].')</b>'; ?></td>
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