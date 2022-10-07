<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
require_once "../config.php";
$con = $link;
$faculty_id = $_GET["fac_id"];
$f1 = "select faculty_name from faculty_details where faculty_id = \"$faculty_id\"";
$res = $link->query($f1);
$faculty_name = mysqli_fetch_assoc($res)['faculty_name'];
$img_path = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkkBpQ9U04geL7EKfAaXSxUCshUNLfDTKzlQ&usqp=CAU";
$p1 = "select * from display_pic where username =\"$faculty_name\"";
// echo $p1;
$res9 = $link->query($p1);
// print_r($res9);
if (mysqli_num_rows($res9) > 0) {
    $res9 = mysqli_fetch_assoc($res9);
    $img_path = $res9["dp"];
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<!-- page content start -->
<style>
    .card {
        z-index: 0 !important;
    }

    .profileUpload {
        position: absolute;
        /* top: 200px; */
        right: 2%;
        top: 49%;
        z-index: 1;

    }

    .profileDelete {
        position: absolute;
        /* top: 200px; */
        left: 2%;
        top: 49%;
        z-index: 1;
        display: none;

    }

    .profileDelete:hover {
        display: inline-block;
    }

    #image_wraper button {
        display: none;
    }

    #image_wraper:hover button {
        display: initial;
        transition: display 250ms linear;
    }

    #imageUpload {
        display: none;
    }

    .img-container {
        padding: 0%;
        margin-left: 2%;
        border: 1px solid #888888;
        border-radius: 50%;
        text-align: center;
        justify-content: center;
        width: 250px;
        height: 250px;
        overflow: hidden;
        box-sizing: border-box;
        align-items: center;
        box-shadow: 0px 0px 20px 7px #888888;
        background: rgba(255, 255, 255, 0.884);
    }
</style>


<?php
$con = $link;


$que = "select * from faculty_details where faculty_id =\"$faculty_id\"";

$result = $con->query($que);
foreach ($result as $row) {


?>
    <div class="card custom-card">
        <div class="container">
            <div class="row" style="align-items: center !important; justify-content: center">
                <div class="col-sm-12 col-md-4 img-container">
                    <div id="image_wraper" style="position: relative;">
                        <img id="profile_pich" src="<?php echo $img_path ?>" style="margin: 0%;padding:0%;width:250px;height:250px;">
                    </div>
                </div>
                <div class="col-sm-12 col-md-8 mt-5" style="text-align: center;">
                    <h2>
                        <span>
                            <?php echo $row["faculty_name"] ?>
                        </span>
                    </h2>
                    <div class="row">
                        <span class="value"><?php echo $row["faculty_email"] ?></span>
                    </div>
                    <div class="row">
                        <span class="value"><?php echo $row["faculty_contact"] ?></span>
                    </div>
                    <div>
                        <h5 class="value"><?php echo $row["faculty_dept"] ?></h5>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="card mt-5" style="padding:3%; box-shadow: 1px 5px 18px black; border:1px solid white">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">

                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-style: italic;font-weight:600;color:black;">
                        Basic Details
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">

                            <div class="col col-lg-4 col-12 label mt-5">
                                Faculty Id : <span class="value"><?php echo $row["faculty_id"] ?></span>
                            </div>

                            <div class="col col-lg-4 col-12 label mt-5">
                                Designation : <span class="value"><?php echo $row["faculty_desg"] ?></span>
                            </div>

                            <div class="col col-lg-4 col-12 label mt-5">
                                Department : <span class="value"><?php echo $row["faculty_dept"] ?></span>
                            </div>

                            <div class="col col-lg-4 col-12 label mt-5">
                                Year Of Joining : <span class="value"><?php echo $row["faculty_yoj"] ?></span>
                            </div>

                            <div class="col col-lg-4 col-12 label mt-5">
                                Date Of Birth : <span class="value"><?php echo $row["faculty_dob"] ?></span>
                            </div>

                            <div class="col col-lg-4 col-12 label mt-5">
                                Parmanent Address : <span class="value"><?php echo $row["faculty_parmenent_address"] ?></span>
                            </div>


                            <div class="col col-lg-4 col-12 label mt-5">
                                Correspondence Address : <span class="value"><?php echo $row["faculty_present_address"] ?></span>
                            </div>


                            <div class="col col-lg-4 col-12 label mt-5">
                                Teaching Experience : <span class="value"><?php echo $row["faculty_teaching_exp"] ?></span>
                            </div>

                            <div class="col col-lg-4 col-12 label mt-5">
                                Industry Experience : <span class="value"><?php echo $row["faculty_industry_exp"] ?></span>
                            </div>

                            <div class="col col-lg-4 col-12 label mt-5">
                                AICTE ID : <span class="value"><?php echo $row["faculty_aicte_id"] ?></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="font-style: italic;font-weight:600;color:black;">
                        Education Details
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row mt-4">
                            <h5> <em>UG</em> </h5>
                            <hr>
                            <div class="col col-lg-4 col-12 label ">
                                BE DEPT : <span class="value"><?php echo $row["faculty_ug_dept"] ?></span>
                            </div>
                            <div class="col col-lg-4 col-12 label ">
                                Year of Passing : <span class="value"><?php echo $row["faculty_ug_year"] ?></span>
                            </div>
                            <div class="col col-lg-4 col-12 label ">
                                College name: <span class="value"><?php echo $row["faculty_ug_college"] ?></span>
                            </div>
                            <br>
                            <h5> <em> PG</em> </h5>
                            <hr>
                            <div class="col col-lg-4 col-12 label mt-2 mb-2">
                                M Tech,DEPARTMENT : <span class="value"><?php echo $row["faculty_pg_dept"] ?></span>
                            </div>

                            <div class="col col-lg-4 col-12 label mt-2 mb-2 ">
                                Year of Passing: <span class="value"><?php echo $row["faculty_pg_year"] ?></span>
                            </div>
                            <div class="col col-lg-4 col-12 label mt-2 mb-2 ">
                                College name: <span class="value"><?php echo $row["faculty_pg_college"] ?></span>
                            </div>
                            <h5> <em> PHD</em> </h5>
                            <hr>
                            <div class="col col-lg-4 col-12 label mt-5 ">
                                Registration date : <span class="value"><?php echo $row["faculty_phd_reg"] ?></span>
                            </div>
                            <div class="col col-lg-4 col-12 label mt-5 ">
                                Current Status : <span class="value"><?php echo $row["faculty_phd_status"] ?></span>
                            </div>
                            <div class="col col-lg-4 col-12 label mt-5 ">
                                Guide Name : <span class="value"><?php echo $row["faculty_phd_guide"] ?></span>
                            </div>
                            <div class="col col-lg-4 col-12 label mt-5 ">
                                Topic of research : <span class="value"><?php echo $row["faculty_phd_topic"] ?></span>
                            </div>
                            <div class="col col-lg-4 col-12 label mt-5 ">
                                Research Domain : <span class="value"><?php echo $row["faculty_phd_domain"] ?></span>
                            </div>
                            <div class="col col-lg-4 col-12 label mt-5 ">
                                University/research center : <span class="value"><?php echo $row["faculty_phd_center"] ?></span>
                            </div>
                            <div class="col col-lg-4 col-12 label mt-5 ">
                                Year of joining : <span class="value"><?php echo $row["faculty_phd_yoj"] ?></span>
                            </div>
                            <div class="col col-lg-4 col-12 label mt-5 ">
                                Year of completion : <span class="value"><?php echo $row["faculty_phd_complition"] ?></span>
                            </div>
                            <div class="col col-lg-4 col-12 label mt-5 ">
                                Teaching Subjects : <span class="value"><?php echo $row["faculty_sub_handel"] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



<?php
}
?>

<?php
$que = "select * from faculty_workshop_details where faculty_id=\"$faculty_id\"";
$result = $con->query($que);
?>
<div class="card mt-3" style="padding:3%; box-shadow: 1px 5px 18px black; border:1px solid white">
    <p style="font-style: italic;font-weight:600;color:black;">Workshop Details</p>
    <?php
    if (mysqli_num_rows($result) < 1) {
        echo "<p>No Workshop is Added</p>";
    }
        ?>
    <?php
    foreach ($result as $r) {

    ?>

        <div class="row">
            <div class="row">
                <div class="col col-lg-4 col-12 label mt-5">
                    Workshop Name : <span class="value"><?php echo $r["faculty_workshop_name"] ?></span>
                </div>
                <div class="col col-lg-4 col-12 label mt-5">
                    Workshop Title : <span class="value"><?php echo $r["faculty_workshop_title"] ?></span>
                </div>
                <div class="col col-lg-4 col-12 label mt-5">
                    No of Days Conducted : <span class="value"><?php echo $r["faculty_workshop_no_of_days"] ?></span>
                </div>
            </div>
            <hr>
        </div>
    <?php
    }
    ?>

</div>

<?php

$que = "select * from faculty_ppr_details where faculty_id=\"$faculty_id\"";
// echo $que;
$result = $con->query($que);
?>

<div class="card mt-3" style="padding:3%; box-shadow: 1px 5px 18px black;border:1px solid white">
    <div class="row">
        <p style="font-style: italic;font-weight:600;color:black;">Published Paper Details </p>
        <?php
    if (mysqli_num_rows($result) < 1) {
        echo "<p>No Paper is Added</p>";
    }
        ?>
        <?php
        foreach ($result as $r) {
        ?>

            <div class="row">
                <div class="col col-lg-4 col-12 label mt-5">
                    Paper Type : <span class="value"><?php echo $r["faculty_ppr_type"] ?></span>
                </div>
                <div class="col col-lg-4 col-12 label mt-5">
                    Academic Year : <span class="value"><?php echo $r["faculty_ppr_year"] ?></span>
                </div>
                <div class="col col-lg-4 col-12 label mt-5">
                    Title of the Paper : <span class="value"><?php echo $r["faculty_ppr_title"] ?></span>
                </div>
                <div class="col col-lg-4 col-12 label mt-5">
                    Name of the Journal/Conference :<span class="value"><?php echo $r["faculty_ppr_jourrnal"] ?></span>
                </div>
                <div class="col col-lg-4 col-12 label mt-5">
                    Date of Publication : <span class="value"><?php echo $r["faculty_ppr_pub_date"] ?></span>
                </div>
                <div class="col col-lg-4 col-12 label mt-5">
                    Volume : <span class="value"><?php echo $r["faculty_ppr_volume"] ?></span>
                </div>
                <div class="col col-lg-4 col-12 label mt-5">
                    Issue : <span class="value"><?php echo $r["faculty_ppr_issue"] ?></span>
                </div>
                <div class="col col-lg-4 col-12 label mt-5">
                    ISSN no : <span class="value"><?php echo $r["faculty_ppr_issn"] ?></span>
                </div>
            </div>


            <hr>
        <?php
        }

        ?>
    </div>
</div>


<?php
include("../template/footer-fac.php");
?>