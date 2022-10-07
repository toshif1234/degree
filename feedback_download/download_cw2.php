<?php

require "../Classes/PHPExcel.php";
require_once "../config.php";
include "../template/fac-auth.php";

$_SESSION['full_sub'] = $_POST['sub'];
$_SESSION['sub'] = explode(' - ', $_POST['sub'])[1];

// session_start();
// $_SESSION['semester'] = $_POST['semester'];
// $_SESSION['feedback_name'] = $_POST['feedback_name'];
// $_SESSION['section']=$_POST['section'];
if ($_SESSION['feedback_name'] == 'course_wise_2') {
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
    $r_code = mysqli_fetch_assoc($link->query($q_code));
    if ($_SESSION['section'] == 'ALL') {
        $q = 'select * from feedback_response where feedback_name="Course wise 2" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" order by usn';
    } else {
        $q = 'select * from feedback_response where feedback_name="Course wise 2" and sem="' . $_SESSION['semester'] . '"and branch="' . $r_dept['faculty_dept'] . '" and section="' . $_SESSION['section'] . '"and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" order by usn';
    } // echo $q;
    $r = $link->query($q);
    // $q_code='select sub_code from subjects where sub_name="'.$_POST['sub'].'"';
    // $r_code=mysqli_fetch_assoc($link->query($q_code));
    $fac = 'select faculty_name from faculty_mapping where sub_name="' . $_SESSION['sub'] . '"';
    $r_fac = $link->query($fac);
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
    $sheet->getCell('K5')->setValue('Course wise 2');


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
    $sheet->getColumnDimension('H')->setWidth(30);

    $sheet->getColumnDimension('P')->setWidth(30);
    $sheet->getColumnDimension('Q')->setWidth(30);
    $sheet->getColumnDimension('R')->setWidth(30);
    $sheet->getColumnDimension('S')->setWidth(30);
    $sheet->getColumnDimension('T')->setWidth(30);
    $sheet->getColumnDimension('U')->setWidth(30);
    $sheet->getColumnDimension('V')->setWidth(30);
    $sheet->getColumnDimension('W')->setWidth(30);
    $sheet->getColumnDimension('X')->setWidth(30);
    $sheet->getColumnDimension('Y')->setWidth(30);
    $sheet->getColumnDimension('Z')->setWidth(30);
    $sheet->getColumnDimension('AA')->setWidth(30);
    $sheet->getColumnDimension('AB')->setWidth(30);
    $sheet->getColumnDimension('AC')->setWidth(30);

    $question = 'select * from feedback_all where feedback_name="Course wise 2"';
    $r_questions = mysqli_fetch_assoc($link->query($question));
    // print_r($r_questions);
    $sheet->getRowDimension('6')->setRowHeight(60);
    $cha = ord('C');
    for ($i = 1; $i <= 23; $i++) {
        $cha++;
        // echo chr($cha);
        // $sheet->getColumnDimension(chr(cha))->setWidth(30);
        $sheet->getCell(chr($cha) . '6')->setValue($r_questions['q' . $i]);
        // echo $r_questions['q'.$i] . '<br>';
    }
    $sheet->getCell('AA6')->setValue($r_questions['q24']);
    $sheet->getCell('AB6')->setValue($r_questions['q25']);
    $sheet->getCell('AC6')->setValue($r_questions['q26']);
    $sheet->getCell('AD6')->setValue($r_questions['q27']);



    // $l=mysqli_num_rows($r);
    $c = 7;
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
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q11']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q12']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q13']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q14']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q15']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q16']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q17']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q18']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q19']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q20']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q21']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q22']);
            $sheet->getCell(chr($cha++) . $c)->setValue($r1['q23']);
            $sheet->getCell('AA' . $c)->setValue($r1['q24']);
            $sheet->getCell('AB' . $c)->setValue($r1['q25']);
            $sheet->getCell('AC' . $c)->setValue($r1['q26']);
            $sheet->getCell('AD' . $c)->setValue($r1['q27']);
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
        for ($j = 1; $j <= 23; $j++) {
            if ($_SESSION['section'] == 'ALL') {
                $quest = 'select count(name) from feedback_response where feedback_name="Course wise 2" and sem="' . $_SESSION['semester'] . '" and branch="' . $r_dept['faculty_dept'] . '" and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" and q' . $j . '="' . $i . '"';
            } else {
                $quest = 'select count(name) from feedback_response where feedback_name="Course wise 2" and sem="' . $_SESSION['semester'] . '" and branch="' . $r_dept['faculty_dept'] . '" and section="' . $_SESSION['section'] . '"and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" and q' . $j . '="' . $i . '"';
            }
            $rq1 = mysqli_fetch_assoc($link->query($quest));
            // echo $rq1['count(name)'];
            $sheet->getCell(chr(++$cha) . $c)->setValue($rq1['count(name)']);
        }
        $cha = ord('A');
        for ($j = 24; $j <= 27; $j++) {
            if ($_SESSION['section'] == 'ALL') {

                $quest = 'select count(name) from feedback_response where feedback_name="Course wise 2" and sem="' . $_SESSION['semester'] . '" and branch="' . $r_dept['faculty_dept'] . '" and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" and q' . $j . '="' . $i . '"';
            } else {
                $quest = 'select count(name) from feedback_response where feedback_name="Course wise 2" and sem="' . $_SESSION['semester'] . '" and branch="' . $r_dept['faculty_dept'] . '" and section="' . $_SESSION['section'] . '"and sub="' . $r_code['sub_code'] . ' - ' . $_SESSION['sub'] . '" and q' . $j . '="' . $i . '"';
            }
            $rq1 = mysqli_fetch_assoc($link->query($quest));
            // echo $rq1['count(name)'];
            $sheet->getCell('A' . chr($cha++) . $c)->setValue($rq1['count(name)']);
        }

        $c++;
    }




    if (file_exists($_SESSION['feedback_name'] . '.xlsx')) {
        unlink($_SESSION['feedback_name'] . '.xlsx');
    }

    $writer->save($_SESSION['feedback_name'] . '.xlsx');

    header("Location: view_feedback_fac_admin.php");
} else {

    $_SESSION['down'] = 1;


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
    } else {
        $q_code = 'select sub_code from subjects_new where sub_name="' . $_SESSION['sub'] . '"';

    }
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
    // echo $r_code['sub_code'];
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
    header("Location: select_feedback.php");
}
