<link href="../../assets/css/popup_style.css" rel="stylesheet">
<?php
include '../../assets/constant/config.php';
session_start();
//insert crud for user form start
if (isset($_POST['btn_save'])) {
  // print_r($_POST); exit;
  $gst_rate =  htmlspecialchars($_POST['gst_rate']);
  $discount =  htmlspecialchars($_POST['discount']);
  $ino =  htmlspecialchars($_POST['invoice_no']);

  $final_total =  htmlspecialchars($_POST['final_total']);
  $cust =  htmlspecialchars($_POST['cust']);


  $sql = "INSERT INTO `sale`(`invoice_no`,`cust_id`,`amount`,`gst`,`discount`) VALUES (?,?,?,?,?)";

  $statement = $db->prepare($sql);

  $statement->bindparam(1, $ino);
  $statement->bindparam(2, $cust);
  $statement->bindparam(3, $final_total);
  $statement->bindparam(4, $gst_rate);
  $statement->bindparam(5, $discount);
  $statement->execute();

  // print_r($sql); exit;

  $last_id = $db->lastInsertId();


  $cnt = count($_POST['product_id']);
  extract($_POST);
  for ($i = 0; $i < $cnt; $i++) {


    //
    $sql = "SELECT * FROM product where i_id='" . $product_id[$i] . "'";
    $statement = $db->prepare($sql);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $quantitynew[$i] = $row['openning_stock'] - $quantity[$i];

    $product = htmlspecialchars($_POST['product_id'][$i]);
    $prize = htmlspecialchars($_POST['rate'][$i]);
    $qty = htmlspecialchars($_POST['quantity'][$i]);
    $total = htmlspecialchars($_POST['total'][$i]);
    $sql1 = "INSERT INTO `sale_item`(`sale_id`,`itemname`,`itemquantity`,`itemprice`,`total`) VALUES (?,?,?,?,?)";

    $statement1 = $db->prepare($sql1);

    $statement1->bindparam(1, $last_id);
    $statement1->bindparam(2, $product);
    $statement1->bindparam(3, $qty);
    $statement1->bindparam(4, $prize);
    $statement1->bindparam(5, $total);


    // print_r($sql); exit;
    $statement1->execute();

    $stmt1 = $db->prepare("UPDATE product SET openning_stock=:openning_stock  WHERE i_id=:id");
    $stmt1->bindParam(':openning_stock', $quantitynew[$i]);
    $stmt1->bindParam(':id', $product_id[$i]);
    $stmt1->execute();
    $stmt2 = $db->prepare("UPDATE sale_item SET itemquantity=:openning_stock  WHERE id=:id");
    $stmt2->bindParam(':openning_stock', $quantitynew[$i]);
    $stmt2->bindParam(':id', $product_id[$i]);
    $stmt2->execute();
  }

  $s = "delete from `sale_item` Where itemname='' ";
  $statement01 = $db->prepare($s);
  $statement01->execute();

  // print_r($stmt); exit;

  header("location:../sale-order.php");
}

?>

<?php
if (isset($_POST['update'])) {
  // print_r($_POST);
  $ino =    htmlspecialchars($_POST['ino']);
  // $sale_quantity =  htmlspecialchars($_POST['sale_quantity']);
  $amount =  htmlspecialchars($_POST['final_total']);
  $cust =  htmlspecialchars($_POST['cust']);
  // $product =  htmlspecialchars($_POST['product']);
  $soid =  htmlspecialchars($_POST['soid']);
  $gst_rate =  htmlspecialchars($_POST['gst_rate']);
  $discount =  htmlspecialchars($_POST['discount']);
  $sql = "UPDATE sale SET  invoice_no=?, amount = ?, cust_id = ?,gst=? ,discount=?WHERE saleid=? ";
  $stmt = $db->prepare($sql);

  $stmt->execute([$ino, $amount, $cust, $gst_rate, $discount, $soid]);


  $q1 = "DELETE FROM sale_item WHERE id='" . $soid . "' ";
  $stmt = $db->prepare($q1);
  $stmt->execute();

  $last_id = $soid;

  $cnt = count($_POST['product_id']);
  // print_r($cnt);exit;
  for ($i = 1; $i <= $cnt - 1; $i++) {

    $sql1 = "INSERT INTO `sale_item`(`sale_id`,`itemname`,`itemquantity`,`itemprice`,`total`) VALUES (?,?,?,?,?)";;
    $product = htmlspecialchars($_POST['product_id'][$i]);
    $prize = htmlspecialchars($_POST['rate'][$i]);
    $qty = htmlspecialchars($_POST['quantity'][$i]);
    $total = htmlspecialchars($_POST['total'][$i]);
    // print_r($sql1);exit;
    $statement1 = $db->prepare($sql1);
    $statement1->bindparam(1, $last_id);
    $statement1->bindparam(2, $product);
    $statement1->bindparam(3, $qty);
    $statement1->bindparam(4, $prize);
    $statement1->bindparam(5, $total);
    $statement1->execute();
  }
?>

  <div class="popup popup--icon -success js_success-popup popup--visible">
    <div class="popup__background"></div>
    <div class="popup__content">
      <h3 class="popup__content__title">
        Success
        </h1>
        <p>Updated Successfully</p>
        <p>

          <?php echo "<script>setTimeout(\"location.href = '../sale-order.php';\",1500);</script>"; ?>
        </p>
    </div>
  </div>

<?php
}





//delete for user form
if (isset($_GET['delid'])) {
  $stmt = $db->prepare("update `sale` SET delete_status='1'  Where saleid=?");

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

          <?php echo "<script>setTimeout(\"location.href = '../sale-order.php';\",1500);</script>"; ?>
        </p>
    </div>
  </div>
<?php
}
?>
<!-- delete end -->