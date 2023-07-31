<?php
// error_reporting(E_ALL);

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
  border: 1px solid #dddddd;
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

<h2 style="text-align:center"> Purchase Order Report</h2>

<table>
  <thead class="table-dark">
    
  <tr>
                                       <th>PO No.</th>
                                        <th>Invoice No.</th>
                                        <th>Supplier</th>
                                        <th>Item</th>
                                        <th>Prize</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                       
                                        <th>Purchase Date</th>
    </thead>
<tbody>


                               <?php

                                   $cnt=1;
                                   $stmt = $db->prepare("SELECT * from purchace_order INNER JOIN supplier ON purchace_order.sup_id=supplier.sup_id where porder_id=? ");
                                   $stmt->execute([$_GET['poid']]);
                                   $record = $stmt->fetchAll();
                                   $i=1;
                                   foreach ($record as $row) 
                                     { 


                                        ?>


    
                    <tr>
                                                      <td><?php echo $cnt;?></td>
                                                            <td><?php  echo $row['invoice_no'];?></td> 
                                                            <td>

                                                            <?php  echo $row['sup_fname'].' '. $row['sup_lname'];?>   </td> 
                                                            <td><?php  echo $row['item_name'];?></td>
                                                            <td><?php  echo $row['prize'];?></td>
                                                            <td><?php  echo $row['quantity'];?></td>
                                                            <td><?php  echo $row['amount'];?></td>
                                                            
                                                            <td><?php  echo $row['purchase_date'];?></td>
                        
                      
                         
                        </tr>


                           <?php 
                    $cnt=$cnt+1;
                    }  ?> 


                                </tbody>
                                </table>
                                <br>
<button class="btn btn-primary" onclick="window.print()">Print</button>
</body>
</html>

<?php include('include/footer.php');?>