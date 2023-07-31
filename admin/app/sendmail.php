  <?php  
 include '../../assets/constant/config.php';

 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
 require '../../PHPMailer/src/PHPMailer.php';
 require '../../PHPMailer/src/SMTP.php';
//  INSERT INTO `tbl_info` (`smtp_server`, `smtp_username`, `smtp_password`, `stmp_port`, `smtp_type`, `keywords`) VALUES
// ('mail.raghavinfocom.com', 'no_reply@raghavinfocom.com', 'zo?n6BDVGtdo', '587', 'tls', 'sadad');
// COMMIT;

   $otp=rand(1000,9000);
   // echo $otp; exit();
   $stmt2=$db->prepare("UPDATE admin SET `otp`='$otp'");
   $stmt2->execute();




   $stmt = $db->prepare("SELECT * FROM tbl_info");
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach($result as $row)
    { 
        $smtp_server = $row['smtp_server'];
        $smtp_password = $row['smtp_password'];
        $smtp_enc = $row['smtp_type'];
        $smtp_username = $row['smtp_username'];
        $smtp_port = $row['stmp_port'];

        
    }
        
$stmt3 = $db->prepare("SELECT * FROM admin");
 
    $stmt3->execute();
    $result3=$stmt3->fetchAll();
    foreach ($result3 as $key) {
    // code...


$msg1 = "Dear Admin, <br>
    Your otp is ".$key['otp']."<br>
    thank you!!! ";
  
}
     $mail = new PHPMailer(true);

 
      $mail->isSMTP();
      $mail->Host       = $smtp_server;
      $mail->SMTPAuth   = true;
      $mail->Username   = $smtp_username;
      $mail->Password   = $smtp_password;
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port       = 587;

      $mail->setFrom($smtp_username);
      $mail->addAddress('sss.upturnit@gmail.com');
     

      $mail->isHTML(true);

      $mail->Subject = 'Test Query';
      $mail->Body    = $msg1;
      $mail->AltBody = $msg1;
      //$mail->send();
     


     if($mail->send())
      {
header("location:../getotp.php" ); 

      }
      // 64 admin=5*