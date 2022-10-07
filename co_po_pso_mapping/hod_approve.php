<?php
    require_once "config.php";
    session_start();

    $fac_id = $_POST["fac_id"];
    $sub = $_POST["sub"];
    $hod = $_POST["hod_select"];

    $_SESSION["f_co"] = 1;

    $p = $_POST["p"];

    if($p == "po")
        $q = 'update co_po set to_hod = "' . $hod . '", approval = "waiting" where faculty_id="' . $fac_id . '" and sub="' . $sub . '"';
    // echo $q;
    else if($p == "pso")
        $q = 'update co_pso set to_hod = "' . $hod . '", approval = "waiting" where faculty_id="' . $fac_id . '" and sub="' . $sub . '"';

    $con -> query($q);

    header("Location: co_po_pso_viewing.php");

?>