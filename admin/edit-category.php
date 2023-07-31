<?php


session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<?php

$stmt = $db->prepare("SELECT * from category WHERE cate_id = ?");
$stmt->execute([$_GET['cateid']]);
$result = $stmt->fetchAll();
foreach ($result as $key) {
    // code...

?>
    <div class="content-body mb-5 p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="heading mb-4 d-flex align-items-center justify-content-between">
                    <h3 class="mb-0">Edit Category Details </h3>
                    <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage </span></p>
                </div>
            </div>
        </div>
        <section>
            <div class="container">

                <!-- Edit category details form -->
                <form class="row" method="POST" action="app/category-crud.php" id="category_form1" enctype="multipart/form-data">
                    <!-- form start -->
                    <input type="hidden" class="form-control" name="cateid" value="<?php echo $key['cate_id']; ?>">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Category Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="catename" value="<?php echo $key['cate_name']; ?>">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-sm" name="update" onclick="submitcat()">Update</button>
                        <button onclick="location.href = 'category.php';" type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>


            <?php } ?>
            </div>
    </div>

    </section>
    <?php include('include/footer.php'); ?>