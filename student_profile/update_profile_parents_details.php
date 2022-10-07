<?php 
require_once "../config.php";
$con=$link;
include("../template/stud_auth.php");
include("../template/student_sidebar.php"); 


        $_SESSION["adm_no"] = $_POST['adm_no'];

        $_SESSION["mother_name"] = $_POST["mother_name"];
        $_SESSION["mother_mob_no"] = $_POST["mother_mob_no"];
        $_SESSION["mother_email_id"] = $_POST["mother_email_id"];
        $_SESSION["mother_aadhar"] = $_POST["mother_aadhar"];
        $_SESSION["mother_pan_card"] = $_POST["mother_pan_card"];
        $_SESSION["mother_occupation"] = $_POST["mother_occupation"];
        $_SESSION["father_name"] = $_POST["father_name"];
        $_SESSION["father_mob_no"] = $_POST["father_mob_no"];
        $_SESSION["father_email_id"] = $_POST["father_email_id"];
        $_SESSION["father_aadhar"] = $_POST["father_aadhar"];
        $_SESSION["father_pan_card"] = $_POST["father_pan_cad"];
        $_SESSION["father_occupation"] = $_POST["father_occupation"];

        $q = "UPDATE `parents_details` SET 
                                            `mother_name`= \"" . $_SESSION["mother_name"] . "\",
                                            `mother_mob_no`= \"" . $_SESSION["mother_mob_no"] . "\",
                                            `mother_email_id`= \"" . $_SESSION["mother_email_id"] . "\",
                                            `mother_aadhar`= \"" . $_SESSION["mother_aadhar"] . "\",
                                            `mother_pan_card`= \"" . $_SESSION["mother_pan_card"] . "\",
                                            `mother_occupation`= \"" . $_SESSION["mother_occupation"] . "\",
                                            `father_name`= \"" . $_SESSION["father_name"] . "\",
                                            `father_mob_no`= \"" . $_SESSION["father_mob_no"] . "\",
                                            `father_email_id`= \"" . $_SESSION["father_email_id"] . "\",
                                            `father_aadhar`= \"" . $_SESSION["father_aadhar"] . "\",
                                            `father_pan_cad`= \"" . $_SESSION["father_pan_card"] . "\",
                                            `father_occupation`= \"" . $_SESSION["father_occupation"] . "\"
                                            WHERE 
                                            `adm_no`=\"" .  $_SESSION["adm_no"] . "\"";
                                            // echo $q;
    if ($con->query($q)) {
        //  header("Location: student_login_profile_view.php");
        echo '<script>window.location.replace("student_login_profile_view.php");</script>';
        
    } else {
        echo "<h1>PUC details  failed to update</h1>";
    }


?>