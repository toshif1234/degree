<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

$duty = $_GET['du'];
$si=$_GET['si'];
$_SESSION['si']=$si;
//echo "$duty";
?>
<h3 class="mb-4">Update Room Duty</h3>
<form action="updateems2.php" method="POST">
<div class="col-4 ">
    <select name="duty" id="duty" class="form-select">
        <option selected disabled>Select</option>
        <option selected="selected" value="Room Duty"<?php if($duty=="Room Duty") { echo "selected";}?>>Room Duty</option>
        <option value="Reserve"<?php if($duty=="Reserve") { echo "selected";}?>>Reserve</option>
        <option value="Relive"<?php if($duty=="Relive") { echo "selected";}?>>Relive</option>
    </select>
</div>

<input type="submit" class="btn btn-primary mt-4" value="Submit" name="sub">
</form>
<?php
include "../template/footer-fac.php";
?>