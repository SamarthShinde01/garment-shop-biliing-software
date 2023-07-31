<?php
include '../../assets/constant/config.php';
session_start();
?>
<link href="../../assets/css/popup_style.css" rel="stylesheet">
<?php
//insert crud for user form start
if (isset($_POST['submit'])) {
	//print_r($_POST); exit;
	$sql = "INSERT INTO `product`(`i_name`,`i_prize`,`product_sprize`,`submitted_date`,`cate_id`) VALUES (?,?,?,?,?)";
	//print_r($sql); exit;
	$statement = $db->prepare($sql);
	$statement->bindparam(1, htmlspecialchars($_POST['pname']));
	$statement->bindparam(2, htmlspecialchars($_POST['pprize']));
	$statement->bindparam(3, htmlspecialchars($_POST['sprize']));
	$statement->bindparam(4, htmlspecialchars($_POST['submitted_date']));
	$statement->bindparam(5, htmlspecialchars($_POST['cate']));

	$statement->execute();



	// header("location:../product.php" ); 


?>
	<!-- popup for insert -->
	<div class="popup popup--icon -success js_success-popup popup--visible">
		<div class="popup__background"></div>
		<div class="popup__content">
			<h3 class="popup__content__title">
				Success
			</h3>
			<p>Insert Successfully</p>
			<p>

				<?php echo "<script>setTimeout(\"location.href = '../product.php';\",1500);</script>"; ?>
			</p>
		</div>
	</div>
<?php
}

//insert crud end

//update crud for user form start
if (isset($_POST['update'])) {
	// print_r($_POST); exit;
	// print_r($sql); 
	$sql = "UPDATE product SET i_name = ?, i_prize = ?,  product_sprize = ?, submitted_date = ?, cate_id = ? WHERE i_id=? ";
	$stmt = $db->prepare($sql);
	$stmt->execute([$_POST['pname'], $_POST['pprize'], $_POST['sprize'], $_POST['submitted_date'], $_POST['cate'], $_POST['id']]);

	// print_r($stmt); exit;
?>
	<!-- popup for update -->
	<div class="popup popup--icon -success js_success-popup popup--visible">
		<div class="popup__background"></div>
		<div class="popup__content">
			<h3 class="popup__content__title">
				Success
			</h3>
			<p>Update Successfully</p>
			<p>

				<?php echo "<script>setTimeout(\"location.href = '../product.php';\",1500);</script>"; ?>
			</p>
		</div>
	</div>
<?php
}

//update crud end	

//delete for user form
if (isset($_GET['delid'])) {
	$stmt = $db->prepare("UPDATE product SET delete_status=1  Where i_id=?");
	$stmt->execute([$_GET['delid']]);


?>
	<!-- popup for delete -->
	<div class="popup popup--icon -success js_success-popup popup--visible">
		<div class="popup__background"></div>
		<div class="popup__content">
			<h3 class="popup__content__title">
				Success
			</h3>
			<p>Delete Successfully</p>
			<p>

				<?php echo "<script>setTimeout(\"location.href = '../product.php';\",1500);</script>"; ?>
			</p>
		</div>
	</div>
<?php
}
		
//delete end
