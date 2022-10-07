<?php
require_once "../config.php";
$con = $link;
include("../template/stud_auth.php");
error_reporting(0);
include("../template/student_sidebar.php");


$img_path = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkkBpQ9U04geL7EKfAaXSxUCshUNLfDTKzlQ&usqp=CAU';
$p1 = 'select * from display_pic where username="' . $_SESSION["username"] . '"';
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
<!-- <div> -->
<?php
// echo $_SESSION["username"];
// $con = mysqli_connect("localhost", "root", "", "erp_alvas");
// if (mysqli_connect_error()) {
//     echo "error";
// } else {
$usn = $_SESSION["username"];
$que = "select * from students where usn=\"$usn\"";
$result = $con->query($que);
foreach ($result as $row) {
?>

    <div class="card" style="padding:3%;">
        <div class="row">
            <div class="col-sm-12 col-md-4 img-container">
                <div id="image_wraper" style="position: relative;">
                    <img id="profile_pich" src="<?php echo $img_path ?>" style="margin: 0%;padding:0%;width:250px;height:250px;">
                    <button id="profileImage" class="profileUpload btn btn-warning btn-sm" onclick="document.getElementById('imageUpload').click()" style="border-radius: 50%;">
                        <i class="fas fa-camera"></i>
                    </button>
                    <form action="Student_Profile_pick_delete.php" method="post">
                        <button id="profileDelete" class="profileDelete btn btn-danger btn-sm" style="border-radius: 50%;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    <form action="Student_profile_pick_upload.php" method="post" style="display: none;" enctype="multipart/form-data">
                        <input id="imageUpload" onchange="" name="path" type="file" accept="image/png, image/gif, image/jpeg" />
                        <input type="submit" value="Submit" name="profile_pick" id="profile_pick_submit">
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-6" style="text-align: center;">
                <div class="row">
                    <h3>
                        <span>
                            <?php echo $row["fname"] ?>
                            <?php echo $row["mname"] ?>
                            <?php echo $row["lname"] ?>
                        </span>
                    </h3>
                </div>
                <div class="row">

                    <span>
                        <?php echo $row["usn"] ?>
                    </span>

                </div>
                <div class="row">
                    <span class="value"><?php echo $row["email_id"] ?></span>
                </div>
                <div class="row">
                    <span class="value"><?php echo $row["mob_no"] ?></span>
                </div>
            </div>

        </div>
    </div>



    <div class="card mt-2" style="padding:3%;">

        <div class="row">

            <p style="font-style: italic;font-weight:600;color:black;">Basic Details</p>

            <div class="col col-lg-4 col-12 label mt-2">
                Admssion Number : <span class="value"><?php echo $row["adm_no"] ?></span>


            </div>

            <div class="col col-lg-4 col-12 label mt-2">
                Gender : <span class="value"><?php echo $row["gender"] ?></span>


            </div>

            <div class="col col-lg-4 col-12 label mt-2">
                Semester : <span class="value"><?php echo $row["semester"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Section : <span class="value"><?php echo $row["section"] ?></span>


            </div>


            <div class="col col-lg-4 col-12 label mt-2">
                Branch : <span class="value"><?php echo $row["branch"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Mobile Number : <span class="value"><?php echo $row["mob_no"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Aadhar Number : <span class="value"><?php echo $row["aadhar"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Date Of Admission : <span class="value"><?php echo $row["data_of_admission"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Nationality : <span class="value"><?php echo $row["nationality"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                KCET : <span class="value"><?php echo $row["kcet"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                COMED-K : <span class="value"><?php echo $row["comedk"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                JEE : <span class="value"><?php echo $row["jee"] ?></span>


            </div>
        </div>
        <div class="row mt-4">
            <p style="font-style: italic;font-weight:600;color:black;">Present Address</p>
            <div class="col col-lg-4 col-12 label ">
                State : <span class="value"><?php echo $row["present_state"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label ">
                District : <span class="value"><?php echo $row["present_dist"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label ">
                House Number : <span class="value"><?php echo $row["present_house_no_name"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Address : <span class="value"><?php echo $row["present_post_village"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2 ">
                Pin-Code : <span class="value"><?php echo $row["present_pincode"] ?></span>


            </div>
        </div>

        <div class="row mt-4">
            <p style="font-style: italic;font-weight:600;color:black;">Permanent Address</p>
            <div class="col col-lg-4 col-12 label ">
                State : <span class="value"><?php echo $row["permanent_state"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label ">
                District : <span class="value"><?php echo $row["permanent_dist"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label ">
                House Number : <span class="value"><?php echo $row["permanent_house_no_name"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Address : <span class="value"><?php echo $row["permanent_post_village"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2 ">
                Pin-Code : <span class="value"><?php echo $row["permanent_pin_code"] ?></span>


            </div>
        </div>
        <form action="student_view_edit.php" method="post">
            <button type="submit" class="btn" style="float: right;"><i class="fas fa-edit"></i></button>
        </form>
    </div>


<?php
}
// } 
?>
<div class="card mt-2" style="padding:3%;">

    <div class="row">

        <p style="font-style: italic;font-weight:600;color:black;">Hostel Details</p>


        <?php
        $que = 'select * from hostel_details where usn = "' . $_SESSION["username"] . '"';
        $res =  $link->query($que);
        $s = mysqli_fetch_assoc($res);
        if (mysqli_num_rows($res) == 0) {
        ?>
            <a href="../student_profile/student_login_profile_hostel_add.php"><button type="submit" class="btn btn-primary" style="float: right;">Add Detail</button></a>

        <?php
        } else {
        ?>
            <div class="col col-lg-4 col-12 label mt-2">
                Hostel Name: <span class="value"><?php echo $s["hostel_name"] ?></span>


            </div>

            <div class="col col-lg-4 col-12 label mt-2">
                Hostel Block : <span class="value"><?php echo $s["hostel_block"] ?></span>


            </div>
            <form action="student_login_profile_hostel_edit.php" method="post">
                <button type="submit" class="btn" style="float: right;"><i class="fas fa-edit"></i></button>
            </form>
        <?php
        }
        ?>



        <!-- page content end -->
    </div>
</div>
<!-- Parent details -->


<?php

$usn = $_SESSION["username"];
$que = "select adm_no from students where usn=\"$usn\"";
$result = $con->query($que);

foreach ($result as $row) {

    $admission_no = $row["adm_no"];
    $_SESSION["adm_no"] = $row["adm_no"];
    $que = "select * from parents_details where adm_no=\"$admission_no\"";
    // echo $que;
    $re1 = $con->query($que);
    // print_r($re1);
    foreach ($re1 as $r1) {
?>


        <div class="card mt-3" style="padding:3%;">
            <div class="row">
                <p style="font-style: italic;font-weight:600;color:black;">Parents Details</p>
                <p style="font-style: italic;font-weight:600;color:black;">Father Details</p>
                <div class="col col-lg-4 col-12 label mt-2">
                    Name : <span class="value"><?php echo $r1["father_name"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Mobile Number : <span class="value"><?php echo $r1["father_mob_no"] ?></span>



                </div>


                <div class="col col-lg-4 col-12 label mt-2">
                    Email ID : <span class="value"><?php echo $r1["father_email_id"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Aadhar card Number : <span class="value"><?php echo $r1["father_aadhar"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    PAN card Number : <span class="value"><?php echo $r1["father_pan_cad"] ?></span>

                </div>


                <div class="col col-lg-4 col-12 label mt-2">
                    Occupation : <span class="value"><?php echo $r1["father_occupation"] ?></span>


                </div>
                <p style="font-style: italic;font-weight:600;color:black;"></p>
                <p style="font-style: italic;font-weight:600;color:black;">Mother Details</p>
                <div class="col col-lg-4 col-12 label mt-2">
                    Name : <span class="value"><?php echo $r1["mother_name"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Mobile Number : <span class="value"><?php echo $r1["mother_mob_no"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Email ID : <span class="value"><?php echo $r1["mother_email_id"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Aadhar card Number : <span class="value"><?php echo $r1["mother_aadhar"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    PAN card Number : <span class="value"><?php echo $r1["mother_pan_card"] ?></span>

                </div>


                <div class="col col-lg-4 col-12 label mt-2">
                    Occupation : <span class="value"><?php echo $r1["mother_occupation"] ?></span>


                </div>
                <form action="student_login_profile_parents_edit.php" method="post">
                    <button type="submit" class="btn" style="float: right;"><i class="fas fa-edit"></i></button>
                </form>
            </div>
        </div>

<?php
    }
}
// } 
?>








<?php
// $con = mysqli_connect("localhost", "root", "", "erp_alvas");
// if (mysqli_connect_error()) {
//     echo "error";
// } else {
$usn = $_SESSION["username"];
$que = "select adm_no from students where usn=\"$usn\"";
$result = $con->query($que);

foreach ($result as $row) {
    $admission_no = $row["adm_no"];
    $_SESSION["adm_no"] = $row["adm_no"];
    $que = "select * from sslc_details where adm_no=\"$admission_no\"";
    $re = $con->query($que);

    foreach ($re as $r) {
?>


        <div class="card mt-3" style="padding:3%;">
            <div class="row">
                <p style="font-style: italic;font-weight:600;color:black;">SSLC Details</p>

                <div class="col col-lg-4 col-12 label mt-2">
                    School Name : <span class="value"><?php echo $r["sslc_school"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Board : <span class="value"><?php echo $r["sslc_board_university"] ?></span>


                </div>


                <div class="col col-lg-4 col-12 label mt-2">
                    Reg No : <span class="value"><?php echo $r["sslc_reg_no"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Year of Passing :<span class="value"><?php echo $r["sslc_year"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Max Marks: <span class="value"><?php echo $r["sslc_max_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Obtained Marks : <span class="value"><?php echo $r["sslc_obtained_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Percentage : <span class="value"><?php echo $r["sslc_percentage"] ?></span>


                </div>
                <form action="student_login_profile_sslc_edit.php" method="post">
                    <button type="submit" class="btn" style="float: right;"><i class="fas fa-edit"></i></button>
                </form>
            </div>
        </div>

<?php
    }
}
//} 
?>



<?php
// $con = mysqli_connect("localhost", "root", "", "erp_alvas");
// if (mysqli_connect_error()) {
//     echo "error";
// } else {
$usn = $_SESSION["username"];
$que = "select adm_no from students where usn=\"$usn\"";
$result = $con->query($que);

foreach ($result as $row) {
    $_SESSION["admission_no"] = $row["adm_no"];

    $que = "select * from puc_details where adm_no=\"$admission_no\"";
    $re = $con->query($que);

    foreach ($re as $r) {
?>


        <div class="card mt-3" style="padding:3%;">
            <div class="row">
                <p style="font-style: italic;font-weight:600;color:black;">PUC Details</p>

                <div class="col col-lg-4 col-12 label mt-2">
                    College Name : <span class="value"><?php echo $r["puc_school"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Board : <span class="value"><?php echo $r["puc_board_university"] ?></span>


                </div>


                <div class="col col-lg-4 col-12 label mt-2">
                    Reg No : <span class="value"><?php echo $r["puc_reg_no"] ?></span>


                </div>

                <div class="col col-lg-4 col-12 label mt-2">
                    Year of Passing :<span class="value"><?php echo $r["puc_year"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">


                </div>
                <div class="col col-lg-4 col-12 label mt-2">


                </div>


                <div class="col col-lg-4 col-12 label mt-2">
                    Physics Max Marks : <span class="value"><?php echo $r["puc_phy_max_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Physics Obtained Marks : <span class="value"><?php echo $r["puc_phy_obtained_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">


                </div>


                <div class="col col-lg-4 col-12 label mt-2">
                    Maths Max Marks : <span class="value"><?php echo $r["puc_maths_max_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Maths Obtained Marks : <span class="value"><?php echo $r["puc_maths_obtained_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">


                </div>
                <!-- <div class="col col-lg-4 col-12 label mt-2">
                     Total Marks : <span class="value"><?php echo $r["puc_sub_total_marks"] ?></span>


                </div> -->
                <div class="col col-lg-4 col-12 label mt-2">
                    Chemistry Max Marks : <span class="value"><?php echo $r["puc_che_max_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Chemistry Obtained Marks : <span class="value"><?php echo $r["puc_che_obtained_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    English Max Marks : <span class="value"><?php echo $r["puc_eng_max_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    English Obtained Marks : <span class="value"><?php echo $r["puc_eng_obtained_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Bio/CS/E/S Max Marks : <span class="value"><?php echo $r["puc_elective_max_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Bio/CS/E/S Obtained Marks : <span class="value"><?php echo $r["puc_elective_obtained_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Max Marks: <span class="value"><?php echo $r["puc_max_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Obtained Marks : <span class="value"><?php echo $r["puc_obtained_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    Percentage : <span class="value"><?php echo $r["puc_percentage"] ?></span>


                </div>



                <form action="student_login_profile_puc_edit.php" method="post">
                    <button type="submit" class="btn" style="float: right;"><i class="fas fa-edit"></i></button>
                </form>
            </div>
        </div>

<?php
    }
}
//} 
?>




</div>

<!-- page content end -->
</div>
</div>
<?php
$x = $_SESSION['falg_pic'] ?? 1;
?>
<script>
    function fasterPreview(uploader) {
        if (uploader.files && uploader.files[0]) {
            $('#profile_pich').attr('src',
                window.URL.createObjectURL(uploader.files[0]));
            if ("space") {
                document.getElementById("profile_pick_submit").click();
                // $("#profile_pick_submit").click();
                <?php unset($_SESSION['flag_pic']) ?>;
            }

        }
    }

    $("#imageUpload").change(function() {
        fasterPreview(this);
    });
</script>
<?php
include("../template/student-footer.php");
?>