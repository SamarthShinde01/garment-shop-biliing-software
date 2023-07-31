<?php include('assets/constant/config.php'); ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Template</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/responsive.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <?php

  $stmt = $db->prepare("SELECT * from manage_website");
  $stmt->execute();
  $result = $stmt->fetchAll();
  foreach ($result as $key) {
    // code...

  ?>
</head>

<body class="login">

  <div class="container-fluid" style="background-image: url('assets/img/<?php echo $key['background_login_image']; ?>');
background-color: #cccccc;  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;   height: 100%;">

    <div class="container-fluid">
      <div class="row align-items-center justify-content-center login-body">

        <div class="col-md-4 mx-auto ">
          <div class="logo text-center py-3 bg-primary rounded-top">
            <img src="assets/img/<?php echo $key['login_logo']; ?>" width="150px">
          </div>
          <div class="card border-0  rounded-0 pb-3">
            <div class="card-body py-5 px-4">

              <form action="admin/app/login-crud.php" method="POST">
                <div class="mb-3">
                  <label class="form-label">Email address</label>
                  <input type="email" class="form-control" name="email" placeholder="Enter Your Email">

                </div>
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                </div>
                <div style="color:blue;">
                  <span class="psw"><u> <a href="fpassword.php">Forgot password?</u></a></span>
                </div>
                <div class="mb-3 form-check" style="padding: 10px;">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Remember me </label>
                </div>
              <?php } ?>
              <div class="mb-3">
                <div class="g-recaptcha" data-sitekey="6LdJC4AeAAAAAE638ShRfVSMBDSDjbQmkxD-lh_p"></div>
              </div>
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary rounded-0 ">Log In</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>