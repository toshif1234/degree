<?php
require_once "../config.php";
$name = $_POST["name"];
$branch = $_POST["branch"];
$sem = $_POST["sem"];
$sec = $_POST["sec"];
session_start();
$q1 = 'select * from faculty_details where faculty_name = "'. $name .'"';
$res = $link->query($q1);
$r = mysqli_fetch_assoc($res);
// echo $r["faculty_id"];
$ii = $link->query('select * from coordinator where faculty_id = "'. $r["faculty_id"] .'"');
$cp=$sem."-".$sec;
if(mysqli_num_rows($ii) > 0)
{
    $q2 = 'update coordinator set class_cordinator ="' . $cp . '"   where faculty_id="'. $r["faculty_id"] .'"';
}
else
{
    $q2 = 'INSERT INTO `coordinator`(`faculty_id`, `name`, `branch`,`class_cordinator`) VALUES("'. $r["faculty_id"] .'","'. $name .'", "'. $branch .'","'. $cp .'")';
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
    header("Location: assign.php");
}
else{
    $_SESSION["popup"] = 2;
    header("Location: assign.php");
}




?>