<?php include('../assets/constant/config.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php

    $stmt = $db->prepare("SELECT * from manage_website");
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $key) {
        // code...

    ?>

        <title><?php echo $key['title'] ?></title>
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/style.css" rel="stylesheet">
        <link href="../assets/css/select2.css" rel="stylesheet">
        <link rel="shortcut icon" href="../assets/img/<?php echo $key['website_logo']; ?>">
        <link href="../assets/css/responsive.css" rel="stylesheet">
        <link href="../assets/css/icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="../assets/css/datatables/jquery.dataTables.min.css" rel="stylesheet">
        <link href="../assets/css/datatables/buttons.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/solid.min.css" integrity="sha512-bdTSJB23zykBjGDvyuZUrLhHD0Rfre0jxTd0/jpTbV7sZL8DCth/88aHX0bq2RV8HK3zx5Qj6r2rRU/Otsjk+g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>

    <div id="page"></div>
    <div id="loading"></div>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="position">
                <div class="sidebar-header">
                    <a href="dashboard.php"><img src="../assets/img/<?php echo $key['login_logo'] ?>" width="150px"></a>
                </div>

            <?php } ?>

            <ul class="list-unstyled components" id="menu">
                <!-- <p>Dummy Heading</p> -->
                <li class="s-item">
                    <a href="dashboard.php"><i class="icon-feather-home"></i>&nbsp;&nbsp;&nbsp;Home</a>
                </li>

                <li class="s-item">
                    <a href="category.php"><i class="fa fa-book"></i>&nbsp;&nbsp;&nbsp; Category</a>
                </li>

                <li class="s-item">
                    <a href="product.php"><i class="fa-solid fa-shirt"></i>&nbsp;&nbsp;&nbsp; Items</a>
                </li>
                <li class="s-item">
                    <a href="supplier.php"><i class="fa-solid fa-truck"></i>&nbsp;&nbsp;&nbsp; Supplier</a>
                </li>

                <!-- <li class="s-item">
                    <a href="stock.php"><i class="fa-solid fa-box-open"></i>&nbsp;&nbsp;&nbsp; Stock</a>
                </li> -->
                <li class="s-item">
                    <a href="customer.php"><i class="nav-icon fas fa-users"></i>&nbsp;&nbsp;&nbsp; Customers</a>
                </li>



                <!-- <li class="s-item">
                    <a href="payment.php" aria-bs-expanded="false"><i class='fas fa-handshake'></i>&nbsp;&nbsp;&nbsp; Payment</a>
                </li> -->

                <li class="s-item">
                    <a href="#pageReports2" data-bs-toggle="collapse" aria-bs-expanded="false" class="dropdown-toggle"><i class='fas fa-shopping-cart'></i>&nbsp;&nbsp;&nbsp; Stock</a>
                    <ul class="collapse list-unstyled" id="pageReports2" data-bs-parent="#menu">
                        <li>
                            <a href="stock.php" class="ms-3">Add Stock</a>
                        </li>
                        <li>
                            <a href="managestock.php" class="ms-3">Manage Stock</a>
                        </li>
                        <!-- <li>
                            <a href="sale-order33.php" class="ms-3">Sale Order M</a>
                        </li> -->
                    </ul>
                </li>

                <li class="s-item">
                    <a href="sale-order.php" aria-bs-expanded="false"><i class='fas fa-handshake'></i>&nbsp;&nbsp;&nbsp; Sale Order</a>
                </li>


                <li class="s-item">
                    <a href="#pageReports" data-bs-toggle="collapse" aria-bs-expanded="false" class="dropdown-toggle"><i class="fa-sharp fa-solid fa-square-poll-vertical"></i>&nbsp;&nbsp;&nbsp; Reports</a>
                    <ul class="collapse list-unstyled" id="pageReports" data-bs-parent="#menu">
                        <li>
                            <a href="stockreport.php" class="ms-3">Stock Report</a>
                        </li>
                        <li>
                            <a href="purchasereport.php" class="ms-3">Purchase Report</a>
                        </li>
                        <li>
                            <a href="salereport.php" class="ms-3">Sale Report</a>
                        </li>
                    </ul>
                </li>

                <li class="s-item">
                    <a href="manage_website.php"><i class="fa fa-cog"></i>&nbsp;&nbsp;&nbsp;Web Appearence</a>
                </li>
            </ul>
            </div>
        </nav>