<?php


session_start();
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>

<style>
  @media print {
    button {
      display: none;
    }
  }
</style>


<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>General Purpose Invoice</title>
  <link rel="stylesheet" href="../assets/css/style1.css">
</head>

<?php

$stmt = $db->prepare("SELECT * from manage_website");
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $key) {
  // code...

?>

  <body>
    <div class="tm_container">
      <div class="tm_invoice_wrap">
        <div class="tm_invoice tm_style1" id="tm_download_section">
          <div class="tm_invoice_in">
            <div class="tm_invoice_head tm_align_center tm_mb20">
              <div class="tm_invoice_left">
                <div class="tm_logo"><img src="../assets/img/<?php echo $key['login_logo'] ?>" alt="Logo" width="150px" height="200px"></div>
              </div>
            <?php } ?>
            <div class="tm_invoice_right tm_text_right">
              <div class="tm_primary_color tm_f50 tm_text_uppercase">Invoice</div>
            </div>
            </div>

            <?php
            $cnt = 1;
            $stmt = $db->prepare("SELECT * from sale INNER JOIN customer ON sale.cust_id=customer.cust_id where saleid=? ;");
            $stmt->execute([$_GET['saleid']]);
            $record = $stmt->fetchAll();
            $i = 1;
            foreach ($record as $row) {
            ?>


              <div class="tm_invoice_info tm_mb20">
                <div class="tm_invoice_seperator tm_gray_bg"></div>
                <div class="tm_invoice_info_list">
                  <p class="tm_invoice_number tm_m0">Invoice No: <b class="tm_primary_color">#<?php echo $row['invoice_no']; ?></b></p>
                  <p class="tm_invoice_date tm_m0">Date: <b class="tm_primary_color"><?php echo date("d/m/Y") ?></b></p>
                </div>
              </div>
              <div class="tm_invoice_head tm_mb10">
                <div class="tm_invoice_left">
                  <p class="tm_mb2"><b class="tm_primary_color">Invoice To:</b></p>
                  <p>
                    <?php

                    $stmt = $db->prepare("SELECT * from admin ");
                    $stmt->execute();
                    $record = $stmt->fetchAll();
                    foreach ($record as $key) {
                      // code...

                    ?>

                      Name: <?php echo $key['admin_fname'] . ' ' . $key['admin_lname']; ?><br>
                      Email: <?php echo $key['admin_email']; ?><br>

                      Address: <?php echo $key['address']; ?><br>
                      Mobile: <?php echo $key['admin_mobileno']; ?><br>
                    <?php } ?>
                  </p>
                </div>
                <div class="tm_invoice_right tm_text_right">
                  <p class="tm_mb2"><b class="tm_primary_color">Pay To:</b></p>
                  <p>
                    Name: <?php echo $row['cust_fname'] . ' ' . $row['cust_lname']; ?><br>
                    Email: <?php echo $row['cust_email']; ?><br>
                    Address: <?php echo $row['cust_add']; ?><br>
                    Mobile:<?php echo $row['cust_mobile']; ?><br>


                  </p>
                </div>
              </div>
              <div class="tm_table tm_style1 tm_mb30">
                <div class="tm_round_border">
                  <div class="tm_table_responsive">
                    <table>
                      <thead>
                        <tr>
                          <th class="tm_width_3 tm_semi_bold tm_primary_color tm_gray_bg">Item</th>
                          <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">Price</th>
                          <th class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg">Units</th>
                          <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg ">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $cnt = 1;

                        // $stmt = $db->prepare("SELECT * from sale INNER JOIN customer ON sale.cust_id=customer.cust_id where saleid=? ;");  
                        $stmt = $db->prepare("SELECT * from sale_item INNER JOIN sale ON sale_item.sale_id=sale.saleid where sale_id=? ;");
                        $stmt->execute([$_GET['saleid']]);
                        $record = $stmt->fetchAll();
                        $i = 1;
                        foreach ($record as $row11) {

                          $r = $row11['itemname'];
                          $stmt = $db->prepare("SELECT * from product  where i_id='$r' ;");
                          $stmt->execute();
                          $record = $stmt->fetchAll();
                          $i = 1;
                          foreach ($record as $row12) {  ?>
                            <tr>
                              <td><?php echo $row12['i_name']; ?></td>

                              <td><?php echo $row11['itemprice']; ?></td>
                              <td><?php echo $row11['itemquantity']; ?></td>
                              <td><?php echo $row11['total']; ?></td>
                            </tr>
                        <?php
                            $cnt = $cnt + 1;
                          }
                        } ?>


                      </tbody>

                    </table>
                  </div>
                </div>
                <!-- <div class="tm_invoice_footer"> -->
                <!--   <div class="tm_left_footer">
                <p class="tm_mb2"><b class="tm_primary_color">Payment info:</b></p>
                <p class="tm_m0">Credit Card - 236***********928 <br>Amount: $1732</p>
              </div> -->
                <div class="tm_left_footer">
                  <table>
                    <tbody>
                      <tr>
                        <td class="tm_width_3 tm_primary_color tm_border_none tm_bold">Discount</td>
                        <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold"><?php echo $row['discount']; ?></td>
                      </tr>
                      <tr>
                        <td class="tm_width_3 tm_primary_color tm_border_none tm_bold">GST</td>
                        <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold"><?php echo $row['gst']; ?></td>
                      </tr>
                      </tr>
                      <tr class="tm_border_top tm_border_bottom">
                        <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color">Grand Total </td>
                        <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold"><?php echo $row['amount']; ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- </div> -->
                </div>
              </div>
              <div class="tm_padd_15_20 tm_round_border">
                <p class="tm_mb5"><b class="tm_primary_color">Terms & Conditions:</b></p>
                <ul class="tm_m0 tm_note_list">
                  <li>Payment Terms: <br>
                    a. All invoices are due and payable within [number of days] days from the date of the invoice.</li>
                  <li>Returns and Exchanges: <br>
                    a. We accept returns and exchanges within [number of days] days of the purchase, provided the garments are in their original condition with tags attached.
                    b. Refunds will be issued in the same form as the original payment, excluding any shipping or handling charges.</li>
                  <li>Warranty: <br>
                    a. Our garments are warranted to be free from defects in materials and workmanship for a period of [duration].
                    b. This warranty does not cover damage resulting from misuse, normal wear and tear, or improper care.</li>
                  <li>Pricing: <br>
                    a. All prices are listed in the local currency and are exclusive of applicable taxes, duties, or shipping charges.</li>
                  <li>Ownership: <br>
                    a. Ownership of the garments remains with the garment shop until full payment is received.
                    b. The garment shop reserves the right to repossess any unpaid items.</li>
                  <li>By making a purchase from our garment shop, you agree to be bound by these terms and conditions. Please read them carefully before proceeding with your purchase.</li>
                </ul>
              </div><!-- .tm_note -->
          </div>
        </div>
        <!-- print button -->

        <div class="tm_invoice_btns tm_hide_print">
          <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
            <span class="tm_btn_icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                <path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                <circle cx="392" cy="184" r="24" fill='currentColor' />
              </svg>
            </span>
            <span class="tm_btn_text">Print</span>
          </a>
          <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
            <span class="tm_btn_icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                <path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
              </svg>
            </span>
            <span class="tm_btn_text">Download</span>
          </button>
        </div>

      </div>
    </div>
  <?php
              $cnt = $cnt + 1;
            }  ?>

  </body>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/jspdf.min.js"></script>
  <script src="../assets/js/html2canvas.min.js"></script>
  <!-- <script src="../assets/js/main.js"></script> -->

</html>
<?php include('include/footer.php'); ?>