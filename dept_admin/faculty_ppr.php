<?php
require_once "../config.php";
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
                                                                                    error_reporting(0);

?>

        <!-- page content start -->
        <div>

            <div class="container">
                <form action="faculty_ppr_data.php" method="POST">
                    <div class="form-row form-inline mb-4 ">
                        <div class="col-auto">
                            <label for="faculty_id" class="col-form-label" value="<?php echo $_SESSION["faculty_id"] ?>">Faculty ID :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" name="faculty_id" id="faculty_id" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row form-inline mb-4 ">
                        <div class=" col-auto">
                            <label for="faculty_ppr_type" class="col-form-label">Choose type:</label>
                        </div>
                        <div class="col-auto ">
                            <select name="faculty_ppr_type" id="faculty_ppr_type" class="form-control">
                                <option>select conference</option>
                                <option value="1">National conference</option>
                                <option value="2">National journal</option>
                                <option value="3">international journal</option>
                                <option value="4">International conference</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="col-auto">
                            <label for="faculty_ppr_year" class="col-form-label">Acedemic year :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" name="faculty_ppr_year" id="faculty_ppr_year" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="faculty_ppr_title">Title of the Paper :</label>
                            <input type="text" name="faculty_ppr_title" class="form-control" id="faculty_ppr_title">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="faculty_ppr_jourrnal">Name of the Journal/Conference :</label>
                            <input type="text" name="faculty_ppr_jourrnal" class="form-control" id="faculty_ppr_jourrnal">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="faculty_ppr_pub_date">Date of Publication :</label>
                            <input type="text" name="faculty_ppr_pub_date" class="form-control" id="faculty_ppr_pub_date">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="faculty_ppr_volume">Volume :</label>
                            <input type="text" name="faculty_ppr_volume" class="form-control" id="faculty_ppr_volume">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="faculty_ppr_issue">Issue :</label>
                            <input type="text" name="faculty_ppr_issue" class="form-control" id="faculty_ppr_issue">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="faculty_ppr_issn">ISSN no. :</label>
                            <input type="text" name="faculty_ppr_issn" class="form-control" id="faculty_ppr_issn">
                        </div>
                    </div>
                    <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
        <!-- page content end -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>

</html>