<?php
      session_start();
      if (isset($_SESSION['login'])){

      }else{
          header('Location: index.php');
      }

      $login = @$_SESSION["login"];

      include "koneksi.php";

    ?>
<html>
    <head>
        <title>Pengumuman</title>
    </head>
    <body>
    <?php
        // session_start();

        $sql_ver ="SELECT * FROM tb_pendaftaran WHERE nisn='".$login["nisn"]."'";
        $result_ver = @mysqli_query($conn,$sql_ver);
        $rsDaftar = @mysqli_fetch_array($result_ver);
        
        if(@$rsDaftar["verifikasi"]==1){
                    

            
            include "vendor/autoload.php";
            $mpdf = new \Mpdf\Mpdf();
            ob_start();
        ?>
        <style>
            @page { margin: 0 2%; }
            h5 { padding: 1px 0; text-align: center;}
            body { font-family: helvetica; }
            
        </style>
        <table width="100%">
            <tr>
                <td width="10%">
                    <img src="assets/images/logo.png" alt="" width="100">
                </td>
                <td style="width:100%; text-align: center;">
                    <h2>SMA NEGERI 1 SRAGEN</h2>
                    <p>Jl Sukowati no.41 Sragen <br/>www.sman1srg.com , Email : mail@sman1srg.com, Telp :(0271) 696969 </p>
                </td>
            </tr>
        </table>
        <?php
                    $nama = $_GET["nama"];
        ?>
        <div class="kep" style="text-align: center;">
            <h2>Pengumuman Kegiatan</h2>
            <h4 style="padding: 40px 0 10px 0;">Selamat Saudara/i <?= $nama ?>, Anda telah diterima sebagai Murid baru SMA 1 Sragen, sebagai aktifias pertama anda sebagai siswa. maka siswa wajib mengikuti masa orientasi yang akan dilaksanakan pada :</h4>
        <table width="100%" style="margin-left: 200px; padding: 20px 0;">
           <tr>
            <th>Hari/Tanggal</th>
            <td>: Senin 25 April 2021</td>
            </tr>
            <tr>
            <th>Tempat</th>
            <td>: Gedung Serbaguna SMA 1 Sragen</td>
            </tr>
            <tr>
            <th>Keperluan</th>
            <td>: Pengenalan lingkungan sekolah</td>
            </tr>
        </table>
            <h4>Maka dari itu siswa/i wajib mengikuti acara yang diselenggarakan oleh pihak sekolah</h4>
            </div>

            <div class="ttd" style="margin-left:60%; margin-top:40%; text-align: center;">
            <h5>Mengetahui :</h5>
            <h5>Kepala Sekolah SMA 1 Sragen</h5>
            <br>
            <br>
            <h3>SUROSO</h3>
            </div>

        <?php
            $mpdf->AddPage();
        ?>
        <!-- New Page -->

        <table width="100%">
            <tr>
                <td width="10%">
                    <img src="assets/images/logo.png" alt="" width="100">
                </td>
                <td style="width:90%;text-align: center;">
                    <h2>SMA NEGERI 1 SRAGEN</h2>
                    <p>Jl Sukowati no.41 Sragen <br/>www.sman1srg.com , Email : mail@sman1srg.com, Telp :(0271) 696969 </p>
                </td>
            </tr>
        </table>
        <h2 style="text-align: center;">Jadwal Kegiatan</h2>
        <div class="tbl" style="padding: 100px 0;">
        <table id="data" border=1 width="100%">
            <thead height="50px; ">
                <tr>
                    <th>Senin 25 April</th>
                    <th>Selasa 26 April</th>
                    <th>Rabu 27 April</th>
                    <th>Kamis 28 April</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>- Upacara Pembuka <br> - Pengenalan Guru <br> -Pengenalan Organisasi</td>
                        <td>- Bedah Buku <br> -Talkshow Alumni <br> -Siraman Rohani</td>
                        <td>- Senam Pagi <br> -Jogging 10km <br> -Pengundian Doorprize</td>
                        <td>-Pembagian Kelas <br> -Pembagian Jadwal</td>
                    </tr>
            </tbody>
        </table>
        </div>

        <?php
                $html = ob_get_contents();
                ob_end_clean();
                $mpdf->WriteHTML($html);
                $mpdf->Output();
        ?>
        <?php
        }else {
        
        ?>
        <h2>Data anda belum diverifikasi!!</h2>
        <?php
        }
        ?>
    </body>
</html>