<?php require_once "config.php";
$q = "select distinct batch from students";
$q2 = "select distinct branch from students";
$result = $con->query($q);
error_reporting(0);
$result2 = $con->query($q2);
//session_start();
include("../template/fac-auth.php");

include("../template/sidebar-fac.php");
$_SESSION["view_flag"] = 0;
?>
<!-- <?php
        //require_once "../config.php";

        ?> -->
<div class="container">
    <div class="row mb-4">
        <div class="col-md-4 mb-4">
            <form action="batch_creation.php" method="post">
                <select class="form-control" name="branch">
                    <option selected>Branch </option>
                    <?php
                    foreach ($result2 as $r) {
                    ?>
                        <option value="<?php echo $r["branch"]  ?>"><?php echo $r["branch"]  ?></option>
                    <?php } ?>
                </select>
        </div>
        <div class="col-md-4 mb-4">
            <select class="form-control" name="batch">
                <option selected>Batch</option>
                <?php
                foreach ($result as $r) {
                ?>
                    <option value="<?php echo $r["batch"]  ?>"><?php echo $r["batch"]  ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
        </form>
    </div>

</div>
</div>


<!-- page content end -->
<div>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>

</html>