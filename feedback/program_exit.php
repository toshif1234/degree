<?php
include "../template/stud_auth.php";
include "../template/student_sidebar.php";


$q = 'select * from feedback_response where usn="' . $_SESSION['username'] . '" and feedback_name="Program Exit"';
$q_r = $link->query($q);
// echo $q;
if (mysqli_num_rows($q_r) != 0) {
    echo 'You have already submitted this feedback';
}
else
{ 
$q='select * from students where usn="'.$_SESSION['username'].'"';
$r1=mysqli_fetch_assoc($link->query($q));
$_SESSION['name']=$r1['fname'];
$_SESSION['branch']=$r1['branch'];
$_SESSION['semester']=$r1['semester'];
$_SESSION['section']=$r1['section'];


$q_po='select * from feedback_all where feedback_name="Program Exit"';
$r_po=mysqli_fetch_assoc($link->query($q_po));
$q_pso='select * from dept_pso where dept_name="'.$r1['branch'].'"';
// echo $q_pso;
$r_pso=mysqli_fetch_assoc($link->query($q_pso));


?>
<form action="update_prg_exit.php" method="post" >
<div class="font-weight-bolder" style='width: 2em;height: 3em;'><h4>Program Exit</h4></div>
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
<!-- <tbody> -->
    <?php
    for($i=1;$i<=30;$i++){  
        if($r_po['q'.$i])
        { ?>
        <tr>
            <td><?php echo $i ?></td>
            <td style><h5><?php echo $r_po['q'.$i] ?></h5></td>
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

    for($c=1;$c<=6;$c++){  
        if($r_pso['pso'.$c])
        { ?>
        <tr>
            <td><?php echo ($i+$c)-1 ?></td>
            <td style><h5><?php echo $r_pso['pso'.$c] ?></h5></td>
            <td><input type="radio" name="c_rating<?php echo ($i+$c)-1 ?>" id="" value="1" required></td>
            <td><input type="radio" name="c_rating<?php echo ($i+$c)-1 ?>" id="" value="2" required></td>
            <td><input type="radio" name="c_rating<?php echo ($i+$c)-1 ?>" id="" value="3" required></td>
            <td><input type="radio" name="c_rating<?php echo ($i+$c)-1 ?>" id="" value="4" required></td>
            <td><input type="radio" name="c_rating<?php echo ($i+$c)-1 ?>" id="" value="5" required></td>
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
<div class="font-weight-bolder" style='width: 2em;h eight: 3em;'><h3>Comment</h3></div>
    <div><textarea class="form-control" name="comment" id="com" cols="150" rows="4"></textarea></div>


<!-- <input type="text" name="count_general" id="" value="<?php echo $c-1 ?>" hidden> -->
<input type="text" name="count_co" id="" value="<?php echo ($c+$i)-1 ?>" hidden>
<input type="submit" class="btn btn-primary mt-3" value="Submit">
</form>  

<?php
//header("Location: course_end_suject.php");
}
include "../template/student-footer.php";
?>
