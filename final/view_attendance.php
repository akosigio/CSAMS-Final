<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

$account = new accounts;

?>
<style></style>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row" style="padding:20px 0px 10px 0px">
                <div class="col-sm-6">
                    <div class="form-group">
                        <select class="form-control">
                            <option value=""> >>select subject<< </option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-success" style="display:inline-block">&nbsp;&nbsp; Confirm &nbsp;&nbsp;</button>
                    </div>
                </div>
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
                        <th>STUDENT NAME</th>
                        <th>TIME-IN</th>
                        <th>TIM-OUT</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    
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