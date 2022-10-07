<?php
include_once("../config.php");
$bookid=$_POST['bookid'];
$x = "update book set flag=0 where bookid='$bookid';";
echo $x;
$link->query($x);
$q="delete from issue_student where bookid=\"" . $bookid . "\"";
echo $q;
$link->query($q)
?>
<script> 
 window.location.replace("view_issue_books.php");
</script> -->
