<?php

require_once "../config.php";

$branch = $_POST['branch'];
$sem = $_POST['sem'];
$sub_code = $_POST['sub_code'];
$sub_name = $_POST['sub_name'];
$sub_id = $_POST['type'];

$q = 'insert into subjects_new values("' . $branch . '", "' . $sem . '", "' . $sub_name . '", "' . $sub_code . '", "' . $sub_id . '")';
if($link->query($q)){}
else{
    $_SESSION['sub_error'] = 1;
}
header("Location: add_sub.php");

?>