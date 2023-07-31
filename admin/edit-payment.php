<?php


session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<?php

$stmt = $db->prepare("SELECT * from payment WHERE payment_id = ?");
$stmt->execute([$_GET['pid']]);
$result = $stmt->fetchAll();
foreach ($result as $key) {
    // code...

?>

    <div class="content-body mb-5 p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="heading mb-4 d-flex align-items-center justify-content-between">
                    <h3 class="mb-0">Edit Payment Details </h3>
                    <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage </span></p>
                </div>
            </div>
        </div>
        <section>
            <div class="container">

                <!-- Edit payment details form -->
                <form class="row" method="POST" action="app/payment-crud.php" id="payment_form">
                    <input type="hidden" class="form-control" name="pid" value="<?php echo $key['payment_id']; ?>">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Invoice No</label>
                        <input type="text" class="form-control" name="ino" value="<?php echo $key['invoice_no']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Select Customer</label>
                        <?php
                        $cnt = 1;

                        $stmt = $db->prepare("select * from customer");
                        $stmt->execute();
                        $record = $stmt->fetchAll();
                        $i = 1; ?>

                        <select class="form-select" aria-label="Default select example" type="text" name="cust">
                            <?php foreach ($record as $row) { ?>
                                <option <?php if ($key['cust_id'] == $row['cust_id']) {
                                            echo 'selected';
                                        } ?> value="<?php echo $row['cust_id'] ?>">
                                    <?php echo $row['cust_fname'] . ' ' . $row['cust_lname']; ?>
                                </option>
                            <?php }; ?>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Select Payment Method</label>
                        <select class="form-select" aria-label="Default select example" type="text" name="pmethod"><?php echo $key['payment_method']; ?>
                            <option></option>
                            <option <?php if ($key['payment_method'] == 'Cash') {
                                        echo 'selected';
                                    } ?>>Cash</option>
                            <option <?php if ($key['payment_method'] == 'Card(Debit/Credit)') {
                                        echo 'selected';
                                    } ?>>Card(Debit/Credit)</option>
                            <option <?php if ($key['payment_method'] == 'UPI payment') {
                                        echo 'selected';
                                    } ?>>UPI payment</option>

                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Payment received</label>
                        <input type="text" class="form-control" name="precieved" value="<?php echo $key['payment_received']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Payment date</label>
                        <input type="date" class="form-control" name="pdate" value="<?php echo $key['payment_date']; ?>">
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-sm" name="update" onclick="validatepayment()">Update</button>
                        <button onclick="location.href = 'payment.php';" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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