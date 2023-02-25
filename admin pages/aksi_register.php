<?php
include"config/config.php";

$username = $_POST['username'];
$password = md5($_POST['password']);
$cekpassword = md5($_POST['cekpassword']);
$nama = $_POST['nama'];
$tgl_lahir = $_POST['tgl_lahir'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$jk = $_POST['jk'];

if ($password == $cekpassword) {
	$query = "INSERT INTO admin (nama_lengkap, username, password, tgl_lahir, alamat, telepon, jk)
	VALUES ('".$nama."', '".$username."', '".$password."', '".$tgl_lahir."', '".$alamat."', '".$telepon."', '".$jk."')
	";

	$insert = $conn->query($query);

	if ($insert === true) {
		echo "<script>
		alert('Registrasi Berhasil');
		window.location.href = ('index.html');
		</script>
		";
	}else {
		echo "<script>
		alert('Gagal, silakan coba lagi');
		</script>
		".mysqli_error($conn);
		
	}
}
?>