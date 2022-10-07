<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);

$q = 'select distinct sub from co_po where to_hod="' . $_SESSION["username"] . '" and approval="waiting"';
$res = $link->query($q);

$qs = 'select distinct sub from co_pso where to_hod="' . $_SESSION["username"] . '" and approval="waiting"';
$ress = $link->query($qs);

$ql = 'select * FROM student_medical_leave as s WHERE status = 0 and (select branch from students where usn = s.usn) = (select branch from hod WHERE name = "' . $_SESSION["username"] . '")';
$resm = $link->query($ql);

$qe = 'select * FROM student_event_leave as s WHERE status = 0 and (select branch from students where usn = s.usn) = (select branch from hod WHERE name = "' . $_SESSION["username"] . '")';
$rese = $link->query($qe);

$qp = 'select * FROM student_placement_leave as s WHERE status = 0 and (select branch from students where usn = s.usn) = (select branch from hod WHERE name = "' . $_SESSION["username"] . '")';
$resp = $link->query($qp);

$q2 = 'select * FROM faculty_casual_leave as f WHERE status = 0 and (select faculty_dept from faculty_details where faculty_name = f.faculty_name) = (select branch from hod WHERE name = "' . $_SESSION["username"] . '")';
$res2 = $link->query($q2);

$q3 = 'select * FROM faculty_scl as f1 WHERE status = 0 and (select faculty_dept from faculty_details where faculty_name = f1.faculty_name) = (select branch from hod WHERE name = "' . $_SESSION["username"] . '")';
$res3 = $link->query($q3);

$q4 = 'select * FROM faculty_ood as f2 WHERE status = 0 and (select faculty_dept from faculty_details where faculty_name = f2.faculty_name) = (select branch from hod WHERE name = "' . $_SESSION["username"] . '")';
$res4 = $link->query($q4);
?>




<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gabriela&display=swap" rel="stylesheet">
<div class="container">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">CO-PO Approvals</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">CO-PSO Approvals</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Lesson Plan Approvals</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="false">Student Leave Approvals</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="faculty-tab" data-toggle="tab" href="#faculty" role="tab" aria-controls="faculty" aria-selected="false">Faculty Leave Approvals</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <!-- <h1 class="" style="font-family: 'Gabriela', serif;">CO-PO-Approval</h1> -->

                <?php
                if (mysqli_num_rows($res) != 0) {
                    foreach ($res as $r) { ?>
                        <table class="table table-responsive table-striped mt-3">

                            <h4 class="mt-2"> Subject: <?php echo $r["sub"] ?></h4>
                            <thead>
                                <tr class="">
                                    <th scope="col">CO</th>
                                    <th scope="col" style="width: 9%;">PO1</th>
                                    <th scope="col" style="width: 9%;">PO2</th>
                                    <th scope="col" style="width: 9%;">PO3</th>
                                    <th scope="col" style="width: 9%;">PO4</th>
                                    <th scope="col" style="width: 9%;">PO5</th>
                                    <th scope="col" style="width: 9%;">PO6</th>
                                    <th scope="col" style="width: 9%;">PO7</th>
                                    <th scope="col" style="width: 9%;">PO8</th>
                                    <th scope="col" style="width: 9%;">PO9</th>
                                    <th scope="col" style="width: 9%;">PO10</th>
                                    <th scope="col" style="width: 9%;">PO11</th>
                                    <th scope="col" style="width: 9%;">PO12</th>

                                </tr>
                            </thead>

                            <?php
                            $q1 = 'select * from co_po where sub="' . $r["sub"] . '" and to_hod="' . $_SESSION["username"] . '" and approval="waiting"';
                            $res1 = $link->query($q1);
                            foreach ($res1 as $r1) { ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $r1["co"]; ?></td>
                                        <td><?php echo $r1["po1"]; ?></td>
                                        <td><?php echo $r1["po2"]; ?></td>
                                        <td><?php echo $r1["po3"]; ?></td>
                                        <td><?php echo $r1["po4"]; ?></td>
                                        <td><?php echo $r1["po5"]; ?></td>
                                        <td><?php echo $r1["po6"]; ?></td>
                                        <td><?php echo $r1["po7"]; ?></td>
                                        <td><?php echo $r1["po8"]; ?></td>
                                        <td><?php echo $r1["po9"]; ?></td>
                                        <td><?php echo $r1["po10"]; ?></td>
                                        <td><?php echo $r1["po11"]; ?></td>
                                        <td><?php echo $r1["po12"]; ?></td>
                                    </tr>
                                </tbody>



                            <?php
                            }
                            ?>
                        </table>

                        <div class="row">
                            <div class="col col-md-3 col-3 col-lg-3">
                                <form action="approve_po.php" method="post">
                                    <input type="text" name="sub" value="<?php echo $r['sub'] ?>" hidden>
                                    <input type="submit" class="btn btn-info" value="Approve">
                                </form>
                            </div>
                            <div class="col col-md-3 col-3 col-lg-3">
                                <form action="reject_po.php" method="post">
                                    <input type="text" name="sub" value="<?php echo $r['sub'] ?>" hidden>
                                    <input type="submit" class="btn btn-info" value="Reject">
                                </form>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<h5> No Approvals Needed</h5>';
                }
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row mt-5">
                <!-- <h1 style="font-family: 'Gabriela', serif;">CO-PSO-Approval</h1> -->
                <?php
                if (mysqli_num_rows($ress) != 0) {
                    foreach ($ress as $r) { ?>
                        <table class="table table-responsive table-striped mt-3">

                            <h3>Subject: <?php echo $r["sub"] ?></h3>
                            <thead>
                                <tr class="">
                                    <th scope="col" style="width: 9%;">CO</th>
                                    <th scope="col" style="width: 9%;">PSO1</th>
                                    <th scope="col" style="width: 9%;">PSO2</th>
                                    <th scope="col" style="width: 9%;">PSO3</th>
                                    <th scope="col" style="width: 9%;">PSO4</th>
                                    <th scope="col" style="width: 9%;">PSO5</th>

                                </tr>
                            </thead>

                            <?php
                            $q1 = 'select * from co_pso where sub="' . $r["sub"] . '" and to_hod="' . $_SESSION["username"] . '" and approval="waiting"';
                            $res1 = $link->query($q1);
                            foreach ($res1 as $r1) { ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $r1["co"]; ?></td>
                                        <td><?php echo $r1["pso1"]; ?></td>
                                        <td><?php echo $r1["pso2"]; ?></td>
                                        <td><?php echo $r1["pso3"]; ?></td>
                                        <td><?php echo $r1["pso4"]; ?></td>
                                        <td><?php echo $r1["pso5"]; ?></td>
                                    </tr>
                                </tbody>



                            <?php
                            }
                            ?>
                        </table>

                        <div class="row">
                            <div class="col col-md-3 col-3 col-lg-3">
                                <form action="approve_pso.php" method="post">
                                    <input type="text" name="sub" value="<?php echo $r['sub'] ?>" hidden>
                                    <input type="submit" class="btn btn-info" value="Approve">
                                </form>
                            </div>
                            <div class="col col-md-3 col-3 col-lg-3">
                                <form action="reject_pso.php" method="post">
                                    <input type="text" name="sub" value="<?php echo $r['sub'] ?>" hidden>
                                    <input type="submit" class="btn btn-info" value="Reject">
                                </form>
                            </div>
                        </div>



                <?php
                    }
                } else {
                    echo '<h5> No Approvals Needed</h5>';
                }
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

            <div class="row">
                <!-- <h1 style="font-family: 'Gabriela', serif;">Lesson Plan-Approval</h1> -->
                <?php
                $lepl = 'select * from lesson_plan_approval where hod = "' . $_SESSION['username'] . '" and status = "Pending"';
                $pl = $link->query($lepl);
                $numpl = mysqli_num_rows($pl);
                if ($numpl > 0) {
                    foreach ($pl as $r) {
                        echo $r['sub'];
                ?>

                        <div class="row">
                            <div class="col col-md-3 col-3 col-lg-3">
                                <form action="approve_lesson.php" method="post">
                                    <input type="text" name="sub" value="<?php echo $r['sub'] ?>" hidden>
                                    <input type="submit" class="btn btn-info" value="Approve">
                                </form>
                            </div>
                            <div class="col col-md-3 col-3 col-lg-3">
                                <form action="reject_lesson.php" method="post">
                                    <input type="text" name="sub" value="<?php echo $r['sub'] ?>" hidden>
                                    <input type="submit" class="btn btn-info" value="Reject">
                                </form>
                            </div>
                        </div>





                <?php
                    }
                } else {
                    echo '<h5> No Approvals Needed</h5>';
                }
                ?>


            </div>
        </div>
        <div class="tab-pane fade" id="student" role="tabpanel" aria-labelledby="student-tab">
            <div class="row">
                <h4 style="text-align:center; margin-top: 30px;  font-family: 'Gabriela', serif;">Medical Leave</h4>
                <table class="table table-responsive table-striped mt-3" style="margin-top: 20px;">
                    <?php
                    if (mysqli_num_rows($resm) != 0) {
                    ?>
                        <tr>
                            <th scope="col" style="width: 10%;">USN</th>
                            <th scope="col" style="width: 10%;">Name</th>
                            <th scope="col" style="width: 10%;">Reason</th>
                            <th scope="col" style="width: 10%;">View</th>
                        </tr>

                        <?php
                        foreach ($resm as $row) {
                            $st = 'select * from students where usn = "' . $row["usn"] . '"';
                            $s = $link->query($st);
                            $s2 = mysqli_fetch_assoc($s);
                        ?>
                            <tr>
                                <td><?php echo $row["usn"] ?></td>
                                <td><?php echo $s2["fname"] ?></td>
                                <td><?php echo $row["reason"] ?></td>
                                <td><a href="../approvals/view_medical_leave.php?id=<?php echo $row["id"]; ?>">
                                        <button type="button" class="btn btn-info">View</button></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<h5><center> No Leave Applied </center></h5>';
                    }
                    ?>
                </table>
                <h4 style="text-align:center;margin-top: 40px;  font-family: 'Gabriela', serif;">Event Leave</h4>
                <table class="table table-responsive table-striped mt-3" style="margin-top: 20px;">
                    <?php
                    if (mysqli_num_rows($rese) != 0) {
                    ?>
                        <tr>
                            <th scope="col" style="width: 10%;">USN</th>
                            <th scope="col" style="width: 10%;">Name</th>
                            <th scope="col" style="width: 10%;">Event Name</th>
                            <th scope="col" style="width: 10%;">View</th>
                        </tr>
                        <?php
                        foreach ($rese as $row) {
                            $st = 'select * from students where usn = "' . $row["usn"] . '"';
                            $s = $link->query($st);
                            $s2 = mysqli_fetch_assoc($s);
                        ?>
                            <tr>
                                <td><?php echo $row["usn"] ?></td>
                                <td><?php echo $s2["fname"] ?></td>
                                <td><?php echo $row["event_name"] ?></td>
                                <td><a href="../approvals/view_event_leave.php?id=<?php echo $row["id"]; ?>">
                                        <button type="button" class="btn btn-info">View</button></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<h5><center> No Leave Applied </center></h5>';
                    }
                    ?>
                </table>

                <h4 style="text-align:center; margin-top: 40px; font-family: 'Gabriela', serif;">Placement Leave</h4>
                <table class="table table-responsive table-striped mt-3" style="margin-top: 20px;">
                    <?php
                    if (mysqli_num_rows($resp) != 0) {
                    ?>
                        <tr>
                            <th scope="col" style="width: 10%;">USN</th>
                            <th scope="col" style="width: 10%;">Name</th>
                            <th scope="col" style="width: 10%;">Company Name</th>
                            <th scope="col" style="width: 10%;">View</th>
                        </tr>
                        <?php
                        foreach ($resp as $row)
                            $st = 'select * from students where usn = "' . $row["usn"] . '"';
                        $s = $link->query($st);
                        $s2 = mysqli_fetch_assoc($s); {
                        ?>
                            <tr>
                                <td><?php echo $row["usn"] ?></td>
                                <td><?php echo $s2["fname"] ?></td>
                                <td><?php echo $row["company_name"] ?></td>
                                <td><a href="../approvals/view_placement_leave.php?id=<?php echo $row["id"]; ?>">
                                        <button type="button" class="btn btn-info">View</button></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<h5><center> No Leave Applied </center></h5>';
                    }
                    ?>
                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="faculty" role="tabpanel" aria-labelledby="faculty-tab">
            <div class="row">
                <h4 style="text-align:center;margin-top: 30px;">Casual Leave</h4>
                <?php
                if (mysqli_num_rows($res2) != 0) {
                    foreach ($res2 as $r) {
                        $st = 'select * from faculty_details where faculty_name = "' . $r["faculty_name"] . '"';
                        $s = $link->query($st);
                        $s2 = mysqli_fetch_assoc($s);
                ?>
                        <div class="row" style="margin-top: 30px;">
                            <div class="col col-lg-4 col-12 label mt-2">
                                Name : <span class="value"><?php echo $s2["faculty_name"] ?></span>
                            </div>
                        </div>
                        <table class="table table-responsive table-borderless" style="width:35%;">
                            <tbody>
                                <tr class="">
                                    <td scope="col" style="width: 10%;">Reason</td>
                                    <td scope="col" style="width: 1%;">:</td>
                                    <td scope="col" style="width: 80%;"><?php echo $r["reason"] ?></td>
                                </tr>
                                <tr class="">
                                    <td scope="col" style="width: 10%;">From</td>
                                    <td scope="col" style="width: 1%;">:</td>
                                    <td scope="col" style="width: 80%;"><?php echo $r["from_date"] ?></td>
                                </tr>
                                <tr class="">
                                    <td scope="col" style="width: 10%;">To</td>
                                    <td scope="col" style="width: 1%;">:</td>
                                    <td scope="col" style="width: 80%;"><?php echo $r["to_date"] ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="approve_fac_CL.php" method="post">
                            <input type="text" name="id" value="<?php echo $r['id'] ?>" hidden>
                            <input type="submit" class="btn btn-success" name="approve" value="Approve">
                            <input type="submit" class="btn btn-danger" style="margin-left: 40px;" name="reject" value="Reject">
                        </form>
                        <hr style="margin-top:20px;">
                <?php
                    }
                } else {
                    echo '<h5> No Approvals Needed</h5>';
                }
                ?>
                <h4 style="text-align:center;margin-top: 30px;">SCL Leave</h4>
                <?php
                if (mysqli_num_rows($res3) != 0) {
                    foreach ($res3 as $r) {
                        $st = 'select * from faculty_details where faculty_name = "' . $r["faculty_name"] . '"';
                        $s = $link->query($st);
                        $s2 = mysqli_fetch_assoc($s);
                ?>
                        <div class="row" style="margin-top: 30px;">
                            <div class="col col-lg-4 col-12 label mt-2">
                                Name : <span class="value"><?php echo $s2["faculty_name"] ?></span>
                            </div>
                        </div>

                        <table class="table table-responsive table-striped mt-3" style="margin-top: 20px;">
                            <tbody>
                                <tr class="">
                                    <td scope="col" style="width: 10%;">Reason</td>
                                    <td scope="col" style="width: 1%;">:</td>
                                    <td scope="col" style="width: 80%;"><?php echo $r["reason"] ?></td>
                                </tr>
                                <tr class="">
                                    <td scope="col" style="width: 10%;">From</td>
                                    <td scope="col" style="width: 1%;">:</td>
                                    <td scope="col" style="width: 80%;"><?php echo $r["from_date"] ?></td>
                                </tr>
                                <tr class="">
                                    <td scope="col" style="width: 10%;">To</td>
                                    <td scope="col" style="width: 1%;">:</td>
                                    <td scope="col" style="width: 80%;"><?php echo $r["to_date"] ?></td>
                                </tr>
                                <tr class="">
                                    <td scope="col" style="width: 10%;">Document</td>
                                    <td scope="col" style="width: 1%;">:</td>
                                    <td scope="col" style="width: 80%;"><a href="<?php echo $r["doc_name"]; ?>" target="_blank" style="color:blue">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="approval_fac_scl.php" method="post">
                            <input type="text" name="id" value="<?php echo $r['id'] ?>" hidden>
                            <input type="submit" class="btn btn-success" name="approve" value="Approve">
                            <input type="submit" class="btn btn-danger" style="margin-left: 40px;" name="reject" value="Reject">
                        </form>
                        <hr style="margin-top:20px;">
                <?php
                    }
                } else {
                    echo '<h5> No Approvals Needed</h5>';
                }
                ?>
                <h4 style="text-align:center;margin-top: 30px;">OOD Leave</h4>
                <?php
                if (mysqli_num_rows($res4) != 0) {
                    foreach ($res4 as $r) {
                        $st = 'select * from faculty_details where faculty_name = "' . $r["faculty_name"] . '"';
                        $s = $link->query($st);
                        $s2 = mysqli_fetch_assoc($s);
                ?>
                        <div class="row" style="margin-top: 30px;">
                            <div class="col col-lg-4 col-12 label mt-2">
                                Name : <span class="value"><?php echo $s2["faculty_name"] ?></span>
                            </div>
                        </div>

                        <table class="table table-responsive table-striped mt-3" style="margin-top: 20px;">
                            <tbody>
                                <tr class="">
                                    <td scope="col" style="width: 10%;">Reason</td>
                                    <td scope="col" style="width: 1%;">:</td>
                                    <td scope="col" style="width: 80%;"><?php echo $r["reason"] ?></td>
                                </tr>
                                <tr class="">
                                    <td scope="col" style="width: 10%;">From</td>
                                    <td scope="col" style="width: 1%;">:</td>
                                    <td scope="col" style="width: 80%;"><?php echo $r["from_date"] ?></td>
                                </tr>
                                <tr class="">
                                    <td scope="col" style="width: 10%;">To</td>
                                    <td scope="col" style="width: 1%;">:</td>
                                    <td scope="col" style="width: 80%;"><?php echo $r["to_date"] ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <form action="approvals_fac_ood.php" method="post">
                            <input type="text" name="id" value="<?php echo $r['id'] ?>" hidden>
                            <input type="submit" class="btn btn-success" name="approve" value="Approve">
                            <input type="submit" class="btn btn-danger" style="margin-left: 40px;" name="reject" value="Reject">
                        </form>
                        <hr style="margin-top:20px;">
                <?php
                    }
                } else {
                    echo '<h5> No Approvals Needed</h5>';
                }
                ?>
            </div>
        </div>
    </div>









</div>





















<?php
include "../template/footer-fac.php";
?>