<?php


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
                <h3 class="mb-0">Manage Stock</h3>
                <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage Stock </span></p>
            </div>
        </div>
    </div>



    <!-- Manage stock details -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Build Date</th>
                                    <th>Supplier Name</th>
                                    <th>Supplier Email</th>
                                    <th>Supplier Address</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                $cnt = 1;
                                $stmt = $db->prepare("SELECT * from stock INNER JOIN supplier ON stock.sup_id=supplier.sup_id where stock.delete_status ='0' order by stock_id DESC ");
                                $stmt->execute();
                                $record = $stmt->fetchAll();
                                $i = 1;
                                foreach ($record as $row) {
                                ?>

                                    <!--Fetch the Records -->
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php $date = date_create($row['build_date']);
                                            echo date_format($date, "d-m-Y"); ?></td>
                                        <td><?php echo $row['sup_fname'] . ' ' . $row['sup_lname']; ?></td>
                                        <td><?php echo $row['sup_email']; ?></td>
                                        <td><?php echo $row['sup_add']; ?></td>
                                        <td><?php echo $row['final_total']; ?></td>


                                        <td>
                                            <a href="app/stock-crud.php?delid=<?php echo $row['stock_id']; ?>" class="btn btn-danger btn-sm " onclick="return confirm('Do you really want to Delete ?');"><i class="icon-line-awesome-trash-o fs-5"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $cnt = $cnt + 1;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>





<?php include('include/footer.php'); ?>