<?php
require_once "config1.php";
include("../template/fac-auth.php");
error_reporting(0);
include("../template/sidebar-fac.php");
//session_start();
$branch = $_SESSION["branch"];
$sec = $_SESSION["sec"];
$sem = $_SESSION["sem"];
$sub = $_SESSION["sub"];
$c = explode("-", $sub);
$a = $c[0];

$z = preg_split("/[A-Za-z]*/", $a);
// echo $z[4];
$m = $z[4];
if ($m == $sem) {
    $q_elec = 'select * from subjects_new where sub_name = "' . explode(' - ', $sub)[1] . '"';
    $open = mysqli_fetch_assoc($link->query($q_elec))['sub_id'];
    if ($open == '1') {
        $qq = 'select * from ia_marks1 a, fac_elec_stud f where a.sem="' . $sem . '" and f.usn=a.usn and f.sub="' . $sub . '" and f.faculty_name="' . $_SESSION['username'] . '" and f.sub=a.sub;';
        $qq1 = 'select * from ia_marks2 a, fac_elec_stud f where a.sem="' . $sem . '" and f.usn=a.usn and f.sub="' . $sub . '" and f.faculty_name="' . $_SESSION['username'] . '" and f.sub=a.sub;';
        $qq2 = 'select * from ia_marks3 a, fac_elec_stud f where a.sem="' . $sem . '" and f.usn=a.usn and f.sub="' . $sub . '" and f.faculty_name="' . $_SESSION['username'] . '" and f.sub=a.sub;';
    } else {
        $qq = "select distinct * from ia_marks1 where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\" order by usn";
        $qq1 = "select distinct * from ia_marks2 where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\" order by usn";
        $qq2 = "select distinct * from ia_marks3 where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\" order by usn";
    }
    $cc = 0;
    $cc1 = 0;
    $cc2 = 0;
    // echo $qq;
    $result = $con->query($qq);
    // print_r($result);
    $result1 = $con->query($qq1);
    $result2 = $con->query($qq2);
    $r1_e = explode(' - ', $sub);
    $q1 = "select distinct * from ia1_max_marks where sub_code=\"" . $r1_e[0] . "\" and dept = \"" . $branch . "\"";
    $result5 = $link->query($q1);
    $q2 = "select distinct * from ia2_max_marks where sub_code=\"" . $r1_e[0] . "\" and dept = \"" . $branch . "\"";
    $result6 = $link->query($q2);
    $q4 = "select distinct * from ia3_max_marks where sub_code=\"" . $r1_e[0] . "\" and dept = \"" . $branch . "\"";
    $result7 = $link->query($q4);
    $q5 = "select distinct * from ia1_co_mapping where sub_code=\"" . $r1_e[0] . "\" and dept = \"" . $branch . "\"";
    $result8 = $link->query($q5);
    if (mysqli_num_rows($result5) == 0) {
        $qq_max = "insert into ia1_max_marks values('" . $r1_e[0] . "','" . $branch . "',0,0,0,0,0,0,0,0,0,0,0,0);";
        $link->query($qq_max);
        // echo $qq_max;
    }
    if (mysqli_num_rows($result6) == 0) {
        $qq_max1 = "insert into ia2_max_marks values('" . $r1_e[0] . "','" . $branch . "',0,0,0,0,0,0,0,0,0,0,0,0);";
        $link->query($qq_max1);
    }
    if (mysqli_num_rows($result7) == 0) {
        $qq_max2 = "insert into ia3_max_marks values('" . $r1_e[0] . "','" . $branch . "',0,0,0,0,0,0,0,0,0,0,0,0);";
        $link->query($qq_max2);
    }
    if (mysqli_num_rows($result8) == 0) {
        $qq3 = "insert into ia1_co_mapping values('" . $r1_e[0] . "','" . $branch . "','none','none','none','none','none','none','none','none','none','none','none','none');";
        $link->query($qq3);
    }
    $q6 = "select distinct * from ia2_co_mapping where sub_code=\"" . $r1_e[0] . "\" and dept = \"" . $branch . "\"";
    // echo $q6;
    $result9 = $link->query($q6);
    if (mysqli_num_rows($result9) == 0) {
        $qq4 = "insert into ia2_co_mapping values('" . $r1_e[0] . "','" . $branch . "','none','none','none','none','none','none','none','none','none','none','none','none');";
        // echo $qq4;
        $link->query($qq4);
    }
    $q7 = "select distinct * from ia3_co_mapping where sub_code=\"" . $r1_e[0] . "\" and dept = \"" . $branch . "\"";
    $result10 = $link->query($q7);
    if (mysqli_num_rows($result10) == 0) {
        $qq5 = "insert into ia3_co_mapping values('" . $r1_e[0] . "','" . $branch . "','none','none','none','none','none','none','none','none','none','none','none','none');";
        $link->query($qq5);
    }
    $result8 = $link->query($q5);
    $result9 = $link->query($q6);
    $result10 = $link->query($q7);
    if ($open == '1') {
        $join1 = 'select distinct * from ia_marks1 i1, ia_marks2 i2, ia_marks3 i3, fac_elec_stud f where i1.usn = i2.usn and i1.usn = i3.usn and i1.sub = i2.sub and i1.sub = i3.sub and f.sub = i1.sub and i1.usn = f.usn and i1.sub = "' . $sub . '" and i1.sem = "' . $sem . '" order by i1.usn';
    } else {
        $join1 = 'select distinct * from ia_marks1 i1, ia_marks2 i2, ia_marks3 i3 where i1.usn = i2.usn and i1.usn = i3.usn and i1.sub = i2.sub and i1.sub = i3.sub and i1.sub = "' . $sub . '" and i1.branch = "' . $branch . '" and i1.sec = "' . $sec . '" and i1.sem = "' . $sem . '" order by i1.usn';
    }
    //  echo $join1;
    $result3 = $con->query($join1);
    // print_r($result3);
}
?>
<style>
    ::placeholder {
        color: black !important;
    }
</style>
<?php
//require_once "../config.php";


//include("../template/sidebar-admin.php");

?>
<h4> Subject : <?php echo $sub ?> </h4>
<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="ia1-tab" data-bs-target="#ia1" data-toggle="tab" href="#ia1" role="tab" aria-controls="ia1" aria-selected="true">IA I</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ia2-tab" data-bs-target="#ia2" data-toggle="tab" href="#ia2" role="tab" aria-controls="ia2" aria-selected="false">IA II</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ia3-tab" data-bs-target="#ia3" data-toggle="tab" href="#ia3" role="tab" aria-controls="ia3" aria-selected="false">IA III</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="cons-tab" data-bs-target="#cons" data-toggle="tab" href="#cons" role="tab" aria-controls="cons" aria-selected="false">Consolidate</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="Extern-tab" data-bs-target="#cons" data-toggle="tab" href="#Extern" role="tab" aria-controls="cons" aria-selected="false">External</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ia1" role="tabpanel" aria-labelledby="ia1-tab">
            <br />
            <!-- contents of ia 1 -->
            <div class="row">
                <div class="col col-1 col-md-1 col-lg-1">
                    <button class="btn btn-primary " data-toggle="modal" data-target="#modal1" type="button">
                        Set
                    </button>
                </div>
                <div class="col ">
                    <!-- Button trigger modal -->
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalimport">
                        New Import
                    </button> -->

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalimport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Class Test1</h5>
                                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                        <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="../upload_ia_marks/ia1.php" method="post" enctype="multipart/form-data">
                                        <input type="file" class="form-control-file" name="xl" id="fileToUpload" accept=".xlsx">
                                        <!-- only xlsx files are accetped -->
                                        <input class="btn btn-primary" type="submit" value="Upload" name="submit">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12 col-md-8 col-lg-8"></div>
                    <div style="align-items:center ;" class="col col-12 col-md-1 col-lg-1">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalimport">Import</button>
                    </div>
                    <div style="align-items:center ;" class="col col-12 col-md-2 col-lg-2">
                        <a href="export_template.php" class="btn btn-info mt-2" hidden>Export Template</a>
                    </div>
                    <div style="align-items:center ;" class="col col-12 col-md-1 col-lg-1">
                        <button class="btn btn-success mt-2" style="margin-left:10px;" onclick="document.getElementById('IA1_Form_submit_Btn').click();"> Submit </button>
                    </div>
                </div>
            </div>

            <br />


            <!-- Modal -->
            <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="update_max.php" method="post">
                    <?php $r = mysqli_fetch_assoc($result5);
                    $rr = mysqli_fetch_assoc($result8);
                    ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Set Class Test-I Marks
                                </h5>
                                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                    <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="1a">1a</label>
                                            <input type="number" default=0 class="form-control mb-1" name="1a" id="tab1-1a" placeholder="1a Max Marks" value="<?php echo $r['1a'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-1a').value,'.tab1-1a')" />
                                            <label for="1b">1b</label>
                                            <input type="number" default=0 class="form-control mb-1" name="1b" id="tab1-1b" placeholder="1b Max Marks" value="<?php echo $r['1b'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-1b').value,'.tab1-1b')" />
                                            <label for="1c">1c</label>
                                            <input type="number" class="form-control mb-1" name="1c" id="tab1-1c" placeholder="1c Max Marks" value="<?php echo $r['1c'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-1c').value,'.tab1-1c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">1a-co</label>
                                            <select type="number" class="form-control mb-1" name="1a-co" id="tab1-1a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['1a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['1a'];
                                                                } ?>">
                                                    <?php if ($rr['1a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['1a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">1b-co</label>
                                            <select type="number" class="form-control mb-1" name="1b-co" id="tab1-1b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['1b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['1b'];
                                                                } ?>">
                                                    <?php if ($rr['1b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['1b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">1c-co</label>
                                            <select type="number" class="form-control mb-1" name="1c-co" id="tab1-1c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['1c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['1c'];
                                                                } ?>">
                                                    <?php if ($rr['1c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['1c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="2a">2a</label>
                                            <input type="number" class="form-control mb-1" id="tab1-2a" name="2a" placeholder="2a Max Marks" value="<?php echo $r['2a'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-2a').value,'.tab1-2a')" />
                                            <label for="2b">2b</label>
                                            <input type="number" class="form-control mb-1" id="tab1-2b" name="2b" placeholder="2b Max Marks" value="<?php echo $r['2b'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-2b').value,'.tab1-2b')" />
                                            <label for="2c">2c</label>
                                            <input type="number" class="form-control mb-1" id="tab1-2c" name="2c" placeholder="2c Max Marks" value="<?php echo $r['2c'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-2c').value,'.tab1-2c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">2a-co</label>
                                            <select type="number" class="form-control mb-1" name="2a-co" id="tab1-2a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['2a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['2a'];
                                                                } ?>">
                                                    <?php if ($rr['2a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['2a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">2b-co</label>
                                            <select type="number" class="form-control mb-1" name="2b-co" id="tab1-2b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['2b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['2b'];
                                                                } ?>">
                                                    <?php if ($rr['2b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['2b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">2c-co</label>
                                            <select type="number" class="form-control mb-1" name="2c-co" id="tab1-2c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['2c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['2c'];
                                                                } ?>">
                                                    <?php if ($rr['2c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['2c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                        <hr class="mt-2">
                                        <div class="col-sm-3">
                                            <label for="3a">3a</label>
                                            <input type="number" class="form-control mb-1" id="tab1-3a" name="3a" placeholder="3a Max Marks" value="<?php echo $r['3a'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-3a').value,'.tab1-3a')" />
                                            <label for="3b">3b</label>
                                            <input type="number" class="form-control mb-1" id="tab1-3b" name="3b" placeholder="3b Max Marks" value="<?php echo $r['3b'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-3b').value,'.tab1-3b')" />
                                            <label for="3c">3c</label>
                                            <input type="number" class="form-control mb-1" id="tab1-3c" name="3c" placeholder="3c Max Marks" value="<?php echo $r['3c'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-3c').value,'.tab1-3c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">3a-co</label>
                                            <select type="number" class="form-control mb-1" name="3a-co" id="tab1-3a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['3a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['3a'];
                                                                } ?>">
                                                    <?php if ($rr['3a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['3a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">3b-co</label>
                                            <select type="number" class="form-control mb-1" name="3b-co" id="tab1-3b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['3b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['3b'];
                                                                } ?>">
                                                    <?php if ($rr['3b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['3b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">3c-co</label>
                                            <select type="number" class="form-control mb-1" name="3c-co" id="tab1-3c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['3c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['3c'];
                                                                } ?>">
                                                    <?php if ($rr['3c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['3c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="4a">4a</label>
                                            <input type="number" class="form-control mb-1" id="tab1-4a" name="4a" placeholder="4a Max Marks" value="<?php echo $r['4a'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-4a').value,'.tab1-4a')" />
                                            <label for="4b">4b</label>
                                            <input type="number" class="form-control mb-1" id="tab1-4b" name="4b" placeholder="4b Max Marks" value="<?php echo $r['4b'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-4b').value,'.tab1-4b')" />
                                            <label for="4c">4c</label>
                                            <input type="number" class="form-control mb-1" id="tab1-4c" name="4c" placeholder="4c Max Marks" value="<?php echo $r['4c'] ?? 0 ?>" onchange="tab1ia1(document.getElementById('tab1-4c').value,'.tab1-4c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">4a-co</label>
                                            <select type="number" class="form-control mb-1" name="4a-co" id="tab1-4a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['4a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['4a'];
                                                                } ?>">
                                                    <?php if ($rr['4a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['4a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">4b-co</label>
                                            <select type="number" class="form-control mb-1" name="4b-co" id="tab1-4b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['4b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['4b'];
                                                                } ?>">
                                                    <?php if ($rr['4b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['4b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">4c-co</label>
                                            <select type="number" class="form-control mb-1" name="4c-co" id="tab1-4c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr['4c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr['4c'];
                                                                } ?>">
                                                    <?php if ($rr['4c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr['4c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Save changes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <style>
                thead tr:nth-child(1) th {
                    background: silver;
                    position: sticky;
                    top: 0;
                    z-index: 10;
                    text-align: center;
                }

                .custom-table {
                    overflow: scroll;
                    width: 78vw;
                    height: 60vh;
                    margin-top: 0px;
                    padding: 0;
                }

                .sticky-col {
                    position: -webkit-sticky;
                    position: sticky;
                    background-color: white;
                }

                .first-col {
                    left: 0px;
                }
            </style>
            <!-- <div class="container"> -->

            <div class="table-responsive-sm custom-table">
                <table class="table" style="width:max-content;" id="table1">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col" class="sticky-col first-col" style="width:140px ;">USN</th>
                            <th scope="col" style="width:160px ;">Name</th>
                            <th scope="col">1A</th>
                            <th scope="col">1B</th>
                            <th scope="col">1C</th>
                            <th scope="col">2A</th>
                            <th scope="col">2B</th>
                            <th scope="col">2C</th>
                            <th scope="col">3A</th>
                            <th scope="col">3B</th>
                            <th scope="col">3C</th>
                            <th scope="col">4A</th>
                            <th scope="col">4B</th>
                            <th scope="col">4C</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="ia_marks_insert.php" method="post">
                            <input type="submit" hidden id="IA1_Form_submit_Btn" class="btn btn-success" value="SUBMIT">
                            <?php
                            if (isset($result)) {
                            } else {
                                // header("Location: ia_marks.php");
                                $_SESSION['check_error'] = 1;

                                echo '<script>window.location.replace("ia_marks.php");</script>';
                            }
                            foreach ($result as $r) {
                                $cc++;
                            ?>
                                <tr id="row<?php echo $cc; ?>">
                                    <td style="width:30px;">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name='att[]' class="custom-control-input" <?php if ($r['att'] == 1) { ?>checked<?php } ?> id="attendance<?php echo $cc; ?>" onclick="myFunction1()" value="<?php echo $r['usn'] ?>" />
                                            <label class="custom-control-label" for="attendance<?php echo $cc; ?>"></label>
                                        </div>
                                    </td>

                                    <td class="sticky-col first-col">
                                        <input type="text" class="form-control" id="usn" name="usn<?php echo $cc ?>" value="<?php echo $r['usn']; ?>" readonly />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control mb-1" id="" name="name<?php echo $cc ?>" value="<?php echo $r['name']; ?>" readonly />
                                    </td>

                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-1a" id="1a" value="<?php echo $r['1a']; ?>" <?php if (empty($r['1a'])) { ?> placeholder="N/A" <?php } ?> name="1a<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-1b" id="1b" value="<?php echo $r['1b']; ?>" <?php if (empty($r['1b'])) { ?> placeholder="N/A" <?php } ?> name="1b<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-1c" id="1c" value="<?php echo $r['1c']; ?>" <?php if (empty($r['1c'])) { ?> placeholder="N/A" <?php } ?> name="1c<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-2a" id="2a" value="<?php echo $r['2a']; ?>" <?php if (empty($r['2a'])) { ?> placeholder="N/A" <?php } ?> name="2a<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-2b" id="2b" value="<?php echo $r['2b']; ?>" <?php if (empty($r['2b'])) { ?> placeholder="N/A" <?php } ?> name="2b<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-2c" id="2c" value="<?php echo $r['2c']; ?>" <?php if (empty($r['2c'])) { ?> placeholder="N/A" <?php } ?> name="2c<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-3a" id="3a" value="<?php echo $r['3a']; ?>" <?php if (empty($r['3a'])) { ?> placeholder="N/A" <?php } ?> name="3a<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-3b" id="3b" value="<?php echo $r['3b']; ?>" <?php if (empty($r['3b'])) { ?> placeholder="N/A" <?php } ?> name="3b<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-3c" id="3c" value="<?php echo $r['3c']; ?>" <?php if (empty($r['3c'])) { ?> placeholder="N/A" <?php } ?> name="3c<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-4a" id="4a" value="<?php echo $r['4a']; ?>" <?php if (empty($r['4a'])) { ?> placeholder="N/A" <?php } ?> name="4a<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-4b" id="4b" value="<?php echo $r['4b']; ?>" <?php if (empty($r['4b'])) { ?> placeholder="N/A" <?php } ?> name="4b<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" min="0" max="20" class="form-control tab1-4c" id="4c" value="<?php echo $r['4c']; ?>" <?php if (empty($r['4c'])) { ?> placeholder="N/A" <?php } ?> name="4c<?php echo $cc ?>" <?php if ($r['att'] == 0) { ?>readonly<?php } ?> />
                                    </td>
                                    <td>
                                        <input type="number" class="form-control tab1-total" readonly name="total<?php echo $cc ?>" id="total" value="<?php echo $r['total1'] ?>">
                                    </td>
                                    <!-- <td>
                                          <button class="btn btn-primary" type="submit">
                                             Save
                                          </button>
                                       </td> -->
                                </tr>

                            <?php } ?>
                            <input type="text" name="cc" id="" value="<?php echo $cc ?>" hidden>

                        </form>
                    </tbody>
                </table>
            </div>

            <!-- </div> -->
        </div>

        <div class="tab-pane fade" id="ia2" role="tabpane2" aria-labelledby="ia2-tab">
            <br />
            <!-- content of ia2 -->
            <div class="row">
                <div class="col col-4 col-md-4 col-lg-4">
                    <button class="btn btn-primary " data-toggle="modal" data-target="#modal2" type="button">
                        Set
                    </button>
                </div>

                <div class="col">

                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#exampleModalimport1">
                        New Import
                    </button> -->
                    <div class="modal fade" id="exampleModalimport1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Class Test2</h5>
                                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                        <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="../upload_ia_marks/ia2.php" method="post" enctype="multipart/form-data">
                                        <input type="file" class="form-control-file" name="xl" id="fileToUpload" accept=".xlsx">
                                        <!-- only xlsx files are accetped -->
                                        <input class="btn btn-primary" type="submit" value="Upload" name="submit">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-3 col-lg-3">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalimport1">
                        Import
                    </button>
                    <button class="btn btn-success" style="margin-left:10px;" onclick="document.getElementById('IA2_Form_submit_Btn').click();"> Submit </button>
                </div>
            </div>
            <br />
            <!-- Modal -->
            <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="update_max2.php" method="post">
                    <?php $r1 = mysqli_fetch_assoc($result6);
                    $rr1 = mysqli_fetch_assoc($result9);
                    ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Set Class Test-II Marks
                                </h5>
                                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                    <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="1a">1a</label>
                                            <input type="number" class="form-control mb-1" name="1a" id="tab2-1a" placeholder="1a Max Marks" value="<?php echo $r1['1a'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-1a').value,'.tab2-1a')" />
                                            <label for="1b">1b</label>
                                            <input type="number" class="form-control mb-1" name="1b" id="tab2-1b" placeholder="1b Max Marks" value="<?php echo $r1['1b'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-1b').value,'.tab2-1b')" />
                                            <label for="1c">1c</label>
                                            <input type="number" class="form-control mb-1" name="1c" id="tab2-1c" placeholder="1c Max Marks" value="<?php echo $r1['1c'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-1c').value,'.tab2-1c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">1a-co</label>
                                            <select type="number" class="form-control mb-1" name="1a-co" id="tab2-1a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['1a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['1a'];
                                                                } ?>">
                                                    <?php if ($rr1['1a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['1a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">1b-co</label>
                                            <select type="number" class="form-control mb-1" name="1b-co" id="tab2-1b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['1b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['1b'];
                                                                } ?>">
                                                    <?php if ($rr1['1b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['1b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">1c-co</label>
                                            <select type="number" class="form-control mb-1" name="1c-co" id="tab2-1c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['1c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['1c'];
                                                                } ?>">
                                                    <?php if ($rr1['1c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['1c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="2a">2a</label>
                                            <input type="number" class="form-control mb-1" id="tab2-2a" name="2a" placeholder="2a Max Marks" value="<?php echo $r1['2a'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-2a').value,'.tab2-2a')" />
                                            <label for="2b">2b</label>
                                            <input type="number" class="form-control mb-1" id="tab2-2b" name="2b" placeholder="2b Max Marks" value="<?php echo $r1['2b'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-2b').value,'.tab2-2b')" />
                                            <label for="2c">2c</label>
                                            <input type="number" class="form-control mb-1" id="tab2-2c" name="2c" placeholder="2c Max Marks" value="<?php echo $r1['2c'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-2c').value,'.tab2-2c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">2a-co</label>
                                            <select type="number" class="form-control mb-1" name="2a-co" id="tab2-4a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['2a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['2a'];
                                                                } ?>">
                                                    <?php if ($rr1['2a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['2a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">2b-co</label>
                                            <select type="number" class="form-control mb-1" name="2b-co" id="tab2-4b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['2b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['2b'];
                                                                } ?>">
                                                    <?php if ($rr1['2b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['2b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">2c-co</label>
                                            <select type="number" class="form-control mb-1" name="2c-co" id="tab2-4c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['2c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['2c'];
                                                                } ?>">
                                                    <?php if ($rr1['2c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['2c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                        <hr class="mt-2">
                                        <div class="col-sm-3">
                                            <label for="3a">3a</label>
                                            <input type="number" class="form-control mb-1" id="tab2-3a" name="3a" placeholder="3a Max Marks" value="<?php echo $r1['3a'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-3a').value,'.tab2-3a')" />
                                            <label for="3b">3b</label>
                                            <input type="number" class="form-control mb-1" id="tab2-3b" name="3b" placeholder="3b Max Marks" value="<?php echo $r1['3b'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-3b').value,'.tab2-3b')" />
                                            <label for="3c">3c</label>
                                            <input type="number" class="form-control mb-1" id="tab2-3c" name="3c" placeholder="3c Max Marks" value="<?php echo $r1['3c'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-3c').value,'.tab2-3c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">3a-co</label>
                                            <select type="number" class="form-control mb-1" name="3a-co" id="tab2-4a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['3a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['3a'];
                                                                } ?>">
                                                    <?php if ($rr1['3a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['3a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">3b-co</label>
                                            <select type="number" class="form-control mb-1" name="3b-co" id="tab2-4b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['3b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['3b'];
                                                                } ?>">
                                                    <?php if ($rr1['3b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['3b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">3c-co</label>
                                            <select type="number" class="form-control mb-1" name="3c-co" id="tab2-4c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['3c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['3c'];
                                                                } ?>">
                                                    <?php if ($rr1['3c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['3c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="4a">4a</label>
                                            <input type="number" class="form-control mb-1" id="tab2-4a" name="4a" placeholder="4a Max Marks" value="<?php echo $r1['4a'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-4a').value,'.tab2-4a')" />
                                            <label for="4b">4b</label>
                                            <input type="number" class="form-control mb-1" id="tab2-4b" name="4b" placeholder="4b Max Marks" value="<?php echo $r1['4b'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-4b').value,'.tab2-4b')" />
                                            <label for="4c">4c</label>
                                            <input type="number" class="form-control mb-1" id="tab2-4c" name="4c" placeholder="4c Max Marks" value="<?php echo $r1['4c'] ?? 0 ?>" onchange="tab2ia1(document.getElementById('tab2-4c').value,'.tab2-4c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">4a-co</label>
                                            <select type="number" class="form-control mb-1" name="4a-co" id="tab2-4a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['4a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['4a'];
                                                                } ?>">
                                                    <?php if ($rr1['4a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['4a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">4b-co</label>
                                            <select type="number" class="form-control mb-1" name="4b-co" id="tab2-4b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['4b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['4b'];
                                                                } ?>">
                                                    <?php if ($rr1['4b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['4b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">4c-co</label>
                                            <select type="number" class="form-control mb-1" name="4c-co" id="tab2-4c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr1['4c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr1['4c'];
                                                                } ?>">
                                                    <?php if ($rr1['4c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr1['4c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Save changes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>




            <div class="container">
                <div class="table-responsive-sm custom-table">
                    <table class="table" id="table2" style="width:max-content;">
                        <thead>
                            <tr>
                                <th></th>
                                <th scope="col" class="sticky-col first-col" style="width:140px ;">USN</th>
                                <th scope="col" style="width:160px ;">Name</th>
                                <th scope="col">1A</th>
                                <th scope="col">1B</th>
                                <th scope="col">1C</th>
                                <th scope="col">2A</th>
                                <th scope="col">2B</th>
                                <th scope="col">2C</th>
                                <th scope="col">3A</th>
                                <th scope="col">3B</th>
                                <th scope="col">3C</th>
                                <th scope="col">4A</th>
                                <th scope="col">4B</th>
                                <th scope="col">4C</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="ia_marks2_insert.php" method="post">
                                <?php foreach ($result1 as $r1) {
                                    $cc1++;
                                ?>
                                    <tr id="row2<?php echo $cc1; ?>">


                                        <td style="width:30px">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name='att[]' class="custom-control-input" <?php if ($r1['att'] == 1) { ?>checked<?php } ?> id="attendance2<?php echo $cc1; ?>" onclick="myFunction2()" value="<?php echo $r1["usn"] ?>" />
                                                <label class="custom-control-label" for="attendance2<?php echo $cc1; ?>"></label>
                                            </div>
                                        </td>

                                        <td class="sticky-col first-col">

                                            <input type="text" class="form-control mb-1" id="tab2-usn" name="usn<?php echo $cc1; ?>" readonly value="<?php echo $r1['usn']; ?>" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control mb-1" id="tab2-name" name="name<?php echo $cc1; ?>" readonly value="<?php echo $r1['name']; ?>" />
                                        </td>

                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-1a" value="<?php echo $r1['1a']; ?>" id="tab2-1a" <?php if (empty($r1['1a'])) { ?> placeholder="N/A" <?php } ?> name="1a<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-1b" value="<?php echo $r1['1b']; ?>" id="tab2-1b" <?php if (empty($r1['1b'])) { ?> placeholder="N/A" <?php } ?> name="1b<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-1c" value="<?php echo $r1['1c']; ?>" id="tab2-1c" <?php if (empty($r1['1c'])) { ?> placeholder="N/A" <?php } ?> name="1c<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-2a" value="<?php echo $r1['2a']; ?>" id="tab2-2a" <?php if (empty($r1['2a'])) { ?> placeholder="N/A" <?php } ?> name="2a<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-2b" value="<?php echo $r1['2b']; ?>" id="tab2-2b" <?php if (empty($r1['2b'])) { ?> placeholder="N/A" <?php } ?> name="2b<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-2c" value="<?php echo $r1['2c']; ?>" id="tab2-2c" <?php if (empty($r1['2c'])) { ?> placeholder="N/A" <?php } ?> name="2c<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-3a" value="<?php echo $r1['3a']; ?>" id="tab2-3a" <?php if (empty($r1['3a'])) { ?> placeholder="N/A" <?php } ?> name="3a<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-3b" value="<?php echo $r1['3b']; ?>" id="tab2-3b" <?php if (empty($r1['3b'])) { ?> placeholder="N/A" <?php } ?> name="3b<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-3c" value="<?php echo $r1['3c']; ?>" id="tab2-3c" <?php if (empty($r1['3c'])) { ?> placeholder="N/A" <?php } ?> name="3c<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-4a" value="<?php echo $r1['4a']; ?>" id="tab2-4a" <?php if (empty($r1['4a'])) { ?> placeholder="N/A" <?php } ?> name="4a<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-4b" value="<?php echo $r1['4b']; ?>" id="tab2-4b" <?php if (empty($r1['4b'])) { ?> placeholder="N/A" <?php } ?> name="4b<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" min="0" max="20" class="form-control tab2-4c" value="<?php echo $r1['4c']; ?>" id="tab2-4c" <?php if (empty($r1['4c'])) { ?> placeholder="N/A" <?php } ?> name="4c<?php echo $cc1; ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?> />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control tab1-total" name="total<?php echo $cc1; ?>" id="total" value="<?php echo $r1['total2'] ?>" <?php if ($r1['att'] == 0) { ?>readonly<?php } ?>>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                <?php } ?>
                                <button class="btn btn-info" type="submit" id="IA2_Form_submit_Btn" hidden>
                                    SUBMIT
                                </button>
                                <input type="text" name="cc1" value="<?php echo $cc1; ?>" hidden>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="ia3" role="tabpane3" aria-labelledby="ia3-tab">
            <br />
            <!-- contents of ia3 -->
            <div class="row">
                <div class="col col-4 col-md-4 col-lg-4">
                    <button class="btn btn-primary " data-toggle="modal" data-target="#modal3" type="button">
                        Set
                    </button>
                </div>
                <div class="col">
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalimport2">
                New Import
            </button> -->
                    <div class="modal fade" id="exampleModalimport2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Import Class Test3</h5>
                                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                        <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="../upload_ia_marks/ia3.php" method="post" enctype="multipart/form-data">
                                        <input type="file" class="form-control-file" name="xl" id="fileToUpload" accept=".xlsx">
                                        <!-- only xlsx files are accetped -->
                                        <input class="btn btn-primary" type="submit" value="Upload" name="submit">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-3 col-lg-3">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalimport2">
                        Import
                    </button> <button class="btn btn-success" style="margin-left:10px;" onclick="document.getElementById('IA3_Form_submit_Btn').click();"> Submit </button>
                </div>
            </div>

            <br />

            <!-- Modal -->
            <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="update_max3.php" method="post">
                    <?php $r2 = mysqli_fetch_assoc($result7);
                    $rr2 = mysqli_fetch_assoc($result10);
                    ?>
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Set Class Test-III Marks
                                </h5>
                                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                    <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="1a">1a</label>
                                            <input type="number" class="form-control mb-1" name="1a" id="tab3-1a" placeholder="1a Max Marks" value="<?php echo $r2['1a'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-1a').value,'.tab3-1a')" />
                                            <label for="1b">1b</label>
                                            <input type="number" class="form-control mb-1" name="1b" id="tab3-1b" placeholder="1b Max Marks" value="<?php echo $r2['1b'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-1b').value,'.tab3-1b')" />
                                            <label for="1c">1c</label>
                                            <input type="number" class="form-control mb-1" name="1c" id="tab3-1c" placeholder="1c Max Marks" value="<?php echo $r2['1c'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-1c').value,'.tab3-1c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">1a-co</label>
                                            <select type="number" class="form-control mb-1" name="1a-co" id="tab3-1a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['1a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['1a'];
                                                                } ?>">
                                                    <?php if ($rr2['1a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['1a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">1b-co</label>
                                            <select type="number" class="form-control mb-1" name="1b-co" id="tab3-1b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['1b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['1b'];
                                                                } ?>">
                                                    <?php if ($rr2['1b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['1b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">1c-co</label>
                                            <select type="number" class="form-control mb-1" name="1c-co" id="tab3-1c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['1c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['1c'];
                                                                } ?>">
                                                    <?php if ($rr2['1c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['1c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="2a">2a</label>
                                            <input type="number" class="form-control mb-1" id="tab3-2a" name="2a" placeholder="2a Max Marks" value="<?php echo $r2['2a'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-2a').value,'.tab3-2a')" />
                                            <label for="2b">2b</label>
                                            <input type="number" class="form-control mb-1" id="tab3-2b" name="2b" placeholder="2b Max Marks" value="<?php echo $r2['2b'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-2b').value,'.tab3-2b')" />
                                            <label for="2c">2c</label>
                                            <input type="number" class="form-control mb-1" id="tab3-2c" name="2c" placeholder="2c Max Marks" value="<?php echo $r2['2c'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-2c').value,'.tab3-2c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">2a-co</label>
                                            <select type="number" class="form-control mb-1" name="2a-co" id="tab3-2a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['2a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['2a'];
                                                                } ?>">
                                                    <?php if ($rr2['2a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['2a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">2b-co</label>
                                            <select type="number" class="form-control mb-1" name="2b-co" id="tab3-2b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['2b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['2b'];
                                                                } ?>">
                                                    <?php if ($rr2['2b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['2b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">2c-co</label>
                                            <select type="number" class="form-control mb-1" name="2c-co" id="tab3-2c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['2c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['2c'];
                                                                } ?>">
                                                    <?php if ($rr2['2c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['2c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                        <hr class="mt-2" />
                                        <div class="col-sm-3">
                                            <label for="3a">3a</label>
                                            <input type="number" class="form-control mb-1" id="tab3-3a" name="3a" placeholder="3a Max Marks" value="<?php echo $r2['3a'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-3a').value,'.tab3-3a')" />
                                            <label for="3b">3b</label>
                                            <input type="number" class="form-control mb-1" id="tab3-3b" name="3b" placeholder="3b Max Marks" value="<?php echo $r2['3b'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-3b').value,'.tab3-3b')" />
                                            <label for="3c">3c</label>
                                            <input type="number" class="form-control mb-1" id="tab3-3c" name="3c" placeholder="3c Max Marks" value="<?php echo $r2['3c'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-3c').value,'.tab3-3c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">3a-co</label>
                                            <select type="number" class="form-control mb-1" name="3a-co" id="tab3-3a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['3a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['3a'];
                                                                } ?>">
                                                    <?php if ($rr2['3a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['3a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">3b-co</label>
                                            <select type="number" class="form-control mb-1" name="3b-co" id="tab3-3b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['3b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['3b'];
                                                                } ?>">
                                                    <?php if ($rr2['3b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['3b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">3c-co</label>
                                            <select type="number" class="form-control mb-1" name="3c-co" id="tab3-4c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['3c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['3c'];
                                                                } ?>">
                                                    <?php if ($rr2['3c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['3c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="4a">4a</label>
                                            <input type="number" class="form-control mb-1" id="tab3-4a" name="4a" placeholder="4a Max Marks" value="<?php echo $r2['4a'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-4a').value,'.tab3-4a')" />
                                            <label for="4b">4b</label>
                                            <input type="number" class="form-control mb-1" id="tab3-4b" name="4b" placeholder="4b Max Marks" value="<?php echo $r2['4b'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-4b').value,'.tab3-4b')" />
                                            <label for="4c">4c</label>
                                            <input type="number" class="form-control mb-1" id="tab3-4c" name="4c" placeholder="4c Max Marks" value="<?php echo $r2['4c'] ?? 0 ?>" onchange="tab3ia1(document.getElementById('tab3-4c').value,'.tab3-4c')" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="1a-co">4a-co</label>
                                            <select type="number" class="form-control mb-1" name="4a-co" id="tab3-4a-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['4a'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['4a'];
                                                                } ?>">
                                                    <?php if ($rr2['4a'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['4a'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">4b-co</label>
                                            <select type="number" class="form-control mb-1" name="4b-co" id="tab3-4b-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['4b'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['4b'];
                                                                } ?>">
                                                    <?php if ($rr2['4b'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['4b'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                            <label for="1a">4c-co</label>
                                            <select type="number" class="form-control mb-1" name="4c-co" id="tab3-4c-co" placeholder="Co-1">
                                                <option value=none disabled>select CO</option>
                                                <option value="<?php if ($rr2['4c'] == 'none') {
                                                                    echo 'none';
                                                                } else {
                                                                    echo $rr2['4c'];
                                                                } ?>">
                                                    <?php if ($rr2['4c'] == 'none') {
                                                        echo 'N/A';
                                                    } else { ?>Co-<?php echo $rr2['4c'];
                                                                } ?>
                                                </option>
                                                <option value=1>Co-1</option>
                                                <option value=2>Co-2</option>
                                                <option value=3>Co-3</option>
                                                <option value=4>Co-4</option>
                                                <option value=5>Co-5</option>
                                                <option value=6>Co-6</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="table-responsive-sm custom-table">
        <table class="table" style="width:max-content;" id="table3">
            <thead>
                <tr>
                    <th></th>
                    <th scope="col" class="sticky-col first-col" style="width:140px ;">USN</th>
                    <th scope="col" style="width:160px ;">Name</th>
                    <th scope="col">1A</th>
                    <th scope="col">1B</th>
                    <th scope="col">1C</th>
                    <th scope="col">2A</th>
                    <th scope="col">2B</th>
                    <th scope="col">2C</th>
                    <th scope="col">3A</th>
                    <th scope="col">3B</th>
                    <th scope="col">3C</th>
                    <th scope="col">4A</th>
                    <th scope="col">4B</th>
                    <th scope="col">4C</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <form action="ia_marks3_insert.php" method="post">
                    <?php foreach ($result2 as $r2) {
                        $cc2++;
                    ?>
                        <tr id="row2<?php echo $cc2; ?>">

                            <td style="width:30px">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="att[]" class="custom-control-input" <?php if ($r2['att'] == 1) { ?>checked<?php } ?> id="attendance3<?php echo $cc2 ?>" onclick="myFunction3()" value="<?php echo $r2["usn"] ?>" />
                                    <label class="custom-control-label" for="attendance3<?php echo $cc2; ?>"></label>
                                </div>
                            </td>

                            <td class="sticky-col first-col">
                                <input type="text" class="form-control mb-1" id="tab3-usn" name="usn<?php echo $cc2; ?>" readonly value="<?php echo $r2['usn']; ?>" />
                            </td>
                            <td>
                                <input type="text" class="form-control mb-1" id="tab3-name" name="name<?php echo $cc2; ?>" readonly value="<?php echo $r2['name']; ?>" />
                            </td>

                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-1a" value="<?php echo $r2['1a']; ?>" id="tab3-1a" <?php if (empty($r2['1a'])) { ?> placeholder="N/A" <?php } ?> name="1a<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-1b" value="<?php echo $r2['1b']; ?>" id="tab3-1b" <?php if (empty($r2['1b'])) { ?> placeholder="N/A" <?php } ?> name="1b<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-1c" value="<?php echo $r2['1c']; ?>" id="tab3-1c" <?php if (empty($r2['1c'])) { ?> placeholder="N/A" <?php } ?> name="1c<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-2a" value="<?php echo $r2['2a']; ?>" id="tab3-2a" <?php if (empty($r2['2a'])) { ?> placeholder="N/A" <?php } ?> name="2a<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-2b" value="<?php echo $r2['2b']; ?>" id="tab3-2b" <?php if (empty($r2['2b'])) { ?> placeholder="N/A" <?php } ?> name="2b<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-2c" value="<?php echo $r2['2c']; ?>" id="tab3-2c" <?php if (empty($r2['2c'])) { ?> placeholder="N/A" <?php } ?> name="2c<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-3a" value="<?php echo $r2['3a']; ?>" id="tab3-3a" <?php if (empty($r2['3a'])) { ?> placeholder="N/A" <?php } ?> name="3a<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-3b" value="<?php echo $r2['3b']; ?>" id="tab3-3b" <?php if (empty($r2['3b'])) { ?> placeholder="N/A" <?php } ?> name="3b<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-3c" value="<?php echo $r2['3c']; ?>" id="tab3-3c" <?php if (empty($r2['3c'])) { ?> placeholder="N/A" <?php } ?> name="3c<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-4a" value="<?php echo $r2['4a']; ?>" id="tab3-4a" <?php if (empty($r2['4a'])) { ?> placeholder="N/A" <?php } ?> name="4a<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-4b" value="<?php echo $r2['4b']; ?>" id="tab3-4b" <?php if (empty($r2['4b'])) { ?> placeholder="N/A" <?php } ?> name="4b<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" min="0" max="20" class="form-control tab3-4c" value="<?php echo $r2['4c']; ?>" id="tab3-4c" <?php if (empty($r2['4c'])) { ?> placeholder="N/A" <?php } ?> name="4c<?php echo $cc2; ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?> />
                            </td>
                            <td>
                                <input type="number" class="form-control tab1-total" name="total<?php echo $cc2; ?>" id="total" value="<?php echo $r2['total3'] ?>" <?php if ($r2['att'] == 0) { ?>readonly<?php } ?>>
                            </td>
                            <td>
                            </td>
                        </tr>
                    <?php } ?>
                    <button class="btn btn-info" type="submit" id="IA3_Form_submit_Btn" hidden>
                        SUBMIT
                    </button>
                    <input type="text" name="cc2" id="" value="<?php echo $cc2; ?>" hidden>

                </form>
            </tbody>
        </table>
    </div>
</div>
</div>

<div class="tab-pane fade" id="cons" role="tabpane4" aria-labelledby="cons-tab">
    <br />
    <!-- content of ia2 -->


    <br />
    <!-- Modal -->
    <?php
    foreach ($result3 as $r3) {
        $total = $r3["total1"] + $r3["total2"] + $r3["total3"];
        if ($open == '1') {
            $q = "update marks set ia1=" . ($r3["total1"] ?? 0) . ",ia2=" . ($r3["total2"] ?? 0) . ",ia3=" . ($r3["total3"] ?? 0) . ",ia_total=" . $total . ",ia_avg=" . ceil($total / 3) . " where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\" and usn=\"" . $r3["usn"] . "\"";
        } else {
            $q = "update marks set ia1=" . ($r3["total1"] ?? 0) . ",ia2=" . ($r3["total2"] ?? 0) . ",ia3=" . ($r3["total3"] ?? 0) . ",ia_total=" . $total . ",ia_avg=" . ceil($total / 3) . " where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\" and usn=\"" . $r3["usn"] . "\"";
        }
        // echo $q;
        $result4 = $link->query($q);
    }
    ?>

    <div class="container">
        <div class="table-responsive-sm custom-table">
            <table class="table" style="width:max-content;" id="table2">
                <thead>
                    <tr>
                        <th></th>
                        <th scope="col" class="sticky-col first-col">USN</th>
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


                            <td style="width:30px">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" checked id="attendance4<?php echo $cc1; ?>" onclick="myFunction2()" />
                                    <label class="custom-control-label" for="attendance4<?php echo $cc1; ?>"></label>
                                </div>
                            </td>
                            <form action="ia_marks2_insert.php" method="post">
                                <td class="sticky-col first-col">

                                    <input type="text" class="form-control mb-1" id="tab2-usn" name="usn" readonly value="<?php echo $r3['usn']; ?>" />
                                </td>
                                <td>
                                    <input type="text" class="form-control mb-1" id="tab2-name" name="name" readonly value="<?php echo $r3['name']; ?>" />
                                </td>


                                <td>
                                    <input type="number" class="form-control mb-1" value="<?php echo $r3['total1']; ?>" id="ia1" name="ia1" />
                                </td>


                                <td>
                                    <input type="number" class="form-control mb-1" value="<?php echo $r3['total2']; ?>" id="ia2" name="ia2" />
                                </td>


                                <td>
                                    <input type="number" class="form-control mb-1" value="<?php echo $r3['total3']; ?>" id="ia3" name="ia3" />
                                </td>


                                <td>
                                    <input type="number" class="form-control tab1-total" name="average" id="average" value="<?php echo ceil(($r3["total1"] + $r3["total2"] + $r3["total3"]) / 3) ?>">
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

<div class="tab-pane fade" id="Extern" role="tabpane4" aria-labelledby="cons-tab">
    <br />
    <div class="container" style="text-align: -webkit-center;">
        <form action="external_insert.php" method="post">
            <input type="submit" value="Submit" class="btn btn-success mb-2" style="float: right;">
            <div class="table-responsive-sm custom-table" style="overflow-x: hidden; overflow-y: scroll;">

                <table class="table" style="width:100%;" id="table2">
                    <thead>
                        <tr>

                            <th scope="col" class="sticky-col first-col">USN</th>
                            <th scope="col">Name</th>

                            <th scope="col">External Marks</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        if ($open == '1') {
                            $q_ext = "select * from marks m, fac_elec_stud f where m.sem = \"" . $sem . "\" and m.sub = \"" . $sub . "\" and f.usn = m.usn and f.sub=m.sub order by m.usn";
                        } else {
                            $q_ext = "select * from marks where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\" order by usn";
                        }
                        $result_ext = $link->query($q_ext);
                        $c_ext = 0;
                        // print_r($result_ext);
                        foreach ($result_ext as $r_ext) {
                            $c_ext++;
                        ?>
                            <tr id="row2<?php echo $cc1; ?>">
                                <td class="sticky-col first-col">

                                    <input type="text" class="form-control mb-1" id="tab2-usn" name="usn<?php echo $c_ext ?>" readonly value="<?php echo $r_ext['usn']; ?>" />
                                </td>
                                <td>
                                    <input type="text" class="form-control mb-1" id="tab2-name" name="name<?php echo $c_ext ?>" readonly value="<?php echo $r_ext['name']; ?>" />
                                </td>


                                <td>
                                    <input type="number" class="form-control mb-1" value="<?php echo $r_ext['external']; ?>" id="ext_mark" min='0' max='60' name="ext_mark<?php echo $c_ext ?>" />
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <input type="text" name="count" id="" value="<?php echo $c_ext ?>" hidden>
                        <input type="text" name="sem" id="" value="<?php echo $sem ?>" hidden>
                        <input type="text" name="sec" id="" value="<?php echo $sec ?>" hidden>
                        <input type="text" name="sub" id="" value="<?php echo $sub ?>" hidden>

                    </tbody>
                </table>

        </form>
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
<a hidden href="<?php echo 'template_ia_'  . $branch . '.xlsx' ?>" download id="tempdown"></a>
<?php
$down = $_SESSION['temp_download'] ?? 0;
if ($down == 1) { ?>
    <script>
        document.getElementById('tempdown').click();
        <?php $_SESSION['temp_download'] = 0; ?>
    </script>
<?php
}
?>
</body>

</html>