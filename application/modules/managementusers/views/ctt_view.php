            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2><?php echo $subtitle; ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <?php echo $runlink; ?>
                        <li>
                            <a href="<?php echo base_url().$mylink ?>"><?php echo $subtitle; ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo $results['name'] ?></strong>
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
                                                <button class="btn btn-primary btn-sm" type="button" id="btnUpdatedUsv"><i class="fa fa-check" style="margin-right: 5px;"></i>  Save</button>
                                                <button class="btn btn-white btn-sm" type="reset" id="reset">Cancel</button>
                                            </div>
                                            <h2>View</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-sm">
                                    <div class="col-lg-12">
                                        <div class="panel blank-panel">
                                            <div class="panel-heading">
                                                <div class="panel-options">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active "><a href="#tab-1" data-toggle="tab" class="skin2">Edit <?php echo $results['name'] ?></a></li>
                                                        <li class=""><a href="#tab-2" data-toggle="tab" class="skin2">Advanced Options</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">

                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab-1">

                                                        <fieldset>
                                                         
                                                        </fieldset> 
                                                        
                                                    </div>
                                                    <div class="tab-pane" id="tab-2" >

                                                        

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

        

        
        <script>
            $(document).ready(function(){
                
                $("#reset").click(function(){
                    
                });
               
            });
        </script>