<?php

require_once "../config.php";
//session_start();
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
error_reporting(0);


// if(!empty($_POST['branch']) and !empty($_POST['sem']) and !empty($_POST['sec']) and !empty($_POST['sub']) and !empty($_POST['date']) and !empty($_POST['period'])){
if($_SESSION["temp"]==0){

$branch=$_POST["branch"];
$sem=$_POST["sem"];
$sec=$_POST["sec"];
$sub=$_POST["sub"];
$date=$_POST["date"];
$period=$_POST["period"];
$_SESSION['branch'] = $branch;
$_SESSION['sem'] = $sem;
$_SESSION['sec'] = $sec;
$_SESSION['sub'] = $sub;
$_SESSION['date'] = $date;
$_SESSION['period'] = $period;
$temp = $_SESSION["temp"];
}
else{
   $branch= $_SESSION['branch'];
   $sem= $_SESSION['sem'];  
   $sec= $_SESSION['sec'];  
   $sub= $_SESSION['sub'];  
   $date= $_SESSION['date'];  
   $period= $_SESSION['period'];
 
}

$c=explode("-",$sub);
$a=$c[0];

$z=preg_split("/[A-Za-z]*/", $a);
// echo $z[4];

$m=$z[4];

if($m==$sem)
{



$sub_only = explode(' - ', $sub);

$q_e = 'select elective from subjects where sub_name ="' . $sub_only[1] . '"';
$result_e = $link->query($q_e);

$r_e = mysqli_fetch_assoc($result_e);

if($r_e['elective'] == 0){
$q="select adm_no,usn,fname,mname,lname from students where branch=\"" . $branch . "\" and semester=\"" . $sem . "\" and section=\"" . $sec . "\";";
}
else{
    $q = "select * from students s, elective_maping e where s.branch = \"" . $branch . "\" and s.section = \"" . $sec . "\" and s.semester = \"" . $sem . "\" and s.usn = e.usn and e.sub_name = \"" . $sub . "\"";
    // $q="select adm_no,usn,fname,mname,lname from students where branch=\"" . $branch . "\" and semester=\"" . $sem . "\" and section=\"" . $sec . "\";";
}
// echo $q;
$r = $link->query($q);
//echo $q;
$date1=str_replace("-","_",$date);
$q1="ALTER TABLE attendance ADD " . $date1 . "_" . $period . " int;";

// echo $q1;
$_SESSION["date3"]=$date1 . "_" . $period;
$date3=$_SESSION["date3"];

if($_SESSION["temp"]==0){
try {
    $result1=$link->query($q1);
} catch (Exception $e) {
    // echo 'Caught exception: ',  $e->getMessage(), "\n";
    
}
}
// echo $_SESSION["temp"];
$q_att = "SELECT Column_Name FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME LIKE '%" . $date1 . "%' order by Column_Name;";
// echo $q_att;
$result_att = $link->query($q_att);
$r_date=mysqli_fetch_assoc($result_att);
// echo $r_date["Column_name"];
$q5 = "SELECT " . $r_date["Column_Name"] . " FROM attendance WHERE " . $r_date["Column_Name"] . " is not null and branch=\"" . $branch . "\" and sem=\"" . $sem . "\" and section=\"" . $sec . "\" and subject=\"" . $sub . "\"";
$result6 = $link->query($q5);
// echo    $q5;
if(mysqli_num_rows($result6)){


if($period>1){
$q_clone='select adm_no,usn,name,' . $r_date["Column_Name"] . ' from attendance where sem="' . $sem . '" and section="' . $sec . '" and subject="' . $sub . '" and branch="' . $branch . '";';
// echo $q_clone;
$result_clone=$link->query($q_clone);
foreach($result_clone as $r_c)
{
    $clone_update='update attendance set ' . $date1 . "_" . $period . '=' . $r_c[$r_date["Column_Name"]] . ' where sem="' . $sem . '" and section="' . $sec . '" and subject="' . $sub . '" and usn="' . $r_c["usn"] . '" and branch="' . $branch . '" ;';
    // $clone_exec=$link->query($clone_update);
    // echo $clone_update;
    $result7=$link->query($clone_update);
}
}
}
else{
    foreach($r as $result){
        
    $q3="INSERT INTO `attendance`(`adm_no`, `usn`, `name`, `branch`, `sem`, `section`,`subject`) VALUES ('".$result["adm_no"]. "','" . $result["usn"] .  "',' " .($result["fname"] . $result["mname"] . $result["lname"]) .  "','" . $branch . "','" . $sem . "','" . $sec . "','" . $sub . "');";
    // echo $q3;
    try{
    $result2=$link->query($q3);
    } catch (Exception $e) {
    }
    }
    // echo $_SESSION["temp"];
    $q5="update attendance set " . $date1 . "_" . $period . "=1 where sem=\"" . $sem . "\" and section=\"" . $sec . "\"and subject=\"" . $sub . "\" and branch=\"" . $branch . "\";";
            // echo $q5;
            $link->query($q5);
    
    }





// header("Location: attendance_data.php");

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
        </style>
                <h3 class="mb-4"> Add Attendence </h3>
                <!-- table -->
                
                    <table class="table table-hover table-bordered table-responsive table-light">
                    <?php
                     $se="select usn,name," . $date3 . " from attendance where sem=\"" . $sem . "\" and section=\"" . $sec . "\"and subject=\"" . $sub . "\"  and branch=\"" . $branch . "\"";
                     $result6=$link->query($se);
                    //  echo $se;
                    $_SESSION["temp"]=1;

                     ?>    
                    <thead class="thead-secondary">
                            <tr>
                                <th scope="col" style="text-align: center;">USN</th>
                                <th scope="col" style="text-align: center;">Name</th>
                                <th scope="col" style="text-align: center;"><?php echo $date; echo "<br>"; echo "Period " . $period ?></th>

                                <!-- loop for dates 
                                <th scope="col" style="text-align: center;">18/08/22</th>
                                <th scope="col" style="text-align: center;">19/08/22</th>
                                <th scope="col" style="text-align: center;">20/08/22</th>
                                <th scope="col" style="text-align: center;">21/08/22</th>
                                <th scope="col" style="text-align: center;">22/08/22</th>
                                <th scope="col" style="text-align: center;">23/08/22</th>-->
                                
                            </tr>
                        </thead>
                        <tbody>
                            <!-- loop for creating table rows -->
                            <form action="mark_attendance.php" method="post">
                            <button class="btn btn-success btn-sm mb-4" style="float:right " type="submit">Submit</button>
                            <?php
                             foreach($result6 as $r1)
                             { ?>
                            <tr>
                                
                                <td style="text-align: center;"><?php echo $r1["usn"] ?></td>
                                <td style="text-align: center;"><?php echo $r1["name"] ?></td>
                                <!-- loop for displaying attendence  -->
                                <td>
                                    <div class="form-check form-switch mx-auto">
                                    <?php if($r1["$date3"]){
                                        ?>
                                        
                                        <input class="form-check-input form-success" type="checkbox"
                                            id="flexSwitchCheckDefault" name='a[]' value="<?php  echo $r1["usn"]; ?>" checked >
                                            <?php } else { ?>
                                                <input class="form-check-input form-success" type="checkbox"
                                            id="flexSwitchCheckDefault" name='a[]' value="<?php  echo $r1["usn"];  ?>" >
                                    </div>
                                    <?php } ?>
                                </td>
                                
                                <!-- <td>
                                    <button class="btn btn-success btn-sm" type="submit">Submit</button>
                                </td> -->

                                <input type="text" name="usn" value="<?php echo $r1["usn"] ?>" hidden>
                            </tr>
                            
                            <?php 
                            } ?>
                           
                        </tbody>
                    </table>
                   
                    </form>
                    <!-- <div class="container">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-sm-1">
                                <input type="Submit" name="Filter" value="Save" class="form-control btn btn-primary"
                                    id="Filter">
                            </div>
                        </div>
                    </div> -->
                
                <!-- table -->
            </div>
            <!-- page content end -->
            <?php
}
else
{


        // header("Location: lesson_plan.php");
        $_SESSION['check_error']=1;
        echo '<script>window.location.replace("Select Attendence_for_Adding_attendence.php");</script>';
       
    }
    ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>