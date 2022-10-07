<?php
require_once "../config.php";
// session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    
    header("location: ../index.php");
    exit;
    
}
$q1 = "select * from users where identity = 1";
$u_name = $link->query($q1);
$flag = 0;
foreach($u_name as $u){
    if($u["username"] == $_SESSION["username"]){
        $flag = 1;
    }

}

if(!$flag){
    header("location: ../index.php");
}
?>