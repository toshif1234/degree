<?php
include("../config.php");
$results_per_page=40;
$q = "select * from book";
$res = $link->query($q);
$nu_res = mysqli_num_rows($res);
$no_of_pages = ceil($nu_res/$results_per_page);
if(!isset($_GET['page'])){
    $page = 1;
}
else{
    $page = $_GET['page'];
}
$this_page_first_res = ($page-1)*$results_per_page;
$sql = "select * from book LIMIT " . $this_page_first_res . ',' . $results_per_page;
$result = $link->query($sql);
while($row = mysqli_fetch_array($result)){
    echo $row['bookid'] . ' ' . $row['title']  . ' ' . $row['author'] . ' ' . $row['edition']  . ' ' . $row['publications']  . ' ' . $row['sub']  . ' ' . $row['Alumni_Cont']  . ' ' . $row['Date_Of_Alumni'] . '<br>';
}
for( $page = 1;$page<=$no_of_pages;$page++){
    echo '<a href="page.php?page=' . $page . '">' . $page . '</a>';
}
?>