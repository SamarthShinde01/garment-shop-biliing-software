<?php
include '../../assets/constant/config.php';

session_start();
?>
<link href="../../assets/css/popup_style.css" rel="stylesheet">
<?php
//insert crud for user form start
if (isset($_POST['submit'])) {
  //print_r($_POST); exit;
  $sql = "INSERT INTO `customer`(`cust_fname`,`cust_lname`,`cust_email`,`cust_mobile`,`cust_add`,`cdate`,`cust_city`,`cust_state`) VALUES (?,?,?,?,?,?,?,?)";
  //print_r($sql); exit;
  $statement = $db->prepare($sql);
  $statement->bindparam(1, ($_POST['fname']));
  $statement->bindparam(2, ($_POST['lname']));
  $statement->bindparam(3, ($_POST['email']));
  $statement->bindparam(4, ($_POST['mobile']));
  $statement->bindparam(5, ($_POST['address']));
  $statement->bindparam(6, ($_POST['cdate']));
  $statement->bindparam(7, ($_POST['cust_city']));
  $statement->bindparam(8, ($_POST['state']));
  $statement->execute();



  // header("location:../customer.php" ); 
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

        <?php echo "<script>setTimeout(\"location.href = '../customer.php';\",1500);</script>"; ?>
      </p>
    </div>
  </div>
<?php
}

//insert crud end

if (isset($_POST['submit2'])) {
  //print_r($_POST); exit;
  $sql = "INSERT INTO `customer`(`cust_fname`,`cust_lname`,`cust_email`,`cust_mobile`,`cust_add`,`cdate`,`cust_city`,`cust_state`) VALUES (?,?,?,?,?,?,?,?)";
  //print_r($sql); exit;
  $statement = $db->prepare($sql);
  $statement->bindparam(1, ($_POST['fname']));
  $statement->bindparam(2, ($_POST['lname']));
  $statement->bindparam(3, ($_POST['email']));
  $statement->bindparam(4, ($_POST['mobile']));
  $statement->bindparam(5, ($_POST['address']));
  $statement->bindparam(6, ($_POST['cdate']));
  $statement->bindparam(7, ($_POST['cust_city']));
  $statement->bindparam(8, ($_POST['state']));
  $statement->execute();



  // header("location:../customer.php" ); 
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

        <?php echo "<script>setTimeout(\"location.href = '../sale-order.php';\",1500);</script>"; ?>
      </p>
    </div>
  </div>
<?php
}

//update crud for user form start
if (isset($_POST['update'])) {
  // print_r($sql); 
  $sql = "UPDATE customer SET cust_fname = ?, cust_lname = ?,  cust_email = ?, cust_mobile = ?, cust_add = ?,cdate = ?, cust_city = ?, cust_state = ? WHERE cust_id=? ";
  $stmt = $db->prepare($sql);
  $stmt->execute([$_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['mobile'], $_POST['address'], $_POST['cdob'], $_POST['cust_city'], $_POST['state'], $_POST['cid']]);

  print_r($stmt);
?>

  <!-- popup for update -->
  <div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Success
        </h1>
        <p>Update Successfully</p>
        <p>

          <?php echo "<script>setTimeout(\"location.href = '../customer.php';\",1500);</script>"; ?>
        </p>
    </div>
  </div>
<?php
}

//update crud end	

//delete for user form
if (isset($_GET['delid'])) {
  $stmt = $db->prepare("UPDATE customer SET delete_status=1  Where cust_id=?");
  $stmt->execute([$_GET['delid']]);


?>

  <!-- popup for Delete  -->
  <div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Success
        </h1>
        <p>Delete Successfully</p>
        <p>

          <?php echo "<script>setTimeout(\"location.href = '../customer.php';\",1500);</script>"; ?>
        </p>
    </div>
  </div>
<?php
}


//delete end

?>