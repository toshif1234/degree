<?php 
    include_once "../template/admin-auth.php";
    include_once "../template/sidebar-admin.php";
    $q1 = 'select * from faculty_details';
    $res = $link->query($q1);
    $q2 = 'select * from dept_pso';
    $res1 = $link->query($q2);
    $q2 = "select distinct semester from students";
$q3 = "select distinct section from students";
$result1 = $link->query($q2);
$result2 = $link->query($q3);
?>

<div class="container">
<?php
// echo isset($_SESSION["popup"]);
if(isset($_SESSION["popup"]) && $_SESSION["popup"] == 1){
    $_SESSION["popup"] = 0;
    echo '<div style="width:50%;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sucessful</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
}
else if(isset($_SESSION["popup"]) && $_SESSION["popup"] == 2){
    $_SESSION["popup"] = 0;
    echo '<div style="width:50%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>failed</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
}

?>
    <form action="assign_proc.php" method="post">
        <div class="row">
            <div class="col-md-4 mb-4">
                <label for="name" class="">Select CLASS COORDINATOR:</label>
                <select name="name" id="name" class="form-control">
                    <option selected disabled>Select CLASS COORDINATOR</option>
                    <?php
                        foreach($res as $r){
                    ?>
                    <option value="<?php echo $r["faculty_name"] ?>"><?php echo $r["faculty_name"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="branch" class="">Select Course:</label>
                <select name="branch" id="branch" class="form-control">
                    <option selected disabled>Select Course</option>
                    <?php
                        foreach($res1 as $r){
                    ?>
                    <option value="<?php echo $r["dept_name"] ?>"><?php echo $r["dept_name"] ?></option>
                    <?php } ?>
                </select>
            </div>



            <div class="col-md-4">
            <label for="sub">Semester</label>
            <select name="sem" class="form-control" required>
                <option selected value="" disabled> Semester </option>
                <?php
                    
                    foreach($result1 as $r){

                
                echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";

                 }  ?>
              </select>
            </div>


            <div class="col-md-4">
            <label for="sub">Section</label>
            <select name="sec" class="form-control" required>
                <option  selected value="" disabled> Section </option>
                <?php
                    
                    foreach($result2 as $r){

               
                echo "<option value=\"" . $r["section"] . "\"> " . $r["section"] . "</option>";

                 }  ?>
              </select>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <label for="sub" class=""></label>
                <button type="submit" class="btn btn-success mt-4">Assign</button>
            </div>
        </div>
    </form>
</div>


<?php 
    include_once "../template/footer-admin.php";
?>
