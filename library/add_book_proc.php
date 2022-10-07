<?php
include("../config.php");
session_start();
$alumni_cont = $_POST['alumni_cont'] ?? $_SESSION['alumni_cont'];
$_SESSION['alumni_cont'] = $alumni_cont;
// $bookid = $_POST['bookid'];
$title = $_POST['title'];
$author = $_POST['author'];
$edition = $_POST['edition'];
$publication = $_POST['publication'];
$subject = $_POST['subject'];
$alumni_cont = $_SESSION['alumni_cont'];
$date_of_alumni = $_POST['Date'];
$USN = $_POST['usn'];
$Alumni_Name = $_POST['Alumni_name'];
$dept = $_POST['dept'];
$w = 'select * from book';
$res1 = $link->query($w);
// foreach($res1 as $a){
//     if($a['bookid'] == $bookid){
//         $_SESSION["exist_book"] = 1;
//         header("Location: add_books.php");
// }
// }
$dept_id = array(
    'Computer Science and Engineering' => 'CS',
    'Information Science and Engineering' => 'ISE',
    'Electronics and Communication Engineering' => 'EC',
    'Civil Engineering' => 'CV',
    'Mechanical Engineering' => 'ME',
    'Artificial Intelligence and Machine Learning' => 'AIML'
  );
$w = 'select max(bookid) as bookid, dept from book where dept="' . $dept . '" order by bookid';
$result_bookid = $link->query($w);
$bookid_max = mysqli_fetch_assoc($result_bookid);
$bookid_id = $bookid_max['bookid'];
if($bookid_id == ""){
    echo "1";
    $bookid = $dept_id[$dept] . "001";

}
else
{
    $de = $dept_id[$bookid_max['dept']];
    $bookid = explode($de,$bookid_id);
    print_r($bookid);
    $bookid[0] = $de;
    $bookid[1]++;  
    $bookid = implode("",$bookid);
}
echo $bookid;
echo $w;
// $bookid_dept = mysqli_fetch_assoc($result_bookid)['branch'];
// print_r($bookid_id);
// echo $dept_id[$bookid_dept];

// print_r($book);
// echo $book1;

// {
    // echo $w;
    $q = 'insert into book values("' . $bookid . '", "' . $title . '","' . $author . '","' . $edition . '", "' . $publication . '","' . $subject . '",0,"' . $alumni_cont . '","' . $date_of_alumni . '","'. $dept .'","' . $USN . '","' . $Alumni_Name . '")';
    // echo $q;

    if($link->query($q))
    {
        $_SESSION['flag'] = 1;
        // header("Location: add_books.php");
    }
// }
header("Location: add_books_main.php");
?>