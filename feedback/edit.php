<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

$_SESSION['id']=$_POST['id'];
$q='select * from feedback_notification where id="'.$_POST['id'].'"';
// echo $q;
$r=mysqli_fetch_assoc($link->query($q));
// print_r($r);
?>
<form action="edit_next.php" class="row gy-2 gx-3 align-items-center" method="post">
<div class="row m-4 x-2">
<table class="table table-striped">
    <thead class="thead-dark" >
        <tr>
        <th  style='width: 10em;' scope="col">Feedback name</th>
        <th style="width: 10em;" scope="col">Semesters</th>
        <th style="width: 10em;" scope="col">From date</th>
        <th style="width: 10em;" scope="col">To date</th>
        <th style="width: 10em;" scope="col"></th>

        </tr>
    <tr>    
    <td><?php echo $r['feedback_name'] ?></td>
    <td><?php echo  $r['sem'] ?></td>
    <td><?php echo $r['from_date'] ?></td>
    <td>
    <input type="date"class="col-auto" id="to_date" name="to_date" required>
    </td>
    <td>
    <input type="submit" class="btn btn-primary" value='UPDATE'> 
    </td>

</tr>
</table>
<!-- <div class="col col-4 col-md-4 col-lg-4"> -->
        <!-- </div> -->
</form>


<?php
include "../template/footer-fac.php";

?>