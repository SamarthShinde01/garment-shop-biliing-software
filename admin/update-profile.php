<?php


session_start();
if(!isset($_SESSION['id'])){
    header('location:../index.php');
}
?>
<?php include('include/sidebar.php');?>
<?php include('include/header.php');?>

<?php

    $stmt = $db->prepare("SELECT * from admin ");
    $stmt->execute();
    $record = $stmt->fetchAll();
    foreach ($record as $key) {
            // code...

    ?>

                        <center><h3 class="mb-0"><b>Update Profile</b></h3></center>
                 <section>
                    <div class="card border-0 shadow">
                        <div class="card-body">
                        <div class="container">
                             
                                <!-- Update admin profile form -->
                              
                                <form class="row" method="POST" action="app/updateprofile-crud.php" id="profile_form" enctype="multipart/form-data">
                                     <input type="hidden" class="form-control" name="admin_id" value="<?php echo $key['admin_id'];?>">
                                <div class="mb-3 col-md-5">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="afname" value="<?php echo $key['admin_fname'];?>" >
                                </div>
                                 <div class="mb-3 col-md-5">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="alname" value="<?php echo $key['admin_lname'];?>" >
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="aemail" value="<?php echo $key['admin_email'];?>" >
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="tel" class="form-control" name="amobile" value="<?php echo $key['admin_mobileno'];?>">
                                </div>
                                 <div class="mb-3 col-md-5">
                                    <label class="form-label">Address </label>
                                    <input type="tel" class="form-control" name="address" value="<?php echo $key['address'];?>">
                                </div>
                                

                                <div class="mb-3 col-md-5">
                                    <label class="form-label">Image</label>
                                    <br>
                                    <img src="../assets/img/<?php echo $key['admin_photo'];?>" width= "100px" height="100px">
                                    <input type="hidden" class="form-control" name="old_img" value="<?php echo $key['admin_photo'];?>">

                                    <input type="file" class="form-control" name="image" id="file" onchange="return fileValidation()" value="<?php echo $key['admin_photo'];?>">
                                </div>
                               

                                <div class="col-md-12">
                                    <center><button onclick="location.href = 'profile.php';" type="submit" class="btn btn-primary btn-sm" name="update" onclick="validateprofile()">Update</button>
                                    <button onclick="location.href = 'profile.php';" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </center>
                                </div>
                            </form>
                             <?php } ?>
                              </div>
                            </div>
                          </div>
                      </section>
                        
 <?php include('include/footer.php');?>