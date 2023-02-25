<?php

include "config/config.php";

$update = false;
$id='';
$name='';

//tambah
if (isset($_POST['insert'])) {
    $id=$_POST['id'];
	$nama_bank= $_POST['nama_toko'];

	$query = "INSERT INTO supplier (id,nama_toko) VALUES ('".$id."','".$nama_bank."')";
	$insert = $conn->query($query);

	if($insert == true){
        echo "
		<script>
		alert('Berhasil insert data');
		</script>
		";

        echo '<script>window.location="home.php?page=toko_bahan&&insert=insert-data"</script>';
        echo mysqli_error($conn);
	}else {
	echo "
		<script>
		alert('ERORR');
		</script>
		";	
	}
}

//hapus
if (isset($_GET['delete'])) {
	$id= $_GET['delete'];

	$query = "DELETE FROM supplier WHERE id=$id";
	$delete = $conn->query($query);

	if($delete == true){
    echo "
		<script>
		alert('Berhasil mengahapus data');
		</script>
		";

        echo '<script>window.location="home.php?page=toko_bahan&&remove=hapus-data"</script>';
	}else {
	echo "
		<script>
		alert('ERORR');
		</script>
		".mysqli_error($conn);	
	}
}

//edit
if (isset($_GET['edit'])) {
	$id= $_GET['edit'];
	$update=true;

	$query = "SELECT * FROM supplier WHERE id=?";
	$edit = $conn->prepare($query);
	$edit -> bind_param("i",$id);
	$edit->execute();
	$result=$edit->get_result();
	$row=$result->fetch_assoc();

	$id=$row['id'];
	$name=$row['nama_toko'];
}
 
// update
if (isset($_POST['update'])) {
	$id=$_POST['id'];
	$nama_bank=$_POST['nama_toko'];

	$query="UPDATE supplier SET nama_toko='$nama_bank' WHERE id='$id'";
	$stmt=$conn->query($query);

	echo $id;
	echo $nama_bank;
	
	if ($stmt == true) {
		header('location:home.php?page=toko_bahan&&editdata=edit-data');
	}else{
		echo "<script>alert('Error');</script>";
	}
	
}


?>