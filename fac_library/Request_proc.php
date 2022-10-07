
<?php
include("../config.php");
session_start();
$faculty_id = $_SESSION['username'];
$q1 ="select faculty_id from faculty_details where faculty_name='$faculty_id'";
$r1 = $link->query($q1);
$row1 = $r1 -> fetch_assoc();
$faculty_id = $row1['faculty_id'];
$bookid = $_POST['bookid1'];
$c1 = "select * from book where bookid='$bookid';";
$r = $link->query($c1);
$row = $r -> fetch_assoc();
echo $faculty_id;
$title = $row['title'];
	$author = $row['author'];
	$edition = $row['edition'];
	$publication = $row['publications'];
	$subject = $row['sub'];
	$date = date('d-m-y');
    $q = 'INSERT INTO `request_book_fac`(`fac_id`, `bookid`, `title`, `author`, `edition`, `publications`, `sub`, `date`, `flag`) VALUES("' . $faculty_id . '", "' . $bookid. '","' . $title . '","' . $author . '","' . $edition . '","' . $publication . '","' . $subject . '","' . $date . '","0")';
    $x = "update book set flag=1 where bookid='$bookid'; ";
    echo $q;
    $link->query($q);
    $link->query($x);
    header("Location: Request_books.php");
?>