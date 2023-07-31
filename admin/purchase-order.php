<?php


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
                <h3 class="mb-0">Purchase Order Details </h3>
                <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage </span></p>
            </div>
        </div>
    </div>
    <div class="card-header">
        <a href="add_purchase_order.php"><button class="btn btn-primary" type="submit" name=""> Add Order </button></a>
    </div>




    <!-- Manage order details -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th>Purchase Order No.</th>
                                    <th>Supplier</th>
                                    <th>Contact</th>
                                    <th>Item</th>
                                    <th>Sale Prize</th>
                                    <th>Qunatity</th>
                                    <th>Amount</th>
                                    <th>Purchase Date</th>
                                    <!-- <th>Purchase Date</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                $cnt = 1;
                                $stmt = $db->prepare("SELECT * from purchace_order INNER JOIN supplier ON purchace_order.sup_id=supplier.sup_id where purchace_order.delete_status='0'");
                                $stmt->execute();
                                $record = $stmt->fetchAll();
                                $i = 1;
                                foreach ($record as $row) {
                                ?>
                                    <!--Fetch the Records -->
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['invoice_no']; ?></td>
                                        <td><?php echo $row['sup_fname'] . ' ' . $row['sup_lname']; ?></td>
                                        <td><?php echo $row['sup_mobile']; ?></td>
                                        <td><?php echo $row['item_name']; ?></td>
                                        <td><?php echo $row['prize']; ?></td>
                                        <td><?php echo $row['quantity']; ?></td>
                                        <td><?php echo $row['amount']; ?></td>
                                        <td><?php echo $row['purchase_date']; ?></td>
                                        <td>
                                            <!-- <a href="purchase-bill.php?poid=<?php echo $row['invoice_no']; ?>"class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i></a> -->
                                            <a href="edit-purchase-order.php?poid=<?php echo $row['porder_id']; ?>" class="btn btn-primary btn-sm "><i class="icon-line-awesome-edit fs-5"></i></a>
                                            <a href="app/purchase-crud.php?delid=<?php echo $row['porder_id']; ?>" class="btn btn-danger btn-sm " onclick="return confirm('Do you really want to Delete ?');"><i class="icon-line-awesome-trash-o fs-5"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $cnt = $cnt + 1;
                                }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>