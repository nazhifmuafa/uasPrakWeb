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
                        <h1 class="mt-4">Data Produk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Produk</li>
                        </ol>

                        <div class="container">

                        <a href="home.php?page=data_produk" style="margin-right :0.5pc;" 
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
                            <form method="POST" action="aksi_produk.php" enctype="multipart/form-data">
                            <?php include 'aksi_produk.php'; ?>
                                <?php 
                                if ($update == true):
                                ?>
                                
                                <input type="hidden" name="id" id="exampleInputid" value="<?php echo $id; ?>">
        
                                <?php endif; ?>
                                <div class="mb-3">
                                    <label for="exampleIdKategori" class="form-label">Id Kategori</label>

                                    <?php if($update == true): ?>
                                    <select class="form-select" aria-label=".form-select-lg example" name="id_kategori">
                                        <option selected value="<?php echo $id_kategori; ?>" >Pilihan sebelumnya = <?php echo $id_kategori; ?></option>
                                        <?php
                                        include "config/config.php";
                                        $query = "SELECT * FROM kategori";
                                        $select = $conn->query($query);
                                        while ($row=$select->fetch_array()) {?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?> -> <?php echo $row['kategori']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <i>Keterangan: Abaikan Jika tidak ingin merubah</i>
                                    <?php else: ?>
                                    <select class="form-select" aria-label=".form-select-lg example" name="id_kategori">
                                        <option selected>Pilih id kategori</option>
                                        <?php
                                        include "config/config.php";
                                        $query = "SELECT * FROM kategori";
                                        $select = $conn->query($query);
                                        while ($row=$select->fetch_array()) {?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?> -> <?php echo $row['kategori']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php endif; ?>

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputNama" class="form-label">Nama Kue</label>
                                    <input type="text" name="nama_kue" class="form-control" id="exampleInputnama_kue" value="<?php echo $name; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputNama" class="form-label">Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" id="ExampleInputDeskripsi" value="<?php echo $deskripsi; ?>">
                                </div>
                                
                                <?php if($update == true): ?>
                                    <div class="mb-3">
                                    <label for="exampleInputGambar" class="form-label">Gambar</label><br>
                                    <img src="gambar_kue/<?php echo $gambar ?>" style="width: 120px;float: left;margin-bottom: 5px;">
                                    <input type="file" name="gambar_kue" class="form-control" value="<?php echo $gambar;?>"/>
                                    <i>Keterangan: Abaikan jika tidak ingin merubah</i>
                                </div>
                                <?php else: ?>
                                <div class="mb-3">
                                    <label for="exampleInputGambar" class="form-label">Gambar</label>
                                    <input type="file" name="gambar_kue" class="form-control" value="<?php echo $gambar; ?>" />
                                </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="exampleInputNama" class="form-label">Harga</label>
                                    <input type="text" name="harga_kue" class="form-control" id="exampleInputharga_kue" value="<?php echo $harga; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputNama" class="form-label">Status</label>
                                    <select class="form-select" aria-label=".form-select-lg example" name="status_kue" value="<?php $status; ?>">
                                        <option value="ada">Ada</option>
                                        <option value="kosong">Kosong</option>
                                    </select>
                                </div>

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
                                            <th>Kategori</th>
                                            <th>Nama</th>
                                            <th>Deksripsi</th>
                                            <th>Gambar</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Kategori</th>
                                            <th>Nama</th>
                                            <th>Deksripsi</th>
                                            <th>Gambar</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        include "aksi_produk.php";
                                        include "config/config.php";

                                        $query = "SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id";

                                        $tampil = $conn->query($query);
                                        while ($c=$tampil->fetch_array()) {?>
                                            <tr>
                                                <td><?php echo $c ['id_kue'];?></td>
                                                <td><?php echo $c ['kategori'];?></td>
                                                <td><?php echo $c ['nama'];?></td>
                                                <td><?php echo $c ['keterangan'];?></td>
                                                <td style="text-align: center;"><img src="gambar_kue/<?php echo $c['gambar']; ?>" style="width: 120px; height: 100px"></td>
                                                <td><?php echo $c ['harga'];?></td>
                                                <td><?php echo $c ['status'];?></td>

                                                <td>
                                                    <a href="home.php?page=data_produk&&edit=<?php echo $c['id_kue']; ?>">
                                                    <button type="submit" class="btn btn-primary btn-sm" name="edit">Edit</button>
                                                    </a>

                                                    <a href="aksi_produk.php?delete=<?php echo $c['id_kue']; ?>">
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
