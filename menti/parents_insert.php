<?php
require_once "../config.php";
include("../template/fac-auth.php");

include("../template/sidebar-fac.php");

?>


<div class="wrapper">
    <!-- Sidebar  -->
   
    <div id="content">




        <!-- page content start -->
        <div>
            <div class="container"  >
                <form action="parents_insert_data.php" method="POST">
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
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="batch">Mother Name<span style="color:red">*</span> </label>
                            <input type="text" name="mother_name" class="form-control" id="mother_name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fname">Mother Mobile<span style="color:red">*</span> </label>
                            <input type="text" name="mother_mob_no" class="form-control" id="mother_mob_no">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mname">Mother Email<span style="color:red">*</span> </label>
                            <input type="text" name="mother_email_id" class="form-control" id="mother_email_id">
                        </div>

                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="batch">Mother Aadhar<span style="color:red">*</span> </label>
                            <input type="text" name="mother_aadhar" class="form-control" id="mother_aadhar">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fname">Mother Pancard No.</label>
                            <input type="text" name="mother_pan_card" class="form-control" id="mother_pan_card">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mname">Mother Occupation<span style="color:red">*</span> </label>
                            <input type="text" name="mother_occupation" class="form-control" id="mother_occupation">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="batch">Father Name<span style="color:red">*</span> </label>
                            <input type="text" name="father_name" class="form-control" id="father_name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fname">Father Mobile<span style="color:red">*</span> </label>
                            <input type="text" name="father_mob_no" class="form-control" id="father_mob_no">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mname">Father Email<span style="color:red">*</span> </label>
                            <input type="text" name="father_email_id" class="form-control" id="father_email_id">
                        </div>

                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="batch">Father Aadhar<span style="color:red">*</span> </label>
                            <input type="text" name="father_aadhar" class="form-control" id="father_aadhar">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fname">Father Pancard No. </label>
                            <input type="text" name="father_pan_card" class="form-control" id="father_pan_card">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mname">Father Occupation<span style="color:red">*</span> </label>
                            <input type="text" name="father_occupation" class="form-control" id="father_occupation">
                        </div>

                    </div>
                    <button type="submit" class="btn btn-success">Save & Next</button>

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