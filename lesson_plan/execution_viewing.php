<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
require_once "../config.php";
error_reporting(0);

$con = $link;
// session_start();
$flag_save = 0;
// $_SESSION["flag_save"]=$flag_save;
$flag_save = $_SESSION["flag_save"];
if ($flag_save == 0) {
    $sem = $_POST["sem"];
    $subid = $_POST["subid"];
    $sec = $_POST["sec"];
    $branch = $_POST['branch'];
    // echo $subid;
    $_SESSION["sem1"] = $sem;
    $_SESSION["sec1"] = $sec;
    $_SESSION["subid1"] = $subid;
    $_SESSION['branch'] = $branch;
} else {
    $sem = $_SESSION["sem1"];
    $sec = $_SESSION["sec1"];
    $subid = $_SESSION["subid1"];
    $branch = $_SESSION['branch'];
}
//   echo $subid;
//   echo $sem;
$c = explode("-", $subid);
$a = $c[0];

$z = preg_split("/[A-Za-z]*/", $a);
// echo $z[4];

$m = $z[4];
// echo gettype($m);
if ($m == $sem) {
    // echo  $_SESSION["vtu"];
    $q = "select sr_no,module, dop_Plan, pending, textbook, co, bt_evel, vtu_textbook, vtu_co, dop_exe, complet from lessonpanl where sem = \"" . $sem . "\" and subid = \"" . $subid . "\" and section = \"" . $sec . "\" and branch = \"" . $branch .  "\" order by module, sr_no ";
    $result = $con->query($q);
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
                        <h4 id="sub"><?php echo $subid ?></h4>

                    </div>
                </div>
                <button type="button" class="btn btn-info mt-5" data-toggle="modal" data-target="#staticBackdrop" style="border-radius: 50% ">
                    <i class="fas fa-plus"></i>
                </button>

                <a href="lesson_plan_download_process.php" target="_blank" class="btn btn-primary" style="float: right;">Download</a>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="min-height: 50vh;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="extra_class.php" method="post">

                                    <input type="text" name="sem" value="<?php echo $sem ?>" hidden>
                                    <input type="text" name="sec" value="<?php echo $sec ?>" hidden>
                                    <input type="text" name="subid" value="<?php echo $subid ?>" hidden>

                                    <label for="module">Module No.:</label>
                                    <input type="text" class="form-control" placeholder="Module" name="module" id="module">

                                    <label for="doe">Date of Execution</label>
                                    <input type="date" id="doe" name="doe" class="form-control">

                                    <label for="completed">Topic covered</label>
                                    <input type="text" id="completed" name="completed" class="form-control">

                                    <label for="txt">Textbook</label>
                                    <input type="text" id="txt" name="txt" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info">SAVE</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="width:75vw; height:80vh;">
                    <table style=" overflow:scroll; height:50vh; width:max-content;" class="table table-striped mt-5">
                        <thead>
                            <tr>
                                <th scope="col">Module</th>
                                <th scope="col">Date of Planning</th>
                                <th scope="col">Topic's to cover</th>
                                <th scope="col">TextBook</th>
                                <th scope="col">CO</th>
                                <th scope="col">BT Level</th>
                                <th scope="col">Date of Execution</th>
                                <th scope="col">Topic's covered</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $con1 = 0;
                            $flag = "";
                            foreach ($result as $r) {
                                $con1++;
                            ?>
                                <tr>
                                    <form action="execution_update.php" method="post">
                                        <?php
                                        if ($flag != $r['module']) {
                                            $flag = $r["module"];
                                        ?>

                                            <td>Module: <?php echo $r['module'] ?></td>
                                        <?php
                                        } else {
                                        ?><td></td><?php
                                                }

                                                    ?>

                                        <th><input class="form-control" type="date" name="dop_Plan<?php echo $con1 ?>" value="<?php echo $r['dop_Plan'] ?>" readonly></th>

                                        <td><textarea class="form-control" cols="60" rows="3" name="topic<?php echo $con1 ?>" readonly><?php echo $r['pending'] ?></textarea></td>
                                        <td><textarea class="form-control" cols="11" rows="3" name="textbook<?php echo $con1 ?>" readonly><?php echo $r['textbook'] ?></textarea></td>

                                        <td><select class="form-control" aria-label="Default select example">
                                                <option class="form-control" value="<?php echo $r['co'] ?>">
                                                    <?php echo $r['co'] ?></option>
                                                <option class="form-control" value="co1">CO1</option>
                                                <option class="form-control" value="co2">CO2</option>
                                                <option class="form-control" value="co3">CO3</option>
                                                <option class="form-control" value="co4">CO4</option>
                                                <option class="form-control" value="co5">CO5</option>
                                                <option class="form-control" value="co6">CO6</option>
                                            </select>
                                        </td>
                                        <td><select class="form-control" aria-label="Default select example">
                                                <option class="form-control" value="<?php echo $r['bt_evel'] ?>">
                                                    <?php echo $r['bt_evel'] ?></option>
                                                <option class="form-control" value="L1">L1</option>
                                                <option class="form-control" value="L1">L2</option>
                                                <option class="form-control" value="L1">L3</option>
                                                <option class="form-control" value="L1">L4</option>
                                                <option class="form-control" value="L1">L5</option>
                                                <option class="form-control" value="L1">L6</option>
                                            </select>
                                        </td>
                                        <?php

                                        ?>
                                        <td><input type="date" class="form-control" name="doe" value="<?php echo $r['dop_exe'] ?>"></td>
                                        <td><input list="comp<?php echo $con1 ?>" class="form-control" id="comp_in" name="compin" value="<?php echo $r['complet'] ?>">
                                            <datalist id="comp<?php echo $con1 ?>">
                                                <option value="<?php echo $r['pending'] ?>"></option>
                                            </datalist>
                                        </td>
                                        <input name="sr_num" value="<?php echo $r["sr_no"] ?>" hidden>
                                        <input name="con2" value="<?php echo $con1 ?>" hidden>

                                        <td> <button type="submit" class="btn btn-success m-5">Save</button>
                                            <?php if ($r['pending'] == ' ') { ?>
                                                <button type="button" id="<?php echo $r['sr_no'] ?>" class="btn btn-danger" onclick="delete_extra(this)">Delete</button>
                                            <?php } ?>
                                        </td>
                                </tr>
                                </form>
                            <?php
                                if (isset($_SESSION["flag"])) {
                                    $flag222 = $_SESSION["flag"];
                                    if ($flag222 == 1) {
                                        echo '<script type="text/javascript">toastr.success(\'Contents Saved\')</script>';
                                    }
                                }
                            } ?>
                        </tbody>

                    </table>
                </div>
                <h2 class="m-3">CO's</h2>
                <div class="row">

                    <?php
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
                                $s = $rt_c['co' . $i];

                                if ($s != '0') { ?>
                                    <tr class="">

                                        <th scope="row" style="text-align:center;width:20%;vertical-align: middle;">CO-<?php echo $i ?></th>
                                        <td><?php echo $rt_c['co' . $i] ?></td>

                                    </tr>
                            <?php }
                                $count++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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
                                $s = $rt_c['t' . $i];

                                if ($s != '0') { ?>

                                    <tr class="">
                                        <th scope="row" style="text-align:center">Textbook -<?php echo $i ?></th>
                                        <td><?php echo $rt_c['t' . $i] ?></td>
                                    </tr>
                            <?php }
                                $count++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
    } else {


        // header("Location: lesson_plan.php");
        $_SESSION['check_error'] = 1;
        echo '<script>window.location.replace("lesson_plan.php");</script>';
    }
        ?>
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