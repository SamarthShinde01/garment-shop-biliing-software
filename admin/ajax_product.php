<?php
//include('connect.php');


 include '../assets/constant/config.php';
 session_start();

 
  if(isset($_POST['drop_services']))
  {
       $sql_service1 ="SELECT * FROM product WHERE i_id  = '".$_POST['drop_services']."'";
       $statement = $db->prepare($sql_service1);
 $statement->execute();
                                                             
                                                                
  $data['product'] = $statement->fetchAll();
 
        /*$result1=$conn->query($sql_service1);  
        $service1 = mysqli_fetch_array($result1);
        */
        // $data['product']=$service1;
        echo json_encode($data); exit;
  }

   if(isset($_POST['group_id']))
  {
       $sql_service2 ="SELECT * FROM product WHERE group_id  = '".$_POST['group_id']."'";
       $statement1 = $db->prepare($sql_service2);
        $statement1->execute();
            $data['products'] = $statement1->fetchAll();
        echo json_encode($data); exit;
  }
?>

<?php


if(isset($_POST['i_id']) && !empty($_POST['i_id'])){
$result=array();
         $id= htmlspecialchars($_POST['i_id']); 
    $stmt = $db->prepare("SELECT * FROM product WHERE i_id=?");
    $stmt->execute([$id]);
    //echo print_r($stmt);exit;
    $display1 = $stmt->fetchAll(); 


}

     //echo print_r($display1);exit;
    //$result['display']=$display;
    $result['display1']=$display1;
    
            echo json_encode($result);


?>
<?php


if(isset($_POST['i_id']) && !empty($_POST['i_id'])){
$result=array();
         $id= htmlspecialchars($_POST['i_id']); 
    $stmt = $db->prepare("SELECT * FROM product WHERE i_id=?");
    $stmt->execute([$id]);
    //echo print_r($stmt);exit;
    $display1 = $stmt->fetchAll(); 


}

     //echo print_r($display1);exit;
    //$result['display']=$display;
    $result['display1']=$display1;
    
            echo json_encode($result);


?>












