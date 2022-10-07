<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="../asset/style/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../asset/style/style_admin.css">
    <link rel="shortcut icon" href="../asset/img/1aiet-logo.png" />
</head>
<script>
    function onReady(callback) {
        var intervalId = window.setInterval(function() {
            if (document.getElementsByTagName('body')[0] !== undefined) {
                window.clearInterval(intervalId);
                callback.call(this);
            }
        }, 1000);
    }

    function setVisible(selector, visible) {
        document.querySelector(selector).style.display = visible ? 'flex' : 'none';
    }

    onReady(function() {
        setVisible('.loader', false);
        setVisible('.page', true);
    });
</script>

<body>

    <div class=" loader load-container">
        <div class="loader">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="shadow"></div>
            <div class="shadow"></div>
            <div class="shadow"></div>
            <span style="color: white;">Loading</span>
        </div>
    </div>

    <style>
        /* loading animation and stuff */
        .load-container {
            padding: 0;
            margin: 0;
            width: 100vw !important;
            height: 100vh !important;
            background: radial-gradient(#120d1abf, #080814);
            z-index: 99999999999999;
        }

        .loader {
            width: 200px;
            height: 60px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .circle {
            width: 20px;
            height: 20px;
            position: absolute;
            border-radius: 50%;
            background-color: #fff;
            left: 15%;
            transform-origin: 50%;
            animation: circle .5s alternate infinite ease;
        }

        @keyframes circle {
            0% {
                top: 60px;
                height: 5px;
                border-radius: 50px 50px 25px 25px;
                transform: scaleX(1.7);
            }

            40% {
                height: 20px;
                border-radius: 50%;
                transform: scaleX(1);
            }

            100% {
                top: 0%;
            }
        }

        .circle:nth-child(2) {
            left: 45%;
            animation-delay: .2s;
        }

        .circle:nth-child(3) {
            left: auto;
            right: 15%;
            animation-delay: .3s;
        }

        .alert-read {
            color: #6d6e80;
            background-color: #c8c8c8;
            border-color: #ffffff00;
        }

        .alert-unread {
            color: #454650;
            background-color: #adadad;
            border-color: #8b8b8b9c;
        }

        .shadow {
            width: 20px;
            height: 4px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, .5);
            position: absolute;
            top: 62px;
            transform-origin: 50%;
            z-index: -1;
            left: 15%;
            filter: blur(1px);
            animation: shadow .5s alternate infinite ease;
        }

        @keyframes shadow {
            0% {
                transform: scaleX(1.5);
            }

            40% {
                transform: scaleX(1);
                opacity: .7;
            }

            100% {
                transform: scaleX(.2);
                opacity: .4;
            }
        }

        .shadow:nth-child(4) {
            left: 45%;
            animation-delay: .2s
        }

        .shadow:nth-child(5) {
            left: auto;
            right: 15%;
            animation-delay: .3s;
        }

        .loader span {
            position: absolute;
            top: 75px;
            font-family: 'Lato';
            font-size: 20px;
            letter-spacing: 12px;
            color: #fff;
            left: 15%;
        }

        /* loading animation and stuff */
        .dropdown-item {
            color: #212529;
        }

        .dropdown-item:active {
            color: #FFF !important;
            background-color: #ff8800 !important;
            animation: show 3ms;
        }

        .dropdown-toggle::after {
            display: none;
        }

        #sidebar ul li.active>a,
        a[aria-expanded="true"] {
            color: #fff;
            background: transparent;
        }

        .dropdown-menu[data-bs-popper] {
            /* left: -250%; */
            animation: show 500ms;
        }

        .alert-dismissible .btn-close {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
            padding: 1.25rem 1rem;
        }

        .avatar {
            background-color: #ffe6b8;
            color: orange;
            border: 2px solid orange;
            padding: 13px;
            border-radius: 50%;
            margin: 0;
            width: 40px;
            height: 40px;
            display: flex;
            text-align: center;
            align-content: center;
            justify-content: center;
            align-items: center;
            animation: show 1s;
            text-transform: uppercase;
        }

        body,
        html,
        .wraper {
            background-image: url("../asset/img/bg.png") !important;
            height: 100% !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            height: 100% !important;
            align-content: center !important;
            background: fixed;
        }

        .notification-container {

            position: fixed;
            right: 1%;
            display: none;
            transition: height 0.4s;
            max-height: 400px;
            overflow: scroll;
            overflow-x: hidden;
            z-index: 1;
        }
    </style>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div style="margin-left: 50px;">
                    <a href="../dashboard/admin_dashboard.php">
                        <img src="../asset/img/1aiet-logo.png" style="height: 10vh; " class="img-fluid ml-auto" alt="logo" srcset="">
                    </a>
                </div>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Student</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="../students/students_insert.php">Add Student</a>
                        </li>
                        <li>
                            <a href="../students/student_Select.php">View Student</a>
                        </li>
                        <li class="">
                            <a href="../stud_register/register_select.php">Student Register</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Faculty</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu1">
                        <li>
                            <a href="../faculty/faculty_insert.php">Add Faculty</a>
                        </li>
                        <li>
                            <a href="../faculty/faculty_department.php">View Faculty</a>
                        </li>
                        <li>
                            <a href="../faculty/register.php">Faculty Register</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#Creation" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Creation</a>
                    <ul class="collapse list-unstyled" id="Creation">
                        <li>
                            <a href="../section_creation/batch_selection.php">Section</a>
                        </li>
                        <li class="">
                            <a href="../lab_batch/lab_batch.php">Lab Batch</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Subject</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <?php if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) { ?>
                            <li>
                                <a href="../subject_maping/add_sub.php">Add Subject</a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="../sub_new/add_sub.php">Add Subject</a>
                            </li>
                        <?php } ?>
                        <?php if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) { ?>
                            <li>
                                <a href="../subject_maping/select_sub_branch.php">View Subject</a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="../sub_new/select_sub_branch.php">View Subject</a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="../student_elective_mapping/drop_view_dis.php">Student Elective Mapping</a>
                        </li>
                        <li>
                            <a href="../student_elective_mapping/select_students.php">Faculty-Student Elective Mapping</a>
                        </li>
                        <li>
                            <a href="../subject_maping/faculty_subject_mapping.php">Subject Mapping</a>
                        </li>
                        <li>
                            <a href="../subject_maping/faculty_view.php">Faculty View</a>
                        </li>

                    </ul>
                </li>




                <li>
                    <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">HOD</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu2">
                        <li>
                            <a href="../hod_assign/assign.php">Assign HOD Post</a>
                        </li>
                        <li>
                            <a href="../hod_assign/view_hod.php">View HOD</a>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="../user_privilege/select_dept.php">User Privilege</a>

                </li>
                <li class="">
                    <a href="../archive_creation/archive.php">Transfer Data</a>

                </li>
                <li class="">
                    <a href="../attendance_new/sem_start_end.php">Semester Start End</a>

                </li>
                <li>
                    <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Class Coordinator</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu3">
                        <li>
                            <a href="../cordinator/assign.php">Assign Class Coordinator</a>
                        </li>
                        <li>
                            <a href="../cordinator/view_class.php">View Class Coordinator</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#homeSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">UG Coordinator</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu4">
                        <li>
                            <a href="../cordinator/ug_assign.php">Assign UG Coordinator</a>
                        </li>
                        <li>
                            <a href="../cordinator/view_ug.php">View UG Coordnator</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#homeSubmenu58" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Library Admin</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu58">
                        <li>
                            <a href="../cordinator/lb_assign.php">Assign Library Admin</a>
                        </li>
                        <li>
                            <a href="../cordinator/view_lb.php">View Library Admin</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#homeSubmenu5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Library</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu5">
                        <li>
                            <a href="../library/add_books_main.php">Add Books</a>
                        </li>
                        <li>
                            <a href="../library/Select_View_Books.php">View Books</a>
                        </li>
                        <li>
                            <a href="../library/issue_books.php">Student Issue Books</a>
                        </li>
                        <li>
                            <a href="../library/view_issue_books.php">Student View Issue Books</a>
                        </li>
                        <li>
                            <a href="../library/fac_issue_books.php">Faculty Issue Books</a>
                        </li>
                        <li>
                            <a href="../library/fac_view_issue_books.php">Faculty View Issue Books</a>
                        </li>
                        <li>
                            <a href="../library/request_select.php">Manage Request Books</a>
                        </li>
                        <li>
                            <a href="../library/select_Total_Fine.php">Month Wise Fine</a>
                        </li>


                    </ul>
                </li>

            </ul>


        </nav>

        <!-- Page Content  -->
        <div class="container notification-container" id="notification" style="">
            <div class="row">
                <div class="col-md-6 col-sm-12 d-none d-sm-block"> </div>
                <div class="col-md-6 col-sm-12" style="background-color: #e7e6e6; border:1px solid transparent;border-radius:10px;">
                    <div class="row m-2 mt-4">
                        <div class="col blockquote"> <strong> Notifications </strong></div>
                        <div class="col"></div>
                        <div class="col">
                            <button style="color: #000; background:transparent;border:none; float:right;" onclick="notify()" class="btn btn-secondary"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="row m-2 p-2">
                        <!--  -->
                        <div class="alert alert-warning alert-dismissible fade show alert-read" role="alert">
                            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                            <button type="button" class="btn-close btn" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="alert alert-warning alert-dismissible fade show alert-unread" role="alert">
                            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                            <button type="button" class="btn-close btn" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                            <button type="button" class="btn-close btn" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                            <button type="button" class="btn-close btn" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>
        </div>
        <div id="content">
            <script>
                function notify() {
                    var z = document.getElementById("notification");
                    console.log(z);
                    if (z.style.display !== "none") {
                        z.style.display = "none"
                    } else {
                        z.style.display = "block"
                    }

                }
                notify();
            </script>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" style="width: 40px; background-color:#6a6b6d;border:none" class="btn btn-primary ">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <div class="d-none d-sm-none d-md-block">
                        <h5 style="text-align: center;" class="">Alva's Degree College</h5>
                    </div>

                    <div class="d-md-none d-sm-block">
                        <h5 style="text-align: center;" class=" ">Alva's</h5>
                    </div>
                    <div class="">
                        <div class="row">
                            <div id="Back-btn" class="col">
                                <button class="btn" onclick="window.history.back();">
                                    <i class="fa fa-lg fa-arrow-left"></i>
                                </button>
                            </div>

                            <div class="p-0 m-0 col" id="navbarSupportedContent" style="justify-content: flex-end;">

                                <!-- <div class="collapse navbar-collapse p-0 m-0" id="navbarSupportedContent"
                                    style="justify-content: flex-end;"> -->
                                <!-- <ul class="nav navbar-nav ml-auto"> -->
                                <li class="nav-item dropdown " style="list-style: none;">
                                    <a class="nav-link dropdown-toggle p-0 m-0" style="background-color: none !important;" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        <Span class="p-0 m-0 avatar" style="color:orange; font-size:20px; font-weight:bold;">
                                            <?php
                                            echo 'A';
                                            ?>
                                        </Span>
                                    </a>
                                    <div class="dropdown-menu" style="left: -350%;">
                                        <a class=" dropdown-item" href="../faculty_profile/faculty_login_profile_view.php"> <i class="fas fa-users  p-2"></i> Profile </a>
                                        <a class=" dropdown-item dropdown-toggle" data-bs-toggle="notification" role="button" onclick="notify();" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-bell p-2 "></i> Notifications </a>
                                        <div class="dropdown-divider"></div>
                                        <a class=" dropdown-item" href="../logout.php"><i class="fas fa-power-off p-2">
                                                Logout</i></a>
                                    </div>
                                </li>

                                <!-- </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- page content start -->
            <div>