<?php
//call the FPDF library
require('fpdf/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
//create pdf object

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->Image('tick.png',100,200,25,25);
$pdf->SetFont('Arial','B',8);  
$pdf->cell(200,100,'',0,1);
$pdf->cell(30,10,'',0,0);
$pdf->cell(75,20,'  Velammal College of engineering and technology ',1,1);
$pdf->cell(30,10,'',0,0);
$pdf->cell(50,10,'Observation mark ',1,0);
$pdf->cell(25,10,'',1,1);
$pdf->cell(30,10,'',0,0);
$pdf->cell(50,10,'Viva ',1,0);
$pdf->cell(25,10,'',1,1);
$pdf->cell(30,10,'',0,0);
$pdf->cell(50,10,'Total marks',1,0);
$pdf->cell(25,10,'',1,1);
$pdf->cell(30,10,'',0,0);
$pdf->cell(75,30,'  ',1,1);
$pdf->SetTextColor(0,0,255);
$pdf->SetXY(170,275);  
$pdf->SetFont('Arial','B',8);  
$pdf->Write(0, "Date:12-09-18");

$pdf->Output();

?>