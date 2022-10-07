<?php
include("../config.php");
session_start();
$fac_id = $_POST["fac_id"];
$bookid = $_POST["bookid"];

$x = "select faculty_dept from faculty_details where faculty_id='$fac_id';";
$branch= mysqli_fetch_assoc($link->query($x));
$dept = $branch['faculty_dept'];
$issue_date=date('d-m-y');

$q = "select * from book where bookid='$bookid';";
if(mysqli_num_rows($link->query($q))==0)
{
    $_SESSION['flag'] = 1;
    goto a;
}
$r1 = mysqli_fetch_assoc($link->query($q));
$flag = $r1['flag'];

$w = "select count(*) from issue_fac where fac_id='$fac_id' and return_date='0000-00-00';";
$r = mysqli_fetch_assoc($link->query($w));
$w1 = "select * from book where bookid='$bookid'";
$r1 = mysqli_fetch_assoc($link->query($w1));
    if( $flag == 0 ){
    $z = 'insert into issue_fac values("' . $bookid . '", "' . $fac_id . '","' . $issue_date . '","0","' . $dept . '")';
    $x = "update book set flag=1 where bookid='$bookid'; ";
    echo $x;
    $link->query($z);
    $link->query($x);
header("Location: fac_view_issue_books.php");
}
else{
    $_SESSION['book'] = 1;
    a: header("Location: fac_issue_books.php");
} 
?>