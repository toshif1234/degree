<?php
require_once "../config.php";
$con=$link;
error_reporting(0);
include(
"../template/stud_auth.php");
include("../template/student_sidebar.php");
?>


<!DOCTYPE html>
<html lang="en">
<!-- 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../asset/style/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/style/style_fac.css">
    <link rel="shortcut icon" href="../asset/img/1aiet-logo.png" />
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
</head> -->

<body>
    <!-- <style>
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
        .dropdown-toggle::after {
            display: none;
        }
    </style>
    </style> -->
    <!-- <div class="wrapper"> -->
        <!-- Sidebar  -->
        <!-- <nav id="sidebar"> -->
            <!-- <div class="sidebar-header">
                <div style="margin-left: 50px;">
                    <a href="student_dashboard.php">
                        <img src="../asset/img/1aiet-logo.png" style="height: 10vh; " class="img-fluid ml-auto" alt="" srcset="">
                    </a>
                </div>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="student_login_view.php">IA Marks</a>
                </li>




            </ul>


        </nav> -->

        <!-- Page Content  -->
        <!-- <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: flex-end">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#" onclick="alert('notificaions')"><i class="fas fa-bell"></i></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle btn btn-primary" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" style="border-radius: 50%; color: #fff" aria-expanded="false">

                                    <?php // echo $_SESSION["username"][-3]  ?>
                                    <?php //echo $_SESSION["username"][-2]  ?>
                                    <?php //echo $_SESSION["username"][-1]  ?>

                                </a>
                                <div class="dropdown-menu" style="position: absolute; left: -150%;">
                                    <a class="nav-link" href="./student_login_profile_view.php"><i class="fa fa-user"><span style="margin-left:20%;">Profile</span></i></a>
                                    <a class="nav-link" href="../reset-password.php"><i class="fas fa-key p-1"> Reset Password</i></a>
                                    <a class="nav-link" href="../logout.php"><i class="fas fa-power-off p-1"> Logout</i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav> -->
            <!-- page content start -->
            <div>
                <!-- sahxjsahs -->
                <?php
                // $con = mysqli_connect("localhost", "root", "", "erp_alvas");
                // if (mysqli_connect_error()) {
                //     echo "error";
                // } else {
                    $admission_no = $_SESSION["admission_no"];

                    $que = "select * from sslc_details where adm_no=\"$admission_no\"";
                    $re = $con->query($que);
                    foreach ($re as $r) {
                ?>

                        <form action="upadte_profile_sslc_details.php" method="post">
                            <div class="form-group col-md-6">
                                <label for="adm_no">Admission Number<span style="color:red">*</span> </label>
                                <input type="text" name="adm_no" class="form-control" id="adm_no" value="<?php echo  $admission_no ?>" readonly>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="sslc_reg_no">Register Number :</label>
                                    <input type="text" name="sslc_reg_no" class="form-control" id="sslc_reg_no" required value="<?php echo $r["sslc_reg_no"] ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sslc_school">School :</label>
                                    <input type="text" name="sslc_school" class="form-control" id="sslc_school" value="<?php echo $r["sslc_school"] ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sslc_board_university">Board/University :</label>
                                    <input type="text" name="sslc_board_university" class="form-control" id="sslc_board_university" value="<?php echo $r["sslc_board_university"] ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="sslc_year">Year of Pass :</label>
                                    <input type="text" name="sslc_year" class="form-control" id="sslc_year" value="<?php echo $r["sslc_year"] ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sslc_max_marks">Maximum Marks :</label>
                                    <input type="text" name="sslc_max_marks" class="form-control" id="sslc_max_marks" value="<?php echo $r["sslc_max_marks"] ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sslc_obtained_marks">Obtained Marks :</label>
                                    <input type="text" name="sslc_obtained_marks" class="form-control" id="sslc_obtained_marks" value="<?php echo $r["sslc_obtained_marks"] ?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sslc_percentage">Percentage :</label>
                                    <input type="text" name="sslc_percentage" class="form-control" id="sslc_percentage" value="<?php echo $r["sslc_percentage"] ?>">
                                </div>
                            </div>
                            <button type="submit">update</button>
                        </form>
                <?php
                    }
               // } ?>





            </div>
            <!-- page content end -->
        </div>
    </div>
    <script src="../asset/style/bootstrap.bundle.min.js"></script>
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