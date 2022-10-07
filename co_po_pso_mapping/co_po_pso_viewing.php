<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
require_once "config.php";
error_reporting(0);

$result = $con->query('Select faculty_id, faculty_dept from faculty_details where faculty_name="' . $_SESSION["username"] . '"');
$res = mysqli_fetch_assoc($result);


$q2 = 'select * from dept_pso where dept_name = "' . $res["faculty_dept"] . '"';
$result2 = $con->query($q2);
$res2 = mysqli_fetch_assoc($result2);

$result5 = $con->query("select * from co_po");
$result6 = $con->query("select * from co_pso");

$flag_check1 = 0;
$flag_check2 = 0;
// echo $_SESSION["f_co"];
if ($_SESSION["f_co"] == 0) {
    $q1 = 'select * from co where faculty_id = "' . $res["faculty_id"] . '" and sub = "' . $_POST["sub"] . '"';
    $_SESSION["sub"] = $_POST["sub"];
    $set = $_POST["sub"];
    foreach ($result5 as $res5) {
        if ($res5["sub"] == $_POST["sub"] && $res5['faculty_id'] == $res['faculty_id'])
            $flag_check1 = 1;
    }
    foreach ($result6 as $res6) {
        if ($res6["sub"] == $_POST["sub"] && $res6['faculty_id'] == $res['faculty_id'])
            $flag_check2 = 1;
    }
    if (!$flag_check1) {
        // echo "in";
        for ($i = 1; $i <= 6; $i++) {
            // $qn = 'insert into co_po(`faculty_id`, `sub`, `co`, `po1`, `po2`, `po3`, `po4`, `po5`, `po6`, `po7`, `po8`, `po9`, `po10`, `po11`, `po12`) values("' . $res["faculty_id"] . '","' . $_POST["sub"] . '","co' . $i . '","0","0","0","0","0","0","0","0","0","0","0","0")';
            // echo $qn;
            $qn = 'insert into co_po(`faculty_id`, `sub`, `co`, `po1`, `po2`, `po3`, `po4`, `po5`, `po6`, `po7`, `po8`, `po9`, `po10`, `po11`, `po12`,`to_hod`) values("' . $res["faculty_id"] . '","' . $_POST["sub"] . '","co' . $i . '","0","0","0","0","0","0","0","0","0","0","0","0","none")';
            // echo $qn;
            $con->query($qn);
            // echo $qn;
        }
    }
    if (!$flag_check2) {
        for ($i = 1; $i <= 6; $i++) {
            $qn = 'insert into co_pso(`faculty_id`, `sub`, `co`, `pso1`, `pso2`, `pso3`, `pso4`, `pso5`, `to_hod`) values("' . $res["faculty_id"] . '","' . $_POST["sub"] . '","co' . $i . '","0","0","0","0","0","none")';
            $con->query($qn);
            // echo $qn;
        }
    }
} else {
    $q1 = 'select * from co where faculty_id = "' . $res["faculty_id"] . '" and sub = "' . $_SESSION["sub"] . '"';
    $set = $_SESSION["sub"];
    $_SESSION["f_co"] = 1;
}
// echo $q1;
$result1 = $con->query($q1);
$res1 = mysqli_fetch_assoc($result1);
// print_r($result1);
$sub = $_POST['sub'] ?? $_SESSION['sub'];
$_SESSION['sub'] = $sub;
if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
    $q_lab = 'select * from subjects where sub_code = "' . explode(' - ', $sub)[0] . '" and branch = "' . $res['faculty_dept'] . '"';

}
else{

    $q_lab = 'select * from subjects_new where sub_code = "' . explode(' - ', $sub)[0] . '" and branch = "' . $res['faculty_dept'] . '"';
}
try{
    $r_lab = mysqli_fetch_assoc($link->query($q_lab))['sub_id'];
}
catch(Exception $e){
    $r_lab = 'none';
}
// echo $r_lab;
// echo $q_lab;
// echo $q1;

?>
<style>
    #co_po {
        background: white;
        color: #7386D5;
    }

    .select {
        position: relative;
        min-width: 50px;
        max-width: 200px;
    }

    .select svg {
        position: absolute;
        right: 12px;
        top: calc(50% - 3px);
        width: 10px;
        height: 6px;
        stroke-width: 2px;
        stroke: #9098a9;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        pointer-events: none;
    }

    .select select {
        -webkit-appearance: none;
        padding: 7px 40px 7px 12px;
        width: 100%;
        border: 1px solid #e8eaed;
        border-radius: 5px;
        background: #fff;
        box-shadow: 0 1px 3px -2px #9098a9;
        cursor: pointer;
        font-family: inherit;
        font-size: 16px;
        transition: all 150ms ease;
    }

    .select select:required:invalid {
        color: #5a667f;
    }

    .select select option {
        color: #223254;
    }

    .select select option[value=""][disabled] {
        display: none;
    }

    .select select:focus {
        outline: none;
        border-color: #07f;
        box-shadow: 0 0 0 2px rgba(0, 119, 255, 0.2);
    }

    .select select:hover+svg {
        stroke: #07f;
    }

    .sprites {
        position: absolute;
        width: 0;
        height: 0;
        pointer-events: none;
        user-select: none;
    }
</style>
<h4 class="">Subject: <?php echo $set; ?></h4>
<div class="container-fluid">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">CO</a>
            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">PO</a>
            <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">PSO</a>
            <a class="nav-link" id="nav-co-po-tab" data-toggle="tab" href="#nav-co-po" role="tab" aria-controls="nav-co-po" aria-selected="false">CO-PO</a>
            <a class="nav-link" id="nav-co-pso-tab" data-toggle="tab" href="#nav-co-pso" role="tab" aria-controls="nav-co-pso" aria-selected="false">CO-PSO</a>

        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <?php
            if ($r_lab == 3) {
            ?>
                <form action="co_lab.php" method="POST">
                <?php } ?>
                <div class="container">
                    <div class="row mt-5">
                        <div class="col col-1 col-md-1 col-lg-1 ">
                            <h5 class="mt-1">CO1:</h5>
                        </div>
                        <div class="col col-10 col-md-10 col-lg-10">
                            <textarea type="text" <?php if ($r_lab != 3) {
                                                        echo "readonly";
                                                    } ?> name="co1" class="form-control"><?php if (empty($res1["co1"])) echo "N/A";
                                                                                            else echo $res1["co1"]; ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col col-1 col-md-1 col-lg-1 ">
                            <h5 class="mt-1">CO2:</h5>
                        </div>
                        <div class="col col-10 col-md-10 col-lg-10">
                            <textarea type="text" <?php if ($r_lab != 3) {
                                                        echo "readonly";
                                                    } ?> name="co2" class="form-control"><?php if (empty($res1["co2"])) echo "N/A";
                                                                                            else echo $res1["co2"]; ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col col-1 col-md-1 col-lg-1 ">
                            <h5 class="mt-1">CO3:</h5>
                        </div>
                        <div class="col col-10 col-md-10 col-lg-10">
                            <textarea type="text" <?php if ($r_lab != 3) {
                                                        echo "readonly";
                                                    } ?> name="co3" class="form-control"><?php if (empty($res1["co3"])) echo "N/A";
                                                                                            else echo $res1["co3"]; ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col col-1 col-md-1 col-lg-1 ">
                            <h5 class="mt-1">CO4:</h5>
                        </div>
                        <div class="col col-10 col-md-10 col-lg-10">
                            <textarea type="text" <?php if ($r_lab != 3) {
                                                        echo "readonly";
                                                    } ?> name="co4" class="form-control"><?php if (empty($res1["co4"])) echo "N/A";
                                                                                            else echo $res1["co4"]; ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col col-1 col-md-1 col-lg-1 ">
                            <h5 class="mt-1">CO5:</h5>
                        </div>
                        <div class="col col-10 col-md-10 col-lg-10">
                            <textarea type="text" <?php if ($r_lab != 3) {
                                                        echo "readonly";
                                                    } ?> name="co5" class="form-control"><?php if (empty($res1["co5"])) echo "N/A";
                                                                                            else echo $res1["co5"]; ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col col-1 col-md-1 col-lg-1 ">
                            <h5 class="mt-1">CO6:</h5>
                        </div>
                        <div class="col col-10 col-md-10 col-lg-10">
                            <textarea type="text" <?php if ($r_lab != 3) {
                                                        echo "readonly";
                                                    } ?> name="co6" class="form-control"><?php if (empty($res1["co6"])) echo "N/A";
                                                                                            else echo $res1["co6"]; ?></textarea>
                        </div>
                    </div>


                </div>
                <?php
                if ($r_lab == 3) {
                ?>
                    <input type="text" name="fac_id" id="" value="<?php echo $res['faculty_id'] ?>" hidden>
                    <input type="text" name="branch" id="" value="<?php echo $res['faculty_dept'] ?>" hidden>
                    <input type="text" name="sub" id="" value="<?php echo $res1['sub'] ?>" hidden>
                    <button class="btn btn-info">Submit</button>
                </form>
            <?php } ?>

        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="container">

                <div class="row mt-5">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO1:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po1" class="form-control">Engineering knowledge: Apply the knowledge of mathematics, science, Engineering fundamentals and an engineering specialization to the solution of complex engineering problems.</textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO2:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po2" class="form-control">Problem analysis: Identify, formulate, review research literature, and analyze complex engineering problems reaching substantiated conclusions using first principles of mathematics, natural sciences and engineering sciences.</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO3:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po3" class="form-control">Design/development of solutions: Design solutions for complex engineering problems and design system components or processes that meet the specified needs with appropriate consideration for the public health and safety, and the cultural, societal and environmental considerations.</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO4:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po4" class="form-control">Conduct investigations of complex problems: Use research-based knowledge and research methods including design of experiments, analysis and interpretation of data, and synthesis of the information to provide valid conclusions.</textarea>
                    </div>
                </div>



                <div class="row mt-3">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO5:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po6" class="form-control">Modern tool usage: Create, select, and apply appropriate techniques, resources, and modern engineering and IT tools including prediction and modeling to complex engineering activities with an understanding of the limitations.</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO6:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po7" class="form-control">The engineer and society: Apply reasoning informed by the contextual knowledge to assess societal, health, safety, legal and cultural issue the consequent responsibilities relevant to the professional engineering practice.</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO7:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po8" class="form-control">Environment and sustainability: Understand the impact of the professional engineering solutions in societal and environmental contexts and demonstrate the knowledge of, and need for sustainable development</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO8:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po9" class="form-control">Ethics: Apply ethical principles and commit to professional ethics and responsibilities and norms of the engineering practice.</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO9:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po10" class="form-control">Individual and team work: Function effectively as an individual, and as member or leader in diverse teams, and in multidisciplinary settings.</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO10:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po1" class="form-control">Communication: Communicate effectively on complex engineering activities with the engineering community and with society at large, such as, being able to comprehend and write effective reports and design documentation, make effective presentations, and give and receive clear instructions.</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO11:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po11" class="form-control">Project management and finance: Demonstrate knowledge and understanding of the engineering and management principles and apply these to one's own work, as a member and leader in a team, to manage projects and in  multidisciplinary environments.</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col col-1 col-md-1 col-lg-1">
                        <h6 class="mt-2" style="text-align: center;">PO12:</h6>
                    </div>
                    <div class="col col-10 col-md-10 col-lg-10">
                        <textarea type="text" readonly name="po12" class="form-control"> Life-long learning: Recognize the need for, and have the preparation and ability to engage in independent and life-long learning in the broadest context of technological change.</textarea>
                    </div>
                </div>

            </div>
        </div>



        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="container">
                <?php
                $c_c = count($res2) - 1;

                for ($i = 1; $i < $c_c; $i++) {
                ?>
                    <div class="row mt-5">
                        <div class="col col-1 col-md-1 col-lg-1">
                            <h5 class="mt-1" style="text-align: center;">PSO<?php echo $i ?>:</h5>
                        </div>
                        <div class="col col-9 col-md-9 col-lg-9">
                            <textarea type="text" name="pso" class="form-control" readonly><?php if (!empty($res2["pso" . $i])) echo $res2["pso" . $i];
                                                                                            else echo "N/A";  ?>
                    </textarea>
                        </div>


                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-co-po" role="tabpanel" aria-labelledby="nav-co-po-tab">

            <div class="table-responsive mb-3" style="overflow-x:scroll; width:75vw !important; justify-content: center;">

                <table class="table table-striped mt-3" style="width: max-content !important;">
                    <thead>
                        <tr class="">
                            <th scope="col"></th>
                            <th scope="col" style="width: 9%;">PO1</th>
                            <th scope="col" style="width: 9%;">PO2</th>
                            <th scope="col" style="width: 9%;">PO3</th>
                            <th scope="col" style="width: 9%;">PO4</th>
                            <th scope="col" style="width: 9%;">PO5</th>
                            <th scope="col" style="width: 9%;">PO6</th>
                            <th scope="col" style="width: 9%;">PO7</th>
                            <th scope="col" style="width: 9%;">PO8</th>
                            <th scope="col" style="width: 9%;">PO9</th>
                            <th scope="col" style="width: 9%;">PO10</th>
                            <th scope="col" style="width: 9%;">PO11</th>
                            <th scope="col" style="width: 9%;">PO12</th>

                        </tr>
                    </thead>
                    <tbody>
                        <form action="update.php" id="<?php echo $i ?>" method="POST">
                            <?php
                            for ($i = 1; $i <= 6; $i++) {
                                $dd = $con->query('Select * from co_po where faculty_id = "' . $res["faculty_id"] . '" and sub = "' . $_SESSION["sub"] . '" and co = "co' . $i . '"');
                                $res7 = mysqli_fetch_assoc($dd);
                            ?>
                                <tr>

                                    <th scope="row">CO<?php echo $i ?></th>
                                    <input type="text" value="co<?php echo $i ?>" name="co<?php echo $i ?>" hidden>
                                    <td>

                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po1<?php echo $i ?>">
                                                <option><?php if ($res7["po1"] == "0") echo "N/A";
                                                        else echo $res7["po1"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>
                                    <td>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po2<?php echo $i ?>">
                                                <option><?php if ($res7["po2"] == "0") echo "N/A";
                                                        else echo $res7["po2"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>
                                    <td>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po3<?php echo $i ?>">
                                                <option><?php if ($res7["po3"] == "0") echo "N/A";
                                                        else echo $res7["po3"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>
                                    <td>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po4<?php echo $i ?>">
                                                <option><?php if ($res7["po4"] == "0") echo "N/A";
                                                        else echo $res7["po4"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>
                                    <td>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po5<?php echo $i ?>">
                                                <option><?php if ($res7["po5"] == "0") echo "N/A";
                                                        else echo $res7["po5"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>
                                    <td>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po6<?php echo $i ?>">
                                                <option><?php if ($res7["po6"] == "0") echo "N/A";
                                                        else echo $res7["po6"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>
                                    <td>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po7<?php echo $i ?>">
                                                <option><?php if ($res7["po7"] == "0") echo "N/A";
                                                        else echo $res7["po7"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>
                                    <td>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po8<?php echo $i ?>">
                                                <option><?php if ($res7["po8"] == "0") echo "N/A";
                                                        else echo $res7["po8"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>
                                    <td>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po9<?php echo $i ?>">
                                                <option><?php if ($res7["po9"] == "0") echo "N/A";
                                                        else echo $res7["po9"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>
                                    <td>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po10<?php echo $i ?>">
                                                <option><?php if ($res7["po10"] == "0") echo "N/A";
                                                        else echo $res7["po10"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>
                                    <td>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po11<?php echo $i ?>">
                                                <option><?php if ($res7["po11"] == "0") echo "N/A";
                                                        else echo $res7["po11"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>
                                    <td>
                                        <label class="select" for="slct">
                                            <select id="slct" required="required" name="po12<?php echo $i ?>">
                                                <option><?php if ($res7["po12"] == "0") echo "N/A";
                                                        else echo $res7["po12"]; ?></option>
                                                <option value="N/A">N/A</option>
                                                <option value="Low">Low</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="High">High</option>

                                            </select>
                                            <svg>
                                                <use xlink:href="#select-arrow-down"></use>
                                            </svg>
                                        </label>

                                        <svg class="sprites">
                                            <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                                <polyline points="1 1 5 5 9 1"></polyline>
                                            </symbol>
                                        </svg>
                                    </td>


                                </tr>


                            <?php } ?>


                    </tbody>
                </table>

            </div>

            <input type="text" name="fac_id" value="<?php echo $res["faculty_id"] ?>" hidden>
            <input type="text" name="sub" value="<?php echo $_SESSION["sub"] ?>" hidden>


            <div class="row">
                <div class="col col-3 col-md-3 col-lg-3">
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
                </form>
                <div class="col col-5 col-md-5 col-lg-5"></div>

                <div class="col col-3 col-md-3 col-lg-3">
                    <form action="hod_approve.php" method="post">
                        <input type="text" name="fac_id" hidden value="<?php echo $res["faculty_id"] ?>">
                        <input type="text" name="p" value="po" hidden>
                        <input type="text" name="sub" id="" value="<?php echo $_SESSION["sub"] ?>" hidden>
                        <select name="hod_select" class="form-control">
                            <option selected disabled>Select HOD</option>
                            <?php $hh = $con->query("select * from hod");
                            foreach ($hh as $h) {
                            ?>
                                <option value="<?php echo $h["name"] ?>"><?php echo $h["name"] ?></option>
                            <?php } ?>
                        </select>
                </div>
                <div class="col col-1 col-md-1 col-lg-1">
                    <button class="btn btn-info">Send</button>
                    </form>
                </div>
            </div>

            <div class="row mt-4 ">
                <div class="col col-10 col-md-10 col-lg-10">
                </div>
                <div class="col col-4 col-md-4 col-lg-4">
                    <?php

                    $qh = 'select * from co_po where faculty_id = "' . $res["faculty_id"] . '" and sub = "' . $_SESSION["sub"] . '"';
                    //   echo $qh;
                    $hho = $con->query($qh);
                    $h1 = mysqli_fetch_assoc($hho);

                    if (!empty($h1['approval']) && $h1['approval'] == "waiting") {
                    ?>
                        <p style="font-weight: 400;">Sent Approval To: <span style="font-weight:600;"> <?php echo $h1["to_hod"] ?> </span></p>
                    <?php }
                    if (!empty($h1['approval']) && $h1['approval'] == "approved") {
                    ?>
                        <p style="font-weight: 400;">Approved By: <?php echo $h1["to_hod"] ?></p>
                    <?php }
                    if (!empty($h1['approval']) && $h1['approval'] == "rejected") {
                    ?>
                        <p style="font-weight: 400;">Rejected By: <?php echo $h1["to_hod"] ?></p>
                    <?php } ?>

                </div>

            </div>

        </div>
        <div class="tab-pane fade" id="nav-co-pso" role="tabpanel" aria-labelledby="nav-co-pso-tab">
            <table class="table table-sm table-striped mt-3">
                <thead>
                    <tr class="">
                        <th scope="col"></th>
                        <th scope="col">PSO1</th>
                        <th scope="col">PSO2</th>
                        <th scope="col">PSO3</th>
                        <th scope="col">PSO4</th>
                        <th scope="col">PSO5</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <form action="update_pso.php" id="<?php echo $j ?>" method="post">
                        <?php
                        for ($j = 1; $j <= 6; $j++) {
                            $dd = $con->query('Select * from co_pso where faculty_id = "' . $res["faculty_id"] . '" and sub = "' . $_SESSION["sub"] . '" and co = "co' . $j . '"');
                            $res7 = mysqli_fetch_assoc($dd);
                        ?>

                            <tr>
                                <th scope="row">CO<?php echo $j ?></th>
                                <input type="text" value="co<?php echo $j ?>" name="co<?php echo $j ?>" hidden>
                                <td>
                                    <label class="select" for="slct">
                                        <select id="slct" required="required" name="pso1<?php echo $j ?>">
                                            <option><?php if ($res7["pso1"] == "0") echo "N/A";
                                                    else echo $res7["pso1"]; ?></option>
                                            <option value="N/A">N/A</option>
                                            <option value="Low">Low</option>
                                            <option value="Moderate">Moderate</option>
                                            <option value="High">High</option>

                                        </select>
                                        <svg>
                                            <use xlink:href="#select-arrow-down"></use>
                                        </svg>
                                    </label>

                                    <svg class="sprites">
                                        <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                            <polyline points="1 1 5 5 9 1"></polyline>
                                        </symbol>
                                    </svg>
                                </td>
                                <td>
                                    <label class="select" for="slct">
                                        <select id="slct" required="required" name="pso2<?php echo $j ?>">
                                            <option><?php if ($res7["pso2"] == "0") echo "N/A";
                                                    else echo $res7["pso2"]; ?></option>
                                            <option value="N/A">N/A</option>
                                            <option value="Low">Low</option>
                                            <option value="Moderate">Moderate</option>
                                            <option value="High">High</option>

                                        </select>
                                        <svg>
                                            <use xlink:href="#select-arrow-down"></use>
                                        </svg>
                                    </label>

                                    <svg class="sprites">
                                        <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                            <polyline points="1 1 5 5 9 1"></polyline>
                                        </symbol>
                                    </svg>
                                </td>
                                <td>
                                    <label class="select" for="slct">
                                        <select id="slct" required="required" name="pso3<?php echo $j ?>">
                                            <option><?php if ($res7["pso3"] == "0") echo "N/A";
                                                    else echo $res7["pso3"]; ?></option>
                                            <option value="N/A">N/A</option>
                                            <option value="Low">Low</option>
                                            <option value="Moderate">Moderate</option>
                                            <option value="High">High</option>

                                        </select>
                                        <svg>
                                            <use xlink:href="#select-arrow-down"></use>
                                        </svg>
                                    </label>

                                    <svg class="sprites">
                                        <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                            <polyline points="1 1 5 5 9 1"></polyline>
                                        </symbol>
                                    </svg>
                                </td>
                                <td>
                                    <label class="select" for="slct">
                                        <select id="slct" required="required" name="pso4<?php echo $j ?>">
                                            <option><?php if ($res7["pso4"] == "0") echo "N/A";
                                                    else echo $res7["pso4"]; ?></option>
                                            <option value="N/A">N/A</option>
                                            <option value="Low">Low</option>
                                            <option value="Moderate">Moderate</option>
                                            <option value="High">High</option>

                                        </select>
                                        <svg>
                                            <use xlink:href="#select-arrow-down"></use>
                                        </svg>
                                    </label>

                                    <svg class="sprites">
                                        <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                            <polyline points="1 1 5 5 9 1"></polyline>
                                        </symbol>
                                    </svg>
                                </td>
                                <td>
                                    <label class="select" for="slct">
                                        <select id="slct" required="required" name="pso5<?php echo $j ?>">
                                            <option><?php if ($res7["pso5"] == "0") echo "N/A";
                                                    else echo $res7["pso5"]; ?></option>
                                            <option value="N/A">N/A</option>
                                            <option value="Low">Low</option>
                                            <option value="Moderate">Moderate</option>
                                            <option value="High">High</option>

                                        </select>
                                        <svg>
                                            <use xlink:href="#select-arrow-down"></use>
                                        </svg>
                                    </label>

                                    <svg class="sprites">
                                        <symbol id="select-arrow-down" viewbox="0 0 10 6">
                                            <polyline points="1 1 5 5 9 1"></polyline>
                                        </symbol>
                                    </svg>
                                </td>



                            </tr>

                        <?php } ?>
                </tbody>
            </table>
            <input type="text" name="fac_id" value="<?php echo $res["faculty_id"] ?>" hidden>
            <input type="text" name="sub" value="<?php echo $_SESSION["sub"] ?>" hidden>
            <div class="row">
                <div class="col col-3 col-md-3 col-lg-3">
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
                </form>
                <div class="col col-5 col-md-5 col-lg-5"></div>

                <div class="col col-3 col-md-3 col-lg-3">
                    <form action="hod_approve.php" method="post">
                        <input type="text" name="fac_id" hidden value="<?php echo $res["faculty_id"] ?>">
                        <input type="text" name="sub" id="" value="<?php echo $_SESSION["sub"] ?>" hidden>
                        <input type="text" name="p" value="pso" hidden>
                        <select name="hod_select" class="form-control">
                            <option selected disabled>Select HOD</option>
                            <?php $hh1 = $con->query("select * from hod");
                            foreach ($hh1 as $h11) {
                            ?>
                                <option value="<?php echo $h11["name"] ?>"><?php echo $h11["name"] ?></option>
                            <?php } ?>
                        </select>
                </div>
                <div class="col col-1 col-md-1 col-lg-1">
                    <button class="btn btn-info">Send</button>
                    </form>
                </div>
            </div>

            <div class="row mt-4 ">
                <div class="col col-10 col-md-10 col-lg-10">
                </div>
                <div class="col col-4 col-md-4 col-lg-4">
                    <?php

                    $qh1 = 'select * from co_pso where faculty_id = "' . $res["faculty_id"] . '" and sub = "' . $_SESSION["sub"] . '"';
                    //   echo $qh;
                    $hho1 = $con->query($qh1);
                    $h112 = mysqli_fetch_assoc($hho1);
                    if ($h112['approval'] == "waiting") {
                    ?>
                        <p style="font-weight: 400;">Sent Approval To: <span style="font-weight:600;"> <?php echo $h112["to_hod"] ?> </span></p>
                    <?php }
                    if ($h112['approval'] == "approved") {
                    ?>
                        <p style="font-weight: 400;">Approved By: <?php echo $h112["to_hod"] ?></p>
                    <?php } ?>
                </div>

            </div>
        </div>


        <?php




        include "../template/footer-fac.php" ?>