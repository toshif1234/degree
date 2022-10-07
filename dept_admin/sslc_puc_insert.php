<?php
require_once "../config.php";
include("../template/fac-auth.php");
                                                                                            error_reporting(0);

include("../template/sidebar-fac.php");

?>
<!DOCTYPE html>



<!-- Page Content  -->
<div id="content">


    <!-- page content start -->
    <div>
        <div class="container">
            <form action="sslc_puc_insert_data.php" method="POST">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="adm_no">Admission Number<span style="color:red">*</span> </label>
                        <input type="text" name="adm_no" class="form-control" id="adm_no" value="<?php echo $_SESSION["adm_no"] ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="usn">USN<span style="color:red">*</span> </label>
                        <input type="text" name="usn" class="form-control" id="usn" value="<?php echo $_SESSION["usn"] ?>" readonly>
                    </div>


                </div>
                <h4>SSLC Details :</h4><br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="sslc_reg_no">Register Number :</label>
                        <input type="text" name="sslc_reg_no" class="form-control" id="sslc_reg_no" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sslc_school">School :</label>
                        <input type="text" name="sslc_school" class="form-control" id="sslc_school">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sslc_board_university">Board/University :</label>
                        <input type="text" name="sslc_board_university" class="form-control" id="sslc_board_university">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="sslc_year">Year of Pass :</label>
                        <input type="text" name="sslc_year" class="form-control" id="sslc_year">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sslc_max_marks">Maximum Marks :</label>
                        <input type="text" name="sslc_max_marks" class="form-control" id="sslc_max_marks">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sslc_obtained_marks">Obtained Marks :</label>
                        <input type="text" name="sslc_obtained_marks" class="form-control" id="sslc_obtained_marks">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sslc_percentage">Percentage :</label>
                        <input type="text" name="sslc_percentage" class="form-control" id="sslc_percentage">
                    </div>
                </div>
                <h4>PU Details :</h4><br>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="puc_reg_no">Register Number :</label>
                        <input type="text" name="puc_reg_no" class="form-control" id="puc_reg_no">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="puc_collage">College :</label>
                        <input type="text" name="puc_collage" class="form-control" id="puc_collage">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="puc_board_university">Board/University :</label>
                        <input type="text" name="puc_board_university" class="form-control" id="puc_board_university">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="puc_year">Year of Pass :</label>
                        <input type="text" name="puc_year" class="form-control" id="puc_year">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="puc_max_marks">Maximum Marks :</label>
                        <input type="text" name="puc_max_marks" class="form-control" id="puc_max_marks">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="puc_obtained_marks">Obtained Marks :</label>
                        <input type="text" name="puc_obtained_marks" class="form-control" id="puc_obtained_marks">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="puc_percentage">Percentage :</label>
                        <input type="text" name="puc_percentage" class="form-control" id="puc_percentage">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <h6>Physics :</h6>
                        <label for="puc_phy_max_marks">Maximum Marks :</label>
                        <input type="text" name="puc_phy_max_marks" class="form-control" id="puc_phy_max_marks">
                        <label for="puc_phy_obtained_marks">Obtained Marks :</label>
                        <input type="text" name="puc_phy_obtained_marks" class="form-control" id="puc_phy_obtained_marks">
                    </div>
                    <div class="form-group col-md-3">
                        <h6>Chemistry :</h6>
                        <label for="puc_che_max_marks">Maximum Marks :</label>
                        <input type="text" name="puc_che_max_marks" class="form-control" id="puc_che_max_marks">
                        <label for="puc_che_obtained_marks">Obtained Marks :</label>
                        <input type="text" name="puc_che_obtained_marks" class="form-control" id="puc_che_obtained_marks">

                    </div>
                    <div class="form-group col-md-3">
                        <h6>Mathematics :</h6>
                        <label for="puc_maths_max_marks">Maximum Marks :</label>
                        <input type="text" name="puc_maths_max_marks" class="form-control" id="puc_maths_max_marks">
                        <label for="puc_maths_obtained_marks">Obtained Marks :</label>
                        <input type="text" name="puc_maths_obtained_marks" class="form-control" id="puc_maths_obtained_marks">

                    </div>
                    <div class="form-group col-md-3">
                        <h6>Bio/CS/E/S :</h6>
                        <label for="puc_elective_max_marks">Maximum Marks :</label>
                        <input type="text" name="puc_elective_max_marks" class="form-control" id="puc_elective_max_marks">
                        <label for="puc_elective_obtained_marks">Obtained Marks :</label>
                        <input type="text" name="puc_elective_obtained_marks" class="form-control" id="puc_elective_obtained_marks">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h6>English :</h6>
                        <label for="puc_eng_max_marks">Maximum Marks :</label>
                        <input type="text" name="puc_eng_max_marks" class="form-control" id="puc_eng_max_marks">
                        <label for="puc_eng_obtained_marks">Obtained Marks :</label>
                        <input type="text" name="puc_eng_obtained_marks" class="form-control" id="puc_eng_obtained_marks">

                    </div>
                    <div class="form-group col-md-6">

                        <label for="puc_sub_total_marks">Total Marks :</label>
                        <input type="text" name="puc_sub_total_marks" class="form-control" id="puc_sub_total_marks">
                        <br><br>
                        <button type="submit" class="btn btn-primary" style="float: right;">Save & Submit</button>

                    </div>
                </div>





            </form>
        </div>
    </div>


    <!-- page content end -->
    <div>

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