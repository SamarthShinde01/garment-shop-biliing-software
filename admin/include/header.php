    <!-- Page Content  -->
    <?php include('../assets/constant/config.php');?> 
    <?php

    $stmt = $db->prepare("SELECT admin_photo,admin_email , admin_fname, admin_lname from admin ");
    $stmt->execute();
    $record = $stmt->fetchAll();
    foreach ($record as $key) {
            // code...

    ?> 

        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container-fluid">
                     
                    <button type="button" id="sidebarCollapse" class="btn text-sidebar bg-turbo-yellow">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ms-auto">
                            <li class="nav-item ">
                               <div id="google_translate_element"></div>
                            </li>
                           
                        </ul>
                        <div class="dropdown ">
						  <a class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">

						   <img src="../assets/img/<?php echo $key['admin_photo'];?>" width="50px" class="rounded-circle">
						  </a>
						  <ul class="dropdown-menu p-0 rounded border-0 shadow">
                            <small class="text-overflow m-0"></small>
						    <!-- <li><a class="dropdown-item py-2">&nbsp; Welcome !</a></li> -->
                            <li><a class="dropdown-item py-2">&nbsp;   <?php echo $key['admin_fname'].' '.$key['admin_lname'];?></a></li>
                            
                            <li><a class="dropdown-item py-2" href="profile.php"><i class="fa fa-user"></i>&nbsp; Profile</a></li>
						    <li><a class="dropdown-item py-2" href="change-password.php"><i class="fa fa-key"></i>&nbsp; Change Password</a></li>
						    <li><a class="dropdown-item py-2" href="../logout.php"><i class="fa fa-lock"></i>&nbsp; Logout</a></li>
						  </ul>
						</div>
                         <?php } ?>
                    </div>
                </div>
            </nav>
