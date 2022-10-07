<?php


include "../Classes/PHPExcel.php";
    require_once '../config.php';
    // error_reporting(0);
    session_start();
    $_SESSION['down'] = 1;
    $php = PHPExcel_IOFactory::createReader("Excel2007");
    $excelFile = $php->load('library.xlsx');
    $writer = PHPExcel_IOFactory::createWriter($excelFile, "Excel2007");
    $sheet = $excelFile -> setActiveSheetIndexByName('Sheet1');
    $q = 'select `bookid`, `title`, `author`, `edition`, `publications`, `sub`,`Alumni_Cont`,`Date_Of_Alumni` from book';
    // echo $q;
    $result = $link->query($q);
    $i = 2;
    foreach($result as $r)
    {
        // echo $r['bookid'];
        $sheet->getCell('A' . $i)->setValue($r['bookid']);
        $sheet->getCell('B' . $i)->setValue($r['title']);
        $sheet->getCell('C' . $i)->setValue($r['author']);
        $sheet->getCell('D' . $i)->setValue($r['edition']);
        $sheet->getCell('E' . $i)->setValue($r['publications']);
        $sheet->getCell('F' . $i)->setValue($r['sub']);
        $sheet->getCell('G' . $i)->setValue($r['Alumni_Cont']);
        $sheet->getCell('H' . $i)->setValue($r['Date_Of_Alumni']);
        


        $i++;
        
    }
    $writer->save('library.xlsx');
    Header("Location: view_books.php");
?>