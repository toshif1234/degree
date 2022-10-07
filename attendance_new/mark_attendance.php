<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";


$sub = $_SESSION['sub'];
$sem = $_SESSION['sem'];
$sec = $_SESSION['sec'];
$branch = $_SESSION['branch'];
$att = $_SESSION['att'];
$date = $_SESSION['date'];
$period = $_SESSION['period'];
$c = explode(' - ', $sub);
$subtype = mysqli_fetch_assoc($link->query('select sub_id from subjects_new where sub_code = "' . $c[0] . '"'))['sub_id'];
if ($subtype == '1') {
    $q = 'select * from attendance_new a, fac_elec_stud e where a.sub="' . $sub . '" and a.sem="' . $sem . '" and e.faculty_name="' . $_SESSION['username'] . '" and a.usn=e.usn and a.sub=e.sub';
} elseif ($subtype == '3') {
    $q = 'select * from attendance_new a, students s where a.sub="' . $sub . '" and a.sem="' . $sem . '" and a.sec="' . $sec . '" and a.branch="' . $branch . '" and s.lab_batch = "' . $_SESSION['lab_batch'] . '" and s.usn = a.usn';
} else {
    $q = 'select * from attendance_new where sub="' . $sub . '" and sem="' . $sem . '" and sec="' . $sec . '" and branch="' . $branch . '" order by usn;';
}
$result = $link->query($q);
// $att_arr = array();
// echo $q;
// $q2 = 'select * from attendance_new where sub="' . $sub . '" and sem="' . $sem . '" and sec="' . $sec . '" and branch="' . $branch . '" and usn = "' . $s . '";';
// $result1 = $link->query($q2);




// $q_up = 'update attendance_new set att = "' . $q . '" where sub="' . $sub . '" and sem="' . $sem . '" and sec="' . $sec . '" and branch="' . $branch . '" and usn = "' . $s . '";';
// $link->query($q_up);


?>
<style>
    .form-check {
        max-width: 30px;
        display: flex;
    }

    .form-check-input:checked {
        background-color: #4cc705;
        border: #20c957;
    }

    .form-check-input {
        background-color: #db3927;
        border: #db3967;
    }
</style>
<h3 class="mb-5"> Add Attendence </h3>


<table class="table table-hover table-bordered table-responsive table-light">
    <thead class="thead-secondary">
        <tr>
            <th scope="col" style="text-align: center;">USN</th>
            <th scope="col" style="text-align: center;">Name</th>
            <th scope="col" style="text-align: center;"><?php echo $date;
                                                        echo "<br>";
                                                        echo "Period: " . $period ?></th>



        </tr>
    </thead>
    <tbody>
        <form action="update_attendance.php" method="post">
            <button class="btn btn-success  mb-4" style="float:right " type="submit">Submit</button>
            <?php
            foreach ($result as $r1) {
                if (strstr($r1['att'], $att)) {
                    $p = 1;
                } else {
                    $p = 0;
                }

            ?>
                <tr>

                    <td style="text-align: center;"><?php echo $r1["usn"] ?></td>
                    <td style="text-align: center;"><?php echo $r1["name"] ?></td>


                    <td>
                        <div class="form-check form-switch mx-auto">
                            <?php if ($p == 1) {  ?>

                                <input class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" name='a[]' value="<?php echo $r1["usn"]; ?>" checked>
                            <?php } else { ?>
                                <input class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" name='b[]' value="<?php echo $r1["usn"]; ?>">
                        </div>
                    <?php } ?>
                    </td>



                </tr>

            <?php
            } ?>

    </tbody>
</table>
<div>
    <?php include "../template/scroll.php"; ?>
</div>

</form>

<?php include "../template/footer-fac.php"; ?>