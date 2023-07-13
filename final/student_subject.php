<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$studid = 0;
$account = new accounts;
$subject = $account->getAllsubject(0);


if (isset($_GET["studid"])){
    $studid = $_GET["studid"];
    $studSubject = $account->getSubjectByStudId($studid);
    $userdetails = $account->getUserbyId($studid);
    $u = $userdetails->fetch_assoc();
}

if (isset($_GET["delete"])){
    $account->deleteSubjectByStudId($_GET["delete"]);
    echo "<script> window.location.href = 'student_subject.php?studid=$studid'; </script>";
}


?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Add Subject
            <div class="card-body">
                <form method="POST" action="actions/php/addSubject.php">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <p>
                                    <input type="hidden" value="<?php echo $studid ?>" name="studid" />
                                    Subject <span style="color:red">*</span></br>
                                    <select class="form-control" required name="subject_id">
                                        <option value="">Select Subject</option>
                                                <?php while($row = $subject->fetch_assoc()){ ?>
                                        <option value="<?php echo $row["id"]; ?>" <?php echo $row["id"]; ?>>
                                            <?php echo "(".$row['subjectcode'].") ".$row['subjectname']; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"
                                    style="font-size:0.8em;"></i> Add Subject</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div style="float:left">Subject List of <?php echo $u["name"]; ?></div>
        </div>
        <div class="card-body mobile-card">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CODE</th>
                        <th>SUBJECT</th>
                        <th class="notoExport" style="width:80px">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; while($row = $studSubject->fetch_assoc()){  ++$counter?>
                    <tr>
                        <td><?php echo $counter; ?>.</td>
                        <td><?php echo $row["subjectcode"]; ?></td>
                        <td><?php echo $row["subjectname"]; ?></td>
                        <td>
                            <a href="?delete=<?php echo $row["id"]; ?>&studid=<?php echo $studid; ?>" type="submit" class="btn btn-danger btn-sm" style="color:#fff"><i class="fa fa-trash"
                                    style="font-size:0.8em;"></i> Delete</a>
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