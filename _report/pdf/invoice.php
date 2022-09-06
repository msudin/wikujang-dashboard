<?php
require ('fpdf181/fpdf.php'); 

//Kertas A4 

$pdf = new FPDF('p','mm','A4'); 
$pdf ->AddPage(); 

$pdf->SetFont('Arial','B',14);

$pdf->Cell(130 , 5,'SMA NEGERI 1 BANGIL',1,1,'center'); 

$pdf->AutoPrint(false);

$pdf->Output();





?>