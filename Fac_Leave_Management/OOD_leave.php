<?php
// require_once "../config.php";
include("../template/fac-auth.php");
$con=$link;

include("../template/sidebar-fac.php");
?>
<div>
    <h4 style="text-align:center">OOD Leave Details</h4><br>
</div>


<div style="margin-left:5%;margin-right:5%">
    <table class="table table-responsive table-borderless">
        <?php

            $s='select * from faculty_details where faculty_name="' . $_SESSION["username"] . '"';
            $res = $link->query($s);
            $res = mysqli_fetch_assoc($res);
            $name = $_SESSION["username"];
            $que = "select * from faculty_ood where faculty_name=\"" . $name . "\" order by applied_date ASC";
            $result = $con->query($que);
            if($result->num_rows > 0){
        ?>
                <tr>
                    <th>Applied On</th>
                    <th>Reason</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    
                </tr>

            <?php
                foreach ($result as $row) 
                {                      
            ?>
            
                    <tr>
                        <td><?php echo $row["applied_date"] ?></td>
                        <td><?php echo $row["reason"] ?></td>
                        <td><?php echo $row["from_date"] ?></td>
                        <td><?php echo $row["to_date"] ?></td>
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
    <a href="../Fac_Leave_Management/OOD_leaveapply.php"><button  type="button" class="btn btn-info">Apply New</button></a>
</div>
<?php
include("../template/footer-fac.php");
?>