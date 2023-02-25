<?php
include "config/config.php";
$id='';
$harga='';
$jumlah='';


//edit
if (isset($_GET['edit'])) {
	$id= $_GET['edit'];
	$update=true;

	$query = "SELECT * FROM produk WHERE id_kue=?";
	$edit = $conn->prepare($query);
	$edit -> bind_param("i",$id);
	$edit->execute();
	$result=$edit->get_result();
	$row=$result->fetch_assoc();

	$id=$row['id_kue'];
    $harga=$row['harga'];
}

//tambah
if (isset($_POST['insert'])) {
    $kode=$_POST['kode'];
    $username=$_POST['username'];
    $tgl=$_POST['tgl'];
    $id_kue=$_POST['id_kue'];
    $jumlah_pesanan=$_POST['jumlah'];
    $total_harga=$_POST['total_harga'];
    $keterangan=$_POST['komentar'];
	$status=$_POST['status'];

	$query = "INSERT INTO pesanan (kode,username,tgl,id_kue,jumlah,total_bayar,keterangan,status_pesanan) VALUES 
	('".$kode."','".$username."','".$tgl."','".$id_kue."','".$jumlah_pesanan."','".$total_harga."','".$keterangan."','".$status."')";
	$insert = $conn->query($query);

	if($insert == true){
        echo "
		<script>
		alert('Berhasil insert data, bayar agar status berubah');
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

