<?php


session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<?php

$stmt = $db->prepare("SELECT * from purchace_order WHERE porder_id = ?");
$stmt->execute([$_GET['poid']]);
$result = $stmt->fetchAll();
foreach ($result as $key) {
    // code...

?>
    <div class="content-body mb-5 p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="heading mb-4 d-flex align-items-center justify-content-between">
                    <h3 class="mb-0">Edit Purchase order Details </h3>
                    <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage </span></p>
                </div>
            </div>
        </div>
        <section>
            <div class="container">

                <!-- Edit purchase order details form -->
                <form class="row" method="POST" action="app/purchase-crud.php" id="order_form">
                    <input type="hidden" class="form-control" name="poid" value="<?php echo $key['porder_id']; ?>">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Invoice Number</label>
                        <input type="text" class="form-control" name="ino" value="<?php echo $key['invoice_no']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Select Supplier</label>
                        <?php
                        $cnt = 1;

                        $stmt = $db->prepare("select * from supplier");
                        $stmt->execute();
                        $record = $stmt->fetchAll();
                        $i = 1; ?>

                        <select class="form-select" aria-label="Default select example" type="text" name="sup">
                            <option></option>
                            <?php foreach ($record as $row) { ?>
                                <option <?php if ($key['sup_id'] == $row['sup_id']) {
                                            echo 'selected';
                                        } ?> value="<?php echo $row['sup_id'] ?>">
                                    <?php echo $row['sup_fname'] . ' ' . $row['sup_lname']; ?>
                                </option>
                            <?php }; ?>
                        </select>
                    </div>
                    <!-- <div class="mb-3 col-md-6">
                        <label class="form-label">Item</label>
                        <input type="text" class="form-control" name="item" value="<?php echo $key['item_name']; ?>">
                    </div> -->

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Item</label>
                        <?php
                        $cnt = 1;

                        $stmt = $db->prepare("select * from product");
                        $stmt->execute();
                        $record = $stmt->fetchAll();
                        $i = 1; ?>

                        <select class="form-select" aria-label="Default select example" type="text" name="item">
                            <option></option>
                            <?php foreach ($record as $row) { ?>
                                <option <?php if ($key['i_id'] == $row['i_id']) {
                                            echo 'selected';
                                        } ?> value="<?php echo $row['i_id'] ?>">
                                    <?php echo $row['i_name']; ?>
                                </option>
                            <?php }; ?>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Prize</label>
                        <input type="text" class="form-control" name="prize" value="<?php echo $key['prize']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="quantity" value="<?php echo $key['quantity']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control" name="amount" value="<?php echo $key['amount']; ?>">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Purchase date</label>
                        <input type="date" class="form-control" name="pdate" value="<?php echo $key['purchase_date']; ?>">
                    </div>

                    <div class="col-md-12">
                        <!-- <button type="submit" class="btn btn-primary" onclick="submitcust()">Submit</button> -->
                        <button type="submit" class="btn btn-primary btn-sm" name="update" onclick="validateorder()">Update</button>
                        <button onclick="location.href = 'purchase-order.php';" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>

            <?php } ?>
            </div>
    </div>
    </div>
    </div>
    </div>
    </section>
    <?php include('include/footer.php'); ?>