<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
$id = 0;
$account = new accounts;

$description = "";
$column = "";
$descriptionTag = "";
if (isset($_GET["id"])){
    $id = $_GET["id"];
    $data = $account->getAllSurvey($id);
    $s = $data->fetch_assoc();
    $description = $s["description"];
    $descriptionTag = $s["descriptiontag"];
    $column = $s["column"];
}
?>

<div style="padding:2%">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="actions/php/addUpdateSurvey.php">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <p>
                                Column : <span style="color:red">*</span> </br>
                                <select class="form-control" name="column">
                                    <option value="">select column</option>
                                    <option value="1" <?php echo $column==1 ? "selected='selected'" : ""; ?>>1</option>
                                    <option value="2" <?php echo $column==2 ? "selected='selected'" : ""; ?>>2</option>
                                </select>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <p>
                                Description English : <span style="color:red">*</span> </br>
                                <textarea type="text" class="form-control descriptionEng"
                                    name="descriptionEng"><?php echo $description; ?></textarea>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <p>
                                Description Tagalog : <span style="color:red">*</span> </br>
                                <textarea type="text" class="form-control descriptionTag"
                                    name="descriptionTag"><?php echo $descriptionTag; ?> </textarea>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <?php if (!isset($_GET["delete"])) { 
                            if (isset($_GET["id"]) && $id > 0) {?>
                        <button type="submit" class="btn btn-primary" name="create" style="color:#fff; cursor:pointer">
                            Update Survey
                        </button>
                        <a href="surveycustom.php" type="button" class="btn btn-primary" name="create"
                            style="color:#fff; cursor:pointer; background:#cf923e">
                            &nbsp;&nbsp;Cancel&nbsp;&nbsp;
                        </a>
                        <?php }else {?>
                        <button type="submit" class="btn btn-primary" name="create" style="color:#fff; cursor:pointer">
                            Create Survey
                        </button>
                        <?php } }?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body mobile-card">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>English</th>
                        <th>Tagalog</th>
                        <th>Column</th>
                        <th class="notoExport">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $dataS = $account->getAllSurvey(0);
                        $counter = 0;
                        while($row = $dataS->fetch_assoc()){
                            ++$counter;
                    ?>
                    <tr>
                        <td><?php echo $counter; ?>.</td>
                        <td><?php echo $row["id"] ?></td>
                        <td><?php echo $row["description"] ?></td>
                        <td><?php echo $row["descriptiontag"] ?></td>
                        <td><?php echo $row["column"] ?></td>
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

<?php
if (isset($_GET["delete"])){
    $id = $_GET["id"];
?>
<script>
swal({
    title: 'Warning',
    text: 'You are about to delete this survey details!, click yes to continue',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3390b9',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    closeOnConfirm: true,
    closeOnCancel: true,
}).then((isConfirm) => {
    console.log(isConfirm);
    if (isConfirm.dismiss == 'cancel') {
        window.location.href = 'surveycustom.php';
    }else if (isConfirm) {
        $.ajax({
            url: 'actions/php/deletefunction.php',
            type: 'POST',
            dataType: 'json',
            data: {
                id: <?php echo $id ?>,
                deletetype: 'survey'
            },
            success: function(res) {
                console.log(res);
                if (res.isSuccess) {
                    window.location.href = 'surveycustom.php';
                } else {
                    swal('Oops!', res.errorMessage, 'warning');
                }
            },
            error: function(e) {
                console.log(e);
            }
        });
    }
});
</script>
<?php } ?>