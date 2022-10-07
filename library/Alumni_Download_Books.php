<?php


include "../Classes/PHPExcel.php";
    require_once '../config.php';
    // error_reporting(0);
    session_start();
    $_SESSION['down'] = 1;
    $php = PHPExcel_IOFactory::createReader("Excel2007");
    $excelFile = $php->load('Alumni_List.xlsx');
    $writer = PHPExcel_IOFactory::createWriter($excelFile, "Excel2007");
    $sheet = $excelFile -> setActiveSheetIndexByName('Sheet1');
    $q = "select `usn`,`Alumni_Name`, `bookid`, `title`, `author`, `edition`, `publications`,`Date_Of_Alumni`from book where Alumni_Cont='Yes';";
    echo $q;
    $result = $link->query($q);
    $i = 2;
    print_r($result);
    foreach($result as $r)
    {
        echo $r['bookid'];
        echo "<br>";
        $sheet->getCell('A' . $i)->setValue($r['usn']);
        $sheet->getCell('B' . $i)->setValue($r['Alumni_Name']);
        $sheet->getCell('C' . $i)->setValue($r['bookid']);
        $sheet->getCell('D' . $i)->setValue($r['title']);
        $sheet->getCell('E' . $i)->setValue($r['author']);
        $sheet->getCell('F' . $i)->setValue($r['edition']);
        $sheet->getCell('G' . $i)->setValue($r['publications']);
        $sheet->getCell('H' . $i)->setValue($r['Date_Of_Alumni']);
        $i++;
    }
    echo $i;
    $writer->save('Alumni_List.xlsx');
    Header("Location: Alumni_Cont_List.php");
