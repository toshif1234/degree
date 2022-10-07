<?php
include_once("../config.php");
    

$bookid=$_POST['bookid1'];
$title=$_POST['title1'];
$author=$_POST['author1'];
$edition=$_POST['edition1'];
$publication=$_POST['publication1'];
$subject=$_POST['subject1'];
$q='update book set title="' . $title . '", author="' . $author . '",edition="' . $edition . '",publications="' . $publication . '",sub="' . $subject . '" where bookid="' . $bookid . '"' ;
echo $q;
$link->query($q);
?>
<script>

window.location.replace("view_books.php");
</script>