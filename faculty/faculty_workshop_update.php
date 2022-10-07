<?php
    require_once '../config.php';
$con = $link;
         session_start();
            $workshop_id = $_POST['workshop_id'];
            // echo $workshop_id;
             $faculty_id = $_POST['faculty_id'];
             $faculty_workshop_name =$_POST['faculty_workshop_name'];
             $faculty_workshop_title = $_POST['faculty_workshop_title'];
             $faculty_workshop_no_of_days = $_POST['faculty_workshop_no_of_days'];


             $q1 = "update faculty_workshop_details set faculty_workshop_name=\"" .  $faculty_workshop_name . "\",
                                                                 faculty_workshop_title=\"" .  $faculty_workshop_title . "\",
                                                                 faculty_workshop_no_of_days = \"" . $faculty_workshop_no_of_days . "\" WHERE faculty_id=\"" . $faculty_id  . "\" and workshop_id = $workshop_id"; 
             
             
            echo $q1;                                         
            if($r = $con->query($q1))
            {
                header ("Location:faculty_view_details.php");
            }
            else
            {
                echo "workshop Details Not Recorded";
            }

            ?>
