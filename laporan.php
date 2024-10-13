<?php
require('library/fpdf.php');
include 'config.php';

// Membuat objek FPDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// Menambahkan judul
$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(0, 10, 'Laporan Pemilihan TBS Layak Produksi', 0, 1, 'C'); // Ubah ke 0 agar menyesuaikan lebar halaman

$pdf->Cell(10, 15, '', 0, 1); // Ruang kosong
$pdf->SetFont('Times', 'B', 9);

// Menambahkan header tabel
$pdf->Cell(20, 7, 'Rangking', 1, 0, 'C');
$pdf->Cell(20, 7, 'Kode', 1, 0, 'C');
$pdf->Cell(75, 7, 'Nama', 1, 0, 'C');
$pdf->Cell(75, 7, 'Bobot', 1, 1, 'C'); // Mengubah format ke 1,1 untuk baris baru

$pdf->SetFont('Times', '', 10);
$no = 1;

// Query untuk mengambil data
$query = "
    SELECT h.*, a.kode, a.nama AS nama_alternatif
    FROM hasil h
    INNER JOIN alternatif a ON h.idAlternatif = a.id
";

$result = mysqli_query($connection, $query); // Menjalankan query

// Mengambil dan menambahkan data ke dalam tabel PDF
while ($data = mysqli_fetch_array($result)) { // Menampilkan no
    $pdf->Cell(20, 6, $data['rangking'], 1, 0, 'C'); // Menggunakan $data untuk ambil data
    $pdf->Cell(20, 6, $data['kode'], 1, 0, 'C');
    $pdf->Cell(75, 6, $data['nama_alternatif'], 1, 0);
    $pdf->Cell(75, 6, $data['bobot'], 1, 1);
}

// Menampilkan output PDF
$pdf->Output();
