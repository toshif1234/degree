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

    require_once '../config.php';

    session_start();
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
    $_SESSION["gender"] = $_POST['gender'] ?? "";
    $_SESSION["mob_no"] = $_POST['mob_no'];
    $_SESSION["email_id"] = $_POST['email_id'];
    $_SESSION["aadhar"] = $_POST['aadhar'];
    $_SESSION["pan_card"] = $_POST['pan_card'];
    $_SESSION["sc_st"] = $_POST['sc_st'];
    $_SESSION["caste"] = $_POST['caste'];
    $_SESSION["annual_income"] = $_POST['annual_income'];

    $_SESSION['mother_name']  = $_POST['mother_name'];
    $_SESSION['mother_mob_no']  = $_POST['mother_mob_no'];
    $_SESSION['mother_email_id']  = $_POST['mother_email_id'];
    $_SESSION['mother_aadhar']  = $_POST['mother_aadhar'];
    $_SESSION['mother_pan_card']  = $_POST['mother_pan_card'];
    $_SESSION['mother_occupation']  = $_POST['mother_occupation'];

    $_SESSION['father_name']  = $_POST['father_name'];
    $_SESSION['father_mob_no']  = $_POST['father_mob_no'];
    $_SESSION['father_email_id']  = $_POST['father_email_id'];
    $_SESSION['father_aadhar']  = $_POST['father_aadhar'];
    $_SESSION['father_pan_card']  = $_POST['father_pan_card'];
    $_SESSION['father_occupation']  = $_POST['father_occupation'];


    $_SESSION['sslc_school']  = $_POST['sslc_school'];
    $_SESSION['sslc_board_university']  = $_POST['sslc_board_university'];
    $_SESSION['sslc_reg_no']  = $_POST['sslc_reg_no'];
    $_SESSION['sslc_year']  = $_POST['sslc_year'];


    $_SESSION['sslc_max_marks']  = $_POST['sslc_max_marks'];
    $_SESSION['sslc_obtained_marks']  = $_POST['sslc_obtained_marks'];
    $_SESSION['sslc_percentage']  = $_POST['sslc_percentage'];

    $_SESSION['puc_school']  = $_POST['puc_school'];
    $_SESSION['puc_board_university']  = $_POST['puc_board_university'];
    $_SESSION['puc_reg_no']  = $_POST['puc_reg_no'];
    $_SESSION['puc_year']  = $_POST['puc_year'];
    $_SESSION['puc_max_marks']  = $_POST['puc_max_marks'];
    $_SESSION['puc_obtained_marks']  = $_POST['puc_obtained_marks'];
    $_SESSION['puc_percentage']  = $_POST['puc_percentage'];
    $_SESSION['puc_phy_max_marks']  = $_POST['puc_phy_max_marks'];
    $_SESSION['puc_phy_obtained_marks']  = $_POST['puc_phy_obtained_marks'];
    $_SESSION['puc_maths_max_marks']  = $_POST['puc_maths_max_marks'];
    $_SESSION['puc_maths_obtained_marks']  = $_POST['puc_maths_obtained_marks'];
    $_SESSION['puc_che_max_marks']  = $_POST['puc_che_max_marks'];
    $_SESSION['puc_che_obtained_marks']  = $_POST['puc_che_obtained_marks'];

    $_SESSION['puc_elective_max_marks']  = $_POST['puc_elective_max_marks'];
    $_SESSION['puc_elective_obtained_marks']  = $_POST['puc_elective_obtained_marks'];
    $_SESSION['puc_sub_total_marks']  = $_POST['puc_sub_total_marks'];
    $_SESSION['puc_eng_max_marks']  = $_POST['puc_eng_max_marks'];
    $_SESSION['puc_eng_obtained_marks']  = $_POST['puc_eng_obtained_marks'];



    $_SESSION["present_state"] = $_POST['present_state'];
    $_SESSION["present_dist"] = $_POST['present_dist'];
    $_SESSION["present_house_no_name"] = $_POST['present_house_no_name'];
    $_SESSION["present_post_village"] = $_POST['present_post_village'];
    $_SESSION["present_pincode"] = $_POST['present_pin_code'];
    $_SESSION["permanent_state"] = $_POST['permanent_state'];
    $_SESSION["permanent_dist"] = $_POST['permanent_dist'];
    $_SESSION["permanent_house_no_name"] = $_POST['permanent_house_no_name'];
    $_SESSION["permanent_post_village"] = $_POST['permanent_post_village'];
    $_SESSION["permanent_pin_code"] = $_POST['permanent_pin_code'];


    $parents = "update parents_details set  mother_name= \"" . $_SESSION['mother_name'] . "\",
mother_mob_no =  \"" . $_SESSION['mother_mob_no'] . "\",
mother_email_id =  \"" . $_SESSION['mother_email_id'] . "\",
mother_aadhar =  \"" . $_SESSION['mother_aadhar'] . "\",
mother_pan_card =  \"" . $_SESSION['mother_pan_card'] . "\",
mother_occupation =  \"" . $_SESSION['mother_occupation'] . "\",
father_name =  \"" . $_SESSION['father_name'] . "\",
father_mob_no =  \"" . $_SESSION['father_mob_no'] . "\",
father_email_id =  \"" . $_SESSION['father_email_id'] . "\",
father_aadhar =  \"" . $_SESSION['father_aadhar'] . "\",
father_pan_cad =  \"" . $_SESSION['father_pan_card'] . "\",
father_occupation =  \"" . $_SESSION['father_occupation'] . "\"
where adm_no =\"" . $_SESSION["adm_no"] . "\"";


    $puc = "update puc_details set puc_school =  \"" . $_SESSION['puc_school'] . "\",
puc_board_university =  \"" . $_SESSION['puc_board_university'] . "\",
puc_reg_no =  \"" . $_SESSION['puc_reg_no'] . "\",
puc_year =  \"" . $_SESSION['puc_year'] . "\",
puc_max_marks =  \"" . $_SESSION['puc_max_marks'] . "\",
puc_obtained_marks =  \"" . $_SESSION['puc_obtained_marks'] . "\",
puc_percentage =  \"" . $_SESSION['puc_percentage'] . "\",
puc_phy_max_marks =  \"" . $_SESSION['puc_phy_max_marks'] . "\",
puc_phy_obtained_marks =  \"" . $_SESSION['puc_phy_obtained_marks'] . "\",
puc_maths_max_marks =  \"" . $_SESSION['puc_maths_max_marks'] . "\",
puc_maths_obtained_marks =  \"" . $_SESSION['puc_maths_obtained_marks'] . "\",
puc_che_max_marks =  \"" . $_SESSION['puc_che_max_marks'] . "\",
puc_che_obtained_marks =  \"" . $_SESSION['puc_che_obtained_marks'] . "\",
puc_elective_max_marks =  \"" . $_SESSION['puc_elective_max_marks'] . "\",
puc_elective_obtained_marks =  \"" . $_SESSION['puc_elective_obtained_marks'] . "\",

puc_sub_total_marks =  \"" . $_SESSION['puc_sub_total_marks'] . "\",
puc_eng_max_marks =  \"" . $_SESSION['puc_eng_max_marks'] . "\",
puc_eng_obtained_marks =  \"" . $_SESSION['puc_eng_obtained_marks'] . "\"
where adm_no =\"" . $_SESSION["adm_no"] . "\"";

    $sslc = "update sslc_details set  sslc_school =  \"" . $_SESSION['sslc_school'] . "\",
sslc_board_university =  \"" . $_SESSION['sslc_board_university'] . "\",

sslc_reg_no =  \"" . $_SESSION['sslc_reg_no'] . "\",
sslc_year =  \"" . $_SESSION['sslc_year'] . "\",
sslc_max_marks =  \"" . $_SESSION['sslc_max_marks'] . "\",
sslc_obtained_marks =  \"" . $_SESSION['sslc_obtained_marks'] . "\",
sslc_percentage =  \"" . $_SESSION['sslc_percentage'] . "\"
where adm_no =\"" . $_SESSION["adm_no"] . "\"";


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
        present_state =\"" . $_SESSION["present_state"] . "\" ,  
        present_dist =\"" . $_SESSION["present_dist"] . "\" ,  
        present_house_no_name =\"" . $_SESSION["present_house_no_name"] . "\" ,  
        present_post_village =\"" . $_SESSION["present_post_village"] . "\" ,  
        present_pincode =\"" . $_SESSION["present_pincode"] . "\" ,  
        permanent_state =\"" . $_SESSION["permanent_state"] . "\" ,  
        permanent_dist =\"" . $_SESSION["permanent_dist"] . "\" ,  
        permanent_house_no_name =\"" . $_SESSION["permanent_house_no_name"] . "\" ,  
        permanent_post_village =\"" . $_SESSION["permanent_post_village"] . "\" ,  
        permanent_pin_code =\"" . $_SESSION["permanent_pin_code"] . "\"
        
       
       
        where adm_no =\"" . $_SESSION["adm_no"] . "\"";

    // echo $q;
    // echo $parents;
    // echo $puc;
    echo $sslc;

    if ($link->query($q) && $link->query($parents) && $link->query($puc) && $link->query($sslc)) {
        // header("Location: ../students/student_view_details.php");
        header("Location: ../dept_admin/student_view_details.php");
    } else {
        echo "<h1>failed</h1>";
    }
    ?>
</body>

</html>