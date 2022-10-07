<?php

require "../Classes/PHPExcel.php";
require_once "../config.php";
include "../template/fac-auth.php";
// error_reporting(0);
error_reporting(E_ALL ^ E_DEPRECATED);
$_SESSION['full_sub'] = $_POST['sub'];
$_SESSION['sub'] = explode(' - ', $_POST['sub'])[1];

// session_start();
// $_SESSION['semester'] = $_POST['semester'];
// $_SESSION['feedback_name'] = $_POST['feedback_name'];
// $_SESSION['section']=$_POST['section'];
$php = PHPExcel_IOFactory::createReader("Excel2007");
    $phpExcel = $php->load("feedback_format.xlsx");

    $writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
    $sheet = $phpExcel->getActiveSheet();

    // $cha = ord('A');
    // $cha++;
    // $i = 0;

    // $sheet->getCell(chr($cha) . $i)->setValue('1');

    $dept = 'select faculty_dept from faculty_details where faculty_name="' . $_SESSION['username'] . '"';
    $r_dept = mysqli_fetch_assoc($link->query($dept));

if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
    $q_code = 'select sub_code from subjects where sub_name="' . $_SESSION['sub'] . '"';

}
else{
    $q_code = 'select sub_code from subjects_new where sub_name="' . $_SESSION['sub'] . '"';

}
// echo $q_code;
    $r_code = mysqli_fetch_assoc($link->query($q_code));
    if ($_SESSION['section'] == 'ALL') {
        $q = 'select * from feedback_response where feedback_name="Course End" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" order by usn';
    } else {
        $q = 'select * from feedback_response where feedback_name="Course End" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and section="' . $_SESSION['section'] . '"and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" order by usn';
    }
    // echo $q;
    $r = $link->query($q);
    // $q_code='select sub_code from subjects where sub_name="'.$_POST['sub'].'"';
    // $r_code=mysqli_fetch_assoc($link->query($q_code));
    $fac = 'select faculty_name from faculty_mapping where sub_name="' . $_SESSION['sub'] . '"';
    $r_fac = $link->query($fac);
    $q_s = 'select * from co where sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '"';

    $r_q = mysqli_fetch_assoc($link->query($q_s));
    echo $r_code['sub_code'];
    // print_r($r_fac);
    foreach ($r_fac as $r2) {
        $dfac = 'select faculty_dept from faculty_details where faculty_name="' . $r2['faculty_name'] . '"';
        $r_dfac = mysqli_fetch_assoc($link->query($dfac));
        if ($r_dfac['faculty_dept'] == $r_dept['faculty_dept']) {
            $faculty = $r2['faculty_name'];
            break;
        }
    }

    $sheet->getCell('A2')->setValue('Department of ' . $r_dept['faculty_dept']);
    // $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->mergeCells('A2:Q2');
    // $sheet->mergeCells('A1:A2');


    $sheet->getCell('C4')->setValue($_SESSION['sub'] . ' - ' . $r_code['sub_code']);
    // $sheet->getStyle('A3')->getFont()->setBold(true);
    $sheet->getColumnDimension('C')->setWidth(30);
    $sheet->getCell('K4')->setValue($_SESSION['semester'] . ' ' . $_SESSION['section']);
    // $sheet->getStyle('B3')->getFont()->setBold(true);
    // $sheet->getColumnDimension('B')->setWidth(15);
    $sheet->getCell('C5')->setValue($faculty);
    $sheet->getCell('K5')->setValue('Course End');


    $sheet->getColumnDimension('C')->setWidth(30);
    $sheet->getColumnDimension('D')->setWidth(30);
    $sheet->getColumnDimension('E')->setWidth(30);
    $sheet->getColumnDimension('F')->setWidth(30);
    $sheet->getColumnDimension('G')->setWidth(30);
    $sheet->getColumnDimension('I')->setWidth(30);
    $sheet->getColumnDimension('J')->setWidth(30);
    $sheet->getColumnDimension('K')->setWidth(30);
    $sheet->getColumnDimension('H')->setWidth(30);

    $question = 'select * from feedback_all where feedback_name="Course End"';
    $r_questions = mysqli_fetch_assoc($link->query($question));
    $sheet->getRowDimension('6')->setRowHeight(60);
    $cha = ord('C');
    for ($i = 1; $i <= 3; $i++) {
        $cha++;
        // echo chr($cha);
        // $sheet->getColumnDimension(chr(cha))->setWidth(30);
        $sheet->getCell(chr($cha) . '6')->setValue($r_questions['q' . $i]);
    }
    $count = 0;
    for ($i = 1; $i <= 6; $i++) {
        if ($r_q['co' . $i]) {
            $cha++;
            $sheet->getCell(chr($cha) . '6')->setValue($r_q['co' . $i]);
            $count++;
        }
    }

    $c = 7;
    $i = 1;
    foreach ($r as $r1) {
        $cha = ord('A');

        $sheet->getCell(chr($cha++) . $c)->setValue($i);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['usn']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['name']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q1']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q2']);
        $sheet->getCell(chr($cha++) . $c)->setValue($r1['q3']);
        // $sheet->getCell(chr($cha++) .$c)->setValue($r1['q4']);
        // $sheet->getCell(chr($cha++) .$c)->setValue($r1['q5']);
        // $sheet->getCell(chr($cha++) .$c)->setValue($r1['q6']);
        // $sheet->getCell(chr($cha++) .$c)->setValue($r1['q7']);
        // if($r1['q8'])
        // { 
        // $sheet->getCell(chr($cha++) .$c)->setValue($r1['q8']);
        // }

        for ($k = 1; $k <= $count; $k++) {
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q' . ($k + 3)]);
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
        for ($j = 1; $j <= 8; $j++) {
            if ($_SESSION['section'] == 'ALL') {
                $quest = 'select count(name) from feedback_response where feedback_name="Course End" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" and q' . $j . '="' . $i . '"';
            } else {
                $quest = 'select count(name) from feedback_response where feedback_name="Course End" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and section="' . $_SESSION['section'] . '"and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" and q' . $j . '="' . $i . '"';
            }
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
    header("Location: view_ce_feed_admin.php");


