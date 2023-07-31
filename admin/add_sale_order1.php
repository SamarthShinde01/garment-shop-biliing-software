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


             <select class="form-select cust " name="cust" id="cust">
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



         <div class="form-group row">
             <div class="col-sm-1">
                 Sr no.
             </div>

             <div class="col-sm-3">
                 Select Product
             </div>

             <div class="col-sm-1">
                 Quantity
             </div>
             <div class="col-sm-2">
                 Sale Price
             </div>
             <div class="col-sm-2">
                 Total
             </div>
             <div class="col-sm-2">
                 Action
             </div>

         </div>
         <div class="mydiv">
             <div class="form-group row control-group after-add-more subdiv">
                 <div class="col-sm-1 sr_no">1</div>
                 <div class="col-sm-3">
                     <div class="col-sm-12">
                         <select name="product_id[]" class="form-control product_id select2" required>
                             <option value="">--Select Product--</option>
                             <?php
                                $cnt = 1;

                                $stmt = $db->prepare("select * from product");
                                $stmt->execute();
                                $record = $stmt->fetchAll();
                                $i = 1; ?>
                             <?php foreach ($record as $row) { ?>
                                 <option value=" <?php echo $row['i_id'] ?>">
                                     <!-- data-prize="<?php echo $row['i_prize'] ?>"> -->
                                     <?php echo $row['i_name']; ?> <?php }; ?>
                                 </option>

                         </select>
                     </div>
                 </div>

                 <div class="col-sm-1">
                     <input type="text" class="form-control" id="quantity1" name="quantity[]" placeholder="Qty" required onblur="GFG_Fun();" pattern="^[0-9]+$" max="">
                     <input type="hidden" class="form-control" id="aquantity" name="aquantity[]" placeholder="Qty" required onblur="GFG_Fun();" pattern="^[0-9]+$" readonly="">


                 </div>

                 <div class="col-sm-2">
                     <input type="text" class="form-control" id="rate" name="rate[]" placeholder="Sale Price" required>
                 </div>
                 <div class="col-sm-2">
                     <input type="text" class="form-control total" id="total" name="total[]" placeholder="Total" readonly="">
                 </div>

                 <div class="col-sm-2">
                     <button class="btn btn-primary add-more" type="button"><i class="fa fa-plus"></i></button>
                 </div>
             </div>


             <div class="form-group row control-group">
                 <label class="col-sm-1">GST %</label>
                 <div class="col-sm-3">
                     <input type="number" class="form-control" id="gst_rate" name="gst_rate" placeholder="GST %" value="0" min="0" max="99">
                 </div>
             </div>
             <div class="form-group row">
                 <label class="col-sm-6 control-label">Discount</label>
                 <div class="col-sm-3">
                     <input type="number" class="form-control" id="discount" name="discount" placeholder="Discount %" value="0" min="0" max="100">
                 </div>
             </div>
             <input type="text" name="subtotal" id="subtotal" class="form-control" placeholder="Subtotal" readonly="">
         </div>


         <div class="form-group row">
             <label class="col-sm-6 control-label"> Final Total</label>
             <div class="col-sm-3">
                 <input type="text" name="final_total" id="final_total" class="form-control" placeholder="Total" readonly="">
             </div>
         </div>

         <button type="submit" name="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30" id="submit_check">Submit</button>
         <p id="GFG_DOWN" style="color: green;">

     </form>
     <div class="copy hide" style="display:none;">
         <div class="form-group control-group row subdiv">
             <div class="col-sm-1 sr_no"></div>
             <div class="col-sm-3">
                 <div class="col-sm-12">
                     <select name="product_id[]" class="form-control product_id" required>
                         <option value="">--Select Product--</option>
                         <?php
                            $cnt = 1;

                            $stmt = $db->prepare("select * from product");
                            $stmt->execute();
                            $record = $stmt->fetchAll();
                            $i = 1; ?>
                         <?php foreach ($record as $row) { ?>
                             <option value=" <?php echo $row['i_id'] ?>">
                                 <!-- data-prize="<?php echo $row['i_prize'] ?>"> -->
                                 <?php echo $row['i_name']; ?> <?php }; ?>
                             </option>
                     </select>
                 </div>
             </div>

             <div class="col-sm-1">
                 <input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Qty" pattern="^[0-9]+$" max="">
                 <!--  <input type="text" class="form-control" id="openning_stock" name="openning_stock[]" placeholder="Qty" required  onblur="GFG_Fun();" pattern="^[0-9]+$">
                      -->
                 <input type="hidden" class="form-control" id="aquantity" name="aquantity[]" placeholder="Qty" required pattern="^[0-9]+$" readonly="">

             </div>

             <div class="col-sm-2">
                 <input type="text" class="form-control" id="rate" name="rate[]" placeholder="Sale Price" required>
             </div>
             <div class="col-sm-2">
                 <input type="text" class="form-control total" id="total" name="total[]" placeholder="Total" readonly="">
             </div>
             <div class="col-sm-2">
                 <button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button>
             </div>
         </div>
     </div>
 </div>
 </div>

 </div>
 </div>


 <script src="../assets/js/jquery-3.3.1.min.js"></script>


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
             url: 'sale-crud.php',
             data: {
                 drop_services: drop_services
             },
             primary: function(data) {
                 //currentRow.find('input[name^="quantity"]').val(1);
                 currentRow.find('input[name^="aquantity"]').val(data['product']['openning_stock']);

                 /*x= currentRow.find('input[name^="quantity"]').val(data['product']['openning_stock']);
                 x1= currentRow.find('input[name^="quantity"]').attr('max',data['product']['openning_stock']);*/

                 currentRow.find('input[name^="quantity"]').val(0);
                 currentRow.find('input[na bme^="quantity"]').attr('max', data['product']['openning_stock']);
                 //$("#quantity").attr('maxlength','6');

                 //currentRow.find('input[name^="quantity"]')..attr('maxlength',2);

                 //$('input[name="quantity"]').attr('maxlength',1);

                 /* currentRow.find('input[name^="openning_stock"]').maxval(data['product']['openning_stock']);
                  */
                 currentRow.find('input[name^="sale_price"]').val(data['product']['unit_price']);
                 var quantity = currentRow.find('input[name^="quantity"]').val();

                 var total = data['product']['unit_price'];
                 currentRow.find('input[name^="total"]').val(total);

                 var rate = parseInt(total) / parseInt(quantity);
                 //currentRow.find('input[name^="rate"]').val(rate);
                 var rate = data['product']['unit_price'];
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
             url: 'search_product.php',
             data: {
                 group_id: group_id
             },
             primary: function(data) {
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
     function total() {
         var a = parseInt(document.getElementById('prize').value);
         var b = parseInt(document.getElementById('sale_quantity').value);
         var t = a * b;
         document.getElementById('final_total').value = t;
         var total = t;
     }
 </script>
 <script>
     function total1() {
         var a = parseInt(document.getElementById('prize').value);
         var b = parseInt(document.getElementById('sale_quantity').value);
         var t = a * b;
         document.getElementById('final_total1').value = t;
         var total = t;
     }
 </script>
 </div>




 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

 <script>
     function Product(eve) {

         var val = $(eve).val();
         var current = $(eve).closest('.auto');

         $.ajax({

             type: "POST",

             url: "app/sale-crud.php",

             data: "i_id=" + val,
             dataType: 'JSON',
             // 
             primary: function(response) {
                 //alert(response['display2'][0].country_name);

                 $("#product_loading").find('.add').val(response['display1'][0].i_prize);
                 // $("#product_loading").fadeIn(500).html(data);


             }

         });

     }
 </script>
 <script>
     function Product1(eve) {

         var val = $(eve).val();
         var current = $(eve).closest('.auto');

         $.ajax({

             type: "POST",

             url: "app/sale-crud.php",

             data: "i_id=" + val,
             dataType: 'JSON',
             // 
             primary: function(response) {
                 //alert(response['display2'][0].country_name);

                 $("#product_loading1").find('.add').val(response['display1'][0].i_prize);
                 // $("#product_loading").fadeIn(500).html(data);


             }

         });

     }
 </script>
 <!-- <script>

function Product(eve) {

    var val=$(eve).val();
     var current=$(eve).closest('.auto');
     
 $.ajax({ 

type: "POST",

url: "app/product-crud.php",

data: "i_id="+val,
dataType:'JSON',
// 
primary: function(response){
    alert('hello');

    $(current).find('.prize').val(response['display1'][0].i_prize);
    

    
 

 }

});   

}
</script> -->

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



 <?php include('include/footer.php'); ?>