<?php


session_start();
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<div class="content-body mb-5 p-3">
  <div class="row">
    <div class="col-md-12">
      <div class="heading mb-4 d-flex align-items-center justify-content-between">
        <h3 class="mb-0">Add Stock Details</h3>
        <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/Add stock </span></p>
      </div>
    </div>
  </div>
  <section>
    <div class="container">


      <!-- Add Stock details form -->
      <form class="row" method="POST" action="app/stock-crud.php" id="stock_form" autocomplete="OFF">


        <div class="mb-3 col-md-6">
          <label class="form-label">Select Supplier<span class="text-danger">*</span><small data-bs-toggle="modal" data-bs-target="#exampleModal" class="text-danger">Add Supplier</small></label>
          <?php
          $cnt = 1;

          $stmt = $db->prepare("select * from supplier");
          $stmt->execute();
          $record = $stmt->fetchAll();
          $i = 1; ?>

          <select class="form-select select2" aria-label="Default select example" type="text" name="sup" id="sup">

            <option value="">--select supplier--</option>
            <?php foreach ($record as $row) { ?>
              <option value="<?php echo $row['sup_id'] ?>" data-email="<?php echo $row['sup_email'] ?>" data-mobile="<?php echo $row['sup_mobile'] ?>">
                <?php echo $row['sup_fname'] . ' ' . $row['sup_lname']; ?>
              </option>
            <?php }; ?>
          </select>

        </div>
        <div class="mb-3 col-md-6">
          <label class="form-label">Date<span class="text-danger">*</span></label>
          <input type="date" class="form-control" name="build_date" value="<?php echo date('Y-m-d'); ?>" readonly>
        </div>
        <div class="mb-3 col-md-6">
          <label class="form-label">Supplier Email</label>
          <input type="text" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3 col-md-6">
          <label class="form-label">Supplier Mobile No</label>
          <input type="tel" class="form-control" name="mobile" id="mobile">
        </div>

        <div class="form-group row">
          <div class="col-sm-1">
            Sr no.
          </div>

          <div class="col-sm-2">
            Category
          </div>

          <div class="col-sm-3">
            Select Item
          </div>


          <div class="col-sm-1">
            Avl. Unit
          </div>
          <div class="col-sm-1">
            Req. Unit
          </div>

          <div class="col-sm-1">
            Purchase Price
          </div>
          <div class="col-sm-2">
            Total
          </div>
        </div>

        <div class="mydiv">
          <div class="form-group row control-group after-add-more subdiv">
            <div class="col-sm-1 sr_no">1</div>
            <div class="col-sm-2">
              <select name="p_group_name[]" class="form-control p_group_name select2" id="input1" required>
                <option value="">--Select Category--</option>
                <?php
                $sql = "SELECT * FROM category where delete_status='0' order by cate_id desc";
                $statement = $db->prepare($sql);
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $row['cate_id']; ?>"><?php echo $row['cate_name']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-3">
              <div class="col-sm-12">
                <select name="product_id[]" class="form-control product_id select2" id="sele_prod" required>
                  <option value="">--Select Items--</option>
                </select>
              </div>
            </div>

            <div class="col-sm-1">
              <input type="text" class="form-control" id="aquantity" name="aquantity[]" placeholder="Unit" required onblur="GFG_Fun();" pattern="^[0-9]+$" readonly="">
              <!-- <label  style="color: red">can not enter value more tha quantity</label>
                                             -->
            </div>
            <div class="col-sm-1">
              <input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="R Unit" required onblur="GFG_Fun();" pattern="^[0-9]+$">
              <!-- <label  style="color: red">can not enter value more tha quantity</label>
                                             -->
            </div>


            <div class="col-sm-1">
              <input type="text" class="form-control" id="rate" name="rate[]" placeholder="Sale Price" required readonly>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control total" id="total" name="total[]" placeholder="Total" readonly="">
            </div>

            <div class="col-sm-2">
              <button class="btn btn-success add-more" type="button"><i class="fa fa-plus"></i></button>
            </div>
          </div>

        </div>
        <div class="form-group row control-group">
          <label class="col-sm-6 control-label">GST %</label>
          <div class="mb-2 col-sm-3">
            <input type="number" class="form-control" id="gst_rate" name="gst_rate" placeholder="GST %" value="0" min="0" max="99">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-6 control-label">Discount</label>
          <div class="mb-2 col-sm-3">
            <input type="number" class="form-control" id="discount" name="discount" placeholder="Discount %" value="0" min="0" max="100">
          </div>
        </div>
        <input type="hidden" name="subtotal" id="subtotal" class="form-control" placeholder="Subtotal" readonly="">

        <div class="form-group row">
          <label class="col-sm-6 control-label"> Final Total</label>
          <div class="mb-2 col-sm-3">
            <input type="text" name="final_total" id="final_total" class="form-control" placeholder="Total" readonly="">
          </div>
        </div>

        <!--   <div class="mb-3 col-md-6">
                                    <label class="form-label">Expiry Date<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date" >
                                </div> -->
        <div class="col-md-12">
          <button type="submit" name="submit" class="btn btn-primary" onclick="submitstock()">Submit</button>
          <input class="btn btn-primary" type="reset" value="Reset">
        </div>
      </form>
      <div class="copy hide" style="display:none;">
        <div class="form-group control-group row subdiv">
          <div class="col-sm-1 sr_no"></div>
          <div class="col-sm-2">
            <select name="p_group_name[]" class="form-control p_group_name" id="" required>
              <option value="">--Select Category--</option>
              <?php
              $sql = "SELECT * FROM category where delete_status='0' order by cate_id desc";
              $statement = $db->prepare($sql);
              $statement->execute();
              while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $row['cate_id']; ?>"><?php echo $row['cate_name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-sm-3">
            <div class="col-sm-12">
              <select name="product_id[]" class="form-control product_id" required>
                <option value="">--Select Product--</option>
              </select>
            </div>
          </div>

          <div class="col-sm-1">
            <input type="text" class="form-control" id="aquantity" name="aquantity[]" placeholder="Unit" pattern="^[0-9]+$">
          </div>
          <div class="col-sm-1">
            <input type="text" class="form-control" id="quantity" name="quantity[]" placeholder=" R Unit" required onblur="GFG_Fun();" pattern="^[0-9]+$">
            <!-- <label  style="color: red">can not enter value more tha quantity</label>
                                             -->
          </div>

          <div class="col-sm-1">
            <input type="text" class="form-control" id="rate" name="rate[]" placeholder="Sale Price" readonly>
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control total" id="total" name="total[]" placeholder="Total" readonly="">
          </div>
          <div class="col-sm-2">
            <button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button>
          </div>
        </div>
      </div>




      <!-- script for customer details automatically display -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

      <script type="text/javascript">
        //$(function(){
        $(document).ready(function() {

          // $("#sup").change(function(){
          // var address=$('#sup').find(":selected").attr('data-addrs');
          // $('#address').val(address);
          // });

          $("#sup").change(function() {
            var email = $('#sup').find(":selected").attr('data-email');
            $('#email').val(email);
          });


          $("#sup").change(function() {
            var mobile_no = $('#sup').find(":selected").attr('data-mobile');
            $('#mobile').val(mobile_no);
          });



        });
      </script>
      <!-- script end -->


  </section>

  <!-- model start -->
  <div class="container">
    <!-- Modal -->
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
                <select class="form-control" id="inputDistrict" name="sup_city">
                  <option value="">-- select one -- </option>
                </select>
              </div>

              <div class="col-md-12">
                <button type="submit" name="submit2" class="btn btn-primary" onclick="validatesuplier()">Submit</button>
                <input class="btn btn-primary" type="reset" value="Reset">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- model end -->

</div>
<?php include('include/footer.php'); ?>
<script type="text/javascript">
  1
  $('#class_id').change(function() {
    $("#subject_id").val('');
    $("#subject_id").children('option').hide();
    var class_id = $(this).val();
    $("#subject_id").children("option[data-id=" + class_id + "]").show();

  });
</script>
<script>
  $(function() {
    $(".datepicker").datepicker({
      format: 'dd/mm/yyyy'
    });
  });
</script>

<script type="text/javascript">
  $("body").on("click", ".remove", function() {
    $(this).parents(".control-group").remove();
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('div.mydiv').on("keyup", 'input[name^="rate"]', function(event) {
      var currentRow = $(this).closest('.subdiv');
      var quantity = currentRow.find('input[name^="quantity"]').val();


      //alert(quantity);
      var unitprice = currentRow.find('input[name^="rate"]').val();
      var gst = currentRow.find('input[name^="gst"]').val();
      var subtotal = Number(quantity) * Number(unitprice);
      var tax_amount = Number(subtotal) * (Number(gst) / 100);

      currentRow.find('input[name^="tax_amount"]').val(tax_amount);
      var total = Number(quantity) * Number(unitprice) + Number(tax_amount);
      var total = +currentRow.find('input[name^="total"]').val(total);
      // $('#subtotal').val(total);
      var sum = 0;
      $('.total').each(function() {
        sum += Number($(this).val());
      });
      $('#subtotal').val(sum);
      $('#final_total').val(sum);
      var sub_text = $('#subtotal').val();
      var sub_total = Number(sub_text);
      $("#final_total").val(sub_total);
      var tot_commi = 0;
      $('.tax_amount').each(function() {
        tot_commi += Number($(this).val());
      });
      $('#total_tax_amount').val(tot_commi);
    });
    var tot_commi = 0;
    $('.taxable_amount').each(function() {
      tot_commi += Number($(this).val());
    });
    $('#total_taxable_amount').val(tot_commi);
  });

  $('div.mydiv').on("keyup", 'input[name^="quantity"]', function(event) {
    var currentRow = $(this).closest('.subdiv');
    var quantity = currentRow.find('input[name^="quantity"]').val();

    var sale_price = currentRow.find('input[name^="rate"]').val();

    var total = parseInt(sale_price) * parseInt(quantity);
    currentRow.find('input[name^="total"]').val(total);

    var rate = parseInt(total) / parseInt(quantity);


    var total = +currentRow.find('input[name^="total"]').val();
    // $('#subtotal').val(total);
    var sum = 0;
    $('.total').each(function() {
      sum += Number($(this).val());
    });
    $('#subtotal').val(sum);
    $('#final_total').val(sum);

    var sub_text = $('#subtotal').val();
    var sub_total = Number(sub_text);
    $("#final_total").val(sub_total);

    var tot_commi = 0;
    $('.tax_amount').each(function() {
      tot_commi += Number($(this).val());
    });
    $('#total_tax_amount').val(tot_commi);
    var tot_commi = 0;
    $('.taxable_amount').each(function() {
      tot_commi += Number($(this).val());
    });
    $('#total_taxable_amount').val(tot_commi);

  });

  $('div.mydiv').on("keyup", 'input[name^="gst"]', function(event) {
    var currentRow = $(this).closest('.subdiv');
    var quantity = currentRow.find('input[name^="quantity"]').val();
    var sale_price = currentRow.find('input[name^="sale_price"]').val();
    var taxable = parseInt(sale_price) * parseInt(quantity);
    currentRow.find('input[name^="taxable_amount"]').val(taxable);

    var taxable_amount = currentRow.find('input[name^="taxable_amount"]').val();
    var gst = currentRow.find('input[name^="gst"]').val();
    var rate = Number(taxable_amount) * (Number(gst) / 100);

    var tax_amount = Number(taxable_amount) * (Number(gst) / 100);
    currentRow.find('input[name^="tax_amount"]').val(tax_amount);

    var total = parseInt(taxable_amount) + parseInt(tax_amount);
    currentRow.find('input[name^="total"]').val(total);

    var rate = parseInt(total) / parseInt(quantity);

    currentRow.find('input[name^="rate"]').val(rate);
    var total = +currentRow.find('input[name^="total"]').val();
    // $('#subtotal').val(total);
    var sum = 0;
    $('.total').each(function() {
      sum += Number($(this).val());
    });
    $('#subtotal').val(sum);
    $('#final_total').val(sum);

    var sub_text = $('#subtotal').val();
    var sub_total = Number(sub_text);
    $("#final_total").val(sub_total);

    var tot_commi = 0;
    $('.tax_amount').each(function() {
      tot_commi += Number($(this).val());
    });
    $('#total_tax_amount').val(tot_commi);
    var tot_commi = 0;
    $('.taxable_amount').each(function() {
      tot_commi += Number($(this).val());
    });
    $('#total_taxable_amount').val(tot_commi);
  });

  $('form').on("keyup", 'input[name="discount"]', function(argument) {
    var disc = $(this).val();
    var sub_text = $('#subtotal').val();


    var tax_percent = $('#gst_rate').val();
    var disc_amount = Number(sub_text) * (Number(disc) / 100);
    var sub_total = Number(sub_text) - Number(disc_amount);

    var tax_amount = Number(sub_total) * (Number(tax_percent) / 100);
    var taxable_amount = Number(sub_total) - Number(tax_amount);
    $("#total_tax_amount").val(tax_amount);
    $("#total_taxable_amount").val(taxable_amount);

    var sub_total1 = Number(sub_total) - Number(tax_amount);
    $("#final_total").val(sub_total1);
  });

  $('form').on("keyup", 'input[name="gst_rate"]', function(argument) {
    var tax_percent = $(this).val();
    var sub_text = $('#subtotal').val();


    var disc = $('#discount').val();
    var disc_amount = Number(sub_text) * (Number(disc) / 100);
    var sub_total = Number(sub_text) - Number(disc_amount);

    var tax_amount = Number(sub_total) * (Number(tax_percent) / 100);
    var taxable_amount = Number(sub_total) - Number(tax_amount);
    $("#total_tax_amount").val(tax_amount);
    $("#total_taxable_amount").val(taxable_amount);

    var sub_total1 = Number(sub_total) - Number(tax_amount);
    $("#final_total").val(sub_total1);
  });


  $('div.mydiv').on("change", 'select[name^="product_id"]', function(event) {
    var drop_services = $(this).val();
    var cnt = 0;
    $(".product_id").each(function() {
      if (drop_services == $(this).val()) {
        cnt++;
      }
    });
    if (cnt >= 2) {
      alert('Product already exists');
      return false;
    }
    var drop_services = $(this).val();
    var currentRow = $(this).closest('.subdiv');
    //console.log(currentRow);


    $.ajax({
      type: "POST",
      dataType: "json",
      url: 'ajax_product.php',
      data: {
        drop_services: drop_services
      },
      success: function(data) {
        //alert('data['product']['openning_stock']');
        //alert(data['product'][0].product_sprize);

        $(currentRow).find('#rate').val(data['product'][0].i_prize);
        $(currentRow).find('#aquantity').val(data['product'][0].openning_stock);
        var rate = date['product'][0].product_sprize;


        currentRow.find('input[name^="aquantity"]').val(data['product']['product_sprize']);
        currentRow.find('input[name^="quantity"]').val(1);

        currentRow.find('input[name^="sale_price"]').val(data['product']['product_sprize']);

        var quantity = currentRow.find('input[name^="quantity"]').val();

        var total = data['product']['product_sprize'];
        currentRow.find('input[name^="total"]').val(total);

        var rate = parseInt(total) / parseInt(quantity);

        currentRow.find('input[name^="rate"]').val(rate);

        //var total=+currentRow.find('input[name^="total"]').val(total);
        // $('#subtotal').val(total);
        var sum = 0;
        $('.total').each(function() {
          if ($(this).val() != '') {
            sum += parseInt($(this).val());
          }

        });

        var sub = $('#subtotal').val(sum);
        var fsub = $('#final_total').val(sum);

        var tot_commi = 0;
        $('.tax_amount').each(function() {
          tot_commi += Number($(this).val());
        });
        $('#total_tax_amount').val(tot_commi);
        var tot_commi = 0;
        $('.taxable_amount').each(function() {
          tot_commi += Number($(this).val());
        });
        $('#total_taxable_amount').val(tot_commi);
      }
    });

  });

  $('div.mydiv').on("change", 'select[name^="p_group_name"]', function(event) {
    var currentRow = $(this).closest('.subdiv');
    //console.log(currentRow);
    var group_id = $(this).val();
    currentRow.find('select[name^="product_id"]');
    currentRow.find('select[name^="product_id"]').html('<option value="" >Select one </option>');
    $.ajax({
      type: "POST",
      dataType: "json",
      url: 'search_product.php',
      data: {
        group_id: group_id
      },
      success: function(data) {
        // alert('hii');
        for (var i = 0; i < data['products'].length; i++) {
          //alert(data['products'][i][0]);
          var p_id = data['products'][i][0];
          var p_name = data['products'][i][3];
          // alert(data['products'][i][1]);
          //         var total = data['products'][i][0];
          // currentRow.find('input[name^="product_id"]').val(total);
          currentRow.find('select[name^="product_id"]').append('<option value="' + p_id + '" > ' + p_name + '</option>');
        }
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    $(".select2").select2();
  });
</script>
<script type="text/javascript">
  function GFG_Fun() {
    // alert(0);
    var x = document.getElementById("quantity").value;
    var x1 = document.getElementById("openning_stock").value;
    //alert(x1);
    if (x > x1) {

      alert("OUT OF STOCK");
    }
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>