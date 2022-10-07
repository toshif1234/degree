<?php
    session_start();

function splitArray($arr, $n){
    $tend = array(array());
    $count1 = 0;
    $ct = count($arr);
    $rem = ceil($ct/$n);
    $l = $n * $rem - $ct;
    $ch = $n - $l;
    for($i = 0; $i<8;$i++){
        if($i < $ch){
            for($j = 0; $j<$rem;$j++){
                $tend[$i][$j] = $arr[$count1];
                $count1++;
            }
        }
        else{
            for($j = 0; $j<$rem-1;$j++){
                $tend[$i][$j] = $arr[$count1];
                $count1++;
            }
        }
    }
    return $tend;
}



$target_path = "../uploads/";
$target_path = $target_path.basename($_FILES['ufile']['name']);

if(move_uploaded_file($_FILES['ufile']['tmp_name'],$target_path)){
    $doc_file = $_FILES['ufile']['name'];
}
else{
    echo "error";
}
    $file = $_FILES['ufile']['name'];
    $_SESSION['filename'] = $file;
    $url = 'https://73238.wayscript.io/?sem=' . $_POST['sem'] .'&sec=' . $_POST['sec'] . '&sub=' . str_replace(" ", "%20", $_POST["sub"]) . '&file=' . str_replace(" ", "%20", $file);
    $line = file($url);
    $lesson = json_decode($line[0]);
    print_r($lesson);

    $modules = array();
    $m1 = explode(', ', $lesson['modules']);
    echo '<br><br>' . $m1;



?>