<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> <?php echo $title.' | '.$subtitle; ?></title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet"><!-- tambahan untuk notification -->

    <link href="<?php echo base_url(); ?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
    <!-- Sweet Alert -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script><!-- ditambahkan untuk jquery bisa bekerja -->

    <style type="text/css">
        table.jambo_table tbody tr:hover td{
            background-color: #e7eaec;
        }
        .skin-1 table.jambo_table tbody tr:hover td{
            background-color: #1486cb2b;
        }
        .skin-2 table.jambo_table tbody tr:hover td{
            background-color: #233b5424;
        }
        .skin-3 table.jambo_table tbody tr:hover td{
            background-color: #ea9b411f;
        }
        .md-skin table.jambo_table tbody tr:hover td{
            background-color: #19c0a01f;
        }
        
        /*table.jambo_table tbody tr.selected{
            background-color: #e7eaec;
        }*/
    </style>
</head>