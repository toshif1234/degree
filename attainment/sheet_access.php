<?php

// use function PHPSTORM_META\type;

include "../Classes/PHPExcel.php";
    require_once '../config.php';
    error_reporting(0);
    $_SESSION['down'] = 1;
//     ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
    session_start();
    $teach = $_SESSION["username"];
    $q_branch='select faculty_dept from faculty_details where faculty_name="' . $teach . '";';
    $result2=$link->query($q_branch);
    $dept=mysqli_fetch_assoc($result2)['faculty_dept'];
    $php = PHPExcel_IOFactory::createReader("Excel2007");
    $excelFile = $php->load('18CS55_2020-2021.xlsx'); 
    $sub_name = $_POST["sub"];
    $temp1 =  explode(" - ",$sub_name);

    $sub = $temp1[1];
    $subcode = $temp1[0];
    $academic_year = $_POST["acadamic_year"];
    $sem = $_POST["sem"];
    $q_sec = 'select distinct section from students where semester = "' . $sem . '" and branch = "' . $dept . '"';

    $result_sec = $link->query($q_sec);
    $div = '';
    $c_sec = 0;
    foreach($result_sec as $r){
        $div = $div . $r['section'] . ' & ';
    }
    $div = substr($div, 0, -2);
    $writer = PHPExcel_IOFactory::createWriter($excelFile, "Excel2007");
    $sheet = $excelFile -> setActiveSheetIndexByName('IA');
    $sheet->getCell('D3')->setValue('Department of ' . $dept);
    $sheet->getCell('K4')->setValue($academic_year);
    $sheet->getCell('V4')->setValue($sem);
    $sheet->getCell('Z4')->setValue($div);
    $sheet->getCell('AF4')->setValue($subcode);
    $sheet->getCell('H5')->setValue($teach);
    $sheet->getCell('Z5')->setValue($sub);
    $q_students= 'select * from students where semester = "' . $sem . '" and branch = "' . $dept . '"';
    // echo $q_students;
    $result_students = $link->query($q_students);
    
    $q_target = 'select * from targets where dept = "' . $dept . '" and batch = "' . $_POST['batch'] . '"';
    $r_target = mysqli_fetch_assoc($link->query($q_target));
    $sheet->getCell('T5')->setValue($r_target['set_target']);
    $sheet->getCell('AT1')->setValue($r_target['f_percentage']);
    $sheet->getCell('AT2')->setValue($r_target['s_percentage']);
    $sheet->getCell('AT3')->setValue($r_target['direct']);
    $sheet->getCell('AT4')->setValue($r_target['indirect']);
    $sheet->getCell('AX1')->setValue($r_target['l1']);
    $sheet->getCell('AX2')->setValue($r_target['l2']);
    $sheet->getCell('AX3')->setValue($r_target['l3']);
    $sheet->getCell('AU8')->setValue($r_target['s_max']);
    
    $i=13;
    foreach($result_students as $r)
    {
        $sheet->getCell('A' . $i)->setValue($r['usn']);
        $sheet->getCell('B' . $i)->setValue($r['fname'] . $r['lname']);
        $q_marks1='select * from ia_marks1 where sem=' . $sem . ' and branch="' . $dept . '" and sub="' . $sub_name . '" and usn="' . $r['usn'] . '"';
        $result1=$link->query($q_marks1);
        // echo $q_marks1;
        $cha=ord('D');
        $r1 = mysqli_fetch_assoc($result1);
        if(!empty($r1['1a']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['1a']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['1b']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['1b']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['1c']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['1c']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['2a']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['2a']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['2b']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['2b']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['2c']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['2c']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['3a']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['3a']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['3b']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['3b']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['3c']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['3c']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['4a']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['4a']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['4b']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['4b']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['4c']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['4c']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        
        
        $q_marks1='select * from ia_marks2 where sem=' . $sem . ' and branch="' . $dept . '" and sub="' . $sub_name . '" and usn="' . $r['usn'] . '"';
        $result1=$link->query($q_marks1);
        $cha=ord('P');
        $r1 = mysqli_fetch_assoc($result1);
        if(!empty($r1['1a']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['1a']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['1b']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['1b']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['1c']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['1c']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['2a']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['2a']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['2b']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['2b']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['2c']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['2c']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['3a']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['3a']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['3b']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['3b']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['3c']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['3c']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['4a']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['4a']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['4b']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['4b']);
        else
            $sheet->getCell(chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['4c']))
        $sheet->getCell(chr($cha) . $i)->setValue($r1['4c']);
        else
            $sheet->getCell('AA' . $i)->setValue('N/A');
        $cha++;



        $q_marks1='select * from ia_marks3 where sem=' . $sem . ' and branch="' . $dept . '" and sub="' . $sub_name . '" and usn="' . $r['usn'] . '"';
        $result1=$link->query($q_marks1);
        $cha=ord('B');
        $r1 = mysqli_fetch_assoc($result1);
        if(!empty($r1['1a']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['1a']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['1b']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['1b']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['1c']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['1c']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['2a']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['2a']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['2b']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['2b']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['2c']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['2c']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['3a']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['3a']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['3b']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['3b']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['3c']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['3c']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['4a']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['4a']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['4b']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['4b']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        if(!empty($r1['4c']))
        $sheet->getCell('A' . chr($cha) . $i)->setValue($r1['4c']);
        else
            $sheet->getCell('A' . chr($cha) . $i)->setValue('N/A');
        $cha++;
        $i++;
    }

    // IA 1 co mapping start
    $q_ia1_co = 'select * from ia1_co_mapping where sub_code = "' . $subcode . '"';
    $r_ia1_co = mysqli_fetch_assoc($link->query($q_ia1_co));
    if(mysqli_num_rows($link->query($q_ia1_co))){
        if($r_ia1_co['1a'] == 'none'){
            $sheet->getCell('D7')->setValue(' ');
        }
        else{
            $sheet->getCell('D7')->setValue($r_ia1_co['1a']);
        }
        if($r_ia1_co['1b'] == 'none'){
            $sheet->getCell('E7')->setValue(' ');
        }
        else{
            $sheet->getCell('E7')->setValue($r_ia1_co['1b']);
        }
        if($r_ia1_co['1c'] == 'none'){
            $sheet->getCell('F7')->setValue(' ');
        }
        else{
            $sheet->getCell('F7')->setValue($r_ia1_co['1c']);
        }

        if($r_ia1_co['2a'] == 'none'){
            $sheet->getCell('G7')->setValue(' ');
        }
        else{
            $sheet->getCell('G7')->setValue($r_ia1_co['2a']);
        }
        if($r_ia1_co['2b'] == 'none'){
            $sheet->getCell('H7')->setValue(' ');
        }
        else{
            $sheet->getCell('H7')->setValue($r_ia1_co['2b']);
        }
        if($r_ia1_co['2c'] == 'none'){
            $sheet->getCell('I7')->setValue(' ');
        }
        else{
            $sheet->getCell('I7')->setValue($r_ia1_co['2c']);
        }

        if($r_ia1_co['3a'] == 'none'){
            $sheet->getCell('J7')->setValue(' ');
        }
        else{
            $sheet->getCell('J7')->setValue($r_ia1_co['3a']);
        }
        if($r_ia1_co['3b'] == 'none'){
            $sheet->getCell('K7')->setValue(' ');
        }
        else{
            $sheet->getCell('K7')->setValue($r_ia1_co['3b']);
        }
        if($r_ia1_co['3c'] == 'none'){
            $sheet->getCell('L7')->setValue(' ');
        }
        else{
            $sheet->getCell('L7')->setValue($r_ia1_co['3c']);
        }

        if($r_ia1_co['4a'] == 'none'){
            $sheet->getCell('M7')->setValue(' ');
        }
        else{
            $sheet->getCell('M7')->setValue($r_ia1_co['4a']);
        }
        if($r_ia1_co['4b'] == 'none'){
            $sheet->getCell('N7')->setValue(' ');
        }
        else{
            $sheet->getCell('N7')->setValue($r_ia1_co['4b']);
        }
        if($r_ia1_co['4c'] == 'none'){
            $sheet->getCell('O7')->setValue(' ');
        }
        else{
            $sheet->getCell('O7')->setValue($r_ia1_co['4c']);
        }
    }
    else{
        $sheet->getCell('D7')->setValue(' ');
        $sheet->getCell('E7')->setValue(' ');
        $sheet->getCell('F7')->setValue(' ');
        $sheet->getCell('G7')->setValue(' ');
        $sheet->getCell('H7')->setValue(' ');
        $sheet->getCell('I7')->setValue(' ');
        $sheet->getCell('J7')->setValue(' ');
        $sheet->getCell('K7')->setValue(' ');
        $sheet->getCell('L7')->setValue(' ');
        $sheet->getCell('M7')->setValue(' ');
        $sheet->getCell('N7')->setValue(' ');
        $sheet->getCell('O7')->setValue(' ');
    }
    // IA 1 co mappig end

    // IA 2 co mapping start
    $q_ia1_co = 'select * from ia2_co_mapping where sub_code = "' . $subcode . '"';
    $r_ia1_co = mysqli_fetch_assoc($link->query($q_ia1_co));
    if(mysqli_num_rows($link->query($q_ia1_co))){
        if($r_ia1_co['1a'] == 'none'){
            $sheet->getCell('P7')->setValue(' ');
        }
        else{
            $sheet->getCell('P7')->setValue($r_ia1_co['1a']);
        }
        if($r_ia1_co['1b'] == 'none'){
            $sheet->getCell('Q7')->setValue(' ');
        }
        else{
            $sheet->getCell('Q7')->setValue($r_ia1_co['1b']);
        }
        if($r_ia1_co['1c'] == 'none'){
            $sheet->getCell('R7')->setValue(' ');
        }
        else{
            $sheet->getCell('R7')->setValue($r_ia1_co['1c']);
        }

        if($r_ia1_co['2a'] == 'none'){
            $sheet->getCell('S7')->setValue(' ');
        }
        else{
            $sheet->getCell('S7')->setValue($r_ia1_co['2a']);
        }
        if($r_ia1_co['2b'] == 'none'){
            $sheet->getCell('T7')->setValue(' ');
        }
        else{
            $sheet->getCell('T7')->setValue($r_ia1_co['2b']);
        }
        if($r_ia1_co['2c'] == 'none'){
            $sheet->getCell('U7')->setValue(' ');
        }
        else{
            $sheet->getCell('U7')->setValue($r_ia1_co['2c']);
        }

        if($r_ia1_co['3a'] == 'none'){
            $sheet->getCell('V7')->setValue(' ');
        }
        else{
            $sheet->getCell('V7')->setValue($r_ia1_co['3a']);
        }
        if($r_ia1_co['3b'] == 'none'){
            $sheet->getCell('W7')->setValue(' ');
        }
        else{
            $sheet->getCell('W7')->setValue($r_ia1_co['3b']);
        }
        if($r_ia1_co['3c'] == 'none'){
            $sheet->getCell('X7')->setValue(' ');
        }
        else{
            $sheet->getCell('X7')->setValue($r_ia1_co['3c']);
        }

        if($r_ia1_co['4a'] == 'none'){
            $sheet->getCell('Y7')->setValue(' ');
        }
        else{
            $sheet->getCell('Y7')->setValue($r_ia1_co['4a']);
        }
        if($r_ia1_co['4b'] == 'none'){
            $sheet->getCell('Z7')->setValue(' ');
        }
        else{
            $sheet->getCell('Z7')->setValue($r_ia1_co['4b']);
        }
        if($r_ia1_co['4c'] == 'none'){
            $sheet->getCell('AA7')->setValue(' ');
        }
        else{
            $sheet->getCell('AA7')->setValue($r_ia1_co['4c']);
        }
    }
    else{
        $sheet->getCell('P7')->setValue(' ');
        $sheet->getCell('Q7')->setValue(' ');
        $sheet->getCell('R7')->setValue(' ');
        $sheet->getCell('S7')->setValue(' ');
        $sheet->getCell('T7')->setValue(' ');
        $sheet->getCell('U7')->setValue(' ');
        $sheet->getCell('V7')->setValue(' ');
        $sheet->getCell('W7')->setValue(' ');
        $sheet->getCell('X7')->setValue(' ');
        $sheet->getCell('Y7')->setValue(' ');
        $sheet->getCell('Z7')->setValue(' ');
        $sheet->getCell('AA7')->setValue(' ');
    }

    // IA 2 co mappig end

    // IA 3 co mapping start
    $q_ia1_co = 'select * from ia3_co_mapping where sub_code = "' . $subcode . '"';
    $r_ia1_co = mysqli_fetch_assoc($link->query($q_ia1_co));
    if(mysqli_num_rows($link->query($q_ia1_co))){
        if($r_ia1_co['1a'] == 'none'){
            $sheet->getCell('AB7')->setValue(' ');
        }
        else{
            $sheet->getCell('AB7')->setValue($r_ia1_co['1a']);
        }
        if($r_ia1_co['1b'] == 'none'){
            $sheet->getCell('AC7')->setValue(' ');
        }
        else{
            $sheet->getCell('AC7')->setValue($r_ia1_co['1b']);
        }
        if($r_ia1_co['1c'] == 'none'){
            $sheet->getCell('AD7')->setValue(' ');
        }
        else{
            $sheet->getCell('AD7')->setValue($r_ia1_co['1c']);
        }
    
        if($r_ia1_co['2a'] == 'none'){
            $sheet->getCell('AE7')->setValue(' ');
        }
        else{
            $sheet->getCell('AE7')->setValue($r_ia1_co['2a']);
        }
        if($r_ia1_co['2b'] == 'none'){
            $sheet->getCell('AF7')->setValue(' ');
        }
        else{
            $sheet->getCell('AF7')->setValue($r_ia1_co['2b']);
        }
        if($r_ia1_co['2c'] == 'none'){
            $sheet->getCell('AG7')->setValue(' ');
        }
        else{
            $sheet->getCell('AG7')->setValue($r_ia1_co['2c']);
        }
    
        if($r_ia1_co['3a'] == 'none'){
            $sheet->getCell('AH7')->setValue(' ');
        }
        else{
            $sheet->getCell('AH7')->setValue($r_ia1_co['3a']);
        }
        if($r_ia1_co['3b'] == 'none'){
            $sheet->getCell('AI7')->setValue(' ');
        }
        else{
            $sheet->getCell('AI7')->setValue($r_ia1_co['3b']);
        }
        if($r_ia1_co['3c'] == 'none'){
            $sheet->getCell('AJ7')->setValue(' ');
        }
        else{
            $sheet->getCell('AJ7')->setValue($r_ia1_co['3c']);
        }
    
        if($r_ia1_co['4a'] == 'none'){
            $sheet->getCell('AK7')->setValue(' ');
        }
        else{
            $sheet->getCell('AK7')->setValue($r_ia1_co['4a']);
        }
        if($r_ia1_co['4b'] == 'none'){
            $sheet->getCell('AL7')->setValue(' ');
        }
        else{
            $sheet->getCell('AL7')->setValue($r_ia1_co['4b']);
        }
        if($r_ia1_co['4c'] == 'none'){
            $sheet->getCell('AM7')->setValue(' ');
        }
        else{
            $sheet->getCell('AA7')->setValue($r_ia1_co['4c']);
        }
    }
    else {
        $sheet->getCell('AB7')->setValue(' ');
        $sheet->getCell('AC7')->setValue(' ');
        $sheet->getCell('AD7')->setValue(' ');
        $sheet->getCell('AE7')->setValue(' ');
        $sheet->getCell('AF7')->setValue(' ');
        $sheet->getCell('AG7')->setValue(' ');
        $sheet->getCell('AH7')->setValue(' ');
        $sheet->getCell('AI7')->setValue(' ');
        $sheet->getCell('AJ7')->setValue(' ');
        $sheet->getCell('AK7')->setValue(' ');
        $sheet->getCell('AL7')->setValue(' ');
        $sheet->getCell('AM7')->setValue(' ');
    }

    // IA 3 co mappig end


    // IA 1 max marks mapping start
    $q_max = 'select * from ia1_max_marks where sub_code = "' . $subcode . '"';
    $r_max = mysqli_fetch_assoc($link->query($q_max));

    if(mysqli_num_rows($link->query($q_max)) > 0){
        $sheet->getCell('D9')->setValue($r_max['1a']);
        $sheet->getCell('E9')->setValue($r_max['1b']);
        $sheet->getCell('F9')->setValue($r_max['1c']);

        $sheet->getCell('G9')->setValue($r_max['2a']);
        $sheet->getCell('H9')->setValue($r_max['2b']);
        $sheet->getCell('I9')->setValue($r_max['2c']);

        $sheet->getCell('J9')->setValue($r_max['3a']);
        $sheet->getCell('K9')->setValue($r_max['3b']);
        $sheet->getCell('L9')->setValue($r_max['3c']);

        $sheet->getCell('M9')->setValue($r_max['4a']);
        $sheet->getCell('N9')->setValue($r_max['4b']);
        $sheet->getCell('O9')->setValue($r_max['4c']);
    }
    else{
        $sheet->getCell('D9')->setValue('0');
        $sheet->getCell('E9')->setValue('0');
        $sheet->getCell('F9')->setValue('0');

        $sheet->getCell('G9')->setValue('0');
        $sheet->getCell('H9')->setValue('0');
        $sheet->getCell('I9')->setValue('0');

        $sheet->getCell('J9')->setValue('0');
        $sheet->getCell('K9')->setValue('0');
        $sheet->getCell('L9')->setValue('0');

        $sheet->getCell('M9')->setValue('0');
        $sheet->getCell('N9')->setValue('0');
        $sheet->getCell('O9')->setValue('0');
    }

    // IA 1 max marks mapping end

    // IA 2 max marks mapping start
    $q_max = 'select * from ia2_max_marks where sub_code = "' . $subcode . '"';
    $r_max = mysqli_fetch_assoc($link->query($q_max));

    if(mysqli_num_rows($link->query($q_max)) > 0){
        $sheet->getCell('P9')->setValue($r_max['1a']);
        $sheet->getCell('Q9')->setValue($r_max['1b']);
        $sheet->getCell('R9')->setValue($r_max['1c']);

        $sheet->getCell('S9')->setValue($r_max['2a']);
        $sheet->getCell('T9')->setValue($r_max['2b']);
        $sheet->getCell('U9')->setValue($r_max['2c']);

        $sheet->getCell('V9')->setValue($r_max['3a']);
        $sheet->getCell('W9')->setValue($r_max['3b']);
        $sheet->getCell('X9')->setValue($r_max['3c']);

        $sheet->getCell('Y9')->setValue($r_max['4a']);
        $sheet->getCell('Z9')->setValue($r_max['4b']);
        $sheet->getCell('AA9')->setValue($r_max['4c']);
    }
    else{
        $sheet->getCell('P9')->setValue('0');
        $sheet->getCell('Q9')->setValue('0');
        $sheet->getCell('R9')->setValue('0');

        $sheet->getCell('S9')->setValue('0');
        $sheet->getCell('T9')->setValue('0');
        $sheet->getCell('U9')->setValue('0');

        $sheet->getCell('V9')->setValue('0');
        $sheet->getCell('W9')->setValue('0');
        $sheet->getCell('X9')->setValue('0');

        $sheet->getCell('Y9')->setValue('0');
        $sheet->getCell('Z9')->setValue('0');
        $sheet->getCell('AA9')->setValue('0');
    }

    // IA 2 max marks mapping end

    // IA 3 max marks mapping start
    $q_max = 'select * from ia3_max_marks where sub_code = "' . $subcode . '"';
    $r_max = mysqli_fetch_assoc($link->query($q_max));

    if(mysqli_num_rows($link->query($q_max)) > 0){
        $sheet->getCell('AB9')->setValue($r_max['1a']);
        $sheet->getCell('AC9')->setValue($r_max['1b']);
        $sheet->getCell('AD9')->setValue($r_max['1c']);

        $sheet->getCell('AE9')->setValue($r_max['2a']);
        $sheet->getCell('AF9')->setValue($r_max['2b']);
        $sheet->getCell('AG9')->setValue($r_max['2c']);

        $sheet->getCell('AH9')->setValue($r_max['3a']);
        $sheet->getCell('AI9')->setValue($r_max['3b']);
        $sheet->getCell('AJ9')->setValue($r_max['3c']);

        $sheet->getCell('AK9')->setValue($r_max['4a']);
        $sheet->getCell('AL9')->setValue($r_max['4b']);
        $sheet->getCell('AM9')->setValue($r_max['4c']);
    }
    else{
        $sheet->getCell('AB9')->setValue('0');
        $sheet->getCell('AC9')->setValue('0');
        $sheet->getCell('AD9')->setValue('0');

        $sheet->getCell('AE9')->setValue('0');
        $sheet->getCell('AF9')->setValue('0');
        $sheet->getCell('AG9')->setValue('0');

        $sheet->getCell('AH9')->setValue('0');
        $sheet->getCell('AI9')->setValue('0');
        $sheet->getCell('AJ9')->setValue('0');

        $sheet->getCell('AK9')->setValue('0');
        $sheet->getCell('AL9')->setValue('0');
        $sheet->getCell('AM9')->setValue('0');
    }

    // IA 3 max marks mapping end
    $q_assignment = 'select * from add_assignment where semester = "' . $sem . '" and branch = "' . $dept . '" and section = "A" and sub_name = "' . $sub_name . '" order by assignment_no';
    $result_assignment = $link->query($q_assignment);
    $r_ass = mysqli_fetch_assoc($result_assignment);
    $co_ass1 = explode(',', $r_ass['co_no']);
    $co_cell_id = 'AN';
    $count_co = 0;
    foreach($co_ass1 as $co){
        $sheet->getCell($co_cell_id . '6')->setValue('A' . $r_ass['assignment_no']);
        $sheet->getCell($co_cell_id . '7')->setValue($co);
        $co_cell_id++;
        $count_co++;
    }
    $q_ass_marks = 'select * from assignment_marks where semester = "' . $sem . '" and branch = "' . $dept . '" and fac_name = "' . $teach . '" and sub_name = "' . $sub_name . '"';
    // echo $q_ass_marks;
    $result_ass_marks = $link->query($q_ass_marks);
    $id_col_count = 13;
    foreach($result_ass_marks as $r_ass){
        $id_marks = 'N';
        for($j = 0; $j < $count_co; $j++){
            $sheet->getCell('A' . $id_marks . $id_col_count)->setValue($r_ass['a1']);
            $id_marks++;
            // echo $id_marks;
        }
        // echo '<br>';
        $id_col_count++;
    }
    $c_loop = 0;
    foreach($result_assignment as $r_ass){
        // echo $c_loop;
        if($c_loop == 0){
            $c_loop++;
            continue;
        }
        else if($count_co < 5){
            $co_ass2 = explode(',', $r_ass['co_no']);
            $cos = array();
            $count_new_ass = 0;
            foreach($co_ass2 as $c){
                if(!(in_array($c, $co_ass1))){
                    $cos[] = $c;
                }
            }
            foreach($cos as $co){
                $sheet->getCell($co_cell_id . '6')->setValue('A' . $r_ass['assignment_no']);
                $sheet->getCell($co_cell_id . '7')->setValue($co);
                $co_cell_id++;
                $count_co++;
                $count_new_ass++;
            }
            $id_col_count = 13;
            // echo $r_ass['assignment_no'];
            foreach($result_ass_marks as $r_ass1){
                $id_marks_new = $id_marks;
                for($j = 0; $j < $count_new_ass; $j++){
                    $sheet->getCell('A' . $id_marks_new . $id_col_count)->setValue($r_ass1['a' . $r_ass['assignment_no']]);
                    $id_marks_new++;
                }
                $id_col_count++;
            }
            $co_ass1 = array_merge($co_ass1, $cos);
            $id_marks = $id_marks_new;
        }
        else{
            break;
        }
    }
    $q_num_stud = 'select * from students where semester = "' . $sem . '" and branch = "' . $dept . '"';
    // echo $q_num_stud;
    $count_num_stud = mysqli_num_rows($link->query($q_num_stud));
    $sheet->getCell('AM4')->setValue($count_num_stud);

    $q_ext = 'select * from marks where sem=' . $sem . ' and branch="' . $dept . '" and sub="' . $sub_name . '" order by usn';
    $result_ext = $link->query($q_ext);
    $ext = 13;
    foreach($result_ext as $r_ext){
        $sheet->getCell('AU' . $ext)->setValue($r_ext['external']);
        $ext++;
    }

    $sheet->freezePane('A13');
    

    $sheet = $excelFile -> setActiveSheetIndexByName('Course End Survey (CES)');
    $q_co_select="select * from co where sub='" . $sub_name . "';";
    // echo $q_co_select . ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
    $result_co_select=$link->query($q_co_select);
    $r_co_select = mysqli_fetch_assoc($result_co_select);
    // echo $r_co_select["co1"] . ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
    if($r_co_select["co1"]!='0')
    {
        $co1=$r_co_select["co1"];
    }
    else{
        $co1 = '';
    }
    // echo $co1 . ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
    $sheet->getCell('B21')->setValue($co1);
    if($r_co_select["co2"]!='0')
    {
        $co1=$r_co_select["co2"];
    }
    else{
        $co1 = '';
    }
    $sheet->getCell('B22')->setValue($co1);
    if($r_co_select["co3"]!='0')
    {
        $co1=$r_co_select["co3"];
    }
    else{
        $co1 = '';
    }
    $sheet->getCell('B23')->setValue($co1);
    if($r_co_select["co4"]!='0')
    {
        $co1=$r_co_select["co4"];
    }
    else{
        $co1 = '';
    }
    $sheet->getCell('B24')->setValue($co1);
    if($r_co_select["co5"]!='0')
    {
        $co1=$r_co_select["co5"];
    }
    else{
        $co1 = '';
    }
    $sheet->getCell('B25')->setValue($co1);
    if($r_co_select["co6"]!='0')
    {
        $co1=$r_co_select["co6"];
    }
    else{
        $co1 = '';
    }
    $sheet->getCell('B26')->setValue($co1);
    
    $sheet = $excelFile -> setActiveSheetIndexByName('PO ATTAINMENT');

    $q_co_po="select * from co_po where sub='" . $sub_name . "' order by co;";
    $result_co_po=$link->query($q_co_po);
    // echo $q_co_po;
    // $r_co_po=mysqli_fetch_assoc($result_co_po);
    $j=9;
    foreach($result_co_po as $r)
    {
        $ch=ord('B');
        // print_r($r);
        for($i=1;$i<13;$i++){
            if($r["po" . $i]=='Moderate')
            {
                $po='2';
            }
            elseif($r["po" . $i]=='High')
            {
                $po='3';
            }
            elseif($r["po" . $i]=='Low')
            {
                $po='1';
            }
            elseif($r["po" . $i]=='N/A')
            {
                $po='';
            }
            // echo $po;
            $sheet->getCell(chr($ch) . $j )->setValue($po);
            $ch++;
        }
        $j++;
    }
    $q_co_pso="select * from co_pso where sub='" . $sub_name . "' order by co;";
    $result_co_pso=$link->query($q_co_pso);
    $j = 9;
    foreach($result_co_pso as $r)
    {
        $ch=ord('N');   
        for($i=1;$i<4;$i++)
        {
            if($r["pso" . $i]=='Moderate')
            {
                $po='2';
            }
            elseif($r["pso" . $i]=='High')
            {
                $po='3';
            }
            elseif($r["pso" . $i]=='Low')
            {
                $po='1';
            }
            elseif($r["pso" . $i]=='N/A')
            {
                $po='';
            }
            // echo $po;
            $sheet->getCell(chr($ch) . $j )->setValue($po);
            $ch++;
        }
        $j++;
    }


    $sheet = $excelFile -> setActiveSheetIndexByName('Course End Survey (CES)');
    $zero = 0;
    $one = 0;
    $two = 0;
    $three = 0;
    $four = 0;

    $q_feedback = 'select * from feedback_response where branch = "' . $dept . '" and sem = "' . $sem . '" and sub = "' . $sub_name . '" and feedback_name = "Course End"';
    $result_feedback = $link->query($q_feedback); 
    $sheet->getCell('B7')->setValue(mysqli_num_rows($result_feedback));
    // echo $q_feedback;
    $cha = ord('B');
    for($i = 4; $i <= 8; $i++){
        $zero = 0;
    $one = 0;
    $two = 0;
    $three = 0;
    $four = 0;
        foreach($result_feedback as $r_f){
            // echo type($r_f['q' . $i]);
            if($r_f['q' . $i] == '1')
                $zero++;
            elseif($r_f['q' . $i] == '2')
                $one++;
            elseif($r_f['q' . $i] == '3')
                $two++;
            elseif($r_f['q' . $i] == '4')
                $three++;
            else
                $four++;
        }
        $sheet->getCell(chr($cha) . '10')->setValue($zero);
        $sheet->getCell(chr($cha) . '11')->setValue($one);
        $sheet->getCell(chr($cha) . '12')->setValue($two);
        $sheet->getCell(chr($cha) . '13')->setValue($three);
        $sheet->getCell(chr($cha) . '14')->setValue($four);
        $cha++;
    }



    if(file_exists('attainment_'  . $dept . '.xlsx')){
        unlink('attainment_'  . $dept . '.xlsx');
    }
    
    $writer->save('attainment_'  . $dept . '.xlsx');

    
    



header("Location: attainment_select.php");
?>