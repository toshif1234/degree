<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
// error_reporting(0);
require_once "../config.php";
$con = $link;
$usn = $_POST["usn"];
// echo $usn;
// $img_path = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkkBpQ9U04geL7EKfAaXSxUCshUNLfDTKzlQ&usqp=CAU';
// $p1 = 'select * from display_pic where username="' . $_SESSION["username"] . '"';
// $res9 = $link->query($p1);
// // print_r($res9);
// if (mysqli_num_rows($res9) > 0) {
//     $res9 = mysqli_fetch_assoc($res9);
//     $img_path = $res9["dp"];
// }
$img_path = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkkBpQ9U04geL7EKfAaXSxUCshUNLfDTKzlQ&usqp=CAU';
$p1 = 'select * from display_pic where username="' . $usn . '"';
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

$que = "select * from students where usn=\"$usn\"";
$result = $con->query($que);
//    print_r($result);
foreach ($result as $row) {
?>

    <div class="card" style="padding:3%;">
        <div class="row">

            <div class="col-sm-12 col-md-4 img-container">
                <div id="image_wraper" style="position: relative;">
                    <img id="profile_pich" src="<?php echo $img_path ?>" style="margin: 0%;padding:0%;width:250px;height:250px;">
                    <!-- <button id="profileImage" class="profileUpload btn btn-warning btn-sm" onclick="document.getElementById('imageUpload').click()" style="border-radius: 50%;">
                        < <i class="fas fa-camera"></i> 
                    </button> -->
                    <!-- <form action="Student_Profile_pick_delete.php" method="post">
                        <button id="profileDelete" class="profileDelete btn btn-danger btn-sm" style="border-radius: 50%;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form> -->
                    <!-- <form action="Student_profile_pick_upload.php" method="post" style="display: none;" enctype="multipart/form-data">
                        <input id="imageUpload" onchange="" name="path" type="file" accept="image/png, image/gif, image/jpeg" />
                        <input type="submit" value="Submit" name="profile_pick" id="profile_pick_submit">
                    </form> -->
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
                Mobile Number :


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
                COME DK : <span class="value"><?php echo $row["comedk"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                JEE : <span class="value"><?php echo $row["jee"] ?></span>


            </div>
        </div>
        <div class="row mt-4">
            <p style="font-style: italic;font-weight:600;color:black;">Present Address</p>
            <div class="col col-lg-4 col-12 label ">
                District: <span class="value"><?php echo $row["present_state"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label ">
                District: <span class="value"><?php echo $row["present_dist"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label ">
                House Number: <span class="value"><?php echo $row["present_house_no_name"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Post Village <span class="value"><?php echo $row["present_post_village"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2 ">
                Pin-Code: <span class="value"><?php echo $row["present_pincode"] ?></span>


            </div>
        </div>

        <div class="row mt-4">
            <p style="font-style: italic;font-weight:600;color:black;">Permanent Address</p>
            <div class="col col-lg-4 col-12 label ">
                District: <span class="value"><?php echo $row["permanent_state"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label ">
                District: <span class="value"><?php echo $row["permanent_dist"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label ">
                House Number: <span class="value"><?php echo $row["permanent_house_no_name"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Post Village <span class="value"><?php echo $row["permanent_post_village"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2 ">
                Pin-Code: <span class="value"><?php echo $row["permanent_pin_code"] ?></span>


            </div>
        </div>

    </div>


<?php
}
// } 
?>

<!-- parents details -->
<?php
// $con = mysqli_connect("localhost", "root", "", "erp_alvas");
// if (mysqli_connect_error()) {
//     echo "error";
// } else {
// $usn = $_SESSION["username"];
$que = "select adm_no from students where usn=\"$usn\"";
$result = $con->query($que);

foreach ($result as $row) {
    $admission_no = $row["adm_no"];
    $_SESSION["adm_no"] = $row["adm_no"];
    $que = "select * from parents_details where adm_no=\"$admission_no\"";
    $re = $con->query($que);

    foreach ($re as $r1) {
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
                    aadhar card Number : <span class="value"><?php echo $r1["mother_aadhar"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    PAN card Number : <span class="value"><?php echo $r1["mother_pan_card"] ?></span>

                </div>


                <div class="col col-lg-4 col-12 label mt-2">
                    Occupation : <span class="value"><?php echo $r1["mother_occupation"] ?></span>


                </div>

            </div>
        </div>

<?php
    }
}
?>

<!-- sslc marks details -->
<?php
// $con = mysqli_connect("localhost", "root", "", "erp_alvas");
// if (mysqli_connect_error()) {
//     echo "error";
// } else {
// $usn = $_SESSION["username"];
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
                    School Board : <span class="value"><?php echo $r["sslc_board_university"] ?></span>


                </div>


                <div class="col col-lg-4 col-12 label mt-2">
                    SSLC Reg No : <span class="value"><?php echo $r["sslc_reg_no"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    SSLC Year :<span class="value"><?php echo $r["sslc_year"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    SSLC Max Marks: <span class="value"><?php echo $r["sslc_max_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    SSLC Obtained Marks : <span class="value"><?php echo $r["sslc_obtained_marks"] ?></span>


                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    SSLC Percentage : <span class="value"><?php echo $r["sslc_percentage"] ?></span>


                </div>

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
// $usn = $_SESSION["username"];


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
                Max Marks: <span class="value"><?php echo $r["puc_max_marks"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                PUC Obtained Marks : <span class="value"><?php echo $r["puc_obtained_marks"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Year :<span class="value"><?php echo $r["puc_year"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Physics maximum marks : <span class="value"><?php echo $r["puc_phy_max_marks"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Physics Obtained marks : <span class="value"><?php echo $r["puc_phy_obtained_marks"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Percentage : <span class="value"><?php echo $r["puc_percentage"] ?></span>


            </div>


            <div class="col col-lg-4 col-12 label mt-2">
                Maths maximum marks : <span class="value"><?php echo $r["puc_maths_max_marks"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Maths Obtained marks : <span class="value"><?php echo $r["puc_phy_obtained_marks"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Subject Total Marks : <span class="value"><?php echo $r["puc_sub_total_marks"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Chemistry maximum marks : <span class="value"><?php echo $r["puc_che_max_marks"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Chemistry Obtained marks : <span class="value"><?php echo $r["puc_phy_obtained_marks"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                English Maximum Marks : <span class="value"><?php echo $r["puc_eng_max_marks"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Bio/CS/E/S maximum marks : <span class="value"><?php echo $r["puc_elective_max_marks"] ?></span>


            </div>
            <div class="col col-lg-4 col-12 label mt-2">
                Bio/CS/E/S Obtained marks : <span class="value"><?php echo $r["puc_elective_obtained_marks"] ?></span>


            </div>

            <div class="col col-lg-4 col-12 label mt-2">
                English Max Marks : <span class="value"><?php echo $r["puc_eng_obtained_marks"] ?></span>


            </div>


        </div>
    </div>

    </div>

    <!-- first ia marks -->
    <div class="card mt-3" style="padding:3%;">
        <p style="font-style: italic;font-weight:600;color:black;">IA 1</p>
        <div class="row">
            <div class="col col-lg-4 col-4 label mt-2">
                Subject name :
            </div>
            <div class="col col-lg-2 col-2 label mt-2">
                Marks 1:
            </div>
            <div class="col col-lg-2 col-2 label mt-2">
                Marks 2:
            </div>
            <div class="col col-lg-2 col-2 label mt-2">
                Marks 3:
            </div>
            <div class="col col-lg-2 col-2 label mt-2">
                attendance :
            </div>
        </div>
        <?php
        $qum = 'select * from marks where usn="' . $row["usn"] . '"';

        $ro = $con->query($qum);

        foreach ($ro as $ri) {
        ?>

            <div class="row">
                <div class="col col-lg-4 col-4 label mt-2">
                    <?php echo $ri["sub"] ?>
                </div>
                <div class="col col-lg-2 col-2 label mt-2">
                    <?php echo $ri["ia1"] ?>
                </div>
                <div class="col col-lg-2 col-2 label mt-2">
                    <?php echo $ri["ia2"] ?>
                </div>
                <div class="col col-lg-2 col-2 label mt-2">
                    <?php echo $ri["ia3"] ?>
                </div>
                <div class="col col-lg-2 col-2 label mt-2">
                    <?php echo $ri["att_avg"] ?>
                </div>
            </div>
        <?php } ?>

    </div>
    <!-- second ia marks -->
    <div class="card mt-3" style="padding:3%;">
        <p style="font-style: italic;font-weight:600;color:black;">IA 2</p>
        <div class="row">
            <div class="col col-lg-6 col-6 label mt-2">
                Subject name :
            </div>
            <div class="col col-lg-6 col-6 label mt-2">
                Marks :
            </div>
        </div>
        <?php
        $qul = "select * from ia_marks2 where adm_no=\"$admission_no\"";

        $rh = $con->query($qul);

        foreach ($rh as $rm) {
        ?>

            <div class="row">
                <div class="col col-lg-6 col-6 label mt-2">
                    <?php echo $rm["sub"] ?>
                </div>
                <div class="col col-lg-6 col-6 label mt-2">
                    <?php echo $rm["total2"] ?>
                </div>
            </div>
        <?php } ?>

    </div>
    <!-- third ia marks -->
    <div class="card mt-3" style="padding:3%;">
        <p style="font-style: italic;font-weight:600;color:black;">IA 3</p>
        <div class="row">
            <div class="col col-lg-6 col-6 label mt-2">
                Subject name :
            </div>
            <div class="col col-lg-6 col-6 label mt-2">
                Marks :
            </div>
        </div>
        <?php
        $qu3 = "select * from ia_marks3 where adm_no=\"$admission_no\"";

        $r3 = $con->query($qu3);

        foreach ($r3 as $rd) {
        ?>

            <div class="row">
                <div class="col col-lg-6 col-6 label mt-2">
                    <?php echo $rd["sub"] ?>
                </div>
                <div class="col col-lg-6 col-6 label mt-2">
                    <?php echo $rd["total3"] ?>
                </div>
            </div>
        <?php } ?>

    </div>







<?php
}
include("../template/footer-fac.php");
?>