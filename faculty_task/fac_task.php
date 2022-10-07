<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
error_reporting(0);


$fac_id = "select faculty_id from faculty_details where faculty_name = \"" . $_SESSION["username"] . "\"";
$result = $link->query($fac_id);
$f_id = $result->fetch_assoc()['faculty_id'];

$fac_dept = "SELECT faculty_dept FROM `faculty_details` WHERE faculty_id=\"" . $f_id . "\"";
$result = $link->query($fac_dept);
$hod_dept = $result->fetch_assoc()['faculty_dept'];

$fac = "select * from faculty_details where faculty_dept = \"" . $hod_dept . "\" order by faculty_name";
$fac_list = $link->query($fac);

//list of faculty who have given assignments.
$fac_names = "select fac_name from add_assignment";
$f_names = $link->query($fac_names);
$f_list = array();
$sc = array();
foreach ($f_names as $fac) {
  $f_list[] = $fac['fac_name'];
}


?>
<style>
  .form-check {
    max-width: 30px;
    display: flex;
  }

  .form-check-input:checked {
    background-color: #4cc705;
    border: #20c957;
  }

  .form-check-input {
    background-color: #db3927;
    border: #db3967;
  }

  thead tr:nth-child(1) th {
    background: silver;
    position: sticky;
    top: 0;
    z-index: 10;
    text-align: center;
  }

  .custom-table {
    overflow: scroll;
    height: 75vh;
    margin-top: 10px;
    padding: 0;
  }

  .sticky-col {
    position: -webkit-sticky;
    position: sticky;
    background-color: white;
  }

  .labels {
    text-align: center;

  }
</style>

<div class="table-responsive-sm custom-table">
  <table class="table table-hover">
    <thead>

      <tr>
        <th scope="col">Faculty ID</th>
        <th scope="col">Faculty Name</th>
        <th scope="col">CO</th>
        <th scope="col">CO-PO</th>
        <th scope="col">Lesson Plan</th>
        <th scope="col">Attendence</th>
        <th scope="col">IA Marks</th>
        <th scope="col">Assignment</th>
      </tr>

    </thead>
    <tbody>
      <?php
      foreach ($fac_list as $r) {
      ?>
        <tr>
          <td>
            <h5 class="labels"><?php echo $r['faculty_id']; ?></h5>
          </td>
          <td>
            <h5 class="labels"><?php echo $r['faculty_name']; ?></h5>
          </td>
          <td>
            <?php

            $co = $link->query("select * from co where faculty_id =\"" . $r['faculty_id'] . "\" ");
            if (mysqli_num_rows($co) > 0) {

              $c = $co->fetch_assoc();
              //if any one of the co is set, then the task is done.
              if ($c['co1'] != "" || $c['co2'] != "" || $c['co3'] != "" || $c['co4'] != "" || $c['co5'] != "" || $c['co6'] != "") { ?>
                <input class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" checked disabled>
              <?php
              } else { ?>
                <input class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" disabled>
              <?php   }
            } else {   ?>
              <input class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" disabled>

            <?php
            }

            ?>
          </td>
          <!-- for co_po -->
          <!-- If any of the field contains 0, or all fields are N/A then the task is incomplete. -->
          <td>
            <?php
            $co_po = $link->query("select * from co_po where faculty_id =\"" . $r['faculty_id'] . "\" ");
            if (mysqli_num_rows($co_po) > 0) {
              $flag = 0;
              foreach ($co_po as $cp) {
                if (($cp['po1'] == "0" || $cp['po2'] == "0" || $cp['po3'] == "0" || $cp['po4'] == "0" || $cp['po5'] == "0" || $cp['po6'] == "0" || $cp['po7'] == "0" || $cp['po8'] == "0" || $cp['po9'] == "0" || $cp['po10'] == "0" || $cp['po11'] == "0" || $cp['po12'] == "0") ||  ($cp['po1'] == "N/A" &&  $cp['po2'] == "N/A" && $cp['po3'] == "N/A" && $cp['po4'] == "N/A" && $cp['po5'] == "N/A" && $cp['po6'] == "N/A" && $cp['po7'] == "N/A" && $cp['po8'] == "N/A" && $cp['po9'] == "N/A" && $cp['po10'] == "N/A" && $cp['po11'] == "N/A" && $cp['po12'] == "N/A")) {
                  $flag = 1;
                  break;
                }
              }
              if ($flag == 1) {
            ?>
                <input class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" disabled>
              <?php  } else { ?>
                <input class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" checked disabled>
              <?php }
            } else {   ?>
              <input class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" disabled>
            <?php
            }

            ?>
          </td>
          <!-- for Lesson Plan -->
          <!-- if the date of execution(dop_exe) is empty or NULL then the task is not completed -->
          <td>
            <?php
            // Getting list of subjects mapped to particular faculty
            $fac_subjects = "select sub_name from faculty_mapping where faculty_name = \"" . $r['faculty_name'] . "\"";
            $f_s = $link->query($fac_subjects);
            $faculty_subjects = array();
            foreach ($f_s as $fs) {
              $faculty_subjects[] = $fs['sub_name'];
            }
            //subject with subject code
            $sc = [];
            foreach ($faculty_subjects as $fs) {
              $sub_code = "select * from subjects_new where sub_name = \"" . $fs . "\"";
              $s_c = $link->query($sub_code);
              foreach ($s_c as $s) {
                $sc[] = $s['sub_code'] . " - " . $fs;
              }
            }
            if (!empty($sc)) {

              foreach ($sc as $s) {

                $lp = "select * from lessonpanl where subid = \"" . $s . "\" ";
                $res_lp = $link->query($lp);
                if (mysqli_num_rows($res_lp) != 0) {
                  $flag_lessonplan = 0;

                  foreach ($res_lp as $l_p) {
                    if ($l_p['dop_exe'] == "") {
                      $flag_lessonplan = 1;
                      break;
                    }
                  }
                  if ($flag_lessonplan == 1) { ?>
                    <div style="background-color:#ff6666; width:100%">
                      <input type="text" value="<?php echo $s;  ?>" disabled>

                    </div>
                  <?php } else {
                  ?>
                    <div style="background-color:#a0eb6e; width:100%">
                      <input type="text" value="<?php echo $s;  ?>" disabled>

                    </div>
                  <?php

                  }
                } else {
                  ?>
                  <div style="background-color:#ff6666; width:100%">
                    <input type="text" value="<?php echo $s;  ?>" disabled>

                  </div>
              <?php
                }
              }
            } else { ?>
              <h5 class="labels">----------</h5>
            <?php
            }
            ?>
          </td>
          <!-- for Attendence -->
          <td>
            <h5 class="labels">----------</h5>
          </td>
          <!-- for IA Marks -->
          <td>
            <?php
            // Getting list of subjects mapped to particular faculty
            $fac_subjects = "select sub_name from faculty_mapping where faculty_name = \"" . $r['faculty_name'] . "\"";
            // $f_s = $link->query($fac_subjects);
            $faculty_subjects = []; $faculty_subjects = array(); $faculty_subjects = (array) null;
            foreach ($f_s as $fs) {
              $faculty_subjects[] = $fs['sub_name'];
            }
            //subject with subject code
            $sc = [];
            foreach ($faculty_subjects as $fs) {
              $sub_code = "select * from subjects_new where sub_name = \"" . $fs . "\"";
              $s_c = $link->query($sub_code);
              foreach ($s_c as $s) {
                $sc[] = $s['sub_code'] . " - " . $fs;
              }
            }

            if (!empty($sc)) {

              foreach ($sc as $s) {

                $flag_ia1 = 0;
                $flag_ia2 = 0;
                $flag_ia3 = 0;

                $ia1 = "select * from ia_marks1 where sub =\"" . $s . "\"";
                $ia_1 = $link->query($ia1);

                $ia2 = "select * from ia_marks2 where sub =\"" . $s . "\"";
                $ia_2 = $link->query($ia2);

                $ia3 = "select * from ia_marks3 where sub =\"" . $s . "\"";
                $ia_3 = $link->query($ia3);

                if (mysqli_num_rows($ia_1) != 0 && mysqli_num_rows($ia_2) != 0 && mysqli_num_rows($ia_3) != 0) {
                  foreach ($ia_1 as $i1) {
                    if ($i1['total1'] == 0 &&  $i1['1a'] == NULL && $i1['1b'] == NULL && $i1['1c'] == NULL && $i1['2a'] == NULL && $i1['2b'] == NULL && $i1['2c'] == NULL && $i1['3a'] == NULL && $i1['3b'] == NULL && $i1['3c'] == NULL && $i1['4a'] == NULL && $i1['4b'] == NULL && $i1['4c'] == NULL) {
                      $flag_ia1 = 1;
                      break;
                    }
                  }
                  foreach ($ia_2 as $i2) {
                    if ($i2['total2'] == 0 &&  $i2['1a'] == NULL && $i2['1b'] == NULL && $i2['1c'] == NULL && $i2['2a'] == NULL && $i2['2b'] == NULL && $i2['2c'] == NULL && $i2['3a'] == NULL && $i2['3b'] == NULL && $i2['3c'] == NULL && $i2['4a'] == NULL && $i2['4b'] == NULL && $i2['4c'] == NULL) {
                      $flag_ia2 = 1;
                      break;
                    }
                  }
                  foreach ($ia_3 as $i3) {
                    if ($i3['total3'] == 0 &&  $i3['1a'] == NULL && $i3['1b'] == NULL && $i3['1c'] == NULL && $i3['2a'] == NULL && $i3['2b'] == NULL && $i3['2c'] == NULL && $i3['3a'] == NULL && $i3['3b'] == NULL && $i3['3c'] == NULL && $i3['4a'] == NULL && $i3['4b'] == NULL && $i3['4c'] == NULL) {
                      $flag_ia3 = 1;
                      break;
                    }
                  }

                  if ($flag_ia1 == 1) { ?>
                    <div style="background-color: white;overflow: hidden; border:2px solid white;">
                      <input style="background-color:white; border:none" type="text" value="<?php echo $s;  ?>" disabled>
                      <label for=""> &nbsp; IA1 :&nbsp; </label> <input style="display:inline;height:20%;width:500px" class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" disabled>
                    <?php
                  } else {
                    ?>
                      <div style="background-color: white;overflow: hidden; border:2px solid white;">
                        <input style="background-color:white; border:none" type="text" value="<?php echo $s;  ?>" disabled>
                        <label for=""> &nbsp; IA1 :&nbsp; </label> <input style="display:inline;height:20%;width:500px" class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" checked disabled>
                      <?php
                    }

                    if ($flag_ia2 == 1) { ?>
                        <div style="background-color: white;overflow: hidden; border:2px solid white;display:inline">
                          <label for=""> &nbsp; IA2 :&nbsp; </label> <input style="display:inline;height:20%;width:500px" class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" disabled>
                        <?php
                      } else {
                        ?>
                          <div style="background-color: white;overflow: hidden; border:2px solid white;display:inline ">
                            <label for=""> &nbsp; IA2 :&nbsp; </label> <input style="display:inline;height:20%;width:500px" class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" checked disabled>
                          <?php
                        }
                        if ($flag_ia3 == 1) { ?>
                            <div style="background-color: white;overflow: hidden; border:2px solid white;display:inline">
                              <label for=""> &nbsp; IA3 :&nbsp; </label> <input style="display:inline;height:20%;width:500px" class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" disabled>
                            <?php
                          } else {
                            ?>
                              <div style="background-color: white;overflow: hidden; border:2px solid white;display:inline">
                                <label for=""> &nbsp; IA3 :&nbsp; </label> <input style="display:inline;height:20%;width:500px" class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" checked disabled>
                            <?php
                          }
                        } ?>

                              </div>
                            <?php

                          }
                        } else {
                            ?>
                            <input style="background-color:#bab2b1;color:white;text-align:center; " type="text" value="SUBJECT IS NOT MAPPED" disabled>
                          <?php
                        }

                          ?>

          </td>
          <!-- for Assignment -->
          <td>
            <?php
            if (in_array($r['faculty_name'], $f_list)) { ?>
              <input class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" checked disabled>
            <?php } else { ?>
              <input class="form-check-input form-success" type="checkbox" id="flexSwitchCheckDefault" disabled>
            <?php } ?>
          </td>


        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>














<?php
include("../template/footer-fac.php")

?>