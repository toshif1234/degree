<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$si=$_GET['si'];
$_SESSION['si']=$si;  //session gen
$sem=$_GET['se'];
$br=$_GET['br'];
$su=$_GET['su']; //subject
$_SESSION['su']=$su;
$us=$_GET['us'];
$_SESSION['us']=$us; //session gen
$ps=$_GET['ps'];
$_SESSION['ps']=$ps;

$q1 = "select distinct semester from students";
//$q3 = "select distinct section from students";
$result = $link->query($q1);
$q2 = "select distinct branch from students";
$result2 = $link->query($q2);
?>
<script>
    function myfun1()
    {
        var a=document.getElementById("semester").value;
        if(a=="semester")
        {
            document.getElementById("message1").innerHTML="  **Please Select Valid Semester";
            return false;
        }
        var b=document.getElementById('branch').value;
        if(b=="br"){
            document.getElementById("message2").innerHTML="  **Please Select Valid Branch";
            return false;
        }
    }
    </script>
<h3>Update Subject Details</h3>

<div class="container">
    <div class="row">

        <form action="updatesub1.php" method="POST" onsubmit="return myfun1()">
            <!-- <form action="../External_seat_allotment/addsub3.php" method="POST">  -->
            
            <div class="col-3">
                <label for="sub">Semester</label>
                <select name="semester" class="form-control" id="semester">
                    <option value="semester"> Semester </option>
                    <?php

                    foreach ($result as $r) {


                        //echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . " </option>";
                        
                        ?> 
                        <option value="<?php echo $r["semester"]?>"<?php if($sem==$r["semester"]) { echo "selected";} ?>><?php echo $r["semester"]?></option>?>
                        <?php } ?>
                        
                </select>
                <span id="message1" style="color: red;"></span>
            </div>

            <div class="col-3">
                <label for="branch">Branch</label>
                <select name="branch" class="form-control" id="branch" value="<?php echo $br?>">
                    <option value="br"> Branch </option>

                    <?php

                    foreach ($result2 as $r) {


                        //echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";
                        ?> 
                        <option value="<?php echo $r["branch"]?>"<?php if($br==$r["branch"]) { echo "selected";} ?>><?php echo $r["branch"]?></option>?>
                        <?php
                            }  ?>
                </select>
                <span id="message2" style="color: red;"></span>
            </div>

            <div class="form-group col-2">
                <br>
                <input type="Submit" value="Load" name="Filter" class="form-control btn btn-primary" id="Filter">
            </div>
        </form>
    </div>
    <?php
include "../template/footer-fac.php";
?>