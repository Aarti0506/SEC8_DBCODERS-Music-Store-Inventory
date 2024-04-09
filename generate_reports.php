<?php
require('./fpdf186/fpdf.php');

// Connect to MySQL using mysqli
$db = mysqli_connect("localhost", "root", "", "musicstore");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set border for the whole page
$pdf->SetDrawColor(0); // Black color
$pdf->SetLineWidth(0.5); // Border width
$pdf->Rect(5, 5, 200, 287); // Border around the whole page

// Set report title and date for Monthly Sales Report
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetTextColor(0, 71, 133); // Dark Blue Color
$pdf->Cell(0, 10, 'Monthly Sales Report', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(50, 50, 50); // Dark Grey Color
$pdf->Cell(0, 10, 'Date: ' . date('Y-m-d'), 0, 1, 'C');
$pdf->Ln(10); // Add some space

// Query data from database for Monthly Sales Report
$stmt = $db->query("SELECT * FROM SalesTransaction WHERE MONTH(Date) = 3 AND YEAR(Date) = 2024");
$salesData = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

// Display sales data in a table for Monthly Sales Report
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(189, 215, 238); // Light Blue Fill Color
$pdf->SetTextColor(0); // Reset Text Color
$pdf->Cell(60, 10, 'Transaction ID', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Total Amount', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Date', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(255); // Reset Fill Color
foreach ($salesData as $sale) {
    $pdf->Cell(60, 10, $sale['TransactionID'], 1, 0, 'C');
    $pdf->Cell(60, 10, '$' . number_format($sale['TotalAmount'], 2), 1, 0, 'C');
    $pdf->Cell(70, 10, $sale['Date'], 1, 1, 'C');
}

// Add a new page for Inventory Stock Status Report
$pdf->AddPage();

// Set border for the whole page
$pdf->SetDrawColor(0); // Black color
$pdf->SetLineWidth(0.5); // Border width
$pdf->Rect(5, 5, 200, 287); // Border around the whole page

// Set report title and date for Inventory Stock Status Report
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetTextColor(0, 71, 133); // Dark Blue Color
$pdf->Cell(0, 10, 'Inventory Stock Status Report', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetTextColor(50, 50, 50); // Dark Grey Color
$pdf->Cell(0, 10, 'Date: ' . date('Y-m-d'), 0, 1, 'C');
$pdf->Ln(10); // Add some space

// Query data from database for Inventory Stock Status Report
$stmt = $db->query("SELECT * FROM Product WHERE QuantityAvailable <= 10");
$lowStockItems = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

$stmt = $db->query("SELECT * FROM Product WHERE QuantityAvailable = 0");
$outOfStockItems = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

// Display inventory data in a table for Inventory Stock Status Report
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(189, 215, 238); // Light Blue Fill Color
$pdf->SetTextColor(0); // Reset Text Color
$pdf->Cell(100, 10, 'Product Name', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Quantity Available', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(255); // Reset Fill Color
foreach ($lowStockItems as $item) {
    $pdf->Cell(100, 10, $item['Name'], 1, 0);
    $pdf->Cell(50, 10, $item['QuantityAvailable'], 1, 1, 'C');
}

// Add a section for out-of-stock items
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(255, 0, 0); // Red Color
$pdf->Cell(0, 10, 'Out-of-Stock Items', 0, 1, 'C');
$pdf->Ln(5); // Add some space

$pdf->SetFont('Arial', '', 14);
$pdf->SetTextColor(50, 50, 50); // Dark Grey Color
foreach ($outOfStockItems as $item) {
    $pdf->Cell(0, 10, $item['Name'], 0, 1);
}

// Output PDF to browser
$pdf->Output('reports.pdf', 'D');
?>
