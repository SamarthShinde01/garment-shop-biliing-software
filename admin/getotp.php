<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   

   
  </head>
  <body class="fpassword">
    <div class="container-fluid">
            <div class="row align-items-center justify-content-center login-body">

                <div class="col-md-4 mx-auto ">
                  <div class="logo text-center py-3 bg-primary rounded-top" >
                             <img src="../assets/img/logo13c.png" width="150px">
                          </div>
                    <div class="card border-0  rounded-0 pb-3">
                        <div class="card-body py-5 px-4">
                          
                           <form action="app/login-crud.php" method="POST" id="fpassword_change">
                          <div class="mb-3">
                            <label class="form-label">Varify OTP</label>
                            <input type="text" class="form-control" name="otp" placeholder="Enter Your  Registered Email" >
                          </div>
                            <div class="text-center">
                              <button type="submit" name="submit3" class="btn btn-primary rounded-0 " onclick="submit_fpassword()">Get OTP</button>
                            </div>
                        </div>
                    </div>
                </div>
               </div>
            </div>
          <script src="assets/js/jquery.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
          <script src="assets/js/bootstrap.bundle.min.js"></script>
          <script src="assets/js/main.js"></script>
   
  
  </body>
</html>

