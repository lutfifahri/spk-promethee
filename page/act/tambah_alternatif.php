<?php

/** Koneksi Database */
include('../../config.php');

// Menangkap data yang dikirim dari form
$kode = mysqli_real_escape_string($connection, $_POST['kode']);
$nama = mysqli_real_escape_string($connection, $_POST['nama']);
$idKriteriaArr = $_POST['idKriteria']; // Array idKriteria dari form
$subKriteriaArr = $_POST['subKriteria']; // Array subKriteria dari form

// Menginput data ke tabel `alternatif`
$query = "INSERT INTO  `alternatif` (kode, nama) VALUES (?, ?)";
$stmt = mysqli_prepare($connection, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $kode, $nama);
    $result = mysqli_stmt_execute($stmt);

    // Mengecek apakah insert ke tabel `alternatif` berhasil
    if ($result) {
        // Mengambil ID alternatif terakhir yang berhasil diinput
        $idAlternatif = mysqli_insert_id($connection);

        // Loop untuk menginput setiap idKriteria dan idSubkriteria ke dalam tabel `perhitungan`
        for ($i = 0; $i < count($idKriteriaArr); $i++) {
            $idKriteria = mysqli_real_escape_string($connection, $idKriteriaArr[$i]);
            $subKriteria = mysqli_real_escape_string($connection, $subKriteriaArr[$i]);

            // Insert data ke tabel `perhitungan`
            $queryPerhitungan = "INSERT INTO `perhitungan` (idAlternatif, idKriteria, idSubkriteria)
                                 VALUES (?, ?, ?)";
            $stmtPerhitungan = mysqli_prepare($connection, $queryPerhitungan);

            if ($stmtPerhitungan) {
                mysqli_stmt_bind_param($stmtPerhitungan, "iii", $idAlternatif, $idKriteria, $subKriteria);
                $resultPerhitungan = mysqli_stmt_execute($stmtPerhitungan);

                // Cek apakah insert ke tabel perhitungan berhasil
                if (!$resultPerhitungan) {
                    echo "Gagal menginput data perhitungan: " . mysqli_error($connection);
                    exit;
                }
            } else {
                echo "Error dalam mempersiapkan query perhitungan: " . mysqli_error($connection);
                exit;
            }
        }

        // Jika semua proses berhasil
        echo "success";
    } else {
        // Jika gagal insert ke tabel alternatif
        echo "Error dalam menginput data alternatif: " . mysqli_error($connection);
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
} else {
    // Jika gagal mempersiapkan statement
    echo "Error dalam mempersiapkan query: " . mysqli_error($connection);
}

// Tutup koneksi database
mysqli_close($connection);
