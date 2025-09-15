<?php
require('../../public/fpdf186/fpdf.php');

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$width = 97.77;     // Two boxes: 2 * 100 = 200mm (A4 width is 210mm)
$height = 55.5;     // Ten boxes: 1 * 25 = 250mm (A4 height is 297mm)
$hSpacing = 5;    // Horizontal spacing between boxes
$vSpacing = 2;    // Vertical spacing between rows

$startX = 5;
$startY = 5;

$boxNumber = 1;

$date = date('d-m-Y');  // This gets today's date in day-month-year format, e.g., 15-09-2025
$name = "JINDAL SAREE CENTRE";
$station = "SHAHPURA";
$transport = "KIRAN EXPRESS TRANSPORT";


for ($row = 0; $row < 5; $row++) {
    for ($col = 0; $col < 2; $col++) {
        $x = $startX + ($col * ($width + $hSpacing));
        $y = $startY + ($row * ($height + $vSpacing));

        // Draw the box
        $pdf->Rect($x, $y, $width, $height, 'D');


        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY($x + 0, $y + 0);
        $pdf->Cell($width - 0, 5, "GSTIN : 24AARPA7722L1ZI               || SHREE ||                         Phone : 93749 22332");
        $pdf->SetXY($x + 0, $y + 5);
        $pdf->SetFont('Arial', 'B', 17);
        $pdf->Cell($width - 0, 5, "            DEEPAK TEXTILES");

        $lineY1 = $y + 11;
        $pdf->SetDrawColor(0, 0, 0);  // Black color for the line
        $pdf->SetLineWidth(0.3);      // Line thickness
        $pdf->Line($x + 0, $lineY1, $x + $width - 0, $lineY1);

        // 3. Second line of text below the underline
        $pdf->SetXY($x + 0, $y + 11); // comment
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell($width - 0, 5, "       E/1205-1206, MILLENIUM-1 TEXTILE MARKET, RING ROAD, SURAT-395002");

        $lineY2 = $y + 16;
        $pdf->SetDrawColor(0, 0, 0);  // Black color for the line
        $pdf->SetLineWidth(0.3);      // Line thickness
        $pdf->Line($x + 0, $lineY2, $x + $width - 0, $lineY2);

        $pdf->SetXY($x + 1, $y + 16 + 1); // comment
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell($width - 0, 5, "NO :                                                                   DATE : " . $date);

        $lineY = $y + 23;
        $pdf->SetDrawColor(0, 0, 0);  // Black color for the line
        $pdf->SetLineWidth(0.3);      // Line thickness
        $pdf->Line($x + 0, $lineY, $x + $width - 0, $lineY);


        
        $labelWidth = 10;
        $pdf->SetXY($x + 1, $y + 1 + 23);
        
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell($labelWidth, 5, "TO : ", 0, 0);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell($width - $labelWidth - 2, 5, $name, 0, 0);



        $lineY = $y + 30;
        $pdf->SetDrawColor(0, 0, 0);  // Black color for the line
        $pdf->SetLineWidth(0.3);      // Line thickness
        $pdf->Line($x + 0, $lineY, $x + $width - 0, $lineY);



        $labelWidth = 17;
        $pdf->SetXY($x + 1, $y + 1 + 30);
        
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell($labelWidth, 5, "STATION : ", 0, 0);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell($width - $labelWidth - 2, 5, $station, 0, 0);



        $lineY = $y + 37;
        $pdf->SetDrawColor(0, 0, 0);  // Black color for the line
        $pdf->SetLineWidth(0.3);      // Line thickness
        $pdf->Line($x + 0, $lineY, $x + $width - 0, $lineY);



        $labelWidth = 23;
        $pdf->SetXY($x + 1, $y + 1 + 37);
        
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell($labelWidth, 5, "TRANSPORT : ", 0, 0);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell($width - $labelWidth - 2, 5, $transport, 0, 0);


        
        $lineY = $y + 44;
        $pdf->SetDrawColor(0, 0, 0);  // Black color for the line
        $pdf->SetLineWidth(0.3);      // Line thickness
        $pdf->Line($x + 0, $lineY, $x + $width - 0, $lineY);



        $pdf->SetXY($x + 1, $y + 1 + 44);
        
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell($labelWidth, 5, "REMARK : ", 0, 0);

        $lineY = $y + 51;
        $pdf->SetDrawColor(0, 0, 0);  // Black color for the line
        $pdf->SetLineWidth(0.3);      // Line thickness
        $pdf->Line($x + 0, $lineY, $x + $width - 0, $lineY);


        $pdf->SetFont('Arial', '', 7);
        $pdf->SetXY($x + 0, $y + 51);
        $pdf->Cell($width - 0, 5, "OFFICE TIME 11 AM TO 7 PM                EMAIL : VISHNUPANSARI95@GMAIL.COM");
    }
}

$pdf->Output();
?>

