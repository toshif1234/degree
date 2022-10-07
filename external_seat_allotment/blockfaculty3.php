<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$use = $_SESSION['username'];
$q = "select * from faculty_details where faculty_name='$use'";
$res = $link->query($q);

$con = $link;
?>

<form action="" method="POST">
    <h4 style="text-align:center">Block Details</h4><br>

    <table>
    <tr>
        <td>
            <?php foreach ($res as $d) {
            ?>
                <div class="d-inline p-2 bg-primary text-white">
                    <label>Faculty ID :</label>
                    <?php echo $d['faculty_id'];
                    ?>
                </div>
        </td>

        <td>
            <div class="d-inline p-2 bg-info text-white">
                <label>Faculty Name :</label>
            <?php echo $d['faculty_name'];
            } ?>
            </div>
        </td>


    </tr>
    <a href="blockfaculty0.php" class="btn btn-info view1">Block Faculty</a>
    <br><br>
</table>

    <div>
        <table class="table">
            <?php
            $que = "SELECT * FROM exam_block where faculty_name='$use' and checkbox='1'";
            $result = $con->query($que);
            if ($result->num_rows > 0) {
            ?>
                <tr>
                    <th>Date</th>
                    <th>Exam Start Time</th>
                    <th>Exam End Time </th>
                    <th>Sem</th>
                    <th>Session</th>
                    
                </tr>
                <?php
                foreach ($result as $row) {
                ?>
                    <tr>
                        <td><?php echo $row["date"] ?></td>
                        <td> <?php $stime = $row['stime']; echo date('h:i a ', strtotime($stime));?></td>
                        <td> <?php $etime = $row['etime']; echo date('h:i a ', strtotime($etime));?></td>
                        <td><?php echo $row["sem"] ?></td>
                        <td><?php echo $row["session"] ?></td>
                        

                        
    </div>
    </div>

    </tr>
    </div>
<?php
                }
            }
            else
            {
                echo "<h3><center><br> No Records Found </center></h3>";
            }
     ?>      
</form>


<?php
include "../template/footer-fac.php";
?>