<?php

include("../config.php");
session_start();
$q = 'DELETE FROM `display_pic` WHERE username="' . $_SESSION["username"] . '"';
$res = $link->query($q);
header("Location: faculty_login_profile_view.php");

?>