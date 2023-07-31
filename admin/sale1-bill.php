<?php


session_start();
if(!isset($_SESSION['id'])){
    header('location:../index.php');
}
?>
<?php 
 include '../assets/constant/config.php';
?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}


td, th {
  border: 1px solid #1a1b1c;
  text-align: left;
  padding: 8px;

}

@media print{
  button{
    display: none;

  }
}
</style>
</head>
<body>

 

 <?php

                

                                   
                                  
                                                         $cnt=1;
                                     $stmt = $db->prepare("SELECT * from sale INNER JOIN customer ON sale.cust_id=customer.cust_id INNER JOIN product ON sale.i_id = product.i_id where saleid=? ;");   
                                                                     $stmt->execute([$_GET['saleid']]);
                                                                       $record = $stmt->fetchAll();
                                                                       $i=1;
                                                                       foreach ($record as $row) 
                                                                         { 
                                                                          ?>
                                                                               <h2 style="text-align:center"> Bill Receipt</h2>
 <h3 style="text-align:right;padding-right: 150px;">Invoice No.:<?php  echo $row['invoice_no'];?></h3>
                  <h3 style="text-align:right;padding-right: 140px;padding-bottom: 10px;">Invoice Date:<?php  echo $row['sale_date'];?></h3>
             <br><br>
                  <h3 style="text-align:left;padding-bottom: 10px;">Billed To: <?php

    $stmt = $db->prepare("SELECT * from admin ");
    $stmt->execute();
    $record = $stmt->fetchAll();
    foreach ($record as $key) {
            // code...

    ?> 
    <br><br>
<?php echo $key['admin_fname'].' '.$key['admin_lname'];?><br>
<?php echo $key['admin_email'];?><br>

<?php echo $key['address'];?><br>
<?php echo $key['admin_mobileno'];?><br>
<?php } ?>
              </p>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <div style="text-align:right;padding-right: 150px;">
              <p class="tm_mb2"><b class="tm_primary_color">Pay To:</b></p>
              <p>

               <?php  echo $row['cust_fname'].' '. $row['cust_lname'];?><br>
                                  <?php  echo $row['cust_email'];?><br>
                                       <?php  echo $row['cust_add'];?><br>
                                  <?php  echo $row['cust_mobile'];?><br>
                             
</div>
              </p>
            </div>
          </div></h3>
                 

                         
 
                  <table>
                    <thead class="table-dark">
                      
                    <tr style="background-color:black;color: white;">
                      <th>Sr No</th>
                      <th>Item</th>
                      <th>Quantity</th>
                      <th>Prize</th>
                      <th>Total</th>
                    </tr>
              
                
                <tbody>

            
                    <tr>
                                                            <td><?php echo $cnt;?></td>
                                                            <td><?php  echo $row['i_name'];?></td> 
                                                            <td><?php  echo $row['prize'];?></td>
                                                            <td><?php  echo $row['sale_quantity'];?></td>
                                                            <td><?php  echo $row['amount'];?></td>
                                                            
                      
                  
                        </tr>

 
                              
  
    <td colspan="4" style="text-align:right"><b> Sub Total</b></td>
    <td><?php  echo $row['amount'];?></td>
  </tr>
  <tr>
  <?php
                        $tax=0.05;
                        $amount= $row['amount'];
                        $gst=($amount*$tax)/100;
                        $total=$amount+$gst;
                        ?>
    <td colspan="4" style="text-align:right"><b> Tax</b></td>
    <td><?php echo round($gst, 2);?></td>
  </tr>
  <tr>
  
    <td colspan="4" style="text-align:right"><b>Total Amount</b></td>
    <td><?php echo round($total, 2);?></td>
  </tr>
    </thead>
   <?php 
                    
                    }  ?> 

</table>  </tbody>
<br>
<button class="btn btn-primary" style="background-color: #03a5fc;border-color: #03a5fc;" onclick="window.print()">Print</button>
</body>
</html>
