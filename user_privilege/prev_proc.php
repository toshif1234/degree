<?php
    require_once "../config.php";
    // echo $_POST["select1"];
    for($i=1;$i<=$_POST["count"];$i++){
    $q1 = 'update users set identity = '. $_POST["select" . $i] .' where username = "' .$_POST["email" . $i] .'"';
    // echo $q1 . '<br>';
    $link->query($q1);
    }
    header("location: user_privilege.php");
?>