<?php
// error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>

<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>

<div class="contend-body mb-5 p-3">
    <div class="row">
        <div class="col-md-12">
            <div class="heading mb-4 d-flex align-items-center justify-content-between">
                <h3 class="mb-0"><i class='fas fa-shopping-cart'></i>&nbsp;&nbsp;&nbsp;Add Order</a> </h3>
                <p class="m-0"><a href="dashboard.php" class="text-primary">Add </a> <span>/ Order-Info</span></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="auto">
                        <form class="row" method="POST" action="app/sale-crud.php" id="sale_info">

                            <!-- invoice number auto add-->

                            <div class="mb-3 col-md-4">
                                <label class="form-label">Invoice Number<span class="text-danger">*</span></label>
                                <?php
                                function random_strings($length_of_string)
                                {
                                    // String of all alphanumeric character
                                    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                                    // Shuffle the $str_result and returns substring
                                    // of specified length
                                    return substr(
                                        str_shuffle($str_result),
                                        0,
                                        $length_of_string
                                    );
                                }

                                // This function will generate
                                // Random string of length 10
                                $new = random_strings(7);
                                ?>
                                <input type="text" class="form-control" name="invoiceno" value="<?php echo $new; ?>">
                            </div>
                            <!-- end auto invoice -->

                            <!-- invoice date -->
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Invoice date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="saledate" value="<?php echo date('Y-m-d'); ?>" readonly>
                            </div>

                            <!-- fetch identification number from checkin table -->

                            <div class="mb-3 col-md-4">
                                <label class="form-label">Select Identification .No<span class="text-danger">*</span></label>
                                <?php
                                $cnt = 1;

                                $stmt = $db->prepare("select * from checkin");
                                $stmt->execute();
                                $record = $stmt->fetchAll();
                                $i = 1; ?>
                                <select class="form-select" aria-label="Default select example" type="text" onchange="Identification(this);" name="identino" id="mySelect2">
                                    <option value="">choose one</option>
                                    <?php foreach ($record as $row) { ?>
                                        <option value=" <?php echo $row['checkid'] ?>">
                                            <?php echo $row['identino']; ?> <?php }; ?>
                                        </option>
                                </select>
                            </div>

                            <!-- end fetch values -->

                            <div class="mb-3 col-md-4">
                                <label class="form-label add2">Customer name<span class="text-danger">*</span></label>
                                <input type="tel" class="form-control add2 " name="custname">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label add4">Customer Contact.No<span class="text-danger">*</span></label>
                                <input type="tel" class="form-control add4 " name="cust_mobile">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label add3">Hardware.No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control add3" name="hardwareno">
                            </div>

                            <!-- service name fetch from service table-->
                            <div class="mb-3 col-md-4">
                                <label class="form-label">Select Service Name<span class="text-danger">*</span></label>
                                <?php
                                $cnt = 1;

                                $stmt = $db->prepare("select * from service");
                                $stmt->execute();
                                $record = $stmt->fetchAll();
                                $i = 1; ?>
                                <select class="form-select" aria-label="Default select example" type="text" onchange="Service(this);" name="sername" id="sername">
                                    <option value="">choose one</option>
                                    <?php foreach ($record as $row) { ?>
                                        <option value=" <?php echo $row['serid'] ?>">
                                            <?php echo $row['sername']; ?> <?php }; ?>
                                        </option>
                                </select>
                            </div>
                            <!-- end fetch values -->
                            <div class="mb-3 col-md-4">
                                <label class="form-label add1">Service charges<span class="text-danger">*</span></label>
                                <input type="text" class="form-control add1" name="sercharges">
                            </div>


                            <!-- multiple values -->
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-1">Sr no.</div>

                                <div class="col-sm-3">
                                    Select Item
                                </div>
                                <div class="col-sm-2">
                                    Item Prize
                                </div>

                                <div class="col-sm-2">Item
                                    Quantity
                                </div>

                                <div class="col-sm-2">
                                    Sub Total
                                </div>
                                <div class="col-sm-2">
                                    Action
                                </div>
                            </div>
                            </hr>
                            <hr><br></hr>
                            <div class="mydiv">
                                <!-- mydiv is for add multiple values -->
                                <div class="form-group row control-group after-add-more subdiv align-items-center">
                                    <div class="mb-3 col">

                                        <div class="sr_no">1</div>
                                    </div>
                                    <div class="mb-3 col">
                                        <?php
                                        $cnt = 1;

                                        $stmt = $db->prepare("select * from item");
                                        $stmt->execute();
                                        $record = $stmt->fetchAll();
                                        $i = 1; ?>
                                        <select class="form-select" aria-label="Default select example" type="text" name="itemname[]" id="itemname">
                                            <option value="">choose one</option>
                                            <?php foreach ($record as $row) { ?>
                                                <option value=" <?php echo $row['itemid'] ?>">
                                                    <?php echo $row['itemname']; ?> <?php }; ?>
                                                </option>
                                        </select>
                                    </div>
                                    <!-- end fetch values -->
                                    <div class="mb-3 col">
                                        <input type="text" class="form-control add" name="itemprice[]" id="itemprice">
                                    </div>
                                    <div class="mb-3 col">
                                        <input type="text" class="form-control" name="itemquantity[]" id="itemquantity">
                                    </div>
                                    <div class="mb-3 col">
                                        <input type="text" class="form-control" name="total[]" id="total" onclick="amount()">
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary add-more" type="button"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- end mydiv -->

                            <!-- hide value -->
                            <div class="copy hide" style="display:none;">
                                <div class="form-group control-group row subdiv align-items-center">
                                    <div class="mb-3 col">
                                        <div class="sr_no"></div>
                                    </div>
                                    <div class="mb-3 col">

                                        <?php
                                        $cnt = 1;

                                        $stmt = $db->prepare("select * from item");
                                        $stmt->execute();
                                        $record = $stmt->fetchAll();
                                        $i = 1; ?>
                                        <select class="form-select" aria-label="Default select example" type="text" name="itemname[]" id="itemname">
                                            <option value="">choose one</option>
                                            <?php foreach ($record as $row) { ?>
                                                <option value=" <?php echo $row['itemid'] ?>">
                                                    <?php echo $row['itemname']; ?> <?php }; ?>
                                                </option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col">

                                        <input type="text" class="form-control add" name="itemprice[]" id="itemprice">
                                    </div>
                                    <div class="mb-3 col">

                                        <input type="text" class="form-control" name="itemquantity[]" id="itemquantity">
                                    </div>
                                    <div class="mb-3 col">

                                        <input type="text" class="form-control" name="total[]" id="total" onclick="amount()">
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-danger remove" type="button"><i class="fa fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- end hide div -->
                            <hr>
                            </hr>
                            <div class="mb-3 col">
                                <label class="form-label">Total Amount<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="amtotal" id="amtotal">
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label">Payment Type<span class="text-danger">*</span></label>
                                <select class="form-control" name="paymenttype" id="paymenttype">
                                    <option value="">~~SELECT~~</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Phone Pe">Phone Pe</option>
                                    <option value="Google Pay">Google Pay</option>
                                    <option value="Amazon Pay">Amazon Pay</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Credit Card">Credit Card</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label">Repair Status<span class="text-danger">*</span></label>
                                <select class="form-control" id="paymentstatus" name="paymentstatus">
                                    <option value="">~~SELECT~~</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label">Delivery Date<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="deliverydate">
                            </div>

                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm" onclick="validatesale()">Submit</button>
                                <input class="btn btn-secondary btn-sm" type="reset" value="Reset">
                            </div>

                        </form>
                    </div>
                    <!-- script for find total -->
                    <script>
                    </script>
                    <!-- end script -->

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ajax script for item values -->
<script>
    function Item(eve) {
        var val = $(eve).val();
        var current = $(eve).closest('.auto');
        $.ajax({
            type: "POST",
            url: "app/sale-crud.php",
            data: "itemid=" + val,
            dataType: 'JSON',
            // 
            primary: function(response) {
                // alert(response['display2'][0].country_name);

                $(current).find('.add').val(response['display1'][0].itemprice);
                // $(current).find('.num').val(response['display2'][0].mobile);
            }
        });
    }
</script>

<!-- end script -->

<!-- ajax script for Service values -->
<script>
    function Service(eve) {
        var val = $(eve).val();
        var current = $(eve).closest('.auto');
        $.ajax({
            type: "POST",
            url: "app/sale-crud.php",
            data: "serid=" + val,
            dataType: 'JSON',
            // 
            primary: function(response) {
                // alert(response['display2'][0].country_name);
                $(current).find('.add1').val(response['display1'][0].sercharges);
                // $(current).find('.num').val(response['display2'][0].mobile);
            }
        });
    }
</script>
<!-- end script -->


<!-- ajax script for Identification values -->
<script>
    function Identification(eve) {
        var val = $(eve).val();
        var current = $(eve).closest('.auto');
        $.ajax({
            type: "POST",
            url: "app/sale-crud.php",
            data: "checkid=" + val,
            dataType: 'JSON',
            // 
            primary: function(response) {
                // alert(response['display2'][0].country_name);

                $(current).find('.add2').val(response['display2'][0].cust_name);
                $(current).find('.add3').val(response['display1'][0].hardwareno);
                $(current).find('.add4').val(response['display3'][0].cust_mobile);


            }
        });
    }
</script>
<!-- end script -->


<?php include('include/footer.php'); ?>

<!-- script for add multiple inpute -->

<script>
    $('div.mydiv').on("change", 'select[name^="itemname"]', function(event) {

        var drop_services = $(this).val();
        var cnt = 0;
        $(".itemname").each(function() {
            if (drop_services == $(this).val()) {
                cnt++;
            }
        });
        if (cnt >= 2) {
            alert('item already exists');
            return false;
        }
        var drop_services = $(this).val();
        var currentRow = $(this).closest('.subdiv');
        //console.log(currentRow);
        // alert('hi');    

        $.ajax({
            type: "POST",
            dataType: "json",
            url: 'app/sale-crud.php',
            data: {
                drop_services: drop_services
            },
            primary: function(data) {
                // alert(data['display1'][itemid]);
                //  alert(data['display1']['itemprice']);
                currentRow.find('input[name^="price"]').val(data['display1']['itemprice']);



            }
        });

    });
</script>