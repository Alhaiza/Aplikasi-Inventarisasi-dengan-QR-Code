<?php
require_once __DIR__ . '/vendor/autoload.php';

include "phpqrcode/qrlib.php";
require "qr-fungsi.php";
// ambil data dari tabel dosen
$conn = mysqli_connect("localhost", "root", "root", "project_college_inventory");
$barang = mysqli_query($conn, "SELECT * FROM barang INNER JOIN Kategori ON Barang.id_kategori = Kategori.id_kategori
INNER JOIN MataKuliah ON Barang.id_matakuliah = MataKuliah.id_matakuliah");



$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>List QR CODE</title>
</head>
<body>';
$i = 1;

QRcode::png($viewUrl, $qrCodeImagePath);
$html .= '
    <div class="card-deck" style="display: flex;">';
foreach ($barang as $row) {
    $id = $row["id_barang"];
    $viewUrl = "qr-hasil.php?id_barang=$id";
    $qrCodeImagePath = 'assets/img/qr/qrcode_' . $id . '.png';
    $html .= ' 
    <div class="card">
    <img class="qrcode" src="' . $qrCodeImagePath . '" alt="QR Code">
        <div class="content">
          <h5>' . $row['nama_barang'] . '</h5>
        </div>
    </div>';
}
$html .= '</div>';





$html .= '<script src="assets/js/sidebar.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>';

$timestamp = time();

$stylesheet = file_get_contents('assets/css/print.css');
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);



$mpdf->Output('qrcode' . '-' . $timestamp, \Mpdf\Output\Destination::INLINE);
