<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
// error_reporting(0);
require_once "../config.php";

$noe = $_SESSION['noe'];
$sub = $_SESSION["sub"];
$branch = $_SESSION["branch"];
$sec = $_SESSION["sec"];
$sem = $_SESSION["sem"];

$q = "select * from lessonpanl where sem = \"" . $sem . "\" and subid = \"" . $sub . "\" and section = \"" . $sec . "\" and branch = \"" . $branch . "\" order by module";
$result = $link->query($q);

// echo $q;
?>
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


                    <form action="clone_lab.php" method="post">

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <select class="form-select" id="exampleSelect1" name="sec">
                                        <?php
                                        $q_sec = 'select distinct section from students where section <> "' . $sec . '"';
                                        $result_sec = $link->query($q_sec);
                                        ?>
                                        <option selected disabled>Select Section</option>
                                        <?php foreach($result_sec as $r){ ?>
                                        <option value="<?php echo $r['section'] ?>">
                                            <?php echo $r['section'] ?>
                                        </option>
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
                                    $zp = $link->query($p1);
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


            </div>
        </div>
    </div>
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">


                    <form action="delete_lab.php" method="post">
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

        td,
        th {
            text-align: center;
        }
    </style>
    <!-- page content start -->
    <div class="container-fluid">
        <form action="update_lab.php" method="POST">
            <div class="row">
                <div class="col col-3 col-md-3 col-lg-3">
                    <label for="sem">Semester</label>
                    <h4 id="sem">
                        <?php echo $sem ?>
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
                        <?php echo $sub ?>
                    </h4>

                </div>
                <div class="col-1">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#clone">
                        Clone
                    </button>
                </div>
                <div class="col-1">

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">
                        delete
                    </button>
                </div>
            </div>



            <div class="table-responsive" style="height: 70vh; overflow: scroll;">
                <table class="table table-striped  mt-5">
                    <thead>
                        <tr>
                            <th scope="col">Experiment no</th>
                            <th scope="col">Date of Planning</th>
                            <th scope="col">Experiment Name</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <?php
                    $i = 0;
                    foreach ($result as $r) {
                        $i++;
                    ?>
                        <tr>
                            <td>Experiment no: <?php echo $r['module'] ?></td>
                            <th>
                                <input class="form-control " style="width: 250px;" type="date" name="plan-date<?php echo $i ?>" value="<?php echo $r['dop_Plan'] ?>">
                            </th>
                            <td>
                                <textarea class="form-control" name="exp_name<?php echo $i ?>" id="" cols="70" rows="3"><?php echo $r['pending'] ?></textarea>
                            </td>
                        </tr>
                    <?php } ?>


                    </tbody>
                </table>
            </div>
            <input type="text" name="count" id="" value="<?php echo $i ?>" hidden>
            <div style="width: 100%; ">
                <button class="btn btn-success mt-3">Save</button>
            </div>

        </form>

        <!-- <div style="float:right"> -->
        <form action="hod_approve_lab.php" method="post">
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
                    <input type="text" name="sub" value="<?php echo $sub ?>" hidden>
                </div>
            </div>
        </form>
    </div>
    <div class="mt-5">
        <form action="co_update_lab.php" method="POST">
            <input type="text" name="sub" id="" hidden value="<?php echo $sub ?>">
            <h2 class="m-3">CO's</h2>
            <div class="row">



                <table class="table table-striped">
                    <thead>
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