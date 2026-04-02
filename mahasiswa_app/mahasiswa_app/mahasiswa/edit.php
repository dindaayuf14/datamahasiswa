<?php
include '../koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$_GET[nim]'");
$d = mysqli_fetch_assoc($data);

$prodi = mysqli_query($koneksi, "SELECT * FROM prodi");

if (isset($_POST['update'])) {
    mysqli_query($koneksi, "UPDATE mahasiswa SET
        nama='$_POST[nama]',
        jk='$_POST[jk]',
        alamat='$_POST[alamat]',
        id_prodi='$_POST[id_prodi]'
        WHERE nim='$_GET[nim]'");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>

    <!-- 🔥 BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="col-md-6 mx-auto">

        <div class="card shadow">
            <div class="card-body">

                <h4 class="text-center mb-4">Edit Mahasiswa</h4>

                <form method="POST">

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $d['nama'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jk" class="form-control">
                            <option <?= $d['jk']=="Laki-laki"?"selected":"" ?>>Laki-laki</option>
                            <option <?= $d['jk']=="Perempuan"?"selected":"" ?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="<?= $d['alamat'] ?>">
                    </div>

                    <div class="mb-3">
                        <label>Prodi</label>
                        <select name="id_prodi" class="form-control">
                            <?php while($p = mysqli_fetch_assoc($prodi)) { ?>
                                <option value="<?= $p['id_prodi'] ?>"
                                    <?= $p['id_prodi']==$d['id_prodi']?"selected":"" ?>>
                                    <?= $p['nama_prodi'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <button name="update" class="btn btn-primary w-100">
                        Update
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