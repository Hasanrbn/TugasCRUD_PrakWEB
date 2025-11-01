<?php
require_once(__DIR__ . "/koneksi.php");

if (!isset($_GET["nim"])) {
    die("NIM tidak ditemukan!");
}

$nim = $_GET["nim"];

// Gunakan prepared statement agar aman
$sql = "DELETE FROM mahasiswa WHERE nim = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $nim);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil dihapus!'); window.location='rumah.php';</script>";
} else {
    echo "Error: " . $connection->error;
}

$stmt->close();
?>
