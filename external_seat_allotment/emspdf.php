<?php
require_once "../config.php";
session_start();
// include "../template/fac-auth.php";
// include "../template/sidebar-fac.php";
$date2 =  $_SESSION['date'];
$session = substr($date2, -2);
$date1 = substr($date2, 0, 10);
$q="select * from exam_duty 
where date='$date1' and session='$session'
order by case when duty='Room Duty' then 1
when duty='Reserve' then 2
when duty='Relive' then 3 
else NULL end";
//$q = "Select * from exam_duty where date='$date1' and session='$session'";
$res = $link->query($q);
require("fpdf17/fpdf.php");
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont("Times","",14);
// $pdf->Cell(0,10,"Alvas Institute of Engineering And Technology",1,1,'C');
$pdf->Image( "aiet-logo.png", 12,11, 22,17,'PNG' );
$pdf->MultiCell(0,10,'Alvas Institute of Engineering And Technology
Examination Faculty Details','LRTB','C',false);




if ($res->num_rows > 0) {
        $pdf->Cell(30,10,"Date",1,0,'C');
        $pdf->Cell(30,10,"Faculty ID",1,0,'C');
        $pdf->Cell(56,10,"Faculty Name",1,0,'C');
        $pdf->Cell(21,10,"Session",1,0,'C');
        $pdf->Cell(19,10,"Sem",1,0,'C');
        $pdf->Cell(0,10,"Duty",1,1,'C');        
foreach ($res as $row) {
        $pdf->Cell(30,10,$row['date'],1,0,'C');
        $pdf->Cell(30,10,$row['faculty_id'],1,0,'C');
        $pdf->Cell(56,10,$row['faculty_name'],1,0,'C');
        $pdf->Cell(21,10,$row['session'],1,0,'C');
        $pdf->Cell(19,10,$row['sem'],1,0,'C');
        $pdf->Cell(0,10,$row['duty'],1,1,'C');
}
    

}
$pdf->Output();