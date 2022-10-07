<?php
include "../template/admin-auth.php";
include "../template/sidebar-admin.php";

if($_POST['feedback_name']=='Course End')
{
    $q='select sub_name from subjects_new where sem="'.$_POST['semester'].'"';
    $r=$link->query($q);
    
}
?>






<?php

include "../template/footer-admin.php";
?>