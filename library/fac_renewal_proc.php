<?php
include("../config.php");

$fac_id=$_POST['fac_id'];
$bookid=$_POST['bookid'];
$issuedate=$_POST['issuedate'];
$returndate=$_POST['returndate'];
 $issue_date=date('y-m-d');

 $q = "update issue_fac set issue_date='$issue_date' where bookid=$bookid; ";
 $x = "update book set flag=1 where bookid=$bookid; ";
    $link->query($x);
 echo $q;
 $link->query($q);

header("Location: fac_view_issue_books.php");
?>