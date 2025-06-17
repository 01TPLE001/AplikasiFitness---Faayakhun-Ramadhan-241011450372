<?php include('db.php'); ?>
<?php include('includes/header.php'); ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Daftar Paket</h2>

    <!-- Tabel daftar paket -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID Paket</th>
                <th>Nama Paket</th>
                <th>Durasi (bulan)</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = new mysqli('localhost', 'root', '', 'database_fitnes');
            $result = $conn->query("SELECT * FROM paket ORDER BY id_paket ASC");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id_paket']}</td>";
                echo "<td>{$row['nama_paket']}</td>";
                echo "<td>{$row['durasi_bulan']}</td>";
                echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                echo "</tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php');?>