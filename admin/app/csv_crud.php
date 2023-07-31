<?php 
 include '../../assets/constant/config.php';
 session_start();
 
// include '../../assets/css/popup_style.css';

    
 ?> 
   <!-- crud start for csv-->
 <link rel="stylesheet" href="popup_style.css">
<?php
if(isset($_POST['submit11']))
{
//echo "<pre>"; print_r($_FILES); exit;
$filename=$_FILES["csv_file"]["tmp_name"];        
       

$tmp = explode('.', $_FILES["csv_file"]["name"]);
$extension = end($tmp);
if($extension != 'csv')
{
  // echo 'Please upload Only CSV file';
    echo "<script>alert(' Please upload only CSV file');</script>";
         echo "<script type='text/javascript'> document.location ='../customer.php'; </script>";
  exit;
}


if($_FILES["csv_file"]["size"] > 0)
{

$file = fopen($filename, "r");
$cnt=0;
for ($lines = 0; $data = fgetcsv($file,1000,",",'"'); $lines++) {
if ($lines == 0) continue;

     
  // $sql = "INSERT INTO `customer`(`cust_id`, `cust_fname`, `cust_lname`,`cust_email` ,`cust_mobile`,`cust_add`,`cdate`,`cust_city`,`cust_state`) VALUES  (?,?,?,?,?,?,?,?,?)";   
   $sql = "INSERT INTO `customer`( `cust_fname`, `cust_lname`,`cust_email` ,`cust_mobile`,`cust_add`,`cdate`,`cust_city`,`cust_state`) VALUES  (?,?,?,?,?,?,?,?)";
 $statement = $db->prepare($sql);
      // $statement->bindparam(1, $data[0]);
    $statement->bindparam(1, $data[0]);
    $statement->bindparam(2, $data[1]);
     $statement->bindparam(3, $data[2]);
      $statement->bindparam(4, $data[3]);
      $statement->bindparam(5, $data[4]);
      $statement->bindparam(6, $data[5]);
      $statement->bindparam(7, $data[6]);
      $statement->bindparam(8, $data[7]);
        $statement->execute();
     
// $sql2="UPDATE `member` SET `payment_status`=? WHERE id=?";
// $statement2 = $conn->prepare($sql2);
//     $statement2->bindparam(1, $data[3]);
//     $statement2->bindparam(2, $data[1]);
//     $statement2->execute();
       

       $cnt++;
       }
       }
       if($cnt>0){
            ?>


    echo "<script>alert('Success  added <?php  echo $cnt; ?> records ');</script>";
         echo "<script type='text/javascript'> document.location ='../customer.php'; </script>";


<?php
}  else {
    
?>
  echo "<script>alert(' Error');</script>";
         echo "<script type='text/javascript'> document.location ='../customer.php'; </script>";
<?php }   
       
       fclose($file);
   
}


?>
<!-- crud start for csv-->
