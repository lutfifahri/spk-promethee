<?php

/** Koneksi Database */
include('../../config.php');

// Menangkap data id yang di kirim dari form
$idAlternatif = mysqli_real_escape_string($connection, $_GET['idAlternatif']);
var_dump($idAlternatif);
// Pastikan idAlternatif tidak kosong
if (empty($idAlternatif)) {
    echo "ID Alternatif tidak valid.";
    exit;
}

// Menghapus data dari tabel `perhitungan` berdasarkan idAlternatif
$query2 = "DELETE FROM `perhitungan` WHERE idAlternatif = ?";
$stmt2 = mysqli_prepare($connection, $query2);
if ($stmt2) {
    mysqli_stmt_bind_param($stmt2, "i", $idAlternatif);
    $result2 = mysqli_stmt_execute($stmt2);

    // Cek apakah delete dari tabel perhitungan berhasil
    if (!$result2) {
        echo "Gagal menghapus data dari perhitungan: " . mysqli_error($connection);
        exit;
    }
    // Tutup statement
    mysqli_stmt_close($stmt2);
} else {
    echo "Error dalam mempersiapkan query untuk menghapus perhitungan: " . mysqli_error($connection);
    exit;
}

// Menghapus data dari tabel `alternatif` berdasarkan idAlternatif
$query3 = "DELETE FROM `alternatif` WHERE id = ?";
$stmt3 = mysqli_prepare($connection, $query3);
if ($stmt3) {
    mysqli_stmt_bind_param($stmt3, "i", $idAlternatif);
    $result3 = mysqli_stmt_execute($stmt3);

    // Cek apakah delete dari tabel alternatif berhasil
    if (!$result3) {
        echo "Gagal menghapus data dari alternatif: " . mysqli_error($connection);
        exit;
    }
    // Tutup statement
    mysqli_stmt_close($stmt3);
} else {
    echo "Error dalam mempersiapkan query untuk menghapus alternatif: " . mysqli_error($connection);
    exit;
}

// Pastikan tidak ada output sebelum redirect
ob_start(); // Start output buffering
header("Location: ../alternatif.php");
ob_end_flush(); // Flush output buffer
exit; // Tambahkan exit untuk menghentikan script
