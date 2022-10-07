<?php
    include("../template/fac-auth.php");
    include("../template/sidebar-fac.php");
error_reporting(0);
require_once "../config.php";
    // $con = $link;
    $sem = $_SESSION["sem"];
    $subid = $_SESSION["subid"];
    $sec = $_SESSION["sec"];
    ?>
    <div class="container-fluid">
        <form action="update.php" method="POST">
            <div class="row">
                <div class="col col-4 col-md-4 col-lg-4">
                    <label for="sem">Semester</label>
                    <h4 id="sem">
                        <?php echo $_POST["sem"]  ?>
                    </h4>
                </div>
                <div class="col col-3 col-md-3 col-lg-3">
                    <label for="sec">Section</label>
                    <h4 id="sec">
                        <?php echo $_POST["sec"]  ?>
                    </h4>
                </div>
                <div class="col col-4 col-md-4 col-lg-4">
                    <label for="sub">Subject</label>
                    <h4 id="sub">
                        <?php echo $_POST["subid"]?>
                    </h4>

                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#clone">
                        Clone
                    </button>
                </div>
            </div>







        </form>
    </div>




