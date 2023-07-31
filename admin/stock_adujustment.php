<?php


session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>

<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">

        <div class="row">
            <!-- ============================================================== -->
            <!-- data table  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">

                        <!--                                  <a href="Product.php"><button class="btn btn-primary" type="submit" name=""> Add Product</button></a>
 -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SR No</th>
                                        <th>Material Name</th>
                                        <th> Prize</th>
                                        <!--  <th>Selling Cost</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    $sql = "SELECT * FROM product where delete_status='0' ";


                                    $statement = $db->prepare($sql);
                                    $statement->execute();

                                    $cnt = 0;
                                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                                        extract($row);
                                        $cnt += 1;
                                    ?>

                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <!-- <td><?= $no; ?></td> -->
                                            <td><?php echo $i_name; ?></td>
                                            <td><?php echo $i_prize; ?></td>
                                            <!-- <td><?= $unit_price; ?></td> -->
                                            <td>







                                                <a href="update_stock_adjustement.php?id=<?= $i_id; ?>" class="btn btn-info" title="Edit Event"><i class="fas fa-edit"></i></a>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end data table  -->
            <!-- ============================================================== -->
        </div>
    </div>
    <?php include('include/footer.php'); ?>
</div>
</div>



</body>