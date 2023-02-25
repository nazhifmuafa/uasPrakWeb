<?php

include "config/config.php";

$update = false;
$id='';
$name='';


//hapus
if (isset($_GET['delete'])) {
	$id= $_GET['delete'];

	$query = "DELETE FROM masukan WHERE id=$id";
	$delete = $conn->query($query);

	if($delete == true){
    echo "
		<script>
		alert('Berhasil mengahapus data');
		</script>
		";

        echo '<script>window.location="home.php?page=data_masukan&&remove=hapus-data"</script>';
	}else {
	echo "
		<script>
		alert('ERORR');
		</script>
		".mysqli_error($conn);	
	}
}

?>