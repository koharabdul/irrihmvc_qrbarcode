			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $subtitle; ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <?php echo $runlink; ?>
                        <li>
                            <a href="<?php echo base_url(); ?>forms">Forms</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().'forms/createnext/'.$results['id']?>"><?php echo $results['name']; ?></a>
                        </li>
                        <li class="active">
                            <strong>Properties</strong>
                        </li>
                    </ol>
                </div>
            </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox">
                        <?php $attributes = array("name" => "formopen".$subtitle, "method" => "post", "class" => "form-horizontal");
                            echo form_open(strtolower($subtitle)."/savepropertieseditor", $attributes);
                        ?> 
                        
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="m-b-md">
                                            <div class="btn-group pull-right">
                                                <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-check" style="margin-right: 5px;"></i>  Save</button>
                                                <button class="btn btn-white btn-sm" type="button">Preview</button>
                                            </div>
                                            <h2>Properties Editor</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-sm">
                                    <div class="col-lg-12">
                                        <div class="panel blank-panel">
                                            <div class="panel-heading">
                                                <div class="panel-options">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#tab-1" data-toggle="tab">Edit <?php echo $propertiesEditor; ?></a></li>
                                                        <li class=""><a href="#tab-2" data-toggle="tab">Advanced Options</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">

                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab-1">

                                                        <!-- <div class="feed-activity-list"> -->
                                                          
                                                            <?php input_text('label', 'Label', '',true,false,'') ?>   

                                                            <?php input_text('name', 'Name & ID', '',true,false,'') ?>   
                                                        <!-- </div> -->
                                                    </div>
                                                    <div class="tab-pane" id="tab-2" >

                                                        <!-- <div class="feed-activity-list"> -->
                                                                
                                                            <?php input_text('lab', 'Label', '',true,false,'') ?> 

                                                            <?php input_text('name', 'Name & ID', '',true,false,'') ?>  
                                                             <?php input_text('lab', 'Label', '',true,false,'') ?> 

                                                            <?php input_text('name', 'Name & ID', '',true,false,'') ?>        
                                                        <!-- </div> -->

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>