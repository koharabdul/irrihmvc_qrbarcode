<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>404 Page Not Found</title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
</head>

<body class="gray-bg">


    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold"><?php echo $heading; ?></h3>

        <div class="error-desc">
            <?php echo $message; ?>
            <br>
       
               
                <button type="submit" class="btn btn-primary" onclick="self.history.back()" title="Back"><i class="fa fa-reply"></i> Back</button>
               <?php echo anchor(base_url(),'<i class="fa fa-home"></i> Home',array('class' => 'btn btn-default','type' => 'botton','title' => 'Edit')); ?>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

</body>

</html>
