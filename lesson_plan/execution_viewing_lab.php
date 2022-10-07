<?php

include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
require_once "../config.php";
$flag_save = 0;
$flag_save = $_SESSION["flag_save"];
if ($flag_save == 0) {
    $sem = $_POST["sem"];
    $sub = $_POST["subid"];
    $sec = $_POST["sec"];
    $branch = $_POST['branch'];
    // echo $subid;
    $_SESSION["sem"] = $sem;
    $_SESSION["sec"] = $sec;
    $_SESSION["sub"] = $sub;
    $_SESSION['branch'] = $branch;
} else {
    $sem = $_SESSION["sem"];
    $sec = $_SESSION["sec"];
    $sub = $_SESSION["sub"];
    $branch = $_SESSION['branch'];
}
$q = "select * from lessonpanl where sem = \"" . $sem . "\" and subid = \"" . $sub . "\" and section = \"" . $sec . "\" and branch = \"" . $branch .  "\" order by length(module), module, sr_no ";
$result = $link->query($q);
// echo $q;
?>



<style>
    thead tr:nth-child(1) th {
        background: silver;
        position: sticky;
        top: 0;
        z-index: 10;
        text-align: center;
    }
</style>
<div class="wrapper">
    <!-- Sidebar  -->
    <!-- Page Content  -->
    <div id="content">
        <!-- page content start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col col-3 col-md-3 col-lg-3">
                    <label for="sem">Semester</label>
                    <h4 id="sem"><?php echo $sem ?></h4>
                </div>
                <div class="col col-3 col-md-3 col-lg-3">
                    <label for="sec">Section</label>
                    <h4 id="sec"><?php echo $sec ?></h4>
                </div>
                <div class="col col-3 col-md-3 col-lg-3">
                    <label for="sub">Subject</label>
                    <h4 id="sub"><?php echo $sub ?></h4>

                </div>
            </div>

            <!-- <a href="lesson_plan_download_process.php" target="_blank" class="btn btn-primary" style="float: right;">Download</a> -->

            <!-- Modal -->
            <div class="table-responsive" style="width:75vw; height:80vh;">
                <table style=" overflow:scroll; height:50vh; width:max-content;" class="table table-striped mt-5">
                    <thead>
                        <tr>
                            <th scope="col">Experiment no</th>
                            <th scope="col">Date of Planning</th>
                            <th scope="col">Experiment Name</th>
                            <th scope="col">Date of Execution</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="execution_update_lab.php" method="post">
                            <input type="submit" name="" id="" class="btn btn-primary" value="Save">
                            <?php
                            $i = 0;
                            foreach ($result as $r) {
                                $i++;
                            ?>
                                <tr>
                                    <td>Experiment No.: <?php echo $r['module'] ?></td>
                                    <th>
                                        <input class="form-control" type="date" name="dop_Plan" value="<?php echo $r['dop_Plan'] ?>" readonly>
                                    </th>
                                    <td>
                                        <textarea class="form-control" cols="50" rows="4" name="exp_name" readonly><?php echo $r['pending'] ?></textarea>
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="doe<?php echo $i ?>" value="<?php echo $r['dop_exe'] ?>">
                                    </td>
                                    <input type="text" name="sr<?php echo $i ?>" id="" value="<?php echo $r['sr_no'] ?>" hidden>
                                <?php } ?>
                                </tr>
                                <input type="text" name="count" id="" value="<?php echo $i ?>" hidden>
                        </form>
                    </tbody>
                </table>
            </div>
            <h2 class="m-3">CO's</h2>
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <?php
                        $q_c = 'select * from co where sub = "' . $sub . '"';
                        $r_c = $link->query($q_c);

                        ?>
                        <tr class="">
                            <th scope="col" style="text-align:center; width:7%;"> Co's </th>
                            <th scope="col" style="text-align:center;"> Descriptions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $li = explode("\n",$r['vtu_co']);
                        $q_c = 'select * from co where sub = "' . $sub . '"';
                        $r_c = $link->query($q_c);
                        $rt_c = mysqli_fetch_assoc($r_c);

                        ?>
                        <?php
                        $count = 1;
                        for ($i = 1; $i <= 6; $i++) {
                        ?>
                            <tr class="">
                                <th scope="row" style="text-align:center;width:20%;vertical-align: middle;">
                                    CO-<?php echo $i ?>
                                </th>
                                <td><?php echo $rt_c['co' . $i] ?></td>
                            </tr>
                        <?php $count++;
                        }
                        ?>
                    </tbody>
                </table>
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

    function delete_extra(id) {
        window.location.replace("extra_module_delete.php?sr_no=" + id.id);
    }
</script>
</body>

</html>