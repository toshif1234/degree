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
                            }else if($_SESSION['priv_id'] == -1){
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

<!-- <style>
        body {
            background-image: url("https://media.istockphoto.com/photos/dark-black-and-blue-grungy-wall-background-for-display-or-montage-of-picture-id1150477705?b=1&k=20&m=1150477705&s=612x612&w=0&h=4AOZ_RTNTu4AJ6giv0c6_j1KYiOxRC7ZyWHBpfppkMw=");
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .card {
            /* opacity: 0.7; */
            background-color: transparent;
            color: white;
        }
        
        h2 {
            text-align: center;
        }
        
        .logo {
            /* align-items: center; */
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            /* border-radius: solid; */
            /* background-color: white; */
        }
    </style>

  



<div class="container mt-5">
        <div class="row m-4">
        <?php 
        // if(!empty($login_err)){
        //     echo '<div class="alert alert-danger">' . $login_err . '</div>';
        // }        
        ?>
            <div class="col col-md-6 col-sm-6 col-lg-6">
                <h1>hello</h1>
            </div>
            <div class="col col-md-6 col-sm-6 col-lg-6">
                <div class="container" style="height: 90%; margin-top: 120px;">
                    <div class="card mt-5 p-4">
                        <img src="./asset/img/1aiet-logo.png" alt="logo" class="logo" width="120">
                        <h2>Log In</h2>
                        <hr style="background-color: white;">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="username">User Name :</label>
                                <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="username"  name="username" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="password" name="password" />
                            </div>

                            <button class="btn btn-primary" type="submit">Login</button>
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
</body> -->


<!-- <link rel="stylesheet" href="style.css"> -->
<style>
    @import url('https://rsms.me/inter/inter-ui.css');
::selection {
  background: #2D2F36;
}
::-webkit-selection {
  background: #2D2F36;
}
::-moz-selection {
  background: #2D2F36;
}
body {
  background: white;
  font-family: 'Inter UI', sans-serif;
  /* margin: 0; */
  padding: 0px 0px 0px 0px;
}
.page {
  background: #e2e2e5;

  background-image:  linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.5)),  url("asset/img/banner.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  display: flex;
  flex-direction: column;
  height: calc(100% - 0px);
  position: absolute;
  place-content: center;
  width: calc(100% - 0px);
}
@media (max-width: 767px) {
  .page {
    height: auto;
    margin-bottom: 20px;
    padding-bottom: 20px;
  }
}
.container {
  display: flex;
  height: 320px;
  margin: 0 auto;
  width: 640px;
}
@media (max-width: 767px) {
  .container {
    flex-direction: column;
    height: 630px;
    width: 320px;
  }
}
.left {
  background: white;
  height: calc(100% - 40px);
  top: 20px;
  position: relative;
  width: 50%;
}
@media (max-width: 767px) {
  .left {
    height: 100%;
    left: 20px;
    width: calc(100% - 40px);
    max-height: 270px;
  }
}
.login {
  font-size: 50px;
  font-weight: 900;
  margin: 50px 40px 40px;
}
.eula {
  color: #999;
  font-size: 14px;
  line-height: 1.5;
  margin: 40px;
}
.right {
  background: #474A59;
  box-shadow: 0px 0px 40px 16px rgba(0,0,0,0.22);
  color: #F1F1F2;
  position: relative;
  width: 50%;
}
@media (max-width: 767px) {
  .right {
    flex-shrink: 0;
    height: 100%;
    width: 100%;
    max-height: 350px;
  }
}
svg {
  position: absolute;
  width: 320px;
}
path {
  fill: none;
  stroke: url(#linearGradient);;
  stroke-width: 4;
  stroke-dasharray: 240 1386;
}
.form {
  margin: 40px;
  position: absolute;
}
label {
  color:  #c2c2c5;
  display: block;
  font-size: 14px;
  height: 16px;
  margin-top: 20px;
  margin-bottom: 5px;
}
input {
  background: transparent;
  border: 0;
  color: #f2f2f2;
  font-size: 20px;
  height: 30px;
  line-height: 30px;
  outline: none !important;
  width: 100%;
}
input::-moz-focus-inner { 
  border: 0; 
}
#submit {
  color: #707075;
  margin-top: 40px;
  transition: color 300ms;
}
#submit:focus {
  color: #f2f2f2;
}
#submit:active {
  color: #d0d0d2;
}

#logo{
    height: 80%;
    display: block;
    margin-left: auto;
  margin-right: auto;
  margin-top: 10%;

}
</style>
<div class="page">
    <div class="container">
      <div class="left">
        <img src="asset/img/1aiet-logo.png" id="logo" alt="">
      </div>
      <div class="right">
        <svg viewBox="0 0 320 300">
          <defs>
            <linearGradient
                            inkscape:collect="always"
                            id="linearGradient"
                            x1="13"
                            y1="193.49992"
                            x2="307"
                            y2="193.49992"
                            gradientUnits="userSpaceOnUse">
              <stop
                    style="stop-color:#ff00ff;"
                    offset="0"
                    id="stop876" />
              <stop
                    style="stop-color:#ff0000;"
                    offset="1"
                    id="stop878" />
            </linearGradient>
          </defs>
          <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
        </svg>
        <div class="form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" >
          <label for="password">Password</label>
          <input type="password" id="password" name="password">
          <input style="color: #f2f2f2;" type="submit" id="submit" value="Login">
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    var current = null;
    document.querySelector('#email').addEventListener('focus', function(e) {
      if (current) current.pause();
      current = anime({
        targets: 'path',
        strokeDashoffset: {
          value: 0,
          duration: 700,
          easing: 'easeOutQuart'
        },
        strokeDasharray: {
          value: '240 1386',
          duration: 700,
          easing: 'easeOutQuart'
        }
      });
    });
    document.querySelector('#password').addEventListener('focus', function(e) {
      if (current) current.pause();
      current = anime({
        targets: 'path',
        strokeDashoffset: {
          value: -336,
          duration: 700,
          easing: 'easeOutQuart'
        },
        strokeDasharray: {
          value: '240 1386',
          duration: 700,
          easing: 'easeOutQuart'
        }
      });
    });
    document.querySelector('#submit').addEventListener('focus', function(e) {
      if (current) current.pause();
      current = anime({
        targets: 'path',
        strokeDashoffset: {
          value: -730,
          duration: 700,
          easing: 'easeOutQuart'
        },
        strokeDasharray: {
          value: '530 1386',
          duration: 700,
          easing: 'easeOutQuart'
        }
      });
    });
  </script>
   <script src="asset/anime/lib/anime.min.js"></script>


       
   </body>