<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "webdailyjournalaya"; // Sudah saya sesuaikan namanya

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi agar tidak error diam-diam
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>