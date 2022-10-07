<?php
// session_start();
$s = 'select * from students where usn="' . $_SESSION["username"] . '"';
$res = $link->query($s);
$res = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../asset/style/bootstrap.min.css" />
    <link rel="stylesheet" href="../asset/style/style_fac.css" />
    <link rel="shortcut icon" href="../asset/img/1aiet-logo.png" />
    <title>Student | Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../asset/style/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/style/style_fac.css">
    <link rel="shortcut icon" href="../asset/img/1aiet-logo.png" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../asset/style/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/style/style_student.css">
    <link rel="shortcut icon" href="../asset/img/1aiet-logo.png" />
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../asset/style/bootstrap.min.css" />
</head>

<body>
    <div class=" loader load-container">
        <div>
            <div class="wrapper">
                <div class="circle">
                    <div class="yinyang"></div>
                    <div class="yinyang"></div>
                </div>
            </div>
            <h3 class="mt-3">

                Loading....

            </h3>

        </div>
    </div>
    <style>
        * {
            transition: 0.7s ease-in-out !important;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-menu[data-bs-popper] {
            left: -360%;
            animation: show 500ms;
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

        .alert-read {
            color: #fff;
            background-color: #ce93d8;
            border-color: #ffffff00;
        }

        .alert-unread {
            color: #fff;
            background-color: #AB47BC;
            border-color: #8b8b8b9c;
        }

        @keyframes show {
            0% {
                opacity: 30%;
            }

            100% {
                opacity: 100%;
            }

        }

        #sidebar ul li.active>a,
        a[aria-expanded="true"] {
            background: transparent
        }

        #sidebar ul.components {
            border: none !important;
        }

        /* loading screen */

        .load-container {
            padding: 0;
            margin: 0;
            width: 100vw !important;
            height: 100vh !important;
            background: radial-gradient(#7d59b6bf, #4447ad);
            z-index: 99999999999999;
        }

        .circle {
            margin-top: 3rem;
            box-sizing: border-box;
            height: 200px;
            width: 200px;
            border-radius: 50%;
            padding-left: 50px;
            background-image: linear-gradient(to left, #fff, #fff 50%, #000 50%, #000);
            animation: roll 10s linear infinite;
        }

        .yinyang {
            position: relative;
            background: #fff;
            height: 100px;
            width: 100px;
            border-radius: 50%;
            background-image: linear-gradient(to left, #fff, #fff 50%, #000 50%, #000);
            animation: roll 4s linear infinite;
            animation-direction: reverse;
        }

        .yinyang:before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translatex(-50%);
            background: #fff;
            border: 18px solid #000;
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        .yinyang:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translatex(-50%);
            background: #000;
            border: 18px solid #fff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        @keyframes roll {
            from {
                transform: rotate(0deg);
            }

            .dropdown-menu[data-bs-popper] {
                left: -360%;
                animation: show 500ms;
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

            .alert-read {
                color: #fff;
                background-color: #ce93d8;
                border-color: #ffffff00;
            }

            .alert-unread {
                color: #fff;
                background-color: #AB47BC;
                border-color: #8b8b8b9c;
            }

            @keyframes show {
                0% {
                    opacity: 30%;
                }

                .yinyang {
                    position: relative;
                    background: #fff;
                    height: 100px;
                    width: 100px;
                    border-radius: 50%;
                    background-image: linear-gradient(to left, #fff, #fff 50%, #000 50%, #000);
                    animation: roll 2s linear infinite;
                    animation-direction: reverse;
                }
            }

            #sidebar ul li.active>a,
            a[aria-expanded="true"] {
                background: transparent
            }

            #sidebar ul.components {
                border: none !important;
            }

            /* loading screen */

            .load-container {
                padding: 0;
                margin: 0;
                width: 100vw !important;
                height: 100vh !important;
                background: radial-gradient(#7d59b6bf, #4447ad);
                z-index: 99999999999999;
            }

            .circle {
                margin-top: 3rem;
                box-sizing: border-box;
                height: 200px;
                width: 200px;
                border-radius: 50%;
                padding-left: 50px;
                background-image: linear-gradient(to left, #fff, #fff 50%, #000 50%, #000);
                animation: roll 10s linear infinite;
            }

            .yinyang {
                position: relative;
                background: #fff;
                height: 100px;
                width: 100px;
                border-radius: 50%;
                background-image: linear-gradient(to left, #fff, #fff 50%, #000 50%, #000);
                animation: roll 4s linear infinite;
                animation-direction: reverse;
            }

            .yinyang:before {
                content: '';
                position: absolute;
                top: 0;
                left: 50%;
                transform: translatex(-50%);
                background: #fff;
                border: 18px solid #000;
                border-radius: 50%;
                width: 50px;
                height: 50px;
            }

            .yinyang:after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translatex(-50%);
                background: #000;
                border: 18px solid #fff;
                border-radius: 50%;
                width: 50px;
                height: 50px;
            }

            @keyframes roll {
                from {
                    transform: rotate(0deg);
                }

                to {
                    transform: rotate(-360deg);
                }
            }

            .loader {
                position: absolute;
                align-items: center;
                display: flex;
                justify-content: center;
                background: #efefef88;
                text-align: center;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            p {
                opacity: .55;
            }

            .wrapper {
                /* filter: drop-shadow(0 0 0.75rem #7d888c); */
            }

            /* loading screen */

            a {
                text-decoration: none;
            }

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
                justify-content: center;
            }

            #content {
                width: 100%;
                padding: 20 px;
                min-height: 100 vh;
                transition: all 0.3s;
            }

            ul ul a {
                background-color: #dddddd;
                color: black;
            }

            to {
                transform: rotate(-360deg);
            }
        }

        .loader {
            position: absolute;
            align-items: center;
            display: flex;
            justify-content: center;
            background: #efefef88;
            text-align: center;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        p {
            opacity: .55;
        }

        .wrapper {
            /* filter: drop-shadow(0 0 0.75rem #7d888c); */
        }

        /* loading screen */

        a {
            text-decoration: none;
        }

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
            justify-content: center;
        }

        #content {
            width: 100%;
            padding: 20 px;
            min-height: 100 vh;
            transition: all 0.3s;
        }

        ul ul a {
            background-color: #dddddd;
            color: black;
        }

        .student-navbar {
            background: #fff !important;
            box-shadow: 0px 0px 13px 3px #a49fa7;
        }

        .dropdown-toggle::after {
            display: none;
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
    </style>
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
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div style="margin-left: 50px">
                    <a href="#">
                        <img src="../asset/img/1aiet-logo.png" style="height: 10vh" class="img-fluid ml-auto" alt="" srcset="" />
                    </a>
                </div>
            </div>

            <ul class="list-unstyled components">
                <!-- <li>
                    <a href="../forum/student_feeds.php" style="color: black"> Forum </a>
                </li> -->
                <li>
                    <a href="../student_profile/student_dashboard.php" style="color: black">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/igpbsrza.json" trigger="morph" colors="primary:#121331" style="width:32px;height:32px">
                        </lord-icon>
                        Home
                    </a>

                </li>
                <li>
                    <a href="../student_profile/student_login_view.php" style="color: black">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/xulniijg.json" trigger="hover" colors="primary:#121331" style="width:32px;height:32px">
                        </lord-icon>
                        IA Marks
                    </a>
                </li>
                <li>
                    <a href="../attendance_new/dropdown.php" style="color: black">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/sygggnra.json" trigger="hover" colors="primary:#121331" style="width:32px;height:32px">
                        </lord-icon>
                        Attendance
                    </a>
                </li>
                <li>
                    <a href="../stud_library/books_details.php" style="color: black">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/stxtcyyo.json" trigger="morph" colors="primary:#121331" style="width:32px;height:32px">
                        </lord-icon>
                        Library
                    </a>
                </li>
                <li>
                    <a href="../assignment/student_assignment_view.php" style="color: black">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/aslgozpd.json" trigger="hover" colors="primary:#121331" style="width:32px;height:32px">
                        </lord-icon>
                        Assignment
                    </a>
                </li>
                <li>
                    <a href="../stud_library/books_details.php" style="color: black">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/stxtcyyo.json" trigger="morph" colors="primary:#121331" style="width:32px;height:32px">
                        </lord-icon>
                        Book Details
                    </a>
                </li>
                <li>
                    <a href="../stud_library/Request_books.php" style="color: black">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/stxtcyyo.json" trigger="morph" colors="primary:#121331" style="width:32px;height:32px">
                        </lord-icon>
                        Requested Books
                    </a>
                </li>
                <li>
                    <a href="#leaveSubmenu" data-toggle="collapse" style="color: black" aria-expanded="false" class="dropdown-toggle">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/wurbjznp.json" trigger="morph" colors="primary:#121331" style="width:32px;height:32px">
                        </lord-icon>
                        Leave
                    </a>
                    <ul class="collapse list-unstyled" id="leaveSubmenu">
                        <li>
                            <a href="../student_leave_management/medical.php" style="color: black; background:white">Medical</a>
                        </li>
                        <li>
                            <a href="../student_leave_management/event.php" style="color: black; background:white">Event</a>
                        </li>


                        <?php

                        if ($res["semester"] == "6" || $res["semester"] == "7" || $res["semester"] == "8") {
                        ?>

                            <li>
                                <a href="../student_leave_management/placement.php" style="color: black; background:white">Placement</a>
                            </li>

                        <?php
                        }
                        ?>

                    </ul>
                </li>
                <li>
                    <a href="#Feedback" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" style="color: black">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/diyeocup.json" trigger="hover" colors="primary:#121331" style="width:32px;height:32px">
                        </lord-icon>
                        Feedback
                    </a>
                    <ul class="collapse list-unstyled" id="Feedback">
                        <?php
                        $q = 'select semester,branch from students where usn="' . $_SESSION['username'] . '"';
                        // echo $q;

                        $q_r = mysqli_fetch_assoc($link->query($q));
                        $q_s = 'select * from feedback_notification where sem="' . $q_r['semester'] . '" and branch="' . $q_r['branch'] . '" ';
                        // echo $q_s;
                        $r_s = $link->query($q_s);
                        $feeds = array();
                        $var = date("Y-m-d");
                        foreach ($r_s as $s) {
                            $feeds[] = $s['feedback_name'];
                        }
                        // print_r($feeds);
                        if (array_search('Course wise 1', $feeds, true) + 1) {
                            // echo $var;
                            $q_d = 'select * from feedback_notification where feedback_name="Course wise 1" and sem="' . $q_r['semester'] . '" and branch="' . $q_r['branch'] . '" and from_date<="' . $var . '" and to_date>="' . $var . '"';
                            // echo $q_d;
                            $r_d = $link->query($q_d);
                            //  print_r($r_d);
                            $n = mysqli_num_rows($r_d);
                            // echo $n;
                            if ($n != 0) {
                        ?><li><a href="../feedback/course_end_subject.php">Course wise 1 Feedback</a></li>
                            <?php
                            }
                        }
                        if (array_search('Course wise 2', $feeds, true) + 1) {
                            $q_d = 'select * from feedback_notification where feedback_name="Course wise 2" and sem="' . $q_r['semester'] . '" and branch="' . $q_r['branch'] . '" and from_date<="' . $var . '" and to_date>="' . $var . '"';
                            // echo $q_d;
                            $r_d = $link->query($q_d);
                            //  print_r($r_d);
                            $n = mysqli_num_rows($r_d);
                            // echo $n;
                            if ($n != 0) {
                            ?><li><a href="../feedback/course_wise2.php">Course wise 2 Feedback</a></li>
                            <?php
                            }
                        }
                        if (array_search('Course end', $feeds, true) + 1) {
                            $q_d = 'select * from feedback_notification where feedback_name="Course end" and sem="' . $q_r['semester'] . '" and branch="' . $q_r['branch'] . '" and from_date<="' . $var . '" and to_date>="' . $var . '"';
                            // echo $q_d;
                            $r_d = $link->query($q_d);
                            //  print_r($r_d);
                            $n = mysqli_num_rows($r_d);
                            // echo $n;
                            if ($n != 0) { ?>
                                <li>
                                    <a href="../feedback/course_end_subject.php">Course End Feedback</a>
                                </li>
                            <?php
                            }
                        }
                        if (array_search('Curriculum feedback', $feeds, true) + 1) {
                            $q_d = 'select * from feedback_notification where feedback_name="Curriculum feedback" and sem="' . $q_r['semester'] . '" and branch="' . $q_r['branch'] . '" and from_date<="' . $var . '" and to_date>="' . $var . '"';
                            // echo $q_d;
                            $r_d = $link->query($q_d);
                            //  print_r($r_d);
                            $n = mysqli_num_rows($r_d);
                            // echo $n;
                            if ($n != 0) {
                            ?>
                                <li>
                                    <a href="../feedback/curriculum_stud.php">Curriculum Feedback</a>
                                </li>
                            <?php
                            }
                        }
                        if (array_search('Program EXit', $feeds, true) + 1) {
                            // echo $var;
                            $q_d = 'select * from feedback_notification where feedback_name="Program Exit" and sem="' . $q_r['semester'] . '" and branch="' . $q_r['branch'] . '" and from_date<="' . $var . '" and to_date>="' . $var . '"';
                            // echo $q_d;
                            $r_d = $link->query($q_d);
                            //  print_r($r_d);
                            $n = mysqli_num_rows($r_d);
                            // echo $n;
                            if ($n != 0) {
                            ?><li><a href="../feedback/program_exit.php">Program Exit Feedback</a></li>
                            <?php
                            }
                        }
                        if (array_search('Infrastructure feedback', $feeds, true) + 1) {
                            // echo $var;
                            $q_d = 'select * from feedback_notification where feedback_name="Infrastructure feedback" and sem="' . $q_r['semester'] . '" and branch="' . $q_r['branch'] . '" and from_date<="' . $var . '" and to_date>="' . $var . '"';
                            // echo $q_d;
                            $r_d = $link->query($q_d);
                            //  print_r($r_d);
                            $n = mysqli_num_rows($r_d);
                            // echo $n;
                            if ($n != 0) {
                            ?><li><a href="../feedback/infrastructure.php">Infrastructure feedback</a></li>
                        <?php
                            }
                        }
                        ?>

                        <li>
                            <a href="../feedback/custom_display.php">Custom Feedback</a>

                        </li>



                    </ul>
                </li>
            </ul>
        </nav>
        <?php
        $q_note = 'select * from notification where usn = "' . $_SESSION['username'] . '";';
        $count = mysqli_num_rows($link->query($q_note));
        ?>

        <!-- Page Content  -->
        <div id="content">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light bg-light student-navbar">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse" class="btn btn-info ">
                            <i class="fas fa-align-left"></i>
                        </button>
                        <div class="d-none d-sm-none d-md-block">
                            <h5 style="text-align: center;" class="">Alva's Institute Of Engineering & Technology</h5>
                        </div>

                        <div class="d-md-none d-sm-block">
                            <h5 style="text-align: center;" class=" ">AIET</h5>
                        </div>

                        <div class="row">
                            <div id="Back-btn" class="col">
                                <button class="btn" onclick="window.history.back();">
                                    <i class="fa fa-lg fa-arrow-left"></i>
                                </button>
                            </div>
                            <div class="col p-0 m-0" id="navbarSupportedContent" style="justify-content: flex-end;">
                                <li class="nav-item dropdown " style="list-style: none;">
                                    <a class="nav-link dropdown-toggle p-0 m-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        <php ?>
                                            <Span class="p-0 m-0 avatar border border-danger" style="color:orange; font-size:18px; font-weight:bold;">
                                                <?php
                                                $user = $_SESSION['username'];
                                                echo $user[-3];
                                                echo $user[-2];
                                                echo $user[-1];
                                                ?>

                                            </Span>
                                            <span class="bg-success border border-light rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Notification" style="z-index: 9999;position: absolute; top: 0px;padding: 5px;">

                                            </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class=" dropdown-item" href="../student_profile/student_login_profile_view.php">
                                            <i class="fas fa-users  p-2"></i> Profile </a>
                                        <a class="dropdown-item" href="../student_profile/reset-password.php"> <i class="fas fa-key  p-2"></i>Reset Password</a>
                                        <a class=" dropdown-item dropdown-toggle" data-bs-toggle="notification" role="button" onclick="notify();" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-bell p-2 "></i> Notifications <span class="badge bg-danger bg-sm"><?php echo $count ?></span> </a>
                                        <div class="dropdown-divider"></div>
                                        <a class=" dropdown-item" href="../logout.php"><i class="fas fa-power-off p-2">
                                                Logout</i></a>
                                    </div>
                                    <!--  -->

                                    <!--  -->
                                </li>

                                <!-- </ul> -->
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
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
            <!-- page content start -->
            <div class="container" id="notification" style="position:fixed;right:1%;display:none;transition:height 0.4s;">
                <div class="row">
                    <div class="col-md-6 col-sm-12 d-none d-sm-block"> </div>
                    <div class="col-md-6 col-sm-12" style="background-color: #fff;box-shadow: 0px 1px 16px 8px #bac2c5;border:1px solid transparent;border-radius:10px;">
                        <div style="max-height:400px; overflow:scroll;overflow-x: hidden;">
                            <div class="row m-2 mt-4">
                                <div class="col blockquote"> <strong> Notifications </strong></div>
                                <div class="col"></div>
                                <div class="col">
                                    <button style="color: #000; background: transparent; float:right; border:none;" onclick="notify()" class="btn btn-secondary"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="row m-2 p-2">
                                <!--  -->
                                <?php
                                $q_not = 'select * from notification where usn = "' . $_SESSION['username'] . '"';
                                $r_not = $link->query($q_not);

                                date_default_timezone_set('Asia/Kolkata');
                                $current_date = date('Y-m-d');
                                foreach ($r_not as $rr) {
                                    if ($rr['end_date'] == $current_date) {
                                        $link->query('delete from notification where usn = "' . $_SESSION['username'] . '" and id = "' . $rr['id'] . '"');
                                        // echo '<script>window.location.replace("student_profile/student_dashboard.php.php");</script>';
                                    }
                                }
                                // Set the new timezone
                                date_default_timezone_set('Asia/Kolkata');
                                $date = date('Y-m-d');
                                $notif = "SELECT * FROM `notification` where usn = \"" . $_SESSION['username'] . "\"";
                                // echo $notif;
                                $result = $link->query($notif);
                                foreach ($result as $row) {
                                    // echo $row['created_date'];
                                ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <a style="text-decoration: none" href="<?php echo $row['redirect']; ?>"><strong><?php echo $row['content']; ?></strong></a>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php
                                }
                                ?>

                                <!-- <div class="alert alert-success alert-dismissible fade show alert-unread" role="alert">
                                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div> -->
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>