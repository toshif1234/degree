<?php
require_once "../config.php";
$name = $_POST["hod_name"];
$branch = $_POST["branch"];
session_start();
$q1 = 'select * from faculty_details where faculty_name = "'. $name .'"';
$res = $link->query($q1);
$r = mysqli_fetch_assoc($res);
// echo $r["faculty_id"];
$ii = $link->query('select max(id) from hod');
$idd = mysqli_fetch_assoc($ii);
// echo $idd['max(id)'];
$id1=(int)$idd['max(id)'] +1;
$q2 = 'INSERT INTO `hod`(`id`, `faculty_id`, `name`, `branch`) VALUES('. $id1 .',"'. $r["faculty_id"] .'","'. $name .'", "'. $branch .'")';
// echo "<br>";
echo  $q2;
try {
    $link->query($q2);
    $goin = 1;;
} catch (\Throwable $th) {
    $goin = 0;
}


if($goin){
    $_SESSION["popup"] = 1;
    echo $_SESSION["popup"];
    header("Location: assign.php");
}
else{
    $_SESSION["popup"] = 2;
    header("Location: assign.php");
}




?>