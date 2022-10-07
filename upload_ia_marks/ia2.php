<?php

    include "../template/fac-auth.php";
    include "../Classes/PHPExcel.php";
    require_once "../config.php";
    $target_path = "../uploads/";
    $target_path = $target_path.basename($_SESSION['username'] . ".xlsx");

    if(move_uploaded_file($_FILES['xl']['tmp_name'],$target_path)){
        $doc_file = $_FILES['xl']['name'];
        
    }
    else{
        echo "error";
    }

    $php = PHPExcel_IOFactory::createReader("Excel2007");
    $excelFile = $php->load('../uploads/'. $_SESSION['username'] . ".xlsx");
    
    $writer = PHPExcel_IOFactory::createWriter($excelFile, "Excel2007");
    $sheet = $excelFile -> getActiveSheet();
    $q_elec = 'select * from subjects_new where sub_name = "' . explode(' - ', $sub)[1] . '"';
    $open = mysqli_fetch_assoc($link->query($q_elec))['sub_id'];
    if($open == '1'){

        $q = 'select * from ia_marks2 a, fac_elec_stud f where a.sem="' . $_SESSION['sem'] . '" and f.usn=a.usn and f.sub="' . $_SESSION['sub'] . '" and f.faculty_name="' . $_SESSION['username'] . '";';
       
    }
    else
    {

    

    $q = 'select * from ia_marks2 where sub="' . $_SESSION["sub"] . '" and branch="' . $_SESSION["branch"] . '" and sem=' . $_SESSION["sem"] . ' and sec="' . $_SESSION["sec"] . '" order by usn';
   
     } $result = $link->query($q);
    // echo $q;
    $row = 2;
    
    foreach($result as $r){
        $v = array();
        for($i = 'B'; $i <= 'T'; $i++){
            $v[] = empty($sheet->getCell($i . $row)->getValue()) ? "NULL" : $sheet->getCell($i . $row)->getValue();
        }
        $link->query("update ia_marks2 set 1a = " . $v[6] . ", 1b = " . $v[7] . ", 1c = " . $v[8] .", 2a = " . $v[9] . ", 2b = " . $v[10] . ", 2c = " . $v[11] . ", 3a = " . $v[12] . ", 3b = " . $v[13] . ", 3c = " . $v[14] . ", 4a = " . $v[15] . ", 4b = " . $v[16] . ", 4c = " . $v[17] . " where usn='" . $v[0] . "' and sem=" . $v[3] . " and branch='" . $v[2] . "' and sec='" . $v[4] . "' and sub='" . $v[5] . "';");
        // echo "update ia_marks1 set 1a = " . $v[6] . ", 1b = " . $v[7] . ", 1c = " . $v[8] .", 2a = " . $v[9] . ", 2b = " . $v[10] . ", 2c = " . $v[11] . ", 3a = " . $v[12] . ", 3b = " . $v[13] . ", 3c = " . $v[14] . ", 4a = " . $v[15] . ", 4b = " . $v[16] . ", 4c = " . $v[17] . " where usn='" . $v[0] . "' and sem=" . $v[3] . " and branch='" . $v[2] . "' and sec='" . $v[4] . "' and sub='" . $v[5] . "';";
        $row ++;
    }
    header("Location: ../IA_Management/ia_marks1.php");


?>