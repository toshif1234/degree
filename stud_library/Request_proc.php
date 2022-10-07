<?php
include("../config.php");
session_start();
$usn = $_SESSION['username'];
$bookid = $_POST['bookid1'];
$c1 = "select * from book where bookid='$bookid';";
$r = $link->query($c1);
$row = $r -> fetch_assoc();
$title = $row['title'];
$author = $row['author'];
$edition = $row['edition'];
$publication = $row['publications'];
$subject = $row['sub'];
$date = date('d-m-y');
$w1 = "SELECT COUNT(*) FROM request_book where usn='$usn';";
$r1 = mysqli_fetch_assoc($link->query($w1));
if($r1['COUNT(*)']<2){
    $q = 'INSERT INTO `request_book`(`usn`, `bookid`, `title`, `author`, `edition`, `publications`, `sub`, `date`, `flag`) VALUES("' . $usn . '", "' . $bookid. '","' . $title . '","' . $author . '","' . $edition . '","' . $publication . '","' . $subject . '","' . $date . '","0")';
    echo $q;
    $x = "update book set flag=1 where bookid='$bookid'; ";
    $link->query($q);
    $link->query($x);
    header("Location: Request_books.php");
}
else{
    $_SESSION['count'] = 1;
    header("Location: books_details.php");
}
    
?>