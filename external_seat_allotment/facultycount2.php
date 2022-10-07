<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
session_start();
if (isset($_POST['sub'])) {
    echo $date1 = $_POST['datee'];
    $session = substr($date1, -2);
    $date2 = substr($date1, 0, 10);
    echo $fcount = $_POST['count'];
    $q = "insert into exam_faculty_count (date,session,count) values('$date2','$session','$fcount')";
    $res = $link->query($q);
    if($res)
    {
        $_SESSION['success1']="Successfully Added";
        
    }
?>
    <script>
        window.location.href = 'facultycount1.php';
    </script>
<?php
}

?>

<?php
include "../template/footer-fac.php";
?>