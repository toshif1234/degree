<?php 
require_once "../config.php";
$c= $_POST['number'];
$gen = array_fill(0, 31 , 0);
for($i = 1; $i <= $c; $i++){
    $gen[$i] = $_POST['q' . $i];
}


$fn='select * from feedback_all where feedback_name = "' . $_POST['feedback_name'] . '"';
echo $fn;
if(mysqli_num_rows($link->query($fn)) != 0){
    $_SESSION['feed_add'] = 2;
    // echo "FAIL";
header('Location: create_feed.php');


}
else{
    $req='select max(id) from feedback_all';
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
    try{
        $id = explode('-', $id)[1];
    }
    catch(Exception $e){
    
    }
    
    $q = 'insert into feedback_all values("c-'. ($id+1) . '", "'.$_POST['feedback_name'].'","'.$gen[1] . '" , "'.$gen[2] . '","'.$gen[3] . '","'.$gen[4] . '","'.$gen[5] . '","'.$gen[6] . '","'.$gen[7] . '","'.$gen[8] . '","'.$gen[9] . '","'.$gen[10] . '","'.$gen[11] . '","'.$gen[12] . '","'.$gen[13] . '","'.$gen[14] . '","'.$gen[15] . '","'.$gen[16] . '","'.$gen[17] . '","'.$gen[18] . '","'.$gen[19] . '","'.$gen[20] . '","'.$gen[21] . '","'.$gen[22] . '","'.$gen[23] . '","'.$gen[24] . '","'.$gen[25] . '","'.$gen[26] . '","'.$gen[27] . '","'.$gen[28] . '","'.$gen[29] . '","'.$gen[30] . '" )';
    // echo $q;
    $link->query($q);
    $_SESSION['feed_add'] = 1;
    
    header('Location: create_feed.php');
}


?>