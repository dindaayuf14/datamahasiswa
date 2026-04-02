<?php
include 'koneksi.php';

$success = "";
$error = "";

if (isset($_POST['reset'])) {
    $username = trim($_POST['username']);
    $password_baru = trim($_POST['password_baru']);
    $konfirmasi_password = trim($_POST['konfirmasi_password']);

    // Validasi input
    if (empty($username)) {
        $error = "Username tidak boleh kosong!";
    } elseif (empty($password_baru)) {
        $error = "Password baru tidak boleh kosong!";
    } elseif (strlen($password_baru) < 6) {
        $error = "Password minimal harus 6 karakter!";
    } elseif ($password_baru != $konfirmasi_password) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        // Cek apakah username ada
        $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $error = "Username tidak ditemukan!";
        } else {
            // Update password
            $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
            $stmt_update = $koneksi->prepare("UPDATE users SET password = ? WHERE username = ?");
            $stmt_update->bind_param("ss", $password_hash, $username);
            
            if ($stmt_update->execute()) {
                $success = "✅ Password berhasil direset! Silakan <a href='login.php' class='text-decoration-none'>login</a> dengan password baru.";
            } else {
                $error = "Gagal mengubah password. Coba lagi!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center mb-3">🔐 Reset Password</h4>

                    <!-- SUCCESS MESSAGE -->
                    <?php if(!empty($success)) { ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php } ?>

                    <!-- ERROR MESSAGE -->
                    <?php if(!empty($error)) { ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password" name="password_baru" class="form-control" required>
                            <small class="form-text text-muted">Minimal 6 karakter</small>
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="konfirmasi_password" class="form-control" required>
                        </div>

                        <button type="submit" name="reset" class="btn btn-warning w-100">
                            Reset Password
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small>
                            Ingat password Anda? <a href="login.php" class="text-decoration-none">Kembali ke login</a>
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>