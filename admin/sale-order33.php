<?php


session_start();
if(!isset($_SESSION['id'])){
    header('location:../index.php');
}

?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <?php include('include/sidebar.php');?>
    <?php include('include/header.php');?>
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
             <div class="card-header">
                                 <a href="add_sale_order.php"><button class="btn btn-primary" type="submit" name=""> Add Order </button></a>
                                               </div>
                    <section>
                        <div class="container">
                     <!-- Modal -->
                    <button type="submit" class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button>
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
                                            return substr(str_shuffle($str_result),
                                                               0, $length_of_string);
                                        }
                                         
                                        // This function will generate
                                        // Random string of length 10
                                        $new=random_strings(7);


                                                 
                                                     ?>
                                    <input type="text" class="form-control" readonly name="invoice_no" value="<?php echo $new; ?>" >
                                </div>
                                
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label">Invoice date<span class="text-danger">*</span></label>
              <input type="date" class="form-control" autocomplete="off"  name="idate" value="<?php echo date('Y-m-d'); ?>" />
                                </div>

                               

                               <div class="mb-3 col-md-6">
                               
                                    <label class="form-label">Select Customer<span class="text-danger">*</span></label>
                                    <a class="text-danger"href="customer-add.php">Add Customer</a>


                             <select class="form-select cust "  name="cust" id="cust" >
                                        <?php
                                                 $cnt=1;

                                    $stmt = $db->prepare("select * from customer");
                                   $stmt->execute();
                                   $record = $stmt->fetchAll();
                                   $i=1; ?>
                                   
                                    
                                        <option value=""></option>
                                        <?php foreach ($record as $row) 
                                         { ?>
                                            <option value=" <?php echo $row['cust_id']?>"
                                                data-addrs="<?php echo $row['cust_add']?>"
                                                 data-email="<?php echo $row['cust_email']?>"
                                              data-mobile="<?php echo $row['cust_mobile']?>">
                                            <?php echo $row['cust_fname'].' '. $row['cust_lname']; ?>  <?php };?>
                                        </option>

                                     </select>
                                </div>
                                   <div class="mb-3 col-md-6">
                                    <label class="form-label ">Customer Number<span class="text-danger">*</span></label>
                                    <input type="tel"  class="form-control num"  name="mobile" id="mobile" >
                                  </div>
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label ">Customer Email<span class="text-danger">*</span></label>
                                    <input type="tel"  class="form-control "  name="email" id="email" >
                                  </div>
                                   <div class="mb-3 col-md-6">
                                    <label class="form-label ">Customer Address<span class="text-danger">*</span></label>
                                    <input type="tel"  class="form-control "  name="address" id="address" >
                                  </div>

                                 
                       <div class="mydiv">
                      <div class="form-group row control-group after-add-more subdiv align-items-center">
                         <div class="mb-3 col">
                          <label class="form-label">Sr no</label>
                       <div class="sr_no">1</div>
                             </div>
                               <div class="mb-3 col">
                                    <label class="form-label">Select Item<span class="text-danger">*</span></label>
                                     <?php
                                                 $cnt=1;

                                    $stmt = $db->prepare("select * from product");
                                   $stmt->execute();
                                   $record = $stmt->fetchAll();
                                   $i=1; ?>
                                   
                                    <select class="form-select" aria-label="Default select example" type="text"  onchange="Product1(this);" name="product11[]">
                                        <option></option>
                                        <?php foreach ($record as $row) 
                                         { ?>
                                            <option value=" <?php echo $row['i_id']?>">
                                                 <!-- data-prize="<?php echo $row['i_prize']?>"> -->
                                            <?php echo $row['i_name']; ?>  <?php };?>
                                        </option>

                                     </select>

                                        </div>
                                      <div class="mb-3 col" id="product_loading1">
                                    <label class="form-label ">product Prize<span class="text-danger">*</span></label></label>
                                    <input type="text" class="form-control add" id="prize" name="prize[]" >
                                  </div>
                             <div class="mb-3 col">
                              <label class="form-label">Quantity<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="sale_quantity" name="sale_quantity[]" >
                               </div>
                                <div class="form-group row">
                                  <label class="col-sm-6 control-label">  Total</label>
                                  <div class="col-sm-3">
                                      <input type="text" name="final_total"  id="final_total" onclick="total()"  class="form-control" placeholder="Total" readonly="">
                                  </div>
                             </div>

                               <div class="col">
                              <button class="btn btn-primary add-more" type="button"><i class="fa fa-plus"></i></button></div>
                            </div>
                                </div>
                                 </div>
                                       <div class="form-group row control-group">
                                    <label class="col-sm-6 control-label">GST %</label>
                                    <div class="col-sm-3">
                                      <input type="number" class="form-control" id="gst_rate" name="gst_rate" placeholder="GST %" value="0" min="0" max="99">
                                    </div>
                              </div>
                                <div class="form-group row">
                                  <label class="col-sm-6 control-label">Discount</label>
                                  <div class="col-sm-3">
                                      <input type="number" class="form-control" id="discount" name="discount" placeholder="Discount %" value="0"  min="0" max="100">
                                  </div>
                             </div>
                                <input type="hidden" name="subtotal" id="subtotal" class="form-control" placeholder="Subtotal" readonly="">

                             
                             <div class="form-group row">
                                  <label class="col-sm-6 control-label"> Final Total</label>
                                  <div class="col-sm-3">
                                      <input type="text" name="final_total"  id="final_total" onclick="total()"  class="form-control" placeholder="Total" >
                                  </div>
                             </div>


                      <div class="copy hide" style="display:none;">
                         <div class="form-group control-group row subdiv align-items-center">
                            <div class="mb-3 col">
                             <div class="sr_no"></div>
                              </div>
                               
                               <div class="mb-3 col">
                                    <label class="form-label">Select Item<span class="text-danger">*</span></label>
                                     <?php
                                                 $cnt=1;

                                    $stmt = $db->prepare("select * from product");
                                   $stmt->execute();
                                   $record = $stmt->fetchAll();
                                   $i=1; ?>
                                   
                                    <select class="form-select" aria-label="Default select example"type="text"  onchange="Product(this);" name="product11[]">
                                        <option></option>
                                        <?php foreach ($record as $row) 
                                         { ?>
                                            <option value=" <?php echo $row['i_id']?>">
                                                 <!-- data-prize="<?php echo $row['i_prize']?>"> -->
                                            <?php echo $row['i_name']; ?>  <?php };?>
                                        </option>

                                     </select>

                                        </div>
                                      <div class="mb-3 col" id="product_loading">
                                    <label class="form-label ">product Prize<span class="text-danger">*</span></label></label>
                                    <input type="text" class="form-control add" id="prize" name="prize[]" >
                                  </div>
                             <div class="mb-3 col">
                              <label class="form-label">Quantity<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="sale_quantity" name="sale_quantity[]" >
                               </div>
                              
                              <div class="col">
                              <button class="btn btn-danger remove" type="button"><i class="fa fa-trash-alt"></i></button>
                             </div>
                            </div>
                           </div>
                              
                                <!--  <div class="mb-3 col-md-6">
                                    <label class="form-label">Quantity<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="sale_quantity" name="sale_quantity" >
                                </div> -->
                                 <!-- <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount</label>
                                       
                    <input type="text" class="form-control" id="amount" onclick="total()"  name="amount"  >
                                </div> -->
                           
                                <div class="col-md-12">
                                    <button type="submit"  name="submit" class="btn btn-primary" onclick="validatesaleorder()">Submit</button>
                                    <input class="btn btn-primary" type="reset" value="Reset"><br><br>
                                    <button onclick="location.href = 'customer-add.php';" type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal" aria-label="Close">Add Customer</button>
                                                          </div>


                                                        <!-- For Multiple select -->
                   
                          
                            </form>
                                  </div>

                          <script>
                                    function total()
                                                {
                                                    var a = parseInt(document.getElementById('prize').value);
                                                    var b = parseInt(document.getElementById('sale_quantity').value);
                                                    var t = a*b;
                                                    document.getElementById('final_total').value=t;
                                                    var total=t;
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
                                        <th>Contact No.</th>
                                        <th>Address</th>
                                       <!--  <th>Quantity</th> -->
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                    <?php
                                        
                                  
                                                         $cnt=1;
  $stmt = $db->prepare("SELECT * from sale INNER JOIN customer ON sale.cust_id=customer.cust_id ;");
                                                                       $stmt->execute();
                                                                       $record = $stmt->fetchAll();
                                                                       $i=1;
                                                                       foreach ($record as $row) 
                                                                         { 
                                                                          ?>

                                    <!--Fetch the Records -->
                                                        <tr>
                                                            <td><?php echo $cnt;?></td>
                                                            <td><?php  echo $row['invoice_no'];?></td> 
                                             <td><?php  echo $row['cust_fname'].' '. $row['cust_lname'];?></td> 
                                                           <td><?php  echo $row['cust_mobile'];?></td>
                                                           <td><?php  echo $row['cust_add'];?></td>
                                                            <td><?php  echo $row['amount'];?></td>
                                                            <td><?php  echo $row['sale_date'];?></td>
                                                             <td>
                                    <a href="edit-sale-order.php?soid=<?php echo $row['saleid'];?>" class="btn btn-primary btn-sm "><i class="icon-line-awesome-edit fs-5"></i></a> 
                                     <a href="sale-bill.php?saleid=<?php echo $row['saleid'];?>"class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    <a href="app/sale-crud.php?delid=<?php echo $row['saleid'];?>" class="btn btn-danger btn-sm "onclick="return confirm('Do you really want to Delete ?');"><i class="icon-line-awesome-trash-o fs-5"></i></a>  
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
      

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        


function Product(eve) {

    var val=$(eve).val();
     var current=$(eve).closest('.auto');
     
 $.ajax({ 

type: "POST",

url: "app/sale-crud.php",

data: "i_id="+val,
dataType:'JSON',
// 
primary: function(response){
    //alert(response['display2'][0].country_name);

    $("#product_loading").find('.add').val(response['display1'][0].i_prize);
     // $("#product_loading").fadeIn(500).html(data);


 }

});   

}
    </script>
     <script>
        


function Product1(eve) {

    var val=$(eve).val();
     var current=$(eve).closest('.auto');
     
 $.ajax({ 

type: "POST",

url: "app/sale-crud.php",

data: "i_id="+val,
dataType:'JSON',
// 
primary: function(response){
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
$(document).ready(function(){

$("#cust").change(function(){
var address=$('#cust').find(":selected").attr('data-addrs');
$('#address').val(address);
});

$("#cust").change(function(){
var email=$('#cust').find(":selected").attr('data-email');
$('#email').val(email);
});


$("#cust").change(function(){
var mobile_no=$('#cust').find(":selected").attr('data-mobile');
$('#mobile').val(mobile_no);
});

// $("#product").change(function(){
// var prize=$('#product').find(":selected").attr('data-prize');
// $('#prize').val(prize);
// });
// $("#product1").change(function(){
// var prize1=$('#product1').find(":selected").attr('data-prize1');
// $('#prize1').val(prize1);
// });


});
</script> 
<!-- script end -->
<script> 

$('div.mydiv').on("change",'select[name^="product_id"]',function(event){
     var drop_services= $(this).val();
         var cnt=0;
     $( ".product_id" ).each(function() {
         if(drop_services==$(this).val())
         {
           cnt++;
         }
    });
    if(cnt>=2)
    {
        alert('Product already exists');
        return false;
    }
    var drop_services= $(this).val();
            var currentRow=$(this).closest('.subdiv');
            //console.log(currentRow);
            

            $.ajax({
                type : "POST",
                dataType : "json",
                url  : 'app/sale-crud.php',
                data : {drop_services:drop_services},
                primary: function(data){
                   //currentRow.find('input[name^="quantity"]').val(1);
                 currentRow.find('input[name^="aquantity"]').val(data['product']['openning_stock']);
                   
                   /*x= currentRow.find('input[name^="quantity"]').val(data['product']['openning_stock']);
                   x1= currentRow.find('input[name^="quantity"]').attr('max',data['product']['openning_stock']);*/
               
               currentRow.find('input[name^="quantity"]').val(0);
                currentRow.find('input[name^="quantity"]').attr('max',data['product']['openning_stock']);
                    //$("#quantity").attr('maxlength','6');

                 //currentRow.find('input[name^="quantity"]')..attr('maxlength',2);

//$('input[name="quantity"]').attr('maxlength',1);

                    /* currentRow.find('input[name^="openning_stock"]').maxval(data['product']['openning_stock']);
*/
                    currentRow.find('input[name^="sale_price"]').val(data['product']['unit_price']);
                    var quantity =currentRow.find('input[name^="quantity"]').val();

                   var total = data['product']['unit_price'];
                  currentRow.find('input[name^="total"]').val(total);

                  var rate=parseInt(total)/parseInt(quantity);
                  //currentRow.find('input[name^="rate"]').val(rate);
                   var rate = data['product']['unit_price'];
                  currentRow.find('input[name^="rate"]').val(rate);

                   //var total=+currentRow.find('input[name^="total"]').val(total);
         // $('#subtotal').val(total);
    var sum = 0;
    $('.total').each(function() {
        if($(this).val()!='')
        {
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

          
</script> 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
   <script>  
 $(document).ready(function(){  
      $('#min_price').change(function(){  
           var price = $(this).val();  
           $("#price_range").text("Product under Price Rs." + price);  
           $.ajax({  
                url:"load_product.php",  
                method:"POST",  
                data:{price:price},  
                primary:function(data){  
                     $("#product_loading").fadeIn(500).html(data);
                      $(current).find('.prize').val(response['display1'][0].i_prize);  
                }  
           });  
      });  
 });  
 </script>  
<?php include('include/footer.php');?>