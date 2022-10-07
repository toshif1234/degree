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
                
                    $admission_no = $_SESSION["adm_no"];
                   
                    $que = "select * from puc_details where adm_no=\"$admission_no\"";
                    $re = $con->query($que);

                    foreach ($re as $r) {
                ?>
                 <form action="update_profile_puc_details.php" method="post">

                        <h4>PU Details :</h4><br>
                        <div class="form-row">
                        <div class="form-group col-md-4">
                                <label for="puc_reg_no">Admission Number:</label>
                                <input type="text" name="adm_no" class="form-control" id="puc_reg_no"
                                value=<?php echo $admission_no?>
                                >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="puc_reg_no">Register Number :</label>
                                <input type="text" name="puc_reg_no" class="form-control" id="puc_reg_no"
                                value=<?php echo $r["puc_reg_no"]?>
                                >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="puc_collage">College :</label>
                                <input type="text" name="puc_collage" class="form-control" id="puc_collage"
                                value=<?php echo $r["puc_school"]?>
                                >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="puc_board_university">Board/University :</label>
                                <input type="text" name="puc_board_university" class="form-control" id="puc_board_university"
                                value=<?php echo $r["puc_board_university"]?>
                                >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="puc_year">Year of Pass :</label>
                                <input type="text" name="puc_year" class="form-control" id="puc_year"
                                value=<?php echo $r["puc_year"]?>
                                >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="puc_max_marks">Maximum Marks :</label>
                                <input type="text" name="puc_max_marks" class="form-control" id="puc_max_marks"
                                value=<?php echo $r["puc_max_marks"]?>
                                >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="puc_obtained_marks">Obtained Marks :</label>
                                <input type="text" name="puc_obtained_marks" class="form-control" id="puc_obtained_marks"
                                value=<?php echo $r["puc_obtained_marks"]?>
                                >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="puc_percentage">Percentage :</label>
                                <input type="text" name="puc_percentage" class="form-control" id="puc_percentage"
                                value=<?php echo $r["puc_percentage"]?>
                                >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <h6>Physics :</h6>
                                <label for="puc_phy_max_marks">Maximum Marks :</label>
                                <input type="text" name="puc_phy_max_marks" class="form-control" id="puc_phy_max_marks"
                                value=<?php echo $r["puc_phy_max_marks"]?>
                                >
                                <label for="puc_phy_obtained_marks">Obtained Marks :</label>
                                <input type="text" name="puc_phy_obtained_marks" class="form-control" id="puc_phy_obtained_marks"
                                value=<?php echo $r["puc_phy_obtained_marks"]?>
                                >
                            </div>
                            <div class="form-group col-md-3">
                                <h6>Chemistry :</h6>
                                <label for="puc_che_max_marks">Maximum Marks :</label>
                                <input type="text" name="puc_che_max_marks" class="form-control" id="puc_che_max_marks"
                                value=<?php echo $r["puc_che_max_marks"]?>
                                >
                                <label for="puc_che_obtained_marks">Obtained Marks :</label>
                                <input type="text" name="puc_che_obtained_marks" class="form-control" id="puc_che_obtained_marks"
                                value=<?php echo $r["puc_che_obtained_marks"]?>
                                >

                            </div>
                            <div class="form-group col-md-3">
                                <h6>Mathematics :</h6>
                                <label for="puc_maths_max_marks">Maximum Marks :</label>
                                <input type="text" name="puc_maths_max_marks" class="form-control" id="puc_maths_max_marks"
                                value=<?php echo $r["puc_maths_max_marks"]?>
                                >
                                <label for="puc_maths_obtained_marks">Obtained Marks :</label>
                                <input type="text" name="puc_maths_obtained_marks" class="form-control" id="puc_maths_obtained_marks"
                                value=<?php echo $r["puc_maths_obtained_marks"]?>
                                >

                            </div>
                            <div class="form-group col-md-3">
                                <h6>Bio/CS/E/S :</h6>
                                <label for="puc_elective_max_marks">Maximum Marks :</label>
                                <input type="text" name="puc_elective_max_marks" class="form-control" id="puc_elective_max_marks"
                                value=<?php echo $r["puc_elective_max_marks"]?>
                                >
                                <label for="puc_elective_obtained_marks">Obtained Marks :</label>
                                <input type="text" name="puc_elective_obtained_marks" class="form-control" id="puc_elective_obtained_marks">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <h6>English :</h6>
                                <label for="puc_eng_max_marks">Maximum Marks :</label>
                                <input type="text" name="puc_eng_max_marks" class="form-control" id="puc_eng_max_marks"
                                value=<?php echo $r["puc_eng_max_marks"]?>
                                >
                                <label for="puc_eng_obtained_marks">Obtained Marks :</label>
                                <input type="text" name="puc_eng_obtained_marks" class="form-control" id="puc_eng_obtained_marks"
                                value=<?php echo $r["puc_eng_obtained_marks"]?>
                                >

                            </div>
                            <div class="form-group col-md-6">

                                <label for="puc_sub_total_marks">Total Marks :</label>
                                <input type="text" name="puc_sub_total_marks" class="form-control" id="puc_sub_total_marks"
                                value=<?php echo $r["puc_sub_total_marks"]?>
                                >
                                <br><br>
                               
                                <button type="submit" class="btn btn-primary" style="float: right;">Update</button>
                               

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