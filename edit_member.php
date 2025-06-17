<?php
// File: edit_member.php
include('db.php');
include('includes/header.php');
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT m.*, t.id_paket FROM member m LEFT JOIN transaksi t ON m.id_member = t.id_member WHERE m.id_member = $id ORDER BY t.tanggal_transaksi DESC LIMIT 1"));
$paketList = mysqli_query($conn, "SELECT * FROM paket");
?>
<div class="container mt-5">
  <h2>Edit Member</h2>
  <form action="update_member.php" method="POST">
    <input type="hidden" name="id_member" value="<?= $data['id_member']; ?>">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" required value="<?= $data['nama']; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">No Telepon</label>
      <input type="text" name="no_telepon" class="form-control" required value="<?= $data['no_telepon']; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea name="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Paket</label>
      <select name="id_paket" class="form-select" readonly disabled>
        <option value="">Belum Ada transaksi</option>
        <?php while($p = mysqli_fetch_assoc($paketList)) { ?>
          <option value="<?= $p['id_paket']; ?>" <?= ($data['id_paket'] == $p['id_paket']) ? 'selected' : ''; ?>><?= $p['nama_paket']; ?> - <?= $p['durasi_bulan']; ?> bulan</option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal Daftar</label>
      <input type="date" name="tanggal_daftar" class="form-control" value="<?= $data['tanggal_daftar']; ?>" readonly disabled>
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal Kadaluarsa</label>
      <input type="date" name="tanggal_kadaluarsa" class="form-control" required value="<?= $data['tanggal_kadaluarsa']; ?>" readonly disabled>
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="Aktif" <?= $data['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
        <option value="Tidak Aktif" <?= $data['status'] == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>
<?php include('includes/footer.php'); ?>