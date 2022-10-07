<?php
include "../config.php";
// session_start();
require('../fpdf184/fpdf.php');
error_reporting(0);

$branch = $_SESSION["branch"];
$sem = $_SESSION["sem1"];
$sub = $_SESSION["subid1"];
$sec = $_SESSION["sec1"];
$result = $link->query('SELECT module,dop_Plan, pending, textbook, dop_exe,complet, textbook FROM `lessonpanl` WHERE branch="' . $branch . '" and sem="' . $sem . '" and subid="' . $sub . '" and section = "' . $sec . '"');
// echo 'SELECT module,dop_Plan, pending, textbook, co, bt_evel FROM `lessonpanl` WHERE branch="Computer Science and Engineering" and sem="7"';
// print_r($result);
// echo 'SELECT module,dop_Plan, pending, textbook, dop_exe,complet, textbook FROM `lessonpanl` WHERE branch="' . $branch . '" and sem="' . $sem . '" and subid="' . $sub . '" and section = "' . $sec . '"';
$pdf = new FPDF('L','mm',array(297 ,210 ));
$pdf->AddPage();
$pdf->SetFont('Arial','B',28);
$pdf->Cell(35,7,"" ,0);
$pdf->Image("../asset/img/aiet-logo.png",9,5,30,25);
$pdf->Cell(220,10,"Alva's Institute of Engineering and Technology" ,0,1,'C');

$pdf->Ln();
$pdf->SetFont('Arial','B',20);
$pdf->Cell(297,10,"Lesson Plan and Execution" ,0,1,'C');

$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,9,"" ,0);
$pdf->Cell(60,9,"Name of the faculty:",1,0,"C");
$pdf->Cell(140,9,$_SESSION["username"],1,0,"C");

$pdf->Ln();
$pdf->Cell(40,9,"" ,0);
$pdf->Cell(60,9,"Subject:",1,0,"C");
$pdf->Cell(140,9,$sub,1,0,"C");

$pdf->Ln();
$pdf->Cell(40,9,"" ,0);
$pdf->Cell(60,9,"Branch:",1,0,"C");
$pdf->Cell(140,9,$branch,1,0,"C");

$pdf->Ln();
$pdf->Cell(40,9,"" ,0);
$pdf->Cell(60,9,"Semister/Section:",1,0,"C");
$pdf->Cell(140,9,$sem . "/" . $sec,1,0,"C");
$pdf->Ln();

$pdf->Cell(40,13,"" ,0);
$pdf->Cell(60,15,"CO:",0);
$pdf->Ln();

$co1=$link->query('select * from co where sub="'.$sub.'"');
foreach($co1 as $co){
	$pdf->SetFont('Arial','',12);
$pdf->Cell(40,13,"" ,0);
	$pdf->Cell(5,7, "1: " ,0);
	$pdf->MultiCell(200,7, $co["co1"] ,0);
	$pdf->Ln();
$pdf->Cell(40,13,"" ,0);
	$pdf->Cell(5,7, "2: " ,0);
	$pdf->MultiCell(200,7, $co["co2"] ,0);
	$pdf->Ln();
$pdf->Cell(40,13,"" ,0);
	$pdf->Cell(5,7, "3: " ,0);
	$pdf->MultiCell(200,7, $co["co3"] ,0);
	$pdf->Ln();
$pdf->Cell(40,13,"" ,0);
	$pdf->Cell(5,7, "4: " ,0);
	$pdf->MultiCell(200,7, $co["co4"] ,0);
	$pdf->Ln();
$pdf->Cell(40,13,"" ,0);
	$pdf->Cell(5,7, "5: " ,0);
	$pdf->MultiCell(200,7, $co["co5"] ,0);
	$pdf->Ln();
}


$copo = $link->query('select * from co_po where dept="'. $branch .'" and sub = "'.$sub.'"');

$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(5,7,"" ,0);
$pdf->Cell(8,12,"CO-PO:" ,0);
$pdf->Ln();
// $pdf->Cell(8,7,'select * from co_po where dept="'. $branch .'" and sub = "'.$sub.'"' ,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(5,7,"" ,0);
	$pdf->Cell(10,10,"CO",1);
	$pdf->Cell(22,10,"PO1",1);
	$pdf->Cell(22,10,"PO2",1);
	$pdf->Cell(22,10,"PO3",1);
	$pdf->Cell(22,10,"PO4",1);
	$pdf->Cell(22,10,"PO5",1);
	$pdf->Cell(22,10,"PO6",1);
	$pdf->Cell(22,10,"PO7",1);
	$pdf->Cell(22,10,"PO8",1);
	$pdf->Cell(22,10,"PO9",1);
	$pdf->Cell(22,10,"PO10",1);
	$pdf->Cell(22,10,"PO11",1);
	$pdf->Cell(22,10,"PO12",1);
	$pdf->Ln();
foreach($copo as $i){

	$pdf->Cell(5,7,"" ,0);
	$pdf->Cell(10,10,$i['co'],1);
	$pdf->Cell(22,10,$i['po1'],1);
	$pdf->Cell(22,10,$i['po2'],1);
	$pdf->Cell(22,10,$i['po3'],1);
	$pdf->Cell(22,10,$i['po4'],1);
	$pdf->Cell(22,10,$i['po5'],1);
	$pdf->Cell(22,10,$i['po6'],1);
	$pdf->Cell(22,10,$i['po7'],1);
	$pdf->Cell(22,10,$i['po8'],1);
	$pdf->Cell(22,10,$i['po9'],1);
	$pdf->Cell(22,10,$i['po10'],1);
	$pdf->Cell(22,10,$i['po11'],1);
	$pdf->Cell(22,10,$i['po12'],1);
	$pdf->Ln();


}

$copso = $link->query('select * from co_pso where dept="'.$branch.'" and sub="'.$sub.'"');
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(35,12,"" ,0);
$pdf->Cell(8,7,"CO-PSO:" ,0);
$pdf->Ln();
// $pdf->Cell(8,7,'select * from co_po where dept="'. $branch .'" and sub = "'.$sub.'"' ,0);
$pdf->SetFont('Arial','',12);

$pdf->Cell(35,7,"" ,0);
	$pdf->Cell(15,10,"CO",1);
	$pdf->Cell(35,10,"PSO1",1);
	$pdf->Cell(35,10,"PSO2",1);
	$pdf->Cell(35,10,"PSO3",1);
	$pdf->Cell(35,10,"PSO4",1);
	$pdf->Cell(35,10,"PSO5",1);
	$pdf->Ln();
foreach($copso as $i){
	$pdf->Cell(35,7,"" ,0);
	$pdf->Cell(15,10,$i['co'],1);
	$pdf->Cell(35,10,$i['pso1'],1);
	$pdf->Cell(35,10,$i['pso2'],1);
	$pdf->Cell(35,10,$i['pso3'],1);
	$pdf->Cell(35,10,$i['pso4'],1);
	$pdf->Cell(35,10,$i['pso5'],1);
	$pdf->Ln();


}




$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(8,7,"" ,0);
$pdf->Cell(30,7,"Date" ,0);
$pdf->Cell(75,7,"Topic" ,0);
$pdf->Cell(20,7,"Textbook" ,0);
$pdf->Cell(30,7,"Date" ,0);
$pdf->Cell(75,7,"Topic" ,0);
$pdf->Cell(20,7,"Textbook" ,0);
// $pdf->SetFont('Arial','',8);
$temp = "#";
$c = 1;
$maxh = 0;
foreach($result as $row) {

	$pdf->Ln();
	

	if($temp != $row["module"] ){
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(255,7,"Module : " . $row["module"] ,1);
		$maxh+=7;
		$pdf->Ln();
	}
	$y = $pdf->GetY();
	$pdf->SetFont('Arial','',8);
	$temp = $row["module"];
	$pdf->Cell(5,7, $c ,1);
	$pdf->Cell(20,7,$row["dop_Plan"] ,1);
	$pdf->MultiCell(85,7,$row["pending"] ,1);
	$x = $pdf->GetX();
	// $pdf->Cell(20,7,$x ,1);
	// $pdf->Cell(20,7,$y ,1);
	$pdf->SetXY(120,$y);
	// $pdf->Text(75,5,$row["pending"]);
	$pdf->Cell(20,7,$row["textbook"] ,1);
	$pdf->Cell(20,7,$row["dop_exe"] ,1);
	$pdf->MultiCell(85,7,$row["complet"] ,1);
	$x1 = $pdf->GetX();
	$y1 = $pdf->GetY();
	$pdf->SetXY(245,$y);
	$pdf->Cell(20,7,$row["textbook"] ,1);
	$pdf->SetXY($x1,$y1-7);
	
	$q =ceil( strlen($row["pending"])/58);
	$maxh+=(7*$q);
	// $pdf->Cell(20,7,$q ,1);


	if($maxh > 150){
		$pdf->AddPage();
		$maxh = 0;
	}
	$c++;
	
}

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',12);

$pdf->Cell(20,7, "" ,0);
$pdf->Cell(20,7, "Textbooks" ,0);
$pdf->Ln();



$pdf->SetFont('Arial','',10);
$c = 1;
foreach($co1 as $textbook){
	if($textbook["t1"] != "0"){
	$pdf->Cell(20,7, "" ,0);
	$pdf->Cell(20,7, "Textbook-" . $c++ ,0);
	$pdf->Cell(5,7, $textbook["t1"] ,0);
	$pdf->Ln();

	}
	if($textbook["t2"] != "0"){
		$pdf->Cell(20,7, "" ,0);
		$pdf->Cell(20,7, "Textbook-" . $c++ ,0);
		$pdf->Cell(5,7, $textbook["t2"] ,0);
		$pdf->Ln();
	
		}
	if($textbook["t3"] != "0"){
	$pdf->Cell(20,7, "" ,0);
	$pdf->Cell(20,7, "Textbook-" . $c++ ,0);
	$pdf->Cell(5,7, $textbook["t3"] ,0);
	$pdf->Ln();

	}
	if($textbook["t4"] != "0"){
		$pdf->Cell(20,7, "" ,0);
		$pdf->Cell(20,7, "Textbook-" . $c++ ,0);
		$pdf->Cell(5,7, $textbook["t4"] ,0);
		$pdf->Ln();
	
		}
	if($textbook["t5"] != "0"){
	$pdf->Cell(20,7, "" ,0);
	$pdf->Cell(20,7, "Textbook-" . $c++ ,0);
	$pdf->Cell(5,7, $textbook["t5"] ,0);
	$pdf->Ln();

	}
	if($textbook["t6"] != "0"){
		$pdf->Cell(20,7, "" ,0);
		$pdf->Cell(20,7, "Textbook-" . $c++ ,0);
		$pdf->Cell(5,7, $textbook["t6"] ,0);
		$pdf->Ln();
	
		}

}



$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(20,7,"" ,0);

$pdf->Cell(25,7,"Faculty Signature" ,'T',1,'C');


$pdf->Output();

?>