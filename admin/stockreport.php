<?php
// error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>


<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<div class="content-body mb-5 p-3">
    <div class="row">
        <div class="col-md-12">
            <div class="heading mb-4 d-flex align-items-center justify-content-between">
                <h3 class="mb-0">Stock Report</h3>
                <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/Stock Report </span></p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">

                    <div class="card-body">

                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" name="from_date" value="<?php if (isset($_POST['from_date'])) {
                                                                                        echo $_POST['from_date'];
                                                                                    } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" name="to_date" value="<?php if (isset($_POST['to_date'])) {
                                                                                        echo $_POST['to_date'];
                                                                                    } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Click to Filter</label> <br>
                                        <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>






                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <div class="mt-5 table-responsive">
                                    <table id="example" class="display table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Build Date</th>
                                                <th>Item Name</th>
                                                <!-- <th>Product Category</th> -->
                                                <th>Selling Cost</th>
                                                <th>Avl Unit</th>
                                                <th>Purchase Cost</th>
                                                <th>Sale Cost</th>

                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $cnt = 1;
                                            if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
                                                // code...
                                                $from_date = $_POST['from_date'];
                                                $to_date = $_POST['to_date'];
                                                // echo $from_date;
                                                // echo $to_date;


                                                //where food.edate < DATE(now()
                                                $stmt = $db->prepare("select * from product where submitted_date between '$from_date' AND '$to_date' AND product.submitted_date <= curdate() ");
                                                $stmt->execute();
                                                $record = $stmt->fetchAll();
                                                $i = 1;
                                                foreach ($record as $row) {


                                            ?>



                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php $date = date_create($row['submitted_date']);
                                                            echo date_format($date, "d-m-Y"); ?></td>

                                                        <td><?php echo $row['i_name']; ?></td>

                                                        <!-- <td><?php echo $row['cate_name']; ?></td>  -->
                                                        <td><?php echo $row['product_sprize']; ?></td>
                                                        <td><?php echo $row['openning_stock']; ?></td>
                                                        <td><?php echo $row['openning_stock'] * $row['i_prize']; ?></td>
                                                        <td><?php echo $row['openning_stock'] * $row['product_sprize']; ?></td>


                                                        <!-- <td>  
                        <a href="print-stock.php?sid=<?php echo $row['product_id']; ?>"class="btn btn-success"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </td> -->
                                                    </tr>
                                            <?php
                                                    $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        </tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('include/footer.php'); ?>