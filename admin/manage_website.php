<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
    include '../../assets/constant/config.php';
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>


<div class="content-body mb-5 p-3">
    <div class="row">
        <div class="col-md-12">
            <div class="heading mb-4 d-flex align-items-center justify-content-between">
                <h3 class="mb-0"> Website Manage </h3>
                <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage </span></p>
            </div>
        </div>
    </div>


    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Website Manage </h5>
            <div class="card-body">
                <form class="row" method="POST" action="app/manage_website-crud.php" id="category_form" enctype="multipart/form-data">

                    <?php
                    $stmt = $db->prepare("SELECT * from manage_website");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach ($result as $key) {
                        //code
                    ?>
                        <input type="hidden" class="form-control" name="id" value="<?php echo $key['id']; ?>">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="<?php echo $key['title']; ?>" name="title">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Currency Symbol<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="<?php echo $key['currency_symbol']; ?>" name="currency_symbol">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Sidebar Logo<span class="text-danger">*</span></label>
                            <image class="profile-img" src="../assets/img/<?php echo $key['login_logo']; ?>" style="height:35%;width:35%;">
                                <input type="hidden" value="<?php echo $key['login_logo']; ?>" name="old_login_image">
                                <input type="file" class="form-control" name="login_image">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Login Page Logo<span class="text-danger">*</span></label>
                            <image class="profile-img" src="../assets/img/<?php echo $key['website_logo']; ?>" style="height:35%;width:25%;">
                                <input type="hidden" value="<?php echo $key['website_logo']; ?>" name="old_website_image">
                                <input type="file" class="form-control" name="website_image">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Background Image For Login Page<span class="text-danger">*</span></label>
                            <image class="profile-img" src="../assets/img/<?php echo $key['background_login_image']; ?>" style="height:35%;width:35%;">
                                <input type="hidden" value="<?php echo $key['background_login_image']; ?>" name="old_back_login_image">
                                <input type="file" class="form-control" name="back_login_image">
                        </div>
                        <!-- <div class="mb-3 col-md-6">
                            <label class="form-label">QR Code For Payment<span class="text-danger">*</span></label>
                            <image class="profile-img" src="../assets/img/<?php echo $key['pay_qrcode']; ?>" style="height:35%;width:35%;">
                                <input type="hidden" value="<?php echo $key['pay_qrcode']; ?>" name="old_qr_image">
                                <input type="file" class="form-control" name="back_qr_image">
                        </div> -->
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Footer<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="<?php echo $key['footer']; ?>" name="footer">
                        </div>


                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <button type="submit" class="btn btn-space btn-primary " type="submit" name="btn_web">Update</button>
                                <button class="btn btn-space btn-secondary">Cancel</button>
                            </div>
                        </div>
                </form>
            <?php } ?>
            </div>
        </div>
    </div>

</div>

</div>


<?php include('include/footer.php'); ?>