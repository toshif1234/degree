<?php session_start();
require_once "../config.php";
?>
<?php
$fac_sub = 'select * from faculty_mapping fm, faculty_details fd where fm.sub_name = "' . $_SESSION['sub'] . '" and fd.faculty_dept = "' . $_POST['fac_dept'] . '" and fm.faculty_name = fd.faculty_name';
$fac_name = mysqli_fetch_assoc($link->query($fac_sub))['faculty_name'];
$fac_dept = mysqli_fetch_assoc($link->query($fac_sub))['faculty_dept'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Download</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
  <!-- <input onclick="pri()" class="btn btn-primary" name="" id="" value='Print'>  -->
  <div class="container" id="all">
    <div class="row mt-3 mb-2 text-center">
      <div class="col col-md-1 col-lg-1 col-1">
        <img src="../asset/img/aiet-logo.png" alt="" width="120">
      </div>
      <div class="col col-md-11 col-lg-11 col-11 " style="padding-right: 80px;">
        <h1>ALVA'S INSTITUTE OF ENGINEERING AND TECHNOLOGY, MIJAR</h1>
      </div>
    </div>
    <hr style="border-top: 1px solid black;">
    <div class="row">
      <div class="col">
        <h2 class="mt-3 mb-4 text-center">FEEDBACK ANALYSIS REPORT: COURSE END</h2>
      </div>
    </div>
    <div class="row mt-3 mb-2">

      <div class="col col-6 col-md-6 col-lg-6" style="justify-content: left;">
        <h5>Faculty Name: <?php echo $fac_name ?></h5>
      </div>
      <div class="col col-6 col-md-6 col-lg-6" style="justify-content: center;">
        <h5>Class: <?php echo $_SESSION['semester'] . ' ' . $_SESSION['section'] ?> </h4>
      </div>
    </div>
    <div class="row mt-3 mb-5">
      <div class="col col-6 col-md-6 col-lg-6" style="justify-content: right;">
        <h5>Subject: <?php echo $_SESSION['full_sub'] ?></h5>
      </div>
      <div class="col col-6 col-md-6 col-lg-6" style="justify-content: right;">
        <h5>Department: <?php echo $fac_dept ?></h4>
      </div>
    </div>
    <?php


    $indexes = $_POST['index'];
    $comments = $_POST['comments'];
    $g1 = $_POST['g1'];
    $g2 = $_POST['g2'];
    $g3 = $_POST['g3'];
    $co1 = $_POST['co1'];
    $co2 = $_POST['co2'];
    $co3 = $_POST['co3'];
    $co4 = $_POST['co4'];
    $co5 = $_POST['co5'];
    $rating_feed = array(
      "G1" => $g1,
      "G2" => $g2,
      "G3" => $g3,
      "CO1" => $co1,
      "CO2" => $co2,
      "CO3" => $co3,
      "CO4" => $co4,
      "CO5" => $co5
    );
    // print_r($rating_feed);
    // print_r($indexes);

    ?>
    <div class="row" style="margin-right: 150px;">
      <div class="col">
        <div id="container1">
          <canvas id="canvas" style="width:80%;max-height:500px;min-height:300px;"></canvas>
        </div>
      </div>
    </div>

    <script>
      var sa = [];
      var i = 0;
      <?php
      for ($i = 0; $i < 8; $i++) {
      ?>
        sa[i++] = <?php echo $rating_feed[$indexes[$i]][0]; ?>;
      <?php } ?>
      var a = [];
      i = 0;
      <?php
      for ($i = 0; $i < 8; $i++) {
      ?>
        a[i++] = <?php echo $rating_feed[$indexes[$i]][1]; ?>;
      <?php } ?>
      var n = []
      i = 0
      <?php
      for ($i = 0; $i < 8; $i++) {
      ?>
        n[i++] = <?php echo $rating_feed[$indexes[$i]][2]; ?>;
      <?php } ?>
      var d = []
      i = 0
      <?php
      for ($i = 0; $i < 8; $i++) {
      ?>
        d[i++] = <?php echo $rating_feed[$indexes[$i]][3]; ?>;
      <?php } ?>
      var sd = []
      i = 0
      <?php
      for ($i = 0; $i < 8; $i++) {
      ?>
        sd[i++] = <?php echo $rating_feed[$indexes[$i]][4]; ?>;
      <?php } ?>



      var barChartData = {
        labels: [
          "G1", "G2", "G3", "CO1", "CO2","CO3","CO4","CO5"
        ],
        datasets: [{
            label: "Strongly Agree",
            backgroundColor: "pink",
            borderColor: "red",
            borderWidth: 1,
            data: sa
          },
          {
            label: "Agree",
            backgroundColor: "lightblue",
            borderColor: "blue",
            borderWidth: 1,
            data: a
          },
          {
            label: "Neutral",
            backgroundColor: "lightgreen",
            borderColor: "green",
            borderWidth: 1,
            data: n
          },
          {
            label: "Disagree",
            backgroundColor: "yellow",
            borderColor: "orange",
            borderWidth: 1,
            data: d
          },
          {
            label: "Strongly Disagree",
            backgroundColor: "#9A0680",
            borderColor: "#781C68",
            borderWidth: 1,
            data: sd
          }
        ]
      };

      var chartOptions = {
        responsive: true,
        legend: {
          position: "top"
        },
        title: {
          display: true,
          text: "Chart.js Bar Chart"
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }

      window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
          type: "bar",
          data: barChartData,
          options: chartOptions
        });

      };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <h3 class="mt-4 mb-2">COMMENTS</h3>
    <div class="text-margin">

      <?php
      foreach ($comments as $c) {
      ?>
        <input type="text" name="" id="" class="form-control" value="<?php echo $c ?>" readonly><br>

      <?php } ?>


      <div class="row mr-2 ml-2 mb-2">
        <label for="observation">OBSERVATIONS</label>
        <div class="border border-dark" style="height: 100px; width: 100%;" id="observation">

        </div>
        <label for="action">ACTION PLAN</label>
        <div class="border border-dark mb-5" style="height: 100px; width: 100%;" id="action">

        </div>
      </div>
      <div class="row mt-5 mr-2 ml-2">
        <div class="col col-6 col-md-6 col-lg-6">
          <span style="float: left;">Faculty Signature</span>
        </div>
        <div class="col col-6 col-md-6 col-lg-6">
          <span style="float: right;">HOD Signature</span>
        </div>
      </div>
    </div>

  </div>
  <script>
    setTimeout(function() {
      window.print();
    }, 1000);
  </script>
  <style>
    @media print {
      .text-margin {
        margin: 30px 20px 0 20px;
      }
    }
  </style>
</body>

</html>