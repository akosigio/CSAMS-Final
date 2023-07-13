<?php
 session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include('classes/accounts.php');
$account = new accounts;
$data = $account->getAllUser(2);
$subject = $account->getAllsubject(0);


$id = 0;
$code = "";
$name = "";
$unit = "";
$tf = "";
$tt = "";
$tid = "";

if (isset($_GET["delete"])){
    $id = $_GET["id"];
    $account->deleteSubject($id);
    echo "<script>window.location.href = '/subject.php'</script>";
}else{
    if (isset($_GET["id"])){
        $datarow = $account->getAllsubject($_GET["id"]);
        $subjectrow = $datarow->fetch_assoc();
        $id = $subjectrow["id"];
        $code = $subjectrow["subjectcode"];
        $name = $subjectrow["subjectname"];
        $unit = $subjectrow["unit"];
        $tf = $subjectrow["timefrom"];
        $tt = $subjectrow["timeto"];
        $tid = $subjectrow["teacher_id"];;
    }
}
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Create Subject
            <div class="card-body">
                <form method="POST" action="actions/php/addUpdateSubject.php">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <p>
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>" />
                                    Subject Code <span style="color:red">*</span></br>
                                    <input type="text" class="form-control" value="<?php echo $code ?>" required
                                        name="subjectcode" />
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <p>
                                    Subject name <span style="color:red">*</span></br>
                                    <input type="text" class="form-control" value="<?php echo $name ?>" required
                                        name="subjectname" />
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <p>
                                    Unit <span style="color:red">*</span></br>
                                    <input type="number" required class="form-control" value="<?php echo $unit ?>"
                                        required name="unit" />
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <p>
                                    Time <span style="color:red">*</span></br>
                                    <input type="time" name="timefrom" value="<?php echo $tf ?>" class="form-control"
                                        style="width:45%; display:inline-block" /> -
                                    <input type="time" name="timeto" value="<?php echo $tt ?>" required
                                        class="form-control" style="width:45%; display:inline-block" />
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <p>
                                    Assign Teacher <span style="color:red">*</span></br>
                                    <select class="form-control" required name="teacher">
                                        <option value="">>>select teacher<<< /option>
                                                <?php while($row = $data->fetch_assoc()){ ?>
                                        <option value="<?php echo $row["id"]; ?>"
                                            <?php echo $row["id"] == $tid ? "selected='selected'" : "" ?>>
                                            <?php echo $row["name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <?php if ($id > 0 ){ ?>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"
                                    style="font-size:0.8em;"></i> Update Subject</button>
                            <a href="subject.php" type="button" class="btn btn-primary"><i class="fa fa-arrow-left"
                                    style="font-size:0.8em;"></i> &nbsp;&nbsp; Cancel &nbsp; &nbsp;</a>
                            <?php } ?>
                            <?php if ($id == 0 ){ ?>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"
                                    style="font-size:0.8em;"></i> Create Subject</button>
                            <?php } ?>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div style="float:left">Subject List</div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CODE</th>
                        <th>SUBJECT</th>
                        <th>UNIT</th>
                        <th>TIME</th>
                        <th>TEACHER</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; while($row = $subject->fetch_assoc()){ ++$counter?>
                    <tr>
                        <td><?php echo $counter; ?>.</td>
                        <td><?php echo $row["subjectcode"]; ?></td>
                        <td><?php echo $row["subjectname"]; ?></td>
                        <td><?php echo $row["unit"]; ?></td>
                        <td>
                            <?php
                                    $timefrom = date_create($row["timefrom"]);
                                    $timeto = date_create($row["timeto"]);
                                    echo date_format($timefrom,"H:s a").' to '.date_format($timeto,"H:s a"); 
                                ?>
                        </td>
                        <td><?php echo $row["name"]; ?></td>
                        <td>
                            <a href="?id=<?php echo $row['id']; ?>" name="ebtn" class="btn btn-success btn-sm"
                                style="padding:5px 17px">Edit</a>
                            </form>
                            <a href="?id=<?php echo $row['id']; ?>&delete=1" name="delete_student"
                                class="btn btn-danger btn-sm">Delete</button>
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