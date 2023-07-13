<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
$type = "";
if ($_GET["type"] == 1){
    $type = "Admin";
}else if ($_GET["type"] == 2){
    $type = "Teacher";
}else if ($_GET["type"] == 3){
    $type = "Student";
}

$ut = $_GET["type"];
$account = new accounts;
$data = $account->getAllUser($ut);

?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div style="float:left"><?php echo $type; ?> List</div>
            <div style="float:right">
                <a type="button" class="btn btn-primary" href="create_account.php?type=<?php echo $_GET["type"]; ?>">
                    Add <?php echo $type?>
                </a>
            </div>
        </div>
        <div class="card-body mobile-card">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID No.</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <?php if ($ut == 3){ ?>
                        <th>Course and Year</th>
                        <?php } ?>
                        <th class="notoExport" style="width:150px">Action</th>
                        <?php if ($ut == 3){ ?>
                        <th class="notoExport">SUBJECT</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $counter = 0;
                        while($rows = $data->fetch_assoc()){
                            ++$counter;
                    ?>
                    <td><?php echo $counter; ?>.</td>
                    <td><?php echo $rows['id_no']; ?></td>
                    <td><?php echo $rows['username']; ?></td>
                    <td><?php echo $rows['name']; ?></td>
                    <td><?php echo $rows['number']; ?></td>
                    <?php if ($ut == 3){ ?>
                    <td><?php echo $rows['course'].' - '.$rows['year']; ?></td>
                    <?php } ?>
                    <td>
                        <a href="update_user.php?id=<?= $rows['id']; ?>&type=<?php echo $ut; ?>" name="ebtn"
                            class="btn btn-success btn-sm">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                        </form>
                        <a href="?type=<?php echo $ut; ?>&id=<?= $rows['id']; ?>&delete=1" type="submit"
                            name="delete_student" value="<?= $rows['id'];?>"
                            class="btn btn-danger btn-sm">Delete</button>
                    </td>
                    <?php if ($ut == 3){ ?>
                    <td>
                        <a href="student_subject.php?studid=<?= $rows['id'];?>" type="submit" name="delete_student"
                            value="<?= $rows['id'];?>" class="btn btn-info btn-sm">&nbsp;&nbsp;view&nbsp;&nbsp;</button>
                    </td>
                    <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
</div>
</div>
</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

<?php
if (isset($_GET["delete"])){
    $id = $_GET["id"];
    echo "<script>
            swal({
                title: 'Warning',
                text: 'You are about to delete this user!, click yes to continue',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3390b9',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                closeOnConfirm: true
            }).then((isConfirm) => {
                console.log(isConfirm);
                if(isConfirm.dismiss == 'cancel'){
                    window.location.href = 'account_list.php?type=$ut';
                }else if (isConfirm) {
                    $.ajax({
                        url  : 'actions/php/deletefunction.php',
                        type    : 'POST',
                        dataType: 'json',
                        data    : { id: $id, deletetype:'user'},
                        success : function(res){
                            console.log(res);
                            if (res.isSuccess){
                                window.location.href = 'account_list.php?type=$ut';
                            }else{
                                swal('Oops!', res.errorMessage,'warning');
                            }
                        }, error  : function(e){console.log(e);}
                    });
                    
                }                
            });
        </script>
        ";
}
?>