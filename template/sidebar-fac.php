<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/style/style_fac.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../asset/img/1aiet-logo.png" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../asset/style/bootstrap.min.css">
    <link rel="shortcut icon" href="../asset/img/1aiet-logo.png" />
    <link rel="stylesheet" href="../asset/style/style_fac.css">
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
            <span style="color: black;">Loading</span>
        </div>
    </div>

    <style>
        /* loading animation and stuff */
        .load-container {
            padding: 0;
            margin: 0;
            width: 100vw !important;
            height: 100vh !important;
            background: radial-gradient(#7d59b6bf, #4447ad);
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


        /* .form-control {min-width: 60px !important;} */

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
            background: fixed;
        }

        #content {
            width: 100%;
            padding: 20 px;
            min-height: 100 vh;
            transition: all 0.3s;
        }
    </style>

    <div class="wrapper page">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div style="margin-left: 50px;">
                    <a href="../dashboard/fac_dashboard.php">
                        <img src="../asset/img/1aiet-logo.png" style="height: 10vh; " class="img-fluid ml-auto" alt="" srcset="">
                    </a>
                </div>
            </div>

            <ul class="list-unstyled components">
                <?php
                if ($_SESSION["username"] == "vivek_alva@alvas.org") {
                ?>
                    <li>
                        <a href="../student_details/stud_details.php">
                            <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/aslgozpd.json" trigger="hover" colors="primary:#16c79e" style="width:32px;height:32px">
                            </lord-icon>
                            Student Details
                        </a>
                    </li>
                    <li>
                        <a href="../faculty_details/fac_details.php">
                            <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/aslgozpd.json" trigger="hover" colors="primary:#16c79e" style="width:32px;height:32px">
                            </lord-icon>
                            Faculty Details
                        </a>
                    </li>


                <?php

                } else {

                ?>
                    <li>
                        <a href="#facultyMainMenue" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/elkhjhci.json" trigger="hover" colors="primary:#16c79e" style="width:32px;height:32px">
                            </lord-icon>
                            Faculty
                        </a>
                        <ul class="collapse list-unstyled" id="facultyMainMenue">
                            <li>
                                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/vmibgbhr.json" trigger="hover" colors="primary:#9cf4df" style="width:30px;height:30px">
                                    </lord-icon>
                                    Lesson
                                    Plan
                                </a>
                                <ul class="collapse list-unstyled" id="pageSubmenu">
                                    <li>
                                        <a href="../lesson_plan/lesson_plan.php" id="">Planning and Tracking</a>
                                    </li>
                                    <li>
                                        <a href="../co_po_pso_mapping/co_po_pso.php" id="co_po">CO, PO and PSO Mapping</a>
                                    </li>

                                </ul>

                            </li>
                            <li>
                                <a href="#page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/dklbhvrt.json" trigger="hover" colors="primary:#9cf4df" style="width:32px;height:32px">
                                    </lord-icon>
                                    Mentor
                                </a>
                                <ul class="collapse list-unstyled" id="page">
                                    <li>
                                        <a href="../menti/student_Select.php" id="">View</a>
                                    </li>
                                    <li>
                                        <a href="../menti/student_Shselect.php" id="">Shedule</a>
                                    </li>
                                    <li>
                                        <a href="../menti/shmeeting.php" id="">Meeting</a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a href="#attendanceSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/sygggnra.json" trigger="hover" colors="primary:#9cf4df" style="width:30px;height:30px">
                                    </lord-icon>
                                    Attendance
                                </a>
                                <ul class="collapse list-unstyled" id="attendanceSubmenu">
                                    <?php if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) { ?>
                                        <li>
                                            <a href="../attendance/Select%20Attendence_for_Adding_attendence.php">Mark Attendance</a>
                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <a href="../attendance_new/Select_Attendence_for_Adding_attendence.php">Mark Attendance</a>
                                        </li>
                                    <?php } ?>
                                    <?php if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) { ?>
                                        <li>
                                            <a href="../attendance/Select%20Attendence_for_viewingattendence.php">View Attendance</a>
                                        </li>
                                    <?php } else { ?>
                                        <li>
                                            <a href="../attendance_new/Select_Attendence_for_viewing_attendence.php">View Attendance</a>
                                        </li>
                                    <?php } ?>


                                </ul>
                            </li>
                            <li>
                                <a href="../IA_Management/ia_marks.php" id="ia">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/xulniijg.json" trigger="hover" colors="primary:#9cf4df" style="width:32px;height:32px">
                                    </lord-icon>
                                    IA Management
                                </a>
                            </li>
                            <li>
                                <a href="../lab_marks/lab.php" id="ia">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/xulniijg.json" trigger="hover" colors="primary:#9cf4df" style="width:32px;height:32px">
                                    </lord-icon>
                                    LAB Marks
                                </a>
                            </li>
                            <li>
                                <a href="../external_seat_allotment/blockfaculty0.php" id="ia">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/drtetngs.json" trigger="hover" colors="primary:#9cf4df" style="width:32px;height:32px">
                                    </lord-icon>
                                    Exam Blocking
                                </a>
                            </li>
                            <li>
                                <a href="#arrsub" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/rslnizbt.json" trigger="hover" colors="primary:#9cf4df" style="width:32px;height:32px">
                                    </lord-icon>
                                    Arrear Subject Details
                                </a>
                                <ul class="collapse list-unstyled" id="arrsub">
                                    <li>
                                        <a href="../external_seat_allotment/addarr1.php">Add Student</a>
                                    </li>
                                    <li>
                                        <a href="../external_seat_allotment/addarrview1.php">View Student</a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a href="../fac_library/books_details.php" id="ia">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/stxtcyyo.json" trigger="morph" colors="primary:#9cf4df" style="width:32px;height:32px">
                                    </lord-icon>
                                    Book Details
                                </a>
                            </li>
                            <li>
                                <a href="#assignment-submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/aslgozpd.json" trigger="hover" colors="primary:#9cf4df" style="width:30px;height:30px">
                                    </lord-icon>
                                    Assignment
                                </a>
                                <ul class="collapse list-unstyled" id="assignment-submenu">
                                    <li>
                                        <a href="../assignment/fac_assignment.php">Assign Assignment</a>
                                    </li>
                                    <li>
                                        <a href="../assignment/fac_assignment_assign_marks.php">Assignment Marks</a>
                                    </li>
                                    <li>
                                        <a href="../assignment/fac_assignment_avg.php">Assignment Average</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#feedback-submenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/elkhjhci.json" trigger="hover" colors="primary:#9cf4df" state="intro" style="width:30px;height:30px">
                                    </lord-icon>
                                    Faculty Feedback
                                </a>
                                <ul class="collapse list-unstyled" id="feedback-submenu">
                                    <li>
                                        <a href="../feedback_faculty/fac_curriculum.php">Course</a>
                                    </li>
                                    <li>
                                        <a href="../feedback_faculty/fac_syllabus.php">Syllabus</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#downloadSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/itykargr.json" trigger="hover" colors="primary:#9cf4df" style="width:32px;height:32px">
                                    </lord-icon>
                                    Download
                                </a>
                                <ul class="collapse list-unstyled" id="downloadSubmenu">
                                    <li>
                                        <a href="../faculty_download/student_excel.php">Student Data</a>
                                    </li>

                                    <li>
                                        <a href=" #iamarks" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">IA Marks</a>
                                        <ul class="collapse list-unstyled" id="iamarks">
                                            <li>
                                                <a href="../faculty_download/iamark1_excel.php">IA I</a>
                                            </li>
                                            <li>
                                                <a href="../faculty_download/iamark2_excel.php">IA II</a>
                                            </li>
                                            <li>
                                                <a href="../faculty_download/iamark3_excel.php">IA III</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href=" #attainment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Attainment</a>
                                        <ul class="collapse list-unstyled" id="attainment">
                                            <li>
                                                <a href=" #theory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Theory</a>
                                                <ul class="collapse list-unstyled" id="theory">
                                                    <li>
                                                        <a href="../attainment/attainment_select.php">Attainment Report</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href=" #lab" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Lab</a>
                                                <ul class="collapse list-unstyled" id="lab">
                                                    <li>
                                                        <a href="../attainment/lab_attainment_select.php">Lab Attainment Report</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="../attendance_new/attendance_download_select.php">Attendance Report</a>
                                    </li>
                                    <li>
                                        <a href="../feedback_download/select_feedback.php">Feedback</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="../nodue/Select_student.php" id="nodue">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/ucvsemjq.json" trigger="hover" colors="primary:#9cf4df" style="width:32px;height:32px">
                                    </lord-icon>
                                    No dues
                                </a>
                            </li>
                            <li>
                                <a href="#leave" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/pvbjsfif.json" trigger="hover" colors="primary:#9cf4df" state="hover" style="width:32px;height:32px">
                                    </lord-icon>
                                    Leave
                                </a>
                                <ul class="collapse list-unstyled" id="leave">

                                    <li>
                                        <a href="#studentleave" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Student Leave</a>
                                        <ul class="collapse list-unstyled" id="studentleave">
                                            <li>
                                                <a href="../attendance_new/Attendence_Permitted.php">Permitted Leave</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href=" #facultyleave" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Faculty Leave</a>
                                        <ul class="collapse list-unstyled" id="facultyleave">
                                            <li>
                                                <a href="../Fac_Leave_Management/casualleave.php">Casual Leave</a>
                                            </li>
                                            <li>
                                                <a href="../Fac_Leave_Management/OOD_leave.php">OOD Leave</a>
                                            </li>
                                            <li>
                                                <a href="../Fac_Leave_Management/sclleave.php">SCL Leave</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href=" #Gen_report" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon src="https://cdn.lordicon.com/itykargr.json" trigger="hover" colors="primary:#9cf4df" style="width:32px;height:32px">
                                    </lord-icon>
                                    Generate
                                    Report
                                </a>
                                <ul class="collapse list-unstyled" id="Gen_report">
                                    <li>
                                        <a href="../ia_report_generation/select_semester.php">IA Marks</a>
                                        <?php if ($_SESSION['username'] == 'Shilpa') { ?>
                                            <a href="../ia_report_generation/select_semester_parallel.php">IA Marks Parallel</a>
                                        <?php } ?>
                                    </li>
                                    <?php if ($_SESSION['username'] == 'Shilpa') { ?>
                                        <li>
                                            <a href="../attainment/attainment_select_parallel.php">Attainment Report Parallel</a>

                                        </li>
                                    <?php } ?>


                                    <li>

                                        <?php if ($_SESSION['username'] == 'Shilpa') { ?>
                                    <li>


                                        <a href="../attainment/lab_parallel_attainment_select.php">Lab Attainment Report Parallel</a>

                                    </li>

                                <?php } ?>

                            </li>
                        </ul>
                    </li>







                    <!-- </li> -->
                    <!-- <li>
                    <a href="#FeedbachSubmenu" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">Feedback</a>
                    <ul class="collapse list-unstyled" id="FeedbachSubmenu">
                        <li>
                            <a href="#" onclick="alert('in Progress')">Course end</a>
                        </li>
                        <li>
                            <a href="#" onclick="alert('in Progress')">Course Wise</a>
                        </li>

                    </ul>
                </li> -->
                    <!-- <li>
                    <a href="#" onclick="alert('in Progress')" id="Attainment">Attainment</a>
                </li> -->










            </ul>
            </li>

            <!-- dept admin list start -->
            <?php if ($hod == 1) { ?>

                <li>
                    <a href="#hod" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/dklbhvrt.json" trigger="hover" colors="primary:#16c79e" style="width:32px;height:32px">
                        </lord-icon>
                        HOD
                    </a>
                    <ul class="collapse list-unstyled" id="hod">
                        <li>
                            <a href=" #deptexam" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">External Seating allotment</a>
                            <ul class="collapse list-unstyled" id="deptexam">
                                <a href="#Dept_student6" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">EMS</a>
                                <ul class="collapse list-unstyled" id="Dept_student6">
                                    <li>
                                        <a href="../external_seat_allotment/ems1.php">EMS Assign</a>
                                    </li>
                                    <li>
                                        <a href="../external_seat_allotment/emsview.php">EMS View</a>
                                    </li>
                                </ul>
                                <a href="#Dept_student10" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Seating</a>
                                <ul class="collapse list-unstyled" id="Dept_student10">
                                    <li>
                                        <a href="../external_seat_allotment/seat_regular1.php">Regular Exam</a>
                                    </li>
                                    <li>
                                        <a href="../external_seat_allotment/seat_arrear1.php">Arrear Exam</a>
                                    </li>

                                </ul>
                                <li>
                                    <a href="../external_seat_allotment/emsviewarr1.php">Student Arrear Details</a>
                                </li>

                                <a href="#Dept_student5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Add Details</a>
                                <ul class="collapse list-unstyled" id="Dept_student5">
                                    <li>
                                        <a href="../external_seat_allotment/addroom3.php">Room Details</a>
                                    </li>
                                    <li>
                                        <a href="../external_seat_allotment/addsub4.php">Subject Details</a>
                                    </li>
                                    <li>
                                        <a href="../external_seat_allotment/addschedule3.php">Exam Schedule Details</a>
                                    </li>
                                    <li>
                                        <a href="../external_seat_allotment/facultycount1.php">Add Faculty Count</a>
                                    </li>
                                </ul>
                            </ul>
                        </li>

                        <li>
                            <a href="../external_seat_allotment/hodviewarr1.php" id="bl2">Student Arrear Details</a>
                        </li>
                        <li>
                            <a href="../approvals/approvals.php">Approvals</a>
                        </li>

                        <li>
                            <a href="../student_details/stud_details.php">Student Details</a>
                        </li>
                        <li>
                            <a href="../faculty_details/fac_details.php">Faculty Details</a>
                        </li>
                        <li>
                            <a href="../faculty_task/fac_task.php">Faculty Task</a>
                        </li>
                        <li>
                            <a href="../nodue/stud_details.php">No Due</a>
                        </li>

                    </ul>
                </li>
            <?php
                    }
                    // echo $_SESSION["priv_id"];
                    if ($_SESSION["priv_id"] == 3) {  ?>

                <li>
                    <a href="#Dept_submenue" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/dklbhvrt.json" trigger="hover" colors="primary:#16c79e" style="width:32px;height:32px">
                        </lord-icon>
                        Dept.
                        Admin
                    </a>
                    <ul class="collapse list-unstyled" id="Dept_submenue">
                        <li>
                            <a href="#Dept_student" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Student</a>
                            <ul class="collapse list-unstyled" id="Dept_student">
                                <li>
                                    <a href="../dept_admin/students_insert.php">Add Student</a>
                                </li>
                                <li>
                                    <a href="../dept_admin/student_Select.php">View Student</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Faculty</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu1">
                                <li>
                                    <a href="../dept_admin/faculty_insert.php">Add Faculty</a>
                                </li>
                                <li>
                                    <a href="../dept_admin/faculty_department.php">View Faculty</a>
                                </li>
                                <!-- <li>
                                    <a href="../dept_admin/register.php">Faculty Register</a>
                                </li> -->

                            </ul>
                        </li>
                        <li>
                            <a href="#pageSubmenu1232" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Attainment</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu1232">
                                <li>
                                    <a href=" #theory1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Theory</a>
                                    <ul class="collapse list-unstyled" id="theory1">
                                        <li>
                                            <a href="../attainment/attainment_select.php">Attainment Report</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href=" #lab1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Lab</a>
                                    <ul class="collapse list-unstyled" id="lab1">
                                        <li>
                                            <a href="../attainment/lab_attainment_select.php">Lab Attainment Report</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="../attainment/attainment_target.php">Set Target</a>
                                </li>



                                <?php if ($_SESSION['username'] == 'Shilpa') { ?>
                                    <li>
                                        <a href="../attainment/redirect_attainment_parallel_dept_admin.php">Attainment Parallel Report</a>
                                    </li>
                                    <li>
                                        <a href="../attainment/redirect_attainment_lab_parallel_dept_admin.php">Attainment Lab Parallel Report</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li>
                            <a href="#mentormenti" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Mentor-Mentee Mapping</a>
                            <ul class="collapse list-unstyled" id="mentormenti">
                                <li class="">
                                    <a href="../mentor/drop_view_dis.php"> Mapping</a>
                                </li>
                                <li class="">
                                    <a href="../mentor/mentor_select_dis.php">View</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#creation" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Creation</a>
                            <ul class="collapse list-unstyled" id="creation">
                                <li>
                                    <a href="../dept_admin/batch_selection.php">Section</a>
                                </li>
                                <li class="">
                                    <a href="../lab_batch_dept/lab_batch.php">Lab Batch</a>
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
                                        <a href="../sub_new_dept/add_sub.php">Add Subject</a>
                                    </li>
                                <?php } ?>
                                <?php if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) { ?>
                                    <li>
                                        <a href="../subject_maping/select_sub_branch.php">View Subject</a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="../sub_new_dept/select_sub_branch.php">View Subject</a>
                                    </li>
                                <?php } ?>
                                <!-- <li>
                                    <a href="../student_elective_mapping_dept/drop_view_dis.php">Student Elective
                                        Mapping</a>
                                </li> -->

                            </ul>
                        </li>

                        <li>
                            <a href="#DeptAdminSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Subject Mapping</a>
                            <ul class="collapse list-unstyled" id="DeptAdminSubmenu">

                                <li>
                                    <a href="../subject_maping_dept/faculty_subject_mapping.php">Faculty Subject Mapping</a>
                                </li>
                                <li>
                                    <a href="../student_elective_mapping_dept/drop_view_dis.php">Student Elective Mapping</a>
                                </li>
                                <li>
                                    <a href="../student_elective_mapping_dept/select_students.php">Faculty-Student Elective Mapping</a>
                                </li>
                                <li>
                                    <a href="../subject_maping_dept/faculty_view.php">Faculty View</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="../attendance_average/select_start.php">Attendance average</a>
                        </li>
                        <li>
                            <a href="#feedback" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Feedback</a>

                        <li class="">
                            <ul class="collapse list-unstyled" id="feedback">
                                <li>
                                    <a href="../feedback/enable.php">Set / Enable Feedback</a>
                                </li>
                                <li>
                                    <a href="../feedback_custom/create_feed.php">Create Feedback</a>
                                </li>
                                <li>
                                    <a href="../feedback_custom/view_all_feed.php">Edit Feedback Form</a>
                                </li>
                                <li>
                                    <a href="../feedback_download/select_feedback.php">Feedback Download</a>
                                </li>
                            </ul>

                        </li>
                </li>
                </ul>
                </li>
            <?php } ?>

            <!-- dept admin list end -->

            <!-- ug CORDINATOR -->

            <?php
                    if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                    } else {
                        $q1 = 'select * from coordinator where ug_coordinator<>0';

                        $res = $link->query($q1);
                        $con1 = 0;
                        foreach ($res as $row) {
                            $con1++;
                            if ($row['name'] == $_SESSION['username']) {


            ?>



                        <li>
                            <a href="#page2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/dklbhvrt.json" trigger="hover" colors="primary:#16c79e" style="width:32px;height:32px">
                                </lord-icon>
                                UG Cordinator
                            </a>
                            <ul class="collapse list-unstyled" id="page2">
                                <li>
                                    <a href="../nodue/select_ug_student.php">No Due</a>
                                </li>


                            </ul>
                        </li>





                <?php
                            }
                        }
                ?>


                <!-- cordinator list ends -->
                <!-- CLASS CORDINATOR -->

                <?php
                        $q1 = 'select * from coordinator where class_cordinator<>0';

                        $res = $link->query($q1);
                        $con1 = 0;
                        foreach ($res as $row) {
                            $con1++;
                            if ($row['name'] == $_SESSION['username']) {


                ?>




                        <li>
                            <a href="#page1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Class Cordinator</a>
                            <ul class="collapse list-unstyled" id="page1">
                                <li>
                                    <a href="../nodue/select_class.php">No Due</a>
                                </li>


                            </ul>
                        </li>

            <?php
                            }
                        }
                    }
            ?>
            <!-- CLASS CORDINATOR end -->
            <li>
                <a href="#pageSubmenu231" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/stxtcyyo.json" trigger="morph" colors="primary:#16c79e" style="width:32px;height:32px">
                    </lord-icon>
                    Library
                </a>
                <ul class="collapse list-unstyled" id="pageSubmenu231">
                    <li>
                        <a href="../fac_library/books_details.php" id="">Books Details</a>
                    </li>
                    <li>
                        <a href="../fac_library/Request_books.php">Requested Books</a>
                    </li>
                </ul>
            </li>

            <?php if ($hod == 1) { ?>

            <?php }
                    if ($_SESSION["principal"] == true) { ?>
                <li>
                    <a href="../student_details/stud_details.php">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/aslgozpd.json" trigger="hover" colors="primary:#16c79e" style="width:32px;height:32px">
                        </lord-icon>
                        Student Details
                    </a>
                </li>
                <li>
                    <a href="../faculty_details/fac_details.php">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/aslgozpd.json" trigger="hover" colors="primary:#16c79e" style="width:32px;height:32px">
                        </lord-icon>
                        Faculty Details
                    </a>
                </li>
        <?php  }
                }
        ?>
        </ul>
        </nav>


        <style>
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

            @media screen and (min-width: 320px) {
                #Back-btn {
                    /* padding-left: 50%; */
                }

            }

            @media screen and (min-width: 230px) {
                #Back-btn {
                    /* padding-left: 40%; */
                }

            }

            @media screen and (min-width: 1024px) {
                #Back-btn {
                    /* padding-left: 85%; */
                }

            }
        </style>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
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

                    <div class="">
                        <div class="row">
                            <div id="Back-btn" class="col">
                                <button class="btn" onclick="window.history.back();">
                                    <i class="fa fa-lg fa-arrow-left"></i>
                                </button>
                            </div>
                            <div class="p-0 m-0 col" id="navbarSupportedContent" style="justify-content: flex-end;">
                                <li class="nav-item dropdown " style="list-style: none;">
                                    <a class="nav-link dropdown-toggle p-0 m-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        <php ?>
                                            <Span class="p-0 m-0 avatar" style="color:orange; font-size:18px; font-weight:bold;">
                                                <?php
                                                $user = $_SESSION['username'];
                                                echo $user[0];
                                                ?>
                                            </Span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class=" dropdown-item" href="../faculty_profile/faculty_login_profile_view.php"> <i class="fas fa-users  p-2"></i> Profile </a>
                                        <a class="dropdown-item" href="../faculty/reset-password.php"> <i class="fas fa-key  p-2"></i>Reset Password</a>
                                        <a class=" dropdown-item" href="#" onclick="alert('notificaions')"><i class="fas fa-bell p-2"></i> Notifications </a>
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
            <?php
            if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
            ?>
                <div class="row mb-4">
                    <div class="col">
                        <form action="../template/redirect.php" method="POST">
                            <button class="btn btn-primary"> Exit Archive</button>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
            <!-- page content start -->
            <div>
                <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
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