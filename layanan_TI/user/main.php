<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: ../sign_in.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<?php include('../nav/navbar.php'); ?>
<?php include('../nav/sidebar-user.php'); ?>
        <div class="main-content">
            <h2>Selamat Datang di Dashboard Layanan TI</h2>
            <p>Anda dapat mengajukan masalah, melihat masalah yang telah diajukan, atau mengakses informasi lainnya.</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Layanan TI - Admin Dashboard</p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>
