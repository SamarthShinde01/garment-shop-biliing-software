<?php

include '../../assets/constant/config.php';
session_start();
?>
<link href="../../assets/css/popup_style.css" rel="stylesheet">
<?php

//login crud for admin form start
if (isset($_POST['submit'])) {
	if (isset($_POST['g-recaptcha-response'])) {
		//echo print_r($_POST);exit;

		$secretekey = "6LdJC4AeAAAAAMLn9tfGX8_BoZGIwLHgBNiiYgxb";
		$ip = $_SERVER['REMOTE_ADDR'];
		//echo $ip;exit;
		$response = $_POST['g-recaptcha-response'];
		//echo $response;exit;
		//https:www.google.com/recaptcha/api/siteverify METHOD: POST
		$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretekey&response=$response&remoteip=$ip";
		//echo $url;exit;
		$fire = file_get_contents($url);
		//echo $fire;exit;
		// data convert to object 
		$data = json_decode($fire);
		//echo print_r($data);exit;
		if ($data->success == true) {

			$passw = hash('sha256', $_POST['password']);
			function createSalt()
			{
				return '2123293dsj2hu2nikhiljdsd';
			}
			$salt = createSalt();
			$password1 = hash('sha256', $salt . $passw);



			$stmt = $db->prepare("select * from admin WHERE admin_email=? AND admin_password=? ");
			$stmt->execute([$_POST['email'], $password1]);
			$record = $stmt->fetchAll();
			$i = 1;
			$cnt = count($record);
			// echo $cnt;
			if ($cnt > 0) {

				foreach ($record as $key) {

					//print_r($key);exit();  
					$_SESSION['id'] = $key['admin_id'];

					$_SESSION['email'] = $key['admin_email'];
					$_SESSION['password'] = $key['admin_password'];
				}


				//                              	echo "<script>alert('Login Successfully');</script>";
				// echo "<script type='text/javascript'> document.location ='../dashboard.php'; </script>";
?>
				<div class="popup popup--icon -success js_success-popup popup--visible">
					<div class="popup__background"></div>
					<div class="popup__content">
						<h3 class="popup__content__title">
							Success
						</h3>
						<p>Login Successfully</p>
						<p>

							<?php echo "<script>setTimeout(\"location.href = '../dashboard.php';\",1500);</script>"; ?>
						</p>
					</div>
				</div>
			<?php  } else {


				// echo "<script>alert('Email Or Password you entered is Wrong');</script>";
				//  echo "<script type='text/javascript'> document.location ='../../index.php'; </script>";
			?>
				<!-- popup starts -->

				<div class="popup popup--icon -error js_error-popup popup--visible">
					<div class="popup__background"></div>
					<div class="popup__content">
						<h3 class="popup__content__title">
							Error
						</h3>
						<p></p>
						<p>
							<!-- <button class="button button--error" data-for="js_error-popup">Close</button> -->
							<?php echo "<script>setTimeout(\"location.href = '../../index.php';\",1500);</script>"; ?>
						</p>
					</div>
				</div>

			<?php  }
		} else { ?>

			<!-- popup start -->

			<div class="popup popup--icon -error js_error-popup popup--visible">
				<div class="popup__background"></div>
				<div class="popup__content">
					<h3 class="popup__content__title">
						Error
					</h3>
					<p></p>
					<p>
						<!-- <button class="button button--error" data-for="js_error-popup">Close</button> -->
						<?php echo "<script>setTimeout(\"location.href = '../../index.php';\",1500);</script>"; ?>
					</p>
				</div>
			</div>

		<?php }
	}
}

//login crud for admin form end

//login crud for varify otp form start

if (isset($_POST['submit3'])) {
	$otp1 = $_POST['otp'];

	$stmt = $db->prepare("SELECT * FROM admin");
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach ($result as $key) {
		$otp2 = $key['otp'];
	}
	// echo $otp1; exit;
	// echo "<br>";
	// echo $otp2; exit;

	if ($otp1 == $otp2) {
		?>
		<!-- echo "<script>alert('Varify Successfully');</script>";
		 				 echo "<script type='text/javascript'> document.location ='../nepass.php'; </script>"; -->
		<!-- popup start -->
		<div class="popup popup--icon -success js_success-popup popup--visible">
			<div class="popup__background"></div>
			<div class="popup__content">
				<h3 class="popup__content__title">
					Success
				</h3>
				<p>Varify Successfully</p>
				<p>

					<?php echo "<script>setTimeout(\"location.href = '../nepass.php';\",1500);</script>"; ?>
				</p>
			</div>
		</div>
	<?php
	} else { ?>


		<!-- echo "<script>alert('Please Enter valid OTP');</script>";
						 echo "<script type='text/javascript'> document.location ='../getotp.php'; </script>"; -->
		<!-- popup start -->
		<div class="popup popup--icon -error js_error-popup popup--visible">
			<div class="popup__background"></div>
			<div class="popup__content">
				<h3 class="popup__content__title">
					Error
				</h3>
				<p></p>
				<p>
					<!-- <button class="button button--error" data-for="js_error-popup">Close</button> -->
					<?php echo "<script>setTimeout(\"location.href = '../getotp.php';\",1500);</script>"; ?>
				</p>
			</div>
		</div>
	<?php
	}
}

//login crud for varify otp form end

//login crud for varify otp crud form start

if (isset($_POST['update'])) {

	// encrypt new password
	$passw1 = hash('sha256', $_POST['pass1']);
	function createSalt4()
	{
		return '2123293dsj2hu2nikhiljdsd';
	}
	$salt = createSalt4();
	$password_new = hash('sha256', $salt . $passw1);

	// new password encrypt as $password_new

	// encrypt confirm password
	$passw2 = hash('sha256', $_POST['pass2']);
	function createSalt5()
	{
		return '2123293dsj2hu2nikhiljdsd';
	}
	$salt = createSalt5();
	$password_conf = hash('sha256', $salt . $passw2);

	// confirm password encrypt as $password_conf

	echo $password_conf;

	if ($password_new == $password_conf) {
		// foreach ($record as $key) {
		echo '<script>alert("Password Updated Successfully!!!!")</script>';
		$stmt2 = $db->prepare("UPDATE admin SET `admin_password`='$password_new'");
		$stmt2->execute();

	?>
		<!--  // echo '<script>alert("Password Updated Successfully!!!!")</script>';
                       //  header("location:../../index.php"); -->
		<div class="popup popup--icon -success js_success-popup popup--visible">
			<div class="popup__background"></div>
			<div class="popup__content">
				<h3 class="popup__content__title">
					Success
				</h3>
				<p>Password Updated Successfully</p>
				<p>

					<?php echo "<script>setTimeout(\"location.href = '../../index.php';\",1500);</script>"; ?>
				</p>
			</div>
		</div>
	<?php


	} else {
		// echo '<script>alert("Password Not Match")</script>';
		//                                header("location:../nepass.php");
	?>
		<div class="popup popup--icon -error js_error-popup popup--visible">
			<div class="popup__background"></div>
			<div class="popup__content">
				<h3 class="popup__content__title">
					Error
				</h3>
				<p></p>
				<p>
					<!-- <button class="button button--error" data-for="js_error-popup">Close</button> -->
					<?php echo "<script>setTimeout(\"location.href = '../nepass.php';\",1500);</script>"; ?>
				</p>
			</div>
		</div>
<?php
	}
}
