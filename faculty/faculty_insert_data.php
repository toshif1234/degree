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

        

    
            $_SESSION["faculty_id"]  = $_POST['faculty_id'];
            
            $_SESSION["faculty_name"] = $_POST['faculty_name'];
            $_SESSION["faculty_desg"] = $_POST['faculty_desg'];
            $_SESSION["faculty_dept"] = $_POST['faculty_dept'];
            $_SESSION["faculty_qulfy"] = $_POST['faculty_qulfy'];
            $_SESSION["faculty_yoj"] = $_POST['faculty_yoj'];
            $_SESSION["faculty_dob"] = $_POST['faculty_dob'];
            $_SESSION["faculty_email"] = $_POST['faculty_email'];
            $_SESSION["faculty_contact"] = $_POST['faculty_contact'];
            $_SESSION["faculty_parmenent_address"] = $_POST['faculty_parmenent_address'];
            $_SESSION["faculty_present_address"] = $_POST['faculty_present_address'];
            $_SESSION["faculty_teaching_exp"] = $_POST['faculty_teaching_exp'];
            $_SESSION["faculty_industry_exp"] = $_POST['faculty_industry_exp'];
            $_SESSION["faculty_aicte_id"] = $_POST['faculty_aicte_id'];

            // education details
            $_SESSION["faculty_ug_dept"] = $_POST['faculty_ug_dept'];
            $_SESSION["faculty_ug_year"] = $_POST['faculty_ug_year'];
            $_SESSION["faculty_ug_college"] = $_POST['faculty_ug_college'];

            $_SESSION["faculty_pg_dept"] = $_POST['faculty_pg_dept'];
            $_SESSION["faculty_pg_year"] = $_POST['faculty_pg_year'];
            $_SESSION["faculty_pg_college"] = $_POST['faculty_pg_college'];

            

            // phd details
            $_SESSION["faculty_phd_reg"] = $_POST['faculty_phd_reg'];
            $_SESSION["faculty_phd_status"] = $_POST['faculty_phd_status'];
            $_SESSION["faculty_phd_guide"] = $_POST['faculty_phd_guide'];
            $_SESSION["faculty_phd_topic"] = $_POST['faculty_phd_topic'];
            $_SESSION["faculty_phd_domain"] = $_POST['faculty_phd_domain'];
            $_SESSION["faculty_phd_center"] = $_POST['faculty_phd_center'];
            $_SESSION["faculty_phd_yoj"] = $_POST['faculty_phd_yoj'];
            $_SESSION["faculty_phd_complition"] = $_POST['faculty_phd_complition'];


            //teaching details
            $_SESSION["faculty_sub_handel"] = $_POST['faculty_sub_handel'];
            

            $q = "insert into faculty_details values (\"" . $_SESSION["faculty_id"] . "\",
                                                      \"" . $_SESSION["faculty_name"] . "\",
                                                      \"" . $_SESSION["faculty_desg"] . "\",
                                                      \"" . $_SESSION["faculty_dept"] . "\",
                                                      \"" . $_SESSION["faculty_qulfy"] . "\",
                                                      \"" . $_SESSION["faculty_yoj"] . "\",
                                                      \"" . $_SESSION["faculty_dob"] . "\",
                                                      \"" . $_SESSION["faculty_email"] . "\",
                                                      \"" . $_SESSION["faculty_contact"] . "\",
                                                      \"" . $_SESSION["faculty_parmenent_address"] . "\",
                                                      \"" . $_SESSION["faculty_present_address"] . "\",
                                                      \"" . $_SESSION["faculty_teaching_exp"] . "\",
                                                      \"" . $_SESSION["faculty_industry_exp"] . "\",
                                                      \"" . $_SESSION["faculty_aicte_id"] . "\",
                                                      \"" . $_SESSION["faculty_ug_dept"] . "\",
                                                      \"" . $_SESSION["faculty_ug_year"] . "\",
                                                      \"" . $_SESSION["faculty_ug_college"] . "\",
                                                      \"" . $_SESSION["faculty_pg_dept"] . "\",
                                                      \"" . $_SESSION["faculty_pg_year"] . "\",
                                                      \"" . $_SESSION["faculty_pg_college"] . "\",
                                                      
                                                      \"" . $_SESSION["faculty_phd_reg"] . "\",
                                                      \"" . $_SESSION["faculty_phd_status"] . "\",
                                                      \"" . $_SESSION["faculty_phd_guide"] . "\",
                                                      \"" . $_SESSION["faculty_phd_topic"] . "\",
                                                      \"" . $_SESSION["faculty_phd_domain"] . "\",
                                                      \"" . $_SESSION["faculty_phd_center"] . "\",
                                                      \"" . $_SESSION["faculty_phd_yoj"] . "\",
                                                      \"" . $_SESSION["faculty_phd_complition"] . "\",
                                                     
                                                      \"" . $_SESSION["faculty_sub_handel"] . "\" )";
            echo $q;
             if($r = $con->query($q))
             {
                $_SESSION["popup"] = 1;
                header ("Location: faculty_insert.php");
             }
             else
             {
                $_SESSION["popup"] = 2;
                //  echo "Faculty Details Not Recorded";
                header ("Location: faculty_insert.php");
             }

    ?>
    
</body>


                                                     




</html>