<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
$account = new accounts;

$admin = "";
$nurse = "";
$guard = "";
$data = $account->getsetting();
if (mysqli_num_rows($data) > 0){
    $setting = $data->fetch_assoc();
    $admin = $setting["admin"];
    $nurse = $setting["nurse"];
    $guard = $setting["guard"];
}
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Settings
            <div class="card-body">
                <form method="POST" id="saveSetting">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="form-group">
                                <p>
                                    Admin Contact Number <span style="color:red">*</span></br>
                                    <input type="number" 
                                        pattern="/^-?\d+\.?\d*$/" 
                                        onKeyPress="if(this.value.length==11) return false;"
                                        class="form-control admin" value="<?php echo $admin ?>" required
                                    name="admin" placeholder="Enter admin number"/>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <p>
                                    Nurse Contact Number <span style="color:red">*</span></br>
                                    <input type="number" 
                                        pattern="/^-?\d+\.?\d*$/" 
                                        onKeyPress="if(this.value.length==11) return false;"
                                        class="form-control nurse" value="<?php echo $nurse ?>" required
                                    name="nurse" placeholder="Enter nurse number"/>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <p>
                                    Guard Contact Number <span style="color:red">*</span></br>
                                    <input type="number" 
                                        pattern="/^-?\d+\.?\d*$/" 
                                        onKeyPress="if(this.value.length==11) return false;"
                                        class="form-control guard" value="<?php echo $guard ?>" required
                                    name="guard" placeholder="Enter guard number" />
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <button type="submit" class="btn btn-primary "><i class="fa fa-edit"
                                    style="font-size:0.8em;"></i> UPDATE SETTING</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>