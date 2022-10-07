<?php
// session_start();
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
require_once '../config.php';
                error_reporting(0);

$img_path = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkkBpQ9U04geL7EKfAaXSxUCshUNLfDTKzlQ&usqp=CAU";
$p1 = 'select * from display_pic where username="' . $_SESSION["username"] . '"';
$res9 = $link->query($p1);
// print_r($res9);
if (mysqli_num_rows($res9) > 0) {
    $res9 = mysqli_fetch_assoc($res9);
    $img_path = $res9["dp"];
}



?>

<?php
$con = $link;
$faculty_name = $_SESSION["username"];

$que = "select * from faculty_details where faculty_name=\"$faculty_name\"";

$result = $con->query($que);
foreach ($result as $row) {
    $faculty_id = $row['faculty_id'];
    $_SESSION['faculty_id'] = $faculty_id;

?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <style>
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

        .custom-card {
            padding: 3%;
            box-shadow: 0px 0px 50px 1px rgba(189, 161, 161, 0.452) inset;
            border: 1px solid rgba(46, 32, 32, 0.329);
            background: rgba(159, 85, 219, 0.082);
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
    </style>

    <div class="card custom-card">
        <div class="container">
            <div class="row" style="align-items: center !important; justify-content: center">
                <div class="col-sm-12 col-md-4 img-container">
                    <div id="image_wraper" style="position: relative;">
                        <img id="profile_pich" src="<?php echo $img_path ?>" style="margin: 0%;padding:0%;width:250px;height:250px;">
                        <button id="profileImage" class="profileUpload btn btn-warning btn-sm" style="border-radius: 50%;">
                            <i class="fas fa-camera"></i>
                        </button>
                        <form action="delete_profile_pick.php" method="post">
                            <button id="profileDelete" class="profileDelete btn btn-danger btn-sm" style="border-radius: 50%;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <form action="faculty_profile_pick_upload.php" method="post" style="display: none;" enctype="multipart/form-data">
                            <input id="imageUpload" name="path" type="file" accept="image/png, image/gif, image/jpeg" />
                            <input type="submit" value="Submit" name="profile_pick" id="profile_pick_submit">
                        </form>
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
                                Permanent Address : <span class="value"><?php echo $row["faculty_parmenent_address"] ?></span>
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
        <form action="faculty_view_edit.php" method="post">
            <button type="submit" class="btn" style="float: right;"><i class="fas fa-edit"></i></button>
        </form>
    </div>



<?php
}
?>
<?php
$con = $link;
// $faculty_id = $_SESSION["username"];
// $faculty_name = $_SESSION["username"];
// $q = "select faculty_id from faculty_details where faculty_name=\"$faculty_name\"";
$que = "select * from faculty_workshop_details where faculty_id=\"$faculty_id\"";

$result = $con->query($que);


?>
<div class="card mt-3" style="padding:3%; box-shadow: 1px 5px 18px black; border:1px solid white">
    <p style="font-style: italic;font-weight:600;color:black;">Workshop Details</p>

    <a href="faculty_workshop.php"><button type="button">Add Workshop </button></a>

    <?php
    foreach ($result as $r) {

    ?>


        <div class="row">
            <form action="faculty_workshop_edit.php" method="post">

                <input type="text" name="workshop_id" hidden id="workshop_id" value=<?php echo $r["workshop_id"] ?>>

                <input type="text" name="faculty_id" id="faculty_id" value="<?php echo $r["faculty_id"] ?>" hidden>
                <input type="text" name="work_name" id="" value="<?php echo $r["faculty_workshop_name"] ?>" hidden>
                <input type="text" name="work_title" id="" value="<?php echo $r["faculty_workshop_title"] ?>" hidden>
                <input type="text" name="work_days" id="" value="<?php echo $r["faculty_workshop_no_of_days"] ?>" hidden>

                <div class="row">
                    <div class="col col-lg-4 col-12 label mt-5">
                        Workshop Title : <span class="value"><?php echo $r["faculty_workshop_name"] ?></span>
                    </div>
                    <div class="col col-lg-4 col-12 label mt-5">
                        Workshop Organized By : <span class="value"><?php echo $r["faculty_workshop_title"] ?></span>
                    </div>
                    <div class="col col-lg-4 col-12 label mt-5">
                        No of Days Conducted : <span class="value"><?php echo $r["faculty_workshop_no_of_days"] ?></span>
                    </div>
                </div>

                <input type="text" name="id" id="" value="<?php echo $r["faculty_id"] ?>" hidden>
                <button type="submit" class="btn" style="float: right;"><i class="fas fa-edit"></i></button>
            </form>
            <form action="fac_delete_workshop.php" method="POST">
                <input type="text" name="workshop_id" id="" value=<?php echo $r["workshop_id"] ?> hidden>
                <button type="submit" class="btn" style="float: right;"><i class="far fa-trash-alt"></i></button>
            </form>
            <hr>
        </div>
    <?php
    }
    ?>

</div>


<?php
$con = $link;
// $faculty_name = $_SESSION["username"];
// $q = "select faculty_id from faculty_details where faculty_name=\"$faculty_name\"";
// $result = $con->query($q);
// $row = $result->fetch_assoc();
// $faculty_id = $row["faculty_id"];
// echo $faculty_id;

// $faculty_id = $_SESSION["username"];
$que = "select * from faculty_ppr_details where faculty_id=\"$faculty_id\"";
// echo $que;
$result = $con->query($que);
?>

<div class="card mt-3" style="padding:3%; box-shadow: 1px 5px 18px black;border:1px solid white">
    <div class="row">
        <p style="font-style: italic;font-weight:600;color:black;">Published Paper Details </p>
        <a href="faculty_ppr.php"><button type="button">Add Paper </button></a>
        <?php
        foreach ($result as $r) {
        ?>
            <form action="faculty_paper_edit.php" method="post">
                <input type="text" name="paper_id" id="" value="<?php echo $r["paper_id"] ?>" hidden>

                <input type="text" name="faculty_id" id="" value="<?php echo $r["faculty_id"] ?>" hidden>
                <input type="text" name="faculty_ppr_type" id="" value="<?php echo $r["faculty_ppr_type"] ?>" hidden>
                <input type="text" name="faculty_ppr_year" id="" value="<?php echo $r["faculty_ppr_year"] ?>" hidden>
                <input type="text" name="faculty_ppr_title" id="" value="<?php echo $r["faculty_ppr_title"] ?>" hidden>
                <input type="text" name="faculty_ppr_jourrnal" id="" value="<?php echo $r["faculty_ppr_jourrnal"] ?>" hidden>
                <input type="text" name="faculty_ppr_pub_date" id="" value="<?php echo $r["faculty_ppr_pub_date"] ?>" hidden>
                <input type="text" name="faculty_ppr_volume" id="" value="<?php echo $r["faculty_ppr_volume"] ?>" hidden>
                <input type="text" name="faculty_ppr_issue" id="" value="<?php echo $r["faculty_ppr_issue"] ?>" hidden>
                <input type="text" name="faculty_ppr_issn" id="" value="<?php echo $r["faculty_ppr_issn"] ?>" hidden>

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
                <button type="submit" class="btn" style="float: right;"><i class="fas fa-edit"></i></button>

            </form>
            <form action="fac_delete_paper.php" method="POST">
                <input type="text" name="paper_id" id="" value="<?php echo $r["paper_id"] ?>" hidden>
                <button type="submit" class="btn" style="float: right;"><i class="far fa-trash-alt"></i></button>
            </form>
            <hr>
        <?php
        }
        $x = $_SESSION['falg_pic'] ?? 1;
        ?>
    </div>
</div>


<!-- page content end -->
</div>
<script>
    x = <?php echo $x ?>;
    $("#profileImage").click(function(e) {
        $("#imageUpload").click();
    });

    function fasterPreview(uploader) {
        if (uploader.files && uploader.files[0]) {
            $('#profile_pich').attr('src',
                window.URL.createObjectURL(uploader.files[0]));
            if (x > 0) {
                $("#profile_pick_submit").click();
                <?php unset($_SESSION['flag_pic']) ?>;
            }

        }
    }

    $("#imageUpload").change(function() {
        fasterPreview(this);
    });
</script>
</div>
<script src="../asset/style/bootstrap.bundle.min.js"></script>
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