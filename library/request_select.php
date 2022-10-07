<?php
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");
?>
<div class="row">
     <form action="requestmanage.php" method="post">
            <div class="mb-3 col-md-6">
                    <button type="submit" class="btn btn-secondary">Student_Request</button>

            </div>
    </form>
    <form action="requestmanage_fac.php" method="post">
            <div class="mb-1 col-md-3">
                    <button type="submit" class="btn btn-secondary">Faculty_Request</button>
            </div>
    </form>
</div>
    <?php
include("../template/footer-admin.php");
?>