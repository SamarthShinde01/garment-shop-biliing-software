<?php 
 include '../../assets/constant/config.php';
 session_start();
//insert crud for user form start
		if (isset($_POST['submit'])) 
		{
//print_r($_POST); exit;
// $sql = "INSERT INTO `sale`(`invoice_no`,`prize`,`sale_quantity`,`amount`,`cust_id`, `i_id`) VALUES (?,?,?,?,?,?)";


			$sql = "INSERT INTO `sale`(`invoice_no`,`cust_id`) VALUES (?,?)";

    $statement = $db->prepare($sql);
    
    $statement->bindparam(1, htmlspecialchars($_POST['invoice_no']));
    // $statement->bindparam(2, htmlspecialchars($_POST['prize']));
    // $statement->bindparam(3, htmlspecialchars($_POST['sale_quantity']));
    // $statement->bindparam(4, htmlspecialchars($_POST['amount'])); 
    $statement->bindparam(2, htmlspecialchars($_POST['cust']));
    // $statement->bindparam(6, htmlspecialchars($_POST['product']));
    // print_r($sql); exit;
    $statement->execute();

	// print_r($sql); exit;

			

		 $last_id=$db->lastInsertId();
    $cnt=count($_POST['itemname']);
    for($i=0;$i<$cnt; $i++){

   $sql1 = "INSERT INTO `sale_item`(`sale_id`,`itemname`,`itemquantity`,`itemprice`,`total`) VALUES (?,?,?,?,?)";

            $statement1 = $db->prepare($sql1);
    
            $statement1->bindparam(1, htmlspecialchars($last_id));
            $statement1->bindparam(2, htmlspecialchars($_POST['itemname'][$i]));
            $statement1->bindparam(3, htmlspecialchars($_POST['itemquantity'][$i]));
            $statement1->bindparam(4, htmlspecialchars($_POST['itemprice'][$i]));
            $statement1->bindparam(5, htmlspecialchars($_POST['total'][$i]));
           
    // print_r($sql); exit;
    $statement1->execute();
     
            }

	// print_r($stmt); exit;

			header("location:../sale-order.php" ); 

		
		}

		
		

//insert crud end

//update crud for user form start
if (isset($_POST['update']))
		 {
		$sql="UPDATE sale SET invoice_no = ?,prize = ?,sale_quantity= ?,amount = ?,cust_id= ?  WHERE saleid=? ";	
	$stmt = $db->prepare($sql);
	// print_r($sql);
$stmt->execute([$_POST['ino'], $_POST['prize'], $_POST['quantity'],$_POST['amount'],$_POST['cust'],$_POST['soid']]);
			// print_r($sql); exit;

		 	header("location: ../sale-order.php");
		 }
		





	//update crud end	



//delete for user form
 if (isset($_GET['delid'])) 
		 {
				$stmt = $db->prepare("UPDATE sale SET delete_status=1  Where saleid=?"); 
			$stmt->execute([ $_GET['delid']]);
			

			header("location:../sale-order.php");
		}
		
//delete end


	





			
