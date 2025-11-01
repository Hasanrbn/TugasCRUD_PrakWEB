<?php
require_once(__DIR__ . "/koneksi.php");

// Cek apakah form pencarian dikirim
$keyword = "";
if (isset($_GET["keyword"])) {
    $keyword = trim($_GET["keyword"]);
    $sql = "SELECT * FROM mahasiswa WHERE nama LIKE ?";
    $stmt = $connection->prepare($sql);
    $searchTerm = "%" . $keyword . "%";
    $stmt->bind_param("s", $searchTerm);
} else {
    $sql = "SELECT * FROM mahasiswa";
    $stmt = $connection->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Speda</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link active" href="rumah.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="tambah.php">Tambah Mahasiswa</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h4>Daftar Mahasiswa</h4>
  
  <!-- Form Pencarian -->
  <form method="GET" class="mb-3 d-flex">
    <input type="text" name="keyword" class="form-control me-2" placeholder="Cari Mahasiswa" value="<?= htmlspecialchars($keyword) ?>">
    <button type="submit" class="btn btn-outline-dark">Cari</button>
  </form>

  <!-- Tabel Data -->
  <table class="table table-striped table-bordered text-center align-middle">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php $no = 1; ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row["nim"]) ?></td>
            <td><?= htmlspecialchars($row["nama"]) ?></td>
            <td><?= htmlspecialchars($row["gender"]) ?></td>
            <td>
              <a href="update.php?nim=<?= $row['nim'] ?>" class="btn btn-sm btn-warning">Update</a>
              <a href="delete.php?nim=<?= $row['nim'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="5">Tidak ada data</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>
