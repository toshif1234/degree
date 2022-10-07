<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
if (isset($_POST['deletedata'])) {
    $id = $_POST['delete_id'];
    $q1 = "delete from exam_faculty_count where si_no ='$id'";
    $res1 = $link->query($q1);
    $q2 = "update exam_faculty_count set status='unblocked' where si_no ='$si'";
    $res2 = $link->query($q2);
    if($res1)
    {
        $_SESSION['delcount']="Successfully Deleted";
    }
}

?>
<script>
    window.location.href = 'facultycount3.php';
</script>

<?php
include "../template/footer-fac.php";
?>