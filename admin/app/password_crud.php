 <?php 
 include '../../assets/constant/config.php';
 session_start();
 ?>
   <link href="../../assets/css/popup_style.css" rel="stylesheet">
   <?php
 // update password crud start
  if (isset($_POST['update'])){
$stmt = $db->prepare("select * from admin");
                                   $stmt->execute();
                                   $record = $stmt->fetchAll();
                                   $i=1;
                                   foreach ($record as $row) 
                                     { 



                 // current password encrypt    
                    $passw=hash('sha256',$_POST['old_pass']);
                     function createSalt()
                    {
                         return'2123293dsj2hu2nikhiljdsd';
                     }
                    $salt=createSalt();
                    $password2=hash('sha256',$salt.$passw);
         // end stored current password =$password2
         

          
          $password3=$row['admin_password'];
          // database password stored=$password3
          // echo $password3;

            // encrypt new password
            $passw1=hash('sha256',$_POST['new_pass']);
      function createSalt1()
      {
        return'2123293dsj2hu2nikhiljdsd';
          }
          $salt=createSalt();
          $password_new=hash('sha256',$salt.$passw1);

          // new password encrypt as $password_new
           
            // encrypt cumfirm password
            $passw2=hash('sha256',$_POST['confirm_pass']);
            function createSalt2()
            {
              return'2123293dsj2hu2nikhiljdsd';
            }
            $salt=createSalt();
            $password_c=hash('sha256',$salt.$passw2);
            if ($password3==$password2) {
                                            if($password_new==$password_c)
                                            {
                                               echo '<script>alert("Password match")</script>';
                                            foreach ($record as $key) {

                                            $sql="UPDATE admin SET admin_password =? WHERE admin_id=?"; 
                                            //print_r($sql); exit;
                                           $statement = $db->prepare($sql);
                                           $statement->execute([$password_new,$_SESSION['id']]);
                                           ?>
                                          <!--  // echo '<script>alert("Password Updated Successfully!!!!")</script>';
                                           // header("location:../../index.php"); -->
                                           <!-- popup for insert -->
    <div class="popup popup--icon -success js_success-popup popup--visible">
      <div class="popup__background"></div>
        <div class="popup__content">
         <h3 class="popup__content__title">
          Success 
         </h3>
        <p>Password Updated Successfully</p>
         <p>
     
         <?php echo "<script>setTimeout(\"location.href = '../../index';\",1500);</script>"; ?>
         </p>
        </div>
      </div>
      <?php
                                }
                              } else{?>
             <!--  // echo '<script>alert("Password Not Match")</script>';
              // // header("location:../dashboard.php"); -->
               <div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
        <p>Password Not Match</p>
         <p>
     
         <?php echo "<script>setTimeout(\"location.href = '../dashboard.php';\",1500);</script>"; ?>
         </p>
        </div>
      </div>
      <?php
                                          }
                            
                               // header("location:../profile.php");
              } 
            else{?>
             <!--  // echo '<script>alert("Password Not Match")</script>';
              // // header("location:../dashboard.php"); -->
               <div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
        <p>Password Not Match</p>
         <p>
     
         <?php echo "<script>setTimeout(\"location.href = '../dashboard.php';\",1500);</script>"; ?>
         </p>
        </div>
      </div>
      <?php
            }

        

                               }
                        
                   }      ?>

<!--  update password crud end -->

                      
       
