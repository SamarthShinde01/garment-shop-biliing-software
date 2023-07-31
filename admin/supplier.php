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
                <h3 class="mb-0">Supplier Details </h3>
                <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage Supplier </span></p>
            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <!-- Modal -->
            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Supplier Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Add supplier details form -->
                            <form class="row" method="POST" action="app/sup-crud.php" id="supplier_form">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">First Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="fname">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Last Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="lname">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Contact Number<span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="mobile">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" name="address"></textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputState">State</label>
                                    <select class="form-control select2" id="inputState" name="state">
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
                                    <select class="form-control select2" id="inputDistrict" name="sup_city">
                                        <option value="">-- select one -- </option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary" onclick="validatesuplier()">Submit</button>
                                    <input class="btn btn-primary" type="reset" value="Reset">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Manage supplier details -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Supplier ID</th>
                                    <th>Supplier Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <!-- <th>Address</th> -->
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $cnt = 1;

                                $stmt = $db->prepare("select * from supplier where delete_status=0");
                                $stmt->execute();
                                $record = $stmt->fetchAll();
                                $i = 1;
                                foreach ($record as $row) { ?>

                                    <!--Fetch the Records -->
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['sup_fname'] . ' ' . $row['sup_lname']; ?></td>
                                        <!-- <td><?php echo $row['sup_lname']; ?></td> -->
                                        <td><?php echo $row['sup_email']; ?></td>
                                        <td><?php echo $row['sup_mobile']; ?></td>
                                        <!-- <td><?php echo $row['sup_add']; ?></td> -->
                                        <td><?php echo $row['sup_city']; ?></td>
                                        <td><?php echo $row['sup_state']; ?></td>
                                        <td>

                                            <a href="edit-suplier.php?supid=<?php echo $row['sup_id']; ?>" class="btn btn-primary btn-sm "><i class="icon-line-awesome-edit fs-5"></i></a>
                                            <a href="app/sup-crud.php?delid=<?php echo $row['sup_id']; ?>" class="btn btn-danger btn-sm " onclick="return confirm('Do you really want to Delete ?');"><i class="icon-line-awesome-trash-o fs-5"></i></a>
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