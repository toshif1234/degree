<?php
include "../template/stud_auth.php";
include "../template/student_sidebar.php";

error_reporting(0);
// session_start();
$q='select * from students where usn="'.$_SESSION['username'].'"';
        
        $r1=mysqli_fetch_assoc($link->query($q));
        $sem=$r1['semester'];
        $q_sub='select * from subjects_new where sem="'.$sem.'" and branch="' . $r1['branch'] . '"';
        $result_sub=$link->query($q_sub);
        $q_esubjects='select * from elective_maping where usn="'.$_SESSION['username'].'"';
        $r_esubjects=$link->query($q_esubjects);
        // echo $q_esubjects;
        $subjects = array();
        $subjects_given = array();
        foreach($result_sub as $r)
        {
            if($r['sub_id']==0 || $r['sub_id']==3 || $r['sub_id']==6 || $r['sub_id']==4 || $r['sub_id']==5)
            {
                $subjects[]=$r['sub_code'] . ' - ' . $r['sub_name'];
            }
        }
        foreach($r_esubjects as $r4)
        {
            $subjects[]=$r4['sub_name'];
        }


        $q_subjects='select sub from feedback_response where usn="'.$_SESSION['username'].'" and feedback_name="Course End"';
        $r_subjects=$link->query($q_subjects);
        // echo $r_subjects;
        foreach($r_subjects as $r2)
        {
            $k = array_search($r2['sub'],$subjects);
            // echo $k;
            unset($subjects[$k]);
        }
        if(empty($subjects)){
            echo '<script>window.location.replace("redirect.php");</script>';
        }
?>

<form action="update_course_end.php" method="post">
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
        <div class="col col-4 col-md-4 col-lg-4">
            <input type="submit" class="btn btn-primary" style="margin-left: 3em;" name="" id="" value='SUBMIT'> 
        </div>
    </div>
    
    <input type="text" name="branch" id="" value="<?php echo $r1['branch'] ?>" hidden>
    <input type="text" name="semester" id="" value="<?php echo $r1['semester'] ?>" hidden>
    <input type="text" name="name" id="" value="<?php echo $r1['fname'] ?>" hidden>
    <input type="text" name="section" id="" value="<?php echo $r1['section'] ?>" hidden>
    <input type="text" name="batch" id="" value="<?php echo $r1['batch'] ?>" hidden>
    <input type="text" name="usn" id="" value="<?php echo $_SESSION['username'] ?>" hidden>
</form>

<?php
// echo $q;
include "../template/student-footer.php";
?>
