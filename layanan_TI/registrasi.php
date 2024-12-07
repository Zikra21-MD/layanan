<?php
include('db.php');
session_start();

ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Password Tidak Cocok',
                text: 'Password dan konfirmasi password tidak sama!',
            }).then(() => {
                window.history.back();
            });
        </script>";
        exit();
    }

    $role = 'user';

    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Username Sudah Terdaftar',
                text: 'Silakan gunakan username lain.',
            }).then(() => {
                window.history.back();
            });
        </script>";
        exit();
    }

    $query = "INSERT INTO users (name, username, password, role) VALUES (:name, :username, :password, :role)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Registrasi Berhasil! Silakan login.";
        
        header("Location: registrasi.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Terjadi Kesalahan, silakan coba lagi.";
        header("Location: registrasi.php");
        exit();
    }
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna</title>
    <link rel="stylesheet" href="styles/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="auth-container">
    <div class="auth-box">
        <h2>Registrasi</h2>
        <?php
        if (isset($_SESSION['success_message'])) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '" . $_SESSION['success_message'] . "',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>";
            unset($_SESSION['success_message']);
        }

        if (isset($_SESSION['error_message'])) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '" . $_SESSION['error_message'] . "',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>";
            unset($_SESSION['error_message']);
        }
        ?>

        <form action="registrasi.php" method="POST" onsubmit="return validatePassword()">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Konfirmasi Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Daftar</button>
        </form>
        <div class="auth-link">
            <p>Sudah punya akun? <a href="sign_in.php">Login di sini</a></p>
        </div>
    </div>
</div>

<script>
    function validatePassword() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Password Tidak Cocok',
                text: 'Password dan konfirmasi password tidak sama!',
            });
            return false;
        }
        return true;
    }
</script>
</body>
</html>
