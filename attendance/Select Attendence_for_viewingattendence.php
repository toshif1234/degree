<?php
                    // session_start();
                    error_reporting(0);

include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$q1 = "select distinct branch from students";
// echo $q1;
$result = $link->query($q1);
$q2 = "select distinct semester from students";
$q3 = "select distinct section from students";
$result1 = $link->query($q2);
$result2 = $link->query($q3);
$faculty_name = $_SESSION["username"];
$_SESSION["temp"] = 0;

if(isset($_SESSION["check_error"]) && $_SESSION["check_error"] == 1){
    $_SESSION["check_error"] = 0;
    echo '<div style="width:50%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Subject and semester doesnot match</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
  
}

?>
 


<!-- page content start -->

<form action="View_or_Edit_Attendence.php" method="post">
    <div class="container mb-5">
        <div class="row">

            <div class="col">
                <label for="sub">Semester</label>
                <select name="sem" class="form-control">
                    <option selected> Semester </option>
                    <?php

                    foreach ($result1 as $r) {


                        echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";
                    }  ?>
                </select>
            </div>
            <div class="col">
                <label for="sub">Section</label>
                <select name="sec" class="form-control">
                    <option selected> Section </option>
                    <?php

                    foreach ($result2 as $r) {


                        echo "<option value=\"" . $r["section"] . "\"> " . $r["section"] . "</option>";
                    }  ?>
                </select>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="Subject"> Subject </label>
                    <select name="sub" class="form-control" id="Subject">
                        <?php
                        $qt = "select a.sub_name, a.sub_code, a.lab from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                        $resultst = $link->query($qt);
                        echo $qt;
                        foreach ($resultst as $r) {
                            if($r['lab'] != 1){ 
                        ?>
                            <option class="form-control" value="<?php echo $r["sub_code"] . " - " . $r["sub_name"] ?>"><?php echo $r["sub_code"] . " - " . $r["sub_name"] ?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
            <div class="col">
                <label for="sub">Branch</label>
                <select name="branch" class="form-control">
                    <option selected disabled> Branch </option>

                    <?php

                    foreach ($result as $r) {
                    ?>
                        <option value="<?php echo $r['branch'] ?>"><?php echo $r['branch'] ?></option>
                    <?php
                    }  ?>
                </select>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="month"> Month </label>
                    <select name="month" class="form-control" id="Period">
                        <option value="01">Jan</option>
                        <option value="02">Feb</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">Aug</option>
                        <option value="09">Sept</option>
                        <option value="10">Oct</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
            </div>
            <div class="col mt-4">
                <div class="form-group">
                    <!-- <label for="Date"> </label> -->
                    <input type="Submit" value="Load" name="Filter" class="form-control btn btn-primary" id="Filter">
                </div>
            </div>
            <!-- <div class="col">
                <div class="form-group">
                    <!-- <label for="Date"> Date </label> -->
                    <!-- <input type="date" name="date" class="form-control" id="Date"> -->
                </div>
            </div> 
        </div>
    </div>
</form>
</div>
<!-- page content end -->
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>

</html>