<?php 
require_once '../config.php';
$con = $link;
    session_start();
    $_SESSION["adm_no"] = $_POST['adm_no'];
    $_SESSION["usn"] = $_POST['usn'];
    $_SESSION["batch"] = $_POST['batch'];
    $_SESSION["fname"] =$_POST['fname'];
    $_SESSION["mname"] = $_POST['mname'];
    $_SESSION["lname"] = $_POST['lname'];
    $_SESSION["branch"] = $_POST['branch'];
    $_SESSION["kcet"] = $_POST['kcet'];
    $_SESSION["comedk"] = $_POST['comedk'];
    $_SESSION["jee"] = $_POST['jee'];
    $_SESSION["nationality"] = $_POST['nationality'];
    $_SESSION["date_of_admission"] = $_POST['date_of_admission'];
    $_SESSION["dob"] = $_POST['dob'];
    $_SESSION["place_of_birth"] =$_POST['place_of_birth'];
    $_SESSION["gender"]= $_POST['gender'];
    $_SESSION["mob_no"] = $_POST['mob_no'];
    $_SESSION["email_id"] = $_POST['email_id'];
    $_SESSION["aadhar"] = $_POST['aadhar'];
    $_SESSION["pan_card"] = $_POST['pan_card'];
    $_SESSION["sc_st"] = $_POST['sc_st'];
    $_SESSION["caste"] = $_POST['caste'];
    $_SESSION["annual_income"] = $_POST['annual_income'];
    $_SESSION["present_state"] = $_POST['present_state'];
    $_SESSION["present_dist"] = $_POST['present_dist'];
    $_SESSION["present_house_no_name"] = $_POST['present_house_no_name'];
    $_SESSION["present_post_village"] = $_POST['present_post_village'];
    $_SESSION["present_pin_code"] = $_POST['present_pin_code'];
    $_SESSION["permanent_state"] = $_POST['permanent_state'];
    $_SESSION["permanent_dist"] = $_POST['permanent_dist'];
    $_SESSION["permanent_house_no_name"] = $_POST['permanent_house_no_name'];
    $_SESSION["permanent_post_village"] = $_POST['permanent_post_village'];
    $_SESSION["permanent_pin_code"] = $_POST['permanent_pin_code'];

    

    header("Location: parents_insert.php");

?>