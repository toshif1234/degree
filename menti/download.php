<?php
include "../config.php";
session_start();
require('../fpdf184/fpdf.php');

$branch = $_SESSION["branch"];
$batch = $_SESSION["batch"];

//$result = $link->query('SELECT module,dop_Plan, pending, textbook, dop_exe,complet, textbook FROM `lessonpanl` WHERE branch="' . $branch . '" and sem="' . $sem . '" and subid="' . $sub . '" and section = "' . $sec . '"');
// echo 'SELECT module,dop_Plan, pending, textbook, co, bt_evel FROM `lessonpanl` WHERE branch="Computer Science and Engineering" and sem="7"';
// print_r($result);
// echo 'SELECT module,dop_Plan, pending, textbook, dop_exe,complet, textbook FROM `lessonpanl` WHERE branch="' . $branch . '" and sem="' . $sem . '" and subid="' . $sub . '" and section = "' . $sec . '"';
//$result =$link->query('select * from marks k,mentor_mapping m,students s where s.usn=k.usn and  s.usn=m.usn and s.semester=k.sem and m.usn = k.usn and  s.batch="' . $batch . '" and s.branch="' . $branch . '"');
//$result =$link->query('select * from students s,mentor_mapping m where  m.usn=s.usn and s.branch="' . $branch . '" and s.batch="' . $batch . '" and m.fac_name="' . $_SESSION["username"] . '"');                       
$result =$link->query('select * from students s,mentor_mapping m where m.usn=s.usn and batch="' . $batch . '" and branch="' . $branch . '" and m.fac_name="' . $_SESSION["username"] . '" order by s.usn');
$pdf = new FPDF('L','mm',array(297 ,210 ));
$pdf->AddPage();


// $pdf->Cell(280,10,$result["semester"],0,1,'C');
// $pdf->Ln();
// $pdf->SetFont('Arial','B',20);
// $pdf->Cell(297,10,"IA marks" ,0,1,'C');

$con1 = 0;
                        foreach ($result as $row) {
                            $con1++;

// $pdf->Ln();
// $pdf->Cell(40,9,"" ,0);
// $pdf->Cell(60,9,"Branch:",1,0,"C");
// $pdf->Cell(140,9,$branch,1,0,"C");
$pdf->SetFont('Arial','B',28);
$pdf->Cell(35,7,"" ,0);
$pdf->Image("../asset/img/aiet-logo.png",9,5,30,25);
$pdf->Cell(220,10,"Alva's Institute of Engineering and Technology" ,0,1,'C');
$pdf->Ln();
$pdf->Cell(290,10,$branch,0,1,'C');

$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,9,"" ,0);
$pdf->Cell(60,9,"USN:",1,0,"C");
$pdf->Cell(140,9,$row["usn"],1,0,"C");

$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,9,"" ,0);
$pdf->Cell(60,9,"Name of the Student:",1,0,"C");
$pdf->Cell(140,9,$row["fname"],1,0,"C");

$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,9,"" ,0);
$pdf->Cell(60,9,"sem:",1,0,"C");
$pdf->Cell(140,9,$row["semester"],1,0,"C");



$pdf->Ln();
$pdf->Ln();

$pdf->Cell(35,7,"" ,0);
$pdf->Cell(230,10,"IA Marks" ,0,1,'C');
//$result1 = $link->query('select * from marks k,mentor_mapping m,students s where s.usn=k.usn and  k.usn="'. $row["usn"] .'" and s.semester=k.sem and m.usn = k.usn and k.usn= m.usn  and s.batch="' . $batch . '" and s.branch="' . $branch . '" and m.fac_name="' . $_SESSION["username"] . '" order by k.usn');
//$pdf->SetFont('Arial','$pdf->Cell(22,10,"PO3",1);',12);
$result1=$link->query('select k.external,k.sub,k.ia1,k.ia2,k.ia3,k.att_avg,k.ia_avg,k.total_marks,k.assignment_avg,(k.ia_avg+k.assignment_avg) as tot, (k.ia_avg+k.assignment_avg+k.external) as grand from marks k,mentor_mapping m,students s where s.usn=k.usn and  s.usn=m.usn and s.semester=k.sem and s.batch="' . $batch . '" and s.branch="' . $branch . '" and m.usn = k.usn and k.usn= "'. $row["usn"] .'"  and m.fac_name="' . $_SESSION["username"] . '" order by k.usn');

$pdf->Cell(5,7,"" ,0);
 $pdf->Cell(110,10,"SUB",1);
	$pdf->Cell(18,10,"IA1",1);
 	$pdf->Cell(18,10,"IA2",1);
 	$pdf->Cell(18,10,"IA3",1);
	 $pdf->Cell(18,10,"IA Avg",1);
	 $pdf->Cell(18,10,"Assign",1);
	 $pdf->Cell(18,10,"Atend",1);
	 $pdf->Cell(18,10,"External",1);
	 $pdf->Cell(18,10,"Final",1);
     $pdf->Ln();
$con2=0;
foreach ($result1 as $row1){
 $con2++;

 $pdf->Cell(5,7,"" ,0);
 	$pdf->Cell(110,10,$row1['sub'],1);
 	$pdf->Cell(18,10,$row1['ia1'],1);
 	$pdf->Cell(18,10,$row1['ia2'],1);
 	$pdf->Cell(18,10,$row1['ia3'],1);
	$pdf->Cell(18,10,$row1['ia_avg'],1);
	$pdf->Cell(18,10,$row1['assignment_avg'],1);
	$pdf->Cell(18,10,$row1['att_avg'],1);
	$pdf->Cell(18,10,$row1['external'],1);
	$pdf->Cell(18,10,$row1['grand'],1);
     $pdf->Ln(); 
  
                        
						







}
$pdf->AddPage();


$pdf->Ln();
$pdf->Cell(35,7,"" ,0);
$pdf->Cell(210,10,"MEETING INFORMATIO" ,0,1,'C');


$result2 = $link->query('select * from shedule m,mentor_mapping k,students s where s.usn=m.usn and k.usn=m.usn and k.usn= "' .$row["usn"]. '" and s.batch="' . $batch . '" and s.branch="' . $branch . '" and k.fac_name="' . $_SESSION["username"] . '" order by k.usn');

$pdf->Cell(5,7,"" ,0);
 $pdf->Cell(35,10,"Date",1);
	$pdf->Cell(80,10,"Aggenda",1);
 	$pdf->Cell(80,10,"Issue",1);
 	$pdf->Cell(80,10,"Remark",1);
	 
	 
     $pdf->Ln();
$con3=0;
foreach ($result2 as $row2){
 $con3++;     
 $pdf->Cell(5,7,"" ,0);
 	$pdf->Cell(35,10,$row2['Date'],1);
 	$pdf->Cell(80,10,$row2['agenda'],1);
 	$pdf->Cell(80,10,$row2['any_issue'],1);
 	$pdf->Cell(80,10,$row2['Remark'],1);
// 	 $pdf->Ln(); 
                      }


					  $pdf->AddPage();














					}





// $pdf->Ln();
// $pdf->Ln();
// $pdf->Ln();
// $pdf->Ln();
// $pdf->Cell(20,7,"" ,0);

// $pdf->Cell(25,7,"Faculty Signature" ,'T',1,'C');
					


$pdf->Output();

?>