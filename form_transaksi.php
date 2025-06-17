<?php include('db.php'); ?>
<?php include('includes/header.php'); ?>


<div class="container my-5">
    <h2 class="text-center mb-4">Input Transaksi Member</h2>
    <form action="proses_transaksi.php" method="POST">
        <div class="mb-3">
            <label for="id_member" class="form-label">Pilih Member</label>
            <select class="form-select" name="id_member" required>
                <option value="">-- Pilih Member --</option>
                <?php
                $members = $conn->query("SELECT * FROM member");
                while ($m = $members->fetch_assoc()) {
                    echo "<option value='{$m['id_member']}'>{$m['nama']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="id_paket" class="form-label">Pilih Paket</label>
            <select class="form-select" name="id_paket" id="id_paket" required onchange="updateTotalBayarDanKadaluarsa()">
                <option value="">-- Pilih Paket --</option>
                <?php
                $pakets = $conn->query("SELECT * FROM paket");
                while ($p = $pakets->fetch_assoc()) {
                    echo "<option value='{$p['id_paket']}' data-harga='{$p['harga']}' data-durasi='{$p['durasi_bulan']}'>{$p['nama_paket']} - {$p['durasi_bulan']} bulan (Rp " . number_format($p['harga'], 0, ',', '.') . ")</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" value="<?= date('Y-m-d') ?>" required onchange="updateKadaluarsa()">
        </div>
        <div class="mb-3">
            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
            <select class="form-select" name="jenis_transaksi" required>
                <option value="Daftar Baru">Daftar Baru</option>
                <option value="Perpanjangan">Perpanjangan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="total_bayar" class="form-label">Total Bayar</label>
            <input type="number" class="form-control" name="total_bayar" id="total_bayar" readonly required>
        </div>
        <div class="mb-3">
            <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa Baru</label>
            <input type="date" class="form-control" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" readonly required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>

<script>
function updateTotalBayarDanKadaluarsa() {
    const paket = document.getElementById("id_paket");
    const selected = paket.options[paket.selectedIndex];
    const harga = selected.getAttribute("data-harga");
    const durasi = parseInt(selected.getAttribute("data-durasi"));

    document.getElementById("total_bayar").value = harga;

    const tglTransaksi = new Date(document.getElementById("tanggal_transaksi").value);
    if (!isNaN(tglTransaksi) && durasi > 0) {
        const tglKadaluarsa = new Date(tglTransaksi);
        tglKadaluarsa.setMonth(tglKadaluarsa.getMonth() + durasi);

        const year = tglKadaluarsa.getFullYear();
        const month = String(tglKadaluarsa.getMonth() + 1).padStart(2, '0');
        const day = String(tglKadaluarsa.getDate()).padStart(2, '0');

        document.getElementById("tanggal_kadaluarsa").value = `${year}-${month}-${day}`;
    } else {
        document.getElementById("tanggal_kadaluarsa").value = "";
    }
}

function updateKadaluarsa() {
    // Jalankan ulang kalkulasi jika tanggal transaksi diganti
    updateTotalBayarDanKadaluarsa();
}
</script>

<?php include('includes/footer.php');?>