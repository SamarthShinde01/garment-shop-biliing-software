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

<h2 style="text-align:center"> Stock Report</h2>

<table>
  <thead class="table-dark">
    
  <tr>
                                        <th>Stock ID</th>
                                        <th>Item Name</th>
                                        <th>Category</th>
                                        <th>Suplier Name</th>
                                        <th>Quantity</th>
                                        <th>Expiry Date</th>
  </tr>
 
   
  
  
  

</thead>
<tbody>


                               <?php

                                   $cnt=1;
                                   $stmt = $db->prepare("select * from stock stock INNER JOIN supplier ON stock.sup_id=supplier.sup_id INNER JOIN category ON stock.cate_id = category.cate_id where stock_id=? ");
                                   $stmt->execute([$_GET['sid']]);
                                   $record = $stmt->fetchAll();
                                   $i=1;
                                   foreach ($record as $row) 
                                     { 


                                        ?>


    
                    <tr>
                                                            <td><?php echo $cnt;?></td>
                                                            <td><?php  echo $row['item_name'];?></td> 
                                                            <td><?php  echo $row['cate_name'];?></td> 
                                                            <td><?php  echo $row['sup_fname'].' '. $row['sup_lname'];?></td> 
                                                            <td><?php  echo $row['avail_quantity'];?></td>
                                                            <td><?php  echo $row['expiry_date'];?></td>
                        
                      
                        
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