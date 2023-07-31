<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<?php

$stmt = $db->prepare("SELECT * from customer WHERE cust_id = ?");
$stmt->execute([$_GET['cid']]);
$result = $stmt->fetchAll();
foreach ($result as $key) {
    // code...

?>
    <div class="content-body mb-5 p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="heading mb-4 d-flex align-items-center justify-content-between">
                    <h3 class="mb-0">Edit Customer Details </h3>
                    <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage </span></p>
                </div>
            </div>
        </div>
        <section>
            <div class="container">

                <!-- Edit customer details form -->
                <!-- <form class="row" method="POST" action="" id="customer_form"> -->
                <form class="row" method="POST" action="app/cust-crud.php" id="customer_form">
                    <input type="hidden" class="form-control" name="cid" value="<?php echo $key['cust_id']; ?>">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="fname" value="<?php echo $key['cust_fname']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" value="<?php echo $key['cust_lname']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $key['cust_email']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <input type="tel" class="form-control" name="mobile" value="<?php echo $key['cust_mobile']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address"><?php echo $key['cust_add']; ?></textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Date Of Birth</label>
                        <input type="date" class="form-control" name="cdob" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputState">State</label>
                        <select class="form-control" id="inputState2" name="state"><?php echo $key['cust_state']; ?>
                            <option></option>
                            <option <?php if ($key['cust_state'] == 'Andra Pradesh') {
                                        echo 'selected';
                                    } ?>>Andra Pradesh</option>
                            <option <?php if ($key['cust_state'] == 'Arunachal Pradesh') {
                                        echo 'selected';
                                    } ?>>Arunachal Pradesh</option>
                            <option <?php if ($key['cust_state'] == 'Assam') {
                                        echo 'selected';
                                    } ?>>Assam</option>
                            <option <?php if ($key['cust_state'] == 'Bihar') {
                                        echo 'selected';
                                    } ?>>Bihar</option>
                            <option <?php if ($key['cust_state'] == 'Chhattisgarh') {
                                        echo 'selected';
                                    } ?>>Chhattisgarh</option>
                            <option <?php if ($key['cust_state'] == 'Goa') {
                                        echo 'selected';
                                    } ?>>Goa</option>
                            <option <?php if ($key['cust_state'] == 'Gujarat') {
                                        echo 'selected';
                                    } ?>>Gujarat</option>
                            <option <?php if ($key['cust_state'] == 'Haryana') {
                                        echo 'selected';
                                    } ?>>Haryana</option>
                            <option <?php if ($key['cust_state'] == 'Himachal Pradesh') {
                                        echo 'selected';
                                    } ?>>Himachal Pradesh</option>
                            <option <?php if ($key['cust_state'] == 'Jammu and Kashmir') {
                                        echo 'selected';
                                    } ?>>Jammu and Kashmir</option>
                            <option <?php if ($key['cust_state'] == 'Jharkhand') {
                                        echo 'selected';
                                    } ?>>Jharkhand</option>
                            <option <?php if ($key['cust_state'] == 'Karnataka') {
                                        echo 'selected';
                                    } ?>>Karnataka</option>
                            <option <?php if ($key['cust_state'] == 'Kerala') {
                                        echo 'selected';
                                    } ?>>Kerala</option>
                            <option <?php if ($key['cust_state'] == 'Madya Pradesh') {
                                        echo 'selected';
                                    } ?>>Madya Pradesh</option>
                            <option <?php if ($key['cust_state'] == 'Maharashtra') {
                                        echo 'selected';
                                    } ?>>Maharashtra</option>
                            <option <?php if ($key['cust_state'] == 'Manipur') {
                                        echo 'selected';
                                    } ?>>Manipur</option>
                            <option <?php if ($key['cust_state'] == 'Meghalaya') {
                                        echo 'selected';
                                    } ?>>Meghalaya</option>
                            <option <?php if ($key['cust_state'] == 'Mizoram') {
                                        echo 'selected';
                                    } ?>>Mizoram</option>
                            <option <?php if ($key['cust_state'] == 'Nagaland') {
                                        echo 'selected';
                                    } ?>>Nagaland</option>
                            <option <?php if ($key['cust_state'] == 'Orissa') {
                                        echo 'selected';
                                    } ?>>Orissa</option>
                            <option <?php if ($key['cust_state'] == 'Punjab') {
                                        echo 'selected';
                                    } ?>>Punjab</option>
                            <option <?php if ($key['cust_state'] == 'Rajasthan') {
                                        echo 'selected';
                                    } ?>>Rajasthan</option>
                            <option <?php if ($key['cust_state'] == 'Sikkim') {
                                        echo 'selected';
                                    } ?>>Sikkim</option>
                            <option <?php if ($key['cust_state'] == 'Tamil Nadu') {
                                        echo 'selected';
                                    } ?>>Tamil Nadu</option>
                            <option <?php if ($key['cust_state'] == 'Telangana') {
                                        echo 'selected';
                                    } ?>>Telangana</option>
                            <option <?php if ($key['cust_state'] == 'Tripura') {
                                        echo 'selected';
                                    } ?>>Tripura</option>
                            <option <?php if ($key['cust_state'] == 'Uttaranchal') {
                                        echo 'selected';
                                    } ?>>Uttaranchal</option>
                            <option <?php if ($key['cust_state'] == 'Uttar Pradesh') {
                                        echo 'selected';
                                    } ?>>Uttar Pradesh</option>
                            <option <?php if ($key['cust_state'] == 'West Bengal') {
                                        echo 'selected';
                                    } ?>>West Bengal</option>
                            <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                            <option <?php if ($key['cust_state'] == 'Andaman and Nicobar Islands') {
                                        echo 'selected';
                                    } ?>>Andaman and Nicobar Islands</option>
                            <option <?php if ($key['cust_state'] == 'Chandigarh') {
                                        echo 'selected';
                                    } ?>>Chandigarh</option>
                            <option <?php if ($key['cust_state'] == 'Dadar and Nagar Haveli') {
                                        echo 'selected';
                                    } ?>>Dadar and Nagar Haveli</option>
                            <option <?php if ($key['cust_state'] == 'Daman and Diu') {
                                        echo 'selected';
                                    } ?>>Daman and Diu</option>
                            <option <?php if ($key['cust_state'] == 'Delhi') {
                                        echo 'selected';
                                    } ?>>Delhi</option>
                            <option <?php if ($key['cust_state'] == 'Lakshadeep') {
                                        echo 'selected';
                                    } ?>>Lakshadeep</option>
                            <option <?php if ($key['cust_state'] == 'Pondicherry') {
                                        echo 'selected';
                                    } ?>>Pondicherry</option>
                        </select>
                    </div>


                    <div class="mb-3 col-md-6">
                        <label for="inputDistrict">District</label>
                        <?php
                        $cnt = 1;

                        $stmt = $db->prepare("select * from customer");
                        $stmt->execute();
                        $record = $stmt->fetchAll();
                        $i = 1; ?>
                        <select class="form-control" aria-label="Default select example" type="text" id="inputDistrict2" name="cust_city">
                            <option>--Select one--</option>
                            <?php foreach ($record as $row) { ?>
                                <option <?php if ($key['cust_city'] == $row['cust_city']) {
                                            echo 'selected';
                                        } ?> value="<?php echo $row['cust_city']; ?>"> <?php echo $row['cust_city']; ?> </option> <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <!-- <button type="submit" class="btn btn-primary" onclick="submitcust()">Submit</button> -->
                        <button type="submit" class="btn btn-primary btn-sm" name="update" onclick="submitcust()">Update</button>
                        <button onclick="location.href = 'customer.php';" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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