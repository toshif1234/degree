<?php

include "../template/stud_auth.php";
include "../template/student_sidebar.php";
$usn = $_SESSION['username'];
$q = 'select * from attendance_new where usn = "' . $usn . '"';
// echo $q;
$result = $link->query($q);
$q_year = 'select distinct att from attendance_new';
$result_year = $link->query($q_year);
$arr_dates = array();
$month = array(
    '01' => 'JANUARY',
    '02' => 'FEBRUARY',
    '03' => 'MARCH',
    '04' => 'APRIL',
    '05' => 'MAY',
    '06' => 'JUNE',
    '07' => 'JULY',
    '08' => 'AUGUST',
    '09' => 'SEPTEMBER',
    '10' => 'OCTOBER',
    '11' => 'NOVEMBER',
    '12' => 'DECEMBER'
);
// echo $month['01'];
foreach ($result_year as $r2) {
    $p = explode(';', $r2['att']);
    
    foreach ($p as $p2) {
        // print_r($p2);
        // echo '<br>';
        $q = explode(':', $p2);
        $q = explode('-', $q[0]);
        if(!isset($q[1])){
            continue;
        }
        $ele = $q[0] . '-' . $q[1];
        if (in_array($ele, $arr_dates)) {
            continue;
        }
        $arr_dates[] = $q[0] . '-' . $q[1];
    }
}
?>
<form action="view_att_stud.php" method="post">
<div class="container">
  <div class="row">
    <div class="col-4">
      <div class="form-group">
        <label for="exampleFormControlSelect1">Subject</label>
        <select class="form-control" id="exampleFormControlSelect1">
          <option selected disabled>Select Subject</option>
          <?php foreach ($result as $r) {  ?>
            <option value="<?php echo $r['sub']; ?>"><?php echo $r['sub']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="col-4">
      <div class="form-group">
        <label for="month"> Month </label>
        <select name="month" class="form-control" id="Period">
          <option selected disabled>Select Month</option>
          <?php
          sort($arr_dates);
          foreach ($arr_dates as $arr) {
            $q = explode('-', $arr);
            // if($q==""){
            //     continue;
            // }
          ?>
            <option value="<?php echo $arr ?>"><?php echo $q[0] . ' - ' . $month[$q[1]]; ?></option>
          <?php }  ?>
        </select>
      </div>
    </div>
    <div class="col-4 mt-4">
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
</form>


<?php
include "../template/student-footer.php";
