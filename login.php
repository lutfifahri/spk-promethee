<?php
session_start();
include('./config.php');


$email          = $_POST['email'];
$password       = MD5($_POST['password']);

//query
$query  = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result     = mysqli_query($connection, $query);
$num_row     = mysqli_num_rows($result);
$row         = mysqli_fetch_array($result);

if ($num_row >= 1) {
    echo "success";
    $_SESSION['id']          = $row['id'];
    $_SESSION['email']       = $row['email'];
    $_SESSION['level']       = $row['level'];
} else {
    echo "error";
}
