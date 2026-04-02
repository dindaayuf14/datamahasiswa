<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    // ambil data user dengan prepared statement
    $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $data = $stmt->get_result();

    // cek query error
    if (!$data) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    $d = mysqli_fetch_assoc($data);

    // Verifikasi password dengan hash
    if ($d && password_verify($pass, $d['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['nama'] = $d['nama'];

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center mb-3">Login</h4>

                    <!-- ERROR -->
                    <?php if(isset($error)) { ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" name="login" class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small>
                            <a href="reset_password.php" class="text-decoration-none">Lupa Password?</a>
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>