<?php
include('db.php');
include('includes/header.php');
$id = $_GET['id'];
$paket = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM paket WHERE id_paket = $id"));
?>
<div class="container mt-5">
  <h2>Edit Paket</h2>
  <form action="update_paket.php" method="POST">
    <input type="hidden" name="id_paket" value="<?= $paket['id_paket']; ?>">
    <div class="mb-3">
      <label class="form-label">Nama Paket</label>
      <input type="text" name="nama_paket" class="form-control" required value="<?= $paket['nama_paket']; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Durasi Bulan</label>
      <input type="number" name="durasi_bulan" class="form-control" required value="<?= $paket['durasi_bulan']; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Harga</label>
      <input type="number" name="harga" class="form-control" required step="0.01" value="<?= $paket['harga']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>
<?php include('includes/footer.php'); ?>