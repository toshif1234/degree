<?php

include("../template/stud_auth.php");
include("../template/student_sidebar.php");

$info = pathinfo($_FILES['file']['name']);
// echo $info;
$ext = $info['extension']; // get the extension of the file
$newname = "newname.".$ext; 
$target = '../posts/temp/'.$newname;

move_uploaded_file($_FILES['file']['tmp_name'], $target);
// echo $_FILES['file']['tmp_name'];
// echo '<img src = "../forum/' .  $newname . '">';

?>


<div class="container">
    <img class="img-thumbnail" width="500" height="600" src = "<?php echo '../posts/temp/' .  $newname ?>">
    <form action="create_post_proc.php" method="post">
        <input name="path" type="text" value="<?php echo '../posts/temp/' .  $newname ?>" hidden>
        <input name="caption" type="text">
        <button class="btn btn-primary" type="submit" >Post</button>
    </form>
</div>

<?php

include("../template/student-footer.php");

?>