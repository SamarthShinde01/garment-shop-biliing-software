<?php


session_start();
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<?php

$stmt = $db->prepare("SELECT * from sale WHERE saleid = ?");
$stmt->execute([$_GET['soid']]);
$result = $stmt->fetchAll();
foreach ($result as $key) {
  // code...

?>
  <div class="content-body mb-5 p-3">
    <div class="row">
      <div class="col-md-12">
        <div class="heading mb-4 d-flex align-items-center justify-content-between">
          <h3 class="mb-0">Edit Sale Order Details </h3>
          <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Edit </span></p>
        </div>
      </div>
    </div>
    <?php

    ?>
    <section>
      <div class="container">

        <!-- Edit sale order details form -->

        <div class="auto auto1">
          <form class="row" method="POST" action="app/sale-crud.php" name="soid" id="saleorder_form" autocomplete="OFF">

            <input type="hidden" class="form-control" name="soid" value="<?php echo $key['saleid']; ?>">

            <div class="mb-3 col-md-6">
              <label class="form-label">Invoice Number</label>
              <input type="text" class="form-control" name="ino" value="<?php echo $key['invoice_no']; ?>">
            </div>




            <div class="mb-3 col-md-6">
              <label class="form-label">Select Customer<span class="text-danger">*</span></label>
              <a class="text-primary" href="customer-add.php">Add customer</a>
              <?php
              $cnt = 1;

              $stmt = $db->prepare("select * from customer where delete_status='0' ");
              $stmt->execute();
              $record = $stmt->fetchAll();
              $i = 1; ?>

              <select class="form-select" aria-label="Default select example" type="text" name="cust" id="cust">
                <option value>--select customer--</option>

                <?php foreach ($record as $row) { ?>
                  <option <?php if ($key['cust_id'] == $row['cust_id']) {
                            echo 'selected';
                          } ?> value="<?php echo $row['cust_id'] ?>" data-addrs="<?php echo $row['cust_add'] ?>" data-email="<?php echo $row['cust_email'] ?>" data-mobile="<?php echo $row['cust_mobile'] ?>">
                    <?php echo $row['cust_fname'] . ' ' . $row['cust_lname']; ?>
                  </option>

                <?php }; ?>
              </select>


            </div>
            <?php $stmt = $db->prepare("select * from customer where delete_status='0' AND cust_id='" . $key['cust_id'] . "' ");
            $stmt->execute();
            $record = $stmt->fetchAll();
            foreach ($record as $res);
            ?>

            <div class="mb-3 col-md-6">
              <label class="form-label">Customer Email</label>
              <input type="text" class="form-control" value="<?php echo $row['cust_email']; ?>" name="email" id="email">
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Customer Mobile No</label>
              <input type="tel" class="form-control" value="<?php echo $row['cust_mobile']; ?>" name="mobile" id="mobile">
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Custmor Address</label>
              <textarea class="form-control" name="address" id="address"><?php echo $row['cust_add']; ?></textarea>
            </div>

            <?php  ?> <div class="form-group row">
              <div class="col-sm-1">
                Sr no.
              </div>



              <div class="col-sm-3">
                Select Item
              </div>
              <div class="col-sm-2">
                Quantity
              </div>

              <div class="col-sm-2">
                Sale Prize
              </div>


              <div class="col-sm-2">
                Total
              </div>
              <div class="col-sm-2">
                Action
              </div>

            </div>


            <div class="mydiv">
              <div class="form-group row control-group after-add-more subdiv align-items-center">
                <div class="mb-2 col-sm-1">

                  <div class="sr_no" name="">1</div>
                </div>

                <div class="mb-3 col">


                  <select name="product_id[]" class="form-control product_id">
                    <option value="">--Select Items--</option>
                    <?php
                    $sql = "SELECT * from product INNER JOIN category ON product.cate_id=category.cate_id ;";

                    $statement = $db->prepare($sql);

                    $statement->execute();
                    // print_r($statement);exit;
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option value="<?php echo $row['i_id']; ?>"><?php echo $row['i_name']; ?></option>
                    <?php } ?>
                  </select>

                </div>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="quantity1" name="quantity[]" placeholder="Qty">
                  <input type="hidden" class="form-control" id="aquantity" name="aquantity[]" placeholder="Qty">



                </div>

                <div class="col-sm-2">
                  <input type="text" class="form-control" id="rate" name="rate[]" placeholder="Sale Price">
                </div>
                <div class="col-sm-2">
                  <input type="text" class="form-control total" id="total" name="total[]" placeholder="Total" readonly="">
                </div>
                <!--     <div class="mb-3 col">
                                  
                                    <input type="text" class="form-control add" id="prize" name="prize[]" >
                                </div>
                                  <div class="mb-3 col">
                                   
                                    <input type="text" class="form-control" id="sale_quantity" name="sale_quantity[]" >
                                </div>
                                  <div class="mb-3 col">
                                    
                                    <input type="text" class="form-control" id="amount" onclick="total()" name="amount[]" >
                                </div> -->
                <div class="col">
                  <button class="btn btn-success add-more" type="button"><i class="fa fa-plus"></i></button>
                </div>
              </div>
              <?php $sql0 = "SELECT * from sale_item WHERE sale_id='" . $key['saleid'] . "'";

              $statement0 = $db->prepare($sql0);

              $statement0->execute();
              // print_r($statement0);exit;
              while ($row0 = $statement0->fetch(PDO::FETCH_ASSOC)) {
                //print_r($row0);
              ?>


                <div class="form-group control-group row subdiv align-items-center">

                  <div class="mb-3 col-sm-1">

                    <div class="sr_no">1</div>
                  </div>

                  <div class="mb-3 col">


                    <select name="product_id[]" class="form-control product_id">
                      <option value="">--Select Product--</option>
                      <?php
                      $sql = "SELECT * from product INNER JOIN category ON product.cate_id=category.cate_id ;";

                      $statement = $db->prepare($sql);

                      $statement->execute();
                      // print_r($statement);exit;
                      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                        <!--  <option value="<?php echo $row['i_id']; ?>"><?php echo $row['i_name']; ?></option> -->
                        <option <?php if ($row['i_id'] == $row0['itemname']) {
                                  echo 'selected';
                                } ?> value="<?php echo $row0['itemname'] ?>">
                          <?php echo $row['i_name']; ?>
                        </option>
                      <?php } ?>
                    </select>


                  </div>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="quantity1" name="quantity[]" value="<?php echo  $row0['itemquantity']; ?>" placeholder="Qty">
                    <input type="hidden" class="form-control" value="<?php echo  $row0['itemquantity']; ?>" id="aquantity" name="aquantity[]" placeholder="Qty">



                  </div>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="rate" name="rate[]" placeholder="Sale Price" value="<?php echo  $row0['itemprice']; ?>">
                  </div>
                  <div class="col-sm-2">
                    <input type="text" class="form-control total" id="total" value="<?php echo  $row0['itemprice']; ?>" name="total[]" placeholder="Total" readonly="">
                  </div>

                  <!-- <div class="mb-3 col">
                                      
                                        <input type="text" class="form-control add" id="prize" name="prize[]" >
                                    </div>

                                    <div class="mb-3 col">
                                       
                                        <input type="text" class="form-control" id="sale_quantity" name="sale_quantity[]" >
                                    </div>

                                    <div class="mb-3 col">
                                      
                                        <input type="text" class="form-control" id="amount" onclick="" name="amount[]" >
                                    </div>
 -->
                  <div class="col">
                    <button class="btn btn-danger remove" type="button"><i class="fa fa-trash-alt"></i></button>
                  </div>
                </div>



              <?php }
              ?>
            </div>


            <div class="form-group row control-group">
              <label class="col-sm-6 control-label">GST %</label>
              <div class="mb-3 col-sm-3">
                <input type="number" class="form-control" id="gst_rate" name="gst_rate" value="<?php echo $key['gst']; ?>" placeholder="GST %" value="0" min="0" max="99">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-6 control-label">Discount</label>
              <div class="mb-3 col-sm-3">
                <input type="number" class="form-control" id="discount" name="discount" value="<?php echo $key['discount']; ?>" placeholder="Discount %" value="0" min="0" max="100">
              </div>
            </div>
            <input type="hidden" name="subtotal" id="subtotal" class="form-control" placeholder="Subtotal" readonly="">


            <div class="form-group row">
              <label class="col-sm-6 control-label">Final Total</label>
              <div class="mb-3 col-sm-3">
                <input type="text" name="final_total" id="final_total" value="<?php echo  $key['amount']; ?>" class="form-control" placeholder="Total" readonly="">
              </div>
            </div>

            <div class="col-md-12">
              <button type="submit" name="update" class="btn btn-primary" onclick="validatesaleorder()">Update</button>
              <input class="btn btn-primary" type="reset" value="Reset"><br><br>


            </div>
          </form>

        <?php } ?>




        <div class="copy hide" style="display:none;">
          <div class="form-group control-group row subdiv align-items-center">

            <div class="mb-3 col-sm-1">

              <div class="sr_no">1</div>
            </div>

            <div class="mb-3 col">


              <select name="product_id[]" class="form-control product_id">
                <option value="">--Select Product--</option>
                <?php
                $sql = "SELECT * from product INNER JOIN category ON product.cate_id=category.cate_id ;";

                $statement = $db->prepare($sql);

                $statement->execute();
                // print_r($statement);exit;
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $row['i_id']; ?>"><?php echo $row['i_name']; ?></option>
                <?php } ?>
              </select>


            </div>

            <div class="col-sm-2">
              <input type="text" class="form-control" id="quantity1" name="quantity[]" placeholder="Qty">
              <input type="hidden" class="form-control" id="aquantity" name="aquantity[]" placeholder="Qty">



            </div>

            <div class="col-sm-2">
              <input type="text" class="form-control" id="rate" name="rate[]" placeholder="Sale Price">
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control total" id="total" name="total[]" placeholder="Total" readonly="">
            </div>

            <!-- <div class="mb-3 col">
                                      
                                        <input type="text" class="form-control add" id="prize" name="prize[]" >
                                    </div>

                                    <div class="mb-3 col">
                                       
                                        <input type="text" class="form-control" id="sale_quantity" name="sale_quantity[]" >
                                    </div>

                                    <div class="mb-3 col">
                                      
                                        <input type="text" class="form-control" id="amount" onclick="" name="amount[]" >
                                    </div>
 -->
            <div class="col">
              <button class="btn btn-danger remove" type="button"><i class="fa fa-trash-alt"></i></button>
            </div>
          </div>
        </div>


        <!-- script for customer details automatically display -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

        <script type="text/javascript">
          //$(function(){
          $(document).ready(function() {

            $("#cust").change(function() {
              var address = $('#cust').find(":selected").attr('data-addrs');
              $('#address').val(address);
            });

            $("#cust").change(function() {
              var email = $('#cust').find(":selected").attr('data-email');
              $('#email').val(email);
            });


            $("#cust").change(function() {
              var mobile_no = $('#cust').find(":selected").attr('data-mobile');
              $('#mobile').val(mobile_no);
            });



          });
        </script>
        <!-- script end -->


        </div>

    </section>







    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>






    <?php include('include/footer.php'); ?>
    <script type="text/javascript">
      $(".add-more").on('click', function() {

        var html = $(".copy").html();
        $(".after-add-more").after(html);
        $(".after-add-more").next().find('select[name^="product_id"]').select2();
        show_no();
      });

      $("body").on("click", ".remove", function() {
        $(this).parents(".control-group").remove();
        show_no();
      });

      function show_no() {
        var row_cnt = 0;
        $(".sr_no").each(function() {
          row_cnt++;
          $(this).html(row_cnt);
        });
      }
    </script>
    <script type="text/javascript">
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
          var x = parseInt(quantity);
          var quantityq = currentRow.find('input[name^="aquantity"]').val();
          var x1 = parseInt(quantityq);
          //alert(x1);
          if (x > x1) {
            alert('Not Enter Value Greather than stock' + '-' + x1);
            location.reload();
          }

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
        var tot_commi = 0;
        $('.taxable_amount').each(function() {
          tot_commi += Number($(this).val());
        });
        $('#total_taxable_amount').val(tot_commi);
      });

      $('div.mydiv').on("keyup", 'input[name^="quantity"]', function(event) {
        var currentRow = $(this).closest('.subdiv');
        var quantity = currentRow.find('input[name^="quantity"]').val();
        var x = parseInt(quantity);
        var quantityq = currentRow.find('input[name^="aquantity"]').val();
        var x1 = parseInt(quantityq);
        //alert(x1);
        if (x > x1) {
          alert('Not Enter Value Greather than stock' + '-' + x1);
          location.reload();
        }

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
        /*var disc = $(this).val();
        var sub_text = $('#subtotal').val();
        var disc_amount=Number(sub_text)*(Number(disc)/100);
        $("#view_discount").val(disc);
        var tax_percent = $('#gst_rate').val();
        var tax_amount=Number(sub_text)*(Number(tax_percent)/100);
        var taxable_amount=Number(sub_text)-Number(tax_amount);
        $("#total_tax_amount").val(tax_amount);
        $("#total_taxable_amount").val(taxable_amount);

        var disc = $('#discount').val();
        var sub_total = Number(taxable_amount)- Number(disc_amount) ; 
        $("#final_total").val(sub_total);*/

        var disc = $(this).val();
        var sub_text = $('#subtotal').val();


        var tax_percent = $('#gst_rate').val();


        var tax_amount = Number(sub_text) * (Number(tax_percent) / 100);
        var taxable_amount = Number(sub_text) + Number(tax_amount);
        var disc_amount = Number(taxable_amount) * (Number(disc) / 100);
        var sub_total = Number(taxable_amount) - Number(disc_amount);
        $("#total_tax_amount").val(tax_amount);
        $("#total_taxable_amount").val(taxable_amount);


        var sub_total1 = Number(sub_total);
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

        var sub_total1 = Number(sub_total) + Number(tax_amount);
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
            // alert('hello');
            // alert(data['product'][0].i_prize);
            // var rate=date['product'][0].i_prize;
            $(currentRow).find('#rate').val(data['product'][0].i_prize);

            var rate = date['product'][0].i_prize;
            // currentRow.find('input[name^="sale_price"]').val(rate);



            //currentRow.find('input[name^="quantity"]').val(1);
            currentRow.find('input[name^="aquantity"]').val(data['product']['openning_stock']);
            // currentRow.find('input[name^="rate"]').val(data['product']['i_']);
            // currentRow.find('input[name^="rate"]').val(data['product']['i_prize']);
            /*x= currentRow.find('input[name^="quantity"]').val(data['product']['openning_stock']);
            x1= currentRow.find('input[name^="quantity"]').attr('max',data['product']['openning_stock']);*/


            currentRow.find('input[name^="quantity"]').val(0);
            currentRow.find('input[name^="quantity"]').attr('max', data['product']['openning_stock']);
            //$("#quantity").attr('maxlength','6');

            //currentRow.find('input[name^="quantity"]')..attr('maxlength',2);

            //$('input[name="quantity"]').attr('maxlength',1);

            /* currentRow.find('input[name^="openning_stock"]').maxval(data['product']['openning_stock']);
             */
            currentRow.find('input[name^="sale_price"]').val(data['product']['i_prize']);
            var quantity = currentRow.find('input[name^="quantity"]').val();

            var total = data['product']['i_prize'];
            currentRow.find('input[name^="total"]').val(total);

            var rate = parseInt(total) / parseInt(quantity);
            //currentRow.find('input[name^="rate"]').val(rate);
            var rate = data['product']['product_sprize'];
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
        currentRow.find('select[name^="product_id"]').select2();
        currentRow.find('select[name^="product_id"]').html('<option value="" >Select one </option>');
        $.ajax({
          type: "POST",
          dataType: "json",
          url: 'ajax_product.php',
          data: {
            group_id: group_id
          },
          success: function(data) {
            // alert('hiii');
            for (var i = 0; i < data['products'].length; i++) {
              var p_id = data['products'][i][0];
              var p_name = data['products'][i][2];
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
      $('#quantity').keyup(function() {
        alert(0);
        if ($(this).val() > 2) {
          alert("No numbers above 100");
          $(this).val('100');
        }
      });



      function GFG_Fun() {
        alert();

        var x = document.getElementById("quantity1").value;

        var x1 = document.getElementById("quantity1").maxlength;
        //alert(x1);
        if (x > x1) {

          alert("OUT OF STOCK");
        }
        $(document).ready(function() {
          $('#quantity1').on('keydown keyup change', function() {
            var char = $(this).val();
            var charLength = $(this).val().length;
            alert(char);
            if (charLength < minLength) {
              $('#warning-message').text('Length is short, minimum ' + minLength + ' required.');
            } else if (charLength > maxLength) {
              $('#warning-message').text('Length is not valid, maximum ' + maxLength + ' allowed.');
              $(this).val(char.substring(0, maxLength));
            } else {
              $('#warning-message').text('');
            }
          });
        });
      }
    </script>

    <script type="text/javascript">
      $(function() {
        $(document).ready(function() {

          $("#cust").change(function() {
            var address = $('#cust').find(":selected").attr('data-addrs');
            $('#address').val(address);
          });

          $("#cust").change(function() {
            var email = $('#cust').find(":selected").attr('data-email');
            $('#email').val(email);
          });


          $("#cust").change(function() {
            var mobile_no = $('#cust').find(":selected").attr('data-mobile');
            $('#mobile').val(mobile_no);
          });

        });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>