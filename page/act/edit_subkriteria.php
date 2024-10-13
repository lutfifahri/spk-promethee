<?php

/** Koneksi Database */
include('../../config.php');

// Menangkap data yang dikirim dari form
$idSubkriteria = $_POST['idSubkriteria'];
$nama = $_POST['nama'];
$bobot = $_POST['bobot'];

// Menginput data ke database
$result = mysqli_query($connection, "UPDATE `subkriteria` SET nama='$nama', bobot='$bobot' WHERE idSubkriteria='$idSubkriteria'");

// Mengecek apakah query berhasil
if ($result) {
    echo "success";
} else {
    echo "error: " . mysqli_error($connection);
}

// Tutup koneksi
mysqli_close($connection);
