 <?php
  // error_reporting(E_ALL);

  session_start();
  if (!isset($_SESSION['id'])) {
    header('location:../index.php');
  }
  ?>
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 <?php include('include/sidebar.php'); ?>
 <?php include('include/header.php'); ?>

 <!-- <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 -->
 <!-- <script src="script.js"></script> -->




 <div class="auto">
   <form class="row" method="POST" action="app/sale-crud.php" name="soid" id="saleorder_form" enctype="multipart/form-data">

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


       <label class="form-label">Select Customer<span class="text-danger">*</span><small data-bs-toggle="modal" data-bs-target="#exampleModal" class="text-danger">Add Customer</small></label>


       <select class="form-select cust select2" name="cust" id="cust">
         <?php
          $cnt = 1;

          $stmt = $db->prepare("select * from customer");
          $stmt->execute();
          $record = $stmt->fetchAll();
          $i = 1; ?>


         <option value=""></option>
         <?php foreach ($record as $row) { ?>
           <option value=" <?php echo $row['cust_id'] ?>" data-addrs="<?php echo $row['cust_add'] ?>" data-email="<?php echo $row['cust_email'] ?>" data-mobile="<?php echo $row['cust_mobile'] ?>">
             <?php echo $row['cust_fname'] . ' ' . $row['cust_lname']; ?> <?php }; ?>
           </option>

       </select>
     </div>
     <div class="mb-3 col-md-6">
       <label class="form-label ">Customer Number<span class="text-danger">*</span></label>
       <input type="tel" class="form-control num" name="mobile" id="mobile">
     </div>
     <div class="mb-3 col-md-6">
       <label class="form-label ">Customer Email<span class="text-danger">*</span></label>
       <input type="tel" class="form-control " name="email" id="email">
     </div>
     <div class="mb-3 col-md-6">
       <label class="form-label ">Customer Address<span class="text-danger">*</span></label>
       <input type="tel" class="form-control " name="address" id="address">
     </div>



     <!-- For Multiple select -->

     <div class="form-group row">
       <div class="col-sm-1" style="margin-left:70px;">
         Sr no.
       </div>

       <div class="col-sm-3">
         Select Items
       </div>

       <div class="col-sm-1">
         Units
       </div>
       <div class="col-sm-2">
         Sale Price
       </div>
       <div class="col-sm-2">
         Total
       </div>
       <div class="col-sm-1">
         Action
       </div>

     </div>
     <div class="mydiv">
       <div class="form-group row control-group after-add-more subdiv">
         <div class="col-sm-1 sr_no" style="margin-left:70px; margin-top:10px;">1</div>
         <div class="col-sm-3" style="margin-top: 10px;">
           <div class="col-sm-12">
             <select name="product_id[]" class="form-control product_id select2" required>
               <option value="">--Select Item--</option>


               <?php
                $sql = "SELECT * from product INNER JOIN category ON product.cate_id=category.cate_id ;";
                $statement = $db->prepare($sql);
                $statement->execute();
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                 <option value="<?php echo $row['i_id']; ?>"><?php echo $row['i_name']; ?></option>
               <?php } ?>
             </select>

           </div>
         </div>

         <div class="col-sm-1" style="margin-top: 10px;">
           <input type="text" class="form-control" id="quantity1" name="quantity[]" placeholder="Qty" required onblur="GFG_Fun();">
           <input type="hidden" class="form-control" id="aquantity" name="aquantity[]" placeholder="Qty" required onblur="GFG_Fun();" pattern="^[0-9]+$" readonly="">
         </div>

         <div class="col-sm-2" style="margin-top: 10px;">
           <input type="text" class="form-control" id="rate" name="rate[]" placeholder="Sale Price" required>
         </div>
         <div class="col-sm-2" style="margin-top: 10px;">
           <input type="text" class="form-control total" id="total" name="total[]" placeholder="Total" readonly="">
         </div>

         <div class="col-sm-2" style="margin-top: 10px;">
           <button class="btn btn-success add-more" type="button"><i class="fa fa-plus"></i></button>
         </div>
       </div>

     </div>
     <div class="form-group row control-group" style="margin-top: 10px;">
       <label class="col-sm-6 control-label">GST %</label>
       <div class="col-sm-3">
         <input type="number" class="form-control" id="gst_rate" name="gst_rate" placeholder="GST %" value="0" min="0" max="99">
       </div>
     </div>
     <div class="form-group row" style="margin-top: 10px;">
       <label class="col-sm-6 control-label">Discount</label>
       <div class="col-sm-3">
         <input type="number" class="form-control" id="discount" name="discount" placeholder="Discount %" value="0" min="0" max="100">
       </div>
     </div>
     <input type="hidden" name="subtotal" id="subtotal" class="form-control" placeholder="Subtotal" readonly="">


     <div class="form-group row" style="margin-top: 10px;">
       <label class="col-sm-6 control-label"> Final Total</label>
       <div class="col-sm-3">
         <input type="text" name="final_total" id="final_total" class="form-control" placeholder="Total" readonly="">
       </div>
     </div>
     <div div class="cmb-3 col-md-6" style="margin-left: 100px;">
       <button type="submit" name="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30" id="submit_check">Submit</button>
       <p id="GFG_DOWN" style="color: green;">
     </div>
   </form>
   <div class="copy hide" style="display:none;">
     <div class="form-group control-group row subdiv">
       <div class="col-sm-1 sr_no" style="margin-left:70px; margin-top:10px;"></div>
       <div class="col-sm-3" style="margin-top: 10px;">
         <div class="col-sm-12">
           <select name="product_id[]" class="form-control product_id" required>
             <option value="">--Select Item--</option>
             <?php
              $sql = "SELECT * from product INNER JOIN category ON product.cate_id=category.cate_id ;";
              $statement = $db->prepare($sql);
              $statement->execute();
              while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
               <option value="<?php echo $row['i_id']; ?>"><?php echo $row['i_name']; ?></option>
             <?php } ?>
           </select>
         </div>
       </div>

       <div class="col-sm-1" style="margin-top: 10px;">
         <input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Qty">
         <!--  <input type="text" class="form-control" id="openning_stock" name="openning_stock[]" placeholder="Qty" required  onblur="GFG_Fun();" pattern="^[0-9]+$">
                      -->
         <input type="hidden" class="form-control" id="aquantity" name="aquantity[]" placeholder="Qty" required pattern="^[0-9]+$" readonly="">

       </div>

       <div class="col-sm-2" style="margin-top: 10px;">
         <input type="text" class="form-control" id="rate" name="rate[]" placeholder="Sale Price" required>
       </div>
       <div class="col-sm-2" style="margin-top: 10px;">
         <input type="text" class="form-control total" id="total" name="total[]" placeholder="Total" readonly="">
       </div>
       <div class="col-sm-2" style="margin-top:10px">
         <button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button>
       </div>
     </div>
   </div>
 </div>

 <div class="container">

   <!-- <button type="submit" onclick="location.href='csvfile.php'" class="btn btn-primary">Add Data</button> -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <h1 class="modal-title fs-5" id="exampleModalLabel">Add Customer Details</h1>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <!-- Add Customer details form -->

           <form class="row" method="POST" action="app/cust-crud.php" id="customer_form">
             <div class="mb-3 col-md-6">
               <label class="form-label">First Name <span class="text-danger">*</span></label>
               <input type="text" class="form-control" name="fname">
             </div>
             <div class="mb-3 col-md-6">
               <label class="form-label">Last Name <span class="text-danger">*</span></label>
               <input type="text" class="form-control" name="lname">
             </div>
             <div class="mb-3 col-md-6">
               <label class="form-label">Email</label>
               <input type="email" class="form-control" name="email">
             </div>
             <div class="mb-3 col-md-6">
               <label class="form-label">Mobile Number</label>
               <input type="tel" class="form-control" name="mobile">
             </div>
             <div class="mb-3 col-md-6">
               <label class="form-label">Address</label>
               <textarea class="form-control" name="address"></textarea>
             </div>
             <div class="mb-3 col-md-6">
               <label class="form-label">Date Of Birth</label>
               <input type="date" class="form-control" name="cdate">
             </div>

             <div class="mb-3 col-md-6">
               <label class="form-label" for="inputState">State</label>
               <select class="form-control" id="inputState" name="state">
                 <option value="">--Select State--</option>
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
               <select class="form-control" id="inputDistrict" name="cust_city">
                 <option value="">--Select District </option>
               </select>
             </div>

             <div class="col-md-12">
               <button type="submit" name="submit2" class="btn btn-primary" onclick="submitcust()">Submit</button>
               <input class="btn btn-primary" type="reset" value="Reset">
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>

 <?php include('include/footer.php'); ?>

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
         $(currentRow).find('#rate').val(data['product'][0].product_sprize);
         $(currentRow).find('#aquantity').val(data['product'][0].openning_stock);
         var rate = date['product'][0].product_sprize;
         // currentRow.find('input[name^="sale_price"]').val(rate);



         //currentRow.find('input[name^="quantity"]').val(1);
         // currentRow.find('input[name^="aquantity"]').val(data['product']['openning_stock']);
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
         currentRow.find('input[name^="sale_price"]').val(data['product']['product_sprize']);
         var quantity = currentRow.find('input[name^="quantity"]').val();

         var total = data['product']['product_sprize'];
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
         //  alert('hiii');
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
     //  alert(0);
     if ($(this).val() > 2) {
       alert("No numbers above 100");
       $(this).val('100');
     }
   });



   function GFG_Fun() {
     //  alert();

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
         //  alert(char);
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

 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>