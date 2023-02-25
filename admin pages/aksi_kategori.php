<?php

include "config/config.php";

$update = false;
$id='';
$name='';

//tambah
if (isset($_POST['insert'])) {
    $id=$_POST['id'];
	$nama_kategori= $_POST['nama_kategori'];

	$query = "INSERT INTO kategori (id,kategori) VALUES ('".$id."','".$nama_kategori."')";
	$insert = $conn->query($query);

	if($insert == true){
        echo "
		<script>
		alert('Berhasil insert data');
		</script>
		";

        echo '<script>window.location="home.php?page=data_kategori&&insert=insert-data"</script>';
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

	$query = "DELETE FROM kategori WHERE id=$id";
	$delete = $conn->query($query);

	if($delete == true){
    echo "
		<script>
		alert('Berhasil mengahapus data');
		</script>
		";

        echo '<script>window.location="home.php?page=data_kategori&&remove=hapus-data"</script>';
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

	$query = "SELECT * FROM kategori WHERE id=?";
	$edit = $conn->prepare($query);
	$edit -> bind_param("i",$id);
	$edit->execute();
	$result=$edit->get_result();
	$row=$result->fetch_assoc();

	$id=$row['id'];
	$name=$row['kategori'];
}
 
// update
if (isset($_POST['update'])) {
	$id=$_POST['id'];
	$nama_kategori=$_POST['nama_kategori'];

	$query="UPDATE kategori SET kategori='$nama_kategori' WHERE id='$id'";
	$stmt=$conn->query($query);

	echo $id;
	echo $nama_kategori;
	
	if ($stmt == true) {
		header('location:home.php?page=data_kategori&&editdata=edit-data');
	}else{
		echo "<script>alert('Error'.'mysqli_error($conn)');</script>";
	}
	
}


?>