<?php
    // session_start();
    $login = @$_SESSION["login"];
?>


<div class="side-content col-md-2 min-vh-100 position-fixed">
                <div class="inner">
                    <div class="logo">
                        <img src="assets/images/logo.png" alt="">
                        <h3>SMA 1 SRAGEN</h3>
                    </div>
                    <div class="info-login">
                        <div class="d-flex">

                        <?php
                        $sql ="SELECT * FROM tb_pendaftaran WHERE nisn='".$login["nisn"]."'";
                        $result = @mysqli_query($conn,$sql);
                        $rsDaftar = @mysqli_fetch_array($result);
                        if(@$rsDaftar["foto"]){
                        ?>
                            <img src="uploads/foto/<?php echo $rsDaftar["foto"]; ?>" alt="">
                        <?php } else {?>
                            <img src="assets/images/users.jpg" alt="">
                        <?php
                        }
                        ?>
                            <p>
                                <strong class="d-block"><?php echo @$login["nm_user"]; ?></strong>
                                <small><?php echo @$login["level"]; ?></small>
                                <a href="update_password.php" class="btn btn-warning btn-sm" style="margin: 3px 0; padding: 3px;">Ganti Password</a>
                            </p>
                        </div>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                        </li>
                        <?php
                            if($login["level"]=="Siswa") {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="frm_pendaftaran.php"><i class="fas fa-file-alt"></i> Formulir Pendaftaran</a>
                        </li>
                        <?php
                            }
                        ?>
                        <?php
                            if($login["level"]=="Admin" || $login["level"]=="Super Admin") {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="data_pendaftar.php"><i class="fas fa-table"></i> Data Pendaftar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="data_user.php"><i class="fas fa-user"></i> Users</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="frm_laporan.php"><i class="fas fa-print"></i> Laporan</a>
                        </li>
                        <?php
                            }
                        ?>
                        <?php
                            if($login["level"]=="Super Admin") {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="super_admin.php"><i class="fas fa-crown"></i> Super Admin Acces</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="lulus.php"><i class="fas fa-crown"></i> Seleksi Penerimaan</a>
                        </li>
                        <?php
                            }
                        ?>
                         <?php
                        if(@$rsDaftar["verifikasi"]==1 && @$rsDaftar["lulus"]==1){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="print_bukti.php" target="blank"><i class="fas fa-file-alt"></i> Unduh Surat Penerimaan</a>
                        </li>
                        <?php
                            }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>