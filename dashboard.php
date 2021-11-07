<?php
        session_start();
        if (isset($_SESSION['login'])){

        }else{
            header('Location: index.php');
        }

        
?>

<?php
$title = "Dashboard";
  include "koneksi.php";
  include "header.php";
?>
    <div id="dashboard">
        <div class="row no-gutters">
            <?php
                include "sidebar.php";
            ?>
            <div class="main-content col-md-10 ml-auto">
                <div class="title">
                    <h2>Dashboard</h2>
                </div>
                <!-- error -->

                <?php if(isset($_GET["pesan"])){ ?>
                <div class="alert alert-<?php echo $_GET["type"]; ?>" role="alert"><?php echo $_GET["pesan"]; ?></div>

               <?php } ?>
                    <!-- end error -->
                <div class="info">
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
                    </div>
                </div>
                <div class="title">
                    <h2>Data Pendaftar</h2>
                </div>

                <?php
                    $sql_ckdt = "SELECT count(*) as total FROM tb_pendaftaran WHERE verifikasi=1";
                    $result = @mysqli_query($conn,$sql_ckdt);
                    $total = @mysqli_fetch_array($result);
               

                if ($total>0){
                ?>
                <table id="dt-pendaftaran" class="table dt-responsive nowrap tabel">
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th>UAN</th>
                            <th>UAS</th>
                            <th>RATA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $sql = "SELECT *,((n_uan+n_uas)/2) as rata FROM tb_pendaftaran WHERE verifikasi=1 ORDER BY rata DESC,n_uan DESC,n_uas DESC LIMIT 0,200";
                                $result = @mysqli_query($conn,$sql);
                                while($rsDaftar = @mysqli_fetch_array($result)):
                                    $rata = ($rsDaftar["n_uan"]+$rsDaftar["n_uas"])/2;

                        ?>
                        <tr>
                                <td width="15%"><?= $rsDaftar["nisn"] ?></td>
                                <td><?= $rsDaftar["nm_siswa"] ?></td>
                                <td><?= $rsDaftar["asal_sekolah"] ?></td>
                                <td style="width:8%;text-align: center;"><?= number_format($rsDaftar["n_uan"],"2",",",".") ?></td>
                                <td style="width:8%;text-align: center;"><?= number_format($rsDaftar["n_uas"],"2",",",".") ?></td>
                                <td style="width:8%;text-align: center;"><?= number_format($rata,"2",",",".") ?></td>
                        </tr>
                        <?php
                            endwhile;
                        ?>
                    </tbody>
                </table>
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
    <?php
    include "footer.php";
   ?>