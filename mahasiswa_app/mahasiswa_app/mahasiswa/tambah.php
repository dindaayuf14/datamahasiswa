<?php
include '../koneksi.php';

$prodi = mysqli_query($koneksi, "SELECT * FROM prodi");

if (isset($_POST['simpan'])) {
    mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES(
        '$_POST[nim]',
        '$_POST[nama]',
        '$_POST[jk]',
        '$_POST[alamat]',
        '$_POST[id_prodi]'
    )");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>

    <!-- 🔥 BOOTSTRAP DI SINI -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-6 mx-auto">

        <div class="card shadow">
            <div class="card-body">

                <h4 class="text-center mb-4">Tambah Mahasiswa</h4>

                <form method="POST">

                    <div class="mb-3">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jk" class="form-control">
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Prodi</label>
                        <select name="id_prodi" class="form-control">
                            <?php while($p = mysqli_fetch_assoc($prodi)) { ?>
                                <option value="<?= $p['id_prodi'] ?>">
                                    <?= $p['nama_prodi'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <button name="simpan" class="btn btn-success w-100">
                        Simpan
                    </button>

                    <a href="index.php" class="btn btn-secondary w-100 mt-2">
                        Kembali
                    </a>

                </form>

            </div>
        </div>

    </div>
</div>

</body>
</html>