<?php 
require_once "../config.php";
include("../template/admin-auth.php");
                    error_reporting(0);

include("../template/sidebar-admin.php");

?>
                <div class="container">
                    <?php
                    $con = $link;

                        $que = "select * from faculty_mapping";
                        $result = $con->query($que);
                        
                        $con1 = 0;
                        foreach ($result as $row) {
                            // echo $row["faculty_name"];
                            $con1++;

                    ?>
                    <div class="row" style="background: transparent; padding:1.5% ;margin-top: 1%;">
                                    <div class="form-group col-md-4">
                                        <label for="adm_no">Faculty Name :</label>
                                        <input type="text" name="adm_no" class="form-control" id="adm_no" value="<?php echo $row["faculty_name"]; ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="usn">Subject Name :</label>
                                        <input type="text" name="usn" class="form-control" id="usn" value="<?php echo $row["sub_name"]; ?>" readonly>
                                    </div>
                                   
                                    <div class="form-group col-md-3" style="margin-top: .6%;left: 0%;">
                                        <label for=""> </label><br>
                                       
                                       
                                        <!-- delete button -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter1<?php echo $con1 ?>" onclick="console.log(<?php echo $row["faculty_name"]; ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <!-- delete button model -->
                                        <!-- model -->
                                        <div class="modal fade" id="exampleModalCenter1<?php echo $con1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content container">
                                                    <div class="modal-header">

                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure that you want to delete?
                                                    </div>
                                                    

                         

                            <form action="faculty_delete.php" method="POST">

                                <div class="form-group col-md-5">
                                    <label for="faculty_name">Faculty Name :</label>
                                    <input type="text" name="faculty_name" class="form-control" id="faculty_name" value="<?php echo $row["faculty_name"]; ?>" readonly>
                                    <label for="sub_name">Subject Name :</label>
                                    <input type="text" name="sub_name" class="form-control" id="sub_name" value="<?php echo $row["sub_name"]; ?>" readonly>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade " id="exampleModal<?php echo $con1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          
        </div>
    </div>


    </div>

    </div>



<?php
                        }
                     ?>








</div>
</div>


<!-- page content end -->
<div>

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