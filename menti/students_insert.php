<?php
require_once "../config.php";
include("../template/facn-auth.php");

include("../template/sidebar-fac.php");

?>
<div class="container">
    <?php

    if (isset($_SESSION["popup"]) && $_SESSION["popup"] == 1) {
        $_SESSION["popup"] = 0;
        echo '<div style="width:50%;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sucessful</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    } else if (isset($_SESSION["popup"]) && $_SESSION["popup"] == 2) {
        $_SESSION["popup"] = 0;
        echo '<div style="width:50%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>failed</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    }

    ?>

    <style>
        @media screen and (min-width: 320px) {
            .import-btn {
                margin-left: 80%;
            }

        }
    </style>
    <div class="row">
        <div class="col-sm-10"></div>
        <div class="col-sm-1 ml-2 mb-2 ">
            <a href="../upload/students_upload/examples/04-upload_and_convert_to_html.php" class="btn btn-primary import-btn"> Import </a>
        </div>
    </div>

    <div class="container">
        <form action="stu_insert_process.php" method="POST">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="adm_no">Admission Number :</label>
                    <input type="text" name="adm_no" class="form-control" id="adm_no">
                </div>
                <div class="form-group col-md-4">
                    <label for="usn">USN :</label>
                    <input type="text" name="usn" class="form-control" id="usn">
                </div>
                <div class="form-group col-md-4">
                    <label for="batch">Batch :</label>
                    <input type="text" name="batch" class="form-control" id="batch">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="fname">Frist Name :</label>
                    <input type="text" name="fname" class="form-control" id="fname">
                </div>
                <div class="form-group col-md-4">
                    <label for="mname">Middle Name :</label>
                    <input type="text" name="mname" class="form-control" id="mname">
                </div>
                <div class="form-group col-md-4">
                    <label for="lname">Last Name :</label>
                    <input type="text" name="lname" class="form-control" id="lname">
                </div>
            </div>

            <div class="form-group">
                <label for="branch">Branch :</label>
                <select name="branch" id="branch" class="custom-select">
                    <option selected></option>
                    <option value="1">Civil</option>
                    <option value="2">Mechanical</option>
                    <option value="3">Computer Science & Engg.</option>
                    <option value="4">Computer Science & Design</option>
                    <option value="5">Agriculture</option>
                    <option value="6">Electronic & Communication</option>
                    <option value="7">Artifical Intelligence & Machine Learning</option>
                    <option value="8">Information Science & Engg.</option>
                </select>
                <!-- <input type="text" name="branch" class="form-control" id="branch"> -->
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="kcet">K-CET Rank :</label>
                    <input type="text" name="kcet" class="form-control" id="kcet">
                </div>
                <div class="form-group col-md-4">
                    <label for="comedk">COMED-K Rank :</label>
                    <input type="text" name="comedk" class="form-control" id="comedk">
                </div>
                <div class="form-group col-md-4">
                    <label for="jee">JEE Rank :</label>
                    <input type="text" name="jee" class="form-control" id="jee">
                </div>
            </div>

            <div class="form-group">
                <label for="nationality">Nationality :</label>
                <input type="text" name="nationality" class="form-control" id="nationality">
            </div>
            <div class="form-group">
                <label for="date_of_admission">Date Of Admission :</label>
                <input type="date" name="date_of_admission" class="form-control" id="date_of_admission">
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="dob">Data of Birth :</label>
                    <input type="date" name="dob" class="form-control" id="dob">
                </div>
                <div class="form-group col-md-6">
                    <label for="place_of_birth">Place of Birth :</label>
                    <input type="text" name="place_of_birth" class="form-control" id="place_of_birth">
                </div>
            </div>
            <div class="form-group">
                <label for="gender">Gender :</label>
                <div class="custom-control custom-radio">
                    <input type="radio" name="gender" class="custom-control-input" id="male">
                    <label for="male" class="custom-control-label">Male</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" name="gender" class="custom-control-input" id="female">
                    <label for="female" class="custom-control-label">Female</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" name="gender" class="custom-control-input" id="not_to_say">
                    <label for="not_to_say" class="custom-control-label">Not to Say</label>
                </div>
                <!-- <input type="text" name="gender" class="form-control" id="gender"> -->
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="mob_no">Mobile Number :</label>
                    <input type="text" name="mob_no" class="form-control" id="mob_no">
                </div>
                <div class="form-group col-md-6">
                    <label for="email_id">Email id :</label>
                    <input type="email" name="email_id" class="form-control" id="email_id">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="aadhar">Aadhar Number :</label>
                    <input type="text" name="aadhar" class="form-control" id="aadhar">
                </div>
                <div class="form-group col-md-6">
                    <label for="pan_card">Pan card Number :</label>
                    <input type="text" name="pan_card" class="form-control" id="pan_card">
                </div>
            </div>

            <div class="form-group">
                <label for="sc_st">SC/ST :</label>
                <input type="text" name="sc_st" class="form-control" id="sc_st">
            </div>
            <div class="form-group">
                <label for="caste">CASTE</label>
                <input type="text" name="caste" class="form-control" id="caste">
            </div>
            <div class="form-group">
                <label for="annual_income">Annual Income :</label>
                <input type="text" name="annual_income" class="form-control" id="annual_income">
            </div>
            <div class="row">
                <div class="col-md-6 pr-4">
                    <h4>Present address :</h4> <br>
                    <div class="form-group">
                        <label for="present_house_no_name">House no/name :</label>
                        <input type="text" name="present_house_no_name" class="form-control" id="present_house_no_name">
                    </div>
                    <div class="form-group">
                        <label for="present_post_village">Post and village :</label>
                        <input type="text" name="present_post_village" class="form-control" id="present_post_village">
                    </div>
                    <div class="form-group">
                        <label for="present_dist">Distict :</label>
                        <input type="text" name="present_dist" class="form-control" id="present_dist">
                    </div>
                    <div class="form-group">
                        <label for="present_state">State :</label>
                        <input type="text" name="present_state" class="form-control" id="present_state">
                    </div>
                    <div class="form-group">
                        <label for="present_pin_code">Pin code :</label>
                        <input type="text" name="present_pin_code" class="form-control" id="present_pin_code">
                    </div>
                </div>

                <div class="col-md-6">
                    <h4>Permanent address : </h4><br>


                    <div class="form-group">
                        <label for="permanent_house_no_name">House no/name :</label>
                        <input type="text" name="permanent_house_no_name" class="form-control" id="permanent_house_no_name">
                    </div>
                    <div class="form-group">
                        <label for="permanent_post_village">Post and village :</label>
                        <input type="text" name="permanent_post_village" class="form-control" id="permanent_post_village">
                    </div>
                    <div class="form-group">
                        <label for="permanent_dist">Distict :</label>
                        <input type="text" name="permanent_dist" class="form-control" id="permanent_dist">
                    </div>
                    <div class="form-group">
                        <label for="permanent_state">State :</label>
                        <input type="text" name="permanent_state" class="form-control" id="permanent_state">
                    </div>
                    <div class="form-group">
                        <label for="permanent_pin_code">Pin code :</label>
                        <input type="text" name="permanent_pin_code" class="form-control" id="permanent_pin_code">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Save & Next</button>

        </form>
        <div class="row">
            <div class="col-md-9">

            </div>

        </div>

    </div>
</div>


<!-- page content end -->
<div>

</div>
</div>
<script>
    document.getElementById('Upload').addEventListener('click', openDialog);

    function openDialog() {
        document.getElementById('fileid').click();
    }
</script>
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