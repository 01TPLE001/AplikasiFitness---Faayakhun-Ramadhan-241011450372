<?php
include('db.php');
include('includes/header.php');

// Ambil daftar paket dari database
$query_paket = mysqli_query($conn, "SELECT * FROM paket");
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Form Pendaftaran Member</h2>
    <form action="proses_daftar.php" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="no_telepon" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="paket" class="form-label">Pilih Paket</label>
            <select class="form-select" id="paket" name="paket" required onchange="hitungKadaluarsa()">
                <option value="" data-durasi="0">-- Pilih Paket --</option>
                <?php while($row = mysqli_fetch_assoc($query_paket)) : ?>
                    <option value="<?= $row['id_paket'] ?>" data-durasi="<?= $row['durasi_bulan'] ?>">
                        <?= $row['nama_paket'] ?> - <?= $row['durasi_bulan'] ?> bulan (Rp<?= number_format($row['harga'], 0, ',', '.') ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
            <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar" required onchange="hitungKadaluarsa()">
        </div>
        <div class="mb-3">
            <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
            <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" readonly>
        </div>
        <input type="hidden" name="status" value="Aktif">
        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>

<script>
function hitungKadaluarsa() {
    // Ambil elemen-elemen input
    const paketSelect = document.getElementById("paket");
    const tanggalDaftarInput = document.getElementById("tanggal_daftar");
    const tanggalKadaluarsaInput = document.getElementById("tanggal_kadaluarsa");

    // Ambil durasi dari option yang dipilih
    const selectedOption = paketSelect.options[paketSelect.selectedIndex];
    const durasiBulan = parseInt(selectedOption.getAttribute("data-durasi")) || 0;

    // Ambil tanggal daftar dan pastikan terisi
    const tanggalDaftar = tanggalDaftarInput.value;
    if (!tanggalDaftar || durasiBulan === 0) {
        tanggalKadaluarsaInput.value = "";
        return;
    }

    // Ubah tanggalDaftar menjadi objek Date
    const tanggal = new Date(tanggalDaftar);
    
    // Tambahkan durasi bulan
    tanggal.setMonth(tanggal.getMonth() + durasiBulan);

    // Format ulang ke yyyy-mm-dd untuk input[type=date]
    const tahun = tanggal.getFullYear();
    const bulan = String(tanggal.getMonth() + 1).padStart(2, '0');
    const hari = String(tanggal.getDate()).padStart(2, '0');

    tanggalKadaluarsaInput.value = `${tahun}-${bulan}-${hari}`;
}
</script>

<?php include('includes/footer.php');?>