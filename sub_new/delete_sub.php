<?php
require_once "../config.php";

$sub_code = $_POST['sub_code'];
$branch = $_POST['branch'];

$q = 'delete from subjects_new where sub_code = "' . $sub_code . '" and branch = "' . $branch . '"';
$link->query($q);

header("Location: view_sub.php");