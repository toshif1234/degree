<?php

require_once "../config.php";
session_start();

$count_general = $_POST['count_general'];

echo $count_general;

$gen = array_fill(0, 30 , 0);

for($i = 1; $i <= $count_general; $i++){
    $gen[$i] = $_POST['g_rating' . $i];
}

$req='select max(id) from feedback_response';
$e_req=$link->query($req);
// $id=$e_req;
if(empty($e_req))
{
    $id=0;
}
else
{
    $id=mysqli_fetch_assoc($e_req)['max(id)'];
}
$q = 'insert into feedback_response values('. ($id+1) . ' , "' . $_SESSION['usn'] . '", "'.$_SESSION['name'] . '", "'.$_SESSION['branch'] . '","'.$_SESSION['semester'] . '","'.$_SESSION['section'] . '","'.$_SESSION['sub'] . '","'.$gen[1] . '","'.$gen[2] . '","'.$gen[3] . '","'.$gen[4] . '","'.$gen[5] . '","'.$gen[6] . '","'.$gen[7] . '","'.$gen[8] . '","'.$gen[9] . '","'.$gen[10] . '","'.$gen[11] . '","'.$gen[12] . '","'.$gen[13] . '","'.$gen[14] . '","'.$gen[15] . '","'.$gen[16] . '","'.$gen[17] . '","'.$gen[18] . '","'.$gen[19] . '","'.$gen[20] . '","'.$gen[21] . '","'.$gen[22] . '","'.$gen[23] . '","'.$gen[24] . '","'.$gen[25] . '","'.$gen[26] . '","'.$gen[27] . '", "0" , "0" , "0" ,"' . $_POST['feedback_name'] . '","'.$_POST['comment'].'")';
echo $q;
$link->query($q);
if($_SESSION['feedback_number'] == 1){
    header('Location: course_wise1.php');
}
else{
    header('Location: course_wise2.php');
}
