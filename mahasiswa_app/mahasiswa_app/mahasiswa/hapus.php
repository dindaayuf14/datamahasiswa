<?php
include 'koneksi.php';

mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$_GET[nim]'");

header("Location: mahasiswa.php");
?>