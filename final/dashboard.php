

<?php
include('includes/header.php'); 
include('includes/navbar.php');

$account = new accounts;
$admin = mysqli_num_rows($account->getAllUser(1));
$teacher = mysqli_num_rows($account->getAllUser(2));
$student = mysqli_num_rows($account->getAllUser(3));
$subjects = mysqli_num_rows($account->getAllsubject(0));
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">ACCOUNTS</h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card shadow h-100 py-2" style="border-left:5px solid #099d52">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#099d52; font-size:14px">Admin Account</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php echo $admin; ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card shadow h-100 py-2" style="border-left:5px solid #099d52">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#099d52; font-size:14px">Teachers</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php echo $teacher; ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card shadow h-100 py-2" style="border-left:5px solid #099d52">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#099d52; font-size:14px">Students</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php echo $student; ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">SUBJECTS</h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card shadow h-100 py-2" style="border-left:5px solid #099d52">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#099d52; font-size:14px">All subjects</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php echo $subjects; ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>








<?php
include('includes/scripts.php');
include('includes/footer.php');
?>