            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2><?php echo $subtitle; ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url().strtolower($subtitle) ?>"><?php echo $subtitle; ?></a>
                        </li>
                        <li class="active">
                            <strong>View</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="<?php if($this->uri->segment(2)=='view'){echo'active';} ?>"><a data-toggle="tab" href="#tab-1"> Properties</a></li>
                            <li class="<?php if($this->uri->segment(2)=='update'){echo'active';} ?>"><a data-toggle="tab" href="#tab-2"> Edit</a></li>
                            <li class="pull-right"><?php echo anchor(strtolower($subtitle).'/delete/'.$results['id'],'<i class="fa fa-trash"></i> Delete</a>',array('onclick' => "return confirm('are you sure want to delete?');")); ?>
                                </li>
                        </ul>
                        <div class="tab-content">

                                
                            <div id="tab-1" class="tab-pane <?php if($this->uri->segment(2)=='view'){echo'active';} ?>" >
                                <!-- <div class="mail-box"> -->
                                <div class="panel-body">
                                    <h4>View Detail</h4>
                                    <hr class="jumbotron-hr" style="margin-top: 0px;">
                                    <form class="form-horizontal">
                                        <b><?php input_text2('', 'Nama Kabupaten',$results['kabupaten'],true,true) ?></b>
                                        <?php input_text2('', 'Nama Provinsi',$results['provinsi'],true,true) ?>
                                        <?php input_text2('', 'Date Created', date_convert($results['date_created'],true),true,true) ?>
                                        <?php input_text2('', 'Date Modified', date_convert($results['date_modified'],true),true,true) ?>
                                        <?php input_text2('', 'Created By Name', $results['created_byname'],true,true) ?>
                                        <?php input_text2('', 'Modified By Name', $results['modified_byname'],true,true) ?>
                                    </form>
                                    
                                     
                                    
                                </div>


                                <!-- </div> -->
                            </div>



                            <div id="tab-2" class="tab-pane <?php if($this->uri->segment(2)=='update'){echo'active';} ?>">
                                <div class="panel-body">
                                    <h4>Form Update</h4>
                                    <hr class="jumbotron-hr" style="margin-top: 0px;">
                                        <?php $attributes = array("name" => $subtitle, "method" => "post", "class" => "form-horizontal");
                                            echo form_open_multipart(strtolower($subtitle)."/update/$results[id]", $attributes);
                                        ?>
                                        

                                            <?php input_text('nama_kabupaten', 'Nama Kabupaten', $results['kabupaten'],true,false) ?>
                                            <?php input_hidden('provinsi_id', $results['provinsi_id']); ?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Nama Provinsi
                                                    <font color="red">&nbsp;* </font>
                                                </label>
                                                <div class="col-sm-10">
                                                    <?php 
                                                        echo"<select class='select2_demo_2 form-control' style='width:100%' disabled='true'>";
                                                        foreach ($groupid as $k) {
                                                            if($k->selected==''){
                                                                $selected = '';
                                                            }
                                                            else{
                                                                $selected = 'selected';
                                                            }
                                                            echo"<option value=".$k->id." ".$selected.">".$k->name."</option>";
                                                        } 
                                                        echo"</select>";
                                                    ?>                                                

                                                    <span class="help-block m-b-none" style="color:red;">
                                                        <?php echo form_error('provinsi_id'); ?>
                                                    </span>
                                                </div>
                                            </div>                                            
                                                
                                            
                                               
                                            <?php btn_saveAndback('Back',strtolower($subtitle),'','Save'); ?>                       
                                        <?php echo form_close(); ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->session->flashdata('infoupdate'); ?>