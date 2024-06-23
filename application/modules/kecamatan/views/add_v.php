            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $subtitle; ?></h2>
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
                    <h5>Add New <?php echo $subtitle; ?></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                
            

                 <div class="ibox-content" style="padding-bottom: 5px; padding-top: 5px;">
                    <div class="row wrapper white-bg page-heading" style="padding-bottom: 0px; padding-top: 5px;">
                        <?php $attributes = array("name" => "formGroups", "method" => "post", "class" => "form-horizontal");
                            echo form_open_multipart(strtolower($subtitle).'/save', $attributes);
                        ?>
                        
                                
                            <?php input_text('nama_kecamatan', 'Kecamatan', '',true,false) ?>
                            <?php input_select('kabupaten_id','Kabupaten',$datapages,'',true);?>

                            
                                
                            
                               
                            <?php btn_saveAndback('Back',strtolower($subtitle),'','Save'); ?>                       
                        <?php echo form_close(); ?> 
                    </div>




                    
                </div>
            </div>
        </div>
        <?php echo $this->session->flashdata('infosaveadd'); ?>

    
    
        
    
       
       