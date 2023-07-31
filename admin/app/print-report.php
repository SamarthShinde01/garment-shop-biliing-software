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
                                        <th>#</th>
                                        <th>Food Name</th>
                                        <th>Food Quantity</th>
                                        <th>Food Decriptio</th>
                                        <th>Food Type</th>
                                        <th>Food Exp date</th>
                                        <th>Image </th>
  </tr>
 
   
  
  
  

</thead>
<tbody>


                                 
                                 <?php
                            
                                $cnt=1;

                                $stmt = $db->prepare("select * from food where fid=?");
                                $stmt->execute([$_GET['fid']]);
                                $record = $stmt->fetchAll();
                                $i=1;
                                foreach ($record as $row) 

                                { ?>

    <!-- $sql="UPDATE user SET fname = ?,quantity = ?,desc = ?,food_type = ?,date = ?,image = ? WHERE uid=? ";    -->

                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td><?php  echo $row['fname'];?></td>
                        <td> <?php  echo $row['quantity'];?></td>
                        <td><?php  echo $row['desci'];?></td>                        
                        <td><?php  echo $row['food_type'];?></td>
                        <td> <?php  echo $row['edate'];?></td>
                        <td> <img src="../assets/img/<?php  echo $row['image'];?>" height="80px" width="80px" class="rounded"> </td>
                              <!-- <td> <?php  echo $row['status'];?></td> -->
                <!--          <td><span class="badge bg-danger">Active</span></td> -->

                       
                     </tr>
                    <?php 
                    $cnt=$cnt+1;
                    }   ?> 









                                </tbody>
                                </table>
<button class="btn btn-primary" onclick="window.print()">Print</button>
</body>
</html>

<?php include('include/footer.php');?>