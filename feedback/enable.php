<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

$q_dept='select faculty_dept from faculty_details where faculty_name="'.$_SESSION['username'].'"';
$r_dept=mysqli_fetch_assoc($link->query($q_dept));

$q_sem='select distinct semester from students';
$q_feed='select distinct feedback_name from feedback_response';
$r_sem=$link->query($q_sem);
$r_feed=$link->query($q_feed);
$flag=$_SESSION['flag']??0;

$q='select * from feedback_all';
$r=$link->query($q);

if($flag==1)
{
    echo '<span style="color:red;"> Semesters '.$_SESSION['repsem'].' is already notified of '.$_SESSION['feedback_name'].'  </span>';
    $_SESSION['flag']=0;
}
?>

<form action="enable_next.php" class="row gy-2 gx-3 align-items-center" method="post">
<div class="row m-3 x-2">
  <!-- <div class="row row-cols-5 row-cols-lg-5 g-2 g-lg-3"> -->
    <div class="col-auto">
    <select name="feedback_name" id="" required>
                 <option value="" selected disabled>Select Feedback</option>
                <?php
                
                foreach($r as $s)
                {
                ?>
                <option value="<?php echo $s['feedback_name'] ?>"><?php echo $s['feedback_name'] ?></option>
                <?php } ?>         
    </select>
</div>
<div class="col-auto">
    <select name="semester[]" id="" class="col-auto" required >
    <option value="" selected disabled >Select Semester</option>
                <?php
                
                foreach($r_sem as $r)
                {
                ?>
                <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
                <?php } ?>
    </select>
</div>
<div class="col-auto">
    <label for="from_date" class="visually-hidden">From Date</label>
    <input type="date" class="col-auto" id="from_date" name="from_date" required>
</div>
<div class="col-auto"> 
    <label for="to_date" class="visually-hidden">To date</label>
    <input type="date"class="col-auto" id="to_date" name="to_date" required>
</div>
    <div class="col-auto">
    <input type="submit"  class="btn btn-primary mb-3" style="margin-left: 3em;" name="" id="" value='NOTIFY'> 
    </div>
    <!-- </div> -->
</div>
</form>

<?php 
$q_all='select * from feedback_notification';
$r_q_all=$link->query($q_all);
?>
<div class="row m-4 x-2">
<table class="table table-striped">
    <thead class="thead-dark" >
    <tr>
        <th style='width: 5em;' scope="col">SL.No</th>
        <th  style='width: 10em;' scope="col">Feedback name</th>
        <th style="width: 10em;" scope="col">Semesters</th>
        <th style="width: 10em;" scope="col">From date</th>
        <th style="width: 10em;" scope="col">To date</th>
        <th style="width: 10em;" scope="col"></th>
        <th style="width: 10em;" scope="col"></th>
    </tr>
    </thead>
    <?php 
$var=date("Y-m-d");
?>
    <tbody>
        <?php $i=1;
        foreach($r_q_all as $d){  
        $q_dis='select * from feedback_notification where feedback_name="'.$d['feedback_name'].'" and sem="'.$d['sem'].'" and branch="'.$r_dept['faculty_dept'].'"and from_date<="'.$var.'" and to_date>="'.$var.'"';
        // echo $q_dis;
        $r_dis=$link->query($q_dis);
        // print_r($r_dis);
$n=mysqli_num_rows($r_dis);
if($n==0)
{
    $q_del='delete from feedback_notification where id="'.$d['id'].'"';
    $r_del=$link->query($q_del);
}
else{



        ?>
        <form action="disable.php" method="post">
        <tr id="<?php echo $i ?> ">
            <td><?php echo $i ?></td>
            <td><?php echo $d['feedback_name'] ?></td>
            <td><?php echo  $d['sem'] ?></td>
            <td><?php echo $d['from_date'] ?></td>
            <td><?php echo $d['to_date'] ?></td>
            <!-- <td><input type="text" value="<?php echo $d['to_date'] ?>"></td> -->
            <!-- <td><u><input type="submit" value="Update"  /></td> -->
            <td><u><input type="submit" class="btn btn-primary" value="disable"  /></td>
        
        <input type="text" name="id" id="" value="<?php echo $d['id'] ?>" hidden>
        </form>
        <form action="edit.php" method="post">
            <td>
                <input type="submit" class="btn btn-primary" value="edit"/>
            </td>
        <input type="text" name="id" id="" value="<?php echo $d['id'] ?>" hidden>

        </form>
        </tr>
        <?php $i=$i+1; } } ?>



    </tbody>
        </table>
        </div>

        <!-- <script>
            function del() {
                var rowId = event.target.parentNode.parentNode.id;
              //this gives id of tr whose button was clicked
                var data = document.getElementById(rowId).querySelectorAll(".row-data"); 
              /*returns array of all elements with 
              "row-data" class within the row with given id*/
  
                var feedback_name = data[0].innerHTML;
                var sem[] = data[1].innerHTML;
                var from = data[2].innerHTML;
                var to = data[3].innerHTML;
                alert("Name: " + feedback_name);
                <?php $q='update feedback_notification set notification="no" where feedback_name="<script>document.writeln(feedback_name);</script>" and sem="<script>document.writeln(sem);</script>"and from_date="<script>document.writeln(from);</script>"';?>
            }
        </script> -->






<?php
include "../template/footer-fac.php";

?>