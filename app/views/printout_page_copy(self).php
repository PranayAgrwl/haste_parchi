<?php
require('../../public/fpdf186/fpdf.php');

// Define global constants and configurations
define('PAGE_WIDTH', 210);
define('PAGE_HEIGHT', 297);

$config = [
    'rows' => 5,
    'cols' => 2,
    'boxWidth' => 97.77,
    'boxHeight' => 53, // Adjusted height for compactness
    'hSpacing' => 5,
    'vSpacing' => 3, // Adjusted vertical spacing
    'startX' => 5,
    'startY' => 5,
];

// Sample data for the boxes
$boxData = array_fill(0, $config['rows'] * $config['cols'], [
    'date' => date('d-m-Y'),
    'name' => 'JINDAL SAREE CENTRE',
    'station' => 'SHAHPURA',
    'transport' => 'KIRAN EXPRESS TRANSPORT',
    'remark' => '',
]);

// -----------------------------------------------------------
// Class to handle the drawing of a single invoice box
// This encapsulates all the drawing logic for one box.
// -----------------------------------------------------------
class InvoiceBox
{
    private $pdf;
    private $x;
    private $y;
    private $width;
    private $height;
    private $data;

    public function __construct(FPDF $pdf, $x, $y, $width, $height, $data)
    {
        $this->pdf = $pdf;
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
        $this->data = $data;
    }

    public function render()
    {
        $pdf = $this->pdf;
        $x = $this->x;
        $y = $this->y;
        $width = $this->width;
        $height = $this->height;
        $data = $this->data;

        // Draw the main box frame
        $pdf->Rect($x, $y, $width, $height, 'D');

        // --- Header Section ---
        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY($x, $y);
        $pdf->Cell($width, 5, 'GSTIN : 24AARPA7722L1ZI               || SHREE ||                         Phone : 93749 22332');

        $pdf->SetFont('Arial', 'B', 17);
        $pdf->SetXY($x, $y + 5);
        $pdf->Cell($width, 5, '            DEEPAK TEXTILES');

        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY($x, $y + 11);
        $pdf->Cell($width, 5, '       E/1205-1206, MILLENIUM-1 TEXTILE MARKET, RING ROAD, SURAT-395002');
        
        // --- Separator Lines ---
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->Line($x, $y + 11, $x + $width, $y + 11);
        $pdf->Line($x, $y + 16, $x + $width, $y + 16);
        $pdf->Line($x, $y + 22, $x + $width, $y + 22);

        // --- Data Section (Compact) ---
        // Date and No.
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($x + 1, $y + 16 + 1);
        $pdf->Cell($width - 2, 5, 'NO :                                                                   DATE : ' . $data['date']);

        // To (Client Name)
        $pdf->SetXY($x + 1, $y + 22 + 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(8, 4, 'TO : ', 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell($width - 10, 4, $data['name']);
        
        $pdf->Line($x, $y + 28, $x + $width, $y + 28);

        // Station
        $pdf->SetXY($x + 1, $y + 28 + 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(15, 4, 'STATION : ', 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell($width - 17, 4, $data['station']);
        
        $pdf->Line($x, $y + 34, $x + $width, $y + 34);

        // Transport
        $pdf->SetXY($x + 1, $y + 35 + 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 4, 'TRANSPORT : ', 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell($width - 22, 4, $data['transport']);

        $pdf->Line($x, $y + 40, $x + $width, $y + 40);

        // Remark
        $pdf->SetXY($x + 1, $y + 40 + 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 4, 'REMARK : ' . $data['remark']);
        
        $pdf->Line($x, $y + 42, $x + $width, $y + 42);

        // --- Footer Section ---
        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY($x, $y + 42);
        $pdf->Cell($width, 5, 'OFFICE TIME 11 AM TO 7 PM                EMAIL : VISHNUPANSARI95@GMAIL.COM');
    }
}

// -----------------------------------------------------------
// Main script execution
// This is now clean and systematic, like a Swiss watch. 🕰️
// -----------------------------------------------------------
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$boxIndex = 0;
for ($row = 0; $row < $config['rows']; $row++) {
    for ($col = 0; $col < $config['cols']; $col++) {
        $x = $config['startX'] + ($col * ($config['boxWidth'] + $config['hSpacing']));
        $y = $config['startY'] + ($row * ($config['boxHeight'] + $config['vSpacing']));
        
        $box = new InvoiceBox($pdf, $x, $y, $config['boxWidth'], $config['boxHeight'], $boxData[$boxIndex]);
        $box->render();
        $boxIndex++;
    }
}

$pdf->Output();
?>