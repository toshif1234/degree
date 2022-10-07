<?php
include("../config.php");
session_start();
$usn = $_POST["usn"];
$bookid = $_POST["bookid"];
//echo $bookid;
$x = "select branch from students where usn='$usn';";
$branch= mysqli_fetch_assoc($link->query($x));
$dept = $branch['branch'];
$issue_date=date('d-m-Y');
$due_date=date('y-m-d',strtotime($issue_date. ' + 15 days'));
$due_date = date("d-m-Y",strtotime($due_date));
// echo $due_date;
// $w = "select count(*) from issue_student where usn='$usn' and return_date='0000-00-00';";
$w = "SELECT COUNT(*) as COUNT FROM issue_student where usn='$usn' && return_date='0';";
// echo $w;
$q = "select * from book where bookid='$bookid';";
if(mysqli_num_rows($link->query($q))==0)
{
    // echo "1111111111111";
    $_SESSION['flag'] = 1;
    goto a;
}
// echo $q;
$r1 = mysqli_fetch_assoc($link->query($q));
$flag = $r1['flag'];
$r = mysqli_fetch_assoc($link->query($w));
if($r['COUNT']<2){
$w1 = "select * from book where bookid='$bookid';";
$res1 = $link->query($w1);
foreach($res1 as $a){
    if($a['bookid'] == $bookid && $flag == 0 ){
    $q = 'insert into issue_student values("' . $bookid . '", "' . $usn . '","' . $issue_date . '","' . $due_date . '","0","0"," ' . $dept . ' ")';
    $x = 'update book set flag = 1 where bookid= "'.$bookid.'"; ';
    // echo $x;
    $link->query($q);
    $link->query($x);
    }
    else
    {
        $_SESSION['book'] = 1;
        // echo "11111111";
        goto a;
    }
}
header("Location: view_issue_books.php");
}
else{
    // echo "BOOKS EXCCEDED";
    $_SESSION['count'] = 1;
a: header("Location: issue_books.php");
} 

 
?>