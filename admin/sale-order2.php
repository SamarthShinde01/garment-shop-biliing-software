<?php


session_start();
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="content-body mb-5 p-3">
  <div class="row1">
    <div class="col-md-12">
      <div class="heading mb-4 d-flex align-items-center justify-content-between">
        <h3 class="mb-0">Sale Order Details </h3>
        <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage </span></p>
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
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Sale Order Details</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Add sale order details form -->
              <div class="auto">
                <form class="row" method="POST" action="app/sale-crud.php" name="soid" id="saleorder_form">

                  <div class="mb-3 col-md-6">



                    <label class="form-label">Invoice Number<span class="text-danger">*</span></label>
                    <?php

                    function random_strings($length_of_string)
                    {

                      // String of all alphanumeric character
                      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                      // Shuffle the $str_result and returns substring
                      // of specified length
                      return substr(
                        str_shuffle($str_result),
                        0,
                        $length_of_string
                      );
                    }

                    // This function will generate
                    // Random string of length 10
                    $new = random_strings(7);



                    ?>
                    <input type="text" class="form-control" readonly name="invoice_no" value="<?php echo $new; ?>">
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label">Invoice date<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" autocomplete="off" name="idate" value="<?php echo date('Y-m-d'); ?>" />
                  </div>



                  <div class="mb-3 col-md-6">

                    <label class="form-label">Select Customer<span class="text-danger">*</span></label>
                    <a class="text-danger" href="customer-add.php">Add Customer</a>


                    <select class="form-select cust " onchange="Cust(this);" id="mySelect2" name="cust">
                      <?php
                      $cnt = 1;

                      $stmt = $db->prepare("select * from customer");
                      $stmt->execute();
                      $record = $stmt->fetchAll();
                      $i = 1; ?>


                      <option value=""></option>
                      <?php foreach ($record as $row) { ?>
                        <option value=" <?php echo $row['cust_id'] ?>">
                          <?php echo $row['cust_fname'] . ' ' . $row['cust_lname']; ?> <?php }; ?>
                        </option>

                    </select>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label ">Customer Number<span class="text-danger">*</span></label>
                    <input type="tel" class="form-control num" id="prize" name="prize">
                  </div>



                  <!--    <div class="mb-3 col-md-6">
                                    <label class="form-label">Select Item<span class="text-danger">*</span></label>
                                     <?php
                                      $cnt = 1;

                                      $stmt = $db->prepare("select * from product");
                                      $stmt->execute();
                                      $record = $stmt->fetchAll();
                                      $i = 1; ?>
                                   
                                    <select class="form-select" aria-label="Default select example"type="text" onchange="Item(this);" id="mySelect1" name="product">
                                        <option></option>
                                        <?php foreach ($record as $row) { ?>
                                            <option value=" <?php echo $row['i_id'] ?>">
                                            <?php echo $row['i_name']; ?>  <?php }; ?>
                                        </option>

                                     </select>

                                        </div>
                                      <div class="mb-3 col-md-6">
                                    <label class="form-label ">product Prize<span class="text-danger">*</span></label></label>
                                    <input type="text" class="form-control add" id="prize" name="prize" >
                                  </div> -->


                  <div class="mydiv">
                    <div class="form-group row control-group after-add-more subdiv align-items-center">
                      <div class="mb-3 col">
                        <label class="form-label">Sr no</label>
                        <div class="sr_no">1</div>
                      </div>
                      <div class="mb-3 col">
                        <label class="form-label">Select Item</label>
                        <?php
                        $cnt = 1;

                        $stmt = $db->prepare("select * from product");
                        $stmt->execute();
                        $record = $stmt->fetchAll();
                        $i = 1; ?>
                        <!-- <input type="number" class="form-control" > -->
                        <select class="form-control" aria-label="Default select example" type="text" onchange="Item(this);" id="mySelect1" name="product">
                          <option></option>
                          <?php foreach ($record as $row) { ?>
                            <option value=" <?php echo $row['i_id'] ?>">
                              <?php echo $row['i_name']; ?> <?php }; ?>
                            </option>

                        </select>
                      </div>
                      <div class="mb-3 col">
                        <label class="form-label ">product Prize<span class="text-danger">*</span></label>
                        <input type="text" class="form-control add" id="prize" name="prize">
                      </div>
                      <div class="mb-3 col">
                        <label class="form-label">Quantity<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sale_quantity" name="sale_quantity">
                      </div>
                      <div class="col">
                        <button class="btn btn-primary add-more" type="button"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                  </div>


                  <div class="copy hide" style="display:none;">
                    <div class="form-group control-group row subdiv align-items-center">
                      <div class="mb-3 col">
                        <div class="sr_no"></div>
                      </div>
                      <div class="mb-3 col">
                        <!-- <input type="number" class="form-control" > -->
                        <?php
                        $cnt = 1;

                        $stmt = $db->prepare("select * from product");
                        $stmt->execute();
                        $record = $stmt->fetchAll();
                        $i = 1; ?>
                        <!-- <input type="number" class="form-control" > -->
                        <select class="form-control" aria-label="Default select example" type="text" onchange="Item(this);" id="mySelect1" name="product">
                          <option></option>
                          <?php foreach ($record as $row) { ?>
                            <option value=" <?php echo $row['i_id'] ?>">
                              <?php echo $row['i_name']; ?> <?php }; ?>
                            </option>

                        </select>
                      </div>
                      <?php
                      $arrayNumber = 0;
                      for ($x = 1; $x < 2; $x++) { ?>
                        <div class="mb-3 col">
                          <input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                        </div>

                        <div class="mb-3 col">
                          <input type="text" class="form-control add" id="prize[]" name="prize">
                        </div>
                        <div class="mb-3 col">
                          <input type="text" class="form-control" id="sale_quantity" name="sale_quantity[]">
                        </div>
                        <div class="col">
                          <button class="btn btn-danger remove" type="button"><i class="fa fa-trash-alt"></i></button>
                        </div>
                    </div>
                  </div>
                <?php }; ?>
                <!--  <div class="mb-3 col-md-6">
                                    <label class="form-label">Quantity<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="sale_quantity" name="sale_quantity" >
                                </div> -->
                <div class="mb-3 col-md-6">
                  <label class="form-label">Amount</label>

                  <input type="text" class="form-control" id="amount" onblur="total()" name="amount" readonly>
                </div>

                <div class="col-md-12">
                  <button type="submit" name="submit" class="btn btn-primary" onclick="validatesaleorder()">Submit</button>
                  <input class="btn btn-primary" type="reset" value="Reset"><br><br>
                  <button onclick="location.href = 'customer-add.php';" type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" aria-label="Close">Add Customer</button>
                </div>


                <!-- For Multiple select -->


                </form>
              </div>

              <script>
                function total() {
                  var a = parseInt(document.getElementById('prize').value);
                  var b = parseInt(document.getElementById('sale_quantity').value);
                  var t = a * b;
                  document.getElementById('amount').value = t;
                  var total = t;
                }
              </script>
  </section>


  <!-- Manage order details -->
  <div class="row">
    <div class="col-md-12">
      <div class="card border-0 shadow">
        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="display table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Invoice No.</th>
                  <th>Customer</th>
                  <th>Item</th>
                  <th>Prize</th>
                  <th>Quantity</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php


                $cnt = 1;
                $stmt = $db->prepare("SELECT * from sale INNER JOIN customer ON sale.cust_id=customer.cust_id INNER JOIN product ON sale.i_id = product.i_id ;");
                $stmt->execute();
                $record = $stmt->fetchAll();
                $i = 1;
                foreach ($record as $row) {
                ?>

                  <!--Fetch the Records -->
                  <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $row['invoice_no']; ?></td>
                    <td><?php echo $row['cust_fname'] . ' ' . $row['cust_lname']; ?></td>
                    <td><?php echo $row['i_name']; ?></td>
                    <td><?php echo $row['prize']; ?></td>
                    <td><?php echo $row['sale_quantity']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo $row['sale_date']; ?></td>
                    <td>
                      <a href="edit-sale-order.php?soid=<?php echo $row['saleid']; ?>" class="btn btn-primary btn-sm "><i class="icon-line-awesome-edit fs-5"></i></a>
                      <a href="sale-bill.php?saleid=<?php echo $row['saleid']; ?>" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i></a>
                      <a href="app/sale-crud.php?delid=<?php echo $row['saleid']; ?>" class="btn btn-danger btn-sm " onclick="return confirm('Do you really want to Delete ?');"><i class="icon-line-awesome-trash-o fs-5"></i></a>
                    </td>

                  </tr>
                <?php
                  $cnt++;
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


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
        // ..
        // var prevResult;
        // primary:function(msg){
        //        if (prevResult === msg) {
        //           ...
        //        }
        //        else {
        //           ...       
        //        }
        //        prevResult = msg;
        //    }
        // ..


        $(current).find('.add').val(response['display1'][0].i_prize);
        // $("#rateValue").val(response['display1'][0].i_prize);
        // $(current).find('.num').val(response['display2'][0].mobile);




      }

    });

  }
</script>

<script>
  function Cust(eve) {

    var val = $(eve).val();
    var current = $(eve).closest('.auto');

    $.ajax({

      type: "POST",

      url: "app/cust-crud.php",

      data: "cust_id=" + val,
      dataType: 'JSON',
      // 
      primary: function(response) {
        // alert(response['display2'][0].country_name);

        $(current).find('.num').val(response['display1'][0].cust_mobile);
        // $(current).find('.num').val(response['display2'][0].mobile);




      }

    });

  }
</script>

<?php include('include/footer.php'); ?>