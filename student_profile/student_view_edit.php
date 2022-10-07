<?php
require_once "../config.php";
$con = $link;
error_reporting(0);
include(
"../template/stud_auth.php");
include("../template/student_sidebar.php");
// session_start();
?>


<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    </style>
    <div class="wrapper">
        Sidebar  -->
<!-- <nav id="sidebar">
            <div class="sidebar-header">
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
<!-- <div id="content"> -->

<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                                    <?php // echo $_SESSION["username"][-3]  
                                    ?>
                                    <?php //echo $_SESSION["username"][-2]  
                                    ?>
                                    <?php //echo $_SESSION["username"][-1]  
                                    ?>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav> -->
<!-- page content start -->
<!-- <div> -->



<?php
// $con = mysqli_connect("localhost", "root", "", "erp_alvas");
// if (mysqli_connect_error()) {
//     echo "error";
// } else {


$con = $link;
$usn = $_SESSION["username"];
$que = "select * from students where usn=\"$usn\"";

$result = $con->query($que);
foreach ($result as $row) {


?>

    <form action="students_view_update.php" method="post">
        <div class="row">
            <div class="col col-lg-4 col-12">
                <label for="adm_no">Admission Number :</label>
                <input type="text" name="adm_no" class="form-control" id="adm_no" value=<?php echo $row["adm_no"] ?> readonly>
            </div>
            <div class="col col-lg-4 col-12">
                <label for="usn">USN :</label>
                <input type="text" name="usn" class="form-control" id="usn" readonly value=<?php echo $row["usn"] ?>>
            </div>
            <div class="col col-lg-4 col-12">
                <label for="batch">Batch :</label>
                <input type="text" name="batch" class="form-control" id="batch" readonly value=<?php echo $row["batch"] ?>>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col col-lg-4 col-12">
                <label for="fname">Frist Name :</label>
                <input type="text" name="fname" class="form-cgitontrol" id="fname" value="<?php echo $row["fname"] ?>">
            </div>
            <div class="col col-lg-4 col-12">
                <label for="mname">Middle Name :</label>
                <input type="text" name="mname" class="form-control" id="mname" value="<?php echo $row["mname"] ?>">
            </div>
            <div class="col col-lg-4 col-12">
                <label for="lname">Last Name :</label>
                <input type="text" name="lname" class="form-control" id="lname" value="<?php echo $row["lname"] ?>">
            </div>
        </div>
        <div class="row">

            <div class="col col-lg-12 col-12 mt-2">
                <label for="branch">Branch :</label>
                <select name="branch" id="branch" class="form-control" data-role="select-dropdown" readonly>
                    <option selected value="<?php echo $row["branch"] ?>"><?php echo $row["branch"] ?></option>
                    <!-- <option value="Civil">Civil</option>
                                        <option value="Mechanical">Mechanical</option>
                                        <option value="Computer Science & Engg.">Computer Science & Engg.</option>
                                        <option value="Computer Science & Design">Computer Science & Design</option>
                                        <option value="Agriculture">Agriculture</option>
                                        <option value="Electronic & Communication">Electronic & Communication</option>
                                        <option value="Artifical Intelligence & Machine Learning">Artifical Intelligence & Machine Learning</option>
                                        <option value="Information Science & Engg.">Information Science & Engg.</option> -->
                </select>
            </div>
        </div>


        <div class="row mt-2">
            <div class="col col-lg-4 col-12">
                <label for="kcet">K-CET Rank :</label>
                <input type="text" name="kcet" class="form-control" id="kcet" value=<?php echo $row["kcet"] ?>>
            </div>
            <div class="col col-lg-4 col-12">
                <label for="comedk">COMED-K Rank :</label>
                <input type="text" name="comedk" class="form-control" id="comedk" value=<?php echo $row["comedk"] ?>>
            </div>
            <div class="col col-lg-4 col-12">
                <label for="jee">JEE Rank :</label>
                <input type="text" name="jee" class="form-control" id="jee" value=<?php echo $row["jee"] ?>>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col col-lg-6 col-12">
                <label for="nationality">Nationality :</label>
                <input type="text" name="nationality" class="form-control" id="nationality" value=<?php echo $row["nationality"] ?>>
            </div>

            <div class="col col-lg-6 col-12">
                <label for="data_of_admission">Date Of Admission :</label>
                <input type="date" name="date_of_admission" class="form-control" id="date_of_admission" value=<?php echo $row["data_of_admission"] ?>>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col col-lg-6 col-12">
                <label for="dob">Data of Birth :</label>
                <input type="date" name="dob" class="form-control" id="dob" value=<?php echo $row["dob"] ?>>
            </div>
            <div class="col col-lg-6 col-12">
                <label for="place_of_birth">Place of Birth :</label>
                <input type="text" name="place_of_birth" class="form-control" id="place_of_birth" value=<?php echo $row["place_of_birth"] ?>>
            </div>
            <div class="col col-lg-6 col-12">
                <label for="place_of_birth">Gender :</label>

                <input type="text" name="gender" class="form-control" id="gender" value=<?php echo $row["gender"] ?>>

            </div>
        </div>
        <div class="row mt-2">
            <div class="col col-lg-6 col-12">
                <label for="mob_no">Mobile Number :</label>
                <input type="text" name="mob_no" class="form-control" id="mob_no" value=<?php echo $row["mob_no"] ?>>
            </div>
            <div class="col col-lg-6 col-12">
                <label for="email_id">Email id :</label>
                <input type="email" name="email_id" class="form-control" id="email_id" value="<?php echo $row["email_id"] ?>">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col col-lg-6 col-126">
                <label for="aadhar">Aadhar Number :</label>
                <input type="text" name="aadhar" class="form-control" id="aadhar" value=<?php echo $row["aadhar"] ?>>
            </div>
            <div class="col col-lg-6 col-12">
                <label for="pan_card">Pan card Number :</label>
                <input type="text" name="pan_card" class="form-control" id="pan_card" value=<?php echo $row["pan_card"] ?>>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col col-lg-4 col-12">
                <label for="sc_st">SC/ST :</label>
                <input type="text" name="sc_st" class="form-control" id="sc_st" value=<?php echo $row["sc_st"] ?>>
            </div>
            <div class="col col-lg-4 col-12">
                <label for="caste">CASTE</label>
                <input type="text" name="caste" class="form-control" id="caste" value=<?php echo $row["caste"] ?>>
            </div>
            <div class="col col-lg-4 col-12">
                <label for="annual_income">Annual Income :</label>
                <input type="text" name="annual_income" class="form-control" id="annual_income" value=<?php echo $row["annual_income"] ?>>
            </div>
        </div>

        <div class="row">
            <h4>Present address :</h4> <br>
            <div class="col col-lg-4 col-12">
                <label for="present_house_no_name">House no/name :</label>
                <input type="text" name="present_house_no_name" class="form-control" id="present_house_no_name" value="<?php echo $row["present_house_no_name"] ?>">
            </div>
            <div class="col col-lg-4 col-12">
                <label for="present_post_village">Post and village :</label>
                <input type="text" name="present_post_village" class="form-control" id="present_post_village" value="<?php echo $row["present_post_village"] ?>">
            </div>
            <div class="col col-lg-4 col-12">
                <label for="present_dist">Distict :</label>
                <input type="text" name="present_dist" class="form-control" id="present_dist" value=<?php echo $row["present_dist"] ?>>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-6 col-12">
                <label for="present_state">State :</label>
                <input type="text" name="present_state" class="form-control" id="present_state" value=<?php echo $row["present_state"] ?>>
            </div>
            <div class="col col-lg-6 col-12">
                <label for="present_pin_code">Pin code :</label>
                <input type="text" name="present_pincode" class="form-control" id="present_pin_code" value=<?php echo $row["present_pincode"] ?>>
            </div>
        </div>

        <div class="row">
            <h4>Permanent address : </h4><br>


            <div class="col col-lg-4 col-12">
                <label for="permanent_house_no_name">House no/name :</label>
                <input type="text" name="permanent_house_no_name" class="form-control" id="permanent_house_no_name" value="<?php echo $row["permanent_house_no_name"] ?>">
                                </div>
                                <div class=" col col-lg-4 col-12">
                <label for="permanent_post_village">Post and village :</label>
                <input type="text" name="permanent_post_village" class="form-control" id="permanent_post_village" value="<?php echo $row["permanent_post_village"] ?>">
            </div>
            <div class="col col-lg-4 col-12">
                <label for="permanent_dist">Distict :</label>
                <input type="text" name="permanent_dist" class="form-control" id="permanent_dist" value="<?php echo $row["permanent_dist"] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-4 col-12">
                <label for="permanent_state">State :</label>
                <input type="text" name="permanent_state" class="form-control" id="permanent_state" value=<?php echo $row["permanent_state"] ?>>
            </div>
            <div class="col col-lg-4 col-12">
                <label for="permanent_pin_code">Pin code :</label>
                <input type="text" name="permanent_pin_code" class="form-control" id="permanent_pin_code" value=<?php echo $row["permanent_pin_code"] ?>>
            </div>
        </div>

        <button class="btn btn-primary mt-2 mr-4" type="submit" style="float: right;">update</button>

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