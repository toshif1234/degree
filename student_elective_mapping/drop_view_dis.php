<?php require_once "config.php";

error_reporting(0);


$q1 = 'select * from dept_pso';
$q2 = 'select distinct semester from students order by semester';
$q3 = 'select distinct section from students order by section';
// echo $q2;
$result2 = $con->query($q2);
$result1 = $con->query($q1);
$result3 = $con->query($q3);

//session_start();
include("../template/admin-auth.php");

include("../template/sidebar-admin.php");
$_SESSION["view_flag"] = 0;
?>
<!-- <?php
        //require_once "../config.php";

        ?> -->
<div class="container">
    <!-- <div class="row"> -->
    <form action="show_students_dis.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <select class="form-control" id="exampleFormControlSelect1" name="dept">
                        <option selected disabled>Course</option>
                        <?php foreach ($result1 as $r) { ?>
                            <option value="<?php echo $r['dept_name'] ?>"><?php echo $r['dept_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 mb-4">

                    <select class="form-control" id="exampleFormControlSelect1" name="sem">
                        <option selected disabled>Semester</option>
                        <?php foreach ($result2 as $r) { ?>
                            <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="col-md-3 mb-4">

                    <select class="form-control" id="exampleFormControlSelect1" name="sec">
                        <option selected disabled>Section</option>
                        <?php foreach ($result3 as $r) { ?>
                            <option value="<?php echo $r['section'] ?>"><?php echo $r['section'] ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div class="col-md-3 mb-4">

                    <button class="btn btn-primary btn-md" type="submit">SUBMIT</button>
                </div>
            </div>
        </div>
    </form>
    <!-- </div> -->

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