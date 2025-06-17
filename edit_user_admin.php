<?php
include 'db.php';
include 'includes/header.php';

$id = $_GET['id'];
$query = "SELECT * FROM user_admin WHERE id_user = $id";
$result = $conn->query($query);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $nama = $_POST['nama_lengkap'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update = "UPDATE user_admin SET username='$username', password='$password', nama_lengkap='$nama' WHERE id_user=$id";
    } else {
        $update = "UPDATE user_admin SET username='$username', nama_lengkap='$nama' WHERE id_user=$id";
    }

    if ($conn->query($update)) {
        header("Location: tampil_user_admin.php");
    } else {
        echo "Gagal mengedit data!";
    }
}
?>

<div class="container mt-4">
    <h2>Edit Admin</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= $row['username'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Password (kosongkan jika tidak ingin diganti)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="<?= $row['nama_lengkap'] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="tampil_user_admin.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>