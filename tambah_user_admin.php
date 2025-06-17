<?php
include 'db.php';
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama = $_POST['nama_lengkap'];

    $query = "INSERT INTO user_admin (username, password, nama_lengkap) VALUES ('$username', '$password', '$nama')";
    if ($conn->query($query)) {
        header("Location: tampil_user_admin.php");
    } else {
        echo "Gagal menambahkan data!";
    }
}
?>

<div class="container mt-4">
    <h2>Tambah Admin</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="tampil_user_admin.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>