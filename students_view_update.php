<?php 
session_start();
require_once "./config.php";
$con=$link;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fields</title>
</head>

<body>
    <?php
    
    
        $_SESSION["adm_no"] = $_POST['adm_no'];

        $_SESSION["usn"] = $_POST['usn'];
        
        $_SESSION["batch"] = $_POST['batch'];
        
        $_SESSION["fname"] = $_POST['fname'];
       $_SESSION["mname"] = $_POST['mname'];
       $_SESSION["lname"] = $_POST['lname'];
       $_SESSION["branch"] = $_POST['branch'];
       $_SESSION["kcet"] = $_POST['kcet'];
       $_SESSION["comedk"] = $_POST['comedk'];
       $_SESSION["jee"] = $_POST['jee'];
        $_SESSION["nationality"] = $_POST['nationality'];
       $_SESSION["data_of_admission"] = $_POST['date_of_admission'];
        $_SESSION["dob"] = $_POST['dob'];
        $_SESSION["place_of_birth"] = $_POST['place_of_birth'];
        $_SESSION["gender"] = $_POST['gender'];
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
       $_SESSION["present_pincode"] = $_POST['present_pincode'];
       $_SESSION["permanent_state"] = $_POST['permanent_state'];
       $_SESSION["permanent_dist"] = $_POST['permanent_dist'];
        $_SESSION["permanent_house_no_name"] = $_POST['permanent_house_no_name'];
        $_SESSION["permanent_post_village"] = $_POST['permanent_post_village'];
        $_SESSION["permanent_pin_code"] = $_POST['permanent_pin_code'];



        $q = "update students set  
                                  batch =\"" . $_SESSION["batch"] . "\" ,
                                  fname =\"" . $_SESSION["fname"] . "\" ,
                                  mname =\"" . $_SESSION["mname"] . "\" ,
                                  lname =\"" . $_SESSION["lname"] . "\" ,
                                 branch =\"" . $_SESSION["branch"] . "\" ,
                                   kcet =\"" . $_SESSION["kcet"] . "\" ,        
        comedk =\"" . $_SESSION["comedk"] . "\" ,   
        jee =\"" . $_SESSION["jee"] . "\" ,   
        nationality =\"" . $_SESSION["nationality"] . "\" ,   
        data_of_admission =\"" . $_SESSION["data_of_admission"] . "\" ,   
        dob =\"" . $_SESSION["dob"] . "\" ,   
        place_of_birth =\"" . $_SESSION["place_of_birth"] . "\" ,  
        gender =\"" . $_SESSION["gender"] . "\" ,  
        mob_no =\"" . $_SESSION["mob_no"] . "\" ,  
        email_id =\"" . $_SESSION["email_id"] . "\" ,  
        aadhar =\"" . $_SESSION["aadhar"] . "\" ,  
        pan_card =\"" . $_SESSION["pan_card"] . "\" ,  
        sc_st =\"" . $_SESSION["sc_st"] . "\" ,  
        caste =\"" . $_SESSION["caste"] . "\" ,  
        annual_income =\"" . $_SESSION["annual_income"] . "\" ,  
        present_state =\"" . $_SESSION["present_state"]. "\" ,  
        present_dist =\"" . $_SESSION["present_dist"] . "\" ,  
        present_house_no_name =\"" . $_SESSION["present_house_no_name"] . "\" ,  
        present_post_village =\"" . $_SESSION["present_post_village"] . "\" ,  
        present_pincode =\"" . $_SESSION["present_pincode"] . "\" ,  
        permanent_state =\"" . $_SESSION["permanent_state"] . "\" ,  
        permanent_dist =\"" . $_SESSION["permanent_dist"] . "\" ,  
        permanent_house_no_name =\"" . $_SESSION["permanent_house_no_name"] . "\" ,  
        permanent_post_village =\"" . $_SESSION["permanent_post_village"] . "\" ,  
        permanent_pin_code =\"" . $_SESSION["permanent_pin_code"] . "\"  where adm_no =\"" . $_SESSION["adm_no"] . "\"";

        if ($con->query($q)) {
            
        echo  $_SESSION["permanent_pin_code"];
             header("Location: student_login_view.php");
        } else {
            echo "<h1>failed</h1>";
        }
    
    ?>
</body>

</html>