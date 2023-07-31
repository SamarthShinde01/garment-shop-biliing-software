<?php


session_start();
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<?php

$stmt = $db->prepare("SELECT * from sale_item INNER JOIN sale ON sale_item.sale_id=sale.saleid where saleid=? ;");
$stmt->execute([$_GET['soid']]);
$result = $stmt->fetchAll();
foreach ($result as $key) {
  // code...

?>
  <?php

  $stmt = $db->prepare("SELECT * from sale INNER JOIN customer ON sale.cust_id=customer.cust_id where saleid=? ;");
  $stmt->execute([$_GET['soid']]);
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
          <div class="auto">
            <form class="row" method="POST" action="app/sale-crud.php" id="order_form">
              <input type="hidden" class="form-control" name="soid" value="<?php echo $key['saleid']; ?>">
              <div class="mb-3 col-md-6">
                <label class="form-label">Invoice Number</label>
                <input type="text" class="form-control" name="ino" value="<?php echo $key['invoice_no']; ?>">
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label">Invoice date<span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" value="<?php echo $key['sale_date']; ?>" name="idate">
              </div>
              <!-- Drop down list for customer -->

              <div class="mb-3 col-md-6">

                <label class="form-label">Select Customer<span class="text-danger">*</span></label>
                <a class="text-danger" href="customer-add.php">Add Customer</a>


                <select class="form-select cust " name="cust" id="cust">
                  <?php
                  $cnt = 1;

                  $stmt = $db->prepare("select * from customer");
                  $stmt->execute();
                  $record = $stmt->fetchAll();
                  $i = 1; ?>


                  <option value=""></option>
                  <?php foreach ($record as $row) { ?>
                    <option value=" <?php if ($key['cust_id'] == $row['cust_id']) {
                                      echo 'selected';
                                    } ?>" data-addrs="<?php echo $row['cust_add'] ?>" data-email="<?php echo $row['cust_email'] ?>" data-mobile="<?php echo $row['cust_mobile'] ?>">
                      <?php echo $row['cust_fname'] . ' ' . $row['cust_lname']; ?> <?php }; ?>
                    </option>

                </select>
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
                  <option></option>
                  <?php foreach ($record as $row) { ?>
                    <option <?php if ($key['cust_id'] == $row['cust_id']) {
                              echo 'selected';
                            } ?> value="<?php echo $row['cust_id'] ?>">
                      <?php echo $row['cust_fname'] . ' ' . $row['cust_lname']; ?>
                    </option> <?php } ?>

                </select>
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label ">Customer Number<span class="text-danger">*</span></label>


                <input type="tel" class="form-control num" name="mobile" id="mobile" value=" <?php echo $key['cust_mobile']; ?>">
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label ">Customer Email<span class="text-danger">*</span></label>
                <input type="tel" class="form-control " name="email" id="email" value=" <?php echo $key['cust_email']; ?>">
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label ">Customer Address<span class="text-danger">*</span></label>
                <input type="tel" class="form-control " name="address" id="address" value=" <?php echo $key['cust_add']; ?>">
              <?php }; ?>
              </div>

              <!-- Drop Down list for Item -->

              <div class="mb-3 col-md-6">
                <label class="form-label">Select Item<span class="text-danger">*</span></label>
                <?php
                $cnt = 1;

                $stmt = $db->prepare("select * from product");
                $stmt->execute();
                $record = $stmt->fetchAll();
                $i = 1; ?>

                <select class="form-select" aria-label="Default select example" type="text" onchange="Item(this);" name="product">
                  <option></option>
                  <?php foreach ($record as $row) { ?>

                    <option <?php if ($key['i_id'] == $row['i_id']) {
                              echo 'selected';
                            } ?> value="<?php echo $row['i_id'] ?>">
                      <?php echo $row['i_name']; ?> <?php }; ?>
                    </option>




                </select>

              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label ">product Prize<span class="text-danger">*</span></label></label>
                <input type="text" class="form-control add" id="prize" value="<?php echo $key['prize']; ?>" name="prize">
              </div>



              <div class="mb-3 col-md-6">
                <label class="form-label">Quantity</label>
                <input type="text" class="form-control" name="quantity" id="sale_quantity" value="<?php echo $key['sale_quantity']; ?>">
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label">Amount</label>
                <input type="text" class="form-control" name="amount" id="amount" onclick="total()" value="<?php echo $key['amount']; ?>">
              </div>

              <!-- onclick="validateorder()" -->

              <div class="col-md-12">
                <!-- <button type="submit" class="btn btn-primary" onclick="submitcust()">Submit</button> -->
                <button type="submit" class="btn btn-primary btn-sm" name="update">Update</button>
                <button onclick="location.href = 'purchase-order.php';" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
              </div>

              <!-- Javascript code for Automatic total generate -->
              <script>
                function total() {
                  var a = parseInt(document.getElementById('prize').value);
                  var b = parseInt(document.getElementById('sale_quantity').value);
                  var t = a * b;
                  document.getElementById('amount').value = t;
                }
              </script>
          </div><?php } ?>
        </form>


        </div>
    </div>
    </div>
    </div>
    </div>
    </section>


    <!-- Ajax for Automatic Enter Item Price -->
    <script>
      function Item(eve) {

        var val = $(eve).val();
        var current = $(eve).closest('.auto');

        $.ajax({

          type: "POST",

          url: "app/product-crud.php",

          data: "i_id=" + val,
          dataType: 'JSON',
          // 
          primary: function(response) {
            // alert(response['display2'][0].country_name);

            $(current).find('.add').val(response['display1'][0].i_prize);
            // $(current).find('.num').val(response['display2'][0].mobile);




          }

        });

      }
    </script>
    <?php include('include/footer.php'); ?>