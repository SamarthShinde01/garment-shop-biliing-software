<?php


session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<?php

$stmt = $db->prepare("SELECT * from supplier WHERE sup_id = ?");
$stmt->execute([$_GET['supid']]);
$result = $stmt->fetchAll();
foreach ($result as $key) {
    // code...

?>
    <div class="content-body mb-5 p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="heading mb-4 d-flex align-items-center justify-content-between">
                    <h3 class="mb-0">Edit Supplier Details </h3>
                    <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage Supplier </span></p>
                </div>
            </div>
        </div>
        <section>
            <div class="container">

                <!-- Edit supomer details form -->
                <!-- <form class="row" method="POST" action="" id="supomer_form"> -->
                <form class="row" method="POST" action="app/sup-crud.php" id="supplier_form">
                    <input type="hidden" class="form-control" name="supid" value="<?php echo $key['sup_id']; ?>">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="fname" value="<?php echo $key['sup_fname']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" value="<?php echo $key['sup_lname']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $key['sup_email']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <input type="tel" class="form-control" name="mobile" value="<?php echo $key['sup_mobile']; ?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address"><?php echo $key['sup_add']; ?></textarea>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputState">State</label>
                        <select class="form-control" id="inputState2" name="state"><?php echo $key['sup_state']; ?>
                            <option></option>
                            <option <?php if ($key['sup_state'] == 'Andra Pradesh') {
                                        echo 'selected';
                                    } ?>>Andra Pradesh</option>
                            <option <?php if ($key['sup_state'] == 'Arunachal Pradesh') {
                                        echo 'selected';
                                    } ?>>Arunachal Pradesh</option>
                            <option <?php if ($key['sup_state'] == 'Assam') {
                                        echo 'selected';
                                    } ?>>Assam</option>
                            <option <?php if ($key['sup_state'] == 'Bihar') {
                                        echo 'selected';
                                    } ?>>Bihar</option>
                            <option <?php if ($key['sup_state'] == 'Chhattisgarh') {
                                        echo 'selected';
                                    } ?>>Chhattisgarh</option>
                            <option <?php if ($key['sup_state'] == 'Goa') {
                                        echo 'selected';
                                    } ?>>Goa</option>
                            <option <?php if ($key['sup_state'] == 'Gujarat') {
                                        echo 'selected';
                                    } ?>>Gujarat</option>
                            <option <?php if ($key['sup_state'] == 'Haryana') {
                                        echo 'selected';
                                    } ?>>Haryana</option>
                            <option <?php if ($key['sup_state'] == 'Himachal Pradesh') {
                                        echo 'selected';
                                    } ?>>Himachal Pradesh</option>
                            <option <?php if ($key['sup_state'] == 'Jammu and Kashmir') {
                                        echo 'selected';
                                    } ?>>Jammu and Kashmir</option>
                            <option <?php if ($key['sup_state'] == 'Jharkhand') {
                                        echo 'selected';
                                    } ?>>Jharkhand</option>
                            <option <?php if ($key['sup_state'] == 'Karnataka') {
                                        echo 'selected';
                                    } ?>>Karnataka</option>
                            <option <?php if ($key['sup_state'] == 'Kerala') {
                                        echo 'selected';
                                    } ?>>Kerala</option>
                            <option <?php if ($key['sup_state'] == 'Madya Pradesh') {
                                        echo 'selected';
                                    } ?>>Madya Pradesh</option>
                            <option <?php if ($key['sup_state'] == 'Maharashtra') {
                                        echo 'selected';
                                    } ?>>Maharashtra</option>
                            <option <?php if ($key['sup_state'] == 'Manipur') {
                                        echo 'selected';
                                    } ?>>Manipur</option>
                            <option <?php if ($key['sup_state'] == 'Meghalaya') {
                                        echo 'selected';
                                    } ?>>Meghalaya</option>
                            <option <?php if ($key['sup_state'] == 'Mizoram') {
                                        echo 'selected';
                                    } ?>>Mizoram</option>
                            <option <?php if ($key['sup_state'] == 'Nagaland') {
                                        echo 'selected';
                                    } ?>>Nagaland</option>
                            <option <?php if ($key['sup_state'] == 'Orissa') {
                                        echo 'selected';
                                    } ?>>Orissa</option>
                            <option <?php if ($key['sup_state'] == 'Punjab') {
                                        echo 'selected';
                                    } ?>>Punjab</option>
                            <option <?php if ($key['sup_state'] == 'Rajasthan') {
                                        echo 'selected';
                                    } ?>>Rajasthan</option>
                            <option <?php if ($key['sup_state'] == 'Sikkim') {
                                        echo 'selected';
                                    } ?>>Sikkim</option>
                            <option <?php if ($key['sup_state'] == 'Tamil Nadu') {
                                        echo 'selected';
                                    } ?>>Tamil Nadu</option>
                            <option <?php if ($key['sup_state'] == 'Telangana') {
                                        echo 'selected';
                                    } ?>>Telangana</option>
                            <option <?php if ($key['sup_state'] == 'Tripura') {
                                        echo 'selected';
                                    } ?>>Tripura</option>
                            <option <?php if ($key['sup_state'] == 'Uttaranchal') {
                                        echo 'selected';
                                    } ?>>Uttaranchal</option>
                            <option <?php if ($key['sup_state'] == 'Uttar Pradesh') {
                                        echo 'selected';
                                    } ?>>Uttar Pradesh</option>
                            <option <?php if ($key['sup_state'] == 'West Bengal') {
                                        echo 'selected';
                                    } ?>>West Bengal</option>
                            <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                            <option <?php if ($key['sup_state'] == 'Andaman and Nicobar Islands') {
                                        echo 'selected';
                                    } ?>>Andaman and Nicobar Islands</option>
                            <option <?php if ($key['sup_state'] == 'Chandigarh') {
                                        echo 'selected';
                                    } ?>>Chandigarh</option>
                            <option <?php if ($key['sup_state'] == 'Dadar and Nagar Haveli') {
                                        echo 'selected';
                                    } ?>>Dadar and Nagar Haveli</option>
                            <option <?php if ($key['sup_state'] == 'Daman and Diu') {
                                        echo 'selected';
                                    } ?>>Daman and Diu</option>
                            <option <?php if ($key['sup_state'] == 'Delhi') {
                                        echo 'selected';
                                    } ?>>Delhi</option>
                            <option <?php if ($key['sup_state'] == 'Lakshadeep') {
                                        echo 'selected';
                                    } ?>>Lakshadeep</option>
                            <option <?php if ($key['sup_state'] == 'Pondicherry') {
                                        echo 'selected';
                                    } ?>>Pondicherry</option>
                        </select>
                    </div>


                    <div class="mb-3 col-md-6">
                        <label for="inputDistrict">District</label>
                        <?php
                        $cnt = 1;

                        $stmt = $db->prepare("select * from supplier");
                        $stmt->execute();
                        $record = $stmt->fetchAll();
                        $i = 1; ?>
                        <select class="form-control" aria-label="Default select example" type="text" id="inputDistrict2" name="sup_city">
                            <option>--Select one--</option>
                            <?php foreach ($record as $row) { ?>
                                <option <?php if ($key['sup_city'] == $row['sup_city']) {
                                            echo 'selected';
                                        } ?> value="<?php echo $row['sup_city']; ?>"> <?php echo $row['sup_city']; ?> </option> <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <!-- <button type="submit" class="btn btn-primary" onclick="submitsup()">Submit</button> -->
                        <button type="submit" class="btn btn-primary btn-sm" name="update" onclick="validatesuplier()">Update</button>
                        <button onclick="location.href = 'supplier.php';" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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