<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);


$con = $link;
?>
 <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
 <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Room Data </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deleteroom.php" method="POST">

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
<!-- <form action="deleteroom.php" method="POST"> -->

<?php
  //for deleroom dismiss
if($_SESSION['delroom'])
{

?>
<div class="alert alert-dismissible alert-success custom-success-alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Hey!</strong> <?php echo $_SESSION['delroom'] ?>
</div>
<?php
unset($_SESSION['delroom']);
}
?>

<?php
  //for updateroom dismiss
if($_SESSION['updateroom'])
{

?>
<div class="alert alert-dismissible alert-success custom-success-alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Hey!</strong> <?php echo $_SESSION['updateroom'] ?>
</div>

<?php
unset($_SESSION['updateroom']);
}
?>
<h4>Exam Room Details</h4><br>

<a href="addroom1.php" class="btn btn-info">Add Room</a>
<br><br>

<div style="margin-left:3%;margin-right:3%">
  <table class="table table-hover table-bordered" style="border-color: gray; background-color: white;">
    <?php
    $que = "SELECT * FROM exam_rooms";
    $result = $con->query($que);
    if ($result->num_rows > 0) {
      $counter=0;
    ?>
      <tr>
        <th> SI No.</th>
        <th>Room Number</th>
        <th>DESK CAPACITY</th>
        <th>STUDENT COUNT</th>
        <th>BLOCK</th>
        <th>FLOOR</th>
        <th>OPERATION</th>
      </tr>
      <?php
      $i = 0;
      foreach ($result as $row) {
        $i++;
      ?>
        <tr>
          <td hidden><?php echo $row['si_no'] ?></td>
          <td><?php echo ++$counter ?></td>
          <td><?php echo $row["room_number"] ?></td>
          <td><?php echo $row["room_desk"] ?></td>
          <td><?php echo $row["std_count"] ?></td>
          <td><?php echo $row["block"] ?></td>
          <td><?php echo $row["floor"] ?></td>


          <td>
            <a href="updateroom.php?si=<?php echo $row['si_no'] ?>&rn=<?php echo $row["room_number"] ?>&rd=<?php echo $row["room_desk"] ?>&scount=<?php echo $row["std_count"] ?>&block=<?php echo $row["block"] ?>&floor=<?php echo $row["floor"] ?>" class="btn btn-success">EDIT <i class="bi bi-pencil-square"></i></a>
            <button type="button" class="btn btn-danger deletebtn"> DELETE <i class="bi bi-trash"></i></button>

          </td>
        </tr>
</div>
</div>


</div>
<?php
      }
    } else {
      echo "<h3><center>Records Not Found</center></h3>";
    }
?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
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