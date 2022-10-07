<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");
if (isset($_SESSION["check_data"]) && $_SESSION["check_data"] == 1) {
    $_SESSION["check_data"] = 0;
    echo '<div style="width:50%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Start and End date for the selected semester has already been added</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

?>
<div class="container">
    <form action="update_sem_start_end.php" method="post">
        <div class="row">
            <div class="col col-12 col-md-4 col-lg-4">
                <label for="sem">Semester</label>
                <select name="sem" id="sem" class="form-control">
                    <option value="" selected disabled>Select Semester</option>
                    <?php
                $q = 'select distinct semester from students';
                $result = $link->query($q);
                for ($i = 1; $i <= 8; $i++) {
                ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col col-12 col-md-4 col-lg-4">
                <label for="start">SEM Start Date</label>
                <input type="date" name="start" id="start" class="form-control">
            </div>
            <div class="col col-12 col-md-4 col-lg-4">
                <label for="end">SEM End Date</label>
                <input type="date" name="end" id="end" class="form-control">
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <button type="submit" class="btn btn-primary" value="Add"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </form>
</div>
<?php

$q = 'select * from sem_start_end';
$result = $link->query($q);
if (mysqli_num_rows($result) > 0) {
?>
<div class="container mt-4">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Semester</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($result as $r) {
                ?>
            <form action="update_row_start_end.php" method="post">
                <tr>
                    <th scope="row"><input type="text" name="sem" id="" value="<?php echo $r['sem'] ?>" hidden>
                        <?php echo $r['sem'] ?></th>
                    <td><input class="form-control" type="date" name="start" id="" value="<?php echo $r['start'] ?>" required>
                    </td>
                    <td><input class="form-control" type="date" name="end" id="" value="<?php echo $r['end'] ?>" required></td>
                    <td>
                        <button class="btn btn-primary" type="submit" name=""><i class="fa fa-floppy-o"></i></button>
                </td>

    
            </form>
            <form action="delete_row_start_end.php" method="post">
                <input type="text" name="sem" id="" value="<?php echo $r['sem'] ?>" hidden>
                <td><button class="btn btn-danger" type="submit" name=""><i class="fas fa-trash"></i>
                </button>
                </td>
            </form>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php } ?>


<?php include("../template/footer-admin.php"); ?>