<?php include('include/sidebar.php');?>
    <?php include('include/header.php');?>

    <form class="center" method="POST" action="app/cust-crud.php" id="customer_form">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="fname">
                                </div>
                                <div>
                        <button type="submit" name="submit" class="btn btn-primary" onclick="submitcust()">Submit</button>
                                    
                                </div>
                            </form>
<?php include('include/footer.php');?>