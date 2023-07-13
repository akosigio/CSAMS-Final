   <?php 
   session_start();
   include('classes/accounts.php');
   $account = new accounts;

  $d = $account->getacount();
   ?>
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center">
  <div class="sidebar-brand-icon rotate-n-15">
  <img src='CSAMS WHITE.png' style="width:50px"/>
  </div>
  <div class="sidebar-brand-text mx-3" style="color:#ffffff">CSAMS</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">


<!-- <li class="nav-item active">
  <a class="nav-link" href="index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>


<hr class="sidebar-divider"> -->


<!-- Nav Item - Pages Collapse Menu -->
<?php if ($d["usertype"] == 1){ ?>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Account Management</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <!-- <h6 class="collapse-header">User</h6> -->
        <a class="collapse-item" href="account_list.php?type=1">Admin</a>
        <a class="collapse-item" href="account_list.php?type=3">Student</a>
        <a class="collapse-item" href="account_list.php?type=2">Teacher</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="surveycustom.php">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Survey Customization</span></a>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>View Survey</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Surveys</h6>
        <a class="collapse-item" href="survey_history.php?type=1">Students Survey</a>
        <a class="collapse-item" href="survey_history.php?type=2">Visitors Survey</a>
      </div>
    </div>
  </li>


  <li class="nav-item">
    <a class="nav-link" href="subject.php">
      <i class="fas fa-fw fa-book"></i>
      <span>Subject</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="setting.php">
      <i class="fas fa-fw fa-cog"></i>
      <span>Setting</span></a>
  </li>
<?php } ?>

<?php if ($d["usertype"] == 3){ ?>
<li class="nav-item">
  <a class="nav-link" href="my-classes.php">
    <i class="fas fa-fw fa-clock"></i>
    <span>Class today</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="student_information.php">
    <i class="fas fa-fw fa-user"></i>
    <span>My Profile</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="attendance_history.php">
    <i class="fas fa-fw fa-file"></i>
    <span>Attendance History</span></a>
</li>
<?php } ?>
<?php if ($d["usertype"] == 2){ ?>
  <li class="nav-item">
  <a class="nav-link" href="attendance.php">
    <i class="fas fa-fw fa-clock"></i>
    <span>Attendance</span></a>
</li>
  <li class="nav-item">
  <a class="nav-link" href="mysubject.php">
    <i class="fas fa-fw fa-book"></i>
    <span>My Subject</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="class_history.php">
    <i class="fas fa-fw fa-file"></i>
    <span>Class History</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="teacher_information.php">
    <i class="fas fa-fw fa-user"></i>
    <span>My Profile</span></a>
</li>
<?php } ?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form  action ="" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method= "GET">
            <div class="input-group">
              <h4><?php echo $d["name"]; ?></h4>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600">
                  
               <?php
                  if($d["usertype"] == 1){
                    echo "Admin";
                  }else if ($d["usertype"] == 2){
                    echo "Teacher";
                  }else{
                    echo "Student";
                  }
               ?>
                  
                </span>
                <img class="img-profile rounded-circle" src="csams.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                 
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <form action="actions/php/logout.php" method="POST"> 
          
            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

          </form>
        </div>
      </div>
    </div>
  </div>
  