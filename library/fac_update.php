<?php
include_once("../config.php");
$fac_id=$_POST['fac_id'];
$bookid=$_POST['bookid'];
$issuedate=$_POST['issuedate'];
$returndate=$_POST['returndate'];
$d2 = strtotime("$returndate");   

 $q = "update issue_fac set return_date='$returndate' where bookid='$bookid'; ";
 $x = "update book set flag=0 where bookid='$bookid'; ";
 echo $q;
 $link->query($q);
 $link->query($x);
header("Location: fac_view_issue_books.php");
?>
