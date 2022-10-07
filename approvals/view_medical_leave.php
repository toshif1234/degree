<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);
?>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gabriela&display=swap" rel="stylesheet">
<div class="container">
            <div class="row">
            <h4 style="text-align:center;margin-top: 20px;">Medical Leave</h4>
            <?php  
                        $id = $_GET["id"];
                        $que = 'select * from student_medical_leave where id = "' . $id . '"';
                        $res = $link->query($que);
                        $r = mysqli_fetch_assoc($res);
                        $st = 'select * from students where usn = "' . $r["usn"] . '"';
                        $s = $link->query($st);
                        $s2 = mysqli_fetch_assoc($s);
                    ?>
                    <div class="row" style="margin-top: 30px;">
                        <div class="col col-lg-4 col-12 label mt-2">
                            USN : <span class="value"><?php echo  $r["usn"] ?></span>
                        </div>
                        <div class="col col-lg-4 col-12 label mt-2">
                            Name : <span class="value"><?php echo $s2["fname"] ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-4 col-12 label mt-2">
                            Semester : <span class="value"><?php echo $s2["semester"] ?></span>
                        </div>
                        <div class="col col-lg-4 col-12 label mt-2">
                            Section : <span class="value"><?php echo $s2["section"] ?></span>
                        </div>
                    </div>
                    <!-- <h6 style="margin-top:25px;"><b>Available Attendance</b></h6>
                    <table class="table table-responsive table-borderless" style="width:35%;">
                        <tbody>
                            <tr>
                            <?php
                                $que1='select * from students where usn="' .  $r["usn"] . '"';
                                $rstd = $link->query($que1);
                                $rsd = mysqli_fetch_assoc($rstd);
                                $que2 = "select * from attendance_new where usn=\"" .  $r["usn"] . "\" and sem=\"" . $rsd["semester"] . "\"";
                                $result4 = $link->query($que2);
                                foreach ($result4 as $row) {
                                    $position = strpos($row["sub"], '-');        
                            ?>
                                <td><?php echo substr($row["sub"], 0, $position)?></td>
                            <?php
                                }
                            ?>
                                </tr>
                            <tr>
                            <?php
                                foreach ($result4 as $row) {       
                            ?>
                                <td style="text-align:center;"><?php echo $row["att_avg"] ?></td>
                            <?php
                                }
                            ?>
                            </tr>
                        </tbody>
                    </table> -->
                    <table class="table table-responsive table-striped mt-3" style="margin-top: 20px;">
                        <tbody>
                            <tr class="" >
                                <td scope="col" style="width: 10%;">Reason</td>
                                <td scope="col" style="width: 1%;">:</td>
                                <td scope="col" style="width: 80%;" ><?php echo $r["reason"] ?></td>
                            </tr>
                            <tr class="" >
                                <td scope="col" style="width: 10%;">From</td>
                                <td scope="col" style="width: 1%;">:</td>
                                <td scope="col" style="width: 80%;" ><?php echo $r["from_date"] ?></td>
                            </tr>
                            <tr class="" >
                                <td scope="col" style="width: 10%;">To</td>
                                <td scope="col" style="width: 10%;">:</td>
                                <td scope="col" style="width: 80%;" ><?php echo $r["to_date"] ?></td>
                            </tr>
                            <tr class="" >
                                <td scope="col" style="width: 10%;">Document</td>
                                <td scope="col" style="width: 10%;">:</td>
                                <td scope="col" style="width: 80%;" ><a href="<?php echo $r["doc_name"]; ?>" target="_blank" style="color:blue">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="approve_student_medical.php" method="post">
                        <input type="text" name="id" value="<?php echo $r['id'] ?>" hidden>
                        <input type="submit" class="btn btn-success" name ="approve" value="Approve">
                        <input type="submit" class="btn btn-danger" style="margin-left: 40px;" name ="reject" value="Reject">
                    </form>
                <hr style="margin-top:20px;">
            
            </div>
        </div>
        </div>
    </div>


</div>





















<?php
include "../template/footer-fac.php";
?>