<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");

if(isset($_SESSION["flag"]) && $_SESSION["flag"] == 1){
    $_SESSION["flag"] = 0;
    echo '<div style="width:50%;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Sucessful</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
}
?>
<form method="post" action="add_books.php">
<div class="col-sm-12 col-md-4" class="form-group">
    <label for="exampleFormControlSelect2">Alumni Contribution</label>
    <select class="form-control" name="alumni_cont" id="exampleFormControlSelect2">
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>
</div>
<br>
<div class="col-sm-12 col-md-4">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
<?php
include("../template/footer-admin.php");
?>