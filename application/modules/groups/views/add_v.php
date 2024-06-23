    <link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    
   


            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Pages</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().strtolower($subtitle) ?>"><?php echo $subtitle; ?></a>
                        </li>
                        <li class="active">
                            <strong>Add</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create New Group</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                
            

                <div class="ibox-content">
                    <div class="row wrapper white-bg page-heading">
                        <?php $attributes = array("name" => "formGroups", "method" => "post", "class" => "form-horizontal");
                            echo form_open("groups/sad", $attributes);
                        ?> 
                            <div class="col-lg-12">


                                <?php input_text('name', 'Page Name', '',true,false) ?>
                                <?php input_text('description', 'Description', '',true,false) ?>
                                <?php input_text('landing_page', 'Landing Page', '',true,false) ?>
                                <?php input_multiselect('pages[]','Pages',$datapages,'',true);?>
                                <?php input_checkboxichecks('active', 'Active','1', 'i-checks') ?>
                               
                                <?php btn_saveAndback('Back',strtolower($subtitle),'submit','Save'); ?> 
                             </div>
                        <?php echo form_close(); ?> 
                    </div>
                </div>

            
            </div>



        </div>
        <?php echo $this->session->flashdata('infosaveadd'); ?>

    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>

    <!-- pace.min merupakan cara untuk menghindari error pada chat/time gitu lah -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            
        
        });
    </script>

    

    
   
    
       
       