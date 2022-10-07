<?php
include "../template/stud_auth.php";
include "../template/student_sidebar.php";
error_reporting(0);

$_SESSION['branch'] = $_POST['branch'];
$_SESSION['batch'] = $_POST['batch'];
$_SESSION['semester'] = $_POST['semester'];
$_SESSION['section'] = $_POST['section'];
$_SESSION['usn'] = $_POST['usn'];
$_SESSION['name'] = $_POST['name'];
// echo $_SESSION['batch'];
$_SESSION['sub'] = $_POST['sub'];

$gen='select * from feedback_all where feedback_name="' . $_POST['feedback_name'] . '"';
$r_gen=mysqli_fetch_assoc($link->query($gen));
//session_start();
?>
<form action="update_cw.php" method="post" >
<div class="font-weight-bolder"><h4>Time Sense</h4></div>
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
    for($c=1;$c<=4;$c++){ ?>
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
} ?>
</tbody>
</table>
</div>






<div class="font-weight-bolder" ><h4>Subject Command</h4></div>
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
    for($c1=1;$c1<=6;$c1++){ ?>
    <tr>
        <td><?php echo $c1 ?></td>
        <td><h5><?php echo $r_gen['q'.($c+$c1-1)] ?></h5></td>
        <td><input class='form-group' type="radio" name="g_rating<?php echo $c+$c1-1 ?>" id="" value="1" required></td>
        <td><input type="radio" name="g_rating<?php echo $c+$c1-1?>" id="" value="2" required></td>
        <td><input type="radio" name="g_rating<?php echo $c+$c1-1?>" id="" value="3" required></td>
        <td><input type="radio" name="g_rating<?php echo $c+$c1-1?>" id="" value="4" required></td>
        <td><input type="radio" name="g_rating<?php echo $c+$c1-1?>" id="" value="5" required></td>
    </tr>
    <?php
    
} $t=$c+$c1-2;?>
</tbody>
</table>
</div>









<div class="font-weight-bolder" ><h4>Use of teaching aid</h4></div>
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
    for($c2=1;$c2<=6;$c2++){ ?>
    <tr>
        <td><?php echo $c2 ?></td>
        <td><h5><?php echo $r_gen['q'.($c2+$t)] ?></h5></td>
        <td><input class='form-group' type="radio" name="g_rating<?php echo $c2+$t ?>" id="" value="1" required></td>
        <td><input type="radio" name="g_rating<?php echo $c2+$t ?>" id="" value="2" required></td>
        <td><input type="radio" name="g_rating<?php echo $c2+$t ?>" id="" value="3" required></td>
        <td><input type="radio" name="g_rating<?php echo $c2+$t ?>" id="" value="4" required></td>
        <td><input type="radio" name="g_rating<?php echo $c2+$t ?>" id="" value="5" required></td>
    </tr>
    <?php
    
} $t=$c2-1+$t;?>
</tbody>
</table>
</div>








<div class="font-weight-bolder" ><h4>Helping Attitude</h4></div>
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
    for($c3=1;$c3<=6;$c3++){ ?>
    <tr>
        <td><?php echo $c3 ?></td>
        <td><h5><?php echo $r_gen['q'.($c3+$t)] ?></h5></td>
        <td><input class='form-group' type="radio" name="g_rating<?php echo $c3+$t ?>" id="" value="1" required></td>
        <td><input type="radio" name="g_rating<?php echo $c3+$t ?>" id="" value="2" required></td>
        <td><input type="radio" name="g_rating<?php echo $c3+$t ?>" id="" value="3" required></td>
        <td><input type="radio" name="g_rating<?php echo $c3+$t ?>" id="" value="4" required></td>
        <td><input type="radio" name="g_rating<?php echo $c3+$t ?>" id="" value="5" required></td>
    </tr>
    <?php
    
} $t=$c3-1+$t;?>
</tbody>
</table>
</div>







<div class="font-weight-bolder" ><h4>Class Control</h4></div>
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
    for($c4=1;$c4<=5;$c4++){ ?>
    <tr>
        <td><?php echo $c4 ?></td>
        <td><h5><?php echo $r_gen['q'.($c4+$t)] ?></h5></td>
        <td><input class='form-group' type="radio" name="g_rating<?php echo $c4+$t ?>" id="" value="1" required></td>
        <td><input type="radio" name="g_rating<?php echo $c4+$t ?>" id="" value="2" required></td>
        <td><input type="radio" name="g_rating<?php echo $c4+$t ?>" id="" value="3" required></td>
        <td><input type="radio" name="g_rating<?php echo $c4+$t ?>" id="" value="4" required></td>
        <td><input type="radio" name="g_rating<?php echo $c4+$t ?>" id="" value="5" required></td>
    </tr>
    <?php
} ?>
</tbody>
</table>
</div>











<div class="font-weight-bolder" style='width: 2em;height: 3em;'><h4>Comment</h4></div>
    <div><textarea class="form-control" name="comment" id="com" cols="150" rows="4"></textarea></div>

<input type="text" name="feedback_name" id="" value="<?php echo $_POST['feedback_name'] ?>" hidden>
<input type="text" name="count_general" id="" value="<?php echo $t+$c4-1?>" hidden>
<input type="submit" class="btn btn-primary mt-3" value="Submit">
</form>  
<?php
//header("Location: course_end_suject.php");
include "../template/student-footer.php";
?>