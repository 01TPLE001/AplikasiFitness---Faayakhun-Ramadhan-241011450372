<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_paket = $_POST['nama_paket'];
    $durasi_bulan = $_POST['durasi_bulan'];
    $harga = $_POST['harga'];

    $stmt = $conn->prepare("INSERT INTO paket (nama_paket, durasi_bulan, harga) VALUES (?, ?, ?)");
    $stmt->bind_param("sid", $nama_paket, $durasi_bulan, $harga);

    if ($stmt->execute()) {
        echo "<script>alert('Paket berhasil ditambahkan'); window.location.href = 'kelola_paket.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan paket'); history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>