<?php
include_once("../config.php");
$bookid=$_POST['bookid'];
$x = "update book set flag=0 where bookid='$bookid';";
$link->query($x);
$q="delete from issue_fac where bookid=\"" . $bookid . "\"";
$link->query($q)
?>
<script> 
 window.location.replace("fac_view_issue_books.php");
</script> -->
