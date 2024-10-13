<?php

/** Koneksi Database */
include('../../config.php');

// Menangkap data yang dikirim dari form
$id = mysqli_real_escape_string($connection, $_POST['id']);
$nama = mysqli_real_escape_string($connection, $_POST['nama']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$password = $_POST['password'];

// Cek apakah password dikosongkan atau tidak
if (empty($password)) {
    // Jika password tidak diubah
    $query = "UPDATE `users` SET nama = ?, email = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $nama, $email, $id);
} else {
    // Jika password diubah
    $hashed_password = md5($password); // Meng-hash password
    $query = "UPDATE `users` SET nama = ?, email = ?, password = ? WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $nama, $email, $hashed_password, $id);
}

// Eksekusi query
if (mysqli_stmt_execute($stmt)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($connection);
}

// Tutup statement dan koneksi
mysqli_stmt_close($stmt);
mysqli_close($connection);
