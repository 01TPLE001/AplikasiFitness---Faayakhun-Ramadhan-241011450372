<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM user_admin WHERE id_user=$id");
header("Location: tampil_user_admin.php");