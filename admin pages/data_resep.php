<section id="main-content">
    <section class = "wrapper">

        <div class="row">
            <main>
                    <?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
                    <?php }?>

                    <?php if(isset($_GET['insert'])){?>
						<div class="alert alert-success">
							<p>Insert Data Berhasil !</p>
						</div>
                    <?php }?>

                    <?php if(isset($_GET['editdata'])){?>
						<div class="alert alert-primary">
							<p>Edit Data Berhasil !</p>
						</div>
                    <?php }?>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Resep</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Resep</li>
                        </ol>

                        <div class="container">

                        <a href="home.php?page=data_resep" style="margin-right :0.5pc;" 
							class="btn btn-success btn-md pull-right">
							<i class="fa fa-refresh"></i> Refresh Data</a>
						<div class="clearfix"></div>
						<br/>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Form 
                            </div>
                            <div class="card-body">
                            <form method="POST" action="aksi_resep.php" enctype="multipart/form-data">
                            <?php
                                include "config/config.php";
                                // mencari kode barang dengan nilai paling besar
                                $query = mysqli_query($conn, "SELECT max(id) as maxKode FROM resep");
                                $data = mysqli_fetch_array($query);
                                $kodeBarang = $data['maxKode'];

                                // mengambil angka atau bilangan dalam kode anggota terbesar,
                                // dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
                                // misal 'BRG001', akan diambil '001'
                                // setelah substring bilangan diambil lantas dicasting menjadi integer
                                $noUrut = (int) substr($kodeBarang, 3, 3);

                                // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
                                $noUrut++;

                                // membentuk kode anggota baru
                                // perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
                                // misal sprintf("%03s", 12); maka akan dihasilkan '012'
                                // atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
                                $char = "RSP";
                                $kodeBarang = $char . sprintf("%03s", $noUrut);
                                ?>
                                <?php include 'aksi_resep.php'; ?>
                                <?php 
                                if ($update == true):
                                ?>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Id resep</label>
                                    <input type="text" name="id_resep" class="form-control" id="exampleInputid" aria-describedby="id" value="<?php echo $id?>" readonly>
                                </div>
                                <?php else: ?>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Id resep</label>
                                    <input type="text" name="id_resep" class="form-control" id="exampleInputid" aria-describedby="id" value="<?php echo $kodeBarang?>" readonly>
                                </div>
                                <?php endif; ?>
                                <div class="mb-3">
                                    <label for="exampleInputNama" class="form-label">Nama Kue</label>
                                    <input type="text" name="nama_resep" class="form-control" id="exampleInputnama_bank" value="<?php echo $nama; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputNama" class="form-label">Bahan Bahan</label>
                                    <textarea name="bahan" rows="10" class="form-control" id="exampleInputnama_bank"><?php echo $bahan; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputNama" class="form-label">Cara Membuat</label>
                                    <textarea name="cara_buat" rows="10" class="form-control" id="exampleInputnama_bank"><?php echo $cara_buat; ?></textarea>
                                </div>

                                <?php if($update == true): ?>
                                <div class="mb-3">
                                    <img src="gambar_resep/<?php echo $gambar ?>" style="width: 120px;float: left;margin-bottom: 5px;">
                                    <input type="file" name="gambar" class="form-control" id="exampleInputnama_bank">
                                    <i>Keterangan: Abaikan jika tidak ingin merubah</i>
                                </div>
                                <?php else: ?>
                                    <div class="mb-3">
                                    <label for="exampleInputNama" class="form-label">Gambar Resep</label>
                                    <input type="file" name="gambar" class="form-control" id="exampleInputnama_bank">
                                </div>
                                <?php endif; ?>

                                <?php 
                                    if ($update == true):
                                    ?>
                                        <button type="submit" name="update" class="btn btn-primary" 
                                        >Update</button>
                                    <?php else: ?>
                                        <button type="submit" name="insert" class="btn btn-primary" 
                                         onclick="javascript:return confirm('Anda yakin insert data?');">Submit</button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabel Data Bank
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nama</th>
                                            <th>Bahan</th>
                                            <th>Cara Buat</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nama</th>
                                            <th>Bahan</th>
                                            <th>Cara Buat</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        include "aksi_resep.php";
                                        include "config/config.php";

                                        $query = "SELECT * FROM resep";

                                        $tampil = $conn->query($query);
                                        while ($c=$tampil->fetch_array()) {?>
                                            <tr>
                                                <td><?php echo $c ['id'];?></td>
                                                <td><?php echo $c ['nama_resep'];?></td>
                                                <td><?php echo $c ['bahan'];?></td>
                                                <td><?php echo $c ['cara_buat'];?></td>
                                                <td style="text-align: center;"><img src="gambar_resep/<?php echo $c['gambar']; ?>" style="width: 120px; height: 100px"></td>
                                                <td>
                                                    <a href="home.php?page=data_resep&&edit=<?php echo $c['id']; ?>">
                                                    <button type="submit" class="btn btn-primary btn-sm" name="edit">Edit</button>
                                                    </a>

                                                    <a href="aksi_resep.php?delete=<?php echo $c['id']; ?>">
                                                    <button type="submit" name="delete" class="btn btn-danger btn-sm" 
                                                        onclick="javascript:return confirm('Anda yakin hapus data bank?');">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <!--End Table-->
        </div>
    </section>
</section>
