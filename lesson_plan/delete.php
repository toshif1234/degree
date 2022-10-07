<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../config.php";
        $con = $link;
          $sem = $_SESSION["sem"];
          $subid = $_SESSION["subid"];
          $sec = $_SESSION["sec"];
        //   echo $sem;
          // echo  $_SESSION["vtu"];
            $q = "DELETE FROM `lessonpanl` WHERE sem = \"" . $sem . "\" and subid = \"" . $subid . "\" and section = \"" . $sec . "\" and branch = \"" . $_SESSION['branch'] . "\"";
            // echo $q;
            $result = $con -> query($q);
            echo "<script>window.location.href='lesson_plan.php';</script>";
            // header("Location: lesson_plan.php");?>