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
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Masukan Member</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Masukan Member</li>
                        </ol>

                        <div class="container">

                        <a href="home.php?page=data_masukan" style="margin-right :0.5pc;" 
							class="btn btn-success btn-md pull-right">
							<i class="fa fa-refresh"></i> Refresh Data</a>
						<div class="clearfix"></div>
						<br/>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabel Masukan Member
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Username</th>
                                            <th>Telepon</th>
                                            <th>Komentar</th>
                                            <th>Create date</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Username</th>
                                            <th>Telepon</th>
                                            <th>Komentar</th>
                                            <th>Create date</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        include "aksi_bank.php";
                                        include "config/config.php";

                                        $query = "SELECT * FROM masukan";

                                        $tampil = $conn->query($query);
                                        while ($c=$tampil->fetch_array()) {?>
                                            <tr>
                                                <td><?php echo $c ['id'];?></td>
                                                <td><?php echo $c ['username'];?></td>
                                                <td><?php echo $c ['telepon'];?></td>
                                                <td><?php echo $c ['komentar'];?></td>
                                                <td><?php echo $c ['createdate'];?></td>
                                                <td>
                                                    <a href="aksi_masukan.php?delete=<?php echo $c['id']; ?>">
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
