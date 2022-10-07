<?php
require_once "../config.php";
$con=$link;

include("../template/student_sidebar.php");
?>
<div>
    <h4 style="text-align:center">Placement Details</h4><br>
</div>
<div style="margin-left:5%;margin-right:5%">
    <table class="table table-responsive table-borderless">
    <?php

        $s='select * from students where usn="' . $_SESSION["username"] . '"';
        // echo $s;
        $res = $link->query($s);
        $res = mysqli_fetch_assoc($res);
        $usn = $_SESSION["username"];
        $que = "select * from student_placement_leave where usn=\"" . $usn . "\" and sem=\"" . $res["semester"] . "\" order by applied_date ASC";
        // echo $que;
        $result = $con->query($que);
        if($result->num_rows > 0){
        ?>
            <tr>
                <th>Applied On</th>
                <th>Company Name</th>
                <th>Date</th>
                <th>Time From</th>
                <th>Time To</th>
                <th>Rounds Cleared </th>
                <th>Status</th>
                <th>Document</th>
            </tr>
            <?php
            foreach ($result as $row) 
            {                      
            ?>
            <tr>
                <td><?php echo $row["applied_date"] ?></td>
                <td><?php echo $row["company_name"] ?></td>
                <td><?php echo $row["place_date"] ?></td>
                <td><?php echo $row["from_time"] ?></td>
                <td><?php echo $row["to_time"] ?></td>
                <td><?php echo $row["rounds"] ?></td>
                <td>
                            <?php 
                                if($row["status"]==1)
                                {
                                    echo "Accepted";
                                }
                                else if($row["status"]==2)
                                {
                                    echo "Rejected"; 
                                }
                                else
                                {
                                    echo "Pending";
                                }
                            ?>
                        </td>
                <td><a href="<?php echo $row["doc_name"]; ?>" target="_blank" style="color:blue">View</a>
            </tr>
            <?php
                }
            }
            else{
                echo '<h5><center> No Leave Applied </center></h5>';
            }
            ?> 
    </table>
</div>
<div class="text-center" style="margin-top:30px">
<a href="../student_leave_management/placementapply.php"><button  type="button" class="btn btn-info">Apply New</button></a>
</div>
<?php
include("../template/student-footer.php");
?>
