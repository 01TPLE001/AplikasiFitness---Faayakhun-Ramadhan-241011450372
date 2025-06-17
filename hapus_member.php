<?php
// File: hapus_member.php
include('db.php');
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM member WHERE id_member = $id");
header("Location: tampil_member.php");
exit;
?>