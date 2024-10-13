<?php

/** Koneksi Database */
include('../../config.php');

// Menangkap data yang dikirim dari form
$kode = $_POST['kode'];
$nama = $_POST['nama'];

// Menginput data ke database
$result = mysqli_query($connection, "INSERT INTO kriteria (kode, nama) VALUES ('$kode', '$nama')");

// Mengecek apakah query berhasil
if ($result) {
    echo "success";
} else {
    echo "error: " . mysqli_error($connection);
}
