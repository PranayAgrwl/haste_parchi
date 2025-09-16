<?php
// Include the FPDF library
require('public/fpdf186/fpdf.php');

/**
 * Encapsulates the configuration for the PDF grid layout.
 */
class PageConfig
{
    public const ROWS = 5;
    public const COLS = 2;

    public const BOX_WIDTH = 97.77;
    public const BOX_HEIGHT = 52; // Reduced for single-page layout

    public const HORIZONTAL_SPACING = 5;
    public const VERTICAL_SPACING = 3; // Reduced for single-page layout

    public const START_X = 5;
    public const START_Y = 5;
}

/**
 * Represents a single invoice box and handles its rendering on an FPDF instance.
 * It's now a "well-oiled Swiss watch" handling its own internal layout. 🕰️
 */
class InvoiceBox
{
    private FPDF $pdf;
    private array $data;

    public function __construct(FPDF $pdf, array $data)
    {
        $this->pdf = $pdf;
        $this->data = $data;
    }

    /**
     * Renders the invoice box at the specified coordinates.
     *
     * @param float $x The x-coordinate of the top-left corner.
     * @param float $y The y-coordinate of the top-left corner.
     */
    public function render(float $x, float $y): void
    {
        $width = PageConfig::BOX_WIDTH;
        $height = PageConfig::BOX_HEIGHT;
        $data = $this->data;

        // Draw the main box frame
        $this->pdf->Rect($x, $y, $width, $height, 'D');

        // Set the cursor's starting position for this box
        $this->pdf->SetXY($x, $y);

        // --- Header Section ---
        $this->pdf->SetFont('Arial', '', 7);
        $this->pdf->Cell($width * 0.4, 5, 'GSTIN : 24AARPA7722L1ZI', 0, 0, 'L');
        
        // $this->pdf->Cell($width * 0.2, 5, '|| OM ||', 0, 0, 'C');
        $imagePath = 'public/resources/ShreeGaneshIcon/ShreeGanesh2.png'; // Corrected relative path
        $imageWidth = 5; // Set the desired width of the image
        $imageHeight = 5; // Set the desired height of the image

        // Calculate the cell width and center the image
        $cellWidth = $width * 0.2;
        $imageX = $this->pdf->GetX() + ($cellWidth - $imageWidth) / 2;
        $imageY = $this->pdf->GetY() + 0.5; 
        
        // Output the image
        $this->pdf->Image($imagePath, $imageX, $imageY, $imageWidth, $imageHeight);
        
        // Use an empty cell to maintain the correct cursor position for the next element
        $this->pdf->Cell($cellWidth, 5, '', 0, 0, 'C'); 


        $this->pdf->Cell($width * 0.4, 5, 'Phone : 93749 22332', 0, 1, 'R');
        $this->pdf->Ln(0.5);

        $this->pdf->SetX($x);
        $this->pdf->SetFont('Arial', 'B', 19);
        $this->pdf->Cell($width, 6, 'DEEPAK TEXTILES', 0, 1, 'C');
        $this->pdf->Ln(0.5);

        $this->pdf->SetDrawColor(0, 0, 0);
        $this->pdf->SetLineWidth(0.3);
        $this->pdf->Line($x, $this->pdf->GetY(), $x + $width, $this->pdf->GetY());
        $this->pdf->Ln(0.5);
        
        $this->pdf->SetX($x);
        $this->pdf->SetFont('Arial', '', 7);
        $this->pdf->Cell($width, 5, 'E/1205-1206, MILLENIUM-1 TEXTILE MARKET, RING ROAD, SURAT-395002', 0, 1, 'C');
        
        $this->pdf->SetDrawColor(0, 0, 0);
        $this->pdf->SetLineWidth(0.3);
        $this->pdf->Line($x, $this->pdf->GetY(), $x + $width, $this->pdf->GetY());
        $this->pdf->Ln(0.5);

        // --- Data Section ---
        $this->pdf->SetX($x);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell($width * 0.5, 5, 'NO : ', 0, 0, 'L');
        $this->pdf->Cell($width * 0.5, 5, 'DATE : ' . $data['date'], 0, 1, 'R');
        $this->pdf->Line($x, $this->pdf->GetY(), $x + $width, $this->pdf->GetY());
        $this->pdf->Ln(1);

        $this->pdf->SetX($x);
        $this->pdf->Cell(8, 5, 'TO : ', 0, 0, 'L');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell($width - 10, 5, $data['name'], 0, 1, 'L');
        $this->pdf->Line($x, $this->pdf->GetY(), $x + $width, $this->pdf->GetY());
        $this->pdf->Ln(1);

        $this->pdf->SetX($x);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(15, 5, 'STATION : ', 0, 0, 'L');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell($width - 17, 5, $data['station'], 0, 1, 'L');
        $this->pdf->Line($x, $this->pdf->GetY(), $x + $width, $this->pdf->GetY());
        $this->pdf->Ln(1);

        $this->pdf->SetX($x);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(20, 5, 'TRANSPORT : ', 0, 0, 'L');
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell($width - 22, 5, $data['transport'], 0, 1, 'L');
        $this->pdf->Line($x, $this->pdf->GetY(), $x + $width, $this->pdf->GetY());
        $this->pdf->Ln(1);

        $this->pdf->SetX($x);
        $this->pdf->SetFont('Arial', '', 8);
        // $this->pdf->Cell($width, 5, 'REMARK : ' . $data['remark'], 0, 1, 'L');
        $this->pdf->Cell($width * 0.5, 5, 'REMARK : ', 0, 0, 'L');
        $this->pdf->Cell($width * 0.5, 5, 'PRANAY AGRAWAL : 7359565548', 0, 1, 'R');
        $this->pdf->Line($x, $this->pdf->GetY(), $x + $width, $this->pdf->GetY());
        $this->pdf->Ln(1);

        // --- Footer Section ---
        $this->pdf->SetX($x);
        $this->pdf->SetFont('Arial', '', 6);
        $this->pdf->Cell($width * 0.5, 3, 'OFFICE TIME 11 AM TO 7 PM', 0, 0, 'L');
        $this->pdf->Cell($width * 0.5, 3, 'EMAIL : VISHNUPANSARI95@GMAIL.COM', 0, 1, 'R');
    }
}

// -----------------------------------------------------------
// Main script execution
// This is now cleaner and more systematic.
// -----------------------------------------------------------

// Sample data for the boxes
$invoiceData = array_fill(0, PageConfig::ROWS * PageConfig::COLS, [
    'date' => date('d-m-Y', strtotime($date)), 
    'name' => $name,
    'station' => $station,
    'transport' => $transport,
]);

// Initialize the PDF document
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// Loop through the data to render each invoice box
$boxCount = count($invoiceData);
for ($i = 0; $i < $boxCount; $i++) {
    $row = floor($i / PageConfig::COLS);
    $col = $i % PageConfig::COLS;

    $x = PageConfig::START_X + ($col * (PageConfig::BOX_WIDTH + PageConfig::HORIZONTAL_SPACING));
    $y = PageConfig::START_Y + ($row * (PageConfig::BOX_HEIGHT + PageConfig::VERTICAL_SPACING));

    $box = new InvoiceBox($pdf, $invoiceData[$i]);
    $box->render($x, $y);
}

// Output the PDF to the browser
$pdf->Output();