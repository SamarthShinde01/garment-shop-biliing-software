<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:../index.php');
}
?>
<?php include('include/sidebar.php');?>
    <?php include('include/header.php');?>
      <div class="content-body mb-5 p-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-4 d-flex align-items-center justify-content-between">
                        <div align="center">
                        <!-- <h3 class="mb-0">Change Password </h3> -->
                      </div>
                        <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Change Password </span></p>
                    </div>
                </div>
            </div>


             <div  align="center">
                        <h2 class="mb-0"><b>Change Password</b> </h2>
                         </div><br>
            <div align="center">
            <div align="center" style="width:550px">
               
             <div class="card border-1 shadow" >
                        <div class="card-body mt-5">
                            <!-- Form Start -->
                         <form method="POST" id="change_pass_form" action="app/password_crud.php">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Old Password <span class="required">*</span> </label>
                                    <input type="password" class="form-control" name="old_pass">
                                </div>
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label">New Password <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="new_pass" >
                                </div>
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label">Confirm New Password <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="confirm_pass" >
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-sm"  name="update" onclick="change_password()"> Update </button>
                                 </div>
                            </form>
                            <!-- Form End -->
                        </div>
                    </div>
                    </div>
                    </div>
     </div>
<?php include('include/footer.php');?>