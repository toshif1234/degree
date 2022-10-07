<?php
require_once '../config.php';

$date1=str_replace("-","_",$_POST["startdate"]);
    $enddate=date("Y-m-d");
    $date2=str_replace("-","_",$enddate);
    $q_dept = 'select branch from subjects_new where sub_code = "' . $subcode . '"';
if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
    $qq = "select * from subjects where branch=\"" . $_POST["dept"] . "\" and sem=\"" . $_POST["sem"] . "\"";

}
else{
    $qq="select * from subjects_new where branch=\"" . $_POST["dept"] . "\" and sem=\"" . $_POST["sem"] . "\"";

}
    $result8 = $link->query($qq);
    foreach($result8 as $r8)
    {
        $sub=$r8["sub_code"] . " - " . $r8["sub_name"];
    $q6="SELECT Column_Name FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME BETWEEN '" . $date1 . "' and '" . $date2 . "'";
    // echo $q;
    $f = [];
    $c=0;
    $result6=$link->query($q6);

    foreach($result6 as $r6){
    $q1="select " . $r6["Column_Name"] . " from attendance where " . $r6["Column_Name"] . " is null and branch='" . $_POST["dept"] . "' and sem=" . $_POST["sem"] . " and section='" . $_POST["sec"] . "' and subject='" . $sub . "';";
    // echo $q1;
    
    // $st=implode($r6);
    // $rr=explode("_",$st);
    // // print_r($rr);
    // // echo $_SESSION["month"];
    // if($rr[1]==$_SESSION["month"]){
    
    $result1=$link->query($q1);
    if(!mysqli_num_rows($result1)){
        $c++;
        $f[]=$r6["Column_Name"];
    }
// }
}
$q3 = "select * from attendance where branch=\"" . $_POST["dept"] . "\" and sem=\"" . $_POST["sem"] . "\" and section=\"" . $_POST["sec"] . "\" and subject=\"" . $sub . "\" order by usn;";
 $result3=$link->query($q3);
//  echo $q3;
$q6 = "select * from marks where branch=\"" . $_POST["dept"] . "\" and sem=\"" . $_POST["sem"] . "\" and sec=\"" . $_POST["sec"] . "\" and sub=\"" . $sub . "\" order by usn;";
$result5=$link->query($q6);  
foreach($result3 as $r3){           
// print_r($f);
if(!mysqli_num_rows($result5)){
$q5="insert into marks(`usn`, `name`, `branch`, `sem`, `sec`, `sub`,`att_avg`) values ( \"" . $r3["usn"] . "\", \"" . $r3["name"] . "\",  \"" . $_POST["dept"] . "\", \"" . $_POST["sem"] . "\", \"" . $_POST["sec"] . "\",\"" . $sub . "\", 0)";
$link->query($q5);
// echo $q5;
}
$c1=0;
    foreach($f as $v){
        $q2 = "select " . $v . " from attendance where branch=\"" . $_POST["dept"] . "\" and sem=\"" . $_POST["sem"] . "\" and section=\"" . $_POST["sec"] . "\" and subject=\"" . $sub . "\" and usn=\"" . $r3["usn"] . "\";"; 
        // echo $q2;
        $result4=$link->query($q2);
        if(mysqli_fetch_assoc($result4)["$v"]==1)
        {
            $c1++;
        }

    }
 $q4="update marks set att_avg=" . (($c1/$c)*100) . " where branch=\"" . $_POST["dept"] . "\" and sem=\"" . $_POST["sem"] . "\" and sec=\"" . $_POST["sec"] . "\" and sub=\"" . $sub . "\" and usn=\"" . $r3["usn"] . "\";"; 
//  echo $q4;
//  echo $c;
//  echo $r3["usn"];
//  echo $c1;
//  echo "<br>";
$link->query($q4);
}
    }

include_once "../template/fac-auth.php";
include_once "../template/sidebar-fac.php";
?>
<?php foreach($result8 as $r8) {
    $sub=$r8["sub_code"] . " - " . $r8["sub_name"];
    ?>
<h1><?php echo $sub; ?></h1>
<table class="table table-hover table-bordered table-responsive table-light">
 
<thead class="thead-secondary">
    <tr>
        <th scope="col" style="text-align: center;">SL.NO</th>
        <th scope="col" style="text-align: center;">USN</th>
        <th scope="col" style="text-align: center;">Name</th>
        <th scope="col" style="text-align: center;">Attendance Average</th>
    </tr>
    </thead>
    <?php 
        $q5="select * from marks where branch=\"" . $_POST["dept"] . "\" and sem=\"" . $_POST["sem"] . "\" and sec=\"" . $_POST["sec"] . "\" and sub=\"" . $sub . "\" order by usn;";
        $result7=$link->query($q5);
    ?>
    <tbody>
        <?php
        $slno = 0;
        foreach($result7 as $r)
        {
            $slno++;
        ?>
        <tr>
            <td style="text-align: center;"><?php  echo $slno; ?></td>
            <td style="text-align: center;"><?php echo $r["usn"] ?></td>
            <td style="text-align: center;"><?php echo $r["name"] ?></td>
            <td style="text-align: center;"><?php echo $r["att_avg"] ?>%</td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php } ?>

<?php include_once "../template/footer-fac.php"; ?>

