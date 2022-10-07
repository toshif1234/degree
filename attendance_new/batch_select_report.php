<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");

$q = 'select distinct lab_batch from students where semester = "' . $_SESSION['sem'] . '" and section = "' . $_SESSION['sec'] . '" and branch = "' . $_SESSION['branch'] . '"';
$result = $link->query($q);

?>

<form action="redirect_download.php" method="post">
    <div class="row">
        <div class="col col-md-4 col-lg-4 col-4">
            <label for="lab">Lab Batch</label>
            <select name="lab_batch" id="lab" class="form-control">
                <option value="" selected disabled>Select Lab Batch</option>
                <?php foreach ($result as $r) { ?>
                    <option value="<?php echo $r['lab_batch'] ?>"><?php echo $r['lab_batch'] ?></option>
                <? } ?>
            </select>
        </div>
        <div class="col col-md-4 col-lg-4 col-4">
            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </div>
        <div class="col col-md-4 col-lg-4 col-4">

        </div>
    </div>


</form>


<?php
include "../template/footer-fac.php";
