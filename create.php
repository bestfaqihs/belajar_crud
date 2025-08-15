<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
</head>
<body>
    <h1>Tambah User Percobaan</h1>
    <form action="store.php" method="POST">
        <label>Nama:</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
