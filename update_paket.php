<?php
// File: update_paket.php
include('db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id_paket'];
  $nama = $_POST['nama_paket'];
  $durasi = $_POST['durasi_bulan'];
  $harga = $_POST['harga'];

  mysqli_query($conn, "UPDATE paket SET nama_paket='$nama', durasi_bulan=$durasi, harga=$harga WHERE id_paket = $id");
  header("Location: kelola_paket.php");
  exit;
}
?>