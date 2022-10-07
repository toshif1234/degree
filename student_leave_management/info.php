<?php
    require_once "../config.php";
    $con=$link;
    include("../template/student_sidebar.php");
    $sub=$_GET["sub"];
?>
<div>
<h4 style="text-align:center"><?php echo $sub ?></h4><br><br>
</div>

<div style="margin-left:5%;margin-right:5%"><h5>
    <table class="table table-responsive table-borderless" style="text-align:left;">
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>Total No.of Classes Taken : </td>
            <td></td>
            <td>Attendence percentage : </td>
        </tr>
        <tr>
            <td>Total No.of Classes Present : </td>
            <td></td>
            <td>No.of Leaves Remaining :</td>
        </tr>
    </table></h5>
    <div style="text-align:center; margin-top:80px">
        <h5>Leave Taken On</h5>
    </div>
</div>
<?php
include("../template/student-footer.php");
?>
