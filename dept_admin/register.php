<?php 
error_reporting(0);
include(
"../template/fac-auth.php");
include("../template/sidebar-fac.php");

?>

                
<div class="row">
    <?php
            require_once '../config.php';
            if(isset($_POST["sub"])){
                
                if(isset($_POST["username"])){
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $confirm = $_POST["confirm_password"];
                    if($password != $confirm ){
                        echo "<span class='ml-5' style='color:#e50e0e;'>Passwords don't match</span>";
                    }
                    else{
                        $id = mysqli_fetch_assoc($link->query('select max(id) from users'))['max(id)'] + 1;
                        // echo $id;
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $q_p = "insert into users(`id`, `username`,`password`,`identity`) values(\"" . $id . "\",\"" . $username . "\",\"" . $password . "\",2)";
                        // echo $q_p;
                        try{
                        $res = $link -> query($q_p);
                        $_SESSION['popup'] = 1;
                        }
                        catch(Exception $e){
                            $_SESSION['popup'] = 2;
                        }
                    }
                }
                else{
                    echo "<span class='ml-5' style='color:#e50e0e;'>Select Faculty</span>";
                }
            }
                // $username_err = $password_err = $confirm_password_err = "";
                
                ?>
                                            <?php

if(isset($_SESSION["popup"]) && $_SESSION["popup"] == 1){
    $_SESSION["popup"] = 0;
    echo '<div style="width:50%; height:50px;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sucessful</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <br>';
  
}
else if(isset($_SESSION["popup"]) && $_SESSION["popup"] == 2){
    $_SESSION["popup"] = 0;
    echo '<div style="width:50%;height:50px;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>failed</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
} ?>
                    </div>

                <div class="wrapper container p-4 m-3">
                    


                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <div class="form-group">
                            <label for="us">Username<span style="color: red;">*</span></label>
                           
                            <select name="username" id="us" name="username" class="form-control" required>
                                <option selected disabled>Select Faculty</option>
                                <?php

                                $q1 = "select * from faculty_details";
                                // echo $q1;
                                $results = $link->query($q1);
                                // print_r($results);

                                foreach ($results as $r) {

                                ?>
                                    <option value="<?php echo $r["faculty_email"] ?>"><?php echo $r["faculty_name"] ?></option>
                                <?php
                                }
                                ?>



                            </select>

                        </div>
                        <div class="form-group">
                            <label>Password<span style="color: red;">*</span></label>
                            <input type="password" value="aiet123" name="password" class="form-control" required>
                            
                        </div>
                        <div class="form-group">
                            <label>Confirm Password<span style="color: red;">*</span></label>
                            <input type="password" value="aiet123" name="confirm_password" class="form-control" required>
                        </div><br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary p-2" value="Submit" name="sub">
                            <input type="reset" class="btn btn-success p-2 m-2" value="Reset">
                        </div>
                        <!-- <p>Already have an account? <a href="login.php" style="color:blue;">Login here</a>.</p> -->
                    </form>
                    
                </div>


<?php include("../template/footer-admin.php") ?>

           