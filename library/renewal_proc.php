<?php
include("../config.php");

$usn=$_POST['USN'];
$bookid=$_POST['bookid'];
$duedate=$_POST['duedate'];
$issuedate=$_POST['issuedate'];
echo $issuedate;
echo "<br>";
$returndate=$_POST['returndate'];
 $issue_date=date('d-m-Y');
 echo $issue_date;
 echo "<br>";
 $fine=0;
 $due_date=date('y-m-d',strtotime($issue_date. ' + 15 days'));
   $due_date = date("d-m-Y",strtotime($due_date));
   echo "<br>";
   echo $due_date;
 $q = "update issue_student set fine=$fine,issue_date='$issue_date',due_date='$due_date' where bookid='$bookid'; ";
 $x = "update book set flag=1 where bookid=$bookid; ";
    $link->query($x);
 echo $q;
 $link->query($q);

header("Location: view_issue_books.php");
?>