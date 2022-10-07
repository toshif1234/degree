<?php 
// session_start();
// error_reporting(0);
require_once "../config.php";
require('../fpdf184/fpdf.php');

?>
<?php 
// $fac_sub = 'select * from faculty_mapping fm, faculty_details fd where fm.sub_name = "' . $_SESSION['sub'] . '" and fd.faculty_dept = "' . $_POST['fac_dept'] . '" and fm.faculty_name = fd.faculty_name';
$fdept = 'select * from faculty_details where faculty_name="'.$_SESSION['username'].'"';
// $fac_name = mysqli_fetch_assoc($link->query($fac_sub))['faculty_name'];
$fac_dept = mysqli_fetch_assoc($link->query($fdept))['faculty_dept'];
$q='select distinct faculty_name from subjects s,faculty_mapping f where branch="'.$fac_dept.'" and s.sub_name = f.sub_name group by f.faculty_name';

// echo $q;
$r=$link->query($q);

$q_all='select * from subjects s,faculty_mapping f where branch="'.$fac_dept.'" and s.sub_name = f.sub_name group by f.faculty_name';

$a=array();
$i=0;
foreach($r as $f){
    $a[]=$f['faculty_name'];
}
// print_r($a);


$pdf = new FPDF('P','mm',array(297 ,210 ));
$pdf->AddPage();
$pdf->SetFont('Times','B',20);
$pdf->Cell(35,7,"" ,0);
$pdf->Image("../asset/img/download.png",10,12,30,25);
$pdf->Cell(150,10,"Alva's Institute of Engineering and Technology" ,0,1,'C');
$pdf->SetFont('Times','B',15);
$pdf->Cell(200,8,"              Shobhavana Campus, Mijar, Moodbidri, D.K - 574227" ,0,1,'C');
$pdf->Cell(200,8,"              Phone: 08258-262725, Fax: 08258-262726",0,1,'C');

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Times','',18);
$pdf->Cell(150,10,"Department of ".$fac_dept,0,1,'L');
$pdf->Cell(150,10,"Consolidated Feedback Report",0,1,'L');

$pdf->Ln();
$pdf->SetFont('Arial','B',12);
// $pdf->Cell(1,12,"" ,0);
$pdf->Cell(14,12,"Sl.No",1,0,'C');
$pdf->Cell(60,12,"Faculty Name",1,0,"C");
$pdf->Cell(40,12,'Semester Handling',1,0,"C");
$pdf->Cell(50,12,"Subject Name and Code",1,0,"C");
$pdf->Cell(24,12,"Percentage",1,0,"C");

$pdf->SetFont('Times','',12);
$i=1;
foreach($r as $n)
{
$pdf->Ln();
$pdf->Cell(14,12,$i,1,0,'C');
$pdf->Cell(60,12,$n['faculty_name'],1,0,"C");

$i++;
}

$pdf->Output();

