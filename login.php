<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = mysqli_query($conn, "SELECT * FROM user_admin WHERE username = '$username'");
  if (mysqli_num_rows($query) == 1) {
    $user = mysqli_fetch_assoc($query);
    if (password_verify($password, $user['password'])) {
      $_SESSION['admin'] = $user;
      header("Location: index.php");
      exit;
    }
  }

  echo "<script>alert('Login gagal. Username atau password salah.');window.location='index.php';</script>";
}
?>
