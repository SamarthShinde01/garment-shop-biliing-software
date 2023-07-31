<?php
include '../../assets/constant/config.php';
session_start();
?>
<!-- //insert crud for category form start -->
<link href="../../assets/css/popup_style.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="assets/css/popup_style.css">  -->
<?php
if (isset($_POST['submit'])) {
  //image uploading end

  // print_r($img); exit;
  $sql = "INSERT INTO `category`(`cate_name`) VALUES (?)";
  //print_r($sql); exit;
  $statement = $db->prepare($sql);
  $statement->bindparam(1, ($_POST['catename']));
  $statement->execute();



  // header("location:../category.php" ); 
?>
  <div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Success
        </h1>
        <p>Inserted Successfully</p>
        <p>

          <?php echo "<script>setTimeout(\"location.href = '../category.php';\",1500);</script>"; ?>
        </p>
    </div>
  </div>
<?php
}

//insert crud end

//update crud for Category form start
if (isset($_POST['update'])) {
  // print_r($sql); 
  // print_r($_POST); exit;
  $sql = "UPDATE category SET cate_name = ? WHERE cate_id=? ";
  $stmt = $db->prepare($sql);
  $stmt->execute([$_POST['catename'], $img, $_POST['cateid']]);
  // print_r($stmt); exit();	
?>
  <!-- popup for Update -->
  <div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Success
        </h1>
        <p>Update Successfully</p>
        <p>

          <?php echo "<script>setTimeout(\"location.href = '../category.php';\",1500);</script>"; ?>
        </p>
    </div>
  </div>
<?php
}
//update crud end	

//delete for user form
if (isset($_GET['delid'])) {
  $stmt = $db->prepare("UPDATE category SET delete_status=1  Where cate_id=?");
  $stmt->execute([$_GET['delid']]);

?>
  <!-- popup for delete -->
  <div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Success
        </h1>
        <p>Delete Successfully</p>
        <p>

          <?php echo "<script>setTimeout(\"location.href = '../category.php';\",1500);</script>"; ?>
        </p>
    </div>
  </div>
<?php
}
?>