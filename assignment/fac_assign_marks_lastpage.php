<?php include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
error_reporting(0);


// $stud_detail = "select * from assignment_marks" . $_SESSION['assignment_no'] . " where sem = \"" . $_SESSION['semester'] . "\" and sec = \"" . $_SESSION['section'] . "\"";

$stud_detail = "select * from students where semester = \"" . $_SESSION['semester'] . "\" and section = \"" . $_SESSION['section'] . "\" and branch = \"" . $_SESSION['branch'] . "\" order by usn";

// echo $stud_detail;
// echo $stud_detail;
//below is for getting max marks
$fac_assign = "select * from add_assignment where sub_name = \"" . $_SESSION['sub_name'] . "\" and fac_name = \"" . $_SESSION['username'] . "\"";
// echo $fac_assign;
//for getting the assignment marks of particular student.
$assignment_marks = "select * from assignment_marks where semester = \"" . $_SESSION['semester'] . "\" and section = \"" . $_SESSION['section'] . "\" and branch = \"" . $_SESSION['branch'] . "\" and sub_name = \"" . $_SESSION['sub_name'] . "\" and fac_name = \"" . $_SESSION['username'] . "\" order by usn";
// echo $assignment_marks;
$assignment_number = "a" . $_SESSION['assignment_no'];

$amr = $link->query($assignment_marks);
$amr1 = $link->query($assignment_marks);

$usn = array();
foreach ($amr as $a) {
  $usn[] = $a['usn'];
}


$result = $link->query($stud_detail);
//for obtaining max marks.
$max = $link->query($fac_assign);
foreach ($max as $ro) {
  $m = $ro['max_marks'];
}




?>
<script>
  function SubmitClick() {
    document.getElementById("SubmitButton").click();
  }
</script>


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
  <div class="container m-2 p-2">
    <div class="row">
      <div class="col">
        <h4>Max Marks: 10</h4>
      </div>
      <div class="col"></div>
      <div class="col">
        <Button class="btn btn-success" style="float: right;" onclick="SubmitClick()">
          Submit
        </Button>
      </div>
    </div>
  </div>

  <div class="table-responsive-sm custom-table">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Slno</th>
          <th scope="col">Usn</th>
          <th scope="col">Name</th>
          <th scope="col">Marks scored</th>
          <!-- <th scope="col">Max Marks</th> -->
          <!-- <th scope="col">Options</th> -->
        </tr>
      </thead>
      <tbody>
        <form action="fac_assignment_marks_insert.php" method="post">
          <?php
          $cnt = 0;
          foreach ($result as $row) {
            $am = $amr1->fetch_assoc();
            $cnt++;
          ?>



            <tr class="">
              <th scope="row"><?php echo $cnt ?></th>
              <td>
                <input type="text" class="form-control tab2-1a" value="<?php echo $row['usn'] ?>" name="usn<?php echo $cnt ?>" readonly>
              </td>
              <td>
                <input type="text" class="form-control tab2-1a" value="<?php echo $row['fname'] ?>" name="stud_name<?php echo $cnt ?>" readonly>
              </td>
              <?php
              if (in_array($row['usn'], $usn)) {

              ?>
                <td>
                  <input type="number" min="0" max="10" class="form-control tab2-1a" value="<?php echo $am[$assignment_number]; ?>" name="marks_obt<?php echo $cnt ?>">
                </td>
              <?php
              } else {

              ?>
                <td>
                  <input type="number" min="0" max="10" class="form-control tab2-1a" value="0" name="marks_obt<?php echo $cnt ?>">
                </td>
              <?php
              }
              ?>
            </tr>
          <?php } ?>
          <input type="text" name="count" value="<?php echo $cnt ?>" hidden>
          <button class="btn btn-md btn-success" id="SubmitButton" hidden style="float: right;" type="submit"> Submit </button>
        </form>

      </tbody>
    </table>
  </div>
</div>

<?php include("../template/footer-fac.php") ?>