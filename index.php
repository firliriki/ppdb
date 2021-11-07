<?php
    $title = "Login";
  include "header.php";
?>
    <div id="welcome">
        <div class="row no-gutters min-vh-100">
            <div class="content col-md-6 d-flex align-items-center">
                <div class="inner">
                    <div class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </div>
                    <h1><div id="logs"> Welcome to SMA 1 SRAGEN </div></h1>
                    <p>Sistem Pendaftaran Siswa Baru 2021 / 2022</p>
                </div>
            </div>
            <div class="form col-md-6 d-flex align-items-center">
                <div class="inner">
                    <h1 style="color: black;">Login</h1>

                    <!-- Pesan Error -->
                    <?php if(isset($_GET["pesan"])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_GET["pesan"]; ?>
                        </div>
                    <?php } ?>

                    
                    <!-- End Pesan Error -->
                    <form action="cek_login.php" method="POST">
                        <div class="form-group">
                          <label for="nisn">NISN</label>
                          <input type="text" class="form-control" name="nisn" id="nisn" aria-describedby="nisn">                          
                        </div>
                        <div class="form-group">
                          <label for="password">PASSWORD</label>
                          <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <small id="emailHelp" class="form-text text-muted">Belum punya Akun ? <a href="registrasi.php">Registrasi</a></small>
                        </div>
                        <button type="submit" class="btn btn-primary">LOGIN</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
   <?php
    include "footer.php";
   ?>