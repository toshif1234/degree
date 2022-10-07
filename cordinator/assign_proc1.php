<?php
require_once "../config.php";
$name = $_POST["name"];
$branch = $_POST["branch"];
session_start();
$q1 = 'select * from faculty_details where faculty_name = "'. $name .'"';
$res = $link->query($q1);
$r = mysqli_fetch_assoc($res);
$id2=1;
$ii = $link->query('select * from coordinator where faculty_id = "'. $r["faculty_id"] .'"');
if(mysqli_num_rows($ii) > 0)
{
    $q2 = 'update coordinator set ug_coordinator ="' . $id2 . '"   where faculty_id="'. $r["faculty_id"] .'"';
}
else
{
    $q2 = 'INSERT INTO `coordinator`(`faculty_id`, `name`, `branch`,`ug_coordinator`) VALUES("'. $r["faculty_id"] .'","'. $name .'", "'. $branch .'",'. $id2 .')';
}
try {
    $link->query($q2);
    $goin = 1;;
} catch (\Throwable $th) {
    $goin = 0;
}


if($goin){
    $_SESSION["popup"] = 1;
    echo $_SESSION["popup"];
    header("Location: ug_assign.php");
}
else{
    $_SESSION["popup"] = 2;
    header("Location: ug_assign.php");
}




?>