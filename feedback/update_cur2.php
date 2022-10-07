<?php

require_once "../config.php";
session_start();

$count_general = $_POST['count_general'];

// echo $count_general;

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
$q = 'insert into feedback_response values('. ($id+1) . ' , "' . $_SESSION['usn'] . '", "'.$_SESSION['name'] . '", "'.$_SESSION['branch'] . '","'.$_SESSION['semester'] . '","'.$_SESSION['section'] . '","'.$_SESSION['sub'] . '","'.$gen[1] . '","'.$gen[2] . '","'.$gen[3] . '","'.$gen[4] . '","'.$gen[5] . '","'.$gen[6] . '","'.$gen[7] . '","'.$gen[8] . '", "'.$gen[9] . '" , "'.$gen[10] . '" , "0" , "0" ,  "0" , "0" , "0" , "0" , "0" , "0","0" , "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0","Curriculum Feedback","'.$_POST['comment'].'")';
echo $q;
$link->query($q);

header('Location: curriculum_student.php');
