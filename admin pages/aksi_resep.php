<?php

include "config/config.php";

$update = false;
$id='';
$nama='';
$cara_buat='';
$bahan='';

//tambah
if (isset($_POST['insert'])) {
    $id_resep=$_POST['id_resep'];
	$nama_resep= $_POST['nama_resep'];
    $bahan = $_POST['bahan'];
	$cara_buat = $_POST['cara_buat'];
    $gambar = $_FILES['gambar']['name'];

	if ($gambar !="") {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $angka_acak     = rand(1,999);
        $nama_gambar_baru = $angka_acak.'-'.$gambar;
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, 'gambar_resep/'.$nama_gambar_baru);
            $query = "INSERT INTO resep (id, nama_resep, bahan, cara_buat, gambar) VALUES 
            ('$id_resep', '$nama_resep', '$bahan', '$cara_buat', '$nama_gambar_baru')";

            $result = mysqli_query($conn, $query);

            if(!$result){
                die ("Query gagal dijalankan: ".mysqli_errno($conn).
                     " - ".mysqli_error($conn));
            } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
              echo "<script>alert('Data berhasil ditambah.');window.location='home.php?page=data_resep&&insert=data-insert';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png, dan jpeg.');window.location='home.php?page=data_produk';</script>";
        }

    } else {
        echo "Error";
    }
}

//hapus
if (isset($_GET['delete'])) {
	$id= $_GET['delete'];

	$query = "DELETE FROM resep WHERE id=$id";
	$delete = $conn->query($query);

	if($delete == true){
    echo "
		<script>
		alert('Berhasil mengahapus data');
		</script>
		";

        echo '<script>window.location="home.php?page=data_resep&&remove=hapus-data"</script>';
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

	$query = "SELECT * FROM resep WHERE id=?";
	$edit = $conn->prepare($query);
	$edit -> bind_param("i",$id);
	$edit->execute();
	$result=$edit->get_result();
	$row=$result->fetch_assoc();

	$nama=$row['nama_resep'];
	$bahan=$row['bahan'];
	$cara_buat=$row['cara_buat'];
	$gambar=$row['gambar'];
}
 
// update
if (isset($_POST['update'])) {
	$id_resep=$_POST['id_resep'];
	$nama_resep= $_POST['nama_resep'];
    $bahan = $_POST['bahan'];
	$cara_buat = $_POST['cara_buat'];
    $gambar = $_FILES['gambar']['name'];

	//cek dulu jika merubah gambar produk jalankan coding ini
	if($gambar != "") {
	  $ekstensi_diperbolehkan = array('png','jpg','jpeg'); //ekstensi file gambar yang bisa diupload 
	  $x = explode('.', $gambar); //memisahkan nama file dengan ekstensi yang diupload
	  $ekstensi = strtolower(end($x));
	  $file_tmp = $_FILES['gambar']['tmp_name'];   
	  $angka_acak     = rand(1,999);
	  $nama_gambar_baru = $angka_acak.'-'.$gambar; //menggabungkan angka acak dengan nama file sebenarnya
	  if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
					move_uploaded_file($file_tmp, 'gambar_resep/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
						
					  // jalankan query UPDATE berdasarkan ID yang produknya kita edit
					  $query  = "UPDATE resep SET id = '$id_resep', nama_resep='$nama_resep', bahan = '$bahan', cara_buat = '$cara_buat', gambar = '$nama_gambar_baru'";
					  $query .= "WHERE id = '$id'";
					  $result = mysqli_query($conn, $query);
					  // periska query apakah ada error
					  if(!$result){
						  die ("Query gagal dijalankan: ".mysqli_errno($conn).
							   " - ".mysqli_error($conn));
					  } else {
						//tampil alert dan akan redirect ke halaman index.php
						//silahkan ganti index.php sesuai halaman yang akan dituju
						echo "<script>alert('Data berhasil diubah.');window.location='home.php?page=data_resep&&editdata=edit-data';</script>";
					  }
				} else {     
				 //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
					echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
				}
	  } else {
					  $query  = "UPDATE resep SET id = '$id_resep', nama_resep='$nama_resep', bahan = '$bahan', cara_buat = '$cara_buat', gambar = '$nama_gambar_baru'";
					  $query .= "WHERE id = '$id'";
					  $result = mysqli_query($conn, $query);
					  // periska query apakah ada error
					  if(!$result){
						  die ("Query gagal dijalankan: ".mysqli_errno($conn).
							   " - ".mysqli_error($conn));
					  } else {
						//tampil alert dan akan redirect ke halaman index.php
						//silahkan ganti index.php sesuai halaman yang akan dituju
						echo "<script>alert('Data berhasil diubah.');window.location='home.php?page=data_resep&&editdata=edit-data';</script>";
					  }
	  }
	
}

?>