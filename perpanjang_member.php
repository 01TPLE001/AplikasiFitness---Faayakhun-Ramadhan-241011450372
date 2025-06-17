<?php
include('db.php');
include('includes/header.php');
?>
<div class="container mt-5">
  <h2>Perpanjangan Member</h2>
  <form action="proses_perpanjang.php" method="POST">
    <div class="mb-3">
      <label for="id_member" class="form-label">Pilih Member</label>
      <select name="id_member" class="form-select" required>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM member");
        while ($row = mysqli_fetch_assoc($query)) {
          echo "<option value='{$row['id_member']}'>{$row['nama']} - Status: {$row['status']}</option>";
        }
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="id_paket" class="form-label">Pilih Paket</label>
      <select name="id_paket" class="form-select" required>
        <?php
        $paket = mysqli_query($conn, "SELECT * FROM paket");
        while ($row = mysqli_fetch_assoc($paket)) {
          echo "<option value='{$row['id_paket']}'>{$row['nama_paket']} - {$row['durasi_bulan']} bulan - Rp{$row['harga']}</option>";
        }
        ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Perpanjang</button>
  </form>
</div>
<?php include('includes/footer.php'); ?>