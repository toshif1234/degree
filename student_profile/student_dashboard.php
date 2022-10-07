<?php
include("../template/stud_auth.php");
error_reporting(0);
include("../template/student_sidebar.php");
?>
<?php
// include "template/admin-auth.php";
require_once '../config.php';
// echo $_SESSION["username"];
$q1 = 'select branch, semester from students where usn = "' . $_SESSION['username'] . '"';
$r1 = mysqli_fetch_assoc($link->query($q1));
$branch = $r1['branch'];
$sem = $r1['semester'];


$q = 'select * from subjects where branch = "' . $branch . '" and sem = "' . $sem . '"';
$sub = array();
$subcode = array();
$marks = array();
$result = $link->query($q);
$num_sub = mysqli_num_rows($result);
foreach ($result as $r) {
    $sub[] = $r['sub_name'];
    $subcode[] = $r['sub_code'];
}
for ($i = 0; $i < $num_sub; $i++) {
    $q2 = 'select total1 from ia_marks1 where sub = "' . $subcode[$i] . ' - ' . $sub[$i] . '" and usn = "' . $_SESSION['username'] . ' "';
    $marks[$i] = mysqli_fetch_assoc($link->query($q2))['total1'] ?? 0;
}

// Notification check



// Notification check




?>
<style>
    #Back-btn {
        display: none;
    }

    .custom-nav-link {
        color: #252626de !important;
        font-size: 18px !important;
        background-color: rgb(255 148 0 / 20%) !important;

    }

    .nav-tabs .active {
        color: #ffffffe3 !important;
        background-color: rgb(241 61 61 / 83%) !important;
    }
</style>
<div>
    <div class="alert alert-dismissible alert-success custom-success-alert">
        <button type="button" class="btn-close" id="auto-close" data-bs-dismiss="alert"></button>
        <strong>Welcome!</strong> <?php echo $_SESSION["username"] ?>
    </div>

    <ul class="nav nav-tabs" style="justify-content: center !important;">
        <li class="nav-item">
            <a class="nav-link custom-nav-link active" data-bs-toggle="tab" href="#IA1">IA 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link custom-nav-link" data-bs-toggle="tab" href="#IA2">IA 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link custom-nav-link" data-bs-toggle="tab" href="#IA3">IA 3</a>
        </li>

    </ul>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade show active" id="IA1">
            <p>ia1</p>
        </div>
        <div class="tab-pane fade" id="IA2">
            <p>ia2</p>
        </div>
        <div class="tab-pane fade" id="IA3">
            <p>ia3</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div id="chart">
                    <canvas id="myChart" style="width:80%;max-height:500px;min-height:300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">

    </script>





    <script>
        var sa = [1, 2, 3, 4, 5];

        var barChartData = {
            labels: [
                "Time Sense", "Subject Command", "Use of Teacing Aid", "Helping Attitude", "Class Control"
            ],
            datasets: [{
                label: "Strongly Agree",
                backgroundColor:  'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 2,
                data: sa
            }]
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
            var ctx = document.getElementById("myChart").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: "bar",
                data: barChartData,
                options: chartOptions
            });
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>







    <script>
        setTimeout(function() {
            document.getElementById("auto-close").click();
        }, 2000);
    </script>
    <?php
    include("../template/student-footer.php");
    ?>