<?php
// session_start();
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");

$q = 'select distinct lab_batch from students where semester = "' . $_SESSION['sem'] . '" and section = "' . $_SESSION['sec'] . '" and branch = "' . $_SESSION['branch'] . '"';
$result = $link->query($q);

?>

<form action="Add_Attendence.php" method="post">
    <div class="row">
        <div class="col col-md-4 col-lg-4 col-4">
            <select name="lab_batch" id="" class="form-control">
                <option value="" selected disabled>Lab Batch</option>
                <?php foreach ($result as $r) { ?>
                    <option value="<?php echo $r['lab_batch'] ?>"><?php echo $r['lab_batch'] ?></option>
                <? } ?>
            </select>
        </div>
        <div class="col col-md-4 col-lg-4 col-4">

        </div>
        <div class="col col-md-4 col-lg-4 col-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>


</form>


<?php
include "../template/footer-fac.php";
