<?php
require_once(__DIR__ . "/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nim = $_POST["nim"];
    $nama = $_POST["nama"];
    $gender = $_POST["gender"];

    $sql = "INSERT INTO mahasiswa (nim, nama, gender) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $nim, $nama, $gender);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='rumah.php';</script>";
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
  <title>Speda - Tambah Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Speda</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="rumah.php">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="tambah.php">Tambah Mahasiswa</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <h4>Tambah Mahasiswa</h4>
    <form method="POST" action="">
      <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" id="nim" name="nim" class="form-control" placeholder="Masukkan NIM">
      </div>
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan Nama">
      </div>
      <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <div>
          <input type="radio" id="laki" name="gender" value="Laki Laki">
          <label for="laki">Laki Laki</label>
        </div>
        <div>
          <input type="radio" id="perempuan" name="gender" value="Perempuan">
          <label for="perempuan">Perempuan</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
