<?php


session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}

?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="content-body mb-5 p-3">
    <div class="row1">
        <div class="col-md-12">
            <div class="heading mb-4 d-flex align-items-center justify-content-between">
                <h3 class="mb-0">Sale Order Details </h3>
                <p class="m-0"><a href="dashboard.php" class="text-primary">Dashoboard </a> <span class="disable">/ Manage </span></p>
            </div>
        </div>
    </div>
    <div class="card-header">
        <a href="add_sale_order11.php"><button class="btn btn-primary" type="submit" name=""> Add Order </button></a>
    </div>



    <!-- Manage order details -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No.</th>
                                    <th>Customer</th>
                                    <th>Contact No.</th>
                                    <!-- <th>Address</th> -->
                                    <!--  <th>Quantity</th> -->
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php


                                $cnt = 1;
                                $stmt = $db->prepare("SELECT * from sale INNER JOIN customer ON sale.cust_id=customer.cust_id ;");
                                $stmt->execute();
                                $record = $stmt->fetchAll();
                                $i = 1;
                                foreach ($record as $row) {
                                ?>

                                    <!--Fetch the Records -->
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['invoice_no']; ?></td>
                                        <td><?php echo $row['cust_fname'] . ' ' . $row['cust_lname']; ?></td>
                                        <td><?php echo $row['cust_mobile']; ?></td>
                                        <!-- <td><?php echo $row['cust_add']; ?></td> -->
                                        <td><?php echo $row['amount']; ?></td>
                                        <td><?php echo $row['sale_date']; ?></td>
                                        <td>
                                            <a href="edit-saleorder.php?soid=<?php echo $row['saleid']; ?>" class="btn btn-primary btn-sm "><i class="icon-line-awesome-edit fs-5"></i></a>
                                            <a href="sale-bill.php?saleid=<?php echo $row['saleid']; ?>" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i></a>
                                            <a href="app/sale-crud.php?delid=<?php echo $row['saleid']; ?>" class="btn btn-danger btn-sm " onclick="return confirm('Do you really want to Delete ?');"><i class="icon-line-awesome-trash-o fs-5"></i></a>
                                        </td>

                                    </tr>
                                <?php
                                    $cnt++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    function Product(eve) {

        var val = $(eve).val();
        var current = $(eve).closest('.auto');

        $.ajax({

            type: "POST",

            url: "app/sale-crud.php",

            data: "i_id=" + val,
            dataType: 'JSON',
            // 
            primary: function(response) {
                //alert(response['display2'][0].country_name);

                $("#product_loading").find('.add').val(response['display1'][0].i_prize);
                // $("#product_loading").fadeIn(500).html(data);


            }

        });

    }
</script>


<!-- script for customer details automatically display -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script type="text/javascript">
    //$(function(){
    $(document).ready(function() {

        $("#cust").change(function() {
            var address = $('#cust').find(":selected").attr('data-addrs');
            $('#address').val(address);
        });

        $("#cust").change(function() {
            var email = $('#cust').find(":selected").attr('data-email');
            $('#email').val(email);
        });


        $("#cust").change(function() {
            var mobile_no = $('#cust').find(":selected").attr('data-mobile');
            $('#mobile').val(mobile_no);
        });

    });
</script>
<!-- script end -->
<script>
    $('div.mydiv').on("change", 'select[name^="product_id"]', function(event) {
        var drop_services = $(this).val();
        var cnt = 0;
        $(".product_id").each(function() {
            if (drop_services == $(this).val()) {
                cnt++;
            }
        });
        if (cnt >= 2) {
            alert('Product already exists');
            return false;
        }
        var drop_services = $(this).val();
        var currentRow = $(this).closest('.subdiv');
        //console.log(currentRow);


        $.ajax({
            type: "POST",
            dataType: "json",
            url: 'app/sale-crud.php',
            data: {
                drop_services: drop_services
            },
            primary: function(data) {
                //currentRow.find('input[name^="quantity"]').val(1);
                currentRow.find('input[name^="aquantity"]').val(data['product']['openning_stock']);
                currentRow.find('input[name^="quantity"]').val(0);
                currentRow.find('input[name^="quantity"]').attr('max', data['product']['openning_stock']);

                currentRow.find('input[name^="sale_price"]').val(data['product']['unit_price']);
                var quantity = currentRow.find('input[name^="quantity"]').val();

                var total = data['product']['unit_price'];
                currentRow.find('input[name^="total"]').val(total);

                var rate = parseInt(total) / parseInt(quantity);
                //currentRow.find('input[name^="rate"]').val(rate);
                var rate = data['product']['unit_price'];
                currentRow.find('input[name^="rate"]').val(rate);

                //var total=+currentRow.find('input[name^="total"]').val(total);
                // $('#subtotal').val(total);
                var sum = 0;
                $('.total').each(function() {
                    if ($(this).val() != '') {
                        sum += parseInt($(this).val());
                    }

                });

                var sub = $('#subtotal').val(sum);
                var fsub = $('#final_total').val(sum);

                var tot_commi = 0;
                $('.tax_amount').each(function() {
                    tot_commi += Number($(this).val());
                });
                $('#total_tax_amount').val(tot_commi);
                var tot_commi = 0;
                $('.taxable_amount').each(function() {
                    tot_commi += Number($(this).val());
                });
                $('#total_taxable_amount').val(tot_commi);
            }
        });

    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#min_price').change(function() {
            var price = $(this).val();
            $("#price_range").text("Product under Price Rs." + price);
            $.ajax({
                url: "load_product.php",
                method: "POST",
                data: {
                    price: price
                },
                primary: function(data) {
                    $("#product_loading").fadeIn(500).html(data);
                    $(current).find('.prize').val(response['display1'][0].i_prize);
                }
            });
        });
    });
</script>
<?php include('include/footer.php'); ?>