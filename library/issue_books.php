<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");

if(isset($_SESSION["count"]) && $_SESSION["count"] == 1){
    $_SESSION["count"] = 0;
    echo '<div style="width:50%;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Only 2 Books for an USN</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
}

if(isset($_SESSION["flag"]) && $_SESSION["flag"] == 1){
    $_SESSION["flag"] = 0;
    echo '<div style="width:50%;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Inavlid BookID</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
}

if(isset($_SESSION["book"]) && $_SESSION["book"] == 1){
    $_SESSION["book"] = 0;
    echo '<div style="width:50%;" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Book already Issued</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  
}
?>
<form method="post" action="issue_books_proc.php">
<div class="container">
<div class="row" style="align-items: center;
    justify-content: center;
    align-content: center;
    flex-direction: row;">
    <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="usn">USN:</label>
                        <input type="text" name="usn" class="form-control" id="usn1" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group ">
                    <div >
                        <label for="bookid">Book ID:</label>
                        <input type="text" name="bookid" class="form-control" id="bookid1" onkeyup="this.value = this.value.toUpperCase();" required>
                    </div>
                </div>
            </div>
  <div class="col-md-1 text-center">
  <button type="submit" class="btn btn-primary" >Submit </button></div>
</div>
</form>
<?php
include("../template/footer-admin.php");
?>