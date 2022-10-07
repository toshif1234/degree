<?php
require_once "../config.php";
$con=$link;
error_reporting(0);
include(
"../template/stud_auth.php");
include("../template/student_sidebar.php");
//session_start();

?>
<?php
                
$admission_no = $_SESSION["adm_no"];

$que = "select * from parents_details where adm_no=\"$admission_no\"";
// echo $que;
$result = $con->query($que);

            foreach ($result as $r) {
            ?>
<form action="update_profile_parents_details.php" method="post">

    <h4>Parents Details :</h4><br>
    <div class="form-group col-md-4">
            <label for="puc_reg_no">Admission Number:</label>
            <input type="text" name="adm_no" class="form-control" id="puc_reg_no" value=<?php echo $admission_no?>
                readonly>
    </div>
    <h1></h1>
    <h4>Father Details :</h4><br>
    <div class="row">
        <div class="col col-lg-4 col-12">
            <label for="father_name">Name :</label>
            <input type="text" name="father_name" class="form-control" id="father_name" value=<?php echo $r["father_name"] ?>
                >
        </div>
        <div class="col col-lg-4 col-12">
            <label for="father_mob_no">Mobile Number :</label>
            <input type="text" name="father_mob_no" class="form-control" id="father_mob_no" readonly value=<?php echo $r["father_mob_no"] ?>>
        </div>
        <div class="col col-lg-4 col-12">
            <label for="father_email_id">Email ID :</label>
            <input type="text" name="father_email_id" class="form-control" id="father_email_id"  value=<?php echo $r["father_email_id"] ?>>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4 col-12">
            <label for="father_aadhar">Aadhar card Number :</label>
            <input type="text" name="father_aadhar" class="form-control" id="father_aadhar" value=<?php echo $r["father_aadhar"] ?>
                >
        </div>
        <div class="col col-lg-4 col-12">
            <label for="father_pan_cad">PAN card Number  :</label>
            <input type="text" name="father_pan_cad" class="form-control" id="father_pan_cad"  value=<?php echo $r["father_pan_cad"] ?>>
        </div>
        <div class="col col-lg-4 col-12">
            <label for="father_occupation">Occupation :</label>
            <input type="text" name="father_occupation" class="form-control" id="father_occupation"  value=<?php echo $r["father_occupation"] ?>>
        </div>
    </div>
    <h4>Mother Details :</h4><br>
    <div class="row">
        <div class="col col-lg-4 col-12">
            <label for="mother_name">Name :</label>
            <input type="text" name="mother_name" class="form-control" id="mother_name" value=<?php echo $r["mother_name"] ?>
                >
        </div>
        <div class="col col-lg-4 col-12">
            <label for="mother_mob_no">Mobile Number :</label>
            <input type="text" name="mother_mob_no" class="form-control" id="mother_mob_no" readonly value=<?php echo $r["mother_mob_no"] ?>>
        </div>
        <div class="col col-lg-4 col-12">
            <label for="mother_email_id">Email ID :</label>
            <input type="text" name="mother_email_id" class="form-control" id="mother_email_id"  value=<?php echo $r["mother_email_id"] ?>>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-4 col-12">
            <label for="mother_aadhar">Aadhar card Number :</label>
            <input type="text" name="mother_aadhar" class="form-control" id="mother_aadhar" value=<?php echo $r["mother_aadhar"] ?>
                >
        </div>
        <div class="col col-lg-4 col-12">
            <label for="mother_pan_card">PAN card Number  :</label>
            <input type="text" name="mother_pan_card" class="form-control" id="mother_pan_card"  value=<?php echo $r["mother_pan_card"] ?>>
        </div>
        <div class="col col-lg-4 col-12">
            <label for="mother_occupation">Occupation :</label>
            <input type="text" name="mother_occupation" class="form-control" id="mother_occupation"  value=<?php echo $r["mother_occupation"] ?>>
        </div>
    </div>



    
    

            <button type="submit" class="btn btn-primary" style="float: right;">Update</button>


        </div>
    </div>
</form>

<?php
}
// } ?>





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