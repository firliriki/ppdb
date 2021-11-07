<?php
    $title = "Registrasi";
    include "header.php";
    include "koneksi.php";
?>
    <div id="welcome">
        <div class="row no-gutters min-vh-100">
            <div class="content col-md-6 d-flex align-items-center">
                <div class="inner">
                    <div class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </div>
                    <h1>Welcome to SMK MARYNOLL</h1>
                    <p>Sistem Pendaftaran Siswa Baru 2021 / 2022</p>
                </div>
            </div>
            <div class="form col-md-6 d-flex align-items-center">
                <div class="inner">
                    <h1>Registrasi</h1>

                    <!-- Pesan Error -->
                    <?php if(isset($_GET["pesan"])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_GET["pesan"]; ?>
                        </div>
                    <?php } ?>
                    <!-- End Pesan Error -->
                    
                    <?php

                    $kuota = "SELECT * FROM tb_kuota";
                    $k_res = @mysqli_query($conn,$kuota);
                    $rsKuota = @mysqli_fetch_array($k_res);



                    if(@$rsKuota["kuota_daftar"]==0){


                ?>

                    <form action="simpan_reg.php" method="POST">
                        <div class="form-group">
                            <label for="nama">NAMA</label>
                            <input type="text" class="form-control" name="nama" id="nama" aria-describedby="nama">                          
                          </div>                        
                        <div class="form-group">
                          <label for="nisn">NISN</label>
                          <input type="text" class="form-control" name="nisn" id="nisn" aria-describedby="nisn">                          
                        </div>
                        <div class="form-group">
                          <label for="password">PASSWORD</label>
                          <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <small id="emailHelp" class="form-text text-muted">Sudah punya Akun ? <a href="index.php">Login</a></small>
                        </div>
                        <button type="submit" class="btn btn-primary">REGISTER</button>
                    </form>
                    <?php } else { ?>
                        <h2>Maaf Kuota Pendaftaran Sudah Terpenuhi!</h2>
                    <?php } ?>                    
                </div>
            </div>
        </div>
    </div>
   <?php
        include "footer.php";
   ?>