<?php

require_once "../config.php";
//session_start();
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$branch=$_POST["branch"];
//$date=$_POST["date"];
$sem=$_POST["semester"];
$ps=$_SESSION['ps']; //primary key used for update
$us=$_SESSION['us'];
$sub=$_SESSION['su'];
$q1 = "SELECT sub_code,sub_name FROM `subjects_new` WHERE branch='$branch' and sem = '$sem'";
// echo $q1;
$result = $link->query($q1);

?>
<script>
    function myfun1()
    {
        var a=document.getElementById("subject").value;
        if(a=="sub")
        {
            document.getElementById("message1").innerHTML="  **Please Select Valid Subject";
            return false;
        }
        
    }
    </script>

<form action="updatesub2.php" method="POST" onsubmit="return myfun1()">
<h3>Update Subject Details</h3>
<div class="container">
<div class="row">
    
       
    <?php
    $branch=$_POST["branch"];
    $_SESSION['branch'] = $branch;
    //$date=$_POST["date"];
    $sem=$_POST["semester"] ;
    $_SESSION['semester'] = $sem;
    ?>
<div class="row ">
    <div class="col-sm-12 col-md-3">
    <select name="subject" id="subject" class="form-select">
    <option value="sub">Select Subject</option>
    <?php
    foreach($result as $r){
    
    ?>
    
    <option value="<?php echo $r['sub_code'].'-'.$r['sub_name'] ?>"<?php if($sub==($r['sub_code'].'-'.$r['sub_name'])) {echo "selected";}?>><?php echo $r['sub_code'].'-'.$r['sub_name'] ?></option>
    <?php
    }?>
    </select>
    <span id="message1" style="color: red;"></span>
    </div>
</div>

<div class="col-sm-12 col-md-3">
                <div class="form-group ">
                    <div >
                        <label for="sub_name1">Common Subject Subcode:</label>
                        <input type="text" name="sub_name1" class="form-control" value="<?php echo $us?>" required>
                    </div>
                </div>
</div>
<div class="col-sm-12 col-md-3">
                <div class="form-group ">
                    <div >
                        <label for="sub_name2">Subject Code:</label>
                        <input  type="text" name="sub_name2" class="form-control" value="<?php echo $ps?>" required>
                    </div>
                </div>
</div>
<div class="col-sm-12 col-md-3">
    <br>
                        <button class="btn btn-info" type="submit">Update</button>
            </div>
        </div>
        <?php
include "../template/footer-fac.php";
?>
