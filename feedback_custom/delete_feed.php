<?php
require_once "../config.php";
$q='delete from feedback_all where feedback_name="'.$_POST['feedback_name'].'"';
// echo $q;
$r=$link->query($q);
header('Location: create_feed.php');

?>