<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "
SELECT m.*, p.nama_prodi, j.nama_jurusan 
FROM mahasiswa m
JOIN prodi p ON m.id_prodi = p.id_prodi
JOIN jurusan j ON p.id_jurusan = j.id_jurusan
");
?>

<h2>Data Mahasiswa</h2>
<a href="tambah.php">+ Tambah</a>

<table border="1">
<tr>
    <th>NIM</th>
    <th>Nama</th>
    <th>JK</th>
    <th>Alamat</th>
    <th>Prodi</th>
    <th>Jurusan</th>
    <th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)) { ?>
<tr>
    <td><?= $row['nim'] ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['jk'] ?></td>
    <td><?= $row['alamat'] ?></td>
    <td><?= $row['nama_prodi'] ?></td>
    <td><?= $row['nama_jurusan'] ?></td>
    <td>
        <a href="edit.php?nim=<?= $row['nim'] ?>">Edit</a>
        <a href="hapus.php?nim=<?= $row['nim'] ?>">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>