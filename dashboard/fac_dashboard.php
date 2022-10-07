<?php include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
// principal dashboard start  
if ($_SESSION["principal"] == true) {


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

    $q3 = "select count(*) as s from subjects";
    $res3 = $link->query($q3);
    $no_of_sub = mysqli_fetch_assoc($res3);

    ?>


    <div class="container">
        <div class="row">
            <div class="four col-md-3 mb-2">
                <a href="">
                    <div class="counter-box">
                        <i class="fas fa-user-graduate orange"></i>
                        <span class="counter text-num" data-target="<?php echo $no_of_stu["s"] ?>">0</span>
                        <p class="greay">Total Students</p>
                    </div>
                </a>
            </div>
            <div class="four col-md-3 mb-2">
                <a href="">
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

    $facname = "SELECT * FROM faculty_mapping f, subjects s WHERE f.faculty_name='" . $_SESSION["username"] . "' and f.sub_name = s.sub_name";
    // echo $facname;
    $fa = $link->query($facname);
    // print_r($fa);1919191 - dbms
    foreach ($fa as $row) {
        // echo $row["sub_code"] . ' - ' .$row['sub_name'];
        // echo "<br>";
    }

?>

    <?php
    if (mysqli_num_rows($fa) != 0) {
        $poor1 = "SELECT * FROM `ia_marks1` WHERE sub=\"" . $row["sub_code"] . ' - ' . $row['sub_name'] . "\" and total1 < 14";
        $cou_1_ia1 = mysqli_num_rows($link->query($poor1));
        $avrage1 = "SELECT * FROM `ia_marks1` WHERE sub=\"" . $row["sub_code"] . ' - ' . $row['sub_name'] . "\" and total1 between 13 and 21";
        $cou_2_ia1 = mysqli_num_rows($link->query($avrage1));
        $high1 = "SELECT * FROM `ia_marks1` WHERE sub=\"" . $row["sub_code"] . ' - ' . $row['sub_name'] . "\" and total1 > 20";
        $cou_3_ia1 = mysqli_num_rows($link->query($high1));

        $poor2 = "SELECT * FROM `ia_marks2` WHERE sub=\"" . $row["sub_code"] . ' - ' . $row['sub_name'] . "\" and total2 < 14";
        $cou_1_ia2 = mysqli_num_rows($link->query($poor2));
        $avrage2 = "SELECT * FROM `ia_marks2` WHERE sub=\"" . $row["sub_code"] . ' - ' . $row['sub_name'] . "\" and total2 between 13 and 21";
        $cou_2_ia2 = mysqli_num_rows($link->query($avrage2));
        $high2 = "SELECT * FROM `ia_marks2` WHERE sub=\"" . $row["sub_code"] . ' - ' . $row['sub_name'] . "\" and total2 > 20";
        $cou_3_ia2 = mysqli_num_rows($link->query($high2));

        $poor3 = "SELECT * FROM `ia_marks3` WHERE sub=\"" . $row["sub_code"] . ' - ' . $row['sub_name'] . "\" and total3 < 14";
        $cou_1_ia3 = mysqli_num_rows($link->query($poor3));
        $avrage3 = "SELECT * FROM `ia_marks3` WHERE sub=\"" . $row["sub_code"] . ' - ' . $row['sub_name'] . "\" and total3 between 13 and 21";
        $cou_2_ia3 = mysqli_num_rows($link->query($avrage3));
        $high3 = "SELECT * FROM `ia_marks3` WHERE sub=\"" . $row["sub_code"] . ' - ' . $row['sub_name'] . "\" and total3 > 20";
        $cou_3_ia3 = mysqli_num_rows($link->query($high3));
    } else {
        echo "No subjects added";
    }
    ?>
    <input hidden type="text" value='<?php echo $cou_1_ia1 ?>' id='poor_ia1'>
    <input hidden type="text" value='<?php echo $cou_2_ia1 ?>' id='average_ia1'>
    <input hidden type="text" value='<?php echo $cou_3_ia1 ?>' id='high_ia1'>

    <input hidden type="text" value='<?php echo $cou_1_ia2 ?>' id='poor_ia2'>
    <input hidden type="text" value='<?php echo $cou_2_ia2 ?>' id='average_ia2'>
    <input hidden type="text" value='<?php echo $cou_3_ia2 ?>' id='high_ia2'>

    <input hidden type="text" value='<?php echo $cou_1_ia3 ?>' id='poor_ia3'>
    <input hidden type="text" value='<?php echo $cou_2_ia3 ?>' id='average_ia3'>
    <input hidden type="text" value='<?php echo $cou_3_ia3 ?>' id='high_ia3'>

    <div class="alert alert-dismissible alert-success custom-success-alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Welcome!</strong> loged in as Faculty.
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
    <script src="//www.amcharts.com/lib/4/themes/material.js"></script>

    <div class="container">
        <?php
        $count = 0;
        foreach ($fa as $row) {
            $count++;
        ?>

            <script>
                am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // am4core.useTheme(am4themes_material);

                    // Themes end

                    var chart = am4core.create("chartdiv0<?php echo $count ?>", am4charts.PieChart3D);

                    chart.hiddenState.properties.opacity = 20; // this creates initial fade-in

                    // 
                    // $poor = "SELECT count(*) FROM `ia_marks1` WHERE sub=\"" . $_SESSION["sub"] . "\" and total1 > 14";
                    // echo $poor;
                    // ?>
                    chart.data = [{
                            country: "Poor",
                            litres: document.getElementById("poor_ia1").value,
                            // litres: 50,
                            color: am4core.color("#ED1C24")

                        },
                        {
                            country: "Average",
                            litres: document.getElementById("average_ia1").value,
                            // litres: 20,
                            color: am4core.color("#ED1C24")
                        },
                        {
                            country: "High",
                            litres: document.getElementById("high_ia1").value,
                            // litres: 30,
                            color: am4core.color("#ED1C24")
                        },

                    ];
                    chart.innerRadius = am4core.percent(40);
                    chart.depth = 10;

                    // chart.legend = new am4charts.Legend();
                    var series = chart.series.push(new am4charts.PieSeries3D());
                    series.dataFields.value = "litres";
                    series.dataFields.depthValue = "litres";
                    series.dataFields.category = "country";
                    series.slices.template.cornerRadius = 4;
                    series.colors.step = 2;
                    series.shuffle = true

                });
                // end am4core.ready()
            </script>

            <script>
                am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var chart = am4core.create("chartdiv1<?php echo $count ?>", am4charts.PieChart3D);

                    chart.hiddenState.properties.opacity = 20; // this creates initial fade-in

                    chart.data = [{
                            country: "Poor",
                            litres: document.getElementById("poor_ia2").value,
                            color: am4core.color("#ED1C24")
                        },
                        {
                            country: "Average",
                            litres: document.getElementById("average_ia2").value,
                            // color: am4core.color("#ED1C62")
                        },
                        {
                            country: "High",
                            litres: document.getElementById("high_ia2").value,
                            color: am4core.color("#ED1C30")
                        },
                    ];

                    chart.innerRadius = am4core.percent(40);
                    chart.depth = 10;

                    // chart.legend = new am4charts.Legend();

                    var series = chart.series.push(new am4charts.PieSeries3D());
                    series.dataFields.value = "litres";
                    series.dataFields.depthValue = "litres";
                    series.dataFields.category = "country";
                    series.slices.template.cornerRadius = 2;
                    series.colors.step = 9;

                }); // end am4core.ready()
            </script>

            <script>
                am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    var chart = am4core.create("chartdiv2<?php echo $count ?>", am4charts.PieChart3D);

                    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

                    chart.data = [{
                            country: "Poor",
                            litres: document.getElementById("poor_ia3").value
                        },
                        {
                            country: "Average",
                            litres: document.getElementById("average_ia3").value
                        },
                        {
                            country: "High",
                            litres: document.getElementById("high_ia3").value
                        },

                    ];

                    chart.innerRadius = am4core.percent(40);
                    chart.depth = 10;

                    // chart.legend = new am4charts.Legend();

                    var series = chart.series.push(new am4charts.PieSeries3D());
                    series.dataFields.value = "litres";
                    series.dataFields.depthValue = "litres";
                    series.dataFields.category = "country";
                    series.slices.template.cornerRadius = 5;
                    series.colors.step = 3;

                }); // end am4core.ready()
            </script>
        <?php } ?>

        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">


            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            IA-I Marks Details
                        </h5>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                            <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        High
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Average
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Poor
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">


            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            IA-2 Marks Details
                        </h5>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                            <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        High
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Average
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Poor
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">


            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            IA-3 Marks Details
                        </h5>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                            <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        High
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Average
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Poor
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner h-100">
                <?php
                $f = 1;
                $ci = 0;
                foreach ($fa as $row) {
                    $ci++;
                ?>
                    <div class="carousel-item <?php if ($f == 1) echo "active"; ?>">
                        <?php $f = 0; ?>
                        <?php echo $row["sub_name"] ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-primary m-2 " style="max-width: 100%; ">
                                        <!-- <div class="card-header"> Pie Chart </div> -->
                                        <Button class="btn btn-outlined-primary" data-toggle="modal" data-target="#modal1" type="button">
                                            <div class="card-body card" style="justify-content: center; align-items: center;">
                                                <!-- <h4 class="card-title">Primary chart</h4> -->
                                                <div id="chartdiv0<?php echo $ci; ?>" style="width: 100%;min-height: 30vh;"></div>
                                            </div>
                                        </Button>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-primary m-2 " style="max-width: 100%;">
                                        <!-- <div class="card-header"> Pie Chart </div> -->
                                        <Button class="btn btn-outlined-primary" data-toggle="modal" data-target="#modal2" type="button">

                                            <div class="card-body" style="justify-content: center; align-items: center;">
                                                <!-- <h4 class="card-title">Primary chart</h4> -->
                                                <div id="chartdiv1<?php echo $ci; ?>" style="width: 100%; min-height: 30vh;"></div>
                                            </div>
                                        </Button>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-3 col-lg-3"></div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="card border-primary m-2 " style="max-width: 100%;">
                                        <!-- <div class="card-header"> Pie Chart </div> -->
                                        <Button class="btn btn-outlined-primary" data-toggle="modal" data-target="#modal3" type="button">

                                            <div class="card-body" style="justify-content: center; align-items: center;">
                                                <!-- <h4 class="card-title">Primary chart</h4> -->
                                                <div id="chartdiv2<?php echo $ci; ?>" style="width: 100%; min-height: 30vh;"></div>
                                            </div>
                                        </Button>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                <?php } ?>

            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <div></div>


<?php } ?>

<?php include("../template/footer-fac.php") ?>