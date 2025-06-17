<?php
// File: hapus_paket.php
include('db.php');
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM paket WHERE id_paket = $id");
header("Location: kelola_paket.php");
exit;
?>