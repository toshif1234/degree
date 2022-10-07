<?php
require_once "config1.php";
// session_start();
$branch = $_SESSION["branch"];
$sec = $_SESSION["sec"];
$sem = $_SESSION["sem"];
$sub = $_SESSION["sub"];
$qq = "select distinct * from lab_marks where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\"";
$result = $con->query($qq);
$r_no = mysqli_fetch_assoc($result);
$sub_code=explode(" - ",$sub);
 for($i=1;$i<=$r_no['no_exp'];$i++){
   //  print_r($_POST['exp-co-' . $i]);
    echo "<br>";
   if(!isset($_POST['exp-co-' . $i]) || count($_POST['exp-co-' . $i]) == 0){
      $co = "NULL";
   }else{
    $co = implode(',', $_POST['exp-co-' . $i]);
   }
   //  echo $co;
   //  echo $i . ' ' . $_POST['exp-co-' . $i] . '<br>';
    $q='update lab_co_mapping set e' . $i . ' = "' . $co . '" where subcode="' . $sub . '" and dept="' . $branch . '";';
    echo $q;
    $con->query($q);


 }
header("Location: lab_marks.php");



?> 