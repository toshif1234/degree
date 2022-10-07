<?php
// session_start();
error_reporting(0);
require_once "../config.php";

$fdept = 'select * from faculty_details where faculty_name="' . $_SESSION['username'] . '"';
// $fac_name = mysqli_fetch_assoc($link->query($fac_sub))['faculty_name'];
$fac_dept = mysqli_fetch_assoc($link->query($fdept))['faculty_dept'];
$q = 'select distinct faculty_name from subjects s,faculty_mapping f where branch="' . $fac_dept . '" and s.sub_name = f.sub_name group by f.faculty_name';

// echo $q;
$r = $link->query($q);

// $q_all = 'select * from subjects s,faculty_mapping f where branch="' . $fac_dept . '" and s.sub_name = f.sub_name group by f.faculty_name';
// echo $q_all;
// $a = array();
$i = 0;
// foreach ($r as $f) {
//     $a[] = $f['faculty_name'];
// }
// print_r($a);
$q_fsub = "select * from faculty_mapping b, subjects a, faculty_details f where b.sub_name = a.sub_name and f.faculty_dept = \"" . $fac_dept . "\" and f.faculty_name = b.faculty_name group by f.faculty_name, b.sub_name order by f.faculty_name";
// echo $q_fsub;
$r2_fsub = $link->query($q_fsub);

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
                <h2>ALVA'S INSTITUTE OF ENGINEERING AND TECHNOLOGY, MIJAR</h2>
                <h4>Shobavana Campus, Mijar, Moodbidri, D.K., - 574227</h4>
                <h4>Phone: 08258-262725, Fax: 08258-262726</h4>
            </div>
        </div>
        <hr style="border-top: 1px solid black;">
        <div class="row">
            <div class="col">
                <h4 class=" mb-4 ">Department of <?php echo $fac_dept ?></h4>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4 class="mb-4 ">Consolidated Feedback Report for 2021-22</h4>
            </div>
        </div>

        <div class="row m-4 x-2">
            <table class="table">
                <th>Sl.No</th>
                <th>Faculty Name</th>
                <th>Semester handling</th>
                <th>Subject Name and Code</th>
                <th>Percentage</th>
                <?php
                $k = 0;
                for ($i1 = 0; $i1 < mysqli_num_rows($r2_fsub); $i1++) {

                    // echo "$i".'<br>';
                    // echo $q_ fsub;


                    // print_r($r_fsub);
                    $r_fsub = mysqli_fetch_assoc($r2_fsub);
                    $q_fsub4 = 'select * from subjects s,faculty_mapping f where s.branch ="' . $fac_dept . '" and s.sub_name=f.sub_name and f.faculty_name="' . $r_fsub['faculty_name'] . '"';
                    $r_fsub4 = $link->query($q_fsub4);
                    $n_sub = mysqli_num_rows($r_fsub4);
                    if (preg_match('/17.*/', $r_fsub['sub_code'])) {
                        continue;
                    }
                    $k++;
                    // print_r($r_fsub);
                    // echo '<br>' ;
                    // echo $r_fsub['sub_code'];
                ?>  
                    <tr>
                        <td><?php echo $k ?></td>
                        <td><?php echo $r_fsub['faculty_name'] ?></td>


                        <?php
                        
                        
                        // echo "$i".'<br>';
                        // for ($j = 0; $j < $n_sub; $j++) {

                        $total = 'select count(name) from feedback_response where feedback_name="Course wise 2" and sem="' . $r_fsub['sem'] . '" and branch="' . $fac_dept . '" and sub="' . $r_fsub['sub_code'] . ' - ' . $r_fsub['sub_name'] . '"';
                        // echo $total . '<br>';
                        $r_total = mysqli_fetch_assoc($link->query($total));

                        $q_feed_resp = 'select * from feedback_response where feedback_name="Course wise 2" and sem="' . $r_fsub['sem'] . '" and branch="' . $fac_dept . '" and sub="' . $r_fsub['sub_code'] . ' - ' . $r_fsub['sub_name'] . '" order by usn';
                        //   echo $q_feed_resp;  
                        $dict_feed = array(
                            "Time Sense" => 4,
                            "Subject Command" => 6,
                            "Use of Teaching Aid" => 6,
                            "Helping Attitude" => 6,
                            "Class Control" => 5
                        );
                        $rating_feed = array(
                            "Time Sense" => array(0, 0, 0, 0, 0),
                            "Subject Command" => array(0, 0, 0, 0, 0),
                            "Use of Teaching Aid" => array(0, 0, 0, 0, 0),
                            "Helping Attitude" => array(0, 0, 0, 0, 0),
                            "Class Control" => array(0, 0, 0, 0, 0)
                        );
                        $itter = 0;
                        $indexes = array_keys($dict_feed);
                        $q_i = 0;
                        foreach ($dict_feed as $d) {
                            // echo $d;
                            $r_feed_resp = $link->query($q_feed_resp);
                            $rat = array();
                            foreach ($r_feed_resp as $r) {
                                $rat_val = 0;
                                for ($i = 1; $i <= $d; $i++) {
                                    // $rating_feed[$indexes[$q_i]][0] += $r['q'.($itter+$i)];
                                    $rat_val += $r['q' . ($itter + $i)];
                                }
                                $rat[] = ceil($rat_val / $d);
                                // echo ceil($rat_val / $d) . ' ';
                            }
                            // echo '<br>';
                            // echo "$i".'<br>';
                            // print_r($rat);
                            // echo '<br>';
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
                        // echo '<br>';
                        // echo "$i".'<br>';
                        $ts = ($rating_feed['Time Sense'][0] + $rating_feed['Time Sense'][1]) * 100 / $r_total['count(name)'];
                        $ts = ceil($ts);
                        // echo $ts;
                        $sb = ($rating_feed['Subject Command'][0] + $rating_feed['Subject Command'][1]) * 100 / $r_total['count(name)'];
                        $sb = ceil($sb);
                        $ut = ($rating_feed['Use of Teaching Aid'][0] + $rating_feed['Use of Teaching Aid'][1]) * 100 / $r_total['count(name)'];
                        $ut = ceil($ut);
                        $ha = ($rating_feed['Helping Attitude'][0] + $rating_feed['Helping Attitude'][1]) * 100 / $r_total['count(name)'];
                        $ha = ceil($ha);
                        $cc = ($rating_feed['Class Control'][0] + $rating_feed['Class Control'][1]) * 100 / $r_total['count(name)'];
                        $cc = ceil($cc);


                        $total_per = ($ts + $sb + $ut + $ha + $cc) / 5;
                        // echo $total_per;
                        ?>
                        <td><?php echo $r_fsub['sem'] ?></td>
                        <td><?php echo $r_fsub['sub_name'] . $r_fsub['sub_code'] ?></td>
                        <td><?php echo $total_per ?></td>
                    </tr>
                <?php
                    
                    // echo "$i".'<br>';

                } ?>


            </table>

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