<?php

require_once '../config.php';
error_reporting(0);
session_start();

$q = 'select faculty_email from faculty_details where faculty_name = "' . $_SESSION['username'] . '"';
$email = mysqli_fetch_assoc($link->query($q))['faculty_email'];

get_headers('https://73209.wayscript.io/?email=' . $email . '&subject=Reset%20Password&content=You%20have%20a%20request%20for%20resetting%20password.%20If%20it%20was%20not%20you,%20please%20contact%20the%20department%20admin');

$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];
if(empty($new_password) || empty($confirm_password)){
    $_SESSION['flag'] = 2;
    header('Location: reset-password.php');
}
else if(strcmp($new_password, $confirm_password) != 0){
    $_SESSION['flag'] = 1;
    header('Location: reset-password.php');
}
else{
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: ../logout.php");
                // exit();
            } 

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }