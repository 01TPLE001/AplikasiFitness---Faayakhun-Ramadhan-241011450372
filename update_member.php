<?php
include('db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id_member'];
  $nama = $_POST['nama'];
  $no = $_POST['no_telepon'];
  $alamat = $_POST['alamat'];
  $status = $_POST['status'];

  // Simpan ke tabel member tanpa mengubah tanggal & paket
  mysqli_query($conn, "UPDATE member SET nama='$nama', no_telepon='$no', alamat='$alamat', status='$status' WHERE id_member = $id");

  header("Location: tampil_member.php");
  exit;
}
?>