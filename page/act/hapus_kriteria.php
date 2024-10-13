<?php

/** Koneksi Database */
include('../../config.php');

// menangkap data id yang di kirim dari url
$idKriteria = $_GET['idKriteria'];

$db = mysqli_query($connection, "SELECT * FROM `subkriteria` WHERE idKriteria='$idKriteria' ");
$a = mysqli_fetch_array($db);

if ($idKriteria == $a['idKriteria']) {
    echo '<script type="text/javascript">
    alert("Maaf, Data Tidak bisa dihapus!");
    window.location.href = "../kriteria.php"; // Pengalihan setelah alert
  </script>';
} else {
    // menghapus data dari database
    mysqli_query($connection, "DELETE FROM `kriteria` WHERE idKriteria='$idKriteria'");

    // mengalihkan halaman kembali ke index.php
    header("location:../kriteria.php");
}
