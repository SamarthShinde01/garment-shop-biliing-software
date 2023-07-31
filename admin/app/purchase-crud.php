<?php
include '../../assets/constant/config.php';
session_start();
//insert crud for user form start
if (isset($_POST['btn_save'])) {
  // print_r($_POST); exit;
  // $sql = "INSERT INTO `sale`(`invoice_no`,`prize`,`sale_quantity`,`amount`,`cust_id`, `i_id`) VALUES (?,?,?,?,?,?)";


  $sql = "INSERT INTO `purchace_order`(`invoice_no`,`sup_id`,`amount`) VALUES (?,?,?)";

  $statement = $db->prepare($sql);

  $statement->bindparam(1, htmlspecialchars($_POST['invoice_no']));
  // $statement->bindparam(2, htmlspecialchars($_POST['prize']));
  // $statement->bindparam(3, htmlspecialchars($_POST['sale_quantity']));

  $statement->bindparam(2, htmlspecialchars($_POST['purchase']));
  $statement->bindparam(3, htmlspecialchars($_POST['final_total']));
  // $statement->bindparam(6, htmlspecialchars($_POST['product']));
  // print_r($sql); exit;
  $statement->execute();

  // print_r($sql); exit;

  $last_id = $db->lastInsertId();

  $cnt = count($_POST['product_id']);
  for ($i = 0; $i < $cnt; $i++) {
    $product = htmlspecialchars($_POST['product_id'][$i]);
    $prize = htmlspecialchars($_POST['rate'][$i]);
    $qty = htmlspecialchars($_POST['quantity'][$i]);
    $total = htmlspecialchars($_POST['total'][$i]);
    $sql1 = "INSERT INTO `purchase_item`(`sid`,`itemname`,`itemquantity`,`itemprice`,`total`) VALUES (?,?,?,?,?)";

    $statement1 = $db->prepare($sql1);

    $statement1->bindparam(1, $last_id);
    $statement1->bindparam(2, $product);
    $statement1->bindparam(3, $qty);
    $statement1->bindparam(4, $prize);
    $statement1->bindparam(5, $total);


    // print_r($sql); exit;
    $statement1->execute();
  }

  $s = "delete from `sale_item` Where itemname='' ";
  $statement01 = $db->prepare($s);
  $statement01->execute();

  // print_r($stmt); exit;

  header("location:../purchase-order.php");
}




//insert crud end

//update crud for user form start
if (isset($_POST['update'])) {
  $sql = "UPDATE purchace_order SET invoice_no = ?,item_name = ?,prize= ?,quantity = ?,amount= ? , purchase_date= ? ,sup_id= ? WHERE porder_id=? ";
  $stmt = $db->prepare($sql);
  // print_r($sql);
  $stmt->execute([$_POST['ino'], $_POST['item'], $_POST['prize'], $_POST['quantity'], $_POST['amount'], $_POST['pdate'], $_POST['sup'], $_POST['poid']]);
  // print_r($sql); exit;

  header("location: ../purchase-order.php");
}

//update crud end	



//delete for user form
if (isset($_GET['delid'])) {
  $stmt = $db->prepare("UPDATE purchace_order SET delete_status=1  Where porder_id =?");
  $stmt->execute([$_GET['delid']]);


  header("location:../purchase-order.php");
}
		
//delete end
