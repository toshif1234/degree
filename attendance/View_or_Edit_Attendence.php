<?php
// require_once "config.php";
error_reporting(0);

// session_start();
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
if ($_SESSION["temp"] == 0) {

    $branch = $_POST["branch"];
    $sem = $_POST["sem"];
    $sec = $_POST["sec"];
    $sub = $_POST["sub"];
    // $date = $_POST["date"];
    $month = $_POST["month"];
    // $period=$_POST["period"];
    $_SESSION['branch'] = $branch;
    $_SESSION['sem'] = $sem;
    $_SESSION['sec'] = $sec;
    $_SESSION['sub'] = $sub;
    // $_SESSION['date'] = $date;
    $_SESSION['month'] = $month;
    // $_SESSION['period'] = $period;
    $temp = $_SESSION["temp"];
} else {
    $branch = $_SESSION['branch'];
    $sem = $_SESSION['sem'];
    $sec = $_SESSION['sec'];
    $sub = $_SESSION['sub'];
    $date = $_SESSION['date'];
    $month = $_SESSION['month'];
    //    $period= $_SESSION['period'];

}

$c=explode("-",$sub);
$a=$c[0];

$z=preg_split("/[A-Za-z]*/", $a);
// echo $z[4];

$m=$z[4];

if($m==$sem)
{


// $date1 = str_replace("-", "_", $date);
$q1 = "SELECT Column_Name FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME LIKE '%\\_" . $month . "\\_%' order by Column_Name;";
// echo $q1;
$result = $link->query($q1);
// 


?>


<style>
.sticky-col {
    position: -webkit-sticky;
    position: sticky;
    background-color: white;
}

.custom-table {
                overflow: scroll;
                width: 79vw;
                height: 75vh;
                margin-top: 0px;
                padding: 0;
            }

.first-col {
    left: 0px;
}

thead tr:nth-child(1) th {
                background: silver;
                position: sticky;
                top: 0;
                z-index: 10;
                text-align: center;
            }

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
<!-- page content start -->
<div>

    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="mb-2"> View Attendence </h3>
            </div>
            <!-- <div class="col"></div> -->
            <!-- <div class="col">
                <button type="button" style="float: right;" class="btn btn-primary m-1" data-toggle="modal" data-target="#exampleModal">
                    Select Dates
                </button> -->
                <!-- Modal -->
                
                <!-- Model End -->
            <!-- </div> -->
        </div>
    </div> <!-- table -->

    <div class="container">
        <div class="table-responsive-sm custom-table">
            <table class="table table-light" >
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">Slno</th>
                        <th scope="col" class="sticky-col first-col" style="text-align: center;">USN</th>
                        <th scope="col" style="text-align: center;">Name</th>
                        <?php foreach ($result as $r) {
                            // echo $r;
                            $st=implode($r);
                            $rr=explode("_",$st);
                            // print_r($rr);
                            if($rr[1]==$month){

                    $q5 = "SELECT " . $r["Column_Name"] . " FROM attendance WHERE " . $r["Column_Name"] . " is null and branch=\"" . $branch . "\" and sem=\"" . $sem . "\" and section=\"" . $sec . "\" and subject=\"" . $sub . "\"";
                    $result6 = $link->query($q5);
                    if (!mysqli_num_rows($result6)) { 
                        //   echo $q5;
                        $ss=explode("_",$r["Column_Name"])
                        ?>
                        <th scope="col" style="text-align: center;"><?php echo $ss[0] . "_" . $ss[1] . "_" . $ss[2] ; echo "<br>"; echo "Hour No " . $ss[3]; ?></th>
                        <?php 
                        $c[]=$r["Column_Name"];    
                    }
                }
                } ?>
                        <th scope="col" style="text-align: center;"> Options </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- loop for creating table rows -->
                    <?php
           
                $q = "select usn,name from attendance where branch=\"" . $branch . "\" and sem=\"" . $sem . "\" and section=\"" . $sec . "\" and subject=\"" . $sub . "\" order by usn;";
            
            
            // echo $q;
            $result1 = $link->query($q);
            $con = 1;
            $con1 = 1;
            $_SESSION["month"] = $month;
            $q4 = "SELECT Column_Name FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME LIKE '%\\_" . $month . "\\_%' order by Column_Name;";
            // echo $q4;
            $result4 = $link->query($q4);
            foreach ($result1 as $r1) { ?>
                    <tr>
                        <th scope="row"><?php echo $con++; ?></th>
                        <input type="text" name="usn" value="<?php echo $r1["usn"] ?>" hidden>
                        <input type="text" name="name" value="<?php echo $r1["name"] ?>" hidden>
                        <td class="sticky-col first-col" style="text-align: center;"><?php echo $r1["usn"] ?></td>
                        <td style="text-align: center;"><?php echo $r1["name"] ?></td>
                        <?php
                    foreach ($c as $s) {
                        
                        $column = $s;
                        // $con1++;
                        
                            $q2 = "select " . $s . " from attendance where usn=\"" . $r1["usn"] . "\" and branch=\"" . $branch . "\" and sem=\"" . $sem . "\" and section=\"" . $sec . "\" and subject=\"" . $sub . "\" order by usn;";
                        // echo $q2;
                        $result2 = $link->query($q2);


                            // $q2="select" . $r["Column_Name"] . " from attendance where usn=\"" . $r1["usn"] . "\";";
                            // $result2=$link->query($q2);
                    ?>
                        <form action="update.php" method="post">
                            <!-- loop for displaying attendence  -->
                            <?php foreach ($result2 as $r2) { ?>
                            <td>
                                <?php if ($r2["$column"]) { ?>

                                <div class="form-check form-switch mx-auto">
                                    <input class="form-check-input form-success" type="checkbox"
                                        id="flexSwitchCheckDefault" name='column[]' checked
                                        value="<?php echo $column ?>">

                                </div>
                                <?php } else { ?>
                                <div class="form-check form-switch mx-auto">
                                    <input class="form-check-input form-success" type="checkbox"
                                        id="flexSwitchCheckDefault" name='column[]' value="<?php echo $column ?>">

                                </div>
                                <?php }  ?>
                                <input type="text" name="usn" value="<?php echo $r1["usn"] ?>" hidden>
                            </td>

                            <?php }   ?>



                            <?php  }
                       ?>
                            <td style="text-align: center;">
                                <button class="btn btn-info btn-sm">
                                    SAVE </button>
                            </td>
                        </form>
                    </tr>
                    <?php } ?>
                    <!-- Default edit options -->

                    <tr>
                        <td style="text-align: center;"></td>
                        <td style="text-align: center;"></td>
                        <td style="text-align: center;"></td>
                        <?php 
                
                foreach ($c as $s) {
                   

                ?>
                        <!-- <th scope="row"></th> -->

                        <!-- loop for displaying attendence  -->

                        <td style="text-align: center;">
                            <!-- <form action="update.php" method="post"> -->
                            <!-- <button class="btn btn-primary btn-sm">
                            SAVE </button> -->
                            <!-- </form> -->

                            <form action="delete.php" method="POST">
                                <input type="text" name="column_name" value="<?php echo $s; ?>" hidden>
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                <input type="text" name="branch" value="<?php echo $branch ?>" hidden>
                                <input type="text" name="sem" value="<?php echo $sem ?>" hidden>
                                <input type="text" name="sec" value="<?php echo $sec ?>" hidden>
                                <input type="text" name="sub" value="<?php echo $sub ?>" hidden>
                            </form>
                        </td>
                        <?php } 



                //  print_r($arr);
                ?>
                        <td></td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
    <?php //echo $con1; ?>
    <!-- <div class="container">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-sm-1">
                                <input type="Submit" name="Filter" value="Save"
                                    class="form-control btn btn-primary btn-sm" id="Filter">
                            </div>
                        </div>
                    </div> -->

    <!-- table -->
    <?php
}
else
{
    $_SESSION['check_error']=1;

        // header("Location: lesson_plan.php");
        echo '<script>window.location.replace("Select Attendence_for_viewingattendence.php");</script>';
       
    }
    ?>
</div>
<!-- page content end -->
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>
<script>
$(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
});
</script>

<?php //print_r($arr); 
?>




</body>

</html>