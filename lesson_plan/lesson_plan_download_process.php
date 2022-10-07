<?php

require_once "../config.php";
$sem = $_SESSION["sem1"];
$sec = $_SESSION["sec1"];
$subid = $_SESSION["subid1"];
$branch = $_SESSION['branch'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid pl-0 pr-0 pb-3" style="overflow: hidden; border-bottom:2px solid black;">
        <div class="row pt-3" style="justify-content: center;align-items: center">
            <div class="col-2">
                <img src="../asset/img/aiet-logo.png" style="width:90px;display:float;float:right;" class="img-fluid p-0 m-0" srcset="">
            </div>
            <div class="col-sm-8 col-md-7 content p-0 m-0">
                <h3 style="font-size: 23px;">Alvas institute of enginering & technology</h3>
                <p>Shobavan Campus, Mijar, Moodibidri, D.K - 574225</p>
                <p>Phone: 08258-262725, Fax: 08258-262726</p>
                <h2 style="font-size: 25px;">Department of <?php echo $branch ?></h2>
            </div>
        </div>
    </div>
    <div class="container justify-content-center">
        <h3 class="text-center mt-3" style="font-weight: 600;">LESSON PLAN AND EXECUTION</h3>
        <div class="justify-content-center">
            <table class="table table-bordered text-center mt-5 ml-auto mr-auto" style="width: 600px;">
                <tr>
                    <th>Name of the Faculty: </th>
                    <td><?php echo $_SESSION['username'] ?></td>
                </tr>
                <tr>
                    <th>Subject: </th>
                    <td><?php echo $subid ?></td>
                </tr>
                <tr>
                    <th>Branch: </th>
                    <td><?php echo $branch ?></td>
                </tr>
                <tr>
                    <th>Semester - Section: </th>
                    <td><?php echo $sem . ' - ' . $sec ?></td>
                </tr>
            </table>
        </div>
        <h4 class="mt-5">Course Outcomes:</h4>
        <?php
        $q = 'select * from co where sub = "' . $subid . '"';
        $result = $link->query($q);
        $r = mysqli_fetch_assoc($result);
        ?>
        <ol>
            <?php
            for ($i = 1; $i <= 6; $i++) {
                if ($r['co' . $i] == '0') {
                    continue;
                }
            ?>
                <li class="p-2"><?php echo $r['co' . $i] ?></li>
            <?php } ?>
        </ol>
        <h4 class="mt-5">CO-PO Mapping</h4>
        <?php
        $q = 'select * from co_po where sub = "' . $subid . '"';
        $result = $link->query($q);
        ?>
        <table class="table table-bordered pg-break-above">
            <thead>
                <th>CO</th>
                <?php for ($i = 1; $i <= 12; $i++) { ?>
                    <th>PO<?php echo $i ?></th>
                <?php } ?>
            </thead>
            <tbody>
                <?php
                $j = 0;
                
                    foreach ($result as $r) {
                        $j++;
                        if ($j < 7) {
                ?>
                        <tr>
                            <th class="pt-1 pb-1">CO<?php echo $j ?></th>
                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                <td class="pt-1 pb-1"><?php if ($r['po' . $i] == '0' || $r['po' . $i] == 'N/A') {
                                                            echo 'N/A';
                                                        } elseif ($r['po' . $i] == 'Moderate') {
                                                            echo '2';
                                                        } elseif ($r['po' . $i] == 'Low') {
                                                            echo '3';
                                                        } else {
                                                            echo '1';
                                                        }


                                                        ?></td>
                            <?php } ?>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
        <h4 class="mt-2">CO-PSO Mapping</h4>
        <?php
        $q = 'select * from co_pso where sub = "' . $subid . '"';
        $result = $link->query($q);
        ?>
        <table class="table table-bordered">
            <thead>
                <th>CO</th>
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <th>PSO<?php echo $i ?></th>
                <?php } ?>
            </thead>
            <tbody>
                <?php
                $j = 0;
                foreach ($result as $r) {
                    $j++;
                ?>
                    <tr style="height: 20px;">
                        <th class="pt-1 pb-1">CO<?php echo $j ?></th>
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <td class="pt-1 pb-1"><?php if ($r['pso' . $i] == '0' || $r['pso' . $i] == 'N/A') {
                                                        echo 'N/A';
                                                    } elseif ($r['pso' . $i] == 'Moderate') {
                                                        echo '2';
                                                    } elseif ($r['pso' . $i] == 'Low') {
                                                        echo '3';
                                                    } else {
                                                        echo '1';
                                                    }


                                                    ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="lesson-plan-break"></div>
        <h4>Lesson Plan and Execution</h4>
        <table class="table table-bordered">
            <tr>
                <th colspan="5">Planning</th>
                <th colspan="3">Execution</th>
            </tr>
            <tr>
                <th>Module</th>
                <th>Sl. No.</th>
                <th>Date</th>
                <th style="width: 50px;">Topic</th>
                <th>Textbook</th>
                <th>Date</th>
                <th>Topic</th>
                <th>Textbook</th>
            </tr>
            <?php
            $i = 0;
            for ($j = 1; $j <= 5; $j++) {
                $q = 'select * from lessonpanl where subid = "' . $subid . '" and branch = "' . $branch . '" and sem = "' . $sem . '" and section = "' . $sec . '" and module = "' . $j . '" order by sr_no';
                // echo $q;
                $result = $link->query($q);
                $flag = 0;
                $num = 'select count(*) from lessonpanl where subid = "' . $subid . '" and branch = "' . $branch . '" and sem = "' . $sem . '" and section = "' . $sec . '" and module = "' . $j . '" order by sr_no';
                $num = mysqli_fetch_assoc($link->query($num))['count(*)'];
                foreach ($result as $r) {
                    $i++;
            ?>
                    <tr>
                        <?php if ($flag == 0) { ?>
                            <th rowspan="<?php echo $num;
                                            $flag = 1; ?>">Module: <?php echo $r['module'] ?></th>
                        <?php } ?>
                        <td style="width: 6px;"><?php echo $i ?></td>
                        <td style="width: 110px;" "><span><?php echo $r['dop_Plan'] ?></span></td>
                        <td ><?php echo $r['pending'] ?></td>
                        <td style=" width: 120px;"><?php echo $r['textbook'] ?></td>
                        <td style="width: 110px;"><?php echo $r['dop_exe'] ?></td>
                        <td><?php echo $r['complet'] ?></td>
                        <td style="width: 120px;"><?php echo $r['textbook'] ?></td>
                    </tr>
            <?php
                    $num--;
                    if ($num == 0) {
                        $flag = 0;
                    }
                }
            } ?>
        </table>
        <h4 class="">Textbooks</h4>
        <?php

        $q = 'select * from co where sub = "' . $subid . '"';
        $result = $link->query($q);
        $r = mysqli_fetch_assoc($result);
        for ($i = 1; $i <= 6; $i++) {
            if ($r['t' . $i] == '0') {
                continue;
            }
        ?>
            <p>Textbook <?php echo $i ?>: <?php echo $r['t' . $i] ?><br></p>
        <?php } ?>
        <div class="row">
            <div class="col-md-4">
                <div class="mt-5" style="border-top: 2px solid black; width:100px; text-align:center;">Faculty Sign</div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="mt-5" style="border-top: 2px solid black; width:100px;text-align:center;">HOD Sign</div>
            </div>
        </div>


    </div>

    <style>
        @media print {
            @page {
                size: landscape;
                margin: 0.5cm;
            }

        }

        h1,
        h3,
        h2 {
            text-transform: uppercase;
            font-family: 'Times New Roman', Times, serif;
        }

        .content {
            line-height: 6px !important;
            text-align: center;
        }

        .book-date,
        .lesson-plan-break {
            page-break-after: always;
        }

        /* .pg-break-above {
            page-break-before: always;
        } */
    </style>
</body>
<script>
    setTimeout(function() {
        window.print();
    }, 1000);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>