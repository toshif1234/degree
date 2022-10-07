<?php
require_once "../config.php";
include("../template/fac-auth.php");
$con=$link;

include("../template/sidebar-fac.php");
?>
<div class="text-center" style="margin-top:30px">
    <a href="../Fac_Leave_Management/earnedleaveapply.php"><button  type="button" class="btn btn-info">Apply New</button></a>
</div>
<?php
include("../template/footer-fac.php");
?>