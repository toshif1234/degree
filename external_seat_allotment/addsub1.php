<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

$q1 = "select distinct semester from students";
//$q3 = "select distinct section from students";
$result = $link->query($q1);
$q2 = "select distinct branch from students";
$result2 = $link->query($q2);
?>
 
    <h3>Add Subject Details</h3>

<script>
    function myfun1()
    {
        var a=document.getElementById("semester").value;
        if(a=="sem")
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
<div class="container">
    <div class="row">

        <form action="addsub2.php" method="POST" onsubmit="return myfun1()">
            <!-- <form action="../External_seat_allotment/addsub3.php" method="POST">  -->
            
                <div class="col-3">
                    <label for="sub">Semester</label>
                    <select name="semester" class="form-control" id="semester">
                        <option value="sem"> Semester </option>
                        <?php

                        foreach ($result as $r) {


                            echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";
                        }  ?>
                    </select>
                    <span id="message1" style="color: red;"></span>
                </div>

                <div class="col-3">
                    <label for="sub">Branch</label>
                    <select name="branch" class="form-control" id="branch">
                        <option value="br"> Branch </option>

                        <?php

                        foreach ($result2 as $r) {


                            echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";
                        }  ?>
                    </select>
                    <span id="message2" style="color: red;"></span>
                </div>

                <div class="form-group col-2 mt-3">
                    <!-- <label for="Date"> </label> -->
                    <input type="Submit" value="Load" name="Filter" class="form-control btn btn-primary" id="Filter">
                </div>
        </form>
    </div>

    <?php
include "../template/footer-fac.php";
?>