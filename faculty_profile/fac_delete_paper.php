<?php

require_once '../config.php';
$ppr_id = $_POST["paper_id"];
$q = "delete from faculty_ppr_details where paper_id = \"" . $ppr_id . "\"";
echo $q;
if($link->query($q))
{
    header("Location:faculty_login_profile_view.php");
}
else {
    echo "deletion failed";
}

?>