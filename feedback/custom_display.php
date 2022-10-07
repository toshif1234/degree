<?php
include "../template/stud_auth.php";
include "../template/student_sidebar.php";

$q_r='select * from students where usn="'.$_SESSION['username'].'"';
// echo $q;
$r_r=mysqli_fetch_assoc($link->query($q_r));

$q='select * from feedback_all where id like "c%"';
// echo $q;
$r=$link->query($q);
$feeds=array();
foreach($r as $s)
{ 
    $feeds[]=$s['feedback_name'];
}
// print_r($feeds);
foreach($feeds as $f)
{ 
    $q_n='select * from feedback_notification where feedback_name="'.$f.'" and sem="'.$r_r['semester'].'" and branch="'.$r_r['branch'].'"';
    $r_n=$link->query($q_n);
    if(mysqli_num_rows($r_n)==0)
    {
        $k = array_search($f,$feeds);
            // echo $k;
        unset($feeds[$k]);
    }
}
foreach($feeds as $f)
{ 
$q_f='select * from feedback_response where usn="'.$_SESSION['username'].'" and feedback_name="'.$f.'"';
$r_f=$link->query($q_f);
    if(mysqli_num_rows($r_f)!=0)
    {
        $k = array_search($f,$feeds);
            // echo $k;
        unset($feeds[$k]);
    }
}
?>
<form action="display_next.php" method="post">
<div class="row m-5">
        <div class="col col-8 col-md-8 col-lg-8">
            <select  name="feed" id="" class='form-control' required>
                <option value="" selected disabled>Select Feedback</option>
                <?php
                
                foreach($feeds as $s)
                {
                ?>
                <option value="<?php echo $s ?>"><?php echo $s ?></option>
                <?php } ?>
            
        </select>
        </div>
        <div class="col col-4 col-md-4 col-lg-4">
            <input type="submit" class="btn btn-primary" style="margin-left: 3em;" name="" id="" value='SUBMIT'> 
        </div>
    </div>
</form>
<?php
// echo $q;

include "../template/student-footer.php";
?>