<?php
include "../template/stud_auth.php";
include "../template/student_sidebar.php";

$_SESSION['feed'] = $_POST['feed'];
$gen='select * from feedback_all where feedback_name="'.$_POST['feed'].'"';
$r_gen=mysqli_fetch_assoc($link->query($gen));
?>
<form action="update_custom.php" method="post">
<div class="font-weight-bolder" style='width: 2em;height: 3em;'><h3><?php echo $_POST['feed'] ?></h3></div>
<div class="table-responsive">
<table class="table table-striped">
    <thead class="thead-dark" >
    <tr>
        <th style='width: 5em;' scope="col">SL.No</th>
        <th  style='width: 40em;' scope="col">Questions</th>
        <th style="text-align:center;" scope="col">1</th>
        <th style="text-align:center;" scope="col">2</th>
        <th style="text-align:center;" scope="col">3</th>
        <th style="text-align:center;" scope="col">4</th>
        <th style="text-align:center;" scope="col">5</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($c=1;$c<=30;$c++){ 
        if($r_gen['q'.$c]!=0)
        { ?>
    <tr>
        <td><?php echo $c ?></td>
        <td><h5><?php echo $r_gen['q'.$c] ?></h5></td>
        <td><input class='form-group' type="radio" name="g_rating<?php echo $c ?>" id="" value="1" required></td>
        <td><input type="radio" name="g_rating<?php echo $c ?>" id="" value="2" required></td>
        <td><input type="radio" name="g_rating<?php echo $c ?>" id="" value="3" required></td>
        <td><input type="radio" name="g_rating<?php echo $c ?>" id="" value="4" required></td>
        <td><input type="radio" name="g_rating<?php echo $c ?>" id="" value="5" required></td>
    </tr>
    <?php
        }
        else
        {
            break;
        }
} ?>
</tbody>
</table>
</div>
<div class="font-weight-bolder" style='width: 2em;height: 3em;'><h3>Comment</h3></div>
    <div><textarea class="form-control" name="comment" id="com" cols="150" rows="4"></textarea></div>


<input type="text" name="count" id="" value="<?php echo $c-1 ?>" hidden>
<input type="submit" class="btn btn-primary mt-3" value="Submit">
</form>