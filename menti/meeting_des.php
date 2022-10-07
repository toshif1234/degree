<?php require_once "config.php";
//  echo $q1;
//session_start();
include("../template/fac-auth.php");

include("../template/sidebar-fac.php");
if($_SESSION['prev'] == 0){
    $_SESSION['batch'] = $batch = $_POST['batch'];
    $_SESSION['branch'] = $branch = $_POST['branch'];
    $_SESSION['prev'] = 1;
}else{

$batch=$_SESSION["batch"];
$branch=$_SESSION["branch"];
}
//$_SESSION["batch"]=$batch;

?>
<div class="container">
<div class="row">
    <table>
        <tr>
           <th> 
<div class="form-group col-md-2"> 
<B><label for="agenda">AGENDA:</label></B>
</div>
</th> 
<th> 
<div class="form-group col-md-2"> 
<B> <label for="usn">USN: </label> </B>
</div>
</th>
<th> 
<div class="form-group col-md-2"> 
<B><label for="date">DATE:</label></B>
</div>
</th>
<th> 
<div class="form-group col-md-2"> 
<B><label for="any_issue">ISSUE:</label></B>
</div>
</th>
<th> 
<div class="form-group col-md-2"> 
<B><label for="Remark">REMARK:</label></B>
</div>
</th>


</tr>
</table>
<?php

 $con = $link;
$q = "SELECT * FROM shedule h,mentor_mapping m,students s where m.fac_name=\"" . $_SESSION["username"] . "\" and m.usn=h.usn and s.usn=h.usn and s.batch=\"" .$batch . "\" and s.branch=\"" . $branch . "\"   and (h.Date=CURRENT_DATE() or h.Date=CURRENT_DATE()+1 or h.Date=CURRENT_DATE()+2 ) ORDER BY h.usn ";
//$q = "SELECT * FROM shedule h,mentor_mapping m,students s where m.fac_name=\"" . $_SESSION["username"] . "\" and m.usn=h.usn and s.usn=h.usn and s.batch=\"" . $_SESSION['semester'] . "\" and s.branch=\"" . $_POST["branch"] . "\" and [h.Date]>= DATEADD(day, DATEDIFF(day,0,getdate()), 0) ORDER BY [Date] ASC";
//$result = mysqli_fetch_assoc($con->query($q)) ;
$result = $con->query($q);
//SELECT  * FROM Events WHERE [Date]>= DATEADD(day, DATEDIFF(day,0,getdate()), 0) ORDER BY [Date] ASC
//$result1=$con->query($result);
//$r=$result['agenda'];

//echo $r;

$con1 = 0;
foreach ($result as $row) {
    $con1++;
   
    ?>

<form action="issue.php" method="post">

<div class="row">


<div class="form-group col-md-2"> 
        
        
       <!--<input type="text" name="agenda" class="form-control" id="agenda">-->
<B><input type="text" name="agenda" class="form-control" id="agenda" value="<?php echo $row['agenda']; ?>" ></B>
                           
        
                       
    </div>

        
     <div class="form-group col-md-2">
                                       
     <input type="text" name="usn" class="form-control" id="usn" value=<?php echo $row["usn"]; ?>  readonly>
    </div>

    <div class="form-group col-md-2">
        
    <input type="text" name="Date" class="form-control" id="Date" value="<?php echo $row['Date']; ?>" readonly>
   </div>

    <div class="form-group col-md-2">
        
    <input type="text" name="any_issue" class="form-control" id="any_issue" value="<?php echo $row["any_issue"]; ?>" >
    </div>

    <div class="form-group col-md-2">
        
    <input type="text" name="Remark" class="form-control" id="Remark" value="<?php echo $row['Remark']; ?>" ></br>

    

   
  </div>

  
  <div class="form-group col-md-1">
     
  <button  style="height:40px;width=50% " type="submit" class="btn btn-success">Submit</button>
 </div>

</div>
</br>
</form> 


<?php
     }
 ?>
 
    </div>
    
    









<?php 
    include_once "../template/footer-admin.php";
?>