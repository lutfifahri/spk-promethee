<?php

/** Koneksi Database */
include('../../config.php');

// Menangkap data yang dikirim dari form
$idKriteria = $_POST['idKriteria'];
$kode = $_POST['kode'];
$nama = $_POST['nama'];

// Menginput data ke database
$result = mysqli_query($connection, "UPDATE kriteria SET kode='$kode', nama='$nama' WHERE idKriteria='$idKriteria'");

// Mengecek apakah query berhasil
if ($result) {
    echo "success";
} else {
    echo "error: " . mysqli_error($connection);
}

// Tutup koneksi
mysqli_close($connection);
