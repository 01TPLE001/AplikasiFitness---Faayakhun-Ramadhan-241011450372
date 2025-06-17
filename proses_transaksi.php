
<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_member = $_POST['id_member'];
    $id_paket = $_POST['id_paket'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    $jenis_transaksi = $_POST['jenis_transaksi'];
    $total_bayar = $_POST['total_bayar'];
    $tanggal_kadaluarsa = $_POST['tanggal_kadaluarsa'];

    // Simpan ke tabel transaksi
    $stmt = $conn->prepare("INSERT INTO transaksi (id_member, id_paket, tanggal_transaksi, jenis_transaksi, total_bayar) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iissd", $id_member, $id_paket, $tanggal_transaksi, $jenis_transaksi, $total_bayar);

    if ($stmt->execute()) {
        // Update tanggal daftar, tanggal kadaluarsa, dan status
        $update = $conn->prepare("
            UPDATE member 
            SET tanggal_kadaluarsa = ?, 
                tanggal_daftar = ?, 
                status = IF(? >= CURDATE(), 'Aktif', 'Tidak Aktif')
            WHERE id_member = ?
        ");
        $update->bind_param("sssi", $tanggal_kadaluarsa, $tanggal_transaksi, $tanggal_kadaluarsa, $id_member);
        $update->execute();
        $update->close();

        echo "<script>alert('Transaksi berhasil, data member diperbarui'); window.location.href = 'tampil_member.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan transaksi'); history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>