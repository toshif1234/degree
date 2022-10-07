<?php
include("../config.php");
session_start();
$bookid = $_POST['bookid'];
$c1 = "select * from request_book_fac where bookid='$bookid';";
$r = $link->query($c1);
$row = $r -> fetch_assoc();
$issue_date=date('y-m-d');
$due_date=date('y-m-d',strtotime($issue_date. ' + 15 days'));
$bookid = $row['bookid'];
$faculty_id = $row['fac_id'];
$title = $row['title'];
$author = $row['author'];
$edition = $row['edition'];
$publication = $row['publications'];
$subject = $row['sub'];
$w = "SELECT COUNT(*) FROM issue_fac where fac_id='$faculty_id';";

$x = "select faculty_dept from faculty_details where faculty_id='$faculty_id';";
$branch= mysqli_fetch_assoc($link->query($x));
$dept = $branch['faculty_dept'];

$q = "select * from book where bookid='$bookid';";
$r1 = mysqli_fetch_assoc($link->query($q));
$flag = $r1['flag'];
$r = mysqli_fetch_assoc($link->query($w));
    $q4 = 'insert into issue_fac values("' . $bookid . '", "' . $faculty_id . '","' . $issue_date . '","0"," ' . $dept . ' ")';
    echo $q4;
    $link->query($q4);
    $q2 = "delete from request_book_fac where bookid='$bookid';";
    $link->query($q2);
    $_SESSION['count'] = 1;
    header("Location: requestmanage_fac.php");
?>