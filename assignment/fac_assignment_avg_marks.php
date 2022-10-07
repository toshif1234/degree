<?php include("../template/fac-auth.php");
include("../template/sidebar-fac.php");

error_reporting(0);

require_once '../config.php';



$q = "select * from assignment_marks where semester = " . $_SESSION['semester'] . " and section = \"" . $_SESSION['section'] . "\" and branch = \"" . $_SESSION['branch'] . "\" and sub_name = \"" . $_SESSION['sub_name'] . "\"  and fac_name = \"" . $_SESSION['username'] . "\"";
// echo $q;

$assign_count = "select * from add_assignment where semester = " . $_SESSION['semester'] . " and section = \"" . $_SESSION['section'] . "\" and branch = \"" . $_SESSION['branch'] . "\" and sub_name = \"" . $_SESSION['sub_name'] . "\"  and fac_name = \"" . $_SESSION['username'] . "\"";


$assinment_avg_in_marks = "select * from marks where  sem = \"" . $_SESSION['semester'] . "\" and sec = \"" . $_SESSION['section'] . "\" and branch = \"" . $_SESSION['branch'] . "\" and sub = \"" . $_SESSION['sub_name'] . "\"";
$av = $link->query($assinment_avg_in_marks);
// echo $assinment_avg_in_marks;
$students_in_marks = array();
foreach ($av as $a) {
  $students_in_marks[] = $a['usn'];
}



$count = 0;
$ac = $link->query($assign_count);
$assignment_numbers = array();
foreach ($ac as $a) {
  $assignment_numbers[] = $a['assignment_no'];
  $count++;
}
// echo $assign_count;
// print_r($assignment_numbers);
// if (in_array("2", $assignment_numbers))
// {
//   echo "found";
// }


$result = $link->query($q);

?>
<style>
  thead tr:nth-child(1) th {
    background: silver;
    position: sticky;
    top: 0;
    z-index: 10;
    text-align: center;
  }

  .custom-table {
    overflow: scroll;
    height: 70vh;
    margin-top: 10px;
    padding: 0;
  }

  .sticky-col {
    position: -webkit-sticky;
    position: sticky;
    background-color: white;
  }
</style>
<div>
  <h4>Subject: <?php echo $_SESSION['sub_name']; ?></h4>



  <!-- <h4>Debug : No of Assignments given: <?php echo $count; ?></h4> -->
  <?php
  if ($count != 0) {
  ?>
    <form action="../assignment_download/excel.php" method="POST">
      <input type="text" name="semester" id="semester" value="<?php echo $_SESSION['semester']; ?>" hidden>
      <input type="text" name="section" id="section" value="<?php echo $_SESSION['section']; ?>" hidden>
      <input type="text" name="branch" id="branch" value="<?php echo $_SESSION['branch']; ?>" hidden>
      <input type="text" name="sub_name" id="sub_name" value="<?php echo $_SESSION['sub_name']; ?>" hidden>
      <div align="right">
        <input type="submit" name="export" id="SubmitButton" value="Download" class="btn btn-success" />
      </div>

    </form>

    <div class="table-responsive-sm custom-table">
      <table class="table table-hover">
        <thead>
          <tr>

            <th scope="col">slno</th>
            <th scope="col">usn</th>
            <th scope="col">name</th>
            <?php
            if (in_array("1", $assignment_numbers)) {
            ?>
              <th scope="col">Assignment 1</th> <?php } ?>
            <?php
            if (in_array("2", $assignment_numbers)) {
            ?>
              <th scope="col">Assignment 2</th> <?php } ?>
            <?php
            if (in_array("3", $assignment_numbers)) {
            ?>
              <th scope="col">Assignment 3</th> <?php } ?>
            <?php
            if (in_array("4", $assignment_numbers)) {
            ?>
              <th scope="col">Assignment 4</th> <?php } ?>
            <?php
            if (in_array("5", $assignment_numbers)) {
            ?>
              <th scope="col">Assignment 5</th> <?php } ?>
            <th scope="col">Average</th>

          </tr>
        </thead>
        <tbody>

          <?php
          $cnt = 0;
          foreach ($result as $row) {
            $cnt++;
          ?>



            <tr class="">
              <th scope="row"><?php echo $cnt ?></th>

              <td>
                <input type="text" class="form-control tab2-1a" value="<?php echo $row['usn'] ?>" name="usn" disabled>
              </td>



              <td>
                <input type="text" class="form-control tab2-1a" value="<?php echo $row['stud_name'] ?>" name="stud_name" disabled>
              </td>

              <?php
              if (in_array("1", $assignment_numbers)) {
              ?>
                <td>
                  <input type="number" min="0" max="10" class="form-control tab2-1a" value="<?php echo $row['a1'] ?>" name="" disabled>
                </td>
              <?php } ?>
              <?php
              if (in_array("2", $assignment_numbers)) {
              ?>
                <td>
                  <input type="number" min="0" max="10" class="form-control tab2-1a" value="<?php echo $row['a2'] ?>" name="" disabled>
                </td>
              <?php } ?>
              <?php
              if (in_array("3", $assignment_numbers)) {
              ?>
                <td>
                  <input type="number" min="0" max="10" class="form-control tab2-1a" value="<?php echo $row['a3'] ?>" name="" disabled>
                </td>
              <?php } ?>
              <?php
              if (in_array("4", $assignment_numbers)) {
              ?>
                <td>
                  <input type="number" min="0" max="10" class="form-control tab2-1a" value="<?php echo $row['a4'] ?>" name="" disabled>
                </td>
              <?php } ?>
              <?php
              if (in_array("5", $assignment_numbers)) {
              ?>
                <td>
                  <input type="number" min="0" max="10" class="form-control tab2-1a" value="<?php echo $row['a5'] ?>" name="" disabled>
                </td>
              <?php } ?>

              <?php
              $avg = ($row['a1'] + $row['a2'] + $row['a3'] + $row['a4'] + $row['a5']) / $count;
              $avg_in_marks = ceil($avg);
              if (in_array($row['usn'], $students_in_marks)) {
                $upd_in_marks = "UPDATE `marks` SET `assignment_avg`= " . $avg_in_marks . " WHERE  usn =\"" . $row['usn'] . "\"  and sem = \"" . $_SESSION['semester'] . "\" and sec = \"" . $_SESSION['section'] . "\" and branch = \"" . $_SESSION['branch'] . "\" and sub = \"" . $_SESSION['sub_name'] . "\"";
                $link->query($upd_in_marks);
              }
              ?>
              <td>
                <input type="number" min="0" max="10" class="form-control tab2-1a" value="<?php echo ceil($avg) ?>" name="" disabled>
              </td>


            </tr>

          <?php
          }
          ?>
        </tbody>
      </table>
    </div>

  <?php

  } else {
    echo "<h2>No assignment is assigned</h2>";
  }

  ?>
</div>

<?php
$section = $_SESSION['section'];
$sub = $_SESSION['sub_name'];
?>
<a hidden href="<?php echo "../assignment_download/Assignment_Average_" . "$section" . "-sec_" . "$sub" . ".xlsx" ?>" download id="assignment"></a>
<?php
$assignment = $_SESSION['assignment'] ?? 0;
if ($assignment == 1) { ?>
  <script>
    document.getElementById('assignment').click();
    <?php $_SESSION['assignment'] = 0; ?>
  </script>
<?php
}
?>
<?php include("../template/footer-fac.php") ?>