<?php include("../template/fac-auth.php");
error_reporting(0);
include("../template/sidebar-fac.php");

include("../IA_Management/graph.php");

if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
    $qt = "select a.sub_name, a.sub_code, a.lab from faculty_mapping b, subjects a where b.faculty_name = \"" . $_SESSION['username'] . "\" and b.sub_name = a.sub_name";
} else {
    $qt = "select a.sub_name, a.sub_code, a.sub_id from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $_SESSION['username'] . "\" and b.sub_name = a.sub_name";
}
$result = $link->query($qt);
$dept = mysqli_fetch_assoc($link->query("Select faculty_dept from faculty_details where faculty_name = '" . $_SESSION['username'] . "'"))['faculty_dept'];
// echo $qt;
?>

<script>
var x = []
</script>

<?php 
$i = 0;
$arr = array();
    foreach($result as $r)
    {
        if(isset($r['lab']) && $r['lab'] == '0'){
            $sub = $r['sub_code'] . " - " . $r['sub_name'];
        }
        elseif($r['sub_id'] != '3'){
            $sub = $r['sub_code'] . " - " . $r['sub_name'];
        }
        else{

            continue;
        }
        if($r['branch'] == 'Computer Science and Engineering-parallel'){
            continue;
        }
        $arr[] = $sub;
        // echo $sub;
        ?>
<script>
var graph = <?php echo graph($dept,$sub,$link) ?>;
x.push(graph)
</script>

<?php
$i ++;
    }
?>
<script>
var loop = <?php echo $i ?>;
console.log("loop", loop);
</script>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
// principal dashboard start  
if ($_SESSION["principal"] == true || $_SESSION["username"]=="vivek_alva@alvas.org") {


?>
<style>
#Back-btn {
    display: none;
}

.container {
    margin-top: 100px
}

.counter-box {
    display: block;
    background: #f6f6f6;
    padding: 40px 20px 37px;
    text-align: center
}

.counter-box p {
    margin: 5px 0 0;
    padding: 0;
    color: #909090;
    font-size: 18px;
    font-weight: 500
}

.counter-box i {
    font-size: 60px;
    margin: 0 0 15px;
    color: #d2d2d2;
    border: 1px solid transparent;
}

.counter {
    display: block;
    font-size: 32px;
    font-weight: 700;
    color: #666;
    line-height: 28px
}

.counter-box:hover {
    box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(240, 250, 251, 0.884) 0px 10px 10px;
    transition: background 0.35s;
    background: #7fd4ee8a;
    border: 1px solid transparent;
    border-radius: 7px;
}

.text-num {
    color: #0e0f3b;
}

.greay {
    color: #07407b !important;
}

.orange {
    color: #f7931e !important;
}

.counter-box.colored p,
.counter-box.colored i,
.counter-box.colored .counter {
    color: #fff;
}
</style>


<?php

$q1 = "select count(*) as s from students";
$res1 = $link->query($q1);
$no_of_stu = mysqli_fetch_assoc($res1);

$q2 = "select count(*) as s from faculty_details";
$res2 = $link->query($q2);
$no_of_fac = mysqli_fetch_assoc($res2);

$q3 = "select count(*) as s from subjects_new";
$res3 = $link->query($q3);
$no_of_sub = mysqli_fetch_assoc($res3);

?>


<div class="container">
    <div class="row">
        <div class="four col-md-3 mb-2">
            <a href="../dept_admin/student_Select.php">
                <div class="counter-box">
                    <i class="fas fa-user-graduate orange"></i>
                    <span class="counter text-num" data-target="<?php echo $no_of_stu["s"] ?>">0</span>
                    <p class="greay">Total Students</p>
                </div>
            </a>
        </div>
        <div class="four col-md-3 mb-2">
            <a href="../dept_admin/faculty_department.php">
                <div class="counter-box">
                    <i class="fas fa-chalkboard-teacher orange"></i>
                    <span class="counter text-num" data-target="<?php echo $no_of_fac["s"] ?>">0</span>
                    <p class="greay">Total Faculties</p>
                </div>
            </a>
        </div>
        <div class="four col-md-3 mb-2">
            <!-- <a href="..faculty/faculty_view_details.php"> -->
            <div class="counter-box">
                <i class="fas fa-pencil-ruler orange"></i>
                <span class="counter text-num" data-target="8">0</span>
                <p class="greay">Total Branch's</p>
            </div>
            <!-- </a> -->
        </div>
        <div class="four col-md-3 mb-2">
            <a href="">
                <div class="counter-box">
                    <i class="fas fa-book-open orange"></i>
                    <span class="counter text-num" data-target="<?php echo $no_of_sub["s"] ?>">0</span>
                    <p class="greay">Total Subjects</p>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
    // DOM Element's
    const counters = document.querySelectorAll('.counter');
    for (let n of counters) {
        const updateCount = () => {
            const target = +n.getAttribute('data-target');
            const count = +n.innerText;
            const speed = 5000000;
            const inc = target / speed;
            if (count < target) {
                n.innerText = Math.ceil(count + inc);
                setTimeout(updateCount, 1);
            } else {
                n.innerText = target;
            }
        }
        updateCount();
    }
</script>




<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<br>
<br>
<figure class="highcharts-figure">
    <div id="container"></div>

</figure>

<style>
#container {
    height: 400px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

.highcharts-credits {
    display: none !important;
}
</style>

 <script>
        Highcharts.chart('container', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                }
            },
            title: {
                text: "Total Students in Alva's Institute Of Engineering & Technology"
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Student Percentage',
                data: [
                    <?php
                    $qu = 'select * from dept_pso';
                    $dep = $link->query($qu);
                    foreach ($dep as $d) {
                        $qu1 = 'select count(*) as c from students where branch="' . $d["dept_name"] . '"';
                        // echo $qu1;
                        $re = $link->query($qu1);
                        $r = mysqli_fetch_assoc($re);
                        echo "['" . $d["dept_name"] . "', " . $r["c"] . "],";
                    }
                    ?>
                ]
            }]
        });
    </script>

<?php

}
// principal dashboard end
else {
    if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
        $facname = "SELECT * FROM faculty_mapping f, subjects s WHERE f.faculty_name='" . $_SESSION["username"] . "' and f.sub_name = s.sub_name";
    
    }
    else{
        $facname = "SELECT * FROM faculty_mapping f, subjects_new s WHERE f.faculty_name='" . $_SESSION["username"] . "' and f.sub_name = s.sub_name";

    }
    $fa = $link->query($facname);
    foreach ($fa as $row) {
    }

?>

<!-- Button trigger modal -->

<?php if (!isset($_SESSION['is_archive']) || $_SESSION['is_archive'] == 0) {  ?>
<div class="mb-4">
    <Button class="btn btn-primary" data-toggle="modal" data-target="#archive" type="button">Archive
    </Button>
</div>
<?php } ?>


<div class="alert alert-dismissible alert-success custom-success-alert">
    <button type="button" class="btn-close" id="auto-close" data-bs-dismiss="alert"></button>
    <strong>Welcome!</strong> loged in as Faculty.
</div>


<!-- Modal -->
<div class="modal fade" id="archive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">


    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Archive Data
                </h5>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="redirect.php" method="POST">
                    <div class="form-group col-12 col-md-6">
                        <label for="academic">Academic Year :</label>
                        <select class="form-control" id="academic" name='year'>
                            <option value="Select Year" selected disabled>Select Year</option>
                            <option value="2021 - 2022">2021 - 2022</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary">
                    Submit
                </button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
#chartdiv {
    width: 80%;
    height: 300px;
}

#Back-btn {
    display: none;
}

.card {
    background: rgba(104, 101, 105, 0.116);
    border: 1px solid rgba(143, 143, 143, 0) !important;
    border-radius: 10px;
}
</style>

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<div class="container">

    <script>
    for (let i = 1; i <= loop; i++) {
        console.log("x[i]:", x[i - 1]);
        console.log("chartdiv" + i);
        for (let j = 1; j < 4; j++) {
            am4core.ready(function() {
                am4core.useTheme(am4themes_animated);
                console.log("ia" + i + "_chartdiv" + j);
                var chart = am4core.create("ia" + i + "_chartdiv" + j, am4charts.PieChart3D);
                chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
                y = x[i - 1]
                chart.data = [{
                        performance: "Poor",
                        percent: y["ia" + j + "poor"]
                    }, {
                        performance: "Average",
                        percent: y["ia" + j + "avg"]
                    }, {
                        performance: "Good",
                        percent: y["ia" + j + "high"]
                    },

                ];

                chart.innerRadius = am4core.percent(35);
                chart.depth = 20;

                // chart.legend = new am4charts.Legend();

                var series = chart.series.push(new am4charts.PieSeries3D());
                series.dataFields.value = "percent";
                series.dataFields.depthValue = "percent";
                series.dataFields.category = "performance";
                series.slices.template.cornerRadius = 2;
                series.colors.step = 3;

            }); // end am4core.ready()
        }
    }
    </script>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

            <?php
            for ($x = 1; $x <= $i; $x++) {?>
            <div class="carousel-item <?php if($x==1) {echo 'active';} ?>">

                <div class="container">
                    <h4><?php echo $arr[$x-1]; ?></h4>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="card border-primary m-2 " style="max-width: 100%; ">
                                <div class="card-body card" style="justify-content: center; align-items: center;">
                                    <div id="<?php echo 'ia' . $x . '_chartdiv1'; ?>"
                                        style="width: 100%;min-height: 30vh;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="card border-primary m-2 " style="max-width: 100%;">
                                <div class="card-body" style="justify-content: center; align-items: center;">
                                    <div id="<?php echo 'ia' . $x . '_chartdiv2'; ?>"
                                        style="width: 100%; min-height: 30vh;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-3 col-lg-3"></div>
                        <div class="col-md-6 col-sm-12">
                            <div class="card border-primary m-2 " style="max-width: 100%;">
                                <div class="card-body" style="justify-content: center; align-items: center;">
                                    <div id="<?php echo 'ia' . $x . '_chartdiv3'; ?>"
                                        style="width: 100%; min-height: 30vh;"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
            <?php
            }
            ?>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</div>


<script>
    setTimeout(function() {document.getElementById("auto-close").click();}, 3000);
</script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script> -->



<?php } ?>

<?php include("../template/footer-fac.php") ?>