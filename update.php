<?php
require_once(__DIR__ . "/koneksi.php");

// Ambil NIM dari parameter URL
if (!isset($_GET["nim"])) {
    die("NIM tidak ditemukan!");
}

$nim = $_GET["nim"];

// Ambil data mahasiswa berdasarkan NIM
$sql = "SELECT * FROM mahasiswa WHERE nim = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $nim);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Data tidak ditemukan!");
}

$mahasiswa = $result->fetch_assoc();
$stmt->close();

// Proses update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST["nama"];
    $gender = $_POST["gender"];

    $update = "UPDATE mahasiswa SET nama = ?, gender = ? WHERE nim = ?";
    $stmt = $connection->prepare($update);
    $stmt->bind_param("sss", $nama, $gender, $nim);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='rumah.php';</script>";
    } else {
        echo "Error: " . $connection->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Speda</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="rumah.php">Home</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">Edit Mahasiswa</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h4>Edit Data Mahasiswa</h4>
  <form method="POST" action="">
    <div class="mb-3">
      <label for="nim" class="form-label">NIM</label>
      <input type="text" id="nim" name="nim" class="form-control" value="<?= htmlspecialchars($mahasiswa['nim']) ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" id="nama" name="nama" class="form-control" value="<?= htmlspecialchars($mahasiswa['nama']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label><br>
      <input type="radio" id="laki" name="gender" value="Laki-laki" <?= $mahasiswa['gender'] == 'Laki-laki' ? 'checked' : '' ?>>
      <label for="laki">Laki-laki</label>
      <input type="radio" id="perempuan" name="gender" value="Perempuan" <?= $mahasiswa['gender'] == 'Perempuan' ? 'checked' : '' ?>>
      <label for="perempuan">Perempuan</label>
    </div>
    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    <a href="rumah.php" class="btn btn-secondary">Batal</a>
  </form>
</div>
</body>
</html>
