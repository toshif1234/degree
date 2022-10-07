<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

$duty1=$_POST['duty'];

$si1=$_SESSION['si'];

$q="update exam_duty set duty='$duty1' where si_no='$si1'";
$res=$link->query($q);

?>

<script>
    window.location.href = 'ems4.php';
</script>

<?php
include "../template/footer-fac.php";
?>