<?php
$conn = mysqli_connect("localhost", "root", "", "db_mahasiswa");

$username = "admin";
$password = password_hash("admin", PASSWORD_DEFAULT);
$nama = "Admin";

mysqli_query($conn, "INSERT INTO users (username, password, nama) 
VALUES ('$username', '$password', '$nama')");

echo "User berhasil dibuat!";
?>