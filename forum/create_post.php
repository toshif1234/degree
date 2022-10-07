<?php
include("../template/stud_auth.php");
include("../template/student_sidebar.php");


?>
<div class="container">
<form action="upload.php" method="post" enctype="multipart/form-data" >
  <input type="file" name="file" id="fileToUpload" accept="image/png, image/jpg, image/jpeg, image/gif">
  <input type="submit" value="Upload Image" name="submit">
</form>



</div>

<script>
    const actualBtn = document.getElementById('actual-btn');

    const fileChosen = document.getElementById('file-chosen');

    actualBtn.addEventListener('change', function() {
        fileChosen.textContent = this.files[0].name
    })
</script>

<?php 
include("../template/student-footer.php");

?>