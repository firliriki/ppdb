<?php
        session_start();
        if (isset($_SESSION['login'])){

        }else{
            header('Location: index.php');
        }

        
?>

<?php
$title = "Laporan";
  include "header.php";
?>
    <div id="dashboard">
        <div class="row no-gutters">
            <?php
                include "sidebar.php";
            ?>
            <div class="main-content col-md-10 ml-auto">
                <div class="title">
                    <h2>Laporan</h2>
                </div>
                    <div class="row">
                      <div class="col-md-6">
                          <h2>Export Excel</h2>
                          <a href="rpt_pendaftaran.php" class="btn btn-warning mt-3 d-block">Export Semua Data</a>
                          <a href="rpt_pendaftaran.php?status=1" class="btn btn-warning mt-3 d-block">Export Diserahkan</a>
                          <a href="rpt_pendaftaran.php?verifikasi=1" class="btn btn-warning mt-3 d-block">Export Sudah Verifikasi</a>
                          <a href="rpt_pendaftaran.php?lulus=1" class="btn btn-warning mt-3 d-block">Export Siswa Diterima</a>
                      </div>
                      <div class="col-md-6">
                          <h2>Export PDF</h2>
                          <a href="rpt_pengumuman.php" class="btn btn-warning mt-3 d-block">Pengumuman Pendaftaran</a>
                      </div>  
                </div>
            </div>
        </div>
    </div>
    <?php
    include "footer.php";
   ?>