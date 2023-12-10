<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'function.php';

$ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock");

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Barang</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <h1>Stock Barang</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Stock</th>
            <th>Kadaluwarsa</th>
            <th>Keterangan</th>
        </tr>';

$search = isset($_GET['search']) ? "WHERE namabarang LIKE '%" . $_GET['search'] . "%'" : '';
$ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock " . $search);
$i = 1;
while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
    $namabarang = $data['namabarang'];
    $stock = $data['stock'];
    $kadaluwarsa = $data['kadaluwarsa'];
    $keterangan = $data['keterangan'];
    $idb = $data['idbarang'];
    
    //cek
    $gambar = $data['image'];
    $base_url = "http://" . $_SERVER['SERVER_NAME'] . '/stokbarang/';
    $img = '<img width="100" src="' . $base_url . 'img/' . $gambar . '">';

    $html .= '<tr>
        <td>' . $i++ . '</td>
        <td><img src="img/' . $data['image'] . '" alt="" width="90px"></td>
        <td>' . $namabarang . '</td>
        <td>' . $stock . '</td>
        <td>' . $kadaluwarsa . '</td>
        <td>' . $keterangan . '</td>       
    </tr>';
}

$html .= '</table>
    </body>
    </html>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output("Daftar-mahasiswa.pdf", 'I');
?>
