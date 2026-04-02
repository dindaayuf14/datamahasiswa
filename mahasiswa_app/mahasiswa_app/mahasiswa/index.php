<?php
session_start();

// 🔒 CEK LOGIN
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

// 🔌 KONEKSI DATABASE
include '../koneksi.php';

// 🔍 QUERY
$query = "
SELECT m.*, 
       COALESCE(p.nama_prodi, '-') AS nama_prodi, 
       COALESCE(j.nama_jurusan, '-') AS nama_jurusan
FROM mahasiswa
LEFT JOIN prodi p ON m.id_prodi = p.id_prodi
LEFT JOIN jurusan j ON p.id_jurusan = j.id_jurusan
ORDER BY m.nim ASC
";

$data = mysqli_query($koneksi, $query);

// ❗ CEK ERROR QUERY
if (!$data) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📊 Data Mahasiswa</h3>
        <div>
            <span class="me-3">Halo, <?= htmlspecialchars($_SESSION['nama']); ?> 👋</span>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>

    <!-- TOMBOL -->
    <a href="tambah.php" class="btn btn-success mb-3">+ Tambah Mahasiswa</a>

    <!-- TABLE -->
    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Alamat</th>
                        <th>Prodi</th>
                        <th>Jurusan</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php 
                $no = 1;

                if (mysqli_num_rows($data) > 0) {
                    while($d = mysqli_fetch_assoc($data)) { 
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($d['nim']) ?></td>
                    <td><?= htmlspecialchars($d['nama']) ?></td>
                    <td><?= htmlspecialchars($d['jk']) ?></td>
                    <td><?= htmlspecialchars($d['alamat']) ?></td>
                    <td><?= htmlspecialchars($d['nama_prodi']) ?></td>
                    <td><?= htmlspecialchars($d['nama_jurusan']) ?></td>
                    <td>
                        <a href="edit.php?nim=<?= urlencode($d['nim']) ?>" class="btn btn-warning btn-sm">Edit</a>

                        <a href="hapus.php?nim=<?= urlencode($d['nim']) ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                           Hapus
                        </a>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Data tidak ditemukan</td></tr>";
                }
                ?>
                </tbody>

            </table>

        </div>
    </div>

    <!-- BACK -->
    <div class="mt-3">
        <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali ke Dashboard</a>
    </div>

</div>

</body>
</html>