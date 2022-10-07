<?php include("../template/admin-auth.php");
    include("../template/sidebar-admin.php");

    $q1 = "select distinct branch from students";
                    // echo $q1;
     $result = $link->query($q1);
     ?>
     <div class="container">
    <form action="view_books.php" method="post">
    <div class="row mb-4">
    <div class="col-sm-12 col-md-4">
        <label for="sub">Branch</label>
            <select name="branch" class="form-control" required >
                <option selected disabled>Select Branch </option>

                <?php
                    
                    foreach($result as $r){

               
                echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";

                 }  ?>
              </select>
        </div>
        </div>
        <div class="container">
            <div class="col-11">
            </div>
            <div class="col-1">
            <button class="btn btn-primary mt-4" type="submit">Submit</button>
            </div>
        </div>
        </form>
        </div>
        <?php 
include("../template/footer-admin.php");
?>