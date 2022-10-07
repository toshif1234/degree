<?php

require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);



$date =  $_SESSION['date'];
$session = substr($date, -2);
$date1 = substr($date, 0, 10);

$q = "select * from exam_block where date='$date1' AND session='$session' AND status='unblocked'";
$res = $link->query($q);
?>
<?php
if($_SESSION['emssub'])
{

?>
<div class="alert alert-dismissible alert-success custom-success-alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Hey!</strong> <?php echo $_SESSION['emssub'] ?>
</div>
<?php
unset($_SESSION['emssub']);
}
?>


<div>
    <a href="emsview.php" class="btn btn-info">View Assigned Duty</a>
    <br><br>

    <table class="table">

        <?php

        if ($res->num_rows > 0) {
            $counter=0;
        ?>
            <tr>
                <th>SI No.</th>
                <th>Date</th>
                <th>Faculty ID</th>
                <th>Faculty Name</th>
                <th>Sem</th>
                <th>Session</th>
                <th>Assign Duty</th>


            </tr>
            <form action="ems3.php" method="POST">
            <?php
            $i = 0;
            foreach ($res as $row) {
                $i++;
            ?>
                
                    <?php
                    
                    ?>
                    <input readonly type="text" name="si<?php echo $i ?>" class="form-control" value="<?php echo $row['si_id'] ?>" hidden>
                    <td><?php echo ++$counter ?></td>
                    <td><input readonly type="text" name="date1<?php echo $i ?>" class="form-control" required value="<?php echo $row['date'] ?>"></td>
                    <td>
                        <input readonly type="text" name="fi<?php echo $i ?>" class="form-control" required value="<?php echo $row['faculty_id'] ?>">
                    </td>
                    <td><input readonly type="text" name="fn<?php echo $i ?>" class="form-control" required value="<?php echo $row['faculty_name'] ?>"></td>
                    <td><input readonly type="text" name="sem<?php echo $i ?>" class="form-control" required value="<?php echo $row['sem'] ?>"></td>
                    <td><input readonly type="text" name="session1<?php echo $i ?>" class="form-control" required value="<?php echo $row['session'] ?>"></td>
                    <td>
                        <div class="col-24 mt-2 ">
                            <select name="duty<?php echo $i ?>" id="duty" class="form-select">
                                <option selected disabled>Select</option>
                                <option selected="selected" value="Room Duty">Room Duty</option>
                                <option value="Reserve">Reserve</option>
                                <option value="Relive">Relive</option>
                            </select>
                        </div>
                    </td>
                 </tr>
        <?php
            }
            
        
        ?>
        <input readonly type="text" name="ii" class="form-control" value="<?php echo $i ?>" hidden>


<input type="submit" class="btn btn-primary p-2" value="Submit" name="sub">
<br><br>
</form>
<?php
        }
        //}
        else{
         echo "<h4><center>No Records Found</center></h4>";
         }
        ?>
    </table>

</div>


<style>
    .view1 {
        margin-left: 85%;
    }
</style>

<?php
include "../template/footer-fac.php";
?>