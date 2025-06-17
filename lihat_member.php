<?php
// File: lihat_member.php
include('db.php');
include('includes/header.php');
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT m.*, p.nama_paket FROM member m LEFT JOIN transaksi t ON m.id_member = t.id_member LEFT JOIN paket p ON t.id_paket = p.id_paket WHERE m.id_member = $id ORDER BY t.tanggal_transaksi DESC LIMIT 1"));
?>
<div class="container mt-5">
  <h2>Lihat Data Member</h2>
  <form>
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" class="form-control" value="<?= $data['nama']; ?>" readonly>
    </div>
    <div class="mb-3">
      <label class="form-label">No Telepon</label>
      <input type="text" class="form-control" value="<?= $data['no_telepon']; ?>" readonly>
    </div>
    <div class="mb-3">
      <label class="form-label">Alamat</label>
      <textarea class="form-control" readonly><?= $data['alamat']; ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Paket Terakhir</label>
      <input type="text" class="form-control" value="<?= $data['nama_paket'] ?? 'Belum Ada Transaksi'; ?>" readonly>
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal Daftar</label>
      <input type="date" class="form-control" value="<?= $data['tanggal_daftar']; ?>" readonly>
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal Kadaluarsa</label>
      <input type="date" class="form-control" value="<?= $data['tanggal_kadaluarsa']; ?>" readonly>
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <input type="text" class="form-control" value="<?= $data['status']; ?>" readonly>
    </div>
  </form>
</div>
<?php include('includes/footer.php'); ?>