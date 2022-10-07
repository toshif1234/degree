<?php 
require_once "../config.php";
$con=$link;
error_reporting(0);
include(
"../template/stud_auth.php");
include("../template/student_sidebar.php"); ?>
<!DOCTYPE html>
<html lang="en">
<!-- <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head> -->
<body>
    <?php
    // $con = mysqli_connect("localhost","root","","erp_alvas");
    // if(mysqli_connect_error())
    // {
    //     echo "ERROR";
    // }
    // else
    // {
        

    
        // SSLC DATA 

       

        // PUC DATA
        $_SESSION["adm_no"] = $_POST['adm_no'];
        $_SESSION["puc_collage"] = $_POST['puc_collage'];
        $_SESSION["puc_board_university"] = $_POST['puc_board_university'];
        $_SESSION["puc_reg_no"] = $_POST['puc_reg_no'];
        $_SESSION["puc_year"] = $_POST['puc_year'];
        $_SESSION["puc_max_marks"] = $_POST['puc_max_marks'];
        $_SESSION["puc_obtained_marks"] = $_POST['puc_obtained_marks'];
        $_SESSION["puc_percentage"] = $_POST['puc_percentage'];
        $_SESSION["puc_phy_max_marks"] = $_POST['puc_phy_max_marks'];
        $_SESSION["puc_phy_obtained_marks"] = $_POST['puc_phy_obtained_marks'];
        $_SESSION["puc_maths_max_marks"] = $_POST['puc_maths_max_marks'];
        $_SESSION["puc_maths_obtained_marks"] = $_POST['puc_maths_obtained_marks'];
        $_SESSION["puc_che_max_marks"] = $_POST['puc_che_max_marks'];
        $_SESSION["puc_che_obtained_marks"] = $_POST['puc_che_obtained_marks'];
        $_SESSION["puc_elective_max_marks"] = $_POST['puc_elective_max_marks'];
        $_SESSION["puc_elective_obtained_marks"] = $_POST['puc_elective_obtained_marks'];
       // $puc_sub_total_marks = $_POST['puc_sub_total_marks'];
        $_SESSION["puc_eng_max_marks"] = $_POST['puc_eng_max_marks'];
        $_SESSION["puc_eng_obtained_marks"] = $_POST['puc_eng_obtained_marks'];
        
        //echo $_SESSION["adm_no"];




        $q = "update puc_details set  
            puc_school =\"" .  $_SESSION["puc_collage"] . "\" ,
            puc_board_university =\"" .  $_SESSION["puc_board_university"] . "\" ,
            puc_reg_no =\"" .  $_SESSION["puc_reg_no"] . "\" ,
            puc_year =\"" .  $_SESSION["puc_year"] . "\" ,
            puc_max_marks =\"" .  $_SESSION["puc_max_marks"] . "\" ,
            puc_obtained_marks =\"" .  $_SESSION["puc_obtained_marks"] . "\" ,
            puc_percentage =\"" .  $_SESSION["puc_percentage"] . "\" ,
            puc_phy_max_marks =\"" .  $_SESSION["puc_phy_max_marks"] . "\" ,
            puc_phy_obtained_marks =\"" .  $_SESSION["puc_phy_obtained_marks"] . "\" ,
            puc_maths_max_marks =\"" .  $_SESSION["puc_maths_max_marks"] . "\" ,
            puc_maths_obtained_marks =\"" .  $_SESSION["puc_maths_obtained_marks"] . "\" ,
            puc_che_max_marks =\"" .  $_SESSION["puc_che_max_marks"] . "\" ,
            puc_che_obtained_marks =\"" .  $_SESSION["puc_che_obtained_marks"] . "\" ,
            puc_elective_max_marks =\"" .  $_SESSION["puc_elective_max_marks"] . "\" ,
            puc_elective_obtained_marks =\"" .  $_SESSION["puc_elective_obtained_marks"] . "\" ,
            puc_eng_max_marks =\"" .  $_SESSION["puc_eng_max_marks"] . "\" ,
            puc_eng_obtained_marks =\"" .  $_SESSION["puc_eng_obtained_marks"] . "\" 
            where adm_no =\"" .  $_SESSION["adm_no"] . "\" 
            ";
            // echo $q;
         
           




        
            // $q1 = "insert into puc_details values (\"" . $_SESSION["adm_no"] . "\",
            //                                        \"" . $_SESSION["puc_collage"] . "\",
            //                                        \"" . $_SESSION["puc_board_university"] . "\",
            //                                        \"" . $_SESSION["puc_reg_no"] . "\",
            //                                        \"" . $_SESSION["puc_year"] . "\",
            //                                        \"" . $_SESSION["puc_max_marks"] . "\",
            //                                        \"" . $_SESSION["puc_obtained_marks"] . "\",
            //                                        \"" . $_SESSION["puc_percentage"] . "\",
            //                                        \"" . $_SESSION["puc_phy_max_marks"] . "\",
            //                                        \"" . $_SESSION["puc_phy_obtained_marks"] . "\",
            //                                        \"" . $_SESSION["puc_maths_max_marks"] . "\",
            //                                        \"" . $_SESSION["puc_maths_obtained_marks"] . "\",
            //                                        \"" . $_SESSION["puc_che_max_marks"] . "\",
            //                                        \"" . $_SESSION["puc_che_obtained_marks"] . "\",
            //                                        \"" . $_SESSION["puc_elective_max_marks"] . "\",
            //                                        \"" . $_SESSION["puc_elective_obtained_marks"] . "\",
            //                                        \"" . $_SESSION["puc_eng_max_marks"] . "\",
            //                                        \"" . $_SESSION["puc_eng_obtained_marks"] . "\"
            //                                        )";

            if ($con->query($q)) {
                    //  header("Location: student_login_profile_view.php");
                    echo '<script>window.location.replace("student_login_profile_view.php");</script>';
                    
             } else {
                    echo "<h1>PUC details  failed to update</h1>";
             }
    
           
           

    






// }

    ?>
    
</body>
</html>