<?php

/** Koneksi Database */
include('../../config.php');

// Menangkap data yang dikirim dari form
$idKriteria = $_POST['idKriteria'];
$nama = $_POST['nama'];
$bobot = $_POST['bobot'];

// Menginput data ke database
$result = mysqli_query($connection, "INSERT INTO `subkriteria` (idKriteria, nama, bobot) VALUES ('$idKriteria', '$nama', '$bobot')");

// Mengecek apakah query berhasil
if ($result) {
    echo "success";
} else {
    echo "error: " . mysqli_error($connection);
}
