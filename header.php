<?php

$site = "http://localhost/ppdb/";
include "koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $site; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $site; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $site; ?>assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $site; ?>assets/plugins/DataTables/DataTables-1.10.24/css/jquery.dataTables.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $site; ?>assets/plugins/DataTables/DataTables-1.10.24/css/dataTables.bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $site; ?>assets/plugins/DataTables/DataTables-1.10.24/css/dataTables.jqueryui.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $site; ?>assets/plugins/DataTables/DataTables-1.10.24/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $site; ?>assets/plugins/DataTables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $site; ?>assets/plugins/DataTables/DataTables-1.10.24/css/responsive.bootstrap4.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $site; ?>assets/plugins/datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $site; ?>style.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <!-- end fonts -->
    <script type="text/javascript" src="assets/plugins/DataTables/jquery.js"></script>
    
</head>
<body>