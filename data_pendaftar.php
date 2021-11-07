<?php 
    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }
    session_start();
        if (isset($_SESSION['login'])){

    }else{
    header('Location: index.php');
    }

    $title = "Form Pendaftaran";
    include "koneksi.php";
    include "header.php"; 
    
    $query = mysqli_query($conn, "SELECT * FROM tb_pendaftaran");
?>
    <div id="dashboard">
        <div class="row no-gutters">
            <?php 
                include "sidebar.php";
            ?>
        </div>
        <div class="main-content col-md-10 ml-auto">
                <div class="title">
                    <h2>Daftar Calon Siswa</h2>
                </div>
        <div id="tabel_wrapper" class="dataTables_wrapper">
        <table class="table table-striped table-bordered dt-responsive nowrap tabel" style="width:100%">

        <thead>
            <tr>
                <th>NISN</th>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Tempat Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th data-priority="1">Action</th>
                <th>Alamat</th>
                <th>Agama</th>
                <th>Telp</th>
                <th>Orang tua/Wali</th>
                <th>Alamat Orang tua/Wali</th>
                <th>No.Hp Orang tua/Wali</th>
                <th>Nilai UAN</th>
                <th>Nilai UAS</th>
                <th>Rata-Rata</th>
                <th>Dokumen</th>
                <th>Status</th>
                <th>Verifikasi</th>
            </tr>
        </thead>
        <tbody>
        <?php

            while($rsDaftar = mysqli_fetch_array($query)):
                $rt =($rsDaftar["n_uan"]+$rsDaftar["n_uas"])/2;
                $alert = ["warning","success"];
                $status = ["Terdaftar","Diserahkan"];
                $verifikasi = ["Belum Verifikasi","Verified"];
        ?>
        <tr>
                <td><?= $rsDaftar["nisn"]; ?></td>
                <td><?= $rsDaftar["nm_siswa"]; ?></td>
                <td><?= $rsDaftar["asal_sekolah"]; ?></td>
                <td><?= $rsDaftar["tmp_lahir"]." ".date("d M Y",strtotime($rsDaftar["tgl_lahir"])); ?></td>
                <td><?php if($rsDaftar["jk"]==1){ echo "Laki-laki";} else { echo "Perempuan"; }?></td>
                <td>
                <?php
                    $sql ="SELECT * FROM tb_users WHERE nisn='".$login["nisn"]."'";
                    $result = @mysqli_query($conn,$sql);
                    $rsDaftar_ad = @mysqli_fetch_array($result);

                    if(@$rsDaftar_ad["level"]=="Admin" || @$rsDaftar_ad["level"]=="Super Admin"){
               
                        if($rsDaftar["status"]==1){
                            if($rsDaftar["verifikasi"]==0){
                    ?>
                    <a href="update_verifikasi.php?id=<?= $rsDaftar["id_daftar"] ?>&verifikasi=1" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                    <a href="update_status.php?id=<?= $rsDaftar["id_daftar"] ?>&status=0" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                    <?php
                            } else {
                    ?>
                    <a href="update_verifikasi.php?id=<?= $rsDaftar["id_daftar"] ?>&verifikasi=0" class="btn btn-danger btn-sm">UNVERIFIED</a>
                    <?php
                            }
                        }
                     }else{ 
                      }
                    ?>
                </td>
                <td><?= $rsDaftar["alamat"]." ".$rsDaftar["kota"]; ?></td>
                <td><?= $rsDaftar["agama"]; ?></td>
                <td><?= $rsDaftar["telp"]; ?></td>
                <td><?= $rsDaftar["nm_ortu_wali"]; ?></td>
                <td><?= $rsDaftar["alamat_ortu_wali"]; ?></td>
                <td><?= $rsDaftar["telp_ortu_wali"]; ?></td>
                <td><?= $rsDaftar["n_uan"]; ?></td>
                <td><?= $rsDaftar["n_uas"]; ?></td>
                <td><?= $rt ?></td>
                <td>
                    <a href="uploads/foto/<?= $rsDaftar["foto"] ?>"> Lihat Foto</a>
                    <a href="uploads/dokumen/<?= $rsDaftar["dokumen"] ?>"> Lihat Dokumen</a>
                </td>
                <td><span class="badge badge-<?= $alert[$rsDaftar["status"]] ?>"><?= $status[$rsDaftar["status"]] ?></span></td>
                <td><span class="badge badge-<?= $alert[$rsDaftar["verifikasi"]] ?>"><?= $verifikasi[$rsDaftar["verifikasi"]] ?></span></td>
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
<?php include "footer.php"; ?>