<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);


$con = $link;
?>
<?php
if($_SESSION['delschedule'])
{

?>
<div class="alert alert-dismissible alert-success custom-success-alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Hey!</strong> <?php echo $_SESSION['delschedule'] ?>
</div>
<?php
unset($_SESSION['delschedule']);
}
?>
<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Schedule Details </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deleteschedule.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-danger"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<!-- <form action="deleteschedule.php" method="POST"> -->
    <h4>Exam Schedule Details</h4><br>

    <a href="addschedule0.php" class="btn btn-info">Add schedule</a>
    <br><br>

    <div style="margin-left:3%;margin-right:3%">
        <table class="table table-hover table-bordered" style="border-color: gray; background-color: white;">
            <?php
            $que = "SELECT * FROM exam_schedule_details";
            $result = $con->query($que);
            if ($result->num_rows > 0) {
              $counter=0;
            ?>
                <tr>
                    <th> SI No.</th>
                    <th> EXAM DATE </th>
                    <th> START TIME</th>
                    <th> END TIME </th>
                    <th> SESSION </th>
                    <th> COMMON SUBJECT CODE</th>
                    <th> SUBJECT </th>
                    <th> SEMESTER </th>
                    <th> OPERATIONS</th>
                </tr>
                <?php
                foreach ($result as $row) {
                ?>
                    <tr>
                        <td hidden><?php echo $row["si_no"] ?></td>
                        <td><?php echo ++$counter ?></td>
                        <td><?php echo $row["date"] ?></td>
                        <td><?php $date1 = $row['stime']; echo date('h:i a ', strtotime($date1)); ?></td>
                        <td><?php $date = $row['etime']; echo date('h:i a ', strtotime($date)); ?></td>
                        <td><?php echo $row["session"] ?></td>
                        <td><?php echo $row["us_code"] ?></td>
                        <td><?php echo $row["sub"] ?></td>
                        <td><?php echo $row["sem"] ?></td>


                        <td>

                            
                                <a><button type="button" class="btn btn-danger deletebtn">Delete <i class="bi bi-trash"></i></button></a>
                                <!-- <div class="col-sm-12 col-md-4">
                                    <a href="../external_seat_allotment/updateschedule.php?si=<?php echo $row["si_no"] ?>&date=<?php echo $row["date"] ?>?&=<?php echo $row["stime"] ?>&et=<?php echo $row["etime"] ?>?ss=<?php echo $row["session"] ?>"><button type="button" class="btn btn-success">Update</button></a> -->
                        </td>
                    </tr>
    </div>
    </div>


    </div>
<?php
                }
            }
            else {
                echo "<h3><center>Records Not Found</center></h3>";
            }
?>
<!-- </form> -->
<!-- Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<script>
  $(document).ready(function() {

    $('.deletebtn').on('click', function() {

      $('#deletemodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_id').val(data[0]);

    });
  });
</script>
<?php
include "../template/footer-fac.php";
?>