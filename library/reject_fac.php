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
    $q2 = "delete from request_book_fac where bookid='$bookid';";
    $link->query($q2);
    $x = 'update book set flag = 0 where bookid= "'.$bookid.'"; ';
    $link->query($x);
    $_SESSION['count1'] = 1;
    header("Location: requestmanage.php");
?>