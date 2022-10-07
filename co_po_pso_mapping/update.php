<?php
    require_once "config.php";
    session_start();
    $fid = $_POST['fac_id'];
    $sub = $_POST['sub'];

    for($i = 1; $i <= 6; $i++){
        $po1=$_POST['po1' . $i];
        $po2=$_POST['po2' . $i];
        $po3=$_POST['po3' . $i];
        $po4=$_POST['po4' . $i];
        $po5=$_POST['po5' . $i];
        $po6=$_POST['po6' . $i];
        $po7=$_POST['po7' . $i];
        $po8=$_POST['po8' . $i];
        $po9=$_POST['po9' . $i];
        $po10=$_POST['po10' . $i];
        $po11=$_POST['po11' . $i];
        $po12=$_POST['po12' . $i];
        $co=$_POST['co' . $i];
        
        $qu = 'update co_po set po1="' . $po1 . '", po2="' . $po2 . '",po3="' . $po3 . '",po4="' . $po4 . '",po5 = "' . $po5 . '", po6 = "' . $po6 . '",po7 = "' . $po7 . '",po8 = "' . $po8 . '",po9 = "' . $po9 . '",po10 = "' . $po10 . '",po11 = "' . $po11 . '",po12 ="' . $po12 . '",approval="not approved",to_hod="" where faculty_id ="' . $fid . '" and  sub = "' . $sub . '" and co = "' . $co . '"';
        // echo $qu;
        $con->query($qu);
    }




    

    

    $_SESSION["f_co"] = 1;

    // $qi='select * from co_po where faculty_id = "' . $fid . '" and sub = "' . $sub . '"';
    // $result=$con->query($qi);
    // print_r($result);


        // $q='insert into co_po values("' . $fid . '","' . $sub . '","' . $co . '","' . $po1 . '","' . $po2 . '","' . $po3 . '","' . $po4 . '","' . $po5 . '","' . $po6 . '","' . $po7 . '","' . $po8 . '","' . $po9 . '","' . $po10 . '","' . $po11 . '","' . $po12 . '")';
        
            
            // echo $qu;
            // header("Location: co_po_pso.php#nav-co-po");
        
        header("Location: co_po_pso_viewing.php");
        // echo $q;
    
?>