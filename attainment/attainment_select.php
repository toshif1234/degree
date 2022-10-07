<?php
// error_reporting(0);

include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$q2 = "select distinct semester from students";
$result1 = $link->query($q2);
$q3 = 'select * from targets';
$result3 = $link->query($q3);
$teach = $_SESSION['username'];
$q_branch = 'select faculty_dept from faculty_details where faculty_name="' . $teach . '";';
$result2 = $link->query($q_branch);
$dept = mysqli_fetch_assoc($result2)['faculty_dept'];
// echo $dept;
?>

<form action="sheet_access.php" method="POST">
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="sub">Semester</label>
      <select name="sem" class="form-control">
        <option selected disabled>Select Semester </option>
        <?php

        foreach ($result1 as $r) {
          echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";
        }  ?>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label for="acadamic_year">Acadamic year</label>
      <input type="text" name="acadamic_year" class="form-control" id="acadamic_year" required>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="sub">Subject</label>
      <select class="form-control" name="sub" id="sub" aria-label="Default select example">
        <option value="" selected disabled>Select Subject</option>
        <?php

        $fac_branch = mysqli_fetch_assoc($link->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];
        $faculty_name = $_SESSION['username'];
        if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
          $qt = "select * from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name and a.branch = '" . $fac_branch . "'";
        } else {
          $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
        }
        $resultst = $link->query($qt);
        $subjects_arr = array();
        if ($fac_branch == 'MATHEMATICS') {
          foreach ($results2 as $r2) {
            $subjects_arr[] = $r2["sub_code"] . " - " . $r2["sub_name"];
          }
        } else {
          if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
            foreach ($resultst as $r) {
              if ($r['lab'] != '1') {
                $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
              } else {
                if ($r['branch'] == $fac_branch) {
                  $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                }
              }
            }
          } else {
            foreach ($resultst as $r) {
              if ($r['sub_id'] != '3') {
                if ($r['sub_id'] == '1') {
                  $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                } else {
                  if ($r['branch'] == $fac_branch) {
                    $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                  }
                }
              }
            }
          }
        }
        print_r($subjects_arr);
        foreach ($subjects_arr as $r) {
        ?>
          <option class="form-control" value="<?php echo $r ?>"><?php echo $r ?></option>
        <?php  } ?>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label for="sub">Scheme</label>
      <select name="batch" class="form-control">
        <option selected disabled>Select Scheme </option>
        <?php

        foreach ($result3 as $r) {
          echo "<option value=\"" . $r["batch"] . "\"> " . $r["batch"] . "</option>";
        }  ?>
      </select>
    </div>

  </div>

  <button class="btn btn-primary" type="submit">Submit</button>
</form>

<a hidden href="attainment_<?php echo $dept ?>.xlsx" download id="down"></a>
<?php
$down = $_SESSION['down'] ?? 0;
if ($down == 1) { ?>
  <script>
    document.getElementById('down').click();
    <?php $_SESSION['down'] = 0; ?>
  </script>
<?php
}
?>

<?php
include("../template/footer-fac.php")

?>