<?php require_once "config.php";
//  echo $q1;
//session_start();
include("../template/admin-auth.php");
error_reporting(0);

include("../template/sidebar-admin.php");
$val = $_SESSION['view_flag'];
// echo $val;
if ($val == 0) {
    $_SESSION['sem'] = $_POST['sem'];
    $_SESSION['sec'] = $_POST['sec'];
    $_SESSION['dept'] = $_POST['dept'];
}
if (isset($_SESSION["success"]) && $_SESSION["success"] == 0) {
    $_SESSION["success"] = 2;
    echo '<div style="width:50%;height:50px;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed. Already mapped to the specified subject.</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
} else if (isset($_SESSION["success"]) && $_SESSION["success"] == 1) {
    $_SESSION["success"] = 2;
    echo '<div style="width:50%; height:50px;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sucessfully mapped.</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <br>';
}
$q = 'select * from students where semester = "' . $_SESSION['sem'] . '" and section = "' . $_SESSION['sec'] . '" and branch = "' . $_SESSION['dept'] . '" order by usn';
//  echo $q;
$result = $con->query($q);
$q1 ='select * from subjects_new where sub_id=1 or sub_id = 2 and branch = "' . $_POST['dept'] . '"';
$result2 = $con->query($q1);
?>
<!-- <?php
        //require_once "../config.php";

        ?> -->
<div class="container">
    <div class="row">
        <form action="update.php" method="post">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <select class="form-control" id="exampleFormControlSelect1" name="elective">
                            <option selected disabled>select</option>
                            <?php foreach ($result2 as $r2) { ?>
                                <option value="<?php echo $r2['sub_code'] . " - " . $r2['sub_name'] ?>">
                                    <?php echo $r2['sub_code'] . " - " . $r2['sub_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button class="btn btn-primary btn-sm" type="submit">SUBMIT</button>
                </div>

            </div>

            <table class="table table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col" style="width: 30px;">
                            <input type="checkbox" name="" id="check-all" onchange="checkall(this.value)">
                        </th>
                        <th scope="col" style="width: 250px;">USN</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $r) { ?>
                        <tr>
                            <td><input type="checkbox" name="name[]" class="checkbox" value="<?php echo $r["usn"] ?>"></td>
                            <td><?php echo $r["usn"] ?></td>
                            <!-- <th scope="row"><input type="checkbox" style="width: 30px;"></th> -->
                            <!-- <td style="width: 30px;"></td> -->
                            <td><?php echo $r['fname'] ?></td>
                            <td><?php echo $r['lname'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>

</div>

</div>
</div>


<!-- page content end -->
<div>

</div>
</div>
<script>
    x = 1

    function checkall(e) {
        if (x) {
            w = document.getElementsByClassName("checkbox")
            for (var i = 0; i < w.length; i++) {
                w[i].checked = true;
            }
        } else {
            w = document.getElementsByClassName("checkbox")
            for (var i = 0; i < w.length; i++) {
                w[i].checked = false;
            }
        }
        x = !x ? 1 : 0;
        console.log(x)
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>

</html>