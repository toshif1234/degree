<?php

require_once '../config.php';
$workshop_id = $_POST["workshop_id"];
$q = "delete from faculty_workshop_details where workshop_id = \"" . $workshop_id . "\"";
echo $q;
if($link->query($q))
{
    header("Location:faculty_login_profile_view.php");
}
else {
    echo "deletion failed";
}

?>