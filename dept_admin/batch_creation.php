<?php
    require_once "config.php";
error_reporting(0);
    include(
"../template/fac-auth.php");

include("../template/sidebar-fac.php");
    // echo $_SESSION['view_flag'];
    //session_start();
    if(!$_SESSION['view_flag']){
    $_SESSION["branch"]=$_POST["branch"];
        $_SESSION["batch"]= $_POST["batch"];
        $branch = $_SESSION["branch"];
        $batch = $_SESSION["batch"];
        $_SESSION['view_flag'] = 1;
    }else{
        $branch = $_SESSION["branch"];
        $batch = $_SESSION["batch"];   
    }
        $q="select * from students where branch=\"" . $branch . "\" and batch =\"" . $batch . "\" order by usn"; 
    // echo $q;
    $result=$con->query($q);
    $rf = mysqli_fetch_assoc($result);
?>

            <div class="container">
                
               
                  <br><br>
                  <div class="row">
                      <div class="col col-md-6 col-lg-6 col-6">
                          <form action="batch_change.php" method="post">
                    <div class="row mb-5">
                        <div class="col col-3 col-md-3 col-lg-3">
                            <input type="number" placeholder="No. of section" name="division" min="1" max="10" class="form-control">
                        </div>
                        <div class="col col-3 col-md-3 col-lg-3">
                            <button type="submit" class="btn btn-primary" name="set_div">SET</button>
                        </div>
                    </div>
                        
                    </form>
                      </div>
                      <div class="col col-md-4 col-lg-4 col-sm-12">
                          <form action="update_semester.php" method="post">
                    <div class="row">
                    <select class="custom-select col form-select  custom-select form-select-sm mr-2" style="width: 20%;" name="semester">
                        <option value="<?php echo $rf["semester"] ?>"><?php echo "SEM " . $rf["semester"] ?></option>
                        <option value="1">SEM 1</option>
                        <option value="2">SEM 2</option>
                        <option value="3">SEM 3</option>
                        <option value="4">SEM 4</option>
                        <option value="5">SEM 5</option>
                        <option value="6">SEM 6</option>
                        <option value="7">SEM 7</option>
                        <option value="8">SEM 8</option>
                      </select>
                      
                      <button class="btn btn-primary col pr-2" type="submit">Set</button>
                    </div>
                </form>
                      </div>
                  </div>
                    
                        <table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">Admission Number</th>
                                  <th scope="col">USN</th>
                                  <th scope="col">Name</th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                              foreach($result as $r)
                                { 
                                    
                                    
                                    ?>
                                    <form action="update_section.php" method="post">    
                                    <tr>
                                        
                                        <td><?php echo $r["adm_no"] ?></td>
                                        <?php if(empty($r["usn"])){ ?>

                                        <td>N/A</td>
                                        
                                        <?php }else{ ?>
                                            <td><?php echo $r["usn"] ?></td>
                                        
                                        <?php }
                                        if (empty($r["mname"])){?>
                                        <td><?php echo $r["fname"] . " " . $r["lname"] ?></td>
                                        <?php  }else{ ?>
                                            <td><?php echo $r["fname"] . " " . $r["mname"] . " " . $r["lname"] ?></td>
                                            <?php } ?>
                                        <td>
                                            
                                            <select name="section" class="custom-select form-select  custom-select form-select -sm">
                                                <option value="<?php echo $r["section"] ?>"><?php echo $r["section"] ?></option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="F">F</option>
                                            </select>
                                        </td>
                                        <td>
                                        <select name="semester" class="custom-select form-select  custom-select form-select -sm">
                                        <option value="<?php echo $r["semester"] ?>"><?php echo "SEM " . $r["semester"] ?></option>
                                        <option value="1">SEM 1</option>
                                        <option value="2">SEM 2</option>
                                        <option value="3">SEM 3</option>
                                        <option value="4">SEM 4</option>
                                        <option value="5">SEM 5</option>
                                        <option value="6">SEM 6</option>
                                        <option value="7">SEM 7</option>
                                        <option value="8">SEM 8</option>
                                    </select>
                                        </td>
                                        <td>
                                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                        </td>    
                                    </tr>
                                            <input type="text" value="<?php echo $r["adm_no"] ?>" name="adm_no" hidden>
                                    </form>
                                <?php } ?>
                                
                            </tbody>
                          </table>
                          
                    
                    
                
                  
            </div>
        </div>


        <!-- page content end -->
        <div>

        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script>
  $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
</script>
</body>
</html>