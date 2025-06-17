<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id_member = $_POST['id_member'];
  $id_paket = $_POST['id_paket'];
  $tanggal = date('Y-m-d');

  // Ambil data paket
  $paket = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM paket WHERE id_paket = $id_paket"));

  // Ambil data member
  $member = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM member WHERE id_member = $id_member"));
  $tanggal_lama = $member['tanggal_kadaluarsa'];
  $tanggal_terbaru = date('Y-m-d', strtotime("{$tanggal_lama} +{$paket['durasi_bulan']} months"));

  // Tambahkan ke transaksi
  mysqli_query($conn, "INSERT INTO transaksi (id_member, id_paket, tanggal_transaksi, jenis_transaksi, total_bayar) VALUES ($id_member, $id_paket, '$tanggal', 'Perpanjangan', {$paket['harga']})");

  // Update tanggal kadaluarsa dan status
  mysqli_query($conn, "UPDATE member SET tanggal_kadaluarsa = '$tanggal_terbaru', status = 'Aktif' WHERE id_member = $id_member");

  header("Location: tampil_member.php?success=1");
  exit;
} else {
  echo "<script>alert('Invalid Request');window.location='perpanjang_member.php';</script>";
}
?>