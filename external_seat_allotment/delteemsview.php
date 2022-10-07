<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

$si = $_GET['si'];

$q1 = "delete from exam_arrear_details where si_no ='$si'";
$res1 = $link->query($q1);
?>
<script>
    window.location.href = 'emsviewarr3.php';
</script>

<?php
include "../template/footer-fac.php";
?>