<?php
require('../fpdf181/fpdf.php');

class PDF extends FPDF
{
// Load data
function LoadData($file)
{
	// Read file lines
	$lines = file($file);
	$data = array();
	foreach($lines as $line)
		$data[] = explode(';',trim($line));
	return $data;
}

// Simple table
function BasicTable($header, $data)
{
	$ind = 0;
	// Header
	foreach($header as $col){
		if ($ind == 0)
				$this->Cell(10,7,$col,1);
		else if ($ind == 1)
				$this->Cell(28,7,$col,1);
			else if ($ind == 16 || $ind==17)
				$this->Cell(9,7,$col,1);
			else if ($ind == 18)
				$this->Cell(11,7,$col,1);
			else if ($ind == 19)
				$this->Cell(13,7,$col,1);
			else
				$this->Cell(8,7,$col,1);
			$ind++;
	}
	$this->Ln();
	// Data
	$ind = 0;
	foreach($data as $row)
	{
// 18, 19
		foreach($row as $col){
			if ($ind == 0)
				$this->Cell(10,6,$col,1);
			else if ($ind == 1)
				$this->Cell(28,6,$col,1);
			else if ($ind == 16 || $ind==17)
				$this->Cell(9,6,$col,1);
			else if ($ind == 18)
				$this->Cell(11,6,$col,1);
			else if ($ind == 19)
				$this->Cell(13,6,$col,1);
			else
				$this->Cell(8,6,$col,1);
			$ind++;
		}
		$this->Ln();
		$ind =0;
	}
}

}

$pdf = new PDF();
// Column headings
$header = array('ID', 'Meno', 'cv1', 'cv2', 'cv3', 'cv4', 'cv5', 'cv6', 'cv7', 'cv8', 'cv9', 'cv10', 'cv11', 'Z1', 'Z2', 'VT', 'SK-T', 'SK-P', 'Spolu', 'Znamka');
// Data loading
$data = $pdf->LoadData('content.txt');
$pdf->SetFont('Arial','',8);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->Output();
?>
