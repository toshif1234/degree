<?php
require_once "../config.php";
$con=$link;
error_reporting(0);
include(
"../template/stud_auth.php");
include("../template/student_sidebar.php");
//session_start();

$q="Select DISTINCT hostel_name from hostel_info";
$res1=$link->query($q);

$q1="Select DISTINCT hostel_block from hostel_info";
$res2=$link->query($q1);
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <p style="font-style: italic;font-weight:600;color:black;">Hostel Details</p>
    <div class="col col-lg-4 col-12 label mt-2">
        <div id="wrapper">
            <label for="yes_no_radio">Are you a Hostelite?</label>
            <p>
                <input type="radio" name="choice" value= "yes" checked>Yes</input>
            </p>
            <p>
                <input type="radio" name="choice" value= "No">No</input>
            </p>
        </div>
        <div class="row">
            <div class="col col-12  col-lg-4">
                <div class="mb-3">
                    <label for="Hostel">Hostel Name :</label>
                        <select name="hostel" id="hostel" class="custom-select form-control">
                            <option selected disabled>Select Hostel Name</option>
                            <?php
                                foreach($res1 as $r){
                            ?>
                            <option value="<?php echo $r["hostel_name"] ?>"><?php echo $r["hostel_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-12  col-lg-4">
                <div class="mb-3">
                    <label for="Hostel">Hostel Block :</label>
                        <select name="block" id="hostel" class="custom-select form-control">
                            <option selected disabled>Select Hostel Block</option>
                            <?php
                                foreach($res2 as $r){
                            ?>
                                <option value="<?php echo $r["hostel_block"] ?>"><?php echo $r["hostel_block"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary" style="float: left;">Submit</button>
    </div>
</form>

<?php
if(isset($_POST["submit"]))
{
    if($_POST["choice"]=="yes" && $_POST["block"]!="" && $_POST["hostel"]!=""){
        $hostel_block = $_POST["block"];
        $hostel_name =  $_POST["hostel"];
        $que = "insert into hostel_details(usn,hostel_block,hostel_name) values (\"" . $_SESSION['username'] . "\",\"" . $hostel_block. "\",\"" . $hostel_name .  "\")";
        $result = $con->query($que);
    }
        //header("Location: ../student_leave_management/medical.php");
        echo '<script>window.location.replace("../student_profile/student_login_profile_view.php");</script>';
    
}
?>




</div>
<!-- page content end -->
</div>
</div>
<script src="../asset/style/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>
<script>
$(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
});
</script>
</body>

</html>