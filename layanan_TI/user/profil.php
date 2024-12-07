<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<?php include('../nav/navbar.php'); ?>
<?php include('../nav/sidebar-user.php'); ?>

        <div class="main-content">
            <h2>Profil Saya</h2>
            <form action="#" method="post" class="profile-form">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" value="Andi Setiawan" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="andi.setiawan@example.com" required>

                <label for="phone">Nomor Telepon:</label>
                <input type="tel" id="phone" name="phone" value="081234567890" required>


                <button type="submit">Perbarui Profil</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Layanan TI - Profil Saya</p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>
