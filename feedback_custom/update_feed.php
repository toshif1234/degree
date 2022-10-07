<?php
require_once "../config.php";

$c=$_POST['count'];
for($i=1;$i<=$c;$i++)
{
    $q='update feedback_all set q'.$i.'="'.$_POST['q'.$i].'" where feedback_name="'.$_SESSION['feedback_name'].'"';
    // echo $q.'<br>';
    $r=$link->query($q);

}

header("Location: view_all_feed.php");