<?php
    require_once '../config.php';
    $con = $link;
        session_start();
       
        // $usn=$_POST["usn"];
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
        $_SESSION["father_pan_card"] = $_POST["father_pan_card"];
        $_SESSION["father_occupation"] = $_POST["father_occupation"];

        // $q="insert into parents_details values (\"" . $adm_no . "\",\"" . $usn . "\",\"" . $mother_name . "\",\"" . $mother_mob_no . "\",\"" . $mother_email_id . "\",\"" . $mother_aadhar . "\",\"" . $mother_pan_card . "\",\"" . $mother_occupation . "\",\"" . $father_name . "\",\"" . $father_mob_no . "\",\"" . $father_email_id . "\",\"" . $father_aadhar . "\",\"" . $father_pan_card . "\",\"" . $father_occupation . "\")"; 
        
      
        // $r=$con->query($q);
        header("Location: sslc_puc_insert.php");
    
?>