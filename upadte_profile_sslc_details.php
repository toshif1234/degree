<?php session_start(); 
require_once "./config.php";
$con=$link;?>
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
    
    
        

    
        // SSLC DATA 
        $_SESSION["adm_no"] = $_POST['adm_no'];
        $_SESSION["sslc_school"] = $_POST['sslc_school'];
        $_SESSION["sslc_board_university"] = $_POST['sslc_board_university'];
        $_SESSION["sslc_reg_no"] = $_POST['sslc_reg_no'];
        $_SESSION["sslc_year"] = $_POST['sslc_year'];
        $_SESSION["sslc_max_marks"] = $_POST['sslc_max_marks'];
        $_SESSION["sslc_obtained_marks"] = $_POST['sslc_obtained_marks'];
        $_SESSION["sslc_percentage"]= $_POST['sslc_percentage'];

       // echo $_SESSION["sslc_percentage"];

          

            
            $q = "update sslc_details set  
            sslc_school =\"" .  $_SESSION["sslc_school"] . "\" ,
            sslc_board_university=\"" .$_SESSION["sslc_board_university"]  . "\" ,
            sslc_reg_no =\"" . $_SESSION["sslc_reg_no"] . "\" ,
            sslc_year =\"" . $_SESSION["sslc_year"] . "\" ,
            sslc_max_marks =\"" . $_SESSION["sslc_max_marks"] . "\" ,
            sslc_obtained_marks =\"" . $_SESSION["sslc_obtained_marks"] . "\" , 
            sslc_percentage =\"" . $_SESSION["sslc_percentage"] . "\" 
             where adm_no =\"" . $_SESSION["adm_no"] . "\"
                                  
                                  ";

            //echo $q;
                                            

            if ($con->query($q)) {
                echo "<h1> SSLC recorded</h1>";
            } else {
                echo $q;
            }


    
           
           

    








    ?>
    
</body>
</html>