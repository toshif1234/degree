<?php
require_once "../config.php";
include("../template/admin-auth.php");
error_reporting(0);

include("../template/sidebar-admin.php");

?>
<?php

if (isset($_SESSION["popup"]) && $_SESSION["popup"] == 1) {
    $_SESSION["popup"] = 0;
    echo '<div style="width:50%;" class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Sucessful</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
} else if (isset($_SESSION["popup"]) && $_SESSION["popup"] == 2) {
    $_SESSION["popup"] = 0;
    echo '<div style="width:50%;" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>failed</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
}

?>
<?php $q = "select distinct branch from students";
$result = $link->query($q);
$q1 = "select distinct semester from students";
$result1 = $link->query($q1);
?>
<div class="container">
    <form action="../add_sub_proc.php" method="POST">
        <div class="row" style="align-items: center;
    justify-content: center;
    align-content: center;
    flex-direction: row;">
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <label for="Branch">Branch:</label>
                    <select name="branch" id="" class="form-control">

                        <option id="Branch" selected>Branch</option>
                        <?php
                        foreach ($result as $r) {
                        ?>
                            <option value="<?php echo $r["branch"]  ?>"><?php echo $r["branch"]  ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <label for="Semester">Semester:</label>

                    <select name="semester" id="" class="form-control">
                        <option selected id="Semester">Semester </option>
                        <?php
                        foreach ($result1 as $r1) {
                        ?>
                            <option value="<?php echo $r1["semester"]  ?>"><?php echo $r1["semester"]  ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col">

                <!-- <div class="form-group"> -->
                <div style="display: flex;" class="p-0 m-0">
                    <label for="elective"> Elective : </label>
                    <input id="elective" type="checkbox" name="elective" style="width: 20px; height: 20px;">
                </div>
                <!-- </div> -->
            </div>
            <div class="col">

                <!-- <div class="form-group"> -->
                <div style="display: flex;" class="p-0 m-0">
                    <label for="elective"> Lab : </label>
                    <input id="elective" type="checkbox" name="lab" style="width: 20px; height: 20px;">
                </div>
                <!-- </div> -->
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div>
                        <label for="sub_name">Subject Name:</label>
                        <input type="text" name="sub_name" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div>
                        <label for="sub_code">Subject Code:</label>
                        <input type="text" name="sub_code" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <button class="btn btn-info" type="submit">ADD</button>
            </div>
    </form>
</div>

</div>


</div>
<!-- page content end -->
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>

</html>