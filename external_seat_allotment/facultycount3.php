<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);

?>
<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Delete Faculty Count Details </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="deletecount.php" method="POST">

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
<!-- <form action="updatefacultycount.php" method="POST"> -->
<?php
//for delecount dismiss
if ($_SESSION['delcount']) {

?>
  <div class="alert alert-dismissible alert-success custom-success-alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Hey!</strong> <?php echo $_SESSION['delcount'] ?>
</div>
<?php
  unset($_SESSION['delcount']);
}
?>

<?php
//for updatecount dismiss
if ($_SESSION['updatecount']) {

?>
 <div class="alert alert-dismissible alert-success custom-success-alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Hey!</strong> <?php echo $_SESSION['updatecount'] ?>
</div>
<?php
  unset($_SESSION['updatecount']);
}
?>


<h4>Faculty Count Details</h4><br>

<a href="facultycount1.php" class="btn btn-info">Add Faculty Count</a>
<br><br>
<div style="margin-left:20%;margin-right:20%">
  <table class="table table-hover table-bordered" style="border-color: gray; background-color: white;">
    <?php
    $que = "SELECT * FROM exam_faculty_count";
    $result = $link->query($que);
    if ($result->num_rows > 0) {
      $counter=0;
    ?>
      <tr>
        <th>SI No.</th>
        <th>Date</th>
        <th>Session</th>
        <th>Faculty Count</th>
        <th>Operations</th>


      </tr>
      <?php
      foreach ($result as $row) {
        //$countersi=1;              
      ?>
        <tr>
          <td hidden><?php echo $row["si_no"] ?></td>
          <td><?php echo ++$counter ?></td>
          <td><?php echo $row["date"] ?></td>
          <td><?php echo $row["session"] ?></td>
          <td><?php echo $row["count"] ?></td>

          <td> <a href="updatefacultycount.php?si=<?php echo $row["si_no"] ?>&ses=<?php echo $row["date"] ?>&count=<?php echo $row["count"] ?>" class="btn btn-success">Edit <i class="bi bi-pencil-square"></i> </a>
            <a><button type="button" class="btn btn-danger deletebtn"> Delete <span> <i class="bi bi-trash"></i></span></button></a>

          </td>
</div>
</div>

</tr>
</div>
<?php

      }
    } else {
      echo "<br><center><h3>No Record Found<h3><center>";
    }
?>
</form>

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