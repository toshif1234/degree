<?php include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
error_reporting(0);

// echo $_SESSION['sub_name'];

$fac_assign = "select distinct assignment_no from add_assignment where sub_name = \"" . $_SESSION['sub_name'] . "\" and fac_name = \"" . $_SESSION['username'] . "\"";

$assignment_section = "select distinct section from add_assignment where sub_name = \"" . $_SESSION['sub_name'] . "\" and fac_name = \"" . $_SESSION['username'] . "\"";
if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) { 
    $sub_code = "select sub_code from subjects where sub_name = \"" . $_SESSION['sub_name'] . "\"";
}
else{
    $sub_code = "select sub_code from subjects_new where sub_name = \"" . $_SESSION['sub_name'] . "\"";
}
    // echo $fac_assign;
$r = $link->query($sub_code);
$result = $link->query($fac_assign);

$q1 = "select distinct dept_name from dept_pso order by dept_name";
// echo $q1;
$q2 = "select distinct semester from students";
// $q3 = "select distinct section from add_assignment ";
$result1 = $link->query($q1);
$result2 = $link->query($q2);
$result3 = $link->query($assignment_section);


// if (isset($_POST['submit'])) {

//     $_SESSION['assignment_no'] = $_POST['assignment_no'];
// }   
?>

<div class="container-fluid">
    <div class="row">
        <h3>Subject: <?php foreach ($r as $sub) {
                            echo $sub['sub_code'];
                        } ?>-<?php echo $_SESSION['sub_name'] ?></h3>
    </div>
    <div>
        <div id = "assignment_notification">
            <h3 id = "assignment_error"></h3>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    </div>
    <form action="../assignment/session2.php" method="post">

        <!-- <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for=""></label>
                    <select class="form-control" name="sub_name" required hidden>
                        <option value="<?php echo $_SESSION['sub_name'] ?>" selected><?php echo $_SESSION['sub_name'] ?></option>
                    </select>
                </div>
            </div>
        </div> -->

        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="sub">Assignment No.</label>
                    <select class="form-control" name="assignment_no" required>
                        <option selected disabled>select assignment no. </option>
                        <?php foreach ($result as $row) { ?>

                            <option value="<?php echo $row["assignment_no"]; ?>"><?php echo $row["assignment_no"]; ?></option>

                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="sub">Branch</label>
                    <select name="branch" class="form-control">
                        <option selected disabled>Select Branch </option>

                        <?php

                        foreach ($result1 as $r) {


                            echo "<option value=\"" . $r["dept_name"] . "\"> " . $r["dept_name"] . "</option>";
                        }  ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="sub">Semester</label>
                    <select name="semester" class="form-control">
                        <option selected disabled>Select Semester </option>
                        <?php

                        foreach ($result2 as $r) {


                            echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";
                        }  ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="sub">Section</label>
                    <select name="section" class="form-control">
                        <option selected disabled>Select Section </option>
                        <?php

                        foreach ($result3 as $r) {


                            echo "<option value=\"" . $r["section"] . "\"> " . $r["section"] . "</option>";
                        }  ?>
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group" mt-3>
                    <label for="sub"></label>
                    <div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <?php

    ?>

</div>
<script>
    // document.getElementById("assignment_notification").style.display = "hidden";  //hide
    var element = document.getElementById("assignment_error");
    var assignment_error = "<?php echo $_SESSION['assignment_error'] ?? ""; ?>";
    
    console.log(assignment_error) ;
    if(assignment_error == "error"){
        // document.getElementById("assignment_notification").style.display = "block"; 
        element.innerHTML =" Assignment does not exist.";
        <?php $_SESSION['assignment_error']=""?>;
        
    }
</script>

<?php include("../template/footer-fac.php") ?>