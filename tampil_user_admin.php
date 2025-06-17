<?php
include 'db.php';
include 'includes/header.php';
?>

<div class="container mt-4">
    <h2>Data Admin</h2>
    <a href="tambah_user_admin.php" class="btn btn-primary mb-3">Tambah Admin</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM user_admin";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_user']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['nama_lengkap']}</td>
                        <td>
                            <a href='edit_user_admin.php?id={$row['id_user']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='hapus_user_admin.php?id={$row['id_user']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('includes/footer.php');?>