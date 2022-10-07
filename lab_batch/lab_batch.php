<?php include("../template/sidebar-admin.php");
error_reporting(0);
require_once "../config.php";
$q = "select distinct batch from students";
$q2 = "select distinct branch from students";
$q3 = "select distinct section from students order by section";
$result = $link->query($q);
$result2 = $link->query($q2);
$result3 = $link->query($q3);
?>
<div class="container">
    <form action="batch_create.php" method="POST">

        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="branch">Branch:</label>
                <select class="form-control " name="branch">
                    <option selected disabled>Branch </option>
                    <?php
                    foreach ($result2 as $r) {
                    ?>
                        <option value="<?php echo $r["branch"]  ?>"><?php echo $r["branch"]  ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="batch">Batch:</label>
                <select class="form-control " name="batch">
                    <option selected disabled>Batch</option>
                    <?php
                    foreach ($result as $r) {
                    ?>
                        <option value="<?php echo $r["batch"]  ?>"><?php echo $r["batch"]  ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="sec">Section:</label>
                <select class="form-control " name="sec">
                    <option selected disabled>Section</option>
                    <?php
                    foreach ($result3 as $r) {
                    ?>
                        <option value="<?php echo $r["section"]  ?>"><?php echo $r["section"]  ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="btn"></label> <br>
                <button type="submit" id="btn" class="btn btn-info mt-2">Load</button>
            </div>

        </div>


    </form>
</div>
<?php include("../template/footer-admin.php") ?>