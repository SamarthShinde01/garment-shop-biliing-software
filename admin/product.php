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
        <h3 class="mb-0">Item Details </h3>
        <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage </span></p>
      </div>
    </div>
  </div>
  <section>
    <div class="container">
      <!-- Modal -->
      <button type="add" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button>
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Item Details</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Add product details form -->
              <form class="row" method="POST" action="app/product-crud.php" id="product_form">
                <div class="mb-3 col-md-6">
                  <label class="form-label">Item Name<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="pname">
                </div>
                <!-- Select category from Category -->
                <div class="mb-3 col-md-6">
                  <label class="form-label">Select Category<span class="text-danger">*</span></label>
                  <?php
                  $cnt = 1;

                  $stmt = $db->prepare("select * from category Where delete_status=0 ");
                  $stmt->execute();
                  $record = $stmt->fetchAll();
                  $i = 1; ?>

                  <select class="form-select" aria-label="Default select example" type="text" id="cate1" name="cate">
                    <option value="">Choose a category </option>
                    <?php foreach ($record as $row) { ?>
                      <option value="<?php echo $row['cate_id'] ?>">
                        <?php echo $row['cate_name']; ?>
                      </option>
                    <?php }; ?>
                  </select>
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label">Item Cost Prize<span class="text-danger">*</span></label></label>
                  <input type="text" class="form-control" name="pprize">
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label">Product Selling Prize<span class="text-danger">*</span></label></label>
                  <input type="text" class="form-control" name="sprize">
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label">Submitted Date<span class="text-danger">*</span></label></label>
                  <input type="date" class="form-control" name="submitted_date" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-12">
                  <button type="submit" name="submit" class="btn btn-primary btn-sm" onclick="validateproduct()">Submit</button>
                  <input class="btn btn-primary btn-sm" type="reset" value="Reset">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Manage menu details -->
  <div class="row">
    <div class="col-md-12">
      <div class="card border-0 shadow">
        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="display table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>Item Id</th>
                  <th>Item Name</th>
                  <th>Category</th>
                  <th>Cost Prize </th>
                  <th>Selling Prize</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php


                $cnt = 1;

                $stmt = $db->prepare("SELECT * from product INNER JOIN category ON product.cate_id=category.cate_id where product.delete_status='0'");
                $stmt->execute();
                $record = $stmt->fetchAll();
                $i = 1;
                foreach ($record as $row) {
                ?>

                  <!--Fetch the Records -->
                  <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $row['i_name']; ?></td>
                    <td><?php echo $row['cate_name']; ?></td>
                    <td><?php echo $row['i_prize']; ?></td>
                    <td><?php echo $row['product_sprize']; ?></td>
                    <td>

                      <a href="edit-product.php?pid=<?php echo $row['i_id']; ?>" class="btn btn-primary btn-sm "><i class="icon-line-awesome-edit fs-5"></i></a>
                      <a href="app/product-crud.php?delid=<?php echo $row['i_id']; ?>" class="btn btn-danger btn-sm " onclick="return confirm('Do you really want to Delete ?');"><i class="icon-line-awesome-trash-o fs-5"></i></a>
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