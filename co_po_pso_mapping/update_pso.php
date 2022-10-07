<?php 
    require_once "config.php";
    session_start();

    $fid = $_POST['fac_id'];
    $sub = $_POST['sub'];

    for($i = 1; $i <= 6; $i++){
        $pso1=$_POST['pso1' . $i];
        $pso2=$_POST['pso2' . $i];
        $pso3=$_POST['pso3' . $i];
        $pso4=$_POST['pso4' . $i];
        $pso5=$_POST['pso5' . $i];
        $pso6=$_POST['pso6' . $i];

        $co = $_POST["co" . $i];

        $qu = 'update co_pso set pso1="' . $pso1 . '",pso2="' . $pso2 . '",pso3="' . $pso3 . '",pso4="' . $pso4 . '",pso5 = "' . $pso5 . '", approval="not approved", to_hod="" where faculty_id ="' . $fid . '" and  sub = "' . $sub . '" and co = "' . $co . '"' ;
        $con->query($qu);
    }


    

    $_SESSION["f_co"] = 1;

    // $q='insert into co_pso values("' . $fid . '","' . $sub . '","' . $co . '","' . $pso1 . '","' . $pso2 . '","' . $pso3 . '","' . $pso4 . '","' . $pso5 . '")';

        
            // echo $qu;
            // header("Location: co_po_pso.php#nav-co-po");
    
    header("Location: co_po_pso_viewing.php");


?>