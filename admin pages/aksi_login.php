<?php
$username = $_POST['username'];
$pass = md5($_POST['password']);

include 'config/config.php';

$user = mysqli_query($conn, "SELECT * FROM admin where username='$username' and password='$pass'");

$cek = mysqli_num_rows($user);

if ($cek>0) {
    session_start();
    $row = mysqli_fetch_array($user);
    $_SESSION['username'] = $row['username'];
    header("location:home.php");
}else {
    echo "password atau username anda salah";
}

?>