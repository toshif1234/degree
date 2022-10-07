<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$use = $_SESSION['username'];
$date1 = $_POST['date'];
$session = substr($date1, -2);
$date2 = substr($date1, 0, 10);

$q = "select * from faculty_details where faculty_name='$use'";
$res = $link->query($q);
$q1 = "select  distinct date,session,stime,etime,sem from exam_schedule_details where date='$date1' and session='$session'";
$res1 = $link->query($q1);

// $q2 = "select  from exam_schedule_details";
// $res2 = $link->query($q2);
// $q3 = "select distinct stime, etime from exam_schedule_details where session='MN'";
// $res3 = $link->query($q3);
// $q4 = "select distinct stime, etime from exam_schedule_details where session='AN'";
// $res4 = $link->query($q4);
// $q4="select distinct sem from exam_subject_details";
// $res4=$link->query($q4);
?>

<table>
    <tr>
        <td>
            <?php foreach ($res as $d) {
            ?>
                <div class="d-inline p-2 bg-primary text-white">
                    <label>Faculty ID :</label>
                    <?php $fi = $d['faculty_id'];
                    echo $fi;
                    $_SESSION['faculty_id'] = $fi;
                    ?>
                </div>
        </td>

        <td>
            <div class="d-inline p-2 bg-info text-white">
                <label>Faculty Name :</label>
            <?php echo $d['faculty_name'];
            } ?>
            </div>
        </td>


    </tr>
    <a href="blockfaculty3.php" class="btn btn-info view1">View Block Details</a>
    <br><br>
</table>


<br>
<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Sem</th>
                <th scope="col">Exam Date</th>
                <th scope="col">Exam Start Time</th>
                <th scope="col">Exam End Time</th>
                <th scope="col">Session</th>
                <th scope="col">Block</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($res1 as $r) {
            ?>
                <form action="blockfaculty2.php" method="POST" id="form1" onsubmit="return cal(this)">
                    <tr>



                        <td>
                            <div style="margin-bottom: 10x;" value="sem">
                                <input readonly type="text" name="sem" class="form-control" value="<?php echo $r['sem'] ?>">


                            </div>

                        </td>
                        <td>

                            <div style="margin-bottom: 20px;">
                                <input readonly type="text" name="date" class="form-control" required value="<?php echo $r['date'] ?>">
                            </div>

                        </td>
                        <td>

                            <div style="margin-bottom: 20px;">
                                <input readonly type="text" name="examstime" class="form-control" required value="<?php $st1=$r['stime'];   echo date('h:i a ', strtotime("$st1")); ?>">
                            </div>
                        </td>
                        <td>

                            <div style="margin-bottom: 20px;">
                                <input readonly type="text" name="exametime" class="form-control" required value="<?php $et1=$r['etime'];   echo date('h:i a', strtotime("$et1")); ?>">
                            </div>
                        </td>
                        <td>

                            <div style="margin-bottom: 20px;">
                                <input readonly type="text" name="session" class="form-control" required value="<?php echo "$r[session]"; ?>">
                            </div>

                        </td>
                        <td>

                            <div>
                                <input style="width: 40px;height: 40px;" type="checkbox" id="scales" name="scales" value="1" required>

                            </div>

                        </td>

                        </td>
                        <td>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Submit
</button>
                            <!-- <a href="../External_seat_allotment/blockfaculty2.php ?>"><button type="submit" id="send" class="btn btn-primary" onclick='save(); this.disabled = true;'>Submit</button></a> -->
                            </span>
</div>
</td>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you really want to submit it?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">CONFIRM</a></button>
      </div>
    </div>
  </div>
</div>
</form>
<?php
            }

?>


</tr>
</tbody>

</table>
</div>


<script>
    // function cal(form) {
    //     if (!document.form1.agree.checked) {
    //         alert("Please Block it");
    //         return false;
    //     }
    //     return true;
    // }

    // function submit() {
    //     var bu = document.getElementById('send');
    //     bu.style.display = "none";
    // }


    function checkb(check1) {

        if (check1.checked) {
            confirm("Do You Want to Block It ?");
            //     /var ch=document.getElementById("scales");
            //     //  var btn1=document.getElementById("btn1");
        } else {
            confirm("Do You Want to UnBlock It ?");

        }


    }




    // function btn1() {
    //         return confirm("Do You Want to Submit It ?");


    //   }
</script>




<?php
include "../template/footer-fac.php";
?>