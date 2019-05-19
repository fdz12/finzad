<?php
require('../fpdf181/tfpdf.php');

class PDF extends tFPDF
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
	$size = sizeof($header);
	if ($size <= 9){
		foreach($header as $col){
				if ($ind == 0)
						$this->Cell(10,7,$col,1);
				else if ($ind == 1)
						$this->Cell(28,7,$col,1);
				else
						$this->Cell(16,7,$col,1);
				$ind++;
			}
			$this->Ln();
			// Data
			$ind = 0;
			foreach($data as $row)
			{
				foreach($row as $col){
					if ($ind == 0)
						$this->Cell(10,6,$col,1);
					else if ($ind == 1)
						$this->Cell(28,6,$col,1);
					else
						$this->Cell(16,6,$col,1);
					$ind++;
				}
				$this->Ln();
				$ind =0;
	}
	}
	else{
			foreach($header as $col){
				if ($ind == 0)
						$this->Cell(10,7,$col,1);
				else if ($ind == 1)
						$this->Cell(28,7,$col,1);
					else if ($ind == 16 || $ind==17)
						$this->Cell(9,7,$col,1);
					else if ($ind == ($size-2))
						$this->Cell(11,7,$col,1);
					else if ($ind == ($size-1))
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
				foreach($row as $col){
					if ($ind == 0)
						$this->Cell(10,6,$col,1);
					else if ($ind == 1)
						$this->Cell(28,6,$col,1);
					else if ($ind == 16 || $ind==17)
						$this->Cell(9,6,$col,1);
					else if ($ind == ($size-2))
						$this->Cell(11,6,$col,1);
					else if ($ind == ($size-1))
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

}

$pdf = new PDF();

// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',8);
$pdf->AddPage();

// Column headings
$header =  $_GET['data'];
// Data loading
$data = $pdf->LoadData('content.txt');

//$pdf->SetFont('Arial','',8);
$pdf->BasicTable($header,$data);

$pdf->Output();
?>
