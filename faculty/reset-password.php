<?php
include("../template/fac-auth.php");
error_reporting(0);
include(
"../template/sidebar-fac.php");
// echo $_SESSION['username'];
// Initialize the session
// session_start();
 
// Check if the user is logged in, otherwise redirect to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: login.php");
//     exit;
// }
 
// Include config file
// require_once "config.php";
 
// Define variables and initialize with empty values

    

    // Validate new password
        
    // Check input errors before updating the database
    
    
    // Close connection
    
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body> -->
<div class="conrainer">

    <div class="row">
        
        <div class="col-md-4"></div>
        <div class="col-sm-12 col-md-4">
            
            <h2>Reset Password</h2>
            <p>Please fill out this form to reset your password.</p>
            <?php 
            $flag = $_SESSION['flag'] ?? 0;
            if($flag == 1){
                echo "<span class='text-danger'>Passwords don't match</span>";
            }
            else if($flag == 2){
                echo "<span class='text-danger'>Password cannot be blank</span>";
            }
        ?>
            <form action="update_password.php" method="post">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password"
                        class="form-control" required
                        value=>
                    <!-- <span class="invalid-feedback"><?php echo $new_password_err; ?></span> -->
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password"
                        class="form-control" required>
                    <!-- <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span> -->
                </div>
                <div class="form-group mt-4">
                    <input type="submit" class="btn btn-success" value="Reset">
                    <a class="btn btn-danger ml-2" href="../welcome.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- </body>
</html> -->