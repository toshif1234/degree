<?php
require_once "../config.php";
include("../template/fac-auth.php");

include("../template/sidebar-fac.php");
if ($_SESSION['prev'] == 0) {
    $_SESSION['batch'] = $batch = $_POST['batch'];
    $_SESSION['branch'] = $branch = $_POST['branch'];
    $_SESSION['prev'] = 1;
} else {

    $batch = $_SESSION["batch"];
    $branch = $_SESSION["branch"];
}

$con = $link;

//   $flag_save = 0;

//   $flag_save = $_SESSION["flag_save"];
//   if ($flag_save == 0) {

//     $batch = $_POST["batch"];

//     $branch = $_POST['branch'];

//     $_SESSION["batch"] = $batch;
//     $_SESSION['branch'] = $branch;
//   } else {

//     $batch = $_SESSION["batch"];
//     $branch = $_SESSION['branch'];
//   }



?>

<a href="download.php" target="_blank" class="btn btn-primary" style="float: right;">Dowanload Mentee's IA & Meeting information </a>

</br>
</br>
</br>
<div class="container">

    <?php
    $con = $link;
    //  $que="select * from students s, mentor_mapping m where m.usn=s.usn and  s.batch=\"" . $_POST["batch"] . "\" and s.branch=\"" . $_POST["branch"] . "\" and m.fac_name=\"" . $_SESSION["username"] . "\"";
    $que = "select * from students s,mentor_mapping m, parents_details p, puc_details pu, sslc_details ss where s.usn=m.usn and s.adm_no = ss.adm_no and ss.adm_no = pu.adm_no and pu.adm_no = p.adm_no and batch=\"" . $_SESSION['batch'] . "\" and branch=\"" . $_SESSION['branch'] . "\" and m.fac_name=\"" . $_SESSION["username"] . "\"";
    // $que = "select * from students s,mentor_mapping m, parents_details p, puc_details pu, sslc_details ss where s.usn=m.usn and s.adm_no = ss.adm_no and ss.adm_no = pu.adm_no and pu.adm_no = p.adm_no and batch= and m.fac_name=\"" . $_SESSION["username"] . "\" and s.batch=\"" . $_POST["batch"] . "\" and s.branch=\"" . $_POST["branch"] . "\"";
    $result = $con->query($que);
    // echo $que;
    //  $que1="select * from marks k,mentor_mapping m,students s where s.usn=k.usn and s.usn=m.usn and s.semester=k.sem and m.usn = k.usn and s.batch=\"" . $_POST["batch"] . "\" and s.branch=\"" . $_POST["branch"] . "\" and m.fac_name=\"" . $_SESSION["username"] . "\"";
    // $result1 = $con->query($que1);
    // echo ". $result1 . ";


    // $con2 = 0;
    $con1 = 0;
    foreach ($result as $row) {
        $con1++;
        //foreach ($result1 as $row1)
        //$con2++;





    ?><form action="student_update_details.php" method="POST">
            <div class="row " style="width:120%; background: #FFFFFF;border: 1px solid #ECF0FA; box-shadow: 0 2px 4px 0 rgba(7,17,55,0.06);  border-radius: 4px; border-radius: 4px;padding:1.5% ;margin-top: 1%;margin-right: 2%;">

                <div class="form-group col-md-2">
                    <label for="usn">USN :</label>
                    <input type="text" name="usn" class="form-control" id="usn" value=<?php echo $row["usn"]; ?> readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="fname">Frist Name :</label>
                    <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $row["fname"]; ?>">
                </div>
                <div class="form-group col-md-2">
                    <label for="mon_no">Phone Number :</label>
                    <input type="text" name="mob_no" class="form-control" id="mob_no" value=<?php echo $row["mob_no"]; ?> readonly>
                </div>
                <div class="form-group col-md-3" style="margin-top: .6%;left: 5%;">
                    <label for=""> </label><br>
                    <!-- Large modal -->
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">View More</button> -->

                    <!-- button to delete the field -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $con1 ?>">
                        Personal Info
                    </button>




                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3<?php echo $con1 ?>">
                        IA
                    </button>

                    <!--<a  href="student_ia.php"> <button type="button" class="btn btn-primary" data-toggle="modal">
                                           IA
                                        </button></a>-->


                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal4<?php echo $con1 ?>">
                        Meeting
                    </button>

                    <!-- //nodue -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal5<?php echo $con1 ?>">
                        Nodue
                    </button>


                    <!-- delete button -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter<?php echo $con1 ?>" onclick="console.log(<?php echo $row["adm_no"]; ?>)">
                        <i class="fas fa-trash"></i>
                    </button>
                    <!-- delete button model -->
                    <!-- model -->
                    <div class="modal fade" id="exampleModalCenter<?php echo $con1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure that you want to delete?

                                </div>
        </form>

        <form action="student_delete_details.php" method="POST">

            <div class="form-group col-md-5">
                <label for="usn">usn :</label>
                <input type="text" name="usn" class="form-control" id="adm_no" value=<?php echo $row["usn"]; ?> readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>

        </form>

</div>
</div>
</div>
</div>


<!-- IA -->

<div id="printThis">
    <?PHP
        //$que1 ="select * from marks k,mentor_mapping m,students s where s.usn=k.usn and  s.usn=m.usn and s.semester=k.sem and m.usn = k.usn and k.usn= \"" .$row["usn"]. "\" and s.batch=\"" . $_POST["batch"] . "\" and s.branch=\"" . $_POST["branch"] . "\" and m.fac_name=\"" . $_SESSION["username"] . "\"";
        $que1 = "select k.external,k.sub,k.ia1,k.ia2,k.ia3,k.att_avg,k.ia_avg,k.total_marks,k.assignment_avg,(k.ia_avg+k.assignment_avg) as tot, (k.ia_avg+k.assignment_avg+k.external) as grand from marks k,mentor_mapping m,students s where s.usn=k.usn and  s.usn=m.usn and s.semester=k.sem and m.usn = k.usn and k.usn= \"" . $row["usn"] . "\" and s.batch=\"" . $_SESSION['batch'] . "\" and s.branch=\"" . $_SESSION['branch'] . "\" and m.fac_name=\"" . $_SESSION["username"] . "\"";


        //$que1 ="select k.external,b.sub_name,k.sub,k.ia1,k.ia2,k.ia3,k.att_avg,k.ia_avg,k.total_marks,(( a.a1+a.a2+a.a3+a.a4+a.a5) /(max(b.assignment_no))) as total
        // from marks k,mentor_mapping m,students s,assignment_marks a,add_assignment b 
        //where s.usn=k.usn and  a.sub_name=b.sub_name and k.sub=a.sub_name and s.usn=m.usn and s.semester=k.sem and m.usn = k.usn and k.usn=a.usn and k.usn= \"" .$row["usn"]. "\"";



        $result1 = $con->query($que1);

        //  $q2= "SELECT a.sub_name, (( a.a1+a.a2+a.a3+a.a4+a.a5) /(max(b.assignment_no))) as total
        //  FROM assignment_marks a,add_assignment b 
        //  WHERE a.sub_name=b.sub_name  and  a.usn=\"" .$row["usn"]. "\"";
        //  $result2 = $con->query($que2);




    ?>

    <div class="modal fade " id="exampleModal3<?php echo $con1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">



            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <p>CIE &nbsp;&nbsp&nbsp;&nbsp &nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp SIE</p>   -->

                <p style="margin-left:30em;color: black;font: size 25px;"><B>CIE &nbsp;&nbsp&nbsp;&nbsp &nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp &nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp &nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp &nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp &nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp &nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SIE</B></p>

                <table>:
                    <tr>
                        <th>&nbsp;&nbspSUBJECTS :</th>
                        <th>&nbsp;&nbsp;IA1</th>
                        <th>&nbsp;&nbsp;IA2</th>
                        <th>&nbsp;&nbsp;IA3</th>
                        <th>&nbsp;&nbsp;Avg</th>
                        <th>&nbsp;&nbsp;Assignment</th>
                        <th>&nbsp;&nbsp;Total</th>
                        <th>&nbsp;&nbsp;Attendence</th>
                        <th>&nbsp;&nbsp;External</th>
                        <th>&nbsp;&nbsp;Grand Total</th>

                    </tr>


                    <?php
                    $con2 = 0;
                    foreach ($result1 as $row1) {
                        $con2++;
                    ?>
                        <tr>

                            <td>
                                <div class="form-control">
                                    <?php echo $row1["sub"]; ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-control">
                                    &nbsp;&nbsp;<?php echo $row1["ia1"]; ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-control">
                                    &nbsp;&nbsp;<?php echo $row1["ia2"]; ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-control">
                                    &nbsp;&nbsp;<?php echo $row1["ia3"]; ?>
                                </div>
                            </td>

                            <td>
                                <div class="form-control">
                                    &nbsp;&nbsp;<?php echo $row1["ia_avg"]; ?>
                                </div>
                            </td>

                            <td>
                                <div class="form-control">
                                    &nbsp;&nbsp;<?php echo $row1["assignment_avg"]; ?>
                                </div>
                            </td>

                            <td>
                                <div class="form-control">
                                    &nbsp;&nbsp;<?php echo $row1["tot"]; ?>
                                </div>
                            </td>

                            <td>
                                <div class="form-control">
                                    &nbsp;&nbsp;<?php echo $row1["att_avg"]; ?>
                                </div>
                            </td>

                            <td>
                                <div class="form-control">
                                    &nbsp;&nbsp;<?php echo $row1["external"]; ?>
                                </div>
                            </td>

                            <td>
                                <div class="form-control">
                                    &nbsp;&nbsp;<?php echo $row1["grand"]; ?>
                                </div>
                            </td>



            </div>

            </tr>


        <?php
                    }
        ?>


        </table>





        </div>

    </div>

</div>

</div>


<!-- nodue -->

<div id="printThis">
    <?PHP
        //$que1 ="select * from nodue k,mentor_mapping m,students s where s.usn=k.usn and  s.usn=m.usn and m.usn = k.usn and k.usn= \"" .$row["usn"]. "\" and s.batch=\"" . $_POST["batch"] . "\" and s.branch=\"" . $_POST["branch"] . "\" and m.fac_name=\"" . $_SESSION["username"] . "\"";
        $que1 = "select * from nodue k, mentor_mapping m where  k.usn=m.usn  and  m.usn = k.usn and k.usn= \"" . $row["usn"] . "\" and m.fac_name=\"" . $_SESSION["username"] . "\"";
        $result1 = $con->query($que1);

        $que2 = "select * from marks k, mentor_mapping m where  k.usn=m.usn  and k.usn= \"" . $row["usn"] . "\" and m.fac_name=\"" . $_SESSION["username"] . "\"";
        $result2 = $con->query($que2);





    ?>

    <div class="modal fade " id="exampleModal5<?php echo $con1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">



            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <table>
                    <tr>

                        <th>&nbsp;&nbspSUBJECTS :</th>
                        <!-- <th>&nbsp;&nbspSUBJECTS :</th> -->
                        <th>&nbsp;&nbsp;Due</th>


                    </tr>

                    <!--                      
                        <?php
                        $con2 = 0;
                        foreach ($result2 as $row2) {
                            $con2++;
                        ?> 
              <tr>
              <td>    
                    <div class="form-control">
                    &nbsp;&nbsp;<?php echo $row2["sub"]; ?>
                     </div> </td> 
                     

                     <?php
                        }
                        ?> -->

                    <?php
                    $con2 = 0;
                    foreach ($result1 as $row1) {
                        $con2++;
                    ?>

                        <tr>
                            <td>
                                <div class="form-control">
                                    <?php echo $row1["subj"]; ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-control">
                                    &nbsp;&nbsp;<?php echo $row1["due"]; ?>
                                </div>
                            </td>
                            <td>





                            <?php
                        }

                            ?>





                        </tr>
                </table>
                </BR>

                <form action="arrange1.php" method="post">
                    <input type="text" name="usn" id="usn" value="<?php echo $row1["usn"]; ?>" readonly>
                    <input type="text" name="SUB" id="sub" value="MENTOR" readonly></td>
                    <input type="text" id="id" name="id">
                    <button class="btn btn-primary btn-sm" id="usn" type="submit">SAVE</button>
                </form>

            </div>

        </div>

    </div>

</div>



<!-- Metting -->
<?PHP
        $que2 = "select * from shedule m,mentor_mapping k,students s where s.usn=m.usn and k.usn=m.usn and k.usn= \"" . $row["usn"] . "\" and s.batch=\"" . $_SESSION['batch'] . "\" and s.branch=\"" . $_SESSION['branch'] . "\" and k.fac_name=\"" . $_SESSION["username"] . "\"";
        $result2 = $con->query($que2);
?>


<div class="modal fade " id="exampleModal4<?php echo $con1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" width=70% aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>





            <div class="modal-body ">
                <form action="issue.php" method="post">

                    <div class="row">
                        <div class="form-group col-md-2">
                            <B><label for="usn">USN :</label></B>
                            <input type="text" name="usn" class="form-control" id="usn" value=<?php echo $row["usn"]; ?> readonly>
                        </div>




                    </DIV>
                    <center>

                </form>






            </div>



            <table>
                <tr>
                    <!--<B><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATE </th></B>
                        <B><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AGENDA</th></B>
                        <B><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ISSUES</th></B>
                        <B><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REMARK</th></B>-->
                    <th>&nbsp;&nbsp; Date</th>
                    <th>Agenda</th>
                    <th>Issue</th>
                    <th>Remark</th>

                </tr>


                <?php
                $con3 = 0;
                foreach ($result2 as $row2) {
                    $con3++;
                ?>




                    <tr>
                        <td>

                            <input type="text" style="font: size 30px;" name="Date" class="form-control" id="Date" value=" <?php echo $row2["Date"]; ?>" readonly>

                        </td>

                        <td>
                            <input type="text" style="font: size 30px;" name="agenda" class="form-control" id="agenda" value="<?php echo $row2["agenda"]; ?>" readonly>
                        </td>
                        <td>

                            <input type="text" style="font: size 30px;" name="any_issue" class="form-control" id="any_issue" value="<?php echo $row2["any_issue"]; ?>">

                        </td>

                        <td>
                            <input type="text" style="font: size 30px;" name="Remark" class="form-control" id="Remark" value="<?php echo $row2["Remark"]; ?>">

                        </td>
                    </tr>








                <?php
                }
                ?>

            </table>






        </div>
    </div>
</div>














<!-- Modal -->

<div class="modal fade " id="exampleModal<?php echo $con1 ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body ">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="batch">Batch :</label>
                        <input type="text" name="batch" class="form-control" id="batch" value=<?php echo $row["batch"]; ?>>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="mname">Middle Name :</label>
                        <input type="text" name="mname" class="form-control" id="mname" value=<?php echo $row["mname"]; ?>>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="lname">Last Name :</label>
                        <input type="text" name="lname" class="form-control" id="lname" value=<?php echo $row["lname"]; ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label for="branch">Branch :</label>
                    <select name="branch" id="branch" class="custom-select">
                        <option value="<?php echo $row["branch"]; ?>"><?php echo $row["branch"]; ?></option>
                        <option value="Civil">Civil</option>
                        <option value="Mechanical">Mechanical</option>
                        <option value="Computer Science and Engineering">Computer Science and Engineering</option>
                        <option value="Computer Science & Design">Computer Science & Design</option>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Electronic & Communication">Electronic & Communication</option>
                        <option value="Artifical Intelligence & Machine Learning">Artifical Intelligence &
                            Machine Learning</option>
                        <option value="Information Science & Engg.">Information Science & Engg.</option>
                    </select>
                    <!-- <input type="text" name="branch" class="form-control" id="branch"> -->
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="kcet">K-CET Rank :</label>
                        <input type="text" name="kcet" class="form-control" id="kcet" value=<?php echo $row["kcet"]; ?>>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="comedk">COMED-K Rank :</label>
                        <input type="text" name="comedk" class="form-control" id="comedk" value=<?php echo $row["comedk"]; ?>>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="jee">JEE Rank :</label>
                        <input type="text" name="jee" class="form-control" id="jee" value=<?php echo $row["jee"]; ?>>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nationality">Nationality :</label>
                    <input type="text" name="nationality" class="form-control" id="nationality" value=<?php echo $row["nationality"]; ?>>
                </div>
                <div class="form-group">
                    <label for="date_of_admission">Date Of Admission :</label>
                    <input type="date" name="date_of_admission" class="form-control" id="date_of_admission" value=<?php echo $row["data_of_admission"]; ?>>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="dob">Data of Birth :</label>
                        <input type="date" name="dob" class="form-control" id="dob" value=<?php echo $row["dob"]; ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="place_of_birth">Place of Birth :</label>
                        <input type="text" name="place_of_birth" class="form-control" id="place_of_birth" value=<?php echo $row["place_of_birth"]; ?>>
                    </div>
                </div>
                <div class="form-group">

                    <label for="gender">Gender : </label>
                    <?php
                    // echo $row["gender"];
                    if (strtolower($row["gender"]) == "male") { ?>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="male" value="male" checked>
                            <label for="male" class="custom-control-label">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="female" value="female">
                            <label for="female" class="custom-control-label">Female</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="not_to_say" value="not_to_say">
                            <label for="not_to_say" class="custom-control-label">Not to Say</label>
                        </div>
                    <?php } else if (strtolower($row["gender"]) == "female") { ?>


                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="male" value="male">
                            <label for="male" class="custom-control-label">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="female" value="female" checked>
                            <label for="female" class="custom-control-label">Female</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="not_to_say" value="not_to_say">
                            <label for="not_to_say" class="custom-control-label">Not to Say</label>
                        </div>
                    <?php } else if (strtolower($row["gender"]) == "not to say") { ?>


                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="male" value="male">
                            <label for="male" class="custom-control-label">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="female" value="female">
                            <label for="female" class="custom-control-label">Female</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="not_to_say" value="not_to_say" checked>
                            <label for="not_to_say" class="custom-control-label">Not to Say</label>
                        </div>
                    <?php } else { ?>


                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="male" value="male">
                            <label for="male" class="custom-control-label">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="female" value="female">
                            <label for="female" class="custom-control-label">Female</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="gender" class="custom-control-input" id="not_to_say" value="not_to_say">
                            <label for="not_to_say" class="custom-control-label">Not to Say</label>
                        </div>
                    <?php } ?>

                    <!-- <input type="text" name="gender" class="form-control" id="gender"> -->
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="mob_no">Mobile Number :</label>
                        <input type="text" name="mob_no" class="form-control" id="mob_no" value=<?php echo $row["mob_no"]; ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email_id">Email id :</label>
                        <input type="email" name="email_id" class="form-control" id="email_id" value=<?php echo $row["email_id"]; ?>>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="aadhar">Aadhar Number :</label>
                        <input type="text" name="aadhar" class="form-control" id="aadhar" value=<?php echo $row["aadhar"]; ?>>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pan_card">Pan card Number :</label>
                        <input type="text" name="pan_card" class="form-control" id="pan_card" value=<?php echo $row["pan_card"]; ?>>
                    </div>
                </div>

                <div class="form-group">
                    <label for="sc_st">SC/ST :</label>
                    <input type="text" name="sc_st" class="form-control" id="sc_st" value=<?php echo $row["sc_st"]; ?>>
                </div>
                <div class="form-group">
                    <label for="caste">CASTE :</label>
                    <input type="text" name="caste" class="form-control" id="caste" value=<?php echo $row["caste"]; ?>>
                </div>
                <div class="form-group">
                    <label for="annual_income">Annual Income :</label>
                    <input type="text" name="annual_income" class="form-control" id="annual_income" value=<?php echo $row["annual_income"]; ?>>
                </div>
                <h4>Parent Details :</h4>
                <div class="row">
                    <div class="col col-6 col-md-6 col-lg-6">

                        <div class="form-group">
                            <label for="mother_name">Mother's name : </label>
                            <input type="text" name="mother_name" class="form-control" id="mother_name" value="<?php echo $row["mother_name"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="mother_mob_no">Mother's mobile number : </label>
                            <input type="text" name="mother_mob_no" class="form-control" id="mother_mob_no" value="<?php echo $row["mother_mob_no"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="mother_email_id">Mother's Email ID : </label>
                            <input type="text" name="mother_email_id" class="form-control" id="mother_email_id" value="<?php echo $row["mother_email_id"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="mother_aadhar">Mother's Aadhar number : </label>
                            <input type="text" name="mother_aadhar" class="form-control" id="mother_aadhar" value="<?php echo $row["mother_aadhar"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="mother_pan_card">Mother's Pan Card number : </label>
                            <input type="text" name="mother_pan_card" class="form-control" id="mother_pan_card" value="<?php echo $row["mother_pan_card"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="mother_occupation">Mother's Occupation : </label>
                            <input type="text" name="mother_occupation" class="form-control" id="mother_occupation" value="<?php echo $row["mother_occupation"]; ?>">
                        </div>
                    </div>
                    <div class="col col-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="father_name">Father's name : </label>
                            <input type="text" name="father_name" class="form-control" id="father_name" value="<?php echo $row["father_name"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="father_mob_no">Father's mobile number : </label>
                            <input type="text" name="father_mob_no" class="form-control" id="father_mob_no" value="<?php echo $row["father_mob_no"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="father_email_id">Father's Email ID : </label>
                            <input type="text" name="father_email_id" class="form-control" id="father_email_id" value="<?php echo $row["father_email_id"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="father_aadhar">Father's Aadhar number : </label>
                            <input type="text" name="father_aadhar" class="form-control" id="father_aadhar" value="<?php echo $row["father_aadhar"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="father_pan_card">Father's Pan Card number : </label>
                            <input type="text" name="father_pan_card" class="form-control" id="father_pan_card" value="<?php echo $row["father_pan_cad"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="father_occupation">Father's Occupation : </label>
                            <input type="text" name="father_occupation" class="form-control" id="father_occupation" value="<?php echo $row["father_occupation"]; ?>">
                        </div>
                    </div>
                </div>
                <h4>SSLC Details : </h4>
                <div class="row">
                    <div class="col col-6 col-md-6 col-lg-6">
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="sslc_school">School : </label>
                                    <input type="text" name="sslc_school" class="form-control" id="sslc_school" value="<?php echo $row["sslc_school"]; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="sslc_board_university">Board : </label>
                                    <input type="text" name="sslc_board_university" class="form-control" id="sslc_board_university" value="<?php echo $row["sslc_board_university"]; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="sslc_reg_no">Registered Number : </label>
                                    <input type="text" name="sslc_reg_no" class="form-control" id="sslc_reg_no" value="<?php echo $row["sslc_reg_no"]; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="sslc_year">Passing year : </label>
                                    <input type="text" name="sslc_year" class="form-control" id="sslc_year" value="<?php echo $row["sslc_year"]; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-6 col-md-6 col-lg-6">
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="sslc_max_marks">Max Marks : </label>
                                    <input type="text" name="sslc_max_marks" class="form-control" id="sslc_max_marks" value="<?php echo $row["sslc_max_marks"]; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="sslc_obtained_marks">Obtained Marks : </label>
                                    <input type="text" name="sslc_obtained_marks" class="form-control" id="sslc_obtained_marks" value="<?php echo $row["sslc_obtained_marks"]; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="sslc_percentage">Percentage : </label>
                                    <input type="text" name="sslc_percentage" class="form-control" id="sslc_percentage" value="<?php if ((float)$row["sslc_percentage"] < 1) echo (float)$row["sslc_percentage"] * 100 . "%";
                                                                                                                                else echo $row["sslc_percentage"] . "%" ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4>PUC/12th Details : </h4>
                <div class="row">
                    <div class="col col-6 col-md-6 col-lg-6">
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_school">School/College : </label>
                                    <input type="text" name="puc_school" class="form-control" id="puc_school" value="<?php echo $row["puc_school"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_board_university">Board/University : </label>
                                    <input type="text" name="puc_board_university" class="form-control" id="puc_board_university" value="<?php echo $row["puc_board_university"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_reg_no">Registered Number : </label>
                                    <input type="text" name="puc_reg_no" class="form-control" id="puc_reg_no" value="<?php echo $row["puc_reg_no"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_year">Year of passing : </label>
                                    <input type="text" name="puc_year" class="form-control" id="puc_year" value="<?php echo $row["puc_year"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_max_marks">Max Marks : </label>
                                    <input type="text" name="puc_max_marks" class="form-control" id="puc_max_marks" value="<?php echo $row["puc_max_marks"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_obtained_marks">Obtained Marks : </label>
                                    <input type="text" name="puc_obtained_marks" class="form-control" id="puc_obtained_marks" value="<?php echo $row["puc_obtained_marks"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_percentage">Percentage : </label>
                                    <input type="text" name="puc_percentage" class="form-control" id="puc_percentage" value="<?php if ((float)$row["puc_percentage"] < 1) echo (float)$row["puc_percentage"] * 100 . "%";
                                                                                                                                else echo $row["puc_percentage"] . "%" ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_phy_max_marks">Max Physics Marks : </label>
                                    <input type="text" name="puc_phy_max_marks" class="form-control" id="puc_phy_max_marks" value="<?php echo $row["puc_phy_max_marks"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_phy_obtained_marks">Obtained Physics Marks : </label>
                                    <input type="text" name="puc_phy_obtained_marks" class="form-control" id="puc_phy_obtained_marks" value="<?php echo $row["puc_phy_obtained_marks"] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-6 col-md-6 col-lg-6">
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_maths_max_marks">Max Maths Marks : </label>
                                    <input type="text" name="puc_maths_max_marks" class="form-control" id="puc_maths_max_marks" value="<?php echo $row["puc_maths_max_marks"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_maths_obtained_marks">Obtained Maths Marks : </label>
                                    <input type="text" name="puc_maths_obtained_marks" class="form-control" id="puc_maths_obtained_marks" value="<?php echo $row["puc_maths_obtained_marks"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_che_max_marks">Max Chemistry Marks : </label>
                                    <input type="text" name="puc_che_max_marks" class="form-control" id="puc_che_max_marks" value="<?php echo $row["puc_che_max_marks"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_che_obtained_marks">Obtained Chemistry Marks : </label>
                                    <input type="text" name="puc_che_obtained_marks" class="form-control" id="puc_che_obtained_marks" value="<?php echo $row["puc_che_obtained_marks"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_elective_max_marks">Max Elective Marks : </label>
                                    <input type="text" name="puc_elective_max_marks" class="form-control" id="puc_elective_max_marks" value="<?php echo $row["puc_elective_max_marks"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_elective_obtained_marks">Obtained Elective Marks : </label>
                                    <input type="text" name="puc_elective_obtained_marks" class="form-control" id="puc_elective_obtained_marks" value="<?php echo $row["puc_elective_obtained_marks"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_sub_total_marks">Sub Total Marks : </label>
                                    <input type="text" name="puc_sub_total_marks" class="form-control" id="puc_sub_total_marks" value="<?php echo $row["puc_sub_total_marks"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_eng_max_marks">Max English Marks : </label>
                                    <input type="text" name="puc_eng_max_marks" class="form-control" id="puc_eng_max_marks" value="<?php echo $row["puc_eng_max_marks"] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="puc_eng_obtained_marks">Obtained English Marks : </label>
                                    <input type="text" name="puc_eng_obtained_marks" class="form-control" id="puc_eng_obtained_marks" value="<?php echo $row["puc_elective_obtained_marks"] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 pr-4">
                        <h5>Present address :</h5> <br>
                        <div class="form-group">
                            <label for="present_house_no_name">House no/name :</label>
                            <input type="text" name="present_house_no_name" class="form-control" id="present_house_no_name" value=<?php echo $row["present_house_no_name"]; ?>>
                        </div>
                        <div class="form-group">
                            <label for="present_post_village">Post and village :</label>
                            <input type="text" name="present_post_village" class="form-control" id="present_post_village" value=<?php echo $row["present_post_village"]; ?>>
                        </div>
                        <div class="form-group">
                            <label for="present_dist">Distict :</label>
                            <input type="text" name="present_dist" class="form-control" id="present_dist" value=<?php echo $row["present_dist"]; ?>>
                        </div>
                        <div class="form-group">
                            <label for="present_state">State :</label>
                            <input type="text" name="present_state" class="form-control" id="present_state" value=<?php echo $row["present_state"]; ?>>
                        </div>
                        <div class="form-group">
                            <label for="present_pin_code">Pin code :</label>
                            <input type="text" name="present_pin_code" class="form-control" id="present_pin_code" value=<?php echo $row["present_pincode"]; ?>>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5>Permanent address :</h5><br>


                        <div class="form-group">
                            <label for="permanent_house_no_name">House no/name :</label>
                            <input type="text" name="permanent_house_no_name" class="form-control" id="permanent_house_no_name" value=<?php echo $row["permanent_house_no_name"]; ?>>
                        </div>
                        <div class="form-group">
                            <label for="permanent_post_village">Post and village :</label>
                            <input type="text" name="permanent_post_village" class="form-control" id="permanent_post_village" value=<?php echo $row["permanent_post_village"]; ?>>
                        </div>
                        <div class="form-group">
                            <label for="permanent_dist">Distict :</label>
                            <input type="text" name="permanent_dist" class="form-control" id="permanent_dist" value=<?php echo $row["permanent_dist"]; ?>>
                        </div>
                        <div class="form-group">
                            <label for="permanent_state">State :</label>
                            <input type="text" name="permanent_state" class="form-control" id="permanent_state" value=<?php echo $row["permanent_state"]; ?>>
                        </div>
                        <div class="form-group">
                            <label for="permanent_pin_code">Pin code :</label>
                            <input type="text" name="permanent_pin_code" class="form-control" id="permanent_pin_code" value=<?php echo $row["permanent_pin_code"]; ?>>
                        </div>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-success">Update</button>

        </div>

    </div>
</div>


</div>

</div>



<?php
    }

?>








</div>
</div>


<!-- page content end -->
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