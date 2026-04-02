<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- 🔥 BOOTSTRAP DI SINI -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- 🔵 NAVBAR -->
<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">Dashboard</span>
        <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">

    <!-- 👋 SAPAAN -->
    <div class="alert alert-success">
        Selamat datang, <b><?= $_SESSION['nama']; ?></b> 👋
    </div>

    <!-- 📊 MENU -->
    <div class="row">

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Data Mahasiswa</h5>
                    <p>Kelola data mahasiswa</p>
                    <a href="mahasiswa/index.php" class="btn btn-primary">
                        Masuk
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>