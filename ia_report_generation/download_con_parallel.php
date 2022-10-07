<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require "../Classes/PHPExcel.php";
error_reporting(0);
require_once "../config.php";
session_start();
$ia="ia" . $_POST["ia"];
$_SESSION['down'] = 1;
// echo $ia;
$php = PHPExcel_IOFactory::createReader("Excel2007");
$phpExcel=$php->load("../uploads/Consolidated_ia_report.xlsx");
$phpExcel->getDefaultStyle()->getFont()->setSize(13);
$phpExcel ->getProperties()->setTitle("IA" . $_POST['ia']);
$phpExcel ->getProperties()->setCreator("Alva's ERP team");
$phpExcel ->getProperties()->setDescription("IA MARKS");

$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
$sheet = $phpExcel->getActiveSheet(); 

$sheet->getCell('A3')->setValue('SEMESTER ' . $_POST['sem'] . $_POST['sec'] . ', IA ' . $_POST['ia'] . ' REPORT');


// $sheet->getCell('A1')->setValue('Branch: ' . $_POST['dept']);
// $sheet->mergeCells("A1:F1");

// $sheet->getCell('A2')->setValue('Internal ' . $_POST['ia'] . ' Marks');
// $sheet->mergeCells("A2:H2");

$sheet->getCell('A5')->setValue('SL.NO');
$sheet->getStyle('A5')->getFont()->setBold(true);
$sheet->getColumnDimension('A')->setWidth(15);
$sheet->getCell('B5')->setValue('USN');
$sheet->getStyle('B5')->getFont()->setBold(true);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getCell('C5')->setValue('Name');
$sheet->getStyle('C5')->getFont()->setBold(true);
$sheet->getColumnDimension('C')->setWidth(30);

$sheet->mergeCells('A5:A6');
$sheet->mergeCells('B5:B6');
$sheet->mergeCells('C5:C6');

$q = 'select distinct sub from ia_marks' . $_POST['ia'] . ' where sem = "' . $_POST['sem'] . '" and branch = "' . $_POST['dept'] . '" and sec = "' . $_POST['sec'] . '" order by sub';
$result = $link->query($q);
$num_subs = mysqli_num_rows($result);
$i = ord('D');

      // echo $_SESSION["branch"];

    
    



// $sub_array = array();

foreach ($result as $r) {
    $sheet->getCell(chr($i) . '5')->setValue($r["sub"]);
    $sheet->mergeCells(chr($i) . '5:' . chr($i+1) . '5');
    $sheet->getCell(chr($i) . '6')->setValue('Marks');
    $sheet->getCell(chr($i+1) . '6')->setValue('Att %');
    $sheet->getStyle(chr($i) . '5:' . chr($i+1) . '5')->getFont()->setBold(true);
    $sheet->getColumnDimension(chr($i))->setWidth(strlen($r['sub'])/2);
    $sheet->getColumnDimension(chr($i+1))->setWidth(strlen($r['sub'])/2);

    $i +=2;
}

$q1 = 'select * from students where semester = "' . $_POST['sem'] . '" and branch = "' . $_POST['dept'] . '" and section = "' . $_POST['sec'] . '"';
$result1 = $link->query($q1);
$row=mysqli_num_rows($result1);
// echo $row;
$co = 7;
$c=0;

foreach($result1 as $r1){
    $count_sub = 0;
    $cha = ord('D');
    
    // $q2 = 'select ia' . $_POST["ia"] . ',att_avg from marks where usn = "' . $r1['usn'] . '" and branch = "' . $_POST['dept'] . '" order by sub';
    // echo $q2 . '<br>';
    $c++;
    // $result2 = $link->query($q2);
    // $num_subs2 = mysqli_num_rows($result2);
    $sheet->getCell('A' . $co)->setValue($c);
    $sheet->getCell('B' . $co)->setValue($r1["usn"]);
    $sheet->getCell('C' . $co)->setValue($r1["fname"] . ' ' . $r1['lname']);
    
    foreach($result as $r2){
        $q_sub_marks = 'select ia' . $_POST["ia"] . ',att_avg from marks where usn = "' . $r1['usn'] . '" and branch = "' . $_POST['dept'] . '" and sub = "' . $r2['sub'] . '"';
        $result_sub_marks = $link->query($q_sub_marks);
        if(mysqli_num_rows($result_sub_marks) == 0){
            $count_sub+=1;
            $sheet->getCell(chr($cha) . $co)->setValue("x");
            $cha += 1;
            $sheet->getCell(chr($cha) . $co)->setValue("x");
            $cha += 1;
        }
        else{
            $r22 = mysqli_fetch_assoc($result_sub_marks);
            $count_sub+=1;
            $sheet->getCell(chr($cha) . $co)->setValue($r22["ia" . $_POST['ia']]);
            $cha += 1;
            $sheet->getCell(chr($cha) . $co)->setValue($r22["att_avg"]);
            $cha += 1;
        }
    }
    $co += 1;
}
$co+=1;
$sheet->getCell('A' . $co)->setValue('# of Students Absent');
$sheet->getStyle('A' . $co)->getFont()->setBold(true);
$sheet->mergeCells('A' . $co . ':C' . $co);
$result = $link->query($q);
$cha = ord('D');
foreach($result as $r){
$q3="select COUNT(att) as att from ia_marks" . $_POST["ia"] . ' where sem = "' . $_POST['sem'] . '" and branch = "' . $_POST['dept'] . '" and att=0 and sub="' . $r['sub'] . '" and sec = "' . $_POST['sec'] . '"';
// echo $q3;
$result3=$link->query($q3);
$r5= mysqli_fetch_assoc($result3);
// print_r($r5);
$sheet->getCell(chr($cha) . $co)->setValue($r5['att']);
$cha+=2;

}
$c=$co;
for($j=0;$j<8;$j++)
{
    $cha = ord('D');
    $cha1=ord('E');
    // $co1=$co+8;
    for($i=0;$i<$count_sub;$i++)
    {
        $sheet->mergeCells(chr($cha) . $c . ':' . chr($cha1) . $c);
        $cha+=2;
        $cha1+=2;
        
    }
    $c+=1;
}
$co+=1;
$sheet->getCell('A' . $co)->setValue('# of Students Scored Less than or equal to 12');
$sheet->getStyle('A' . $co)->getFont()->setBold(true);
$sheet->mergeCells('A' . $co . ':C' . $co);
$cha = ord('D');
foreach($result as $r){
$q3="select COUNT(" . $ia . ') as mark from marks where sem = "' . $_POST['sem'] . '" and branch = "' . $_POST['dept'] . '" and ' . $ia . '<=12 and sub="' . $r['sub'] . '" and sec = "' . $_POST['sec'] . '"';
// echo $q3;
$result3=$link->query($q3);
$r5= mysqli_fetch_assoc($result3);
// print_r($r5);
$sheet->getCell(chr($cha) . $co)->setValue($r5['mark']);
$cha+=2;

}
$co+=1;
$sheet->getCell('A' . $co)->setValue('# of Students Scored between 13 and 20');
$sheet->getStyle('A' . $co)->getFont()->setBold(true);
$sheet->mergeCells('A' . $co . ':C' . $co);
$cha = ord('D');
foreach($result as $r){
    
$q3="select COUNT(" . $ia . ') as mark from marks where sem = "' . $_POST['sem'] . '" and branch = "' . $_POST['dept'] . '" and ' . $ia . ' BETWEEN 12 AND 19  and sub="' . $r['sub'] . '" and sec = "' . $_POST['sec'] . '"';
// echo $q3;
$result3=$link->query($q3);
$r5= mysqli_fetch_assoc($result3);
// print_r($r5);
$sheet->getCell(chr($cha) . $co)->setValue($r5['mark']);
$cha+=2;

}
$co+=1;
$sheet->getCell('A' . $co)->setValue('# of Students Scored above 20');
$sheet->getStyle('A' . $co)->getFont()->setBold(true);
$sheet->mergeCells('A' . $co . ':C' . $co);
$cha = ord('D');
foreach($result as $r){
    
$q3="select COUNT(" . $ia . ') as mark from marks where sem = "' . $_POST['sem'] . '" and branch = "' . $_POST['dept'] . '" and ' . $ia . '>=20 and sub="' . $r['sub'] . '" and sec = "' . $_POST['sec'] . '"';
// echo $q3;
$result3=$link->query($q3);
$r5= mysqli_fetch_assoc($result3);
// print_r($r5);
$sheet->getCell(chr($cha) . $co)->setValue($r5['mark']);
$cha+=2;

}
$co+=1;
$sheet->getCell('A' . $co)->setValue('# of Students Scored 30');
$sheet->getStyle('A' . $co)->getFont()->setBold(true);
$sheet->mergeCells('A' . $co . ':C' . $co);
$cha = ord('D');
foreach($result as $r){
    
$q3="select COUNT(" . $ia . ') as mark from marks where sem = "' . $_POST['sem'] . '" and branch = "' . $_POST['dept'] . '" and ' . $ia . '=30 and sub="' . $r['sub'] . '" and sec = "' . $_POST['sec'] . '"';
// echo $q3;
$result3=$link->query($q3);
$r5= mysqli_fetch_assoc($result3);
// print_r($r5);
$sheet->getCell(chr($cha) . $co)->setValue($r5['mark']);
$cha+=2;

}
$co+=1;
$sheet->getCell('A' . $co)->setValue('Pass percentage');
$sheet->getStyle('A' . $co)->getFont()->setBold(true);
$sheet->mergeCells('A' . $co . ':C' . $co);
$cha = ord('D');
foreach($result as $r){
$q3="select COUNT(" . $ia . ') as mark from marks where sem = "' . $_POST['sem'] . '" and branch = "' . $_POST['dept'] . '" and ' . $ia . '>=14 and sub="' . $r['sub'] . '" and sec = "' . $_POST['sec'] . '"';
// echo $q3;
$result3=$link->query($q3);
$r5= mysqli_fetch_assoc($result3);
// print_r($r5);
$sheet->getCell(chr($cha) . $co)->setValue(ceil(($r5['mark']/$row)*100));
// echo $r5['mark'];
$cha+=2;

}
$co+=1;
$sheet->getCell('A' . $co)->setValue('Staff Incharge');
$sheet->getStyle('A' . $co)->getFont()->setBold(true);
$sheet->mergeCells('A' . $co . ':C' . $co);
$cha = ord('D');

foreach($result as $r){
    
    $rr=explode(' - ',$r['sub']);
  if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
    $q_elect = 'select * from subjects where sub_name = "' . $rr[1] . '"';
  } else {
    $q_elect = 'select * from subjects_new where sub_name = "' . $rr[1] . '"';

  }
    $result_elect = $link->query($q_elect);
    $elect = mysqli_fetch_assoc($result_elect);
    if($elect['elective'] == 1){
            $q4='select f.faculty_name from faculty_details f,faculty_mapping m where m.faculty_name=f.faculty_name and m.sub_name="' . $rr[1] . '";';
    }
    else{
    $q4='select f.faculty_name from faculty_details f,faculty_mapping m where m.faculty_name=f.faculty_name and m.sub_name="' . $rr[1] . '" and f.faculty_dept="' . $_POST["dept"] . '";';
    }
    $result4=$link->query($q4);
    
    
    // echo $q4;
    $rr1=mysqli_fetch_assoc($result4);
    $sheet->getCell(chr($cha) . $co)->setValue($rr1["faculty_name"]);
    $cha+=2;

}
$co+=1;
$sheet->getCell('A' . $co)->setValue('Staff Signature');
$sheet->getStyle('A' . $co)->getFont()->setBold(true);
$sheet->mergeCells('A' . $co . ':C' . $co);



// $sheet->getColumnDimension('A')->setWidth(15);
if(file_exists('../uploads/ia_report_generated_'  . $_POST['dept'] . '.xlsx')){
    unlink('../uploads/ia_report_generated_'  . $_POST['dept'] . '.xlsx');
}
    
$writer->save('../uploads/ia_report_generated_'  . $_POST['dept'] . '.xlsx');

// $url = '../uploads/ia_report_generated_'  . $_POST['dept'] . '.xlsx';
// $file_name = 'ia_report_generated_'  . $_POST['dept'] . '.xlsx';
// file_put_contents( $file_name,file_get_contents($url));
header("Location: select_semester_parallel.php");
?>



<!-- end about --> 

<!-- <div class="content">
   <div class="loading">
<p>loading</p>
      <span></span>
   </div>
</div>

<style>
@import url("https://fonts.googleapis.com/css?family=Oxygen:700&display=swap");


body {
  margin: 0;
}

.content {
  width: 100%;
  height: 100vh;
  background-color: #171f30;
  display: flex;
  justify-content: center;
  align-items: center;
}
.content .loading {
  width: 80px;
  height: 50px;
  position: relative;
}
.content .loading p {
  top: 0;
  padding: 0;
  margin: 0;
  color: #5389a6;
  font-family: "Oxygen", sans-serif;
  animation: text 3.5s ease both infinite;
  font-size: 12px;
  letter-spacing: 1px;
}
@keyframes text {
  0% {
    letter-spacing: 1px;
    transform: translateX(0px);
  }
  40% {
    letter-spacing: 2px;
    transform: translateX(26px);
  }
  80% {
    letter-spacing: 1px;
    transform: translateX(32px);
  }
  90% {
    letter-spacing: 2px;
    transform: translateX(0px);
  }
  100% {
    letter-spacing: 1px;
    transform: translateX(0px);
  }
}
.content .loading span {
  background-color: #5389a6;
  border-radius: 50px;
  display: block;
  height: 16px;
  width: 16px;
  bottom: 0;
  position: absolute;
  transform: translateX(64px);
  animation: loading 3.5s ease both infinite;
}
.content .loading span:before {
  position: absolute;
  content: "";
  width: 100%;
  height: 100%;
  background-color: #a6dcee;
  border-radius: inherit;
  animation: loading2 3.5s ease both infinite;
}
@keyframes loading {
  0% {
    width: 16px;
    transform: translateX(0px);
  }
  40% {
    width: 100%;
    transform: translateX(0px);
  }
  80% {
    width: 16px;
    transform: translateX(64px);
  }
  90% {
    width: 100%;
    transform: translateX(0px);
  }
  100% {
    width: 16px;
    transform: translateX(0px);
  }
}
@keyframes loading2 {
  0% {
    transform: translateX(0px);
    width: 16px;
  }
  40% {
    transform: translateX(0%);
    width: 80%;
  }
  80% {
    width: 100%;
    transform: translateX(0px);
  }
  90% {
    width: 80%;t
  }
  100% {
    transform: translateX(0px);
    width: 16px;
  }
}</style> -->






