<?php
require 'function.php';
require 'vendor\tecnickcom\tcpdf\tcpdf.php';

// Fetch data from the database
$ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock");
$dataArray = mysqli_fetch_all($ambilsemuadatastock, MYSQLI_ASSOC);

// Create a new TCPDF instance
$pdf = new TCPDF();
$pdf->AddPage();

// Add content to the PDF
$pdf->SetFont('times', '', 12);
$pdf->Cell(0, 10, 'Inventory Report', 0, 1, 'C'); // Title
$pdf->Ln(10); // Add space after the title

// Add table header
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(10, 10, 'No.', 1);
$pdf->Cell(30, 10, 'Image', 1);
$pdf->Cell(40, 10, 'Nama Barang', 1);
$pdf->Cell(30, 10, 'Kadaluwarsa', 1);
$pdf->Cell(50, 10, 'Keterangan', 1);
$pdf->Cell(20, 10, 'Stock', 1);
$pdf->Ln(); // Move to the next line

// Add table content
$pdf->SetFont('times', '', 10);
foreach ($dataArray as $i => $data) {
    $pdf->Cell(10, 10, $i + 1, 1);

    // Add image
    $imagePath = 'img/' . $data['image'];
    $pdf->Image($imagePath, $pdf->GetX() + 2, $pdf->GetY() + 2, 26);
    $pdf->SetXY($pdf->GetX() + 30, $pdf->GetY()); // Move to the next column

    $pdf->Cell(40, 10, $data['namabarang'], 1);
    $pdf->Cell(30, 10, $data['kadaluwarsa'], 1);
    $pdf->Cell(50, 10, $data['keterangan'], 1);
    $pdf->Cell(20, 10, $data['stock'], 1);
    $pdf->Ln(); // Move to the next line
}

// Output the PDF to the browser
$pdfData = $pdf->Output('example.pdf', 'S'); // Get PDF data as a string

// Display PDF as inline content for preview
header('Content-Type: application/pdf');
echo $pdfData;

// Provide a download link
echo '<p style="margin-top: 10px;"><a href="data:application/pdf;base64,' . base64_encode($pdfData) . '" download="example.pdf">Download PDF</a></p>';
?>
