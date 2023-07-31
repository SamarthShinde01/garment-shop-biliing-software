<?php
// error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>


<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<div class="content-body mb-5 p-3">
    <div class="row">
        <div class="col-md-12">
            <div class="heading mb-4 d-flex align-items-center justify-content-between">
                <h3 class="mb-0">Sale Report</h3>
                <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Sale report </span></p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">

                    <div class="card-body">

                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" name="from_date" value="<?php if (isset($_POST['from_date'])) {
                                                                                        echo $_POST['from_date'];
                                                                                    } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" name="to_date" value="<?php if (isset($_POST['to_date'])) {
                                                                                        echo $_POST['to_date'];
                                                                                    } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Click to Filter</label> <br>
                                        <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <div class="mt-5 table-responsive">
                                    <table id="example" class="display table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>PO No.</th>
                                                <th>Invoice No.</th>
                                                <th>Supplier</th>
                                                <th>Item</th>
                                                <th>Prize</th>
                                                <th>Units</th>
                                                <th>Amount</th>

                                                <th>Purchase Date</th>
                                                <!--  <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $cnt = 1;
                                            if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
                                                // code...
                                                $from_date = $_POST['from_date'];
                                                $to_date = $_POST['to_date'];
                                                // echo $from_date;
                                                // echo $to_date;


                                                //where food.edate < DATE(now()
                                                $stmt = $db->prepare("select * from sale  where sale_date between '$from_date' AND '$to_date' ");
                                                $stmt->execute();
                                                $record = $stmt->fetchAll();
                                                $i = 1;
                                                foreach ($record as $row) {
                                                    $r = $row['saleid'];
                                                    // print_r($r);

                                                    $w = $row['cust_id'];
                                                    // print_r($w);


                                                    $stmt2 = $db->prepare("select * from customer  where cust_id= $w ");
                                                    $stmt2->execute();
                                                    $record2 = $stmt2->fetchAll();
                                                    $i = 1;
                                                    foreach ($record2 as $row2) {

                                                        // print_r($w);



                                            ?>


                                                        <tr>
                                                            <td><?php echo $cnt; ?></td>
                                                            <td><?php echo $row['invoice_no']; ?></td>
                                                            <td>

                                                                <?php echo $row2['cust_fname'] . ' ' . $row2['cust_lname']; ?> </td>

                                                            <td>
                                                                <?php $stmt1 = $db->prepare("select * from sale_item WHERE sale_id='" . $r . "' ");
                                                                $stmt1->execute();
                                                                $record1 = $stmt1->fetchAll();
                                                                $i = 1;
                                                                foreach ($record1 as $row1) {
                                                                    $d = $row1['itemname'];
                                                                    $stmt3 = $db->prepare("select * from product  where i_id= '" . $d . "' ");
                                                                    $stmt3->execute();
                                                                    $record3 = $stmt3->fetchAll();
                                                                    $i = 1;
                                                                    foreach ($record3 as $row3) {
                                                                        echo $row3['i_name'];
                                                                        echo '</br>';
                                                                    }
                                                                } ?>

                                                            </td>
                                                            <td><?php $stmt1 = $db->prepare("select * from sale_item WHERE sale_id='" . $r . "' ");
                                                                $stmt1->execute();
                                                                $record1 = $stmt1->fetchAll();
                                                                $i = 1;
                                                                foreach ($record1 as $row1) {
                                                                    echo $row1['itemprice'];
                                                                    echo '</br>';
                                                                } ?></td>
                                                            <td><?php $stmt1 = $db->prepare("select * from sale_item WHERE sale_id='" . $r . "' ");
                                                                $stmt1->execute();
                                                                $record1 = $stmt1->fetchAll();
                                                                $i = 1;
                                                                foreach ($record1 as $row1) {
                                                                    echo $row1['itemquantity'];
                                                                    echo '</br>';
                                                                } ?></td>
                                                            <td><?php echo $row['amount']; ?></td>

                                                            <td><?php echo $row['sale_date']; ?></td>


                                                            <!-- <td>  
                          <a href="print-purchase-order.php?poid=<?php echo $row['saleid']; ?>"class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i></a>                  
                    </td> -->
                                                        </tr>
                                            <?php
                                                        $cnt = $cnt + 1;
                                                    }
                                                }
                                            } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('include/footer.php'); ?>