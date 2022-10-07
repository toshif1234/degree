<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

// echo $_SESSION['sub'];
// echo $_SESSION['feedback_name'];
if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
    $q_sem = 'select sem,sub_code from subjects where sub_name="' . $_SESSION['sub'] . '"';
} else {
    $q_sem = 'select sem,sub_code from subjects_new where sub_name="' . $_SESSION['sub'] . '"';
}
$r_sem = mysqli_fetch_assoc($link->query($q_sem));
// echo $r_sem['sem'];
$dept = 'select faculty_dept from faculty_details where faculty_name="' . $_SESSION['username'] . '"';
$r_dept = mysqli_fetch_assoc($link->query($dept));

if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
    $q_code = 'select sub_code from subjects where sub_name="' . $_SESSION['sub'] . '"';
} else {
    $q_code = 'select sub_code from subjects_new where sub_name="' . $_SESSION['sub'] . '"';
}
$r_code = mysqli_fetch_assoc($link->query($q_code));
$sem = $r_sem['sem'];
$subcode = $r_sem['sub_code'] . ' - ' . $_SESSION['sub'];
// echo $subcode;\
if ($_SESSION['section'] == 'ALL') {
    $feed = 'select * from feedback_response where feedback_name="Course End" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '"';
} else {
    $feed = 'select * from feedback_response where feedback_name="Course End" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and section="' . $_SESSION['section'] . '"and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '"';
}
// echo $feed;
// $feed='select * from feedback_response where sem="'.$sem.'" and feedback_name="'.$_SESSION['feedback_name'].'"and sub="'.$subcode.'"';
$r_feed = $link->query($feed);
// print_r($r_feed);
$count = 0;
if ($_SESSION['section'] == 'ALL') {
    $total = 'select count(name) from feedback_response where feedback_name="Course End" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '"';
} else {
    $total = 'select count(name) from feedback_response where feedback_name="Course End" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and section="' . $_SESSION['section'] . '"and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '"';
}
$r_total = mysqli_fetch_assoc($link->query($total));
// $total=mysqli_num_rows($r_feed);
foreach ($r_feed as $r) {
    for ($i = 1; $i <= 30; $i++) {
        if ($r['q' . $i] != 0) {
            $count = $count + 1;
        }
    }
    break;
}
// print_r($count);
$ratings = array();
$rating = array();
$subsq = array();
$rows = mysqli_num_rows($r_feed);
// echo $rows;
for ($i = 1; $i <= $count; $i++) {
    $question = 0;
    foreach ($r_feed as $s) {
        $question = $question + $s['q' . $i];
        // echo $question . '<br>';
    }
    $ratings[] = round($question / $rows, 1);
}
// print_r($ratings[10]+$ratings[11]+$ratings[12]+$ratings[13]+$ratings[15]+$ratings[16]);
// echo"<br>";
// $rating[] = round(($ratings[0] + $ratings[1] + $ratings[2] + $ratings[3]) / 4, 1);
// $rating[] = round(($ratings[4] + $ratings[5] + $ratings[6] + $ratings[7] + $ratings[8] + $ratings[9]) / 6, 1);
// $rating[] = round(($ratings[10] + $ratings[11] + $ratings[12] + $ratings[13] + $ratings[14] + $ratings[15]) / 6, 1);
// $rating[] = round(($ratings[16] + $ratings[17] + $ratings[18] + $ratings[19] + $ratings[20] + $ratings[21]) / 6, 1);
// $rating[] = round(($ratings[22] + $ratings[23] + $ratings[24] + $ratings[25] + $ratings[26]) / 5, 1);
// print_r($ratings);
// $question = 'select * from feedback_all where feedback_name="Course End"';
// $r_questions = mysqli_fetch_assoc($link->query($question));
array_push($subsq, "G1", "G2", "G3", "CO1", "CO2","CO3","CO4","CO5");
// print_r($subsq);
?>
<style>
    #Back-btn {
        display: none;
    }
</style>
<div>Total responses : <?php echo $r_total['count(name)'] ?></div>
<div>
    <!-- <h1>Welcome <?php echo $_SESSION["username"] ?> </h1> -->

    <div class="row">
        <div class="col">
            <div id="chart">
                <canvas id="myChart" style="width:100%;max-height:500px;min-height:300px;"></canvas>
            </div>
        </div>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">

</script>
<script>
    var subsq = [];
    var rating = []
    var i = 0;
    var j = 0;
    <?php
    foreach ($subsq as $s) {
    ?>
        subsq[i++] = "<?php echo $s ?>";
    <?php   }
    foreach ($ratings as $m) {
    ?>
        rating[j++] = "<?php echo $m ?>";
    <?php } ?>
    console.log(subsq);
    console.log(rating);
</script>
<script>
    var myChart = new Chart("myChart", {
        type: 'bar',
        yAxes: {
            maximum: 5
        },
        data: {
            labels: subsq,
            datasets: [{
                label: 'rating',
                data: rating,
                backgroundColor: [
                    '#ffe6b877'

                ],
                borderColor: [
                    '#fea90f'
                ],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {

                        beginAtZero: true,
                        // suggestedMax : 5
                        max: 5,
                        stepSize: 1
                        // steps:5
                    }
                }]
            }
        }

    });
</script>





<!-- <a href='download'><button>Link To freeCodeCamp</button></a> -->


<form action="select_feedback_prev.php">
    <input type="submit" class="btn btn-primary" style="margin-left: 3em;" name="" id="" value='Download'>
</form>

<div class="row mt-5">
    <div class="col">
        <div id="container1">
            <canvas id="canvas" style="width:80%;max-height:500px;min-height:300px;"></canvas>
        </div>
    </div>
</div>

<?php
if ($_SESSION['section'] == 'ALL') {
    $q_feed_resp = 'select * from feedback_response where feedback_name="Course End" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" order by usn';
} else {
    $q_feed_resp = 'select * from feedback_response where feedback_name="Course End" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and section="' . $_SESSION['section'] . '"and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" order by usn';
}
// echo $q_feed_resp;
$dict_feed = array(
    "G1" => 1,
    "G2" => 1,
    "G3" => 1,
    "CO1" =>1,
    "CO2" =>1,
    "CO3" =>1,
    "CO4" =>1,
    "CO5" =>1
);
$rating_feed = array(
    "G1"   => array(0, 0, 0, 0, 0),
    "G2"   => array(0, 0, 0, 0, 0),
    "G3"   => array(0, 0, 0, 0, 0),
  "CO1"   => array(0, 0, 0, 0, 0),
  "CO2"   => array(0, 0, 0, 0, 0),
  "CO3"   => array(0, 0, 0, 0, 0),
  "CO4"   => array(0, 0, 0, 0, 0),
  "CO5"   => array(0, 0, 0, 0, 0)
);
$itter = 0;
$indexes = array_keys($dict_feed);
$q_i = 0;
foreach ($dict_feed as $d) {
    $r_feed_resp = $link->query($q_feed_resp);
    $rat = array();
    foreach ($r_feed_resp as $r) {
        $rat_val = 0;
        for ($i = 1; $i <= $d; $i++) {
            // $rating_feed[$indexes[$q_i]][0] += $r['q'.($itter+$i)];
            $rat_val += $r['q' . ($itter + $i)];
        }
    $rat[] = ceil($rat_val / $d);
}
    // print_r($rat);
    echo '<br>';
    $one = 0;
    $two = 0;
    $three = 0;
    $four = 0;
    $five = 0;
    foreach ($rat as $r_v) {
        if ($r_v == 1) {
            $one++;
        }
        if ($r_v == 2) {
            $two++;
        }
        if ($r_v == 3) {
            $three++;
        }
        if ($r_v == 4) {
            $four++;
        }
        if ($r_v == 5) {
            $five++;
        }
    }
    // echo $one . ' ' . $two . ' ' . $three . ' ' . $four . ' ' . $five . '<br>';
    $rating_feed[$indexes[$q_i]][0] = $five;
    $rating_feed[$indexes[$q_i]][1] = $four;
    $rating_feed[$indexes[$q_i]][2] = $three;
    $rating_feed[$indexes[$q_i]][3] = $two;
    $rating_feed[$indexes[$q_i]][4] = $one;

    $itter += $d;
    $q_i++;
}
// print_r($rating_feed);
// // echo $rating_feed[$indexes[7]][0]
// print_r($indexes);
?>

<script>
    var sa = [];
    var i = 0;
    
    <?php
    for ($i = 0; $i < 8; $i++) {
    ?>
        sa[i++] = "<?php echo $rating_feed[$indexes[$i]][0] ?>";
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
        console.log(sa);




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
<div style="height: 500px; overflow-y: scroll;">
    <?php
    $r_com = $link->query($q_feed_resp);
    $comments = array();
    foreach ($r_com as $r) {
        $comments[] = $r['commments'];
    }
    $comments = array_diff($comments, [' ', 'No', 'no', 'No comments', 'Nice', 'NA', 'nil', 'NIL', '', '.']);
    foreach ($comments as $c) {
    ?>
        <input type="text" name="" id="" class="form-control" value="<?php echo $c ?>"><br>

    <?php } ?>
</div>
<form action="download_graph_ce.php" method="POST" target="_blank">
    <?php foreach ($rating_feed['G1'] as $r) { ?>
        <input type="text" name="g1[]" id="" hidden value="<?php echo $r ?>">
    <?php } ?>
    <?php foreach ($rating_feed['G2'] as $r) { ?>
        <input type="text" name="g2[]" id="" hidden value="<?php echo $r ?>">
    <?php } ?>
    <?php foreach ($rating_feed['G3'] as $r) { ?>
        <input type="text" name="g3[]" id="" hidden value="<?php echo $r ?>">
    <?php } ?>
    <?php foreach ($rating_feed['CO1'] as $r) { ?>
        <input type="text" name="co1[]" id="" hidden value="<?php echo $r ?>">
    <?php } ?>
    <?php foreach ($rating_feed['CO2'] as $r) { ?>
        <input type="text" name="co2[]" id="" hidden value="<?php echo $r ?>">
    <?php } ?>
    <?php foreach ($rating_feed['CO3'] as $r) { ?>
        <input type="text" name="co3[]" id="" hidden value="<?php echo $r ?>">
    <?php } ?>
    <?php foreach ($rating_feed['CO4'] as $r) { ?>
        <input type="text" name="co4[]" id="" hidden value="<?php echo $r ?>">
    <?php } ?>
    <?php foreach ($rating_feed['CO5'] as $r) { ?>
        <input type="text" name="co5[]" id="" hidden value="<?php echo $r ?>">
    <?php } ?>

    <?php foreach ($indexes as $i) { ?>
        <input type="text" name="index[]" id="" hidden value="<?php echo $i ?>">
    <?php } ?>
    <?php foreach ($comments as $c) { ?>
        <input type="text" name="comments[]" id="" hidden value="<?php echo $c ?>">
    <?php } ?>
    <input type="text" value="<?php echo $r_dept['faculty_dept'] ?>" name="fac_dept" hidden>
    <input type="submit" class="btn btn-primary" style="margin-left: 3em;" name="" id="" value='Download'>
</form>




<?php
include "../template/footer-fac.php";
?>