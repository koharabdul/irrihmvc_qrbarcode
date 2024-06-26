<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title.' | '.$subtitle; ?></title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">


</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Welcome to IN+</h2>

                <p>
                    Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                </p>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                </p>

                <p>
                    When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <p>
                    <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">

                    <?php $attributes = array('role' => 'form' , 
                                               'class' => 'm-t'); ?>
                    <?php echo form_open('login', $attributes); ?>
                        <div class="form-group">
                            <?php 
                                echo form_input('username', 
                                                 set_value('username'), 
                                                 array('class' => 'form-control',
                                                       'type' => 'text',
                                                       'placeholder' => 'Username')); 
                            ?>

                                <span class="help-block" style="color:red;">
                                    <?php echo form_error('username'); ?>
                                </span>
                        </div>
                        <div class="form-group">
                            <?php 
                                echo form_password('password', 
                                                 set_value('password'), 
                                                 array('class' => 'form-control',
                                                       'placeholder' => 'Password')); 
                            ?>
                            <span class="help-block" style="color:red;">
                                <?php echo form_error('password'); ?>
                            </span>
                        </div>
                        <!-- <div class="form-group">
                            <?php 
                                echo form_password('confirm_password', 
                                                 set_value('confirm_password'), 
                                                 array('class' => 'form-control',
                                                       'placeholder' => 'Confirm Password')); 
                            ?>
                            <span class="help-block" style="color:red;">
                                <?php echo form_error('confirm_password'); ?>
                            </span>
                        </div>            -->             
                        <?php $data = array('type' => 'submit', 'class' => 'btn btn-primary block full-width m-b', 'content' => 'Login');
                            echo form_button($data);
                        ?>
                        <a href="#">
                            <small>Forgot password?</small>
                        </a>

                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
                    </form>
                    <p class="m-t">
                        <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Example Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2014-2015</small>
            </div>
        </div>
    </div>

</body>

</html>
