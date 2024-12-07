<?php
include('db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];
        $role = $user['role'];
    
        $redirectUrl = ($role === 'admin') ? "admin/main.php" : "user/main.php";
    
        header("Location: $redirectUrl");
        exit();
    } else {
        $error = "Username atau password salah!";
    
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '$error',
            });
        </script>";
    }
    
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengguna</title>
    <link rel="stylesheet" href="styles/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="auth-container">
    <div class="auth-box">
        <h2>Login</h2>

        <?php if (isset($error)): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: '<?= $error; ?>',
                });
            </script>
        <?php endif; ?>

        <form action="sign_in.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <div class="auth-link">
            <p>Belum punya akun? <a href="registrasi.php">Daftar di sini</a></p>
        </div>
    </div>
</div>
</body>
</html>
