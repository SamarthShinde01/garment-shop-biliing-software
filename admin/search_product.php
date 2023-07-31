<?php
//include('connect.php');


include '../assets/constant/config.php';
session_start();

?>
 <?php
      if (isset($_POST['group_id'])) {
            $sql_service1 = "SELECT * FROM product WHERE i_id  = '" . $_POST['group_id'] . "'";
            $statement = $db->prepare($sql_service1);
            $statement->execute();


            $data['products'] = $statement->fetchAll();

            // print_r($data);exit;
            echo json_encode($data);
            exit;
      }


      ?>



