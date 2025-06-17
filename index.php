
<?php session_start(); include('db.php'); ?>
<?php include('includes/header.php'); ?>

<div class="container my-5">
    <h1 class="text-center mb-4">Selamat Datang di Aplikasi Fitness</h1>
    <p class="text-center">Gunakan menu berikut untuk mengakses fitur-fitur aplikasi:</p>

    <?php if (isset($_SESSION['admin'])) { ?>
    <?php
    $result = $conn->query("SELECT COUNT(*) AS jumlah FROM member WHERE status = 'Tidak Aktif'");
    $row = $result->fetch_assoc();
    $jumlah_tidak_aktif = $row['jumlah'];

    if ($jumlah_tidak_aktif > 0) {
        echo "<div class='alert alert-warning text-center'>
                <strong>Perhatian!</strong> Terdapat <strong>$jumlah_tidak_aktif member</strong> yang statusnya <strong>Tidak Aktif</strong>. 
                <a href='tampil_member.php?status=Tidak+Aktif' class='alert-link'>Lihat sekarang</a>.
              </div>";
    }
    ?>
    <?php } ?>

    <div class="row text-center mt-5">
        <div class="col-md-4 mb-4 dropdown">
            <button class="btn btn-primary btn-lg w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Daftar Member Baru
            </button>
            <ul class="dropdown-menu w-100 text-start">
                <li><a class="dropdown-item" href="form_pendaftaran.php">Pendaftaran Baru</a></li>
                <li><a class="dropdown-item" href="daftar_paket.php">Lihat Daftar Paket</a></li>
            </ul>
        </div>
        <div class="col-md-4 mb-4">
            <a href="tampil_member.php" class="btn btn-success btn-lg w-100">Lihat Daftar Member</a>
        </div>

        <?php if (isset($_SESSION['admin'])) { ?>
        <div class="col-md-4 mb-4">
            <a href="kelola_paket.php" class="btn btn-info btn-lg w-100">Kelola Paket</a>
        </div>
        <div class="col-md-4 mb-4 dropdown">
            <button class="btn btn-warning btn-lg w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                User Admin
            </button>
            <ul class="dropdown-menu w-100 text-start">
                <li><a class="dropdown-item" href="tampil_user_admin.php">Kelola Admin</a></li>
                <li><a class="dropdown-item" href="perpanjang_member.php">Perpanjangan Member</a></li>
                <li><a class="dropdown-item" href="form_transaksi.php">Input Transaksi User</a></li>
            </ul>
        </div>
        <div class="text-center mt-3">
            <span class="text-muted">Login sebagai: <?= $_SESSION['admin']['nama_lengkap']; ?></span>
            <br>
            <a href="logout.php" class="btn btn-outline-danger btn-sm mt-2">Logout</a>
        </div>
        <?php } else { ?>
        <div class="col-md-4 mb-4 text-end">
            <button class="btn btn-outline-dark btn-lg w-100" data-bs-toggle="modal" data-bs-target="#loginModal">Admin Login</button>
        </div>
        <?php } ?>
    </div>
</div>

<!-- Modal Login Admin -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="login.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>


<?php include('includes/footer.php');?>