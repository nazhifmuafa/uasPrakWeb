<?php
include "config/config.php";

//edit
if (isset($_GET['edit'])) {
	$id= $_GET['edit'];

	$query = "SELECT * FROM resep WHERE id='$id'";
	$tampil = $conn->query($query);
    $row=$tampil->fetch_array();

    $nama=$row['nama_resep'];
    $bahan=$row['bahan'];
    $cara_buat=$row['cara_buat'];
    $gambar=$row['gambar'];


}

//tambah
if (isset($_POST['insert'])) {
    $kode=$_POST['id_kue'];
    $username=$_POST['username'];
    $id_order=$_POST['id_order'];
    $id_kue=$_POST['id_kue'];
    $tgl=$_POST['tgl'];
    $id_bank=$_POST['id_bank'];
    $no_rekening=$_POST['no_rekening'];
    $nama_rekening=$_POST['nama_rekening'];
    $bukti = $_FILES['gambar']['name'];

	if ($bukti !="") {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $x = explode('.', $bukti);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $angka_acak     = rand(1,999);
        $nama_gambar_baru = $angka_acak.'-'.$bukti;
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../admin pages/bukti/'.$nama_gambar_baru);
            $query = "INSERT INTO pembayaran (id, username, kode_order, id_bank, rekening, nama_rekening, tgl_transfer, bukti) VALUES 
            ('$kode', '$username', '$id_order', '$id_bank', '$no_rekening', '$nama_rekening','$tgl', '$nama_gambar_baru')";

            $result = mysqli_query($conn, $query);

            if(!$result){
                die (mysqli_error($conn)."Pesanan Sudah Dibayar");
            } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
              echo "<script>alert('Data berhasil ditambah, tunggu sebentar untuk konfirmasi admin');window.location='home.php?page=data_produk&&insert=data-insert';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png, dan jpeg.');window.location='home.php?page=data_produk';</script>";
        }

    } else {
        echo "Error";
    }
}


?>

