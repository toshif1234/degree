<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$cnt = $_POST['count'];
$_SESSION['count'] = $cnt;
$sem1 = $_SESSION['sem'];
$a1 = $_POST['code'];
$_SESSION['code'] = $a1;
$q10 = "select * from exam_schedule_details where us_code = '$a1'";
$res = $link->query($q10);
$q11 = "select distinct date,stime,etime from exam_schedule_details where us_code = '$a1'";
$res2 = $link->query($q11);
$q1 = "select distinct semester from students";
$q4 = "select * from exam_rooms";
$group1 = array();
$group2 = array();
$result1 = $link->query($q1);
$result4 = $link->query($q4);
$qa1 = "(select usn from exam_arrear_details  where (usn LIKE '%ME%') AND sem='$sem1')";
$qa2 = "(select usn from exam_arrear_details  where (usn LIKE '%CV%') AND sem='$sem1')";
$qa3 = "(select usn from exam_arrear_details  where (usn LIKE '%EC%') AND sem='$sem1')";
$qa4 = "(select usn from exam_arrear_details  where (usn LIKE '%CS%') AND sem='$sem1')";
$qa5 = "(select usn from exam_arrear_details  where (usn LIKE '%IS%') AND sem='$sem1')";
$qa6 = "(select usn from exam_arrear_details  where (usn LIKE '%AI%') AND sem='$sem1')";
$groupa1 = array();
$groupa2 = array();
$groupa3 = array();
$groupa4 = array();
$groupa5 = array();
$groupa6 = array();
$resulta1 = $link->query($qa1);
$resulta2 = $link->query($qa2);
$resulta3 = $link->query($qa3);
$resulta4 = $link->query($qa4);
$resulta5 = $link->query($qa5);
$resulta6 = $link->query($qa6);
if(mysqli_num_rows($resulta1)>0);
{
    foreach ($resulta1 as $ra1) {
        array_push($groupa1, $ra1['usn']);
    }
}
if(mysqli_num_rows($resulta2)>0);
{
    foreach ($resulta2 as $ra2) {
        array_push($groupa2, $ra2['usn']);
    }
}
if(mysqli_num_rows($resulta3)>0);
{
    foreach ($resulta3 as $ra3) {
        array_push($groupa3, $ra3['usn']);
    }
}
if(mysqli_num_rows($resulta4)>0);
{
    foreach ($resulta4 as $ra4) {
        array_push($groupa4, $ra4['usn']);
    }
}
if(mysqli_num_rows($resulta5)>0);
{
    foreach ($resulta5 as $ra5) {
        array_push($groupa5, $ra5['usn']);
    }
}
if(mysqli_num_rows($resulta6)>0);
{
    foreach ($resulta6 as $ra6) {
        array_push($groupa6, $ra6['usn']);
    }
}
  $a1=sizeof($groupa1);
 $a2=sizeof($groupa2);
 $a3=sizeof($groupa3);
 $a4=sizeof($groupa4);
 $a5=sizeof($groupa5);
 $a6=sizeof($groupa6);
$countgroup1=0;
if($a1!=0){
    for($i=0;$i<$a1;$i++){
        $countgroup1++;
    $group1[$i]=$groupa1[$i];
    }
}
if($a2!=0){
    $duplicatecountgroup11=$countgroup1;
    $k=0;
    for($i=$duplicatecountgroup11;$i<$a2+$duplicatecountgroup11;$i++){
        $countgroup1++;
    $group1[$i]=$groupa2[$k++];
    }  
}
if($a3!=0){
    $duplicatecountgroup12=$countgroup1;
    $k=0;
    for($i=$duplicatecountgroup12;$i<$a3+$duplicatecountgroup12;$i++){
        $countgroup1++;
    $group1[$i]=$groupa3[$k++];
    }
}

    // $count2=0;
    // for($i=0;$i<sizeof($group1);$i++){
    //   $count2++;
    //     echo "group1:".$group1[$i];
    //     echo "<br>";
    // }
    // //for group 2
    // echo $count2;
    $countgroup2=0;
    if($a4!=0){
        for($i=0;$i<$a4;$i++){
            $countgroup2++;
        $group2[$i]=$groupa4[$i];
        }
    }
    if($a5!=0){
        $duplicatecountgroup21=$countgroup2;
        $k=0;
        for($i=$duplicatecountgroup21;$i<$a5+$duplicatecountgroup21;$i++){
            $countgroup2++;
        $group2[$i]=$groupa5[$k++];
        }  
    }
    if($a6!=0){
        $duplicatecountgroup22=$countgroup2;
        $k=0;
        for($i=$duplicatecountgroup22;$i<$a6+$duplicatecountgroup22;$i++){
            $countgroup2++;
        $group2[$i]=$groupa6[$k++];
        }
    }
    
        // $count3=0;
        // for($i=0;$i<sizeof($group2);$i++){
        //   $count3++;
        //     echo "group2:".$group2[$i];
        //     echo "<br>";
        // }
        // //for group 2
        // echo $count3;
$group4 = array();
$group5 = array();
$group6 = array();
error_reporting(0);
foreach ($result4 as $r4) {
    array_push($group4, $r4['room_number']);
}
foreach ($result4 as $r5) {
    array_push($group5, $r5['block']);
}
$count = 0;
$count1 = 0;
$l = 0;
$k = sizeof($group1);
$j = sizeof($group2);
if ($k > $j) {
    $big = $k;
    $sm = $j;
    for ($i = $sm; $i < $big; $i++) {
        $group6[$l++] = $group1[$i];
    }
} else {
    $big = $j;
    $sm = $k;
    for ($i = $sm; $i < $big; $i++) {
        $group6[$l++] = $group2[$i];
    }
}
$group10 = array();
$group11 = array();
for ($i = 0; $i < $sm; $i++) {
    $group10[$i] = $group1[$i];
}

for ($i = 0; $i < $sm; $i++) {
    $group11[$i] = $group2[$i];
}
$remainingCount = sizeof($group6);
$index = 0;
for ($i = $sm; $i < ($sm + ($remainingCount / 2)); $i++) {
    $group10[$i] = $group6[$index++];
}
for ($i = $sm; $i < ($sm + ($remainingCount / 2)); $i++) {
    $group11[$i] = $group6[$index++];
}
$end1 = 0;
$end2 = 0;
?>
<?php
$countroom=0;
for ($i = 0; $i < floor(($sm) / ($cnt * 2)); $i++) {
    $countroom++;
?>
    <div class="outer my-3" style="border: 2px solid black; padding: 10px">
        <?php
        echo "<center><b>ALVAS INSTITUTE OF ENGINEERING AND TECHNOLOGY</b></center>";
        echo "<center><b>VTU THEORY EXAMINATION</b></center>";
        echo "<center><b>SEATING ARRANGEMENT</b></center><br>";
        foreach ($res2 as $r) {
        ?>
            <div class="container" style="font-size: bold;">
                <?php
                echo "<b>DATE: " . $r['date'] . "</b>";
                echo str_repeat("&nbsp;", 120);
                $stime = $r['stime'];
                $etime = $r['etime'];
                echo "<b>TIME: " . date('h:i a ', strtotime($stime)) . " to " . date('h:i a ', strtotime($etime)) . "</b>";
                // echo "TIME: ".$r['stime']." to ".$r['etime'];
                echo str_repeat("&nbsp;", 100);
                echo "<b>College Code: 4AL</b>";
                echo "<br>";
                echo "<br>";
                ?>
            </div>
        <?php }
        echo "<b>ROOM NO:" . $group4[$i] . " (" . $group5[$i] . ")</b><br><br>";
        ?>
        <div class="row">
            <div class="col order-1">
                <span class="d-block fw-bolder my-1">1-coulmn</span>
                <?php
                for ($b = 0; $b < $cnt; $b++) {
                    echo "<b>" . $group10[$count] . "</b>";
                    $count++;
                    $end1++;
                ?>
                    <br>
                <?php
                } ?>
            </div>
            <div class="col order-3">
                <span class="d-block fw-bolder my-1">3-coulmn</span>
                <?php
                for ($a = $cnt + 1; $a < ($cnt * 2) + 1; $a++) {
                    echo "<b>" . $group10[$count] . "</b>";
                    $count++;
                    $end1++;
                ?>
                    <br>
                <?php
                } ?>

            </div>
            <div class="col order-2">
                <span class="d-block fw-bolder my-1">2-coulmn</span>
                <?php
                for ($c = 0; $c < $cnt; $c++) {
                    echo "<b>" . $group11[$count1] . "</b>";
                    $count1++;
                    $end2++;
                ?>
                    <br>
                <?php
                } ?>
            </div>
            <div class="col order-4">
                <span class="d-block fw-bolder my-1">4-coulmn</span>
                <?php
                for ($d = $cnt + 1; $d < ($cnt * 2) + 1; $d++) {
                    echo "<b>" . $group11[$count1] . "</b>";
                    $count1++;
                    $end2++;
                ?>
                    <br>
                <?php
                } ?>
            </div>
        </div>
        <br>
        <br>
        <?php
        echo "<br>";
        echo "<br>";
        ?>
    </div>
<?php
}
?>
<?php
$val=0;
$group100=array();
if($k>$j){
    for($i=($countroom*($cnt*2));$i<$sm;$i++){
        $group100[$val++]=$group11[$i];
    }
    for($i=($countroom*($cnt*2));$i<$sm;$i++){
        $group100[$val++]=$group10[$i];
    }
    for($i=0;$i<sizeof($group6);$i++){
        $group100[$val++]=$group6[$i];
    }
    }
    else{
        for($i=($countroom*($cnt*2));$i<$sm;$i++){
            $group100[$val++]=$group10[$i];
        }
        for($i=($countroom*($cnt*2));$i<$sm;$i++){
            $group100[$val++]=$group11[$i];
        }
        for($i=0;$i<sizeof($group6);$i++){
            $group100[$val++]=$group6[$i];
        }
        }
$countnew=0;
for ($i = 0; $i < ceil((sizeof($group100)/($cnt*2*2))); $i++) {
    ?>
        <div class="outer my-3" style="border: 2px solid black; padding: 10px">
            <?php
            echo "<center><b>ALVAS INSTITUTE OF ENGINEERING AND TECHNOLOGY</b></center>";
            echo "<center><b>VTU THEORY EXAMINATION</b></center>";
            echo "<center><b>SEATING ARRANGEMENT</b></center><br>";
            foreach ($res2 as $r) {
            ?>
                <div class="container" style="font-size: bold;">
                    <?php
                    echo "<b>DATE: " . $r['date'] . "</b>";
                    echo str_repeat("&nbsp;", 120);
                    $stime = $r['stime'];
                    $etime = $r['etime'];
                    echo "<b>TIME: " . date('h:i a ', strtotime($stime)) . " to " . date('h:i a ', strtotime($etime)) . "</b>";
                    // echo "TIME: ".$r['stime']." to ".$r['etime'];
                    echo str_repeat("&nbsp;", 100);
                    echo "<b>College Code: 4AL</b>";
                    echo "<br>";
                    echo "<br>";
                    ?>
                </div>
            <?php }
            echo "<b>ROOM NO:" . $group4[$i] . " (" . $group5[$i] . ")</b><br><br>";
            ?>
            <div class="row">
                <div class="col order-1">
                    <span class="d-block fw-bolder my-1">1-coulmn</span>
                    <?php
                    for ($b = 0; $b < $cnt; $b++) {
                        echo "<b>" . $group100[$countnew] . "</b>";
                        $countnew++;
                        $end1++;
                    ?>
                        <br>
                    <?php
                    } ?>
                </div>
                <div class="col order-2">
                    <span class="d-block fw-bolder my-1">2-coulmn</span>
                    <?php
                    for ($a = $cnt + 1; $a < ($cnt * 2) + 1; $a++) {
                        echo "<b>" . $group100[$countnew] . "</b>";
                        $countnew++;
                        $end1++;
                    ?>
                        <br>
                    <?php
                    } ?>
    
                </div>
                <div class="col order-3">
                    <span class="d-block fw-bolder my-1">3-coulmn</span>
                    <?php
                    for ($c = 0; $c < $cnt; $c++) {
                        echo "<b>" . $group100[$countnew] . "</b>";
                        $countnew++;
                        $end2++;
                    ?>
                        <br>
                    <?php
                    } ?>
                </div>
                <div class="col order-4">
                    <span class="d-block fw-bolder my-1">4-coulmn</span>
                    <?php
                    for ($d = $cnt + 1; $d < ($cnt * 2) + 1; $d++) {
                        echo "<b>" . $group100[$countnew] . "</b>";
                        $countnew++;
                        $end2++;
                    ?>
                        <br>
                    <?php
                    } ?>
                </div>
            </div>
            <br>
            <br>
            <?php
            echo "<br>";
            echo "<br>";
            ?>
        </div>
    <?php
    }
    ?>
<?php
include "../template/footer-fac.php";
?>