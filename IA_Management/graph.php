<?php
require_once "../config.php";
// session_start();;
function graph($branch,$sub, $link){
    $q='select total1 from ia_marks1 where branch ="' . $branch . '" and sub="' . $sub .'";';
    // echo $q;
    $result= $link->query($q);
    $q1='select total2 from ia_marks2 where branch ="' . $branch . '" and sub="' . $sub .'";';
    $result1=$link->query($q1);
    $q2='select total3 from ia_marks3 where branch ="' . $branch . '" and sub="' . $sub .'";';
    $result2=$link->query($q2);
    $poor=0;
    $avg=0;
    $high=0;
    foreach($result as $r)
    {
        if($r['total1']<13)
        {
            $poor++;
        }
        else if($r['total1']<=20 && $r['total1']>=13)
        {
            $avg++;
        }
        else{
            $high++;
        }
    }
    $poor1=0;
    $avg1=0;
    $high1=0;
    foreach($result1 as $r)
    {
        if($r['total2']<13)
        {
            $poor1++;
        }
        else if($r['total2']<=20 && $r['total2']>=13)
        {
            $avg1++;
        }
        else{
            $high1++;
        }
    }
    $poor2=0;
    $avg2=0;
    $high2=0;
    foreach($result2 as $r)
    {
        if($r['total3']<13)
        {
            $poor2++;
        }
        else if($r['total3']<=20 && $r['total3']>=13)
        {
            $avg2++;
        }
        else{
            $high2++;
        }
    }
    $arr = array(
        "ia1poor" => $poor,
        "ia1avg" => $avg,
        "ia1high" => $high,
        "ia2poor" => $poor1,
        "ia2avg" => $avg1,
        "ia2high" => $high1,
        "ia3poor" => $poor2,
        "ia3avg" => $avg2,
        "ia3high" => $high2
    );
    return json_encode($arr);
}
?>
