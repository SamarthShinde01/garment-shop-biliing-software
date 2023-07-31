<?php 
 include '../../assets/constant/config.php';
 session_start();

//update crud for user form start
if (isset($_POST['update']))
		 {
		 	// echo $_POST['update'];
		 	$filepath = "../../assets/img/" . $_FILES["image"]["name"];

            if(move_uploaded_file($_FILES["image"]["tmp_name"], $filepath)) 
            {

                $img=$_FILES["image"]["name"];
            } 
            else 
            {
                $img=$_POST['old_img'];
            }
		//print_r($_POST['update']); exit;
		 
		$sql="UPDATE admin SET admin_fname = ?,admin_lname = ?,admin_email = ?,admin_mobileno = ?,admin_photo = ?,address = ?  WHERE admin_id=? ";	
		// print_r($sql);
	$stmt = $db->prepare($sql);

  $stmt->execute([$_POST['afname'], $_POST['alname'], $_POST['aemail'], $_POST['amobile'],$img,$_POST['address'],$_POST['admin_id']]);
		
	//print_r($stmt); exit;
		 	header("location:../profile.php");
		 }
		
	//update crud end	

			
			