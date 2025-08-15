<?php
include 'koneksi.php';

if (isset($_POST['id']) && isset($_POST['column']) && isset($_POST['value'])) {
    $id = $_POST['id'];
    $column = $_POST['column'];
    $value = $_POST['value'];

    $stmt = $conn->prepare("UPDATE users SET $column = ? WHERE id = ?");
    $stmt->bind_param('si', $value, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "no change";
    }
}
?>
