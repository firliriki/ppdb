<?php
        if(!@$_SERVER['HTTP_REFERER']){
            die("koneksi error!");
        }
        session_start();
        if (isset($_SESSION['login'])){

        }else{
            header('Location: index.php');
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
                    <h2>Data User</h2>
                </div>
                
                <!-- error -->

                <?php if(isset($_GET["pesan"])){ ?>
                <div class="alert alert-<?php echo $_GET["type"]; ?>" role="alert"><?php echo $_GET["pesan"]; ?></div>

               <?php } ?>
                    <!-- end error -->
                <div id="tabel_wrapper" class="dataTables_wrapper">
        <table class="table table-striped dt-responsive nowrap tabel" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama User</th>
                <th>NISN</th>
                <th>Level</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Edit</th>
                <th>Hapus</th>
                
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
                <td><?= $rsDaftar["created_at"]; ?></td>
                <td><?= $rsDaftar["updated_at"]; ?></td>
                <td>
                <?php 
                    $sql ="SELECT * FROM tb_users WHERE nisn='".$login["nisn"]."'";
                    $result = @mysqli_query($conn,$sql);
                    $rsDaftar_ad = @mysqli_fetch_array($result);

                    if(@$rsDaftar_ad["level"]=="Admin" || @$rsDaftar_ad["level"]=="Super Admin"){
                ?>
                [<a href="admin_akses.php?id=<?= $rsDaftar["id_user"]; ?>"><i class="fas fa-user-edit"></i></a>]
                </td>
                <td class="center">
                <?php
                if($rsDaftar["level"]!="Super Admin"){
                ?>     
                [<a href="hapus_user.php?id=<?= $rsDaftar["id_user"]; ?>"><i class="fas fa-user-minus"></i></a>]
                <?php 
                 }  
                    }else{ }
                ?>
                </td>
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

        <p style="text-align : center;"><a href="admin_akses.php" class="btn btn-primary">TAMBAH</a></p>
        </div>
            </div>
        </div>
    </div>
    <?php
    include "footer.php";
   ?>