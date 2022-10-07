<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once '../config.php';
    $con = $link;
        

    
        // SSLC DATA 
        $_SESSION["adm_no"] = $_POST['adm_no'];
        $_SESSION["sslc_school"] = $_POST['sslc_school'];
        $_SESSION["sslc_board_university"] = $_POST['sslc_board_university'];
        $_SESSION["sslc_reg_no"] = $_POST['sslc_reg_no'];
        $_SESSION["sslc_year"] = $_POST['sslc_year'];
        $_SESSION["sslc_max_marks"] = $_POST['sslc_max_marks'];
        $_SESSION["sslc_obtained_marks"] = $_POST['sslc_obtained_marks'];
        $_SESSION["sslc_percentage"] = $_POST['sslc_percentage'];

        // PUC DATA
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
        
         
            if($_SESSION["puc_che_obtained_marks"] > $_SESSION["puc_elective_obtained_marks"])
            {
                (int)$_SESSION["puc_sub_total_marks"] = (int)$_SESSION["puc_phy_obtained_marks"] + (int)$_SESSION["puc_maths_obtained_marks"] + (int)$_SESSION["puc_che_obtained_marks"];
            }
            else
            {
                (int)$_SESSION["puc_sub_total_marks"] = (int)$_SESSION["puc_phy_obtained_marks"] + (int)$_SESSION["puc_maths_obtained_marks"] + (int)$_SESSION["puc_elective_obtained_marks"];
            }



            $q3 = "insert into students(`adm_no`, `usn`, `batch`, `fname`, `mname`, `lname`, `branch`, `kcet`, `comedk`, `jee`, `nationality`, `data_of_admission`, `dob`, `place_of_birth`, `gender`, `mob_no`, `email_id`, `aadhar`, `pan_card`, `sc_st`, `caste`, `annual_income`, `present_state`, `present_dist`, `present_house_no_name`, `present_post_village`, `present_pincode`, `permanent_state`, `permanent_dist`, `permanent_house_no_name`, `permanent_post_village`, `permanent_pin_code`, `semester`) values (\"" . $_SESSION["adm_no"] . "\",
                                               \"" . $_SESSION["usn"] . "\",
                                               \"" . $_SESSION["batch"] . "\",
                                               \"" . $_SESSION["fname"] . "\",
                                               \"" . $_SESSION["mname"] . "\",
                                               \"" . $_SESSION["lname"] . "\",
                                               \"" . $_SESSION["branch"] . "\",
                                               \"" . $_SESSION["kcet"] . "\",
                                               \"" . $_SESSION["comedk"] . "\",
                                               \"" . $_SESSION["jee"] . "\",
                                               \"" . $_SESSION["nationality"] . "\",
                                               \"" . $_SESSION["date_of_admission"] . "\",
                                               \"" . $_SESSION["dob"] . "\",
                                               \"" . $_SESSION["place_of_birth"] . "\",
                                               \"" . $_SESSION["gender"] . "\",
                                               \"" . $_SESSION["mob_no"] . "\",
                                               \"" . $_SESSION["email_id"] . "\",
                                               \"" . $_SESSION["aadhar"] . "\",
                                               \"" . $_SESSION["pan_card"] . "\",
                                               \"" . $_SESSION["sc_st"] . "\",
                                               \"" . $_SESSION["caste"] . "\",
                                               \"" . $_SESSION["annual_income"] . "\",
                                               \"" . $_SESSION["present_state"] . "\",
                                               \"" . $_SESSION["present_dist"] . "\",
                                               \"" . $_SESSION["present_house_no_name"] . "\",
                                               \"" . $_SESSION["present_post_village"] . "\",
                                               \"" . $_SESSION["present_pin_code"] . "\",
                                               \"" . $_SESSION["permanent_state"] . "\",
                                               \"" . $_SESSION["permanent_dist"] . "\",
                                               \"" . $_SESSION["permanent_house_no_name"] . "\",
                                               \"" . $_SESSION["permanent_post_village"] . "\",
                                               \"" . $_SESSION["permanent_pin_code"] . "\" ,
                                               '1'
                                               )";
                    echo $q3;
                    if ($con->query($q3)) {
                        echo "<h1>students recorded</h1>";

                        } else {
                            echo $q3;
                        echo "<h1>students failed</h1>";
                        }
                            
            
            
            
            $q2="insert into parents_details values (\"" . $_SESSION["adm_no"] . "\",
                                                     \"" . $_SESSION["usn"] . "\",
                                                     \"" . $_SESSION["mother_name"] . "\",
                                                     \"" . $_SESSION["mother_mob_no"] . "\",
                                                     \"" . $_SESSION["mother_email_id"] . "\",
                                                     \"" . $_SESSION["mother_aadhar"] . "\",
                                                     \"" . $_SESSION["mother_pan_card"] . "\",
                                                     \"" . $_SESSION["mother_occupation"] . "\",
                                                     \"" . $_SESSION["father_name"] . "\",
                                                     \"" . $_SESSION["father_mob_no"] . "\",
                                                     \"" . $_SESSION["father_email_id"] . "\",
                                                     \"" . $_SESSION["father_aadhar"] . "\",
                                                     \"" . $_SESSION["father_pan_card"] . "\",
                                                     \"" . $_SESSION["father_occupation"] . "\"
                                                     )";
            
            
            if ($con->query($q2)) {
            echo "<h1>PARENTS recorded</h1>";

            } else {
                echo $q2;
            echo "<h1>PARENTS failed</h1>";
            }

            
            $q = "insert into sslc_details values (\"" . $_SESSION["adm_no"] . "\",
                                                   \"" . $_SESSION["sslc_school"] . "\",
                                                   \"" . $_SESSION["sslc_board_university"] . "\",
                                                   \"" . $_SESSION["sslc_reg_no"] . "\",
                                                   \"" . $_SESSION["sslc_year"] . "\",
                                                   \"" . $_SESSION["sslc_max_marks"] . "\",
                                                   \"" . $_SESSION["sslc_obtained_marks"] . "\",
                                                   \"" . $_SESSION["sslc_percentage"] . "\" 
                                                   )";

            if ($con->query($q)) {
                echo "<h1> SSLC recorded</h1>";
            } else {
                echo $q;
                echo "<h1>SSLC failed</h1>";
            }


        
            $q1 = "insert into puc_details values (\"" . $_SESSION["adm_no"] . "\",
                                               \"" . $_SESSION["puc_collage"] . "\",
                                               \"" . $_SESSION["puc_board_university"] . "\",
                                               \"" . $_SESSION["puc_reg_no"] . "\",
                                               \"" . $_SESSION["puc_year"] . "\",
                                               \"" . $_SESSION["puc_max_marks"] . "\",
                                               \"" . $_SESSION["puc_obtained_marks"] . "\",
                                               \"" . $_SESSION["puc_percentage"] . "\",
                                               \"" . $_SESSION["puc_phy_max_marks"] . "\",
                                               \"" . $_SESSION["puc_phy_obtained_marks"] . "\",
                                               \"" . $_SESSION["puc_maths_max_marks"] . "\",
                                               \"" . $_SESSION["puc_maths_obtained_marks"] . "\",
                                               \"" . $_SESSION["puc_che_max_marks"] . "\",
                                               \"" . $_SESSION["puc_che_obtained_marks"] . "\",
                                               \"" . $_SESSION["puc_elective_max_marks"] . "\",
                                               \"" . $_SESSION["puc_elective_obtained_marks"] . "\",
                                               \"" . $_SESSION["puc_sub_total_marks"] . "\",
                                               \"" . $_SESSION["puc_eng_max_marks"] . "\",
                                               \"" . $_SESSION["puc_eng_obtained_marks"] . "\"
                                               )";

            if ($con->query($q1)) {
                $_SESSION["popup"] = 1;
                    header("Location: students_insert.php");

                    
             } else {
                 echo $q1;
                    echo "<h1>PUC failed</h1>";
                $_SESSION["popup"] = 2;
                header("Location: students_insert.php");

             }

    ?>
    
</body>
</html>