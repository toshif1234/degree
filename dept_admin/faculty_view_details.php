<?php

require_once '../config.php';
    error_reporting(0);

$con = $link;

$q1 = "select distinct faculty_dept from faculty_details";


$result1 = $con->query($q1);

?>



<?php
require_once "../config.php";
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md">
            <h2>View Faculty Details</h2>
        </div>
        <div class="col"></div>
        <div class="col-sm-12 col-md-2">
            <button type="button" class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#downloadModal">Download</button>
        </div>
    </div><br>

    <?php
    // $con = mysqli_connect("localhost", "root", "", "erp_alvas");
    // if (mysqli_connect_error()) {
    //     echo "error";
    // } else {

    $que = "select * from faculty_details where faculty_dept=\"" . $_POST["branch"] . "\"";

    $result = $con->query($que);
    $con1 = 0;
    foreach ($result as $row) {
        $con1++;

    ?>

        <form action="student_update_details.php" method="POST">

            <div class="row " style="background: #FFFFFF;border: 1px solid #ECF0FA; box-shadow: 0 2px 4px 0 rgba(7,17,55,0.06);  border-radius: 4px; border-radius: 4px;padding:1.5% ;margin-top: 1%;">
                <div class="form-group col-md-2">
                    <label for="faculty_id">Faculty Id :</label>
                    <input readonly type="text" name="faculty_id" class="form-control" id="faculty_id" value=<?php
                                                                                                                $faculty_id = $row["faculty_id"];
                                                                                                                echo $faculty_id; ?>>
                </div>
                <div class="form-group col-md-2">
                    <label for="faculty_name">Faculty Name :</label>
                    <input type="text" name="faculty_name" style="width: <?php echo strlen($row['faculty_name']) ?>em;" class="form-control" id="faculty_name" required value="<?php echo
                                                                                                                    $row["faculty_name"]; ?>"">
                </div>


                <div class="container">
                    <div class="row">
                        <div class="form-group col-sm-5 col-md-3 mt-2">
                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#facultyModal<?php echo $con1 ?>">Faculty Details</button>
                        </div>
                        <div class="form-group col-sm-4 col-md-3 mt-2">
                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#workshopModal<?php echo $con1 ?>">
                                Workshop
                            </button>
                        </div>
                        <div class="form-group col-sm-6 col-md-3 mt-2">
                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#paperModal<?php echo $con1 ?>">
                                Paper Details
                            </button>
                        </div>
                        <div class="form-group col-sm-6 col-md-3 mt-2">
                            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#exampleModalCenter<?php echo $con1 ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group col-md-2">


        </form>
        <div class="modal fade" id="exampleModalCenter<?php echo $con1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4>Confirm delete?</h4>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                            <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="faculty_delete.php" method="POST">
                            <div class="form-group col-md-5">
                                <label for="faculty_id">Admission Number :</label>
                                <input type="text" name="faculty_id" class="form-control" id="faculty_id" readonly value=<?php echo $row["faculty_id"]; ?>>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                    </div>



                </div>
            </div>
        </div>
</div>




<!-- Modal Faculty Details -->

<div class="modal fade " id="facultyModal<?php echo $con1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md-lg    " role="document">
        <div class="modal-content" style="">
            <div class="modal-header" style="align-items: baseline">
                <h4>Faculty Details</h4>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="faculty_upadte.php" method="POST">

                    <div class="row" style="margin-bottom:2% ;">
                        <div class="col-12 col-lg-12">
                            <label for="faculty_id">Faculty Id :</label>
                            <input readonly type="text" name="faculty_id" class="form-control" id="faculty_id" value=<?php echo $row["faculty_id"]; ?>>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-12  col-lg-6">
                            <div class="mb-3">
                                <label for="faculty_desg" class="form-label">Designation<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" id="faculty_desg" name="faculty_desg" placeholder="Enter your designation" required value="<?php echo $row["faculty_desg"]
                                                                                                                                                                    ?>">
                            </div>
                        </div>
                        <div class="col col-12  col-lg-6">
                            <div class="mb-3">
                                <label for="faculty_dept" class="form-label">Department<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" id="faculty_dept" name="faculty_dept" placeholder="Enter your Department" required value=<?php echo $row["faculty_dept"]
                                                                                                                                                                    ?> readonly>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col col-12  col-lg-6">
                            <div class="mb-3">
                                <label for="faculty_qulfy" class="form-label">Qualification<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" id="faculty_qulfy" name="faculty_qulfy" placeholder="Enter your Qualification" required value=<?php echo
                                                                                                                                                                        $row["faculty_qulfy"] ?>>
                            </div>
                        </div>
                        <div class="col col-12  col-lg-6">
                            <div class="mb-3">
                                <label for="faculty_dob" class="form-label">DOB<span style="color: red;">*</span></label></label>
                                <input type="date" class="form-control" name="faculty_dob" id="faculty_dob" required value=<?php echo $row["faculty_dob"] ?>>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col col-12  col-lg-6">
                            <div class="mb-3">
                                <label for="faculty_email" class="form-label">Mail Id<span style="color: red;">*</span></label></label>
                                <input class="form-control" type="email" id="faculty_email" name="faculty_email" placeholder="name@example.com" required value=<?php echo $row["faculty_email"] ?> readonly>
                            </div>
                        </div>
                        <div class="col col-12  col-lg-6">
                            <div class="mb-3">
                                <label for="faculty_contact" class="form-label">Contact Number<span style="color: red;">*</span></label></label>
                                <input type="number" class="form-control" name="faculty_contact" id="faculty_contact" placeholder="Enter contact number" required value=<?php echo $row["faculty_contact"]
                                                                                                                                                                        ?>>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col col-12  col-lg-6">
                            <div class="mb-3">
                                <label for="faculty_parmenent_address" class="form-label">Parmanent Address<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" name="faculty_parmenent_address" id="faculty_parmenent_address" placeholder="Enter permanent address" required value=<?php echo $row["faculty_parmenent_address"] ?>>
                            </div>
                        </div>
                        <div class="col col-12  col-lg-6">
                            <div class="mb-3">
                                <label for="faculty_present_address" class="form-label">Correspondence
                                    Address</label>
                                <input type="text" class="form-control" name="faculty_present_address" id="faculty_present_address" placeholder="Enter orrespondence address" required value=<?php echo $row["faculty_present_address"] ?>>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col col-12  col-lg-6">
                            <div class="mb-3">
                                <label for="faculty_teaching_exp" class="form-label">Teaching Experience<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" name="faculty_teaching_exp" id="faculty_teaching_exp" placeholder="Enter Teaching Experience " required value=<?php echo $row["faculty_teaching_exp"] ?>>
                            </div>
                        </div>
                        <div class="col col-12  col-lg-6">
                            <div class="mb-3">
                                <label for="faculty_yoj" class="form-label">Year Of Joining<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" id="faculty_yoj" name="faculty_yoj" placeholder="Enter your Year Of Joining" required value=<?php echo
                                                                                                                                                                    $row["faculty_yoj"] ?>>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">

                            <div class="mb-3">
                                <label for="faculty_industry_exp" class="form-label">Industry Experience<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" name="faculty_industry_exp" id="faculty_industry_exp" placeholder="Enter Industry Experience" required value=<?php echo $row["faculty_industry_exp"] ?>>
                            </div>

                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="faculty_aicte_id" class="form-label">AICTE ID<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" name="faculty_aicte_id" id="faculty_aicte_id" placeholder="Enter AICTE ID" required value=<?php echo $row["faculty_aicte_id"] ?>>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6"></div>
                    </div>

                    <div>
                        <h4>Education Details</h4>
                    </div>
                    <hr>
                    <div>
                        <h5>UG</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="faculty_ug_dept" class="form-label">BE,DEPARTMENT<span style="color: red;">*</span></label></label>

                                <input type="text" class="form-control" id="faculty_ug_dept" name="faculty_ug_dept" placeholder="Enter your department" required value=<?php echo
                                                                                                                                                                        $row["faculty_ug_dept"] ?>>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="faculty_ug_year" class="form-label">Year of Passing<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" name="faculty_ug_year" id="faculty_ug_year" placeholder="Enter year of passing" required value=<?php echo
                                                                                                                                                                        $row["faculty_ug_year"] ?>>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="mb-3">
                                <label for="faculty_ug_college" class="form-label">College name<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" name="faculty_ug_college" id="faculty_ug_college" placeholder="Enter college name" required value=<?php echo
                                                                                                                                                                            $row["faculty_ug_college"] ?>>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h5>PG</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">

                                <label for="faculty_pg_dept" class="form-label">M Tech,DEPARTMENT<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" name="faculty_pg_dept" id="faculty_pg_dept" placeholder="Enter your department" required value=<?php echo
                                                                                                                                                                        $row["faculty_pg_dept"] ?>>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="faculty_pg_year" class="form-label">Year of Passing<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" name="faculty_pg_year" id="faculty_pg_year" placeholder="Enter year of passing" required value=<?php echo
                                                                                                                                                                        $row["faculty_pg_year"] ?>>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="mb-3">
                                <label for="faculty_pg_college" class="form-label">College name<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" name="faculty_pg_college" id="faculty_pg_college" placeholder="Enter college name" required value=<?php echo
                                                                                                                                                                            $row["faculty_pg_college"] ?>>
                            </div>
                        </div>
                    </div>


                    <div>
                        <h5>PHD</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_reg" class="form-label">Registration date<span style="color: red;">*</span></label></label>
                                <input type="date" class="form-control" id="faculty_phd_reg" name="faculty_phd_reg" placeholder="Enter your department" required value=<?php echo
                                                                                                                                                                        $row["faculty_phd_reg"] ?>>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_status" class="form-label">Current Status<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" id="faculty_phd_status" name="faculty_phd_status" placeholder="Enter your current status" required value=<?php echo $row["faculty_phd_status"] ?>>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_guide" class="form-label">Guide Name<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" id="faculty_phd_guide" name="faculty_phd_guide" placeholder="Enter guide name" required value=<?php echo $row["faculty_phd_guide"]
                                                                                                                                                                        ?>>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_topic" class="form-label">Topic of research<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" id="faculty_phd_topic" name="faculty_phd_topic" placeholder="Enter research topic" required value=<?php echo
                                                                                                                                                                            $row["faculty_phd_topic"] ?>>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_domain" class="form-label">Research Domain<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" id="faculty_phd_domain" name="faculty_phd_domain" placeholder="Enter domain" required value=<?php echo
                                                                                                                                                                    $row["faculty_phd_domain"] ?>>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_center" class="form-label">University/research center<span style="color: red;">*</span></label></label>
                                <input type="text" class="form-control" name="faculty_phd_center" id="faculty_phd_center" placeholder="Enter research center" required value=<?php
                                                                                                                                                                                echo $row["faculty_phd_center"] ?>>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_yoj" class="form-label">Year of joining<span style="color: red;">*</span></label></label>
                                <input type="number" class="form-control" id="faculty_phd_yoj" name="faculty_phd_yoj" placeholder="Enter joining year" required value=<?php echo $row["faculty_phd_yoj"]
                                                                                                                                                                        ?>>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="faculty_phd_complition" class="form-label">Year of completion<span style="color: red;">*</span></label></label>
                                <input type="number" class="form-control" id="faculty_phd_complition" name="faculty_phd_complition" placeholder="Enter completion" required value=<?php
                                                                                                                                                                                    echo $row["faculty_phd_complition"] ?>>
                            </div>
                        </div>


                    </div>


                    Teaching Subjects : <input type="text" class="form-control" name="faculty_sub_handel" value=<?php
                                                                                                                echo $row["faculty_sub_handel"] ?>>


                    <div class="row" style="margin-top: 2%;">
                        <div class="col-lg-12 col-12">
                            <button type="submit" class="btn btn-success" style="width: 100%;">Update</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal Paper Details -->
<div class="modal fade " id="paperModal<?php echo $con1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md-lg   " role="document">
        <div class="modal-content modal-md-lg" style=" ">
            <div class="modal-header" style="align-items: baseline">
                <h4>Paper Details</h4>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="">
                    <?php
                    $q = "select * from faculty_ppr_details where faculty_id=\"" . $faculty_id . "\"";
                    $result1 = $con->query($q);
                    foreach ($result1 as $ro) {
                    ?>
                        <div class="row" style="margin-bottom:2% ;">
                            <div class="col-12 col-lg-12">
                                <label for="faculty_id">Faculty Id :</label>
                                <input readonly type="text" name="faculty_id" class="form-control" id="faculty_id" value=<?php echo $ro["faculty_id"]; ?>>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="faculty_ppr_type" class="col-md-3 col-form-label">Paper Detail :</label>
                            <div class="col-md-9">

                                <input type="text" name="faculty_ppr_type" class="form-control" id="faculty_ppr_type" value=<?php echo $ro["faculty_ppr_type"]; ?>>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="faculty_ppr_year" class="col-md-3 col-form-label">Year :</label>
                            <div class="col-md-9">
                                <input type="text" name="faculty_ppr_year" class="form-control" id="faculty_ppr_year" value=<?php echo $ro["faculty_ppr_year"]; ?>>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="faculty_ppr_title" class="col-md-3 col-form-label">Title :</label>
                            <div class="col-md-9">
                                <input type="text" name="faculty_ppr_title" class="form-control" id="faculty_ppr_title" value=<?php echo $ro["faculty_ppr_title"]; ?>>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="faculty_ppr_jourrnal" class="col-md-3 col-form-label">Journal :</label>
                            <div class="col-md-9">
                                <input type="text" name="faculty_ppr_jourrnal" class="form-control" id="faculty_ppr_jourrnal" value=<?php echo $ro["faculty_ppr_jourrnal"]; ?>>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="faculty_ppr_pub_date" class="col-md-3 col-form-label">Publish Date :</label>
                            <div class="col-md-9">
                                <input type="text" name="faculty_ppr_pub_date" class="form-control" id="faculty_ppr_pub_date" value=<?php echo $ro["faculty_ppr_pub_date"]; ?>>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="faculty_ppr_volume" class="col-md-3 col-form-label">Volume :</label>
                            <div class="col-md-9">
                                <input type="text" name="faculty_ppr_volume	" class="form-control" id="faculty_ppr_volume	" value=<?php echo $ro["faculty_ppr_volume"]; ?>>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="faculty_ppr_issue" class="col-md-3 col-form-label">Issue :</label>
                            <div class="col-md-9">
                                <input type="text" name="faculty_ppr_issue" class="form-control" id="faculty_ppr_issue" value=<?php echo $ro["faculty_ppr_issue"]; ?>>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="faculty_ppr_issn" class="col-md-3 col-form-label">ISSN :</label>
                            <div class="col-md-9">
                                <input type="text" name="faculty_ppr_issn" class="form-control" id="faculty_ppr_issn" value=<?php echo $ro["faculty_ppr_issn"]; ?>>
                            </div>
                        </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-success" style="float:right;">Update</button>

                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal for Workshop Details -->
<div class="modal fade " id="workshopModal<?php echo $con1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md-lg      " role="document">
        <div class="modal-content">
            <div class="modal-header" style="align-items: baseline">
                <h4>WorkShop</h4>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="">
                    <?php
                    $q1 = "select * from faculty_workshop_details where faculty_id=\"" . $faculty_id . "\"";
                    $result2 = $con->query($q1);
                    foreach ($result2 as $ro1) {
                    ?>
                        <div class="row" style="margin-bottom:2% ;">
                            <div class="col-12 col-lg-12">
                                <label for="faculty_id">Faculty Id :</label>
                                <input readonly type="text" name="faculty_id" class="form-control" id="faculty_id" value=<?php echo $ro1["faculty_id"]; ?>>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="faculty_workshop_name" class="col-md-3 col-form-label">Name :</label>
                            <div class="col-md-9">

                                <input type="text" name="faculty_workshop_name" class="form-control" id="faculty_workshop_name" value=<?php echo $ro1["faculty_workshop_name"]; ?>>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="faculty_workshop_title" class="col-md-3 col-form-label">Title :</label>
                            <div class="col-md-9">
                                <input type="text" name="faculty_workshop_title" class="form-control" id="faculty_workshop_title" value=<?php echo $ro1["faculty_workshop_title"]; ?>>
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label for="faculty_workshop_no_of_days" class="col-md-3 col-form-label">No. of Days :</label>
                            <div class="col-md-9">
                                <input type="text" name="faculty_workshop_no_of_days" class="form-control" id="faculty_workshop_no_of_days" value=<?php echo $ro1["faculty_workshop_no_of_days"];
                                                                                                                                                    ?>>
                            </div>
                        </div>
                    <?php } ?>

                    <button type="submit" class="btn btn-success" style="float:right;">Update</button>
                </form>
            </div>

        </div>
    </div>
</div>

</div>



<!-- Moadal For Download -->

</div>
</div>
<?php
    }
?>
</div>

<div class="modal fade" id="downloadModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md-lg    modal-md">
        <div class="modal-content">
            <div class="modal-header" style="align-items: baseline">
                <h4>Download Faculty Details</h4>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 25px;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="post" action="../download/faculty_excel_extract_data.php" align="center">
                        <div class="row">
                            <div class=" form-group col-md-4">
                                <select class="form-control" name="faculty_dept" id="faculty_dept" aria-label="Default select example">
                                    <option value="selected">Department</option>
                                    <?php foreach ($result1 as $r) { ?>
                                        <option class="form-control" value="<?php echo $r[" faculty_dept"] ?>">
                                            <?php echo $r["faculty_dept"] ?>
                                        </option>

                                    <?php } ?>
                                    <option class="form-control" value="all">ALL Department</option>



                                </select>
                            </div>

                            <div class="col-md-3">
                                <input type="submit" name="export" value="Download" class="btn btn-success" />

                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <!-- <button type="button" class="btn btn-primary">Understood</button> -->
            </div>
        </div>
    </div>
</div>

<!-- page content end -->
<div>
    <?php include "../template/scroll.php"; ?>
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
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>

</body>

</html>