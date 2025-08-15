<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "belajar_crud"; // pastikan sudah buat DB ini

$conn = new mysqli($servername, $username, $password, $database, 3307);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
