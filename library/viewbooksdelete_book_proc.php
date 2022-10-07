
<?php
include_once("../config.php");
$bookid=$_POST['bookid'];
$q="delete from book where bookid=\"" . $bookid . "\"";
$link->query($q)
?>
<script>
window.location.replace("view_books.php");
</script>
