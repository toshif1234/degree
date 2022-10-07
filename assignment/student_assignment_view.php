<?php
require_once "../config.php";
$con = $link;
include("../template/stud_auth.php");
include("../template/student_sidebar.php");
error_reporting(0);

$q = "select * from students where usn=\"" . $_SESSION['username'] . "\"";

$result = $con->query($q);
$row = $result->fetch_assoc();
if ($row) {
    $sem = $row['semester'];
    $branch = $row['branch'];
    $sec = $row['section'];
    // echo $sem;
    // echo $branch;
    // echo $sec;
}
$assign = "select  * from  add_assignment where branch = \"" . $branch . "\" and semester = \"" . $sem . "\" and section = \"" . $sec . "\"";
$res = $con->query($assign);
$marks = "select * from assignment_marks am, add_assignment aa where aa.sub_name = am.sub_name and aa.branch = am.branch and aa.semester = am.semester and aa.section = am.section and am.usn = \"" . $_SESSION['username'] . "\" ";
$marks_result = $con->query($marks);


if (mysqli_num_rows($res) < 1) {
    echo "<h2>No Assignment is given</h2>";
}

?>
<div class="container">
    <?php
    foreach ($res as $r) {
        $as = $marks_result->fetch_assoc();

    ?>
        <div class=" row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="sub">Subject</label>
                    <input type="text" name="" class="form-control" value="<?php echo $r['sub_name'] ?>" id="sub" readonly>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="an" >Assignment No</label>
                    <input type="text" name="" class="form-control" value="<?php echo $r['assignment_no'];
                                                                            $an = 'a' . $r['assignment_no']; ?>" id="an" readonly>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="ld" >Last Date</label>
                    <input type="text" name="" class="form-control" value="<?php echo $r['last_date'] ?>" id="ld" readonly>
                </div>
            </div>

            <?php
            $q = "select $an from assignment_marks where sub_name = \"" . $r['sub_name'] . "\" and branch = \"" . $r['branch'] . "\" and semester = \"" . $r['semester'] . "\" and section = \"" . $r['section'] . "\" and usn = \"" . $_SESSION['username'] . "\"";
            // echo $q;
            $m = $con->query($q);
            $mark = $m->fetch_assoc();
            ?>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="mo" >Marks Obtained</label>
                    <input type="text" name="" class="form-control" value="<?php echo $mark["$an"] ?>" id="mo" readonly>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <div>
                        <pre></pre>
                    </div>

                    <a href="../upload/<?php echo $r['file_name'] ?>" target="_blank"><button class="btn btn-info">View Assignment </button></a>
                </div>
            </div>
        </div>
        <hr>
    <?php
    }
    ?>
</div>
<?php
include("../template/student-footer.php");
?>