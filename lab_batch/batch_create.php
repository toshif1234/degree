<?php include("../template/admin-auth.php") ?>
<?php include("../template/sidebar-admin.php")?>

<?php require_once("../config.php") ?>
<?php
error_reporting(0);

    if(isset($_POST["branch"])){
    $branch = $_POST["branch"];
    $batch = $_POST["batch"];
    $sec = $_POST["sec"];
    }else
    {
        $branch = $_SESSION["branch"];
        $batch = $_SESSION["batch"];
        $sec = $_SESSION["sec"];
    }
    $q1 = 'select * from students where batch = "'. $batch .'" and branch = "' . $branch . '" and section = "' . $sec . '" order by usn';
    // echo $q1;
    $result=$link->query($q1);
    // print_r($result);


?>
<div class="container">
<a href="lab_batch.php" class="btn btn-info" style="float: right;">Back</a>
    <form action="divide_batch.php" method="post">
    <div class="row">
    
        <div class="col col-3 col-md-3 col-lg-3">
            <label for="division">No of Batch</label>
            <input type="text" name="no_of_div" id="division" class="form-control mb-4" placeholder="No of Batch">
            
        </div>
        <div class="col col-4 col-md-4 col-lg-4">
            
            <button class="btn btn-primary mt-4"  type="submit">Set</button>
        </div>
    </div>
    <input type="text" value="<?php echo $branch ?>" name="branch" hidden>
                                            <input type="text" value="<?php echo $batch ?>" name="batch" hidden>
                                            <input type="text" value="<?php echo $sec ?>" name="sec" hidden>
    </form>
<table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">Admission Number</th>
                                  <th scope="col">USN</th>
                                  <th scope="col">Name</th>
                                 <th scope="col">Section</th>
                                 <th scope="col">Lab Batch</th>
                                 <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php
                              foreach($result as $r)
                                { 
                                    
                                    $_SESSION["view_flag"] = 1;
                                    ?>
                                    <form action="update_lab.php" method="post">    
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
                                        <?php echo $r["section"] ?>
                                           
                                        </td>
                                        <td>
                                        <select name="lab_batch" class="custom-select custom-select-sm">
                                        <option selected disabled value="<?php echo $r["lab_batch"] ?>"><?php echo " " . $r["lab_batch"] ?></option>
                                        <option value="batch 1">Batch 1</option>
                                        <option value="batch 2">Batch 2</option>
                                        <option value="batch 3">Batch 3</option>
                                        <option value="batch 4">Batch 4</option>
                                        
                                    </select>
                                        </td>
                                        <td>
                                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                        </td>    
                                    </tr>
                                            <input type="text" value="<?php echo $r["adm_no"] ?>" name="adm_no" hidden>
                                            <input type="text" value="<?php echo $branch ?>" name="branch" hidden>
                                            <input type="text" value="<?php echo $batch ?>" name="batch" hidden>
                                            <input type="text" value="<?php echo $sec ?>" name="sec" hidden>
                                    </form>
                                <?php } ?>
                                
                            </tbody>
                          </table>




                              </div>
<?php include("../template/footer-admin.php")?>