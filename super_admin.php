<?php
        session_start();
        if (isset($_SESSION['login'])){

        }else{
            header('Location: index.php');
        }

        if(!@$_SERVER['HTTP_REFERER']){
            die("koneksi error!");
        }
        
?>

<?php
$title = "User Data";
  include "koneksi.php";
  include "header.php";

  $query = mysqli_query($conn, "SELECT * FROM tb_users");

?>

    <div id="dashboard">
        <div class="row no-gutters">
            <?php
                include "sidebar.php";
            ?>
            <div class="main-content col-md-10 ml-auto">
                <div class="title">
                    <h2>Data User/Admin</h2>
                </div>

                <?php
                $sql_ad ="SELECT * FROM tb_users WHERE id_user='".$login["id_user"]."'";
                $result_ad = @mysqli_query($conn,$sql_ad);
                $rsDaftar = @mysqli_fetch_array($result_ad);

                ?>

                <?php
                    if(@$rsDaftar["level"]=="Super Admin"){
                    
                ?>

                <div id="tabel_wrapper" class="dataTables_wrapper">
        <table class="table table-striped table-bordered dt-responsive nowrap tabel" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama User</th>
                <th>NISN</th>
                <th>Level</th>
                <th>Status</th>
                <th>ACTION</th>
                
            </tr>
        </thead>
        <tbody>
        <?php

            while($rsDaftar = mysqli_fetch_array($query)):
                
        ?>
        <tr>
                <td><?= $rsDaftar["id_user"]; ?></td>
                <td><?= $rsDaftar["nm_user"]; ?></td>
                <td><?= $rsDaftar["nisn"]; ?></td>
                <td><?= $rsDaftar["level"]; ?></td>
                <td><?= $rsDaftar["status"]; ?></td>
                <td>
                <?php 
                        if($rsDaftar["level"]=="Siswa"){
                ?>
                <a href="update_admin.php?id=<?= $rsDaftar["id_user"] ?>&level=Admin" class="btn btn-success btn-sm">Angkat Sbg Admin</a>
                <?php
                     } elseif($rsDaftar["level"]=="Admin") {
                ?>
                    <a href="update_admin.php?id=<?= $rsDaftar["id_user"] ?>&level=Siswa" class="btn btn-danger btn-sm">Turunkan dari Admin</a>
                <?php
                     } else {}
                ?>

                </td>
            </tr>
            <?php
                endwhile;
            ?>
        </tbody>
        </table>
        
        <div id="dashboard">
        <div class="row">
                        <div class="col-md-4">
                            <div class="info-box card mb-3">
                                <div class="row no-gutters">
                                    <div class="icon col-md-4 bg-aqua">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="content">
                                        <?php
                                            $sql_users = "SELECT count(*) as total FROM tb_users";
                                            $result = @mysqli_query($conn,$sql_users);
                                            $total = @mysqli_fetch_array($result);
                                        ?>
                                            <h5>Total Users</h5>
                                            <h1><?= $total[0] ?></h1>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box card mb-3">
                                <div class="row no-gutters">
                                    <div class="icon col-md-4 bg-red">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="content">
                                        <?php
                                            $sql_total = "SELECT count(*) as total FROM tb_pendaftaran";
                                            $result = @mysqli_query($conn,$sql_total);
                                            $total = @mysqli_fetch_array($result);
                                        ?>
                                            <h5>Total Pendaftar</h5>
                                            <h1><?= $total[0] ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box card mb-3">
                                <div class="row no-gutters">
                                    <div class="icon col-md-4 bg-yellow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="content">
                                        <?php
                                            $sql_ver = "SELECT count(*) as total FROM tb_pendaftaran WHERE verifikasi=1";
                                            $result = @mysqli_query($conn,$sql_ver);
                                            $total = @mysqli_fetch_array($result);
                                        ?>
                                            <h5>Total Terverifikasi</h5>
                                            <h1><?= $total[0] ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                        <h5>Hentikan Pendaftaran Penerimaan Siswa??</h5>
                        <a href="update_kuota.php?kuota_daftar=1" class="btn btn-warning btn-sm" style="margin: 3px 0; padding: 3px;">Hentikan!</a>
                        </div>
                        <div class="col">
                        <h5>Buka Kembali Pendaftaran Penerimaan Siswa??</h5>
                        <a href="update_kuota.php?kuota_daftar=0" class="btn btn-warning btn-sm" style="margin: 3px 0; padding: 3px;">Buka Kembali</a>
                        </div>                                                 
                    </div>
        </div>
        <?php
                    } else {
        ?>
            <h1>Super Admin Acces required!!</h1>
        <?php
                }
        ?>
        <script type="text/javascript" class="init">
    $(document).ready(function() {
    $('.tabel').DataTable();
    } ); </script>

        </div>
            </div>
        </div>
    </div>
    <?php
    include "footer.php";
   ?>