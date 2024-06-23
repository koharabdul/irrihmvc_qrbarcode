    <link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    
    
           <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2>Pages</h2>
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
                            <li class="<?php if($this->uri->segment(2)=='vew'){echo'active';} ?>"><a data-toggle="tab" href="#tab-1"> Properties</a></li>
                            <li class="<?php if($this->uri->segment(2)=='edt'){echo'active';} ?>"><a data-toggle="tab" href="#tab-2"> Edit Page</a></li>
                            <li class="pull-right"><?php echo anchor(strtolower($subtitle).'/dlt/'.$results['id'],'<i class="fa fa-trash"></i> Delete Page </a>',array('onclick' => "return confirm('are you sure want to delete?');")); ?>
                                </li>
                        </ul>
                        <div class="tab-content">

                                
                            <div id="tab-1" class="tab-pane <?php if($this->uri->segment(2)=='vew'){echo'active';} ?>" >
                                <!-- <div class="mail-box"> -->
                                <div class="panel-body">
                                    <h3>View Detail</h3>
                                    <table class="table table-info" style="padding-bottom: 0px; margin-bottom: 0px;">
                                        <tbody>
                                            <tr >
                                                <td width="150px">Page Name</td>
                                                <td class="mail-subject" align="left">: <?php echo $results['name']; ?></td>
                                            </tr>
                                            <tr >
                                                <td width="150px">Description</td>
                                                <td class="mail-subject" align="left">: <?php echo $results['description']; ?></td>
                                            </tr>
                                            <tr >
                                                <td width="150px">Landing Page</td>
                                                <td class="mail-subject" align="left">: <?php echo $results['landing_page']; ?></td>
                                            </tr>
                                            <tr >
                                                <td width="150px">Active</td>
                                                <td class="mail-subject" align="left">
                                                    : <?php 
                                                        echo ($results['active']) ? "<input type='checkbox' class='i-checks' checked name='active[]' value='1' disabled='true' >" : "<input type='checkbox' class='i-checks' name='active[]' value='1' disabled='true'>";
                                                    ?>                                                        
                                                </td>
                                            </tr>
                                            <tr >
                                                <td width="150px">Count Groups :</td>
                                                <td class="mail-subject" align="left">: <?php echo $results['countgroups']; ?></td>
                                            </tr>
                                            <tr >
                                                <td width="150px">Date Created</td>
                                                <td class="mail-subject" align="left">: <?php echo date_convert($results['date_created'],true); ?></td>
                                            </tr>
                                            <tr >
                                                <td width="150px">Created By</td>
                                                <td class="mail-subject" align="left">: <?php echo $results['nm_lengkap']; ?></td>
                                            </tr>
                                            <tr >
                                                <td width="150px">Date Modified</td>
                                                <td class="mail-subject" align="left">: <?php 
                                                    if($results['date_modified']==''){
                                                        echo'-';
                                                    }else{
                                                        echo date_convert($results['date_modified'],true);
                                                    }
                                                    ?>
                                                    </td>
                                            </tr>
                                            <tr >
                                                <td width="150px">Modified By</td>
                                                <td class="mail-subject" align="left">: 
                                                    <?php 
                                                        if($results['modified_by']==''){
                                                            echo'-';
                                                        }
                                                        else{
                                                            echo $nm_lengkap['nm_lengkap'];
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <!-- </div> -->
                            </div>


                            <div id="tab-2" class="tab-pane <?php if($this->uri->segment(2)=='edt'){echo'active';} ?>">
                                <div class="panel-body">
                                    <h3>Form Update</h3>
                                    <hr class="jumbotron-hr" style="margin-top: 0px;">
                                    <?php $attributes = array("name" => "formedtPages", "method" => "post", "class" => "form-horizontal");
                                        echo form_open("groups/edt/$results[id]", $attributes);
                                    ?> 
                                       
                                        <?php input_text('name', 'Group Name', $results['name'],true,false) ?>
                                        <?php input_text('description', 'Description', $results['description'],true,false) ?>
                                        <?php input_text('landing_page', 'Landing Page', $results['landing_page'],true,false) ?>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Autorize Pages <font color="red">&nbsp;* </font></label>
                                            <div class="col-sm-10">
                                                <?php 
                                                    echo"<select class='select2_demo_3 form-control' multiple='multiple' name='pages[]' style='width:100%'>";
                                                    foreach ($groupid as $k) {
                                                        if($k->groups==''){
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
                                                    <?php echo form_error('pages[]'); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Active</label>
                                            <div class="col-sm-10">
                                                <?php 
                                                    if($results['active']==1)
                                                    {
                                                        echo "<input type='checkbox' class='i-checks' checked name='active' value='1' >" ;
                                                    } 
                                                    else{
                                                        echo "<input type='checkbox' class='i-checks' name='active' value='1'>";
                                                    }
                                                ?>
                                                <span class="help-block m-b-none" style="color:red;">
                                                    
                                                </span>
                                            </div>
                                        </div>
                                        <?php btn_saveAndback('Back',strtolower($subtitle),'submit','Save'); ?>    
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <?php echo $this->session->flashdata('infosaveupdate'); ?>
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