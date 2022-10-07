<?php
// session_start();
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$q1 = "select distinct branch from students";
                    // echo $q1;
$result = $link->query($q1);
$q2 = "select distinct semester from students";
$q3 = "select distinct section from students";
$result1 = $link->query($q2);
$result2 = $link->query($q3);
$faculty_name = $_SESSION["username"];

$_SESSION['prev'] = 0;
$_SESSION["temp"] = 0;?>

                <form action="nodue.php" method="post">
                    <div id="dateWarning" style="display: none;" class="alert alert-warning">
                        <button type="button" class="btn-close" onclick="dateWarningClose()"></button>
                        <h4 class="alert-heading">Warning!</h4>
                        <p class="mb-0" style="color: white;">
                            atendence of <span id="sd" style="color: rgb(230, 73, 73);"></span> cannot be assigned today, <span id="td" style="color: rgb(175, 241, 136);"></span> selected instead 
                        </p>
                      </div>
                    <div class="container mb-5">
                        <div class="row">

                        <div class="col">
        <label for="sub">Semester</label>
            <select name="sem" class="form-control" required>
                <option selected value="" disabled> Semester </option>
                <?php
                    
                    foreach($result1 as $r){

                
                echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";

                 }  ?>
              </select>
        </div>
        <div class="col">
        <label for="sub">Section</label>
            <select name="sec" class="form-control" required>
                <option  selected value="" disabled> Section </option>
                <?php
                    
                    foreach($result2 as $r){

               
                echo "<option value=\"" . $r["section"] . "\"> " . $r["section"] . "</option>";

                 }  ?>
              </select>
        </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="Subject"> Subject </label>
                                    <select name="sub" class="form-control" id="Subject" required>
                                     <!-- <?php 
                                    $qt = "select a.sub_name, a.sub_code, a.lab from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                                    $resultst = $link->query($qt);
                                    echo $qt;
                                    foreach($resultst as $r){
                                                   if($r['lab'] != 1){                      
                                    ?>
                                 <option class="form-control" value="<?php echo $r["sub_code"] . " - " . $r["sub_name"] ?>"><?php echo $r["sub_code"] . " - " . $r["sub_name"] ?></option>
                            <?php  } } ?>  -->


                             <?php
                             
                               $qt = "select * from faculty_mapping  where faculty_name = \"" . $_SESSION["username"] . "\" ";
                               $resultst = $link->query($qt);         
                               foreach($resultst as $r){
                             ?>                      
                                <option class="form-control" value="<?php echo  $r["sub_name"] ?>"><?php echo  $r["sub_name"] ?></option>
                                <?php         
                               }
                                ?> 

                                



                            </select>
                                </div>
                            </div>
                            <div class="col">
        <label for="sub">Branch</label>
            <select name="branch" class="form-control" required>
                <option selected value="" disabled> Branch </option>

                <?php
                    
                    foreach($result as $r){

               
                echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";

                 }  ?>
              </select>
        </div>
                           
                            <div class="col">
                                <div class="form-group">
                                    <!-- <label for="Date"> </label> -->
                                    <input type="Submit" value="Load" name="Filter" class="form-control btn btn-primary"
                                        id="Filter">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- page content end -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>
