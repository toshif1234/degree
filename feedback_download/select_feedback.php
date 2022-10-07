<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
    $q_sem = 'select distinct sem from subjects';
} else {
    $q_sem = 'select distinct sem from subjects_new';
}
$r_sem = $link->query($q_sem);

?>
<form action="redirect.php" method="post">
    <div class="row m-4">
        <div class="form-group col-4 mt-4">
            <label for="feedback">Feedback :</label>
            <select name="feedback_name" id="feedback" class='form-control' required>
                <option value="" selected disabled>Select Feedback</option>
                <option value="curriculum_feedback">Curriculum Feedback</option>
                <option value="course_wise_2">Course wise 2</option>
                <option value="course_end">Course End</option>

                <!-- <option value="Course_end">Course End</option> -->

            </select>
        </div>
        <div class="form-group col-4 mt-4">
            <label for="semester">Semester :</label>
            <select name="semester" id="semester" class='form-control' required>
                <option value="" selected disabled>Select Semester</option>
                <?php

                foreach ($r_sem as $r) {
                ?>
                    <option value="<?php echo $r['sem'] ?>"><?php echo $r['sem'] ?></option>
                <?php } ?>

            </select>
        </div>
        <div class="form-group col-4 mt-4">
            <label for="section">Section :</label>
            <select name="section" id="section" class='form-control' required>
                <option value="" selected disabled>Select Section</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="ALL">ALL</option>

            </select>
        </div>
    </div>
    <div class="form-group mt-4">
        <input type="submit" class="btn btn-primary" style="margin-left: 3em;" name="" id="" value='Download'>
    </div>
</form>
<a hidden href="<?php echo $_SESSION['feedback_name'] . '.xlsx' ?>" download id="down"></a>
<?php if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) { ?>
    <div class="row mt-5">
        <div class="col-md-3">
            <h3>Consolidated Report:</h3>
        </div>
        <div class="col-md-3">
            <form action="download_consolid.php" method="POST" target="_blank">
                <input type="submit" class="btn btn-primary" style="margin-left: 3em;" name="" id="" value='Download'>
            </form>
        </div>
        <div class="col-md-6"></div>
    </div>
<?php
}
$down = $_SESSION['down'] ?? 0;
if ($down == 1) { ?>
    <script>
        document.getElementById('down').click();
        <?php $_SESSION['down'] = 0; ?>
    </script>
<?php
}
?>
<?php
include "../template/footer-fac.php";
?>