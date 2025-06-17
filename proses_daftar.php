<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $tanggal_daftar = $_POST['tanggal_daftar'];
    $tanggal_kadaluarsa = $_POST['tanggal_kadaluarsa'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO member (nama, no_telepon, alamat, tanggal_daftar, tanggal_kadaluarsa, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nama, $no_telepon, $alamat, $tanggal_daftar, $tanggal_kadaluarsa, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location.href = 'tampil_member.php';</script>";
    } else {
        echo "<script>alert('Pendaftaran gagal: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>