<?php
include('db.php');
include('includes/header.php');
$paket = mysqli_query($conn, "SELECT * FROM paket");
?>
<div class="container mt-5">
  <h2>Kelola Paket</h2>
   <!-- Form tambah paket -->
    <form action="proses_tambah_paket.php" method="POST" class="row g-3 mb-5">
        <div class="col-md-4">
            <input type="text" class="form-control" name="nama_paket" placeholder="Nama Paket" required>
        </div>
        <div class="col-md-3">
            <input type="number" class="form-control" name="durasi_bulan" placeholder="Durasi (bulan)" required>
        </div>
        <div class="col-md-3">
            <input type="number" class="form-control" name="harga" placeholder="Harga" step="1000" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Tambah Paket</button>
        </div>
    </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Paket</th>
        <th>Durasi (Bulan)</th>
        <th>Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($paket)) { ?>
      <tr>
        <td><?= $row['id_paket']; ?></td>
        <td><?= $row['nama_paket']; ?></td>
        <td><?= $row['durasi_bulan']; ?></td>
        <td>Rp<?= number_format($row['harga'], 2, ',', '.'); ?></td>
        <td>
          <a href="edit_paket.php?id=<?= $row['id_paket']; ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="hapus_paket.php?id=<?= $row['id_paket']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus paket ini?');">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php include('includes/footer.php'); ?>