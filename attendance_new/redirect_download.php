<?php

require_once "../config.php";

$sub = $_POST['sub'] ?? $_SESSION['sub'];
$_SESSION['sub'] = $sub;
$sem = $_POST['sem'] ?? $_SESSION['sem'];
$_SESSION['sem'] = $sem;
$sec = $_POST['sec'] ?? $_SESSION['sec'];
$_SESSION['sec'] = $sec;
$branch = $_POST['branch'] ?? $_SESSION['branch'];
$_SESSION['branch'] = $branch;

$sub_name = explode(' - ', $sub)[1];

$subtype = mysqli_fetch_assoc($link->query('select sub_id from subjects_new where sub_name = "' . $sub_name . '" and branch = "' . $branch . '"'))['sub_id'];

if ($subtype == '3' && $_SESSION['lab'] == 0) {
    $_SESSION['lab'] = 1;
    header('Location: batch_select_report.php');
    exit();
}

if ($_SESSION['lab'] == 1) {
    $lab_batch = $_POST['lab_batch'] ?? $_SESSION['lab_batch'];
    $_SESSION['lab_batch'] = $lab_batch;
}

if ($subtype  == '1') {
    $q = "select * from attendance_new a,fac_elec_stud e where a.sem=\"" . $sem . "\" and a.usn = e.usn and e.sub=\"" . $sub . "\" and a.sub=\"" . $sub . "\" and e.faculty_name=\"" . $_SESSION['username'] . "\" order by a.usn;";
} elseif ($subtype == '2') {
    $q = "select * from attendance_new a,elective_maping e where a.sem=\"" . $sem . "\" and a.sec=\"" . $sec . "\" and a.usn = e.usn and a.branch=\"" . $branch . "\" and e.sub_name=\"" . $sub . "\" and a.sub=\"" . $sub . "\"  order by a.usn;";
} elseif ($subtype == '3') {
    $q = "select * from attendance_new a, students s where a.branch=\"" . $branch . "\" and a.sem=\"" . $sem . "\" and a.sec=\"" . $sec . "\" and s.lab_batch = \"" . $lab_batch . "\" and a.usn=s.usn order by usn;";
} else {
    $q = "select * from attendance_new where branch=\"" . $branch . "\" and sem=\"" . $sem . "\" and sec=\"" . $sec . "\" order by usn;";
}
// echo $q;
$result = $link->query($q);

$r_temp = mysqli_fetch_assoc($result)['att'];
$num_col = count(explode(';', $r_temp));
// echo $num_col;
$att_dict = array();
$i = 0;
foreach ($result as $r) {
    $i++;
    $temp = explode(';', $r['att']);
    sort($temp);
    $a = array($r['usn'] => $temp);
    $att_dict[] = $a;
    // print_r(sort($temp));
}
if ($subtype  == '1') {
    $q2 = "select * from attendance_average a,fac_elec_stud e where a.sem=\"" . $sem . "\" and a.usn = e.usn and e.sub=\"" . $sub . "\" and a.sub=\"" . $sub . "\" and e.faculty_name=\"" . $_SESSION['username'] . "\" order by a.usn;";
} elseif ($subtype == '2') {
    $q2 = "select * from attendance_average a,elective_maping e where a.sem=\"" . $sem . "\" and a.sec=\"" . $sec . "\" and a.usn = e.usn and a.branch=\"" . $branch . "\" and e.sub_name=\"" . $sub . "\" and a.sub=\"" . $sub . "\"  order by a.usn;";
} elseif ($subtype == '3') {
    $q2 = "select * from attendance_new a, students s where a.branch=\"" . $branch . "\" and a.sem=\"" . $sem . "\" and a.sec=\"" . $sec . "\" and s.lab_batch = \"" . $lab_batch . "\" and a.usn=s.usn order by usn;";
} else {
    $q2 = "select * from attendance_new where branch=\"" . $branch . "\" and sem=\"" . $sem . "\" and sec=\"" . $sec . "\" order by usn;";
}
$result2 = $link->query($q2);

$num_rows = mysqli_num_rows($result);
$usn_new = array();
foreach ($result as $r) {
    $usn_new[] = $r['usn'];
}
$name = array_fill_keys($usn_new, 0);
foreach($result as $r){
    $name[$r['usn']] = $r['name'];
}
$percentage = array_fill_keys($usn_new, 0);
foreach($result2 as $r2){
    $percentage[$r2['usn']] = $r2['att_avg'];
}
$count_pres = array_fill_keys($usn_new, 0);
// print_r($percentage);
// print_r($name);
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
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

<div class="row">
    <div class="col-6"><p>SEMESTER: <?php echo $sem ?></p></div>
    <div class="col-6"><p>SECTION: <?php echo $sec ?></p></div>
    <div class="col-6"><p>SUBJECT: <?php echo $sub ?></p></div>
    <div class="col-6"><p>FACULTY NAME: <?php echo $_SESSION['username'] ?></p></div>
</div>






<?php
$traverse = 0;

B:
$i = $traverse;
// echo $i;
?>
<table class="table table-bordered">
    <thead>
        <th>Sl. No.</th>
        <th>USN</th>
        <th>Name</th>
        <?php
        foreach ($att_dict as $h => $a) {
        ?>
            <th><?php
                $usn = array_keys($a)[0];
                $b = explode(':', $a[$usn][$i])[0];
                echo explode('-', $b)[2] . '/' . explode('-', $b)[1];
                ?></th>
        <?php
            $i++;
            if ($i >= 18 + $traverse) {
                break;
            }
            if ($i >= $num_col) {
                echo "<th>Percentage</th>";
                break;
            }
        }
        ?>
    </thead>
    <tbody>

        <?php
        $num_stud = 0;
        foreach ($att_dict as $k => $a) {

            $i = $traverse;
            $usn1 = array_keys($a)[0];
            // echo $i;
            $c = $count_pres[$usn1];
        ?>
            <tr>
                <td><?php echo $k + 1 ?></td>
                <td><?php echo array_keys($a)[0]; ?></td>
                <td><?php echo $name[$usn1]; ?></td>
                <?php
                for (; $i < 18 + $traverse; $i++) {
                    if ($i >= $num_col) {
                        break;
                    }

                    // $i++;
                    $b = explode(':', $a[$usn1][$i])[2];
                    if ($b == '0') {
                        echo '<td>A</td>';
                    } else {
                        $c += $b;
                        echo '<td>' . $c . '</td>';
                    }
                    if ($i == $num_col - 1) {
                        echo '<td>' . $percentage[$usn1] . '</td>';
                    }
                    // $num_stud++;
                }
                $count_pres[$usn1] = $c;
                ?>

            </tr>
        <?php

        }
        $traverse = $traverse + 18;
        if ($traverse >= $num_col) {
            goto A;
        }
        // echo $traverse;
        // echo "going back";
        goto B;

        A:

        // echo "OUT";
        ?>
    </tbody>
</table>

<style>
    @media print {
        @page {
            size: landscape;
            margin: 0.5cm;
        }
  table {page-break-after: always;}

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
</style>