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
             
                <div class="title">
                    <h2>Seleksi Pendaftar</h2>
                </div>
                <!-- error -->

                <?php if(isset($_GET["pesan"])){ ?>
                <div class="alert alert-<?php echo $_GET["type"]; ?>" role="alert"><?php echo $_GET["pesan"]; ?></div>

               <?php } ?>
                    <!-- end error -->

                <!-- Button Modal -->
                    <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" style="margin-left: 50%;" data-toggle="modal" data-target="#lulus">
            Mulai Seleksi Kelulusan
            </button>

            <!-- Modal -->
            <div class="modal fade" id="lulus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seleksi Kelulusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="launch_lulus.php" method="POST">
                <label for="jml">Jumlah siswa yang diterima</label>
                <input type="text" class="form-control" name="jml" id="jml" aria-describedby="jml" required>    
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">MULAI SELEKSI</button>
                </form>
                </div>
                </div>
            </div>
            </div>
                <!-- End Button Modal -->
                
                <table id="dt-pendaftaran" class="table dt-responsive nowrap tabel">
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th>UAN</th>
                            <th>UAS</th>
                            <th>RATA</th>
                            <th>Keputusan</th>
                            <th>Tgl seleksi</th>
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
                                <td><?php if($rsDaftar["lulus"]==1){?> <p style="color: green;"><?= "Diterima"; ?></p> <?php } elseif($rsDaftar["lulus"]==2){?> <p style="color: green;"><?= "Ditolak"; ?></p> <?php } else { ?> <p style="color: red;"><?= "Tidak Diterima"; }?></td>
                                <td><?= $rsDaftar["updated_at"] ?></td>
                        </tr>
                        <?php
                            endwhile;
                        ?>
                    </tbody>
                </table>
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