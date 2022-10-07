<?php
include "../template/fac-auth.php";
// include "../template/sidebar-fac.php";

$q='update feedback_notification set to_date="'.$_POST['to_date'].'" where id="'.$_SESSION['id'].'"';
// echo $q;
$r=$link->query($q);

header('Location: enable.php');
