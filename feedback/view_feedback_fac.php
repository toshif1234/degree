<?php
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);

$q='select sub_name from faculty_mapping where faculty_name="'.$_SESSION['username'].'"';
$q_r=$link->query($q);
$subjects=array();
foreach($q_r as $r)
{
    $subjects[]=$r['sub_name'];
}
// print_r($subjects);
?>
<form action="uview_feedback_fac.php" method="post">
    <div class="row m-5">
        <div class="col col-8 col-md-8 col-lg-8">
            <select  name="sub" id="" class='form-control' required>
                <option value="" selected disabled>Select Subject</option>
                <?php
                
                foreach($subjects as $s)
                {
                ?>
                <option value="<?php echo $s ?>"><?php echo $s ?></option>
                <?php } ?>
            
        </select>
        </div>
        <select name="feedback_name" id="" required>
    <option value="" selected disabled>Select Feedback</option>
                <option value="Course wise 1">Course wise 1</option>
                <option value="Course wise 2">Course wise 2</option>
                <option value="Course End">Course End</option>
                
    </select>
        <div class="col col-4 col-md-4 col-lg-4">
            <input type="submit" class="btn btn-primary" style="margin-left: 3em;" name="" id="" value='SUBMIT'> 
        </div>
    </div>









<?php
include "../template/footer-fac.php";
?>