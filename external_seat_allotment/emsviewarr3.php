<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$sem = $_SESSION['sem'];
$ps = $_SESSION['us_code'];
?>

<form action="" method="POST">
    <h4>Arrear Student Details</h4><br>

    <div>
        <table class="table table-hover table-bordered" style="border-color: gray; background-color: white;">
            <?php
            $que = "SELECT * FROM exam_arrear_details where sem='$sem' and us_code='$ps'";
            $result = $link->query($que);
            if ($result->num_rows > 0) {
                $counter=0;
            ?>
                <tr>
                    <th>SI No.</th>
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
<script>
    function del() {
        return confirm("Are you Realy want to delte it ?");
    }
</script>

<?php
include "../template/footer-fac.php";
?>