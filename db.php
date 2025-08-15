<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "belajar_crud_db";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
