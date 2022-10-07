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

$q = 'select * from co where sub="'.$_POST['sub'].'"';
$r_q=mysqli_fetch_assoc($link->query($q));
$gen='select * from feedback_all where feedback_name="Course End"';
$r_gen=mysqli_fetch_assoc($link->query($gen));
//session_start();
?>
<form action="update_ce.php" method="post" >
<div class="font-weight-bolder" style='width: 2em;height: 3em;'><h3>General</h3></div>
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
    for($c=1;$c<=3;$c++){ ?>
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
<div class="font-weight-bolder" style='width: 2em;height: 3em;'><h3>CO's</h3></div>
<div class="table-responsive">
<table class="table table-striped">
<thead class="thead-dark" >
    <tr>
        <th style='width: 5em;'>SL.No</th>
        <th style='width: 40em;'>Questions</th>
        <th style="text-align:center;">1</th>
        <th style="text-align:center;">2</th>
        <th style="text-align:center;">3</th>
        <th style="text-align:center;">4</th>
        <th style="text-align:center;">5</th>
    </tr>
</thead>
<tbody>
    <?php
    for($i=1;$i<=6;$i++){  
        if($r_q['co'.$i])
        { ?>
        <tr>
            <td><?php echo $i ?></td>
            <td style><h5><?php echo $r_q['co'.$i] ?></h5></td>
            <td><input type="radio" name="c_rating<?php echo $i ?>" id="" value="1" required></td>
            <td><input type="radio" name="c_rating<?php echo $i ?>" id="" value="2" required></td>
            <td><input type="radio" name="c_rating<?php echo $i ?>" id="" value="3" required></td>
            <td><input type="radio" name="c_rating<?php echo $i ?>" id="" value="4" required></td>
            <td><input type="radio" name="c_rating<?php echo $i ?>" id="" value="5" required></td>
        </tr>
    <?php
     }
     else
     {
         break;
     }
    }

    ?>
    </tbody>
</table>
</div>
<div class="font-weight-bolder" style='width: 2em;height: 3em;'><h3>Comment</h3></div>
    <div><textarea class="form-control" name="comment" id="com" cols="150" rows="4"></textarea></div>


<input type="text" name="count_general" id="" value="<?php echo $c-1 ?>" hidden>
<input type="text" name="count_co" id="" value="<?php echo $i-1 ?>" hidden>
<input type="submit" class="btn btn-primary mt-3" value="Submit">
</form>  
<?php
//header("Location: course_end_suject.php");
include "../template/student-footer.php";
?>