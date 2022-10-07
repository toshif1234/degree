<?php

use WindowsAzure\ServiceManagement\Models\Location;

require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);
// $q = "select distinct date,session from exam_schedule_details";
// $res = $link->query($q);

//echo $session1=$_GET['ses'];
$count=$_GET['count'];
$si=$_GET['si'];
// $si=$_SESSION['si'];

?>
 <?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $count= $_POST["count"];
    $si=$_POST['si_no'];
    $q4="update exam_faculty_count set count=$count where si_no='$si'";
    $res=$link->query(($q4));
    if($res)
    {
        $_SESSION['updatecount']="Successfully Updated";
    }
    ?>
        <script>
            window.location.href = 'facultycount3.php';
        </script>
    <?php
  }
 ?>

<script>
    function myfun(){
   
        var b=document.getElementById("count").value;
        if(b>=100)
        {
            document.getElementById("message1").innerHTML="  **Please Enter Less than 100 Faculty";
            return false;
        }
    }   
</script>
<?php
if($_SESSION['delroom'])
{

?>
<div class="alert alert-dismissible alert-success custom-success-alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Hey!</strong> <?php echo $_SESSION['delroom'] ?>
</div>
<?php
unset($_SESSION['delroom']);
}
?>
<h4>Update Faculty Count</h4>
<br>

<br> <br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return myfun()">
    

    <div class="col-3">
        <div class="form-group ">
            <div>
                <label for="count">Faculty Count</label>
                <input type="text" name="count" id="count" class="form-control" value="<?php echo $count?>" required>
                <span id="message1" style="color: red;"></span>
            </div>
        </div>
    </div>
    <input type="text" name="si_no" value="<?php echo $si?>"     hidden>
    <br>
    <input type="submit" name="sub" class="btn btn-info">
</form>


<?php
include "../template/footer-fac.php";
?>

