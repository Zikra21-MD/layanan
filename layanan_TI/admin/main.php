<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: ../sign_in.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles/styles.css">

</head>
<body>
<?php include('../nav/navbar.php'); ?>

<?php include('../nav/sidebar-admin.php'); ?>

        <div class="main-content">
            <h2>Selamat Datang, Admin!</h2>
            <div class="admin-dashboard">
                <div class="card">
                    <h3>Total Pengguna</h3>
                    <p>150</p>
                </div>
                <div class="card">
                    <h3>Total Masalah</h3>
                    <p>75</p>
                </div>
                <div class="card">
                    <h3>Masalah Aktif</h3>
                    <p>20</p>
                </div>
                <div class="card">
                    <h3>Pengaturan Sistem</h3>
                    <p><a href="settings.php">Kelola</a></p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Layanan TI - Admin Dashboard</p>
    </footer>

</body>
</html>
