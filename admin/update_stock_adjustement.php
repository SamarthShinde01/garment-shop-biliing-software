<?php


session_start();
if(!isset($_SESSION['id'])){
    header('location:../index.php');
}
?>
    <?php include('include/sidebar.php');?>
    <?php include('include/header.php');?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            
       <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <!-- <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Candidate </h2>
                            <p class="pageheader-text">Candidate</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Forms</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Form Validations</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                 --><!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                   <div class="row">
                        <!-- ============================================================== -->
                        <!-- validation form -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                              <br>
                              <br>
                                <h5 class="card-header">Deduct Quantity</h5>
                                <div class="card-body">
                                   <form class="form-horizontal" action="app/stock-crud.php" method="post" enctype="multipart/form-data">
                                          
                                    
                                        
                                          <div class="form-group row">
                                             
                                          <!--  <div class="col-sm-2">
                                                Material Category  
                                        </div>
 -->
                                    <div class="col-sm-3">
                                            Select Material
                                            </div>
                                             

                                            <div class="col-sm-1">
                                            Avl.Qty
                                            </div>
                                            <div class="col-sm-1">
                                            Ded.Qty
                                            </div>
                                           
                                           <!--  <div class="col-sm-1">
                                           Sale Price
                                            </div>
                                            <div class="col-sm-2">
                                              Total
                                            </div>
                                            --> <!--  <div class="col-sm-1">
                                              Action
                                            </div>
                                         -->
                                         </div>
                                         <div class="mydiv">
                                           <?php
                                                      $sql1 = "SELECT * FROM product where i_id='".$_GET['id']."'";
                                                 
                                                                
                                                 $statement1 = $db->prepare($sql1);
                                                 $statement1->execute();
                                                     $row1 = $statement1->fetch(PDO::FETCH_ASSOC);
                                                
                                                      ?>
                                         
                                        <div class="form-group row control-group after-add-more subdiv">
                                           
                                        <div class="col-sm-3">
                                            <div class="col-sm-12">
                                                   <select name="product_id[]" class="form-control product_id select2" required>
                                                      <option value="">--Select --</option>
                                                     <?php
                                                    $sql = "SELECT * from product INNER JOIN category ON product.cate_id=category.cate_id ;";
                                                    $statement = $db->prepare($sql);
                                                    $statement->execute();
                                                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>  
                                                        <option value="<?php echo $row['i_id'];?>"  <?php if($row1['i_id']==$row['i_id']){ echo "Selected";}?>><?php echo $row['i_name'];?></option>
                                                   <?php } ?>
                                                     </select>


                                      </div>
    </div>

                                            <div class="col-sm-1">
                                            <input type="text" class="form-control" id="aquantity" name="aquantity[]" placeholder="Qty" required   pattern="^[0-9]+$" readonly="" value="<?=$row1['openning_stock'];?>">
                                            <!-- <label  style="color: red">can not enter value more tha quantity</label>
                                             --></div>
                                             <div class="col-sm-1">
                                            <input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="D Qty" required   pattern="^[0-9]+$">
                                            <!-- <label  style="color: red">can not enter value more tha quantity</label>
                                             --></div>


                                           <!--  <div class="col-sm-1">
                                           <input type="text" class="form-control" id="rate" name="rate[]" placeholder="Sale Price" required readonly value="<?=$item['rate'];?>">
                                            </div>
                                            <div class="col-sm-2">
                                           <input type="text" class="form-control total" id="total" name="total[]" placeholder="Total" readonly=""  value="<?=$item['total'];?>">
                                            </div>
 -->
                                            <div class="col-sm-2">
<!--                                             <button class="btn btn-primary add-more" type="button"><i class="fa fa-plus"></i></button>
 -->                                            </div>
                                         </div>
                                                                                               <?php ?>
                                                                                             

                                      </div>

                                      



                               
                                       

                              <!--<div class="form-group row">
                                  <label class="col-sm-6 control-label">Subtotal</label>
                                  <div class="col-sm-3">
                                      <input type="text" name="subtotal" id="subtotal" class="form-control" placeholder="Subtotal" readonly="">
                                  </div>
                             </div>

                             <div class="form-group row">
                                  <label class="col-sm-6 control-label">Total Tax Amount</label>
                                  <div class="col-sm-3">
                                      <input type="text" name="total_tax_amount" id="total_tax_amount" class="form-control" placeholder="Total Tax Amount" readonly="">
                                  </div>
                             </div>-->                            

                             <!-- <div class="form-group row">
                                  <label class="col-sm-6 control-label">Total Taxable Amount</label>
                                  <div class="col-sm-3">
                                      <input type="text" name="total_taxable_amount" id="total_taxable_amount" class="form-control" placeholder="Total Taxable Amount" readonly="">
                                  </div>
                             </div>-->
                           
                             <button type="submit" name="btn_save" class="btn btn-primary btn-flat m-b-30 m-t-30"  >Submit</button>
                                 <p id="GFG_DOWN" style="color: green;">

            </form>
                    
        </div>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
           <?php include('include/footer.php');?>
           </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
    <script type="text/javascript">1
 $('#class_id').change(function(){
    $("#subject_id").val('');
    $("#subject_id").children('option').hide();
    var class_id=$(this).val();
    $("#subject_id").children("option[data-id="+class_id+ "]").show();
    
  });
</script>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({
      format: 'dd/mm/yyyy'
    });
  } );
 <script type="text/javascript">
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });   
</script>
<script type="text/javascript">
      $("#customer_id").on("change",function(){ 
          var customer_id=$(this).val();
          $.ajax({
                type : "POST",
                url  : 'ajax_represent.php',
                data : {customer_id:customer_id },
                primary: function(data){
                  $('#representative_id').html(data);
                    }
                  });
      });   
</script>
<script type="text/javascript">
  $(".add-more").on('click',function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
          show_no();
      });  

      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
          show_no();
      });
function show_no()
{
    var row_cnt=0;
  $( ".sr_no" ).each(function() {
      row_cnt++;
    $( this ).html(row_cnt);
    });
}
</script>
<script type="text/javascript">

$(document).ready(function() {
$('div.mydiv').on("keyup",'input[name^="rate"]',function(event){
          var currentRow=$(this).closest('.subdiv');
          var quantity =currentRow.find('input[name^="quantity"]').val();
           

          //alert(quantity);
          var unitprice=currentRow.find('input[name^="rate"]').val();
          var gst=currentRow.find('input[name^="gst"]').val();
         var subtotal=Number(quantity) * Number(unitprice);
         var tax_amount=Number(subtotal)*(Number(gst)/100);

          currentRow.find('input[name^="tax_amount"]').val(tax_amount);
          var total = Number(quantity) * Number(unitprice)+Number(tax_amount);
          var total=+currentRow.find('input[name^="total"]').val(total);
         // $('#subtotal').val(total);
    var sum = 0;
    $('.total').each(function() {
        sum += Number($(this).val());
    });
 $('#subtotal').val(sum);
$('#final_total').val(sum);
var sub_text = $('#subtotal').val();
var sub_total = Number(sub_text) ; 
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
     
     $('div.mydiv').on("keyup",'input[name^="quantity"]',function(event){
          var currentRow=$(this).closest('.subdiv');
          var quantity =currentRow.find('input[name^="quantity"]').val();
          var x=parseInt(quantity);
          var quantityq =currentRow.find('input[name^="aquantity"]').val();
          var x1=parseInt(quantityq);
                      //alert(x1);

          if(x>=x1)
          {
            alert('Not Enter Value Greather than Availible Quantity'+'-'+  x1);
location.reload();         }

          var sale_price=currentRow.find('input[name^="rate"]').val();                

        var total =parseInt(sale_price)*parseInt(quantity);
        currentRow.find('input[name^="total"]').val(total);

        var rate=parseInt(total)/parseInt(quantity);

       
          var total=+currentRow.find('input[name^="total"]').val();
         // $('#subtotal').val(total);
    var sum = 0;
    $('.total').each(function() {
        sum += Number($(this).val());
    });
 $('#subtotal').val(sum);
$('#final_total').val(sum);

var sub_text = $('#subtotal').val();
var sub_total = Number(sub_text) ; 
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

 $('div.mydiv').on("keyup",'input[name^="gst"]',function(event){
          var currentRow=$(this).closest('.subdiv');
          var quantity =currentRow.find('input[name^="quantity"]').val();
          var sale_price=currentRow.find('input[name^="sale_price"]').val();
          var taxable=parseInt(sale_price)*parseInt(quantity);
          currentRow.find('input[name^="taxable_amount"]').val(taxable);

        var taxable_amount=currentRow.find('input[name^="taxable_amount"]').val();
        var gst=currentRow.find('input[name^="gst"]').val();
        var rate=Number(taxable_amount) * (Number(gst)/100);                    

      var tax_amount=Number(taxable_amount)  * (Number(gst)/100);
      currentRow.find('input[name^="tax_amount"]').val(tax_amount);                  

      var total = parseInt(taxable_amount)+parseInt(tax_amount);
      currentRow.find('input[name^="total"]').val(total);

      var rate=parseInt(total)/parseInt(quantity);

      currentRow.find('input[name^="rate"]').val(rate);
          var total=+currentRow.find('input[name^="total"]').val();
         // $('#subtotal').val(total);
    var sum = 0;
    $('.total').each(function() {
        sum += Number($(this).val());
    });
 $('#subtotal').val(sum);
$('#final_total').val(sum);

var sub_text = $('#subtotal').val();
var sub_total = Number(sub_text) ; 
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

$('form').on("keyup",'input[name="discount"]',function(argument) {
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
var disc_amount=Number(sub_text)*(Number(disc)/100);
var sub_total = Number(sub_text)- Number(disc_amount) ; 

var tax_amount=Number(sub_total)*(Number(tax_percent)/100);
var taxable_amount=Number(sub_total)-Number(tax_amount);
$("#total_tax_amount").val(tax_amount);
$("#total_taxable_amount").val(taxable_amount);

var sub_total1 = Number(sub_total)- Number(tax_amount) ; 
$("#final_total").val(sub_total1);
});

$('form').on("keyup",'input[name="gst_rate"]',function(argument) {
var tax_percent = $(this).val();
var sub_text = $('#subtotal').val();


var disc = $('#discount').val();
var disc_amount=Number(sub_text)*(Number(disc)/100);
var sub_total = Number(sub_text)- Number(disc_amount) ; 

var tax_amount=Number(sub_total)*(Number(tax_percent)/100);
var taxable_amount=Number(sub_total)-Number(tax_amount);
$("#total_tax_amount").val(tax_amount);
$("#total_taxable_amount").val(taxable_amount);

var sub_total1 = Number(sub_total)- Number(tax_amount) ; 
$("#final_total").val(sub_total1);
});


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
                url  : 'ajax_product.php',
                data : {drop_services:drop_services},
                primary: function(data){
                    alert(data['product']['openning_stock']);
                   // currentRow.find('input[name^="quantity"]').val(1);
                 currentRow.find('input[name^="aquantity"]').val(data['product']['openning_stock']);
                   
                   x= currentRow.find('input[name^="quantity"]').val(data['product']['openning_stock']);
                   x1= currentRow.find('input[name^="quantity"]').attr('max',data['product']['openning_stock']);
               
                
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

  $('div.mydiv').on("change",'select[name^="p_group_name"]',function(event){
            var currentRow=$(this).closest('.subdiv');
            //console.log(currentRow);
            var group_id= $(this).val();
            currentRow.find('select[name^="product_id"]').select2();
            currentRow.find('select[name^="product_id"]').html('<option value="" >Select one </option>');
            $.ajax({
                type : "POST",
                dataType : "json",
                url  : 'search_product.php',
                data : {group_id:group_id},
                primary: function(data){
                    for(var i=0;i<data['products'].length;i++)
                    {
                        var p_id=data['products'][i][0];
                        var p_name=data['products'][i][2];
                       currentRow.find('select[name^="product_id"]').append('<option value="'+p_id+'" > '+p_name+'</option>'); 
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

  
$('#quantity').keyup(function(){
  alert(0);
  if ($(this).val() >2){
    alert("No numbers above 100");
    $(this).val('100');
  }
});



function GFG_Fun() {
       alert();

              var x = document.getElementById("quantity1").value;

              var x1 = document.getElementById("quantity1").maxlength;
              //alert(x1);
              if(x>x1)
              {

alert("OUT OF STOCK");
}
$(document).ready(function(){
    $('#quantity1').on('keydown keyup change', function(){
        var char = $(this).val();
        var charLength = $(this).val().length;
        alert(char);
        if(charLength < minLength){
            $('#warning-message').text('Length is short, minimum '+minLength+' required.');
        }else if(charLength > maxLength){
            $('#warning-message').text('Length is not valid, maximum '+maxLength+' allowed.');
            $(this).val(char.substring(0, maxLength));
        }else{
            $('#warning-message').text('');
        }
    });
});
</script> 


</script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
 
</html>