<?php 
include_once "../template/fac-auth.php";
include_once "../template/sidebar-fac.php";
error_reporting(0);
require_once "../config.php";

$dept = mysqli_fetch_assoc($link->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];
?>


<form action="download_con.php" method="post">
    <div class="form-row">
    <div class="form-group col-md-4">
        <select class="form-control" name="sem" id="">
            <option selected disabled>Select Semester</option>
            <?php 
                $result = $link->query('select distinct(semester) from students');
                foreach($result as $r){
            ?>
                <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group col-md-4 mt-3">
        <select class="form-control" name="sec" id="">
            <option selected disabled>Select Section</option>
            <?php 
                $result = $link->query('select distinct(section) from students');
                foreach($result as $r){
            ?>
                <option value="<?php echo $r['section'] ?>"><?php echo $r['section'] ?></option>
            <?php } ?>
        </select>
        
    </div>
    <div class="form-group col-md-4">
        <select  class="form-control mt-3" name="ia" id="">
        <option selected disabled>Select IA</option>
        <option value="1">IA 1</option>
        <option value="2">IA 2</option>
        <option value="3">IA 3</option>
        <option value="4">Consolidated</option>
    </select>
</div>
    
    <div class="form-group col-md-4">
         <input type="text" hidden name="dept" value="<?php echo $dept ?>" id="">
    <button class="btn btn-primary mt-4" type="submit">Submit</button></div>
    
    </div>
     
    
     
     </div>
       
</form>
<a hidden href="<?php echo '../uploads/ia_report_generated_'  . $dept . '.xlsx' ?>" download id="down"></a>
<?php
    $down = $_SESSION['down'] ?? 0;
    if($down == 1){ ?>
        <script>
            document.getElementById('down').click();
           <?php $_SESSION['down'] = 0; ?>
        </script>
    <?php
    }
?>
















<?php include_once "../template/footer-fac.php"; ?>