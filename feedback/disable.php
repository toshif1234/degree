<?php
require_once "../config.php";
$q='delete from feedback_notification where id="'.$_POST['id'].'"';
// echo $q;
$r=$link->query($q);
header('Location: enable.php');

?>