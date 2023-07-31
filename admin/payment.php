<?php


session_start();
if(!isset($_SESSION['id'])){
    header('location:../index.php');
}
?>
  <?php include('include/sidebar.php');?>
    <?php include('include/header.php');?>
      <div class="content-body mb-5 p-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-4 d-flex align-items-center justify-content-between">
                        <h3 class="mb-0">Payment Details </h3>
                        <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage </span></p>
                    </div>
                </div>
            </div>
                    <section>
                        <div class="container">
                     <!-- Modal -->
                    <button type="submit" class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Payment Details</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <!-- Add payment details form -->
                            <form class="row" method="POST" action="app/payment-crud.php" id="payment_form">
                                    <div class="mb-3 col-md-6">
                                    <label class="form-label">Invoice Number<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ino" >
                                    </div>
                                    <div class="mb-3 col-md-6">
                                    <label class="form-label">Select Customer<span class="text-danger">*</span></label>
                                     <?php
                                                 $cnt=1;

                                    $stmt = $db->prepare("select * from customer");
                                   $stmt->execute();
                                   $record = $stmt->fetchAll();
                                   $i=1; ?>
                                   
                                    <select class="form-select" aria-label="Default select example"type="text" name="cust">
                                        <option></option>
                                        <?php foreach ($record as $row) 
                                         { ?>
                                            <option value=" <?php echo $row['cust_id']?>">
                                            <?php echo $row['cust_fname'].' '. $row['cust_lname'];?>
                                        </option>
                                             <?php };?>
                                     </select>
                                </div>
                                    <div class="mb-3 col-md-6">
                                   <label class="form-label">Select Payment Method<span class="text-danger">*</span></label>
                                   <select class="form-select" aria-label="Default select example"type="text" name="pmethod">
                                      <option selected></option>
                                      <option>Cash</option>
                                      <option>Card(Debit/Credit)</option>
                                      <option>UPI payment</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Payment received<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="precieved" >
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Payment date<span class="text-danger">*</span></label>

                                    <input type="date" id="current-date" class="form-control" name="pdate"  >
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary" onclick="validatepayment()">Submit</button>
                                    <input class="btn btn-primary" type="reset" value="Reset">
                                </div>
                            </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                        </section>

            <!-- Manage order details -->
            <div class="row">
               <div class="col-md-12">
                   <div class="card border-0 shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="example" class="display table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>Invoice No.</th>
                                        <th>Customer Name</th>
                                        <th>Payment Method</th>
                                        <th>Payment Received</th>
                                        <th>Payment Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                  
                                                         $cnt=1;

                                    $stmt = $db->prepare("SELECT * from payment INNER JOIN customer ON payment.cust_id=customer.cust_id where payment.delete_status=0 ; ");
                                                                       $stmt->execute();
                                                                       $record = $stmt->fetchAll();
                                                                       $i=1;
                                                                       foreach ($record as $row) 
                                                                         {
                                                                          ?>

                                    <!--Fetch the Records -->
                                                        <tr>
                                                            <td><?php echo $cnt;?></td>
                                                            <td><?php  echo $row['invoice_no'];?></td> 
                                                            <td>

                                                            <?php  echo $row['cust_fname'].' '. $row['cust_lname'];?>   </td> 
                                                            <td><?php  echo $row['payment_method'];?></td>
                                                            <td><?php  echo $row['payment_received'];?></td>
                                                            <td><?php  echo $row['payment_date'];?></td>
                                                            <td>

                                     <a href="edit-payment.php?pid=<?php echo $row['payment_id'];?>" class="btn btn-primary btn-sm "><i class="icon-line-awesome-edit fs-5"></i></a> 
                                     <a href="app/payment-crud.php?delid=<?php echo $row['payment_id'];?>" class="btn btn-danger btn-sm "onclick="return confirm('Do you really want to Delete ?');"><i class="icon-line-awesome-trash-o fs-5"></i></a>  
                                    </td>
                                     </tr>
                                    <?php 
                                    $cnt=$cnt+1;
                                    }  ?>              
                                </tbody>
                            </table>
                        </div>
                        </div>
                   </div>
               </div>
            </div>
      </div>
<?php include('include/footer.php');?>