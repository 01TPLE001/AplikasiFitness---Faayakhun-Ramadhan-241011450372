<?php
// File: tampil_member.php
include('db.php');
include('includes/header.php');
$result = mysqli_query($conn, "SELECT * FROM member");
?>
<div class="container mt-5">
  <h2>Daftar Member</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nama</th>
        <th>No Telepon</th>
        <th>Alamat</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?= $row['nama']; ?></td>
          <td><?= $row['no_telepon']; ?></td>
          <td><?= $row['alamat']; ?></td>
          <td><?= $row['status']; ?></td>
          <td>
            <a href="lihat_member.php?id=<?= $row['id_member']; ?>" class="btn btn-info btn-sm">Lihat</a>
            <a href="edit_member.php?id=<?= $row['id_member']; ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="hapus_member.php?id=<?= $row['id_member']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus member ini?');">Hapus</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php include('includes/footer.php'); ?>