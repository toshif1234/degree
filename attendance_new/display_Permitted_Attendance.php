<?php 
require_once "../config.php";
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$branch = $_POST["branch"];
    $sem = $_POST["semester"];
    $Date = $_POST["ldate"];        

    $ql = 'select * FROM student_medical_leave as s WHERE status = 1 and (select branch from students where usn = s.usn) ="' 
    . $branch . '" and sem ="' . $sem . '" and "' . $Date .'" between from_date and to_date';
    $resm = $link -> query($ql);

    $qe = 'select * FROM student_event_leave as s WHERE status = 1 and (select branch from students where usn = s.usn) ="' 
    . $branch . '" and sem ="' . $sem . '" and event_date="' . $Date .'"';
    $rese = $link -> query($qe);

    $qp = 'select * FROM student_placement_leave as s WHERE status = 1 and (select branch from students where usn = s.usn) ="' 
    . $branch . '" and sem ="' . $sem . '" and place_date="' . $Date .'"';
    $resp = $link -> query($qp);
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Gabriela&display=swap" rel="stylesheet">
<div class="container">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Medical Leave</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Event Leave</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Placement Leave</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <table class="table table-responsive table-striped mt-3">
                    <?php
                        if(mysqli_num_rows($resm)!= 0){
                    ?>
                            <tr>
                                <th>USN</th>
                                <th>Name</th>
                                <th>Reason</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Document</th>
                            </tr>

                        <?php
                            foreach ($resm as $row) 
                            {                     
                                $st = 'select * from students where usn = "' . $row["usn"] . '"';
                                $s = $link->query($st);
                                $s2 = mysqli_fetch_assoc($s);     
                        ?>
                                <tr>
                                    <td><?php echo $row["usn"] ?></td>
                                    <td><?php echo $s2["fname"] ?></td>
                                    <td><?php echo $row["reason"] ?></td>
                                    <td><?php echo $row["from_date"] ?></td>
                                    <td><?php echo $row["to_date"] ?></td>
                                    <td><a href="<?php echo $row["doc_name"]; ?>" target="_blank" style="color:blue">View</a></td>
                                </tr>
                    <?php
                            }
                        }
                        else{
                            echo '<h5 style="margin-top:45px"><center> No Leave Applied </center></h5>';
                        }
                        ?> 
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row mt-5">
                <table class="table table-responsive table-striped mt-3">
                    <?php
                        if(mysqli_num_rows($rese)!= 0){
                            ?>
                                <tr>
                                    <th>USN</th>
                                    <th>Name</th>
                                    <th>Event Name</th>
                                    <th>Time From</th>
                                    <th>Time To</th>
                                    <th>Document</th>
                                </tr>
                            <?php
                                foreach ($rese as $row) 
                                {          
                                    $st = 'select * from students where usn = "' . $row["usn"] . '"';
                                    $s = $link->query($st);
                                    $s2 = mysqli_fetch_assoc($s);            
                            ?>
                                <tr>
                                    <td><?php echo $row["usn"] ?></td>
                                    <td><?php echo $s2["fname"] ?></td>
                                    <td><?php echo $row["event_name"] ?></td>
                                    <td><?php echo $row["from_time"] ?></td>
                                    <td><?php echo $row["to_time"] ?></td>
                                    <td><a href="<?php echo $row["doc_name"]; ?>" target="_blank" style="color:blue">View</a>
                                </tr>
                            <?php
                                    }
                                }
                                else{
                                echo '<h5><center> No Leave Applied </center></h5>';
                            }
                    ?>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row mt-5">
                <table class="table table-responsive table-striped mt-3">
                <?php
                    if(mysqli_num_rows($resp)!= 0){
                        ?>
                        <tr>
                                <th>USN</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Time From</th>
                                <th>Time To</th>
                                <th>Rounds Cleared </th>
                                <th>Document</th>
                            </tr>
                            <?php
                            foreach ($resp as $row) 
                                $st = 'select * from students where usn = "' . $row["usn"] . '"';
                                $s = $link->query($st);
                                $s2 = mysqli_fetch_assoc($s);    
                            {                      
                            ?>
                            <tr>
                                <td><?php echo $row["usn"] ?></td>
                                <td><?php echo $s2["fname"] ?></td>
                                <td><?php echo $row["company_name"] ?></td>
                                <td><?php echo $row["from_time"] ?></td>
                                <td><?php echo $row["to_time"] ?></td>
                                <td><?php echo $row["rounds"] ?></td>
                                <td><a href="<?php echo $row["doc_name"]; ?>" target="_blank" style="color:blue">View</a>
                            </tr>
                            <?php
                                }
                            }
                            else{
                                echo '<h5><center> No Leave Applied </center></h5>';
                            }
                            ?> 
                    </table>
                </div>
            </div>
        </div>
    </div>

<div>
<?php include "../template/scroll.php"; ?>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>







</body>

</html>