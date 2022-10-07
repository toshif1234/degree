<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");

$q2="SELECT distinct YEAR(return_date) as year FROM `issue_student` WHERE return_date IS NOT NULL GROUP BY MONTH(return_date)";


$result = $link->query($q2);
// echo $q2;
?>
<form action="Totalfine.php" method="post">
<div class="col-sm-12 col-md-4" class="form-group">
    <label for="exampleFormControlSelect2">Select Year</label>
    <select class="form-control" name="year" id="exampleFormControlSelect2">
    <?php foreach($result as $r){ ?>
      <option value="<?php echo $r['year'] ?>"><?php echo $r['year'] ?></option>
      <?php } ?>
      
    </select>

</div>
<div class="mt-4">
            <label for="Date"> </label>
            <button type="Submit" name="Filter" class="btn btn-lg btn-primary" id="Filter">Load</button>
        </div>
        </form>

<?php
include("../template/footer-admin.php");
?>