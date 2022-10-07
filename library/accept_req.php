<?php
include("../config.php");
session_start();
$bookid = $_POST['bookid'];
$c1 = "select * from request_book where bookid='$bookid';";
$r = $link->query($c1);
$row = $r -> fetch_assoc();
$issue_date=date('y-m-d');
$due_date=date('y-m-d',strtotime($issue_date. ' + 15 days'));
$bookid = $row['bookid'];
$usn = $row['usn'];
$title = $row['title'];
$author = $row['author'];
$edition = $row['edition'];
$publication = $row['publications'];
$subject = $row['sub'];
$w = "SELECT COUNT(*) FROM issue_student where usn='$usn';";
$x = "select branch from students where usn='$usn';";
$branch= mysqli_fetch_assoc($link->query($x));
$dept = $branch['branch'];
$q = "select * from book where bookid='$bookid';";
$r1 = mysqli_fetch_assoc($link->query($q));
$flag = $r1['flag'];
$r = mysqli_fetch_assoc($link->query($w));
if($r['COUNT(*)']<2){
    $q4 = 'insert into issue_student values("' . $bookid . '", "' . $usn . '","' . $issue_date . '","' . $due_date . '","0","0"," ' . $dept . ' ")';
    $link->query($q4);
    $q2 = "delete from request_book where bookid='$bookid';";
    $link->query($q2);
}
else{
    $q2 = "delete from request_book where bookid='$bookid';";
    echo $q2;
    $link->query($q2);
    echo "Only 2 book for a Person";}
    $_SESSION['count'] = 1;
    header("Location: requestmanage.php");
?>