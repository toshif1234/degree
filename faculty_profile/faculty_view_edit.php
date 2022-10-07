<?php

require_once '../config.php';
include("../template/fac-auth.php");
error_reporting(0);
include(
"../template/sidebar-fac.php");
// session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../asset/style/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/style/style_fac.css">
    <link rel="shortcut icon" href="../asset/img/1aiet-logo.png" />
    <link rel="stylesheet" href="asset/style/style_fac.css">
    <title>Document</title>
    <style>
    .label {
        color: #97A1BF;
        font-size: 16px;
        font-weight: 800;
    }

    .value {
        color: #161E37;
        font-size: 16px;
    }
    </style>
</head>

<body>
    <style>
    body,
    html,
    .wraper {
        background-image: url("../asset/img/bg.png") !important;
        height: 100vh !important;
        width: 100vw !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        background-size: cover !important;
        height: 100% !important;
        align-content: center !important;
    }

    .dropdown-toggle::after {
        display: none;
    }
    </style>
    <div class="wrapper">
        <div id="content">
            <div>
                <?php
                $con = $link;
                    $faculty_id = $_SESSION["username"];
                    $que = "select * from faculty_details where faculty_name=\"$faculty_id\"";
                    // echo $que;
                    $result = $con->query($que);
                    foreach ($result as $row) {
                ?>

                <form action="faculty_view_update.php" method="POST">
                    <div class="row">
                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">
                                <label for="faculty_id" class="form-label">Faculty ID<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="faculty_id" name="faculty_id"  
                                    value="<?php echo $row["faculty_id"] ?>" readonly>
                            </div>
                        </div>
                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">
                                <label for="faculty_name" class="form-label">Faculty Name<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="faculty_name" name="faculty_name"  
                                    value="<?php echo $row["faculty_name"] ?>">
                            </div>
                        </div>

                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">
                                <label for="faculty_desg" class="form-label">Designation<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="faculty_desg" name="faculty_desg"  
                                    value="<?php echo $row["faculty_desg"] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">
                                <label for="faculty_dept" class="form-label">Department<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="faculty_dept" name="faculty_dept"  
                                    value="<?php echo $row["faculty_dept"] ?>" readonly>
                            </div>
                        </div>
                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">
                                <label for="faculty_qulfy" class="form-label">Qualification<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="faculty_qulfy" name="faculty_qulfy"  
                                    value="<?php echo $row["faculty_qulfy"] ?>">
                            </div>
                        </div>
                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">
                                <label for="faculty_yoj" class="form-label">Year Of Joining<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="faculty_yoj" name="faculty_yoj" 
                                    value="<?php echo $row["faculty_yoj"] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">


                                <label for="faculty_dob" class="form-label">DOB<span
                                        style="color: red;">*</span></label>
                                <input type="date" class="form-control" name="faculty_dob" id="faculty_dob"  
                                    value="<?php echo $row["faculty_dob"] ?>">
                            </div>
                        </div>
                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">
                                <label for="faculty_email" class="form-label">Mail Id<span
                                        style="color: red;">*</span></label>
                                <input class="form-control" type="email" id="faculty_email" name="faculty_email"
                                      value="<?php echo $row["faculty_email"] ?>" readonly>
                            </div>
                        </div>
                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">
                                <label for="faculty_contact" class="form-label">Contact Number<span
                                        style="color: red;">*</span></label>
                                <input type="number" class="form-control" name="faculty_contact" id="faculty_contact"
                                      value="<?php echo $row["faculty_contact"] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">
                                <label for="faculty_parmenent_address" class="form-label">Parmanent Address<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="faculty_parmenent_address"
                                    id="faculty_parmenent_address"   value="<?php echo $row["faculty_parmenent_address"] ?>">
                            </div>
                        </div>
                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">
                                <label for="faculty_present_address" class="form-label">Correspondence Address</label>
                                <input type="text" class="form-control" name="faculty_present_address"
                                    id="faculty_present_address"  
                                    value="<?php echo $row["faculty_present_address"] ?>">
                            </div>
                        </div>
                        <div class="col col-12  col-lg-4">
                            <div class="mb-3">
                                <label for="faculty_teaching_exp" class="form-label">Teaching Experience<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="faculty_teaching_exp"
                                    id="faculty_teaching_exp"  
                                    value="<?php echo $row["faculty_teaching_exp"] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-12">

                            <div class="mb-3">
                                <label for="faculty_industry_exp" class="form-label">Industry Experience<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="faculty_industry_exp"
                                    id="faculty_industry_exp"  
                                    value="<?php echo $row["faculty_industry_exp"] ?>">
                            </div>

                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_aicte_id" class="form-label">AICTE ID<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="faculty_aicte_id" id="faculty_aicte_id"
                                      value="<?php echo $row["faculty_aicte_id"] ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-4"></div>
                    </div>

                    <div>
                        <h3>Education Details</h3>
                    </div>
                    <div>
                        <h5>UG</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_ug_dept" class="form-label">BE,DEPARTMENT<span
                                        style="color: red;">*</span></label>

                                <input type="text" class="form-control" id="faculty_ug_dept" name="faculty_ug_dept"
                                      value="<?php echo $row["faculty_ug_dept"] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_ug_year" class="form-label">Year of Passing<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="faculty_ug_year" id="faculty_ug_year"
                                      value="<?php echo $row["faculty_ug_year"] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_ug_college" class="form-label">College name<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="faculty_ug_college"
                                    id="faculty_ug_college"   value="<?php echo $row["faculty_ug_college"] ?>" />
                            </div>
                        </div>


                    </div>
                    <div>
                        <h5>PG</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">

                                <label for="faculty_pg_dept" class="form-label">M Tech,DEPARTMENT<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="faculty_pg_dept" id="faculty_pg_dept"
                                      value="<?php echo $row["faculty_pg_dept"] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_pg_year" class="form-label">Year of Passing<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="faculty_pg_year" id="faculty_pg_year"
                                      value="<?php echo $row["faculty_pg_year"] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_pg_college" class="form-label">College name<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="faculty_pg_college"
                                    id="faculty_pg_college"   value="<?php echo $row["faculty_pg_college"] ?>" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <h5>PHD</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">

                                <label for="faculty_phd_reg" class="form-label">Registration date<span
                                        style="color: red;">*</span></label>
                                <input type="date" class="form-control" id="faculty_phd_reg" name="faculty_phd_reg"
                                      value="<?php echo $row["faculty_phd_reg"] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_status" class="form-label">Current Status<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="faculty_phd_status"
                                    name="faculty_phd_status"  
                                    value="<?php echo $row["faculty_phd_status"] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_guide" class="form-label">Guide Name<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="faculty_phd_guide" name="faculty_phd_guide"
                                      value="<?php echo $row["faculty_phd_guide"] ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_topic" class="form-label">Topic of research<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="faculty_phd_topic" name="faculty_phd_topic"
                                      value="<?php echo $row["faculty_phd_topic"] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_domain" class="form-label">Research Domain<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="faculty_phd_domain"
                                    name="faculty_phd_domain"  
                                    value="<?php echo $row["faculty_phd_domain"] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_center" class="form-label">University/research center<span
                                        style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="faculty_phd_center"
                                    id="faculty_phd_center"   value="<?php echo $row["faculty_phd_center"] ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_yoj" class="form-label">Year of joining<span
                                        style="color: red;">*</span></label>
                                <input type="number" class="form-control" id="faculty_phd_yoj" name="faculty_phd_yoj"
                                      value="<?php echo $row["faculty_phd_yoj"] ?>" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_complition" class="form-label">Year of completion<span
                                        style="color: red;">*</span></label>
                                <input type="number" class="form-control" id="faculty_phd_complition"
                                    name="faculty_phd_complition"  
                                    value="<?php echo $row["faculty_phd_complition"] ?>" />
                            </div>
                        </div>


                    </div>


                    Teaching Subjects : <input type="text" class="form-control" name="faculty_sub_handel"
                        value="<?php echo $row["faculty_sub_handel"] ?>">

                    <!-- <div class="col-2 col-lg-2">

                            <button type="submit" class="btn btn-success mt-4">Submit</button></a>
                        </div> -->

                    <div class="row">
                        <div class="col-12 col-lg-4 offset-md-11 offset-11 offset-lg-11">
                            <button type="submit" class="btn btn-success mt-4">Update</button></a>
                        </div>

                    </div>

                </form>




                <?php
                    }
                 ?>

            </div>
            <!-- page content end -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
    </script>
</body>

</html>