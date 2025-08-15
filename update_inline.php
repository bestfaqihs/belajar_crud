<?php
include 'koneksi.php';

if (isset($_POST['id']) && isset($_POST['field']) && isset($_POST['value'])) {
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    $sql = "UPDATE users SET $field='$value' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
