<?php 
    include_once "../template/admin-auth.php";
    include_once "../template/sidebar-admin.php";
    $q1 = 'select * from faculty_details';
    $res = $link->query($q1);
    $q2 = 'select * from dept_pso';
    $res1 = $link->query($q2);

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
    <form action="assign_proc1.php" method="post">
        <div class="row">
            <div class="col-md-4 mb-4">
                <label for="name" class="">Select UG COORDINATOR:</label>
                <select name="name" id="name" class="form-control">
                    <option selected disabled>Select UG COORDINATOR</option>
                    <?php
                        foreach($res as $r){
                    ?>
                    <option value="<?php echo $r["faculty_name"] ?>"><?php echo $r["faculty_name"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="branch" class="">Select Branch:</label>
                <select name="branch" id="branch" class="form-control">
                    <option selected disabled>Select Branch</option>
                    <?php
                        foreach($res1 as $r){
                    ?>
                    <option value="<?php echo $r["dept_name"] ?>"><?php echo $r["dept_name"] ?></option>
                    <?php } ?>
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
