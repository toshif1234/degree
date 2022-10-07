<?php
// Initialize the session
session_start();

 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}


 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            // session_start();
                            
                            // Store data in session variables
                            $_SESSION["principal"] = false;
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["priv_id"] = mysqli_fetch_assoc($link->query('select identity from users where username = "' . $username . '"'))['identity'];
                            // echo 'select faculty_name where faculty_email = "' . $username . '"';
                            if($username == 'admin' or $username == 'shreekanthsuvarna@aiet.org.in'){
                                $_SESSION['username'] = $username;
                            }
                            elseif($username == 'vivek_alva@alvas.org'){
                                $_SESSION['username'] = $username;
                            }
                            else if($_SESSION['priv_id'] == -1){
                                $_SESSION['username'] = $username;
                            }else{
                            if($username == "principalaiet08@gmail.com"){
                                $_SESSION["principal"] = true;
                            }
                            $_SESSION["username"] = mysqli_fetch_assoc($link->query('select faculty_name from faculty_details where faculty_email = "' . $username . '"'))['faculty_name'];                            
                            }
                            echo $_SESSION["username"];
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="shortcut icon" href="./asset/img/1aiet-logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./asset/style/bootstrap.min.css">
    <link rel="stylesheet" href="./asset/style/style.css">


</head>

<body>

    <style>
    #eye {
        cursor: pointer;
        position: absolute;
        left: 85%;
        padding-left: 20px;
        margin-right: 10px;
    }

    @media screen and (max-width: 1024px) {
        
        #eye{
            left:80%;
        }

    }
    
    @media screen and (max-width: 430px) {
        
        #eye{
            margin-left:27px;
        }

    }
    @media screen and (max-width: 770px) {
        
        #eye{
            
            left:73%;
        }
    }
        @media screen and (max-width: 330px) {
        
        #eye{
            left:65%;
        }

    }
    @media screen and (max-width: 379px) {
        
        #eye{
            margin-left:20px;
        }

    }
    </style>

    <div class="bg-image">
        <div class="form_bg mx-auto">
            <div class="container">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
                    <div class="row">
                        <div class="col-md-5 col-sm-12 mx-auto card-login border p-5">
                            <div class="form_icon text-center m-3 p-3"><img src="aiet-logo.png" style="width: 100px;">
                            </div>

                            <div class="fontuser">
                                <label><b class="white">Username</b></label>
                                <input type="text" placeholder="Username" name="username"
                                    class="in form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $username; ?>">
                                <i class="fa fa-user fa-lg pr-5 pt-2"></i>
                            </div>

                            <div class="fontpassword">
                                <label><b class="white">Password</b></label>
                                <input id="password" type="password" placeholder="Password" name="password"
                                    class="in form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                <i class="fa fa-key fa-lg pr-5 pt-2"></i>
                                <i class="fa fa-eye eye fa-lg pr-5 pt-2" id="eye" onclick="show_password();"></i>
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
    function show_password() {

        x = document.getElementById("password");
        y = document.getElementById("eye");

        if (x.type == "password") {
            x.type = "text";
            y.classList.remove("fa-eye");
            y.classList.add("fa-eye-slash")
        } else {
            x.type = "password";
            y.classList.remove("fa-eye-slash");
            y.classList.add("fa-eye")
        }

    }
    </script>
</body>




<!-- <body>
    

    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

       

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html> -->