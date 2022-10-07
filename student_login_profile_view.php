<?php
session_start();
require_once "./config.php";
$con=$link;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./asset/style/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="./asset//style/style.css"> -->
    <link rel="stylesheet" href="asset/style/style_fac.css">
    <title>Document</title>
    <style>
        .label {
            color: #97A1BF;
            font-size: 14px;
            font-weight: 800;
        }

        .value {
            color: #161E37;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <style>
        body,
        html,
        .wraper {
            background-image: url("asset/img/bg.png") !important;
            height: 100vh !important;
            width: 100vw !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            height: 100% !important;
            align-content: center !important;
        }
    </style>
    </style>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div style="margin-left: 50px;">
                    <img src="asset/img/1aiet-logo.png" style="height: 10vh; " class="img-fluid ml-auto" alt="" srcset="">
                </div>
            </div>

            <ul class="list-unstyled components">

                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Lesson Plan</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="lesson_plan.php">Planning and Tracking</a>
                        </li>
                        <li>
                            <a href="#">CO and PO Mapping</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#">Portfolio</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>


        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info ">
                        <i class="fas fa-align-left"></i>

                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: flex-end;">

                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#" onclick="alert('notificaions')"><i class="fas fa-bell "></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php"><i class="fas fa-power-off p-1"> Logout</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="reset-password.php"><i class="fas fa-key p-1"> Reset Password</i></a>
                            </li>
                            <li class="nav-item" style="margin-top: 1%;">
                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal" style="border-radius: 40%;background-color: red;font-size: 12px;">
                                    <?php echo $_SESSION["username"][-3]  ?>
                                    <?php echo $_SESSION["username"][-2]  ?>
                                    <?php echo $_SESSION["username"][-1]  ?>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- page content start -->
            <div>




                <?php
                
                    $usn = $_SESSION["username"];
                    $que = "select * from students where usn=\"$usn\"";
                    $result = $con->query($que);
                    foreach ($result as $row) {
                ?>

                        <div class="card" style="padding:3%;">
                            <div class="row">

                                <div class="col-lg-3 col-6 " style="margin-left: 2%;">

                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkkBpQ9U04geL7EKfAaXSxUCshUNLfDTKzlQ&usqp=CAU" alt="" srcset="" width="80%" height="80%">

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
                            <form action="student_view_edit.php" method="post">
                                <button type="submit" class="btn" style="float: right;"><i class="fas fa-edit"></i></button>
                            </form>
                        </div>


                <?php
                    }
                 ?>



                <?php
                $con = mysqli_connect("localhost", "root", "", "erp_alvas");
                if (mysqli_connect_error()) {
                    echo "error";
                } else {
                    $usn = $_SESSION["username"];
                    $que = "select adm_no from students where usn=\"$usn\"";
                    $result = $con->query($que);
                   
                    foreach ($result as $row) {
                        $admission_no = $row["adm_no"];

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
                                <form action="student_login_profile_sslc_edit.php" method="post">
                                    <button type="submit" class="btn">edit</button>
                                </form>
                            </div>
                        </div>

                <?php
                }
                    }
                } ?>



<?php
                $con = mysqli_connect("localhost", "root", "", "erp_alvas");
                if (mysqli_connect_error()) {
                    echo "error";
                } else {
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
                                   PUC Reg No : <span class="value"><?php echo $r["puc_reg_no"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                    PUC Year :<span class="value"><?php echo $r["puc_year"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                    PUC Max Marks: <span class="value"><?php echo $r["puc_max_marks"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                    PUC Obtained Marks : <span class="value"><?php echo $r["puc_obtained_marks"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                   PUC Percentage : <span class="value"><?php echo $r["puc_percentage"] ?></span>


                                </div>

                                <div class="col col-lg-4 col-12 label mt-2">
                                   PUC Phsics max marks : <span class="value"><?php echo $r["puc_phy_max_marks"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                   PUC Phsics Obtainedmarks : <span class="value"><?php echo $r["puc_phy_obtained_marks"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                   PUC Maths max marks : <span class="value"><?php echo $r["puc_maths_max_marks"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                   PUC Phsics Obtained marks : <span class="value"><?php echo $r["puc_phy_obtained_marks"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                   PUC Chemistrymax marks : <span class="value"><?php echo $r["puc_che_max_marks"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                   PUC Chemistry Obtained marks : <span class="value"><?php echo $r["puc_phy_obtained_marks"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                   PUC Elective max marks : <span class="value"><?php echo $r["puc_elective_max_marks"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                   PUC Elective Obtained marks : <span class="value"><?php echo $r["puc_elective_obtained_marks"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                   PUC Sub Total Marks : <span class="value"><?php echo $r["puc_sub_total_marks"] ?></span>


                                </div>
                                <div class="col col-lg-4 col-12 label mt-2">
                                   PUC Engineering Max Marks : <span class="value"><?php echo $r["puc_eng_obtained_marks"] ?></span>


                                </div>

                                <form action="student_login_profile_puc_edit.php" method="post">
                                    <button type="submit" class="btn">edit</button>
                                </form>
                            </div>
                        </div>

                <?php
                }
                    }
                } ?>




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