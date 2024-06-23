			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><?php echo $subtitle; ?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <li class="active">
                            <strong><?php echo $subtitle; ?></strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>List <?php echo $subtitle; ?></h5>
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

                	    <div class="row">
	                        <div class="col-sm-7 column-title">
	                            <?php $attributes = array("name" => "flatihan", 'method' => 'post');
	                                echo form_open($datatampil."/search", $attributes);
	                            ?>
	                                <div class="input-group anto">
	                                    <?php 
	                                    	$urione = $this->uri->segment(2);
                                    		if($urione == 'search'){
                                    			$viewcari = $tampilcari;
                                    		}
                                    		else{
                                    			$viewcari = '';
                                    		}
                                    		$data = array('type' => 'text',
	                                                      'placeholder' => 'Searching for '.$subtitle,
	                                                      'class' => 'input-sm form-control',
	                                                      'name' => 'cari',
	                                                      'id' => 'input_search',
	                                                      'value' => $viewcari );
	                                        echo form_input($data);
	                                     ?>
	                                    <span class="input-group-btn">
	                                        <button type="submit" class="btn btn-sm btn-primary" id="btn_search"> Go!</button> 
	                                    </span>
	                                </div>
	                            <?php echo form_close(); ?> 
	                        </div>
	                        <div class="col-sm-5 m-b-xs column-title">
	                            <div class="btn-group">
	                                <button type="botton" id="btn_add" class="btn btn-sm btn-white">Add</button>
	                                <button type="botton" id="btn_print" class="btn btn-sm btn-white">Print</button>
	                                <button type="botton" id="btn_deleted" class="btn btn-sm btn-white" disabled>Delete</button>
	                                
	                            </div>
	                        </div>
	                    </div>


                    	<!--  -->            



                    </div>                   
                </div>
            </div>
        </div>


    <script type="text/javascript">
    	$('#btn_deleted').click(function(){
            alert('Hello');
        });
        $('#btn_add').click(function(){
            window.location.href="<?php echo base_url().$datatampil; ?>/create";
        });
    </script>