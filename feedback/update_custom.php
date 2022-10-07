<?php

require_once "../config.php";
// session_start();

$count = $_POST['count'];
// echo $count_general;
$q='select * from students where usn="'.$_SESSION['username'].'"';
echo $q;
$r=mysqli_fetch_assoc($link->query($q));

$gen = array_fill(0, 31 , 0);

for($i = 1; $i <= $count; $i++){
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
$u = 'insert into feedback_response values('. ($id+1) . ' , "' . $_SESSION['username'] . '", "'.$r['fname'] . '", "'.$r['branch'] . '","'.$r['semester'] . '","'.$r['section'] . '","nil","'.$gen[1] . '","'.$gen[2] . '","'.$gen[3] . '","'.$gen[4] . '","'.$gen[5] . '","'.$gen[6] . '","'.$gen[7] . '","'.$gen[8] . '", "'.$gen[9] . '","'.$gen[10] . '","'.$gen[11] . '","'.$gen[12] . '","'.$gen[13] . '","'.$gen[14] . '","'.$gen[15] . '","'.$gen[16] . '","'.$gen[17] . '","'.$gen[18] . '","'.$gen[19] . '","'.$gen[20] . '","'.$gen[21] . '","'.$gen[22] . '","'.$gen[23] . '","'.$gen[24] . '","'.$gen[25] . '","'.$gen[26] . '","'.$gen[27] . '", "'.$gen[28] . '" , "'.$gen[29] . '" , "'.$gen[30] . '" ,"' . $_SESSION['feed'] . '","'.$_POST['comment'].'")';
echo $u;
$link->query($u);

header('Location: custom_display.php');
