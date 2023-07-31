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
                        <!-- Admin Profile Photo -->
                        <center><h3 class="mb-0"><b>Admin Profile</b></h3></center><br>
                       <div align="center">
                               <img src="../assets/img/<?php echo $key['admin_photo'];?>" height="150px" width="150px" class="rounded-circle" > <br>   
                                <?php echo $key['admin_fname'].' '.$key['admin_lname'];?>
                                </div>
                        
                 <section>
                    
                        <div class="container">
                            <div class="card ">
                    <div class="card border-0 shadow">
                        <div class="card-body ">
                             
                                <!-- View admin profile form -->
                                <form class="row"  method="" action="">
                                    <!-- Admin Details -->
                                     <input type="hidden" class="form-control" name="admin_id" value="<?php echo $key['admin_id'];?>">
                                <div class="mb-3 col-md-5">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="afname" value="<?php echo $key['admin_fname'];?>" disabled>
                                </div>
                                 <div class="mb-3 col-md-5">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="alname" value="<?php echo $key['admin_lname'];?>" disabled>
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="aemail" value="<?php echo $key['admin_email'];?>" disabled>
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="tel" class="form-control" name="amobile" value="<?php echo $key['admin_mobileno'];?>"disabled>
                                </div>
                                  <div class="mb-3 col-md-5">
                                    <label class="form-label">Address </label>
                                    <input type="tel" class="form-control" name="address" value="<?php echo $key['address'];?>"disabled>
                                </div>

                                <div class="col-md-12">
                                    <center>
                                       <a href="update-profile.php?admin_id=" class="btn1"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"s> Update</button></a>
                                    <button onclick="location.href = 'dashboard.php';" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </center>
                                </div>
                               
                            </form>
                             <?php } ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                        </section>
 <?php include('include/footer.php');?>