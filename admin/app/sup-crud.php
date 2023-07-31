<?php
include '../../assets/constant/config.php';
session_start();
//insert crud for user form start
if (isset($_POST['submit'])) {
	//print_r($_POST); exit;
	$sql = "INSERT INTO `supplier`(`sup_fname`,`sup_lname`,`sup_email`,`sup_mobile`,`sup_add`,`sup_city`,`sup_state`) VALUES (?,?,?,?,?,?,?)";
	//print_r($sql); exit;
	$statement = $db->prepare($sql);
	$statement->bindparam(1, htmlspecialchars($_POST['fname']));
	$statement->bindparam(2, htmlspecialchars($_POST['lname']));
	$statement->bindparam(3, htmlspecialchars($_POST['email']));
	$statement->bindparam(4, htmlspecialchars($_POST['mobile']));
	$statement->bindparam(5, htmlspecialchars($_POST['address']));
	$statement->bindparam(6, htmlspecialchars($_POST['sup_city']));
	$statement->bindparam(7, htmlspecialchars($_POST['state']));
	$statement->execute();



	header("location:../supplier.php");
}

// supplier model crud

if (isset($_POST['submit2'])) {
	//print_r($_POST); exit;
	$sql = "INSERT INTO `supplier`(`sup_fname`,`sup_lname`,`sup_email`,`sup_mobile`,`sup_add`,`sup_city`,`sup_state`) VALUES (?,?,?,?,?,?,?)";
	//print_r($sql); exit;
	$statement = $db->prepare($sql);
	$statement->bindparam(1, htmlspecialchars($_POST['fname']));
	$statement->bindparam(2, htmlspecialchars($_POST['lname']));
	$statement->bindparam(3, htmlspecialchars($_POST['email']));
	$statement->bindparam(4, htmlspecialchars($_POST['mobile']));
	$statement->bindparam(5, htmlspecialchars($_POST['address']));
	$statement->bindparam(6, htmlspecialchars($_POST['sup_city']));
	$statement->bindparam(7, htmlspecialchars($_POST['state']));
	$statement->execute();



	header("location:../managestock.php");
}

//insert crud end

//update crud for user form start
if (isset($_POST['update'])) {
	// print_r($sql); 
	$sql = "UPDATE supplier SET sup_fname = ?, sup_lname = ?,  sup_email = ?, sup_mobile = ?, sup_add = ?, sup_city = ?, sup_state = ? WHERE sup_id=? ";
	$stmt = $db->prepare($sql);
	$stmt->execute([$_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['mobile'], $_POST['address'], $_POST['sup_city'], $_POST['state'], $_POST['supid']]);


	header("location:../supplier.php");
}

//update crud end	

//delete for user form
if (isset($_GET['delid'])) {
	$stmt = $db->prepare("UPDATE supplier SET delete_status=1  Where sup_id=?");
	$stmt->execute([$_GET['delid']]);



	header("location:../supplier.php");
}
		
//delete end
