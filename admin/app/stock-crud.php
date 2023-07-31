<?php
include '../../assets/constant/config.php';
session_start();
?>
<link href="../../assets/css/popup_style.css" rel="stylesheet">
<!-- insert crud for sale order form start -->
<?php
if (isset($_POST['submit'])) {
  //print_r($_POST); exit;
  $sql = "INSERT INTO `stock`(`build_date`,`sub_total`,`gst`,`discount`,`final_total`,`sup_id`) VALUES (?,?,?,?,?,?)";
  // $ino =  htmlspecialchars($_POST['ino']);
  $build_date =  htmlspecialchars($_POST['build_date']);
  $subtotal =  htmlspecialchars($_POST['subtotal']);
  $gst_rate =  htmlspecialchars($_POST['gst_rate']);
  $discount =  htmlspecialchars($_POST['discount']);
  $final_total =  htmlspecialchars($_POST['final_total']);
  $sup =  htmlspecialchars($_POST['sup']);
  $statement = $db->prepare($sql);

  // $statement->bindparam(1, $ino);
  $statement->bindparam(1, $build_date);
  $statement->bindparam(2, $subtotal);
  $statement->bindparam(3, $gst_rate);
  $statement->bindparam(4, $discount);
  $statement->bindparam(5, $final_total);
  $statement->bindparam(6, $sup);

  $statement->execute();

  $last_id = $db->lastInsertId();

  $cnt = count($_POST['product_id']);
  // print_r($cnt);exit;
  for ($i = 0; $i <= $cnt - 1; $i++) {
    extract($_POST);
    $quantitynew[$i] = $quantity[$i] + $aquantity[$i];
    $sql1 = "INSERT INTO `stock_items`(`stock_id`,`quantity`,`purchce_quantity`,`rate`,`total`,`i_id`) VALUES (?,?,?,?,?,?)";


    $aquantity = htmlspecialchars($_POST['aquantity'][$i]);
    $sale_quantity = htmlspecialchars($_POST['quantity'][$i]);
    $rate = htmlspecialchars($_POST['rate'][$i]);
    $total = htmlspecialchars($_POST['total'][$i]);
    $product = htmlspecialchars($_POST['product_id'][$i]);
    // print_r($sql1);exit;
    $statement1 = $db->prepare($sql1);
    $statement1->bindparam(1, $last_id);
    $statement1->bindparam(2, $aquantity);
    $statement1->bindparam(3, $sale_quantity);
    $statement1->bindparam(4, $rate);
    $statement1->bindparam(5, $total);
    $statement1->bindparam(6, $product);




    // print_r($sql); exit;
    $statement1->execute();
    // print_r($statement1);exit;
    //     $sql1="UPDATE product SET openning_stock = ? WHERE product_id=? ";	
    // 	$stmt1 = $db->prepare($sql1);
    // $stmt1->execute([$fname, $lname, $email, $mobile, $address, $sup_city, $state, $supid]);


    $stmt1 = $db->prepare("UPDATE product SET openning_stock=:openning_stock  WHERE i_id=:id");
    $stmt1->bindParam(':openning_stock', $quantitynew[$i]);
    $stmt1->bindParam(':id', $product_id[$i]);
    $stmt1->execute();
    $stmt2 = $db->prepare("UPDATE stock_items SET quantity=:openning_stock  WHERE i_id=:id");
    $stmt2->bindParam(':openning_stock', $quantitynew[$i]);
    $stmt2->bindParam(':id', $product_id[$i]);
    $stmt2->execute();
  }
?>

  <div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Success
        </h1>
        <p>Inserted Successfully</p>
        <p>

          <?php echo "<script>setTimeout(\"location.href = '../managestock.php';\",1500);</script>"; ?>
        </p>
    </div>
  </div>

<?php
}


//insert crud end

//delete for user form
if (isset($_GET['delid'])) {
  $stmt = $db->prepare("update stock SET delete_status='1' where stock_id=?");

  $stmt->execute([$_GET['delid']]);

?>
  <!-- popup for delete -->
  <div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Success
        </h1>
        <p>Deleted Successfully</p>
        <p>

          <?php echo "<script>setTimeout(\"location.href = '../managestock.php';\",1500);</script>"; ?>
        </p>
    </div>
  </div>
<?php
}
?>
<!-- delete end -->