<?php
include("../template/fac-auth.php");
error_reporting(0);
include("../template/sidebar-fac.php");
?>

<!--  -->

</div>
<?php
$q_cse = 'SELECT * FROM `faculty_details` WHERE faculty_dept="Computer Science and Engineering"';
$r_cse = $link->query($q_cse);

$q_ise = 'SELECT * FROM `faculty_details` WHERE faculty_dept="Information Science and Engineering"';
$r_ise = $link->query($q_ise);

$q_ese = 'SELECT * FROM `faculty_details` WHERE faculty_dept="Electronics and Communication Engineering"';
$r_ese = $link->query($q_ese);

$q_mech = 'SELECT * FROM `faculty_details` WHERE faculty_dept="Mechanical Engineering"';
$r_mech = $link->query($q_mech);

$q_civ = 'SELECT * FROM `faculty_details` WHERE faculty_dept="Civil Engineering"';
$r_civ = $link->query($q_civ);

$q_mat = 'SELECT * FROM `faculty_details` WHERE faculty_dept="MATHEMATICS"';
$r_mat = $link->query($q_mat);

$q_phy = 'SELECT * FROM `faculty_details` WHERE faculty_dept="PHYSICS"';
$r_phy = $link->query($q_phy);

$q_ai = 'SELECT * FROM `faculty_details` WHERE faculty_dept="Artificial Intelligence and machine Learning"';
$r_ai = $link->query($q_ai);

?>

<div>
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Computer Science and Engineering
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <?php foreach ($r_cse as $r) { ?>
                            <li><a href="fac_view.php?fac_id=<?php echo $r['faculty_id'] ?>"><?php echo $r['faculty_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Information Science and Engineering
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <?php foreach ($r_ise as $r) { ?>
                            <li><a href="fac_view.php?fac_id=<?php echo $r['faculty_id'] ?>"><?php echo $r['faculty_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Electronics and Communication Engineering
                    </button>
                </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <?php foreach ($r_ese as $r) { ?>
                            <li><a href="fac_view.php?fac_id=<?php echo $r['faculty_id'] ?>"><?php echo $r['faculty_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                    <button class="btn text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        Mechanical Engineering
                    </button>
                </h2>
            </div>

            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <?php foreach ($r_mech as $r) { ?>
                            <li><a href="fac_view.php?fac_id=<?php echo $r['faculty_id'] ?>"><?php echo $r['faculty_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                    <button class="btn text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                        Civil Engineering
                    </button>
                </h2>
            </div>

            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <?php foreach ($r_civ as $r) { ?>
                            <li><a href="fac_view.php?fac_id=<?php echo $r['faculty_id'] ?>"><?php echo $r['faculty_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingSix">
                <h2 class="mb-0">
                    <button class="btn text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                        MATHEMATICS
                    </button>
                </h2>
            </div>

            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <?php foreach ($r_mat as $r) { ?>
                            <li><a href="fac_view.php?fac_id=<?php echo $r['faculty_id'] ?>"><?php echo $r['faculty_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingSeven">
                <h2 class="mb-0">
                    <button class="btn text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                        Artificial Intelligence and machine Learning
                    </button>
                </h2>
            </div>

            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <?php foreach ($r_ai as $r) { ?>
                            <li><a href="fac_view.php?fac_id=<?php echo $r['faculty_id'] ?>"><?php echo $r['faculty_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingEight">
                <h2 class="mb-0">
                    <button class="btn text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                        PHYSICS
                    </button>
                </h2>
            </div>

            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <?php foreach ($r_phy as $r) { ?>
                            <li><a href="fac_view.php?fac_id=<?php echo $r['faculty_id'] ?>"><?php echo $r['faculty_name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>








<?php
include("../template/footer-fac.php")

?>