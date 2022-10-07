<?php
include "../template/admin-auth.php";
include "../template/sidebar-admin.php";
error_reporting(0);

$q='select distinct branch from students';
$q_sem='select distinct sem from subjects_new';
$q_feed='select distinct feedback_name from feedback_response';
$r_q=$link->query($q);
$r_sem=$link->query($q_sem);
$r_feed=$link->query($q_feed);
?>
<form action="view_admin.php">
    <select name="branch" id="">
    <option value="" selected disabled>Select Branch</option>
                <?php
                
                foreach($r_q as $s)
                {
                ?>
                <option value="<?php echo $s['branch'] ?>"><?php echo $s['branch'] ?></option>
                <?php } ?>
    </select>

    <select name="semester" id="">
    <option value="" selected disabled>Select Semester</option>
                <?php
                
                foreach($r_sem as $r)
                {
                ?>
                <option value="<?php echo $r['sem'] ?>"><?php echo $r['sem'] ?></option>
                <?php } ?>
    </select>
    <select name="feedback_name" id="">
    <option value="" selected disabled>Select Feedback</option>
                <?php
                
                foreach($r_feed as $s1)
                {
                ?>
                <option value="<?php echo $s1['feedback_name'] ?>"><?php echo $s1['feedback_name'] ?></option>
                <?php } ?>
    </select>
    <input type="submit" value="Submit">
</form>






<?php

include "../template/footer-admin.php";
?>