<?php
session_start();
include("../config.php");
// echo $_FILES['path']['name'];
// echo $_SESSION["username"];

$target_path = "../profile_pic/";
$target_path = $target_path.basename($_FILES['path']['name']);
$p1 = 'select * from display_pic where username="' . $_SESSION["username"] . '"';
$res9 = $link->query($p1);

if(move_uploaded_file($_FILES['path']['tmp_name'],$target_path)){
    $doc_file = $_FILES['path']['name'];
    // echo mysqli_num_rows($res9);
    if((mysqli_num_rows($res9)>0)){
        $q = 'UPDATE `display_pic` SET `dp`="' . $target_path . '" WHERE username="' . $_SESSION["username"] . '"';
    }
    else{
        $q = 'INSERT INTO `display_pic`(`username`, `dp`) VALUES ("' . $_SESSION["username"] . '","' . $target_path . '")';
    }
    // echo $q;
    $link->query($q);
    // header("Location :faculty_login_profile_view.php");
    $_SESSION['flag_pic'] = 0;
    echo '<script>window.location.replace("faculty_login_profile_view.php");</script>';
}
else{
    echo "error";
}


?>
