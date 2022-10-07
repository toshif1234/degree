<?php

include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
include "../error_display_all.php";
// error_reporting(0);
$date = $_POST['month'] ?? $_SESSION['date'];
$_SESSION['date'] = $date;
$sem = $_POST['sem'] ?? $_SESSION['sem'];
$_SESSION['sem'] = $sem;
$sec = $_POST['sec'] ?? $_SESSION['sec'];
$_SESSION['sec'] = $sec;
$branch = $_POST['branch'] ?? $_SESSION['branch'];
$_SESSION['branch'] = $branch;
$sub = $_POST['sub'] ?? $_SESSION['sub'];
$_SESSION['sub'] = $sub;
$c = explode(' - ', $sub);
$subtype = mysqli_fetch_assoc($link->query('select sub_id from subjects_new where sub_code = "' . $c[0] . '"'))['sub_id'];
if ($subtype == '3' && isset($_SESSION['lab_view_batch']) && $_SESSION['lab_view_batch'] == 1) {
    $_SESSION['lab_view_batch'] = 0;
    // header("Location: lab_batch_select_view.php");
    echo '<script>window.location.replace("lab_batch_select_view.php");</script>';

    // ob_end_flush();
    // exit();
}

if ($subtype == '3') {
    $lab_batch = $_POST['lab_batch'] ?? $_SESSION['lab_batch'];
    $_SESSION['lab_batch'] = $lab_batch;
    $q = 'select * from attendance_new a, students s where a.sub="' . $sub . '" and a.sem="' . $sem . '" and a.sec="' . $sec . '" and a.branch="' . $branch . '" and s.lab_batch = "' . $_SESSION['lab_batch'] . '" and s.usn = a.usn';
} 
elseif ($subtype == '1') {
    $q = 'select * from attendance_new a, fac_elec_stud e where a.sub="' . $sub . '" and a.sem="' . $sem . '" and e.faculty_name="' . $_SESSION['username'] . '" and a.usn=e.usn and a.sub=e.sub';
} 
else {
    $q = 'select * from attendance_new where sub="' . $sub . '" and sem="' . $sem . '" and sec="' . $sec . '" and branch="' . $branch . '" order by usn;';
}
// echo $q;
$result = $link->query($q);
$r = mysqli_fetch_assoc($result);

$entire_date = explode(';', $r['att']);
$new_arr = array();
foreach ($entire_date as $e) {
    if (strstr($e, $date) == false) {
        continue;
    } else {
        $new_arr[] = $e;
    }
}
// print_r($new_arr);
$display_dates = array();
$num_stud = mysqli_num_rows($result);
foreach ($new_arr as $n) {
    $display_dates[] = explode(':', $n)[0] . ':' . explode(':', $n)[1];
}

// print_r($display_dates);
$_SESSION['dates'] = $display_dates;
?>
<style>
    .sticky-col {
        position: -webkit-sticky;
        position: sticky;
        background-color: white;
    }

    .custom-table {
        overflow: scroll;
        width: 79vw;
        height: 75vh;
        margin-top: 0px;
        padding: 0;
    }

    .first-col {
        left: 0px;
    }

    thead tr:nth-child(1) th {
        background: silver;
        position: sticky;
        top: 0;
        z-index: 10;
        text-align: center;
    }

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
<div>

    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="mb-2"> View Attendence </h3>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="table-responsive-sm custom-table">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">Slno</th>
                        <th scope="col" class="sticky-col first-col" style="text-align: center;">USN</th>
                        <th scope="col" style="text-align: center;">Name</th>
                        <?php foreach ($display_dates as $d) { ?>
                            <th scope="col" style="text-align: center;"><?php echo $d ?></th>
                        <?php } ?>
                        <th scope="col" style="text-align: center;"> Options </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- loop for creating table rows -->


                    <?php
                    $i = 0;
                    foreach ($result as $r) {
                        $i++;
                    ?>

                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td class="sticky-col first-col" style="text-align: center;"><?php echo $r['usn'] ?></td>
                            <td style="text-align: center;"><?php echo $r['name'] ?></td>
                            <?php
                            $att_stud = array();
                            foreach ($display_dates as $d) {
                                $q_stud = 'select * from attendance_new where sub="' . $sub . '" and sem="' . $sem . '" and branch="' . $branch . '" and usn = "' . $r['usn'] . '";';
                                $result_stud = $link->query($q_stud);
                                $r_stud = mysqli_fetch_assoc($result_stud)['att'];
                                $stud_att = explode(';', $r_stud);
                                foreach ($stud_att as $s_att) {
                                    if (strstr($s_att, $d) == false) {
                                        continue;
                                    } else {
                                        $att_stud[] = explode(':', $s_att)[2];
                                    }
                                }
                            ?>
                            <?php } ?>
                            <form action="row_update.php" method="post">
                                <?php
                                $iii = 0;
                                foreach ($att_stud as $a) {
                                    $iii++;
                                ?>
                                    <td>


                                        <div class="form-check form-switch mx-auto">
                                            <input class="form-check-input form-success" type="checkbox" id="cell-<?php echo $i . '-' . $iii ?>" name='row<?php echo $i . $iii ?>' <?php if ($a) {
                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                    } ?>>

                                        </div>

                                    </td>
                                <?php } ?>
                                <td>

                                    <input type="text" name="usn" id="" value="<?php echo $r['usn']; ?>" hidden>
                                    <input type="text" name="i" id="" value="<?php echo $i ?>" hidden>
                                    <input type="text" name="iii" id="" value="<?php echo $iii ?>" hidden>
                                    <button class="btn btn-info" type="submit"><i class="fas fa-floppy-o"></i></button>
                            </form>
                            </td>
                        </tr>

                    <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <?php
                        $i = 0;
                        foreach ($display_dates as $r) {
                            $i++;
                        ?>
                            <td>
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-3">
                                        <button class="btn btn-info " id="up_col-<?php echo $i ?>" onclick="update_col(this.id)"><i class="fas fa-floppy-o"></i></button>
                                        <form action="update_col.php" id="form-<?php echo $i ?>" method="post">
                                            <input type="text" name="arr" id="val-<?php echo $i ?>" value='' hidden>
                                            <input type="text" name="date" value="<?php echo $r ?>" hidden>

                                        </form>
                                    </div>
                                    <div class="col-3">
                                        <form action="del_col.php" id="form-<?php echo $i ?>" method="post">
                                            <input type="text" name="date" value="<?php echo $r ?>" hidden>
                                            <button class="btn btn-danger" type="submit" id="del_col-<?php echo $i ?>"> <i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-3"></div>
                                </div>
                            </td>
                        <?php
                        }
                        ?>
                        <td></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </script>
    <script>
        function update_col(id) {
            let num_stud = <?php echo $num_stud; ?>;
            let colid = id.split("-")[1];
            const arr = [];
            for (let i = 1; i <= num_stud; i++) {
                let cellid = "cell-" + i + "-" + colid;
                arr.push(document.getElementById(cellid).checked);
            }
            console.log(arr);
            var json_file = JSON.stringify(arr);
            document.getElementById('val-' + colid).value = json_file;
            document.getElementById('form-' + colid).submit();
            // sessionStorage.setItem('arr', arr);
            // window.location = 'update_col.php?arr=';
        }
    </script>






    <?php include "../template/footer-fac.php"; ?>