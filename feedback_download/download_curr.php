<?php

require "../Classes/PHPExcel.php";
require_once "../config.php";
include "../template/fac-auth.php";
error_reporting(0);
$_SESSION['down'] = 1;

// session_start();
// $_SESSION['semester'] = $_POST['semester'];
// $_SESSION['feedback_name'] = $_POST['feedback_name'];
// $_SESSION['section']=$_POST['section'];

$php = PHPExcel_IOFactory::createReader("Excel2007");
$phpExcel = $php->load("curriculum_template.xlsx");

$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
$sheet = $phpExcel->getActiveSheet();

// $cha = ord('A');
// $cha++;
// $i = 0;

// $sheet->getCell(chr($cha) . $i)->setValue('1');

$dept = 'select faculty_dept from faculty_details where faculty_name="' . $_SESSION['username'] . '"';
$r_dept = mysqli_fetch_assoc($link->query($dept));

if ($_SESSION['section'] == 'ALL') {
    $q = 'select * from feedback_response where feedback_name="Curriculum Feedback" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" order by usn';
} else {
    $q = 'select * from feedback_response where feedback_name="Curriculum Feedback" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and section="' . $_SESSION['section'] . '" order by usn';
} // echo $q;
$r = $link->query($q);


$sheet->getCell('A2')->setValue('Department of ' . $r_dept['faculty_dept']);
$sheet->getStyle('A1')->getFont()->setBold(true);
$sheet->mergeCells('A2:Q2');
// $sheet->mergeCells('A1:A2');


$sheet->getCell('C4')->setValue('Curriculum Feedback');
// $sheet->getStyle('A3')->getFont()->setBold(true);
$sheet->getColumnDimension('C')->setWidth(30);
$sheet->getColumnDimension('D')->setWidth(30);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(30);
$sheet->getColumnDimension('I')->setWidth(30);
$sheet->getColumnDimension('J')->setWidth(30);
$sheet->getColumnDimension('K')->setWidth(30);
$sheet->getColumnDimension('L')->setWidth(30);
$sheet->getColumnDimension('M')->setWidth(30);
$sheet->getColumnDimension('N')->setWidth(30);
$sheet->getColumnDimension('O')->setWidth(30);
$sheet->getColumnDimension('H')->setWidth(30);



// $objPHPExcel->getActiveSheet()->getStyle('D5:E5')->getAlignment()->setWrapText(true); 
$sheet->getCell('K4')->setValue($_SESSION['semester'] . ' ' . $_SESSION['section']);

$question = 'select * from feedback_all where feedback_name="Curriculum Feedback"';
$r_questions = mysqli_fetch_assoc($link->query($question));
$sheet->getRowDimension('5')->setRowHeight(60);

for ($i = 1; $i <= 10; $i++) {
    $cha = ord('C') + $i;
    // $sheet->getColumnDimension(chr(cha))->setWidth(30);
    $sheet->getCell(chr($cha) . '5')->setValue($r_questions['q' . $i]);
}


$c = 6;
$i = 1;
foreach ($r as $r1) {
    $cha = ord('A'); {
        $sheet->getCell(chr($cha++) . $c)->setValue($i);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['usn']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['name']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q1']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q2']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q3']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q4']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q5']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q6']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q7']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q8']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q9']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q10']);
    }
    $c++;
    $i++;
}

$c = $c + 2;
$co = $c;
$sheet->getCell('C' . $co++)->setValue('Strongly Disagree');
$sheet->getCell('C' . $co++)->setValue('Disagree');
$sheet->getCell('C' . $co++)->setValue('Neutral');
$sheet->getCell('C' . $co++)->setValue('Agree');
$sheet->getCell('C' . $co++)->setValue('Strongly Agree');

for ($i = 1; $i <= 5; $i++) {
    $cha = ord('C');
    for ($j = 1; $j <= 10; $j++) {

        $quest = 'select count(name) from feedback_response where feedback_name="Curriculum Feedback" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and section="' . $_SESSION['section'] . '" and q' . $j . '="' . $i . '"';
        $rq1 = mysqli_fetch_assoc($link->query($quest));
        // echo $rq1['count(name)'];
        $sheet->getCell(chr(++$cha) . $c)->setValue($rq1['count(name)']);
    }
    $c++;
}


if (file_exists($_SESSION['feedback_name'] . '.xlsx')) {
    unlink($_SESSION['feedback_name'] . '.xlsx');
}

$writer->save($_SESSION['feedback_name'] . '.xlsx');
// header("Location: select_feedback.php");
header("Location: view_curr_feed_admin.php");
