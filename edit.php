<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        
        <label>Nama:</label><br>
        <input type="text" name="name" value="<?= $user['name'] ?>" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $user['email'] ?>" required><br><br>
        
        <button type="submit">Update</button>
    </form>
</body>
</html>
