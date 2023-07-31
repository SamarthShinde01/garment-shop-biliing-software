<?php


session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>

<form class="row" method="POST" action="app/cust-crud1.php" id="customer_form">
    <!-- Form start -->
    <div class="mb-3 col-md-6">
        <label class="form-label">First Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="fname">
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Last Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="lname">
    </div>



    <div class="mb-3 col-md-6">
        <label class="form-label" for="inputState">State</label>
        <select class="form-control" id="inputState" name="state[]">
            <option value="">Select State</option>
            <option value="Andra Pradesh">Andra Pradesh</option>
            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
            <option value="Assam">Assam</option>
            <option value="Bihar">Bihar</option>
            <option value="Chhattisgarh">Chhattisgarh</option>
            <option value="Goa">Goa</option>
            <option value="Gujarat">Gujarat</option>
            <option value="Haryana">Haryana</option>
            <option value="Himachal Pradesh">Himachal Pradesh</option>
            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
            <option value="Jharkhand">Jharkhand</option>
            <option value="Karnataka">Karnataka</option>
            <option value="Kerala">Kerala</option>
            <option value="Madya Pradesh">Madya Pradesh</option>
            <option value="Maharashtra">Maharashtra</option>
            <option value="Manipur">Manipur</option>
            <option value="Meghalaya">Meghalaya</option>
            <option value="Mizoram">Mizoram</option>
            <option value="Nagaland">Nagaland</option>
            <option value="Orissa">Orissa</option>
            <option value="Punjab">Punjab</option>
            <option value="Rajasthan">Rajasthan</option>
            <option value="Sikkim">Sikkim</option>
            <option value="Tamil Nadu">Tamil Nadu</option>
            <option value="Telangana">Telangana</option>
            <option value="Tripura">Tripura</option>
            <option value="Uttaranchal">Uttaranchal</option>
            <option value="Uttar Pradesh">Uttar Pradesh</option>
            <option value="West Bengal">West Bengal</option>
            <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
            <option value="Chandigarh">Chandigarh</option>
            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
            <option value="Daman and Diu">Daman and Diu</option>
            <option value="Delhi">Delhi</option>
            <option value="Lakshadeep">Lakshadeep</option>
            <option value="Pondicherry">Pondicherry</option>
        </select>
    </div>
    <div class="mb-3 col-md-6">
        <label for="inputDistrict">District</label>
        <select class="form-control" id="inputDistrict" name="city">
            <option value="">-- select one -- </option>
        </select>
    </div>

    <div class="col-md-12">
        <button type="submit" name="submit1" class="btn btn-primary" onclick="submitcust()">Submit</button>
        <input class="btn btn-primary" type="reset" value="Reset">
    </div>
</form>
<!-- Form end -->
<?php include('include/footer.php'); ?>