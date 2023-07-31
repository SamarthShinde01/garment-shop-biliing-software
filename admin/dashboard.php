<?php


session_start();
error_reporting(0);
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
?>
<?php include('include/sidebar.php'); ?>
<?php include('include/header.php'); ?>
<div class="content-body mb-5 p-3">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="heading mb-3">
          <h3>Dashboard</h3>
        </div>
      </div>
      <?php
      $sql = "select count(*) as cnt from stock";
      $row = $db->query($sql)->fetch();
      $a = $row['cnt'];
      ?>
      <?php
      $sql = "select count(*) as cnt from customer";
      $row = $db->query($sql)->fetch();
      $b = $row['cnt'];
      ?>
      <?php
      $sql = "select count(*) as cnt from sale";
      $row = $db->query($sql)->fetch();
      $c = $row['cnt'];
      ?>
      <?php
      $sql = "select count(*) as cnt from category";
      $row = $db->query($sql)->fetch();
      $d = $row['cnt'];
      ?>
      <?php
      $sql = "select count(*) as cnt from product";
      $row = $db->query($sql)->fetch();
      $e = $row['cnt'];
      ?>
      <?php
      $sql = "select count(*) as cnt from supplier";
      $row = $db->query($sql)->fetch();
      $f = $row['cnt'];
      ?>
    </div>


    <div class="row mb-5">
      <div class="col-md-3">
        <a href="managestock.php">
          <div class="card dashboard">
            <div class="card-body bg-primary">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h4><?php echo $a; ?></h4>
                  <p class="mb-0">Total Stock</p>
                </div>
                <i class="fas fa-shopping-cart"></i>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-3">
        <a href="customer.php">
          <div class="card dashboard">
            <div class="card-body bg-danger">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h4><?php echo $b; ?></h4>
                  <p class="mb-0">Total Customer</p>
                </div>
                <i class="nav-icon fas fa-users"></i>

              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3">
        <a href="sale-order.php">
          <div class="card dashboard">
            <div class="card-body bg-warning">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h4><?php echo $c; ?></h4>
                  <p class="mb-0">Total Sale</p>
                </div>
                <i class="fas fa-handshake"></i>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3">
        <a href="category.php">
          <div class="card dashboard">
            <div class="card-body bg-primary">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h4><?php echo $d; ?></h4>
                  <p class="mb-0">Total Category</p>
                </div>
                <i class="fa fa-book"></i>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3" style="margin-top: 20px;">
        <a href="product.php">
          <div class="card dashboard">
            <div class="card-body bg-info">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h4><?php echo $e; ?></h4>
                  <p class="mb-0">Total Products</p>
                </div>
                <i class="fa-solid fa-shirt"></i>
              </div>
            </div>
          </div>
        </a>
      </div>


      <div class="col-md-3" style="margin-top: 20px;">
        <a href="supplier.php">
          <div class="card dashboard">
            <div class="card-body bg-warning">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h4><?php echo $f; ?></h4>
                  <p class="mb-0">Total Suppliers</p>
                </div>
                <i class="fa-solid fa-truck"></i>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div>
        <br>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card border-0 shadow rounded-0">
            <div class="card-body">
              <div class="col-md-12">
                <div class="heading mb-3">
                  <h4>Calendar</h4>
                </div>
              </div>
              <div class="col-md-12">
                <!-- <div id='calendar'></div> -->
              </div>
              <!-- <div class="col-md-6">
                <div id="piechart" style="width: 100%; height: 500px;"></div>
              </div> -->
              <div class="col-md-6">
                <div id="piechart" style="width: 900px; height: 500px;"></div>
                <?php
                $j = 0;

                // $c=array("event_name","amount");
                $stmt = $db->prepare("select * from product");
                $stmt->execute();
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  // echo $result['event_name'];
                  // exit;

                  $res12 = $db->prepare("select sum(openning_stock) as sum3 from product where i_name='" . $result['i_name'] . "' and delete_status='0'");
                  $res12->execute();
                  // print_r($res12);exit;
                  $row18 = $res12->fetch(PDO::FETCH_ASSOC);
                  //echo $row18['sum3'];

                ?>
                <?php

                  $a1 .= $result['i_name'] . ',';
                  $b1 .= $row18['sum3'] . ',';


                  $j++;
                }
                $a = explode(",", $a1, -1);
                $b = explode(",", $b1, -1);
                // print_r($a);
                // print_r($b);exit;

                $data = '';
                for ($i = 0; $i < $j; $i++) {
                  $data .= "['" . $a[$i] . "'," . $b[$i] . "],";
                } ?>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- <marquee>This is an example of html marquee </marquee>   -->

    <?php include('include/footer.php'); ?>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work', 11],
          ['Eat', 2],
          ['Commute', 2],
          ['Watch TV', 2],
          ['Sleep', 7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <!-- pie chart script -->
    <script type="text/javascript">
      google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawChart);


      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['', ''], <?php echo $data; ?>
        ]);


        var options = {
          title: 'Event wise Revenue'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <!-- pie chart script end -->


    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          initialDate: '2020-09-12',
          navLinks: true, // can click day/week names to navigate views
          selectable: true,
          selectMirror: true,
          select: function(arg) {
            var title = prompt('Event Title:');
            if (title) {
              calendar.addEvent({
                title: title,
                start: arg.start,
                end: arg.end,
                allDay: arg.allDay
              })
            }
            calendar.unselect()
          },
          eventClick: function(arg) {
            if (confirm('Are you sure you want to delete this event?')) {
              arg.event.remove()
            }
          },
          editable: true,
          dayMaxEvents: true, // allow "more" link when too many events
          events: [{
              title: 'All Day Event',
              start: '2020-09-01'
            },
            {
              title: 'Long Event',
              start: '2020-09-07',
              end: '2020-09-10'
            },
            {
              groupId: 999,
              title: 'Repeating Event',
              start: '2020-09-09T16:00:00'
            },
            {
              groupId: 999,
              title: 'Repeating Event',
              start: '2020-09-16T16:00:00'
            },
            {
              title: 'Conference',
              start: '2020-09-11',
              end: '2020-09-13'
            },
            {
              title: 'Meeting',
              start: '2020-09-12T10:30:00',
              end: '2020-09-12T12:30:00'
            },
            {
              title: 'Lunch',
              start: '2020-09-12T12:00:00'
            },
            {
              title: 'Meeting',
              start: '2020-09-12T14:30:00'
            },
            {
              title: 'Happy Hour',
              start: '2020-09-12T17:30:00'
            },
            {
              title: 'Dinner',
              start: '2020-09-12T20:00:00'
            },
            {
              title: 'Birthday Party',
              start: '2020-09-13T07:00:00'
            },
            {
              title: 'Click for Google',
              url: 'dashboard.php',
              start: '2020-09-28'
            }
          ]
        });

        calendar.render();
      });
    </script>