<?php
include "../Classes/PHPExcel.php";
require_once '../config.php';
error_reporting(0);
$_SESSION['down'] = 1;
$php = PHPExcel_IOFactory::createReader("Excel2007");
$excelFile = $php->load('Lab attainment Format.xlsx');
$writer = PHPExcel_IOFactory::createWriter($excelFile, "Excel2007");
$sheet = $excelFile->setActiveSheetIndexByName('IA');
$teach = $_SESSION["username"];
$sub_name = $_POST["sub"];
$temp1 =  explode(" - ", $sub_name);

$sub = $temp1[1];
$subcode = $temp1[0];
$academic_year = $_POST["acadamic_year"];
$sem = $_POST["sem"];
if(isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1){
    $q_dept = 'select branch from subjects where sub_code = "' . $subcode . '"';
}
else{
    $q_dept = 'select branch from subjects_new where sub_code = "' . $subcode . '"';

}
$r_dept = mysqli_fetch_assoc($link->query($q_dept));
$dept = mysqli_fetch_assoc($link->query("Select faculty_dept from faculty_details where faculty_name = '" . $_SESSION['username'] . "'"))['faculty_dept'];
$q_sec = 'select distinct section from students where semester = "' . $sem . '" and branch = "' . $dept . '"';

$result_sec = $link->query($q_sec);
$div = '';
// echo '<br>';
// print_r($result_sec);
$c_sec = 0;
foreach ($result_sec as $r) {
    $div = $div . $r['section'] . ' & ';
}
$div = substr($div, 0, -2);
// echo $div;
$sheet->getCell('D3')->setValue('Department of ' . $dept);
$sheet->getCell('K4')->setValue($academic_year);
$sheet->getCell('V4')->setValue($sem);
$sheet->getCell('X4')->setValue($div);
$sheet->getCell('AB4')->setValue($subcode);
$sheet->getCell('H5')->setValue($teach);
$sheet->getCell('X5')->setValue($sub);
$q_students = 'select * from students where semester = "' . $sem . '" and branch = "' . $dept . '" order by usn';
// echo $q_students;
$result_students = $link->query($q_students);
// echo mysqli_num_rows($result_students);
$sheet->getCell('AG4')->setValue(mysqli_num_rows($result_students));
$q_num_lab_exp = 'select * from lab_marks where sub = "' . $sub_name . '" and sem = "' . $sem . '" and branch = "' . $dept . '" order by usn';
$result_marks = $link->query($q_num_lab_exp);
// echo $q_num_lab_exp;
// echo '/////' . mysqli_num_rows($result_marks) . '/////';
$num_exp = mysqli_fetch_assoc($link->query($q_num_lab_exp))['no_exp'];
// echo $num_exp;
$q_co_map = 'select * from lab_co_mapping where dept = "' . $dept . '" and subcode = "' . $sub_name . '"';
$result_co_map = $link->query($q_co_map);
$r_co_map = mysqli_fetch_assoc($result_co_map);

$col = 'D';

for($i = 1; $i <= $num_exp; $i++){
    $arr = explode(',',$r_co_map['e' . $i]);
    foreach($arr as $a){
        $sheet->getCell($col . '8')->setValue($i);
        $sheet->getCell($col . '7')->setValue($a);
        $sheet->getCell($col . '10')->setValue('10');
        $col++;
    }
}
// echo mysqli_fetch_assoc($link->query('select distinct sub from lab_marks'))['sub'];
$row = '14';
foreach($result_students as $r){
    $sheet->getCell('A' . $row)->setValue($r['usn']);
    $sheet->getCell('B' . $row)->setValue($r['fname'] . ' ' . $r['lname']);
    $row ++;
}

$col = 'D';
$row = '14';

foreach($result_marks as $r){
    $col = 'D';
    for ($i = 1; $i <= $num_exp; $i++) {
        $arr = explode(',', $r_co_map['e' . $i]);
        foreach ($arr as $a) {
            $sheet->getCell($col . $row)->setValue($r['exp' . $i]);
            $col ++;
        }
    }
    $row ++;
}

$q_lab = 'select * from lab_marks where sub = "' . $sub_name . '" and branch = "' . $dept . '" and sem = "' . $sem . '"';
$res_lab = $link->query($q_lab);

$row = '14';
foreach($res_lab as $r){
    $col = 'AF';
    for($i = 0; $i < 5; $i++){
        $sheet->getCell($col . $row)->setValue($r['ia_avg']);
        $col++;
    }
    $sheet->getCell('AQ' . $row)->setValue($r['exam_mark']);
    $row++;
}
$q_target = 'select * from targets where dept = "' . $dept . '" and batch = "' . $_POST['batch'] . '"';
$r_target = mysqli_fetch_assoc($link->query($q_target));
$sheet->getCell('T5')->setValue($r_target['set_target']);
$sheet->getCell('AP1')->setValue($r_target['f_percentage']);
$sheet->getCell('AP2')->setValue($r_target['s_percentage']);
$sheet->getCell('AP3')->setValue($r_target['direct']);
$sheet->getCell('AP4')->setValue($r_target['indirect']);
$sheet->getCell('AT1')->setValue($r_target['l1']);
$sheet->getCell('AT2')->setValue($r_target['l2']);
$sheet->getCell('AT3')->setValue($r_target['l3']);
$sheet->getCell('AQ8')->setValue($r_target['s_max']);

$sheet->freezePane('A14');

$sheet = $excelFile->setActiveSheetIndexByName('Course End Survey (CES)');
$q_feedback = 'select * from feedback_response where branch = "' . $dept . '" and sem = "' . $sem . '" and sub = "' . $sub_name . '" and feedback_name = "Course End"';
$res_feed = $link->query($q_feedback);
$sheet->getCell('B7')->setValue(mysqli_num_rows($res_feed));

$cha = ord('B');
for ($i = 4; $i <= 8; $i++) {
    $zero = 0;
    $one = 0;
    $two = 0;
    $three = 0;
    $four = 0;
    foreach ($res_feed as $r_f) {
        // echo type($r_f['q' . $i]);
        if ($r_f['q' . $i] == '1')
            $zero++;
        elseif ($r_f['q' . $i] == '2')
            $one++;
        elseif ($r_f['q' . $i] == '3')
            $two++;
        elseif ($r_f['q' . $i] == '4')
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
$sheet = $excelFile->setActiveSheetIndexByName('PO ATTAINMENT');

$q_co_po = "select * from co_po where sub='" . $sub_name . "' order by co;";
$result_co_po = $link->query($q_co_po);
// echo $q_co_po;
// $r_co_po=mysqli_fetch_assoc($result_co_po);
$j = 9;
foreach ($result_co_po as $r) {
    $ch = ord('B');
    // print_r($r);
    for ($i = 1; $i < 13; $i++) {
        if ($r["po" . $i] == 'Moderate') {
            $po = '2';
        } elseif ($r["po" . $i] == 'High') {
            $po = '3';
        } elseif ($r["po" . $i] == 'Low') {
            $po = '1';
        } elseif ($r["po" . $i] == 'N/A') {
            $po = '';
        }
        // echo $po;
        $sheet->getCell(chr($ch) . $j)->setValue($po);
        $ch++;
    }
    $j++;
}
$q_co_pso = "select * from co_pso where sub='" . $sub_name . "' order by co;";
$result_co_pso = $link->query($q_co_pso);
$j = 9;
foreach ($result_co_pso as $r) {
    $ch = ord('N');
    for ($i = 1; $i < 4; $i++) {
        if ($r["pso" . $i] == 'Moderate') {
            $po = '2';
        } elseif ($r["pso" . $i] == 'High') {
            $po = '3';
        } elseif ($r["pso" . $i] == 'Low') {
            $po = '1';
        } elseif ($r["pso" . $i] == 'N/A') {
            $po = '';
        }
        // echo $po;
        $sheet->getCell(chr($ch) . $j)->setValue($po);
        $ch++;
    }
    $j++;
}



if (file_exists('labattainment_'  . $dept . '.xlsx')) {
    unlink('labattainment_'  . $dept . '.xlsx');
}

$writer->save('labattainment_'  . $dept . '.xlsx');
header("Location: lab_attainment_select.php");
?>
<!-- <a href="labattainment_<?php echo $dept ?>.xlsx" download>Download</a> -->