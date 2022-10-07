<?php
require_once "config1.php";
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
error_reporting(0);
//session_start();
$branch = $_SESSION["branch"];
$sec = $_SESSION["sec"];
$sem = $_SESSION["sem"];
$sub = $_SESSION["sub"];
$sub_code = explode(" - ", $sub);
$qq = "select distinct * from lab_marks where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\"";
//  $qq1 = "select distinct * from ia_marks2 where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\"";
//  $qq2 = "select distinct * from ia_marks3 where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\"";
$q = "select * from lab_co_mapping where dept=\"" . $branch . "\" and subcode=\"" . $sub . "\";";
$result4 = $con->query($q);
$rr = mysqli_fetch_assoc($result4);

$cc = 0;
$cc1 = 0;
$cc2 = 0;
$result = $con->query($qq);
// echo $qq;
//  $result1 = $con->query($qq1);
//  $result2 = $con->query($qq2);
$join1 = "SELECT ia_marks1.usn,ia_marks1.name, ia_marks1.total1, ia_marks2.total2, ia_marks3.total3 FROM ia_marks1 JOIN ia_marks2 ON ia_marks1.usn = ia_marks2.usn JOIN ia_marks3 ON ia_marks2.usn = ia_marks3.usn  where ia_marks1.branch = \"" . $branch . "\" and ia_marks1.sec = \"" . $sec . "\" and ia_marks1.sem = \"" . $sem . "\" and ia_marks1.sub = \"" . $sub . "\"";
//  echo $join1;
$result3 = $con->query($join1);

$r_no = mysqli_fetch_assoc($result);
?>
<?php
//require_once "../config.php";


//include("../template/sidebar-admin.php");

?>
<div class="" style="width:100%">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="ia1-tab" data-bs-target="#ia1" data-toggle="tab" href="#ia1" role="tab" aria-controls="ia1" aria-selected="true">Lab Exp</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ia2-tab" data-bs-target="#ia2" data-toggle="tab" href="#ia2" role="tab" aria-controls="ia2" aria-selected="false">Class Test</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ia3-tab" data-bs-target="#ia3" data-toggle="tab" href="#ia3" role="tab" aria-controls="ia3" aria-selected="false">Total</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ia4-tab" data-bs-target="#ia4" data-toggle="tab" href="#ia4" role="tab" aria-controls="ia4" aria-selected="false">External</a>
        </li>
    </ul>
    <br>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ia1" role="tabpanel" aria-labelledby="ia1-tab">
            <a href="../lab_report/select_semester.php">Export</a>

            <!-- popup -->
            <form action="co.php" method="post">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Set Lab CO</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="row mt-2">

                                    <?php for ($i = 1; $i <= $r_no['no_exp']; $i++) { ?>
                                        <div class="col-6 mt-2">
                                            <!-- <div class="row mb-1">
                                                <div class="col col-3 col-md-3 col-lg-3">
                                                    <span>EX-<?php echo $i; ?></span>
                                                </div>
                                                <div class="col col-9 col-md-9 col-lg-9">
                                                    <input type="text" class="form-control" value="<?php if (is_null($rr['e' . $i])) { ?>N/A<?php } else {
                                                                                                                                            echo $rr['e' . $i];
                                                                                                                                        } ?>">
                                                </div>
                                            </div> -->
                                            <label for="co_for_ex-<?php echo $i ?>">EX - <?php echo $i ?></label>
                                            <input type="text" name="ex<?php echo $i ?>" id="" value="<?php echo $rr['e' . $i]; ?>" class="form-control">
                                            <select class="form-select" aria-label="Default select example" id="co_for_ex-<?php echo $i ?>" name="exp-co-<?php echo $i; ?>[]" multiple>
                                                <option value="1">CO1</option>
                                                <option value="2">CO2</option>
                                                <option value="3">CO3</option>
                                                <option value="4">CO4</option>
                                                <option value="5">CO5</option>
                                                <option value="6">CO6</option>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <!-- </div> -->
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
            </form>

        </div>
    </div>
</div>
<!-- popup end -->

<!-- Modal -->
<div class="container">
    <div class="row">
        <div class="col-8">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Set Lab CO
            </button>
        </div>
        <div class="col">
            <form style="display: flex;" action='up.php' method="post">
                <label for="staticEmail" class="m-2 col-form-label">No of experiments</label>
                <div class="m-2 col-sm-2 primary">
                    <input type="text" name="sub" id="" value="<?php echo $sub ?>" hidden>
                    <input type="number" name='no_exp' min=1 max=16 class="form-control " id="staticEmail" value="<?php echo $r_no['no_exp'] ?>">
                </div>
                <button type="submit" class="m-2 btn btn-primary" name='set_no'>Set</button>
            </form>
        </div>
    </div>
</div>
<!-- Model End -->
<style>
    th {
        text-align: center;
    }
</style>
<script>
    function exp(e) {
        var i = 0;
        for (i = 1; i < 17; i++) {
            var y = document.getElementsByClassName(`ex-${i}`);
            for (var k = 0; k < y.length; k++) {
                y[k].style.display = "table-cell";
            }
            var x = document.getElementById(`ex-${i}`);
            x.style.display = "table-cell";
        }
        //  console.log("******************************");
        for (i = parseInt(e) + 1; i < 17; i++) {
            var y = document.getElementsByClassName(`ex-${i}`);
            for (let k = 0; k < y.length; k++) {
                y[k].style.display = "none";
            }
            var x = document.getElementById(`ex-${i}`);
            x.style.display = "none";
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        exp(<?php echo $r_no['no_exp'] ?>);
        internal_marks(<?php echo $r_no['total_ia'] ?>);
    }, false);
</script>
<div class="">
    <div class="row">

        <div class="col col-sm-12 col-md-12" style="overflow-x: scroll">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <!-- <th></th> -->
                        <th scope="col">USN</th>
                        <th scope="col">Name</th>
                        <th scope="col" id="ex-1">Ex-1</th>
                        <th scope="col" id="ex-2">Ex-2</th>
                        <th scope="col" id="ex-3">Ex-3</th>
                        <th scope="col" id="ex-4">Ex-4</th>
                        <th scope="col" id="ex-5">Ex-5</th>
                        <th scope="col" id="ex-6">Ex-6</th>
                        <th scope="col" id="ex-7">Ex-7</th>
                        <th scope="col" id="ex-8">Ex-8</th>
                        <th scope="col" id="ex-9">Ex-9</th>
                        <th scope="col" id="ex-10">Ex-10</th>
                        <th scope="col" id="ex-11">Ex-11</th>
                        <th scope="col" id="ex-12">Ex-12</th>
                        <th scope="col" id="ex-13">Ex-13</th>
                        <th scope="col" id="ex-14">Ex-14</th>
                        <th scope="col" id="ex-15">Ex-15</th>
                        <th scope="col" id="ex-16">Ex-16</th>
                        <th scope="col">Total</th>
                        <th scope="col">Average</th>
                    </tr>
                </thead>
                <tbody>

                    <form action="lab_marks_insert.php" method="post">
                        <?php
                        $cc = 0;
                        foreach ($result as $r) {
                            $cc++;
                        ?>
                            <tr id="row<?php echo $cc; ?>">
                                <td>
                                    <input type="text" class="form-control" id="usn" name="usn<?php echo $cc; ?>" value="<?php echo $r['usn']; ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="name" name="name<?php echo $cc; ?>" value="<?php echo $r['name']; ?>" readonly />
                                </td>

                                <td class="ex-1">
                                    <input type="number" min="0" max="10" class="form-control tab1-1a " id="ex-1" value="<?php echo $r['exp1']; ?>" name="exp1-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-2">
                                    <input type="number" min="0" max="10" class="form-control tab1-1b " id="ex-2" value="<?php echo $r['exp2']; ?>" name="exp2-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-3">
                                    <input type="number" min="0" max="10" class="form-control tab1-1c " id="ex-3" value="<?php echo $r['exp3']; ?>" name="exp3-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-4">
                                    <input type="number" min="0" max="10" class="form-control tab1-2a " id="ex-4" value="<?php echo $r['exp4']; ?>" name="exp4-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-5">
                                    <input type="number" min="0" max="10" class="form-control tab1-2b " id="ex-5" value="<?php echo $r['exp5']; ?>" name="exp5-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-6">
                                    <input type="number" min="0" max="10" class="form-control tab1-2c " id="ex-6" value="<?php echo $r['exp6']; ?>" name="exp6-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-7">
                                    <input type="number" min="0" max="10" class="form-control tab1-3a " id="ex-7" value="<?php echo $r['exp7']; ?>" name="exp7-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-8">
                                    <input type="number" min="0" max="10" class="form-control tab1-3b " id="ex-8" value="<?php echo $r['exp8']; ?>" name="exp8-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-9">
                                    <input type="number" min="0" max="10" class="form-control tab1-3c " id="ex-9" value="<?php echo $r['exp9']; ?>" name="exp9-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-10">
                                    <input type="number" min="0" max="10" class="form-control tab1-4a " id="ex-10" value="<?php echo $r['exp10']; ?>" name="exp10-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-11">
                                    <input type="number" min="0" max="10" class="form-control tab1-4b " id="ex-11" value="<?php echo $r['exp11']; ?>" name="exp11-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-12">
                                    <input type="number" min="0" max="10" class="form-control tab1-4c " id="ex-12" value="<?php echo $r['exp12']; ?>" name="exp12-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-13">
                                    <input type="number" min="0" max="10" class="form-control tab1-4c " id="ex-13" value="<?php echo $r['exp13']; ?>" name="exp13-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-14">
                                    <input type="number" min="0" max="10" class="form-control tab1-4c " id="ex-14" value="<?php echo $r['exp14']; ?>" name="exp14-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-15">
                                    <input type="number" min="0" max="10" class="form-control tab1-4c " id="ex-15" value="<?php echo $r['exp15']; ?>" name="exp15-<?php echo $cc; ?>" />
                                </td>
                                <td class="ex-16">
                                    <input type="number" min="0" max="10" class="form-control tab1-4c " id="ex-16" value="<?php echo $r['exp16']; ?>" name="exp16-<?php echo $cc; ?>" />
                                </td>
                                <td>
                                    <input type="number" class="form-control tab1-total" readonly name="exp_total" id="total" value="<?php echo $r['exp_total'] ?>">
                                </td>
                                <td>
                                    <input type="number" readonly class="form-control tab1-4c" id="4c" value="<?php echo $r['exp_avg']; ?>" name="exp_avg" />
                                </td>
                                <td>

                                </td>
                            </tr>
                        <?php } ?>
                        <input type="text" name="count" id="" hidden value="<?php echo $cc ?>">
                        <button class="btn btn-success" type="submit">
                            Save
                        </button>
                    </form>
                </tbody>
            </table>

        </div>
    </div>
</div>
</div>

<div class="tab-pane fade" id="ia2" role="tabpane2" aria-labelledby="ia2-tab">
    <!-- <br /> -->
    <!-- <button type="button" style="float: right;" class="btn btn-primary m-1" data-toggle="modal"
                data-target="#exampleModal2">
                Set no of Ia's
            </button> -->

    <!-- <br /> -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Set no of Class Test's </h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span style="font-size: 25px;" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 5px; margin: 5px;">
                    <form action="att_avgc.php" method="post">
                        <div class="row">
                            <div class="col">
                                <label for="no-ia"> Set no of Class Test's </label>
                                <input id="no-ia" class="form-control" type="number" name="no-ia">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button style="float: right; margin-top: 5px;" class="btn btn-primary" type="submit">Set</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <br /> -->

    <div class="container">
        <div class="row">
            <div class="col-8"></div>
            <div class="col">
                <form style="display: flex;" action='up_ia.php' method="post">
                    <label for="InternalSelect" class="m-2 col-form-label">No of Class Test's</label>
                    <div class="m-2 col-sm-2 primary">
                        <select class="form-select" id="InternalSelect" name="total_ia">
                            <option value="<?php echo $r_no['total_ia'] ?>"><?php echo $r_no['total_ia'] ?></option>
                            <option value=1>1</option>
                            <option value=2>2</option>
                        </select>
                    </div>
                    <input type="text" name="sub" id="" value="<?php echo $sub ?>" hidden>
                    <button type="submit" class="m-2 btn btn-primary" name='set_no' onclick="internal_marks(parseInt(this.value));">Set</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function internal_marks(e) {
            console.log(e);
            var i = 0;
            for (i = 1; i < 3; i++) {
                var y = document.getElementsByClassName(`exptest${i}`);
                for (var k = 0; k < y.length; k++) {
                    y[k].style.display = "table-cell";
                }
            }
            //  console.log("******************************");
            for (i = e + 1; i < 3; i++) {
                var y = document.getElementsByClassName(`exptest${i}`);
                for (let k = 0; k < y.length; k++) {
                    y[k].style.display = "none";
                }
            }
        }
    </script>
    <div class="container">
        <div class="col col-sm-12 col-md-12" style="overflow-x: scroll">
            <table class="table" style="overflow: hidden" id="table2">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">USN</th>
                        <th scope="col">Name</th>
                        <th scope="col" class="exptest1">Exp No. Class Test-1</th>
                        <th scope="col" class="exptest1">Marks Class Test-1</th>
                        <th scope="col" class="exptest2">Exp No. Class Test-2</th>
                        <th scope="col" class="exptest2">Marks Class Test-2</th>
                        <th scope="col">Total</th>
                        <th scope="col">Average</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="lab_ia_mark_insert.php" method="post">
                        <?php foreach ($result as $r1) {
                            $cc1++;
                        ?>
                            <tr id="row2<?php echo $cc1; ?>">


                                <td style="width: 30px;">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" checked id="attendance2<?php echo $cc1; ?>" onclick="myFunction2()" />
                                        <label class="custom-control-label" for="attendance2<?php echo $cc1; ?>"></label>
                                    </div>
                                </td>

                                <td>

                                    <input type="text" class="form-control" id="tab2-usn" name="usn<?php echo $cc1; ?>" readonly value="<?php echo $r1['usn']; ?>" />
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="tab2-name" name="name<?php echo $cc1; ?>" readonly value="<?php echo $r1['name']; ?>" />
                                </td>

                                <td class="exptest1">
                                    <input type="number" min="0" max="20" class="form-control tab2-1a" value="<?php echo $r1['ia1_expno']; ?>" id="tab2-1a" name="ia1_expno<?php echo $cc1; ?>" />
                                </td>
                                <td class="exptest1">
                                    <input type="number" min="0" max="30" class="form-control tab2-1b" value="<?php echo $r1['ia1_mark']; ?>" id="tab2-1b" name="ia1_mark<?php echo $cc1; ?>" />
                                </td>
                                <td class="exptest2">
                                    <input type="number" min="0" max="20" class="form-control tab2-1c" value="<?php echo $r1['ia2_expno']; ?>" id="tab2-1c" name="ia2_expno<?php echo $cc1; ?>" />
                                </td>
                                <td class="exptest2">
                                    <input type="number" min="0" max="30" class="form-control tab2-2a" value="<?php echo $r1['ia2_marks']; ?>" id="tab2-2a" name="ia2_marks<?php echo $cc1; ?>" />
                                </td>
                                <td>
                                    <input type="number" class="form-control tab2-2b" value="<?php echo $r1['ia_total']; ?>" id="tab2-2b" name="ia_total" readonly />
                                </td>
                                <td>
                                    <input type="number" class="form-control tab1-total" name="ia_avg" id="total" value="<?php echo $r1['ia_avg'] ?>" readonly>
                                </td>
                                <td>
                                </td>
                            </tr>
                        <?php } ?>
                </tbody>
                <input type="text" name="count" id="" value="<?php echo $cc1; ?>" hidden>
                <button class="btn btn-success" type="submit">
                    Save
                </button>
                </form>
            </table>
        </div>
    </div>
</div>

<div class="tab-pane fade" id="ia3" role="tabpane3" aria-labelledby="ia3-tab">
    <br />
    <br />
    <br />

    <div class="container">
        <div class="col col-sm-12 col-md-12" style="overflow-x: scroll">
            <table class="table" style="overflow: hidden" id="table3">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">USN</th>
                        <th scope="col">Name</th>
                        <!-- <th scope="col">Exp No.</th> -->
                        <th scope="col">Class Test Marks</th>
                        <th scope="col">Lab Exp Marks</th>
                        <th scope="col">Total</th>


                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $r2) {
                        $cc2++;
                    ?>
                        <tr id="row2<?php echo $cc2; ?>">

                            <td style="width: 30px;">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" checked id="attendance3<?php echo $cc2 ?>" onclick="myFunction3()" />
                                    <label class="custom-control-label" for="attendance3<?php echo $cc2; ?>"></label>
                                </div>
                            </td>
                            <!-- <form action="ia_marks3_insert.php" method="post"> -->
                            <td>
                                <input type="text" class="form-control" id="tab3-usn" name="usn" readonly value="<?php echo $r2['usn']; ?>" />
                            </td>
                            <td>
                                <input type="text" class="form-control" id="tab3-name" name="name" readonly value="<?php echo $r2['name']; ?>" />
                            </td>

                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-1a" value="<?php echo $r2['ia_avg']; ?>" id="tab3-1a" name="final_ia" readonly />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-1b" value="<?php echo $r2['exp_avg']; ?>" id="tab3-1b" name="1b" readonly />
                            </td>

                            <td>
                                <input type="number" class="form-control tab1-total" name="total" id="total" value="<?php echo $r2['ia_avg'] + $r2['exp_avg'] ?>" readonly>
                            </td>
                            <!-- <td>
                                    <button class="btn btn-success" type="submit">
                                        Save
                                    </button>
                                </td> -->
                        </tr>
                        <!-- </form> -->
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="tab-pane fade" id="cons" role="tabpane4" aria-labelledby="cons-tab">
    <br />
    <!-- content of ia2 -->


    <br />
    <br />

    <!-- Modal -->


    <div class="container">
        <div class="col col-sm-12 col-md-12" style="overflow-x: scroll">
            <table class="table" style="overflow: hidden" id="table2">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col">USN</th>
                        <th scope="col">Name</th>
                        <th scope="col">Class TestI</th>
                        <th scope="col">Class TestII</th>
                        <th scope="col">Class TestIII </th>
                        <th scope="col">Average</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result3 as $r3) {
                        $cc1++;
                    ?>
                        <tr id="row2<?php echo $cc1; ?>">


                            <td style="width: 30px;">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" checked id="attendance4<?php echo $cc1; ?>" onclick="myFunction2()" />
                                    <label class="custom-control-label" for="attendance4<?php echo $cc1; ?>"></label>
                                </div>
                            </td>
                            <form action="ia_marks2_insert.php" method="post">
                                <td>

                                    <input type="text" class="form-control" id="tab2-usn" name="usn" readonly value="<?php echo $r3['usn']; ?>" />
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="tab2-name" name="name" readonly value="<?php echo $r3['name']; ?>" />
                                </td>


                                <td>
                                    <input type="number" class="form-control" value="<?php echo $r3['total1']; ?>" id="ia1" name="ia1" />
                                </td>


                                <td>
                                    <input type="number" class="form-control" value="<?php echo $r3['total2']; ?>" id="ia2" name="ia2" />
                                </td>


                                <td>
                                    <input type="number" class="form-control" value="<?php echo $r3['total3']; ?>" id="ia3" name="ia3" />
                                </td>


                                <td>
                                    <input type="number" class="form-control tab1-total" name="average" id="average" value="<?php echo ($r3["total1"] + $r3["total2"] + $r3["total3"]) / 3 ?>">
                                </td>
                                <!-- <td>
                                          <button class="btn btn-primary" type="submit">
                                             Save
                                          </button>
                                       </td> -->
                        </tr>
                        </form>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="tab-pane fade" id="ia4" role="tabpane5" aria-labelledby="ia4-tab">
    <br />


    <div class="container">
        <div class="col col-sm-12 col-md-12" style="overflow-x: scroll">
            <table class="table" style="overflow: hidden" id="table3">
                <thead>
                    <tr>
                        <!-- <th></th> -->
                        <th scope="col">USN</th>
                        <th scope="col">Name</th>
                        <!-- <th scope="col">Exp No.</th> -->
                        <th scope="col">External Marks</th>


                    </tr>
                </thead>
                <tbody>
                    <form action="ext_lab.php" method="post">
                        <button class="btn btn-success" type="submit">
                            Save
                        </button>
                        <?php
                        $cc2 = 0;
                        foreach ($result as $r2) {
                            $cc2++;
                        ?>
                            <tr>

                                <!-- <form action="ia_marks3_insert.php" method="post"> -->
                                <td>
                                    <input type="text" class="form-control" id="tab3-usn" name="usn<?php echo $cc2; ?>" readonly value="<?php echo $r2['usn']; ?>" />
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="tab3-name" name="name<?php echo $cc2; ?>" readonly value="<?php echo $r2['name']; ?>" />
                                </td>

                                <td>
                                    <input type="number" min="0" max="60" class="form-control tab3-1a" value="<?php echo $r2['exam_mark']; ?>" id="tab3-1a" name="ext<?php echo $cc2; ?>" />
                                </td>
                                <!-- <td>
                                    <button class="btn btn-success" type="submit">
                                        Save
                                    </button>
                                </td> -->
                            </tr>
                            <!-- </form> -->
                        <?php } ?>
                        <input type="text" name="sub" id="" value="<?php echo $sub ?>" hidden>
                        <input type="text" name="cc2" id="" value="<?php echo $cc2; ?>" hidden>
                    </form>
                </tbody>
            </table>
        </div>
    </div>
</div>


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
        let x = 1;
        $("#sidebarCollapse").on("click", function() {
            $("#sidebar").toggleClass("active");
            console.log(x);
            if (x) {
                $("body").css({
                    width: "100%"
                });
                x = 0;
            } else {
                $("body").css({
                    width: "30%"
                });
                x = 1;
            }
        });
    });
</script>
<script>
    $('#table1 tr td div:first-child input[type="checkbox"]').prop('checked', true);
    $('#table2 tr td div:first-child input[type="checkbox"]').prop('checked', true);
    $('#table3 tr td div:first-child input[type="checkbox"]').prop('checked', true);

    function tab1ia1(e, id) {
        console.log(e);
        $(id).attr("max", e);
    }

    function tab2ia1(e, id) {
        console.log(e);
        $(id).attr("max", e);
    }

    function tab3ia1(e, id) {
        console.log(e);
        $(id).attr("max", e);
    }

    function myFunction3() {
        console.log("myFunctin3");
        $('#table3 tr td div:first-child input[type="checkbox"]').click(
            function() {
                //enable/disable all except checkboxes, based on the row is checked or not
                console.log(this.checked);
                $(this)
                    .closest("tr")
                    .find(":input:not(:first)")
                    .attr("disabled", !this.checked);

            }
        );
    }

    function myFunction2() {
        console.log("myFunctin2");
        $('#table2 tr td:first-child input[type="checkbox"]').click(
            function() {
                //enable/disable all except checkboxes, based on the row is checked or not
                $(this)
                    .closest("tr")
                    .find(":input:not(:first)")
                    .attr("disabled", !this.checked);
            }
        );
    }

    function myFunction1() {
        console.log("myFunctin1");
        $('#table1 tr td div:first-child input[type="checkbox"]').click(
            function() {
                //enable/disable all except checkboxes, based on the row is checked or not
                console.log(this.checked);
                $(this)
                    .closest("tr")
                    .find(":input:not(:first)")
                    .attr("disabled", !this.checked);
            }
        );
    }

    function disable3() {
        console.log('dis3')
    }
</script>
</body>

</html>