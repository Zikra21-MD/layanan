<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['category'];
    $description = $_POST['description'];
    $user_id = 1;

    $query = "INSERT INTO issues (category, description, user_id) VALUES (:category, :description, :user_id)";
    $stmt = $pdo->prepare($query);

    try {
        $stmt->execute([
            ':category' => $category,
            ':description' => $description,
            ':user_id' => $user_id
        ]);
        $success = "Masalah berhasil diajukan!";
    } catch (PDOException $e) {
        $error = "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Masalah</title>
    <link rel="stylesheet" href="../styles/styles.css">
   
</head>
<body>
<?php include('../nav/navbar.php'); ?>
<?php include('../nav/sidebar-user.php'); ?>
    <div class="submit-issue">
        <h2>Ajukan Masalah</h2>
        <?php if (!empty($success)): ?>
            <div class="alert success"><?= $success; ?></div>
        <?php elseif (!empty($error)): ?>
            <div class="alert error"><?= $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label for="category">Kategori Masalah:</label>
            <select name="category" id="category" required>
                <option value="" disabled selected>Pilih kategori...</option>
                <option value="Bug">Bug</option>
                <option value="Koneksi">Koneksi</option>
                <option value="Aplikasi">Aplikasi</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            <label for="description">Deskripsi Masalah:</label>
            <textarea name="description" id="description" placeholder="Deskripsikan masalah Anda..." required></textarea>
            <button type="submit">Ajukan Masalah</button>
        </form>
    </div>
        <div id="notification" class="notification"></div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        <?php if (!empty($success)): ?>
            showNotification("<?= $success; ?>", "success");
        <?php elseif (!empty($error)): ?>
            showNotification("<?= $error; ?>", "error");
        <?php endif; ?>
    });

    function showNotification(message, type) {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.classList.add(type);
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
            notification.classList.remove(type);
        }, 3000);
    }
</script>
    <footer>
        <p>&copy; 2024 Layanan TI - Admin Dashboard</p>
    </footer>
</body>
</html>
