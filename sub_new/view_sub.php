<?php
require_once "../config.php";
include("../template/admin-auth.php");
error_reporting(0);

include("../template/sidebar-admin.php");

?>
<div class="container">

    <?php
    $con = $link;
    $branch = $_POST["branch"] ?? $_SESSION['branch'];
    $_SESSION['branch'] = $branch;

    $q = "select * from subjects_new where branch=\"" . $branch . "\"";
    // echo $q;




    $row = $con->query($q);

    ?>
    <table class="table table-hover table-light table-bordered">
        <thead class="table-primary">
            <tr>
                <th scope="col" style="text-align:center;">Subject Name</th>
                <th scope="col" style="text-align:center;">Subject Code</th>
                <th scope="col" style="text-align:center;">Subject Type</th>
                <th scope="col" style="text-align:center;"></th>

            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($row as $r) {
            ?>

                <tr>
                    <td style="text-align:center;"><?php echo $r["sub_name"] ?></td>
                    <td style="text-align:center;"><?php echo $r["sub_code"] ?></td>
                    <td style="text-align:center;"><?php
                        if($r['sub_id'] == '0'){
                            echo '---';
                        }
                        elseif($r['sub_id'] == '1')
                        {
                            echo 'Open Elective';
                        } elseif ($r['sub_id'] == '2') {
                            echo 'Professional Elective';
                        } elseif ($r['sub_id'] == '3') {
                            echo 'Lab';
                        } elseif ($r['sub_id'] == '4') {
                            echo 'Internship';
                        } elseif ($r['sub_id'] == '5') {
                            echo 'Seminar';
                        } else{
                            echo 'Project';
                        }
                    ?></td>
                    <td>
                    <form action="delete_sub.php" method="post">
                        <input type="text" name="sub_code" id="" value="<?php echo $r["sub_code"] ?>" hidden>
                        <input type="text" name="branch" id="" value="<?php echo $branch ?>" hidden>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form> 

                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <?php


    ?>
</div>
</div>

<!-- page content end -->

<?php include "../template/footer-admin.php" ?>