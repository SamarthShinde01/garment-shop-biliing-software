<?php
include '../../assets/constant/config.php';
session_start();
//insert crud for user form start
if (isset($_POST['submit'])) {
    // print_r($_POST); exit;
    $sql = "INSERT INTO `sale`(`invoiceno`,`saledate`,`cust_mobile`,`hardwareno`,`deliverydate`,`paymenttype`,`custname`,`sercharges`,`amtotal`,`paymentstatus`,`checkid`,`serid`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

    $statement = $db->prepare($sql);
    $statement->bindparam(1, htmlspecialchars($_POST['invoiceno']));
    $statement->bindparam(2, htmlspecialchars($_POST['saledate']));
    $statement->bindparam(3, htmlspecialchars($_POST['cust_mobile']));
    $statement->bindparam(4, htmlspecialchars($_POST['hardwareno']));
    $statement->bindparam(5, htmlspecialchars($_POST['deliverydate']));
    $statement->bindparam(6, htmlspecialchars($_POST['paymenttype']));
    $statement->bindparam(7, htmlspecialchars($_POST['custname']));
    $statement->bindparam(8, htmlspecialchars($_POST['sercharges']));
    $statement->bindparam(9, htmlspecialchars($_POST['amtotal']));
    $statement->bindparam(10, htmlspecialchars($_POST['paymentstatus']));
    $statement->bindparam(11, htmlspecialchars($_POST['identino']));
    $statement->bindparam(12, htmlspecialchars($_POST['sername']));
    // print_r($sql); exit;
    $statement->execute();

    header("location:../sale-manage.php");

    $last_id = $db->lastInsertId();
    $cnt = count($_POST['itemname']);
    for ($i = 0; $i < $cnt; $i++) {

        $sql1 = "INSERT INTO `sale_item`(`sale_id`,`itemname`,`itemquantity`,`itemprice`,`total`) VALUES (?,?,?,?,?)";

        $statement1 = $db->prepare($sql1);

        $statement1->bindparam(1, htmlspecialchars($last_id));
        $statement1->bindparam(2, htmlspecialchars($_POST['itemname'][$i]));
        $statement1->bindparam(3, htmlspecialchars($_POST['itemquantity'][$i]));
        $statement1->bindparam(4, htmlspecialchars($_POST['itemprice'][$i]));
        $statement1->bindparam(5, htmlspecialchars($_POST['total'][$i]));

        // print_r($sql); exit;
        $statement1->execute();
    }

    // print_r($stmt); exit;

    header("location:../sale-manage.php");
}

//insert crud end

//update crud for user form start
if (isset($_POST['update'])) {
    $invoiceno = htmlspecialchars($_POST['invoiceno']);
    $saledate = htmlspecialchars($_POST['saledate']);
    $cust_mobile = htmlspecialchars($_POST['cust_mobile']);
    $hardwareno = htmlspecialchars($_POST['hardwareno']);
    $deliverydate = htmlspecialchars($_POST['deliverydate']);
    $price = htmlspecialchars($_POST['price']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $total = htmlspecialchars($_POST['total']);
    $paymenttype = htmlspecialchars($_POST['paymenttype']);
    $custname = htmlspecialchars($_POST['custname']);
    $sercharges = htmlspecialchars($_POST['sercharges']);
    $paymentstatus = htmlspecialchars($_POST['paymentstatus']);
    $itemid = htmlspecialchars($_POST['itemid']);
    $checkid = htmlspecialchars($_POST['checkid']);
    $serid = htmlspecialchars($_POST['serid']);
    $saleid = htmlspecialchars($_POST['saleid']);

    $sql = "UPDATE sale SET invoiceno = ?,saledate = ?,cust_mobile = ?,hardwareno= ?,deliverydate = ?,price = ?,quantity = ?,total = ?,paymenttype = ?,custname= ?,sercharges= ?, paymentstatus= ?, itemid= ? ,checkid = ?,serid = ? WHERE saleid=? ";
    $stmt = $db->prepare($sql);

    $stmt->execute([$invoiceno, $saledate, $cust_mobile, $hardwareno, $deliverydate, $price, $quantity, $total, $paymenttype, $custname, $sercharges, $paymentstatus, $itemname, $identino, $sername, $saleid]);

    // print_r($stmt); exit;
    header("location: ../sale-manage.php");
}

//update crud end

//delete for user form
if (isset($_GET['delid'])) {
    // $stmt = $db->prepare("DELETE FROM  `sale`  Where saleid=?"); 
    $stmt = $db->prepare("update sale SET delete_status='1' Where saleid=?");

    $stmt->execute([$_GET['delid']]);


    header("location:../sale-manage.php");
}

//delete end


if (isset($_POST['itemid']) && !empty($_POST['itemid'])) {
    $result = array();
    $id = htmlspecialchars($_POST['itemid']);
    $stmt = $db->prepare("SELECT * FROM item WHERE itemid=?");
    $stmt->execute([$id]);
    //echo print_r($stmt);exit;
    $display1 = $stmt->fetchAll();
    $result['display1'] = $display1;
    echo json_encode($result);
}
?>


<?php
if (isset($_POST['serid']) && !empty($_POST['serid'])) {
    $result = array();
    $id = htmlspecialchars($_POST['serid']);
    $stmt = $db->prepare("SELECT * FROM service WHERE serid=?");
    $stmt->execute([$id]);
    //echo print_r($stmt);exit;
    $display1 = $stmt->fetchAll();
    $result['display1'] = $display1;
    echo json_encode($result);
}

?>  


<?php
if (isset($_POST['checkid']) && !empty($_POST['checkid'])) {
    $result = array();
    $id = htmlspecialchars($_POST['checkid']);
    $stmt = $db->prepare("SELECT * FROM checkin WHERE checkid=?");
    $stmt->execute([$id]);
    //echo print_r($stmt);exit;
    $display1 = $stmt->fetchAll();
    foreach ($display1 as $dis) {
        $customer = $dis['cust_id'];
    }
    $stmt2 = $db->prepare("SELECT * FROM customer WHERE cust_id=?");
    $stmt2->execute([$customer]);
    //echo print_r($stmt2);exit;
    $display2 = $stmt2->fetchAll();

    $stmt3 = $db->prepare("SELECT * FROM customer WHERE cust_id=?");
    $stmt3->execute([$customer]);
    //echo print_r($stmt2);exit;
    $display3 = $stmt3->fetchAll();

    //echo print_r($display1);exit;
    //$result['display']=$display;


    $result['display1'] = $display1;

    $result['display2'] = $display2;

    $result['display3'] = $display3;
    echo json_encode($result);
}
?>    
<?php
if (isset($_POST['submit'])) {
    if (!empty($_POST['Fruit'])) {
        $selected = $_POST['Fruit'];
        echo 'You have chosen: ' . $selected;
    } else {
        echo 'Please select the value.';
    }
}
?>

<?php
if (isset($_POST['drop_services']) && !empty($_POST['drop_services'])) {
    $result = array();
    $id = htmlspecialchars($_POST['drop_services']);
    $stmt = $db->prepare("SELECT * FROM item WHERE itemid=?");
    $stmt->execute([$id]);
    //echo print_r($stmt);exit;
    $display1 = $stmt->fetchAll();
    $result['display1'] = $display1;
    echo json_encode($result);
    exit;
}

?>  