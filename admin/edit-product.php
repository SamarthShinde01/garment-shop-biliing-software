<?php


session_start();
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<?php

$stmt = $db->prepare("SELECT * from product WHERE i_id = ?");
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
        <form class="row" method="POST" action="app/product-crud.php" id="product_form">

          <input type="hidden" class="form-control" name="id" value="<?php echo $key['i_id'] ?>">

          <div class="mb-3 col-md-6">
            <label class="form-label">Product Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="pname" value="<?php echo $key['i_name'] ?>">
          </div>

          <div class="mb-3 col-md-6">
            <label class="form-label">Select Category<span class="text-danger">*</span></label>
            <?php
            $cnt = 1;

            $stmt = $db->prepare("select * from category Where delete_status=0 ");
            $stmt->execute();
            $record = $stmt->fetchAll();
            $i = 1; ?>

            <select class="form-select" aria-label="Default select example" type="text" name="cate">
              <option value="">Choose a category </option>
              <?php foreach ($record as $row) { ?>
                <!-- <option value="<?php echo $row['cate_id'] ?>">
                                            <?php echo $row['cate_name']; ?>  
                                        </option> -->

                <option <?php if ($key['cate_id'] == $row['cate_id']) {
                          echo 'selected';
                        } ?> value="<?php echo $row['cate_id'] ?>">
                  <?php echo $row['cate_name']; ?>
                </option>

              <?php }; ?>
            </select>
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">product Prize<span class="text-danger">*</span></label></label>
            <input type="text" class="form-control" name="pprize" value="<?php echo $key['i_prize'] ?>">
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">product Selling Prize<span class="text-danger">*</span></label></label>
            <input type="text" class="form-control" name="sprize" value="<?php echo $key['product_sprize'] ?>">
          </div>
          <div class="mb-3 col-md-6">
            <label class="form-label">Submitted Date<span class="text-danger">*</span></label></label>
            <input type="date" class="form-control" name="submitted_date" value="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="col-md-12">
            <button type="submit" name="update" class="btn btn-primary btn-sm" onclick="validateproduct()">Submit</button>
            <input class="btn btn-primary btn-sm" type="reset" value="Reset">
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