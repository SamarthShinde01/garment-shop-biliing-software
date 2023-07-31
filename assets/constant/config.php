<?php
//assets/constant/config.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="garment_billing_system";
try {
  $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_LOCAL_INFILE => 1));
  // set the PDO error mode to exception

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>


