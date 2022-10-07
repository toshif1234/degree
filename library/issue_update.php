<?php
include_once("../config.php");
session_start();
$usn = $_POST["USN"];
$bookid=$_POST['bookid'];
$duedate=$_POST['duedate'];
$issuedate=$_POST['issuedate'];
$returndate=$_POST['returndate'];
 $d1 = strtotime("$duedate");
 $d2 = strtotime("$returndate"); 

 $sec = $d2 - $d1;
 $flag = 0;
 if($sec>0){
 $fine = $sec/86400;
 $fine=$fine*2;}
 else{
     $fine=0;
 }
 $q = 'update issue_student set fine=" '. $fine. '",return_date="' .$returndate.'" where bookid="' .$bookid.'"; ';

 $q1 = "update book set flag='$flag' where bookid='$bookid';";

 $link->query($q);
 $link->query($q1);
header("Location: view_issue_books.php");
?>
