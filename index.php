<?php
include 'koneksi.php';

// Ambil keyword pencarian
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
$orderIcon = $order == 'ASC' ? '▲' : '▼';
$newOrder = $order == 'ASC' ? 'DESC' : 'ASC';

// Query
if ($keyword) {
    $sql = "SELECT * FROM users WHERE nama LIKE '%$keyword%' OR email LIKE '%$keyword%' ORDER BY $sort $order";
} else {
    $sql = "SELECT * FROM users ORDER BY $sort $order";
}
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <style>
    .editable:focus {
        background-color: #fff3cd; /* kuning muda */
        outline: none;
    }
</style>

    <title>Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="container py-4">

<h2 class="mb-4">Data User</h2>

<div class="mb-3 d-flex justify-content-between">
    <form method="GET" action="" class="d-flex gap-2">
        <input type="text" name="keyword" class="form-control" placeholder="Cari nama atau email..." value="<?php echo $keyword; ?>">
        <button type="submit" class="btn btn-primary">Cari</button>
        <a href="index.php" class="btn btn-secondary">Reset</a>
    </form>
    <a href="create.php" class="btn btn-success">+ Tambah User</a>
</div>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th><a href="?sort=id&order=<?=$newOrder?>">ID <?=$sort=='id'?$orderIcon:''?></a></th>
            <th><a href="?sort=nama&order=<?=$newOrder?>">Nama <?=$sort=='nama'?$orderIcon:''?></a></th>
            <th><a href="?sort=email&order=<?=$newOrder?>">Email <?=$sort=='email'?$orderIcon:''?></a></th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr data-id="<?= $row['id'] ?>">
            <td><?= $row['id'] ?></td>
            <td contenteditable="true" class="editable" data-field="nama"><?= $row['nama'] ?></td>
            <td contenteditable="true" class="editable" data-field="email"><?= $row['email'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Toast Notifikasi -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
  <div id="toastNotif" class="toast align-items-center text-bg-success border-0" role="alert">
    <div class="d-flex">
      <div class="toast-body" id="toastMessage">
        Data berhasil diupdate!
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

<script>
$(document).on('focus', '.editable', function(){
    $(this).addClass('editing');
}).on('blur', '.editable', function(){
    $(this).removeClass('editing');

    var id = $(this).closest('tr').data('id');
    var field = $(this).data('field');
    var value = $(this).text();

    $.post('update_inline.php', { id:id, field:field, value:value }, function(response){
        if(response.trim() === "success"){
            $("#toastNotif").removeClass("text-bg-danger").addClass("text-bg-success");
            $("#toastMessage").text("Data berhasil diupdate!");
        } else {
            $("#toastNotif").removeClass("text-bg-success").addClass("text-bg-danger");
            $("#toastMessage").text("Gagal update data!");
        }
        var toast = new bootstrap.Toast(document.getElementById('toastNotif'));
        toast.show();
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
