<?php

include "config/config.php";

//tambah
if (isset($_POST['insert'])) {
    $username=$_POST['username'];
    $tgl=$_POST['tgl'];
    $telepon=$_POST['telepon'];
    $komentar=$_POST['komentar'];

	$query1 = "SELECT * FROM member JOIN masukan ON member.username = masukan.username";
	$select = $conn->query($query1);
	$query = "INSERT INTO masukan (username,telepon,komentar,createdate) VALUES ('".$username."','".$telepon."','".$komentar."','".$tgl."')";
	$insert = $conn->query($query);

	if($insert == true){
        echo "
		<script>
		alert('Berhasil insert data');
		</script>
		";

        echo '<script>window.location="home.php"</script>';
	}else {
	echo "
		<script>
		alert('ERORR');
		</script>
		
		".mysqli_error($conn);;;	
	}
}


?>