<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
error_reporting(0);
require_once '../config.php';
?>

<!-- page content start -->
<div>

    <div class="container">
        <?php
        $con = $link;
        $paper_id = $_POST["paper_id"];
        $faculty_id = $_POST["faculty_id"];

        $faculty_ppr_typed = $_POST['faculty_ppr_type'];
        $faculty_ppr_year = $_POST['faculty_ppr_year'];
        $faculty_ppr_title = $_POST['faculty_ppr_title'];
        $faculty_ppr_jourrnal = $_POST['faculty_ppr_jourrnal'];
        $faculty_ppr_pub_date = $_POST['faculty_ppr_pub_date'];
        $faculty_ppr_volume = $_POST['faculty_ppr_volume'];
        $faculty_ppr_issue = $_POST['faculty_ppr_issue'];
        $faculty_ppr_issn = $_POST['faculty_ppr_issn'];
        ?>

        <form action="faculty_ppr_update.php" method="POST">

            <input type="text" name="paper_id" id="paper_id" hidden value=<?php echo $paper_id ?> >
            <div class="form-row form-inline mb-4 ">
                <div class="col-auto">
                    <label for="faculty_id" class="col-form-label">Faculty ID :</label>
                </div>
                <div class="col-auto">
                    <input type="text" name="faculty_id" id="faculty_id" class="form-control" required value="<?php echo $faculty_id ?>" readonly>
                </div>
            </div>
            <div class="form-row mb-4">
                <div class=" col-auto">
                    <label for="faculty_ppr_type" class="col-form-label">Choose type:</label>
                </div>
                <div class="col-auto">
                    <select name="faculty_ppr_type" id="faculty_ppr_type" class="form-select">
                        <option value="" selected><?php echo $faculty_ppr_typed ?></option>
                        <option value="National conference">National conference</option>
                        <option value="National journal">National journal</option>
                        <option value="international journal">international journal</option>
                        <option value="International conference">International conference</option>
                    </select>
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col-auto">
                    <label for="faculty_ppr_year" class="col-form-label">Acedemic year :</label>
                </div>
                <div class="col-auto">
                    <input type="text" name="faculty_ppr_year" id="faculty_ppr_year" class="form-control" value="<?php echo $faculty_ppr_year ?>">
                </div>
            </div>
            <div class="form-row mb-4 mb-4">
                <div class="form-group col-md-4 mb-4">
                    <label for="faculty_ppr_title">Title of the Paper :</label>
                    <input type="text" name="faculty_ppr_title" class="form-control" id="faculty_ppr_title" value="<?php echo $faculty_ppr_title ?>" value="<?php echo $row['faculty_ppr_title'] ?>">
                </div>
                <div class="form-group col-md-4 mb-4">
                    <label for="faculty_ppr_jourrnal">Name of the Journal/Conference :</label>
                    <input type="text" name="faculty_ppr_jourrnal" class="form-control" id="faculty_ppr_jourrnal" value="<?php echo $faculty_ppr_jourrnal ?>">
                </div>
                <div class="form-group col-md-4 mb-4">
                    <label for="faculty_ppr_pub_date">Date of Publication :</label>
                    <input type="text" name="faculty_ppr_pub_date" class="form-control" id="faculty_ppr_pub_date" value="<?php echo $faculty_ppr_pub_date ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4 mb-4">
                    <label for="faculty_ppr_volume">Volume :</label>
                    <input type="text" name="faculty_ppr_volume" class="form-control" id="faculty_ppr_volume" value="<?php echo $faculty_ppr_volume ?>">
                </div>
                <div class="form-group col-md-4 mb-4">
                    <label for="faculty_ppr_issue">Issue :</label>
                    <input type="text" name="faculty_ppr_issue" class="form-control" id="faculty_ppr_issue" value="<?php echo $faculty_ppr_issue ?>">
                </div>
                <div class="form-group col-md-4 mb-4">
                    <label for="faculty_ppr_issn">ISSN no. :</label>
                    <input type="text" name="faculty_ppr_issn" class="form-control" id="faculty_ppr_issn" value="<?php echo $faculty_ppr_issn ?>">
                </div>
            </div>
            <button type="submit" value="Submit" class="btn btn-primary">Update</button>
        </form>

    </div>
</div>

<?php include("../template/footer-fac.php") ?>