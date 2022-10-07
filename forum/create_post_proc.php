<?php
session_start();
include("../config.php");

$q = 'INSERT INTO `post`( `post_pic`, `username`, `caption`) VALUES ("' . $_POST["path"] . '","' . $_SESSION["username"] . '","' . $_POST["caption"] . '")';
echo $q;

$res = $link->query($q);
if($res){
    header("Location: student_feeds.php");
}else{
    echo "error";
}

?>