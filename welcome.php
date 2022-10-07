<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    // header("location: index.php");
}

$pattern = "/[4][A][L]*/";
// echo $_SESSION['username'];

// echo preg_match($pattern, '4AL18CS020');


if($_SESSION["username"] == "admin" or $_SESSION["username"] == "shreekanthsuvarna@aiet.org.in"){

    header("Location: dashboard/admin_dashboard.php");

}

else if((preg_match($pattern, $_SESSION["username"]))){

    header("Location: student_profile/student_dashboard.php");

}
else{
    
    header("Location: dashboard/fac_dashboard.php");
}




?>

<a href="logout.php"> logout</a>

<br>
<a href="reset-password.php">Reset password?</a>
