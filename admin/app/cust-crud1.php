<?php
include '../../assets/constant/config.php';

session_start();
?>
<link href="../../assets/css/popup_style.css" rel="stylesheet">
<?php
//insert crud for user form start
if (isset($_POST['submit1'])) {

  $state = implode(',', $_POST['state']);
  // print_r($state); exit;

  $sql = "INSERT INTO `customer1`(`fname`,`lname`,`state`) VALUES (?,?,?)";
  //print_r($sql); exit;
  $statement = $db->prepare($sql);
  $statement->bindparam(1, ($_POST['fname']));
  $statement->bindparam(2, ($_POST['lname']));
  $statement->bindparam(3, ($state));

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

<?php
// for auto select

if (isset($_POST['cust_id']) && !empty($_POST['cust_id'])) {
  $result = array();
  $id = htmlspecialchars($_POST['cust_id']);
  $stmt = $db->prepare("SELECT * FROM customer WHERE cust_id=?");
  $stmt->execute([$id]);
  //echo print_r($stmt);exit;
  $display1 = $stmt->fetchAll();




  $result['display1'] = $display1;


  echo json_encode($result);
}
?>