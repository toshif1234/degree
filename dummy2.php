<?php
include "Classes/PHPExcel.php";
require_once 'config.php';
$_SESSION['temp_download'] = 1;

$php = PHPExcel_IOFactory::createReader("Excel2007");
$excelFile = $php->load('ia_marks_template.xlsx');
$dept = "Computer Science and Engineering";


$sheet = $excelFile -> getActiveSheet();
$writer = PHPExcel_IOFactory::createWriter($excelFile, "Excel2007");
$que = "SELECT * FROM `ia_marks1` where branch = '" . $dept . "' and sem = '6' and sec = 'A' and sub='18CS644 - Advanced Java and J2EE'";
echo $que;
            $result = $link->query($que);
            print_r($result);
            $i=2;
            foreach($result as $row) {
$sheet->getCell('A' . $i)->setValue($row['adm_no']);
$sheet->getCell('B' . $i)->setValue($row['usn']);
$sheet->getCell('C' . $i)->setValue($row['name']);
$sheet->getCell('D' . $i)->setValue($row['branch']);
$sheet->getCell('E' . $i)->setValue($row['sem']);
$sheet->getCell('F' . $i)->setValue($row['sec']);
$sheet->getCell('G' . $i)->setValue($row['sub']);
$i++;
            }











if(file_exists('template_ia_'  . $dept . '.xlsx')){
  unlink('template_ia_'  . $dept . '.xlsx');
}

$writer->save('template_ia_'  . $dept . '.xlsx');
header()
?>

