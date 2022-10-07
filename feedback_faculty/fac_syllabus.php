<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

$q = 'select * from feedback_response where usn="' . $_SESSION['username'] . '" and feedback_name="Feedback on syllabus"';
$q_r = $link->query($q);
if (mysqli_num_rows($q_r) != 0) {
    echo 'You have already submitted this feedback';
}
else{
$r = 'select * from faculty_details where faculty_name="' . $_SESSION['username'] . '"';
$r_q = mysqli_fetch_assoc($link->query($r));
$gen = 'select * from feedback_all where feedback_name="Feedback on syllabus"';
$r_gen = mysqli_fetch_assoc($link->query($gen));

?>


<form action="fac_syll_update.php" method="post">
    <div class="font-weight-bolder" style='height: 3em;'>
        <h3>Feedback on Syllabus</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th style='width: 5em;' scope="col">SL.No</th>
                    <th style='width: 40em;' scope="col">Questions</th>
                    <th style="text-align:center;" scope="col">1</th>
                    <th style="text-align:center;" scope="col">2</th>
                    <th style="text-align:center;" scope="col">3</th>
                    <th style="text-align:center;" scope="col">4</th>
                    <th style="text-align:center;" scope="col">5</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($c = 1; $c <= 9; $c++) { ?>
                    <tr>
                        <td><?php echo $c ?></td>
                        <td>
                            <h5><?php echo $r_gen['q' . $c] ?></h5>
                        </td>
                        <td><input class='form-group' type="radio" name="g_rating<?php echo $c ?>" id="" value="1" required></td>
                        <td><input type="radio" name="g_rating<?php echo $c ?>" id="" value="2" required></td>
                        <td><input type="radio" name="g_rating<?php echo $c ?>" id="" value="3" required></td>
                        <td><input type="radio" name="g_rating<?php echo $c ?>" id="" value="4" required></td>
                        <td><input type="radio" name="g_rating<?php echo $c ?>" id="" value="5" required></td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </div>
    <div class="font-weight-bolder" style='width: 2em;height: 3em;'>
        <h3>Comment</h3>
    </div>
    <div><textarea class="form-control" name="comment" id="com" cols="150" rows="4"></textarea></div>
    
    <input type="text" name="branch" id="" value="<?php echo $r_q['faculty_dept'] ?>" hidden>
    <!-- <input type="text" name="semester" id="" value="<?php echo $r_q['semester'] ?>" hidden> -->
    <input type="text" name="name" id="" value="<?php echo $r_q['faculty_name'] ?>" hidden>
    <!-- <input type="text" name="section" id="" value="<?php echo $r_q['section'] ?>" hidden> -->
    <!-- <input type="text" name="batch" id="" value="<?php echo $r_q['batch'] ?>" hidden> -->
    <input type="text" name="count_general" id="" value="<?php echo ($c - 1) ?>" hidden>
    <button type="submit" class="btn btn-success mt-3">Submit</button>
</form>
<?php
}
//header("Location: course_end_suject.php");
include "../template/student-footer.php";

?>