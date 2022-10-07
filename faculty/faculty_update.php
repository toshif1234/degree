<?php
session_start();
require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrive the Data</title>
</head>

<body>

    <?php

      $con =  $link;

            $_SESSION["faculty_id"]=$_POST['faculty_id'];
            $faculty_desg = $_POST['faculty_desg'];
            $faculty_dept= $_POST['faculty_dept'];
            $faculty_qulfy = $_POST['faculty_qulfy'];
            $faculty_yoj= $_POST['faculty_yoj'];
            $faculty_dob= $_POST['faculty_dob'];
            $faculty_email= $_POST['faculty_email'];
            $faculty_contact = $_POST['faculty_contact'];
            $faculty_parmenent_address= $_POST['faculty_parmenent_address'];
            $faculty_present_address = $_POST['faculty_present_address'];
            $faculty_teaching_exp = $_POST['faculty_teaching_exp'];
            $faculty_industry_exp = $_POST['faculty_industry_exp'];
            $faculty_aicte_id = $_POST['faculty_aicte_id'];

         
            $faculty_ug_dept = $_POST['faculty_ug_dept'];
            $faculty_ug_year = $_POST['faculty_ug_year'];
            $faculty_ug_college = $_POST['faculty_ug_college'];

            $faculty_pg_dept = $_POST['faculty_pg_dept'];
            $faculty_pg_year = $_POST['faculty_pg_year'];
            $faculty_pg_college = $_POST['faculty_pg_college'];

            

            $faculty_phd_reg= $_POST['faculty_phd_reg'];
            $faculty_phd_status = $_POST['faculty_phd_status'];
            $faculty_phd_guide = $_POST['faculty_phd_guide'];
            $faculty_phd_topic = $_POST['faculty_phd_topic'];
            $faculty_phd_domain = $_POST['faculty_phd_domain'];
            $faculty_phd_center = $_POST['faculty_phd_center'];
            $faculty_phd_yoj = $_POST['faculty_phd_yoj'];
            $faculty_phd_complition= $_POST['faculty_phd_complition'];
            $faculty_sub_handel=$_POST['faculty_sub_handel'];



            $q="update faculty_details set  faculty_desg=\"" . $faculty_desg . "\" ,
                                                 faculty_dept=\"" . $faculty_dept . "\",
                                                 faculty_qulfy=\"" . $faculty_qulfy . "\",
                                                 faculty_yoj=\"" . $faculty_yoj . "\",
                                                 faculty_dob=\"" . $faculty_dob . "\",
                                                 faculty_email=\"" . $faculty_email . "\",
                                                 faculty_contact=\"" . $faculty_contact . "\",
                                                 faculty_parmenent_address=\"" . $faculty_parmenent_address . "\",
                                                 faculty_present_address=\"" . $faculty_present_address . "\",
                                                 faculty_teaching_exp=\"" . $faculty_teaching_exp . "\",

                                                 faculty_industry_exp=\"" . $faculty_industry_exp. "\",
                                                 faculty_aicte_id=\"" . $faculty_aicte_id. "\",
                                                 faculty_ug_dept=\"" . $faculty_ug_dept. "\",
                                                 faculty_ug_year=\"" . $faculty_ug_year . "\",
                                                 faculty_ug_college=\"" . $faculty_ug_college . "\",
                                                 faculty_pg_dept=\"" . $faculty_pg_dept. "\",
                                                 faculty_pg_year=\"" . $faculty_pg_year. "\",
                                                 faculty_pg_college=\"" . $faculty_pg_college . "\",
                                                 faculty_phd_reg=\"" . $faculty_phd_reg. "\",
                                                 faculty_phd_status=\"" . $faculty_phd_status . "\",
                                                 faculty_phd_guide=\"" . $faculty_phd_guide. "\",
                                                 faculty_phd_topic=\"" . $faculty_phd_topic. "\",
                                                 faculty_phd_domain=\"" . $faculty_phd_domain. "\",
                                                 faculty_phd_center=\"" . $faculty_phd_center. "\",

                                                 faculty_phd_yoj=\"" . $faculty_phd_yoj . "\",

                                                 faculty_phd_complition=\"" . $faculty_phd_complition . "\",
                                                 faculty_sub_handel=\"" . $faculty_sub_handel. "\" WHERE faculty_id=\"" .$_SESSION["faculty_id"]. "\" " ;
                                                 

            //teaching details
            // $_SESSION["faculty_sub_handel"] = $_POST['faculty_sub_handel'];
            
            echo $q;
       
             if($con->query($q))
             {
               header("Location: faculty_view_details.php");
             }
             else
             {
                 echo "Faculty Details Not Recorded";
             }
    ?>
    
</body>


                                                     




</html>