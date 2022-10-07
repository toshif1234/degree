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
                                <a href="student_login_profile_view.php"><button type="sumbit" class="btn" style="border-radius: 40%;background-color: red;font-size: 12px;">
                                    <?php echo $_SESSION["username"][-3]  ?>
                                    <?php echo $_SESSION["username"][-2]  ?>
                                    <?php echo $_SESSION["username"][-1]  ?>
                                </button></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- page content start -->
            <div>
                <?php echo $_SESSION["username"]?>
                <h4>IA1 Marks</h4>
                <table class="table table-responsive">
                    <tbody>
                        <tr>
                            <th>Branch</th>
                            <th>Semester</th>
                            <th>Section</th>
                            <th>Subjects</th>
                            <th>1a</th>
                            <th>1b</th>
                            <th>1c</th>
                            <th>2a</th>
                            <th>2b</th>
                            <th>2c</th>
                            <th>3a</th>
                            <th>3b</th>
                            <th>3c</th>
                            <th>4a</th>
                            <th>4b</th>
                            <th>4c</th>
                            <th>Total</th>

                        </tr>
                        <?php
                        
                            $usn = $_SESSION["username"];
                            $que = "select * from ia_marks1 where usn=\"$usn\"";
                            $result = $con->query($que);
                            foreach ($result as $row) {
                              
                        ?>

                                <tr>
                                    <td>
                                        <?php echo $row["branch"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["sem"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["sec"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["sub"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["1a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["1b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["1c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["2a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["2b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["2c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["3a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["3b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["3c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["4a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["4b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["4c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["total"] ?>
                                    </td>
                                </tr>



                        <?php
                            }
                         ?>
                    </tbody>
                </table>


                <h4>IA2 Marks</h4>
                <table class="table table-responsive">
                    <tbody>
                        <tr>
                            <th>Branch</th>
                            <th>Semester</th>
                            <th>Section</th>
                            <th>Subjects</th>
                            <th>1a</th>
                            <th>1b</th>
                            <th>1c</th>
                            <th>2a</th>
                            <th>2b</th>
                            <th>2c</th>
                            <th>3a</th>
                            <th>3b</th>
                            <th>3c</th>
                            <th>4a</th>
                            <th>4b</th>
                            <th>4c</th>
                            <th>Total</th>

                        </tr>
                        <?php
                        $con = mysqli_connect("localhost", "root", "", "erp_alvas");
                        if (mysqli_connect_error()) {
                            echo "error";
                        } else {
                            $usn = $_SESSION["username"];
                            $que = "select * from ia_marks2 where usn=\"$usn\"";
                            $result = $con->query($que);
                            foreach ($result as $row) {
                        ?>

                                <tr>
                                    <td>
                                        <?php echo $row["branch"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["sem"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["sec"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["sub"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["1a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["1b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["1c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["2a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["2b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["2c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["3a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["3b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["3c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["4a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["4b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["4c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["total"] ?>
                                    </td>
                                </tr>


                        <?php
                            }
                        } ?>
                    </tbody>
                </table>


                <h4>IA3 Marks</h4>
                <table class="table table-responsive">
                    <tbody>
                        <tr>
                            <th>Branch</th>
                            <th>Semester</th>
                            <th>Section</th>
                            <th>Subjects</th>
                            <th>1a</th>
                            <th>1b</th>
                            <th>1c</th>
                            <th>2a</th>
                            <th>2b</th>
                            <th>2c</th>
                            <th>3a</th>
                            <th>3b</th>
                            <th>3c</th>
                            <th>4a</th>
                            <th>4b</th>
                            <th>4c</th>
                            <th>Total</th>

                        </tr>

                        <?php
                        $con = mysqli_connect("localhost", "root", "", "erp_alvas");
                        if (mysqli_connect_error()) {
                            echo "error";
                        } else {
                            $usn = $_SESSION["username"];
                            $que = "select * from ia_marks3 where usn=\"$usn\"";
                            $result = $con->query($que);
                            foreach ($result as $row) {
                        ?>

                                <tr>
                                    <td>
                                        <?php echo $row["branch"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["sem"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["sec"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["sub"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["1a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["1b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["1c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["2a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["2b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["2c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["3a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["3b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["3c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["4a"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["4b"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["4c"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row["total"] ?>
                                    </td>
                                </tr>



                        <?php
                            }
                        } ?>

                    </tbody>
                </table>

                <h1>you have logged in as Student <?php echo $_SESSION["username"] ?></h1>


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