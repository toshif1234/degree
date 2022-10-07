<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
error_reporting(0);
require_once '../config.php';


?>




    <!-- page content start -->
    <div>

        <div class="container">
            <!-- <div class="card"> -->
            <form action="faculty_workshop_data.php" method="POST">
                <div class="form-row form-inline mb-4">
                    <div class="col-md-4">
                        <label for="faculty_id" class="col-form-label" > Faculty ID :</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="faculty_id" id="faculty_id" class="form-control" value="<?php echo $_SESSION["faculty_id"]?? "" ?>" readonly>
                    </div>
                </div>
                <div class="form-row form-inline mb-4">
                    <div class=" col-md-4">
                        <label for="faculty_workshop_name" class="col-form-label">Workshop Title :</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="faculty_workshop_name" id="faculty_workshop_name" class="form-control" required>
                    </div>
                </div>
                <div class="form-row form-inline mb-4">
                    <div class="col-md-4">
                        <label for="faculty_workshop_title" class="col-form-label">Workshop Organized By :</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="faculty_workshop_title" id="faculty_workshop_title" class="form-control" required>
                    </div>
                </div>
                <div class="form-row form-inline mb-3">
                    <div class="col-md-4">
                        <label for="faculty_workshop_no_of_days" class="col-form-label">No of Days Conducted :</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="faculty_workshop_no_of_days" id="faculty_workshop_no_of_days" class="form-control" required>
                    </div>
                </div>
                <div>
                    <button type="submit" value="Submit" class="btn btn-primary" style="margin-left:30%"> Submit</button>
                </div>
            </form>
        </div>
    </div>

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