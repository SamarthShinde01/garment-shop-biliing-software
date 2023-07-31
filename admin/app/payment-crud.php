<?php 
 include '../../assets/constant/config.php';
 session_start();
//insert crud for payment form start
		if (isset($_POST['submit'])) 
		{
     //print_r($_POST); exit;
$sql = "INSERT INTO `payment`(`invoice_no`,`payment_method`,`payment_received`,`payment_date`,`cust_id`) VALUES (?,?,?,?,?)";
     //print_r($sql); exit;
    $statement = $db->prepare($sql);
    $statement->bindparam(1, htmlspecialchars($_POST['ino']));
    $statement->bindparam(2, htmlspecialchars($_POST['pmethod']));
    $statement->bindparam(3, htmlspecialchars($_POST['precieved']));
    $statement->bindparam(4, htmlspecialchars($_POST['pdate']));
    $statement->bindparam(5, htmlspecialchars($_POST['cust']));
    $statement->execute();

	

			header("location:../payment.php" ); 

		
		}

//insert crud end

//update crud for payment form start
if (isset($_POST['update']))
		 {
		// print_r($sql); 
		$sql="UPDATE payment SET invoice_no = ?, payment_method = ?, payment_received = ?,  payment_date = ?, cust_id=? WHERE payment_id=? ";	
	$stmt = $db->prepare($sql);
$stmt->execute([$_POST['ino'],$_POST['pmethod'], $_POST['precieved'], $_POST['pdate'], $_POST['cust'], $_POST['pid']]);
		

		 	header("location:../payment.php");
		 }
		
	//update crud end	

//delete for payment form
 if (isset($_GET['delid'])) 
		 {
			$stmt = $db->prepare("UPDATE payment SET delete_status=1  Where payment_id=?"); 
			$stmt->execute([ $_GET['delid']]);
			

			header("location:../payment.php");
		}
		
//delete end

			
			
			