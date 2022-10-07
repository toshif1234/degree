<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
require_once "../config.php";
$con=$link;
$usn = $_POST["usn"];
// echo $usn;
// $img_path = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkkBpQ9U04geL7EKfAaXSxUCshUNLfDTKzlQ&usqp=CAU';
// $p1 = 'select * from display_pic where username="' . $_SESSION["username"] . '"';
// $res9 = $link->query($p1);
// // print_r($res9);
// if (mysqli_num_rows($res9) > 0) {
//     $res9 = mysqli_fetch_assoc($res9);
//     $img_path = $res9["dp"];
// }
$img_path = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkkBpQ9U04geL7EKfAaXSxUCshUNLfDTKzlQ&usqp=CAU';
$p1 = 'select * from display_pic where username="' . $usn . '"';
// echo $p1;
$res9 = $link->query($p1);
// print_r($res9);
if (mysqli_num_rows($res9) > 0) {
    $res9 = mysqli_fetch_assoc($res9);
    $img_path = $res9["dp"];
}

?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<!-- page content start -->
<style>
    .card {
        z-index: 0 !important;
    }

    .profileUpload {
        position: absolute;
        /* top: 200px; */
        right: 2%;
        top: 49%;
        z-index: 1;

    }

    .profileDelete {
        position: absolute;
        /* top: 200px; */
        left: 2%;
        top: 49%;
        z-index: 1;
        display: none;

    }

    .profileDelete:hover {
        display: inline-block;
    }

    #image_wraper button {
        display: none;
    }

    #image_wraper:hover button {
        display: initial;
        transition: display 250ms linear;
    }
    #imageUpload {
            display: none;
        }
    .img-container {
        padding: 0%;
        margin-left: 2%;
        border: 1px solid #888888;
        border-radius: 50%;
        text-align: center;
        justify-content: center;
        width: 250px;
        height: 250px;
        overflow: hidden;
        box-sizing: border-box;
        align-items: center;
        box-shadow: 0px 0px 20px 7px #888888;
        background: rgba(255, 255, 255, 0.884);
    }
</style>
<style>
table, th, td, tr {
  border:1px solid black;
  border-collapse: collapse;
}
</style>

<?php

$que = "select * from students where usn=\"$usn\"";
                    $result = $con->query($que);
                //    print_r($result);
                foreach ($result as $row) {
                    ?>
    
        <div class="card" style="padding:5%;">
            <div class="row">
    
                <div class="col-lg-8 col-10" style="text-align: center;">
                    <div class="row" style="font-size:30px">
                        <h3>
                            <span>
                                <?php echo $row["fname"] ?>
                                <?php echo $row["lname"] ?>
                                
                            </span>
                        </h3>
                    </div>
                    <div class="row">
                    <h3>
                        <span>
                            
                            <?php echo $row["usn"] ?>
                        </span>
                </h3>
                    </div>
                    
                </br>
                </br>



                    <?php

              $que = "select * from nodue where usn=\"$usn\"";
                    $result = $con->query($que);
                //    print_r($result);
                
                

                    ?>
                   
           


               
                <table style="width:100%">
                    <tr style="font-size:25px">
                        <th>&nbsp;&nbspSUBJECTS </th>
                        <th>&nbsp;&nbsp;DUE </th>
                        
                        
                        </tr>
                       
                     
                     <?php
                          $con2=0;
                          foreach ($result as $row1){
                           $con2++;
                         ?> 
              <tr>
                   
               <td tr style="font-size:20px">
                       <div class="form-control"  style="font-size:20px">
                        <?php  echo $row1["subj"] ; ?>
                    </div>
               </td>    
               <td>  
                     
                    <div class="form-control" style="font-size:20px">
                    &nbsp;&nbsp;<?php  echo $row1["due"] ; ?>
                     </div> </td> 
                     
                </tr>    
                
               
                <?php
                          }
                ?>
                
               
                </table>     
               
                       



          
                    
                </div>
    
            </div>
        </div>
    
    
    
       
    
    
        <?php
                        }
                   // } ?>

<!-- parents details -->


<!-- sslc marks details -->
<!-- <?php
                    
                        $que = "select adm_no from students where usn=\"$usn\"";
                        $result = $con->query($que);
                       
                        foreach ($result as $row) {
                            $admission_no = $row["adm_no"];
                            $_SESSION["adm_no"]=$row["adm_no"];
                            $que = "select * from sslc_details where adm_no=\"$admission_no\"";
                            $re = $con->query($que);
    
                            foreach ($re as $r) {
                    ?>
    
    
        <div class="card mt-3" style="padding:3%;">
            <div class="row">
                <p style="font-style: italic;font-weight:600;color:black;">SSLC Details</p>
    
                <div class="col col-lg-4 col-12 label mt-2">
                    School Name : <span class="value"><?php echo $r["sslc_school"] ?></span>
    
    
                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    School Board : <span class="value"><?php echo $r["sslc_board_university"] ?></span>
    
    
                </div>
    
    
                <div class="col col-lg-4 col-12 label mt-2">
                    SSLC Reg No : <span class="value"><?php echo $r["sslc_reg_no"] ?></span>
    
    
                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    SSLC Year :<span class="value"><?php echo $r["sslc_year"] ?></span>
    
    
                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    SSLC Max Marks: <span class="value"><?php echo $r["sslc_max_marks"] ?></span>
    
    
                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    SSLC Obtained Marks : <span class="value"><?php echo $r["sslc_obtained_marks"] ?></span>
    
    
                </div>
                <div class="col col-lg-4 col-12 label mt-2">
                    SSLC Percentage : <span class="value"><?php echo $r["sslc_percentage"] ?></span>
    
    
                </div>
                
            </div>
        </div>
    
        <?php
                    }
                        }
                    //} ?>
    
    <?php
                    // $con = mysqli_connect("localhost", "root", "", "erp_alvas");
                    // if (mysqli_connect_error()) {
                    //     echo "error";
                    // } else {
                        // $usn = $_SESSION["username"];
                        
    
                            $que = "select * from puc_details where adm_no=\"$admission_no\"";

                            $re = $con->query($que);
    
                            foreach ($re as $r) {
                    ?>
    
    
        <div class="card mt-3" style="padding:3%;">
            <div class="row">
            <p style="font-style: italic;font-weight:600;color:black;">PUC Details</p>

<div class="col col-lg-4 col-12 label mt-2">
    College Name : <span class="value"><?php echo $r["puc_school"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
    Board : <span class="value"><?php echo $r["puc_board_university"] ?></span>


</div>


<div class="col col-lg-4 col-12 label mt-2">
     Reg No : <span class="value"><?php echo $r["puc_reg_no"] ?></span>


</div>

<div class="col col-lg-4 col-12 label mt-2">
     Max Marks: <span class="value"><?php echo $r["puc_max_marks"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
    PUC Obtained Marks : <span class="value"><?php echo $r["puc_obtained_marks"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
     Year :<span class="value"><?php echo $r["puc_year"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
     Physics maximum marks : <span class="value"><?php echo $r["puc_phy_max_marks"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
     Physics Obtained marks : <span class="value"><?php echo $r["puc_phy_obtained_marks"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
     Percentage : <span class="value"><?php echo $r["puc_percentage"] ?></span>


</div>


<div class="col col-lg-4 col-12 label mt-2">
     Maths maximum marks : <span class="value"><?php echo $r["puc_maths_max_marks"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
    Maths Obtained marks : <span class="value"><?php echo $r["puc_phy_obtained_marks"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
     Subject Total Marks : <span class="value"><?php echo $r["puc_sub_total_marks"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
     Chemistry maximum marks : <span class="value"><?php echo $r["puc_che_max_marks"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
     Chemistry Obtained marks : <span class="value"><?php echo $r["puc_phy_obtained_marks"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
     English Maximum Marks : <span class="value"><?php echo $r["puc_eng_max_marks"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
     Bio/CS/E/S maximum marks : <span class="value"><?php echo $r["puc_elective_max_marks"] ?></span>


</div>
<div class="col col-lg-4 col-12 label mt-2">
 Bio/CS/E/S Obtained marks : <span class="value"><?php echo $r["puc_elective_obtained_marks"] ?></span>


</div>

<div class="col col-lg-4 col-12 label mt-2">
    English Max Marks : <span class="value"><?php  echo $r["puc_eng_obtained_marks"] ?></span>


</div>
    
                
            </div>
        </div>
    
    
    
    
      
    
        -->

    <?php
                            }
        include("../template/footer-fac.php");
    ?>