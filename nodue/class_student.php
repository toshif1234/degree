<?php

require_once "../config.php";
//session_start();
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
if($_SESSION['prev'] == 0){
    
    $_SESSION['branch'] = $branch = $_POST['branch'];
    $_SESSION['sem'] = $sem = $_POST['sem'];
    $_SESSION['sec'] = $sec = $_POST['sec'];
    $_SESSION['prev'] = 1;
}else{


$branch=$_SESSION["branch"];
$sem=$_SESSION["sem"];
$sec=$_SESSION["sec"];

}



// $sub_only = explode(' - ', $sub);

// $q_e = 'select elective from subjects where sub_name ="' . $sub_only[1] . '"';
// $result_e = $link->query($q_e);

// $r_e = mysqli_fetch_assoc($result_e);




//if($r_e['elective'] == 0){
$q="select adm_no,usn,fname,mname,lname from students where branch=\"" . $branch . "\" and semester=\"" . $sem . "\" and section=\"" . $sec . "\"";
//}
// else{
//     $q = "select * from students s, elective_maping e where s.branch = \"" . $branch . "\" and s.section = \"" . $sec . "\" and s.semester = \"" . $sem . "\" and s.usn = e.usn and e.sub_name = \"" . $sub . "\"";
//     // $q="select adm_no,usn,fname,mname,lname from students where branch=\"" . $branch . "\" and semester=\"" . $sem . "\" and section=\"" . $sec . "\";";
// }
// echo $q;
$r = $link->query($q);

// $fac_branch = mysqli_fetch_assoc($link->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];

//                                         if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
//                                             $qt = "select a.sub_name, a.sub_code, a.lab from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
//                                         } else {
//                                             $qt = "select a.sub_name, a.sub_code, a.sub_id from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name  and a.branch = \"" . $fac_branch . "\"";
//                                         }
//                                         $resultst = $link->query($qt);

foreach($r as $result){
    $sub = "class cordinator";
$q5 = "SELECT usn,subj from nodue where usn='" . $result["usn"] .  "'and subj='" . $sub . "'";
$result6 = $link->query($q5);





if(mysqli_num_rows($result6)){

      

}
else{


    $content = "PENDING";
    
    $cont = "class cordinator";
    

        
    //$q3="INSERT INTO `nodue`( `usn` ,`name`,`subj`,`due`) VALUES ('" . $result["usn"] .  "','" . $result["fname"] .  "','" . $sub . "','" . $content . "');";
    $q4="INSERT INTO `nodue`( `usn` ,`name`,`subj`,`sem`,`sec`,`due`) VALUES ('" . $result["usn"] .  "','" . $result["fname"] .  "','" . $cont . "','" . $sem . "','" . $sec . "','" . $content . "');";
    /// echo $q3;
    
     try {

       // $result2=$link->query($q3);
        $result10=$link->query($q4);
        
    
     } 
     catch (Exception $e) {
       
       
        

     }
     
   
}







}




    
    // echo $_SESSION["temp"];

    // $q5="update attendance set " . $date1 . "_" . $period . "=1 where sem=\"" . $sem . "\" and section=\"" . $sec . "\"and subject=\"" . $sub . "\" and branch=\"" . $branch . "\";";
    //         // echo $q5;
    //         $link->query($q5);
    
    





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
                <h3 class="mb-5"> NO DUE </h3>
                <!-- table -->
                
                    

 
<div class="container">
    <div class="row">
        
            
      
                
                
        
            

        
            <table class="table table-hover mt-4">
            <thead>
                    <tr>
                       
                        <th scope="col" style="width: 250px;">USN</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Status</th>
                        <!--<th scope="col" style="width: 30px;">
                        <input type="checkbox" name="" id="check-all" onchange="checkall(this.value)">
                        </th>-->

                        <th scope="col">Submit</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                    <?php
                    $sub= "Class cordinator";
                    $q5 = "SELECT * from nodue where subj='" . $sub . "' and sec='" . $sec . "' and sem='" . $sem . "'";
                    $result6 = $link->query($q5);
                    $con1 = 0;
                     foreach($result6 as $r){ 
                        $con1++;


                        
                        ?>
                         
                        
                        <form action="arrange2.php" method="post">
                        <td><input type="text" name="usn" class="form-control" id="usn" value="<?php echo $r["usn"]; ?>"  readonly></td>
                        <!-- <th scope="row"><input type="checkbox" style="width: 30px;"></th> -->
                        <!-- <td style="width: 30px;"></td> -->
                        <td><input type="text" name="fname" class="form-control" id="fname" value="<?php echo $r["name"]; ?>"  readonly></td>
                        <!-- <td><input type="text" name="lname" class="form-control" id="lanme" value="<?php echo $r["lname"]; ?>" readonly></td> -->
                       
                        <td><input type ="text" name= "sub" class="form-control" id="sub_name" value="<?php echo $sub; ?>" readonly></td>
                       
                 
                        
                <td>
                     <select id="id" name="id" >
                     
                   
                     <option selected  value="<?php echo $r["due"]?>" disabled><?php echo $r["due"]?></option>
                
                        <option value="PENDING">PENDING</option>
                        <option value="COMPLETED">COMPLETED</option>
                       

            
</select>
</td> 

                        <td><button class="btn btn-primary btn-sm"  type="submit">SAVE</button></td>
                        </form>
                    </tr>
                   
                    <?php   } ?>
                </tbody>
            </table>
        
    </div>
</div>
                   
            </div>
            <!-- page content end -->
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