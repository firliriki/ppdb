<?php
    if(!@$_SERVER['HTTP_REFERER']){
        die("koneksi error!");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran</title>

    <style>
        table { border-collapse: collapse; }
        table th,table td { border-collapse: collapse; border: 1px solid red; padding: 5px; }
        table th { background-color: #777; color: #fff; }
    </style>
</head>
<body>
        <?php
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Data Pendaftaran.xls");
        ?>

        <?php
            include "koneksi.php";

            $sql = "SELECT * FROM tb_pendaftaran";

            if(isset($_GET["status"])){
                $sql = "SELECT * FROM tb_pendaftaran WHERE status=1";
            }

            if(isset($_GET["verifikasi"])){
                $sql = "SELECT * FROM tb_pendaftaran WHERE verifikasi=1";
            }

            if(isset($_GET["lulus"])){
                $sql = "SELECT * FROM tb_pendaftaran WHERE lulus=1";
            }

            $result = @mysqli_query($conn,$sql);
        ?>
        <table>
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>TANGGAL DAFTAR</th>
                    <th>NAMA</th>
                    <th>ASAL SEKOLAH</th>
                    <th>NILAI UAN</th>
                    <th>NILAI UAS</th>
                    <th>RATA-RATA</th>
                    <th>TEMPAT LAHIR</th>
                    <th>TANGGAL LAHIR</th>
                    <th>ALAMAT</th>
                    <th>JENIS KELAMIN</th>
                    <th>AGAMA</th>
                    <th>TELEPON</th>
                    <th>NAMA ORANG TUA/WALI</th>
                    <th>ALAMAT ORANG TUA/WALI</th>
                    <th>TELEPON ORANG TUA/WALI</th>
                    <th>STATUS</th>
                    <th>VERIFIKASI</th>
                    <?php
                            if(isset($_GET["lulus"])){
                        ?>
                    <th>Keputusan</th>
                    <?php
                            }
                        ?>
                </tr>
            </thead>
            <tbody>
                <?php
                        while($rsDaftar = @mysqli_fetch_array($result)):
                            $rt =($rsDaftar["n_uan"]+$rsDaftar["n_uas"])/2;
                            $alert = ["warning","success"];
                            $status = ["Terdaftar","Diserahkan"];
                            $verifikasi = ["Belum Verifikasi","Verified"];
                ?>
                <tr>
                        <td><?= $rsDaftar["nisn"]; ?></td>
                        <td><?= date("d M Y",strtotime($rsDaftar["created_at"])) ?></td>
                        <td><?= $rsDaftar["nm_siswa"]; ?></td>
                        <td><?= $rsDaftar["asal_sekolah"]; ?></td>
                        <td><?= $rsDaftar["n_uan"]; ?></td>
                        <td><?= $rsDaftar["n_uas"]; ?></td>
                        <td><?= $rt ?></td>
                        <td><?= $rsDaftar["tmp_lahir"]; ?></td>
                        <td><?= $rsDaftar["tgl_lahir"]; ?></td>
                        <td><?= $rsDaftar["alamat"]." ".$rsDaftar["kota"] ?></td>
                        <td><?= $rsDaftar["jk"]==1 ? "Laki-Laki" : "Perempuan" ?></td>
                        <td><?= $rsDaftar["agama"]; ?></td>
                        <td><?= $rsDaftar["telp"]; ?></td>
                        <td><?= $rsDaftar["nm_ortu_wali"]; ?></td>
                        <td><?= $rsDaftar["alamat_ortu_wali"]; ?></td>
                        <td><?= $rsDaftar["telp_ortu_wali"]; ?></td>
                        <td><?= $status[$rsDaftar["status"]]; ?></td>
                        <td><?= $verifikasi[$rsDaftar["verifikasi"]]; ?></td>
                        <?php
                            if(isset($_GET["lulus"])){
                        ?>
                            <td> <?= $rsDaftar["lulus"]==1 ? "Diterima" : "Tidak Diterima" ?></td>
                        <?php
                            }
                        ?>

                </tr>
                      <?php
                      endwhile;
                      ?>
            </tbody>
        </table>

</body>
</html>