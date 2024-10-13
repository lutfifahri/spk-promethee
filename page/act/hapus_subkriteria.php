<?php

/** Koneksi Database */
include('../../config.php');

// menangkap data id yang di kirim dari url
$idSubkriteria = $_GET['idSubkriteria'];
$db = mysqli_query($connection, "SELECT * FROM `subkriteria` WHERE idSubkriteria='$idSubkriteria' ");
$a = mysqli_fetch_array($db);

// menghapus data dari database
mysqli_query($connection, "DELETE FROM `subkriteria` WHERE idSubkriteria='$idSubkriteria'");


$idKriteria = $a['idKriteria'];
// mengalihkan halaman kembali ke index.php
header("location:../subkriteria_temp.php?idKriteria=$idKriteria");
