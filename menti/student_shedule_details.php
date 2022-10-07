<?php require_once "config.php";
//  echo $q1;
//session_start();
include("../template/fac-auth.php");

include("../template/sidebar-fac.php");

//$dept = $_POST["dept"];
//$sec = $_POST["sec"];
//$sem = $_POST["sem"];
//$q1 = 'select * from students where semester="' . $sem . '" and section ="' . $sec . '" and branch="' . $dept . '"';
// echo $q1;




$val = $_SESSION['username'];
// echo $val;
if ($val == 0) {
    $_SESSION['branch'] = $_POST['branch'];
    $_SESSION['batch'] = $_POST['batch'];
}
if (isset($_SESSION["success"]) && $_SESSION["success"] == 0) {
    $_SESSION["success"] = 2;
} else if (isset($_SESSION["success"]) && $_SESSION["success"] == 1) {
    $_SESSION["success"] = 2;
    echo '<div style="width:50%; height:50px;" class="alert alert-warning alert-dismissible fade show" role="alert">
    
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <br>';
}





//$q = 'select * from students where semester = "' . $_SESSION['sem'] . '" and section = "' . $_SESSION['sec'] . '" and  order by usn';
//  echo $q;
$q = "select * from students s,mentor_mapping m where s.usn=m.usn  and batch=\"" . $_POST["batch"] . "\" and branch=\"" . $_POST["branch"] . "\" and m.fac_name=\"" . $_SESSION["username"] . "\"";



$result = $con->query($q);

//$qq = 'select * from faculty_details where faculty_dept ="' . $_SESSION['dept'] . '"';
//$result1 = $con->query($qq);

?>
<!-- <?php
        //require_once "../config.php";

        ?> -->

<div class="container">


    <form action="arrange.php" method="post">
        <div class="row">
            <div class="col-md-3">
                <B><label for="Date">Date :</label></b>
                <input class="form-control" type="date" name="Date" id="Date" required> &nbsp;&nbsp;
            </div>
            <div class="col-md-3">
                <B><label for="time">Time :</label></b>
                <input class="form-control" type="time" name="time" id="time" required> &nbsp;&nbsp;

            </div>
            <div class="col-md-3">
                <B><label for="agenda">Aggenda :</label></B>
                <input class="form-control" type="text" name="agenda" id="agenda" size="50" required>&nbsp;&nbsp;

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
        </br>
        </br>
        <button class="btn btn-primary" type="submit" size="30">Send</button>

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