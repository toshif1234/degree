<?php
include("../template/stud_auth.php");
include("../template/student_sidebar.php");
?>


<a href="../forum/create_post.php">create post</a>

<br>
<br>


<div class="container">

<?php 
$q1 = 'select * from post';
$res = $link->query($q1);

foreach($r as $res){
?>
<p><?php echo $r["username"] ?></p>
<img class="img-thumbnail" width="500" height="600" src = "<?php echo $r["post_pic"] ?>">
<p><?php echo $r["caption"] ?></p>

<br>
<br>
<?php
}
?>
</div>



<?php
include("../template/student-footer.php");
?>