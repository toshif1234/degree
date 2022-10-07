<?php
session_start();
require_once '../config.php';
if (isset($_POST['deletedata'])) {
    echo $id = $_POST['delete_id'];
    $q = "delete from exam_schedule_details where si_no ='$id'";

    $link->query($q);
    if ($link->query($q)) {
        $_SESSION['delschedule']="Successfully Deleted"; 
       header("Location: addschedule3.php");
    } else {
        echo "<h1>failed</h1>";
    }
}
?>
<?php
include "../template/footer-fac.php";
?>