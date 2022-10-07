<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);
$sem = $_SESSION['sem'];
$ps = $_SESSION['ps_code'];
$use = $_SESSION['username'];
?>

<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Arrear Details </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deleteaddarrview.php" method="POST">

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
<?php
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

<form action="" method="POST">
    <h4>Arrear Student Details</h4><br>

    <div>
        <table class="table table-hover table-bordered" style="border-color: gray; background-color: white;">
            <?php
            $que = "SELECT * FROM exam_arrear_details where sem='$sem' and ps_code='$ps' and  faculty_name='$use'";
            $result = $link->query($que);
            if ($result->num_rows > 0) {
                $counter=0;
            ?>
                <tr>
                    <th> SI No.</th>
                    <th>Semester</th>
                    <th>USN</th>
                    <th>Subject Common Code</th>
                    <th>Subject Code</th>
                </tr>
                <?php
                foreach ($result as $row) {
                ?>
                    <tr>
                        <td hidden><?php echo $row['si_no'] ?></td>
                        <td><?php echo ++$counter ?></td>
                        <td><?php echo $row["sem"] ?></td>
                        <td><?php echo $row["usn"] ?></td>
                        <td><?php echo $row["us_code"] ?></td>
                        <td><?php echo $row["ps_code"] ?></td>
                        <td>

                            <!-- <a href="updatesub.php?ps=<?php echo $row["ps_code"] ?>&se=<?php echo $row["sem"] ?>&br=<?php echo $row["branch"] ?>&su=<?php echo $row["sub"] ?>&us=<?php echo $row["us_code"] ?>"><button type="button" class="btn btn-success">Update</button></a>
                         -->

                            <!-- <a href="deleteaddarrview.php?si=<?php echo $row['si_no'] ?>"><button type="button" class="btn btn-danger" onclick="return del()">Delete</button></a> -->
                            <button type="button" class="btn btn-danger deletebtn"> DELETE <i class="bi bi-trash"></i></button>

                        </td>
    </div>
    </div>

    </tr>
    </div>
<?php
                }
            } else {
                echo "<h3><center>Records Not Found</center></h3>";
            }
?>
</form>
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