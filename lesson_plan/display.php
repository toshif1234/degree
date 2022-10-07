<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
require_once "../config.php";
// error_reporting(0);
$con = $link;
$sem = $_SESSION["sem"];
$subid = $_SESSION["subid"];
$sec = $_SESSION["sec"];
$branch = $_SESSION['branch'];
//   echo $sem;
// echo  $_SESSION["vtu"];
$q = "select module, dop_Plan, pending, textbook, co, bt_evel, vtu_textbook, vtu_co from lessonpanl where sem = \"" . $sem . "\" and subid = \"" . $subid . "\" and section = \"" . $sec . "\" and branch = \"" . $branch . "\" order by module, sr_no";
// echo $q;
$result = $con->query($q);
// $vtu = $_SESSION["vtu"];
// $arr1 = explode(".", $vtu);
?>
<!-- Page Content  -->
<div id="content">
    <div class="modal fade" id="clone" tabindex="-1" aria-labelledby="clone" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Clone to section</h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">


                    <form action="clone.php" method="post">
                        <?php
                        $q_sec = 'select distinct section from students where section <> "' . $_SESSION['sec'] . '"';
                        $result_sec = $link->query($q_sec);
                        ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <select class="form-select" id="exampleSelect1" name="sec">
                                        <option selected disabled>Select Section</option>
                                        <?php foreach ($result_sec as $r) {
                                        ?>
                                            <option value="<?php echo $r['section'] ?>"><?php echo $r['section'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <select name="branch" class="form-control">
                                    <option selected disabled>Select Branch </option>

                                    <?php
                                    $p1 = "select distinct branch from students";
                                    // echo $q1;
                                    $zp = $con->query($p1);
                                    foreach ($zp as $r) {


                                        echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";
                                    }  ?>
                                </select>

                            </div>
                            <div class="col-6" style="align-self:center;">
                                <button type="submit" class="btn-success btn"> Submit </button>
                            </div>
                        </div>
                    </form>



                </div>

                <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">delete</h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">


                    <form action="delete.php" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    Are sure do you want to delete this section
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12 m-3" style="align-self:center;">
                                <button type="submit" class="btn-danger btn"> Delete </button>
                            </div>
                        </div>
                    </form>



                </div>


            </div>
        </div>
    </div>
    <style>
        thead tr:nth-child(1) th {
            background: silver;
            position: sticky;
            top: 0;
            z-index: 10;
            text-align: center;
        }
    </style>
    <!-- page content start -->
    <div class="container-fluid">
        <form action="update.php" method="POST">
            <div class="row">
                <div class="col col-3 col-md-3 col-lg-3">
                    <label for="sem">Semester</label>
                    <h4 id="sem">
                        <?php echo $sem  ?>
                    </h4>
                </div>
                <div class="col col-3 col-md-3 col-lg-3">
                    <label for="sec">Section</label>
                    <h4 id="sec">
                        <?php echo $sec  ?>
                    </h4>
                </div>
                <div class="col col-4 col-md-4 col-lg-4">
                    <label for="sub">Subject</label>
                    <h4 id="sub">
                        <?php echo $subid ?>
                    </h4>

                </div>
                <div class="col-1">

                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#clone">
                        Clone
                    </button> -->
                </div>
                <div class="col-1">

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">
                        delete
                    </button>
                </div>
            </div>



            <div class="table-responsive" style="height:flex; overflow: scroll;">
                <table class="table table-striped  mt-5">
                    <thead>
                        <tr>
                            <th scope="col">Module</th>
                            <th scope="col">Date of Planning</th>
                            <th scope="col">Topics to cover</th>
                            <th scope="col">TextBook</th>
                            <th scope="col">CO</th>
                            <th scope="col">BT Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $con1 = 0;
                        $flag = "";
                        foreach ($result as $r) {
                            if ($r['pending'] != ' ') {
                                $con1++;
                        ?>
                                <tr>
                                    <?php
                                    if ($flag != $r['module']) {
                                        $flag = $r["module"];
                                    ?>

                                        <td>Module:
                                            <?php echo $r['module'] ?>
                                        </td>
                                    <?php
                                    } else {
                                    ?>
                                        <td></td>
                                    <?php
                                    }

                                    ?>
                                    <th>
                                        <?php
                                        ?>
                                        <input class="form-control " style="width: 300px;" type="date" name="dop_Plan<?php echo $con1 ?>" value="<?php echo $r['dop_Plan'] ?>">


                                    </th>
                                    <td><textarea class="form-control" name="topic<?php echo $con1 ?>" id="" cols="30" rows="3"><?php echo $r['pending'] ?></textarea></td>
                                    <td><textarea class="form-control" name="textbook<?php echo $con1 ?>" id="" cols="30" rows="3"><?php echo $r['textbook'] ?></textarea></td>
                                    <td><select class="form-control" name="co_select<?php echo $con1 ?>" aria-label="Default select example">
                                            <option value="<?php echo $r['co'] ?>">
                                                <?php echo $r['co'] ?>
                                            </option>
                                            <option class="form-control" value="CO1">CO1</option>
                                            <option class="form-control" value="CO2">CO2</option>
                                            <option class="form-control" value="CO3">CO3</option>
                                            <option class="form-control" value="CO4">CO4</option>
                                            <option class="form-control" value="co5">CO5</option>
                                            <option class="form-control" value="co6">CO6</option>


                                        </select>
                                    </td>
                                    <td><select class="form-control" name="lvl_select<?php echo $con1 ?>" aria-label="Default select example">
                                            <option value="<?php echo $r['bt_evel'] ?>">
                                                <?php echo $r['bt_evel'] ?>
                                            </option>
                                            <option class="form-control" value="L1">L1</option>
                                            <option class="form-control" value="L2">L2</option>
                                            <option class="form-control" value="L3">L3</option>
                                            <option class="form-control" value="L4">L4</option>
                                            <option class="form-control" value="L5">L5</option>
                                            <option class="form-control" value="L6">L6</option>

                                        </select>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
            <div style="width: 100%; ">
                <button class="btn btn-success mt-3">Save</button>
            </div>

            <?php

            $p = 'select * from lesson_plan_approval where sem="' . $sem . '" and sec="' . $sec . '" and sub="' . $subid . '" and branch ="' . $branch . '"';
            // echo $p;
            try {
                $pre = mysqli_num_rows($link->query($p));
            } catch (Exception $e) {
                $pre = 0;
            }
            if ($pre > 0) {
                $pre1 = mysqli_fetch_assoc($link->query($p));
                echo '<h4 class="m-3">Approval: ' . $pre1["status"] . '</h4>';
            }

            ?>

        </form>

        <!-- <div style="float:right"> -->
        <form action="hod_approve.php" method="post">
            <div class="row mt-4">

                <div class="col-4 col-md-4">

                    <div class="form-group">
                        <!-- <label for="hod_select">HOD :</label> -->
                        <select name="hod_select" id="hod_select" class="form-control">
                            <option selected disabled>Select HOD</option>
                            <?php $hh1 = $link->query("select * from hod");
                            foreach ($hh1 as $h11) {
                            ?>
                                <option value="<?php echo $h11["name"] ?>"><?php echo $h11["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4 col-md-4">

                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Send</button>
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <input type="text" name="sem" value="<?php echo $sem ?>" hidden>
                    <input type="text" name="sec" value="<?php echo $sec ?>" hidden>
                    <input type="text" name="sub" value="<?php echo $subid ?>" hidden>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-5">
        <form action="co_update.php" method="POST">
            <input type="text" name="sub" id="" hidden value="<?php echo $subid ?>">
            <h2 class="m-3">CO's</h2>
            <div class="row">

                <?php
                // $li = explode("\n",$r['vtu_co']);
                $q_c = 'select * from co where sub = "' . $subid . '"';
                $r_c = $con->query($q_c);
                $rt_c = mysqli_fetch_assoc($r_c);

                ?>

                <table class="table table-striped">
                    <thead>
                        <tr class="">
                            <th scope="col" style="text-align:center; width:7%;"> Co's </th>
                            <th scope="col" style="text-align:center;"> Descriptions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        for ($i = 1; $i <= 6; $i++) {
                        ?>
                            <tr class="">
                                <th scope="row" style="text-align:center;width:20%;vertical-align: middle;">
                                    CO-
                                    <?php echo $i ?>
                                </th>
                                <td><input type="text" class="form-control" name="co<?php echo $i ?>" id="" value="<?php echo $rt_c['co' . $i] ?>"></td>
                            </tr>
                        <?php $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div style="width: 100%; ">
                <button class="btn btn-success mt-3">Save</button>
            </div>
        </form>
    </div>
    <form action="textbook_update.php" method="POST">
        <input type="text" name="sub" id="" hidden value="<?php echo $subid ?>">
        <h2 class="m-3">Textbooks</h2>
        <div class="row">
            <?php
            // $textBooks = explode("\n",$r['vtu_textbook']);
            ?>
            <table class="table table-striped">
                <thead>
                    <tr class="">
                        <th scope="col" style="text-align:center"> Textbooks's </th>
                        <th scope="col"> Descriptions </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    for ($i = 1; $i <= 6; $i++) {
                    ?>
                        <tr class="">
                            <th scope="row" style="text-align:center">Textbook -
                                <?php echo $i ?>
                            </th>
                            <td><input type="text" class="form-control" name="t<?php echo $i ?>" id="" value="<?php echo $rt_c['t' . $i] ?>"></td>
                        </tr>
                    <?php $count++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div style="width: 100%; ">
            <button class="btn btn-success mt-3">Save</button>
        </div>
    </form>

</div>
<?php

$_SESSION["con1"] = $con1;
?>
<!-- page content end -->
</div>
</div>
<div>
    <?php include "../template/scroll.php"; ?>
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