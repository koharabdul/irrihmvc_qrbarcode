			<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet"><!-- tambahan untuk tabel pagination bulk -->
			<link href="<?php echo base_url(); ?>assets/css/icheck/flat/green.css" rel="stylesheet"><!-- tambahan untuk tabel pagination bulk -->

 			<link href="<?php echo base_url(); ?>assets/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
            <link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 

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
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>List <?php echo $subtitle; ?> </h5>
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
    		                        <div class="col-sm-4 column-title">
    		                            <?php $attributes = array("name" => "flatihan", 'method' => 'post');
    		                                echo form_open(strtolower($subtitle)."/src", $attributes);
    		                            ?>
    		                                <div class="input-group anto">
    		                                    <?php 
    		                                    	$urione = $this->uri->segment(2);
                                            		if($urione == 'src'){
                                            			$viewcari = $tampilcari;
                                            		}
                                            		else{
                                            			$viewcari = '';
                                            		}
                                            		$data = array('type' => 'text',
    		                                                      'placeholder' => 'Name Pages/Urisegment',
    		                                                      'class' => 'input-sm form-control',
    		                                                      'name' => 'cari',
    		                                                      'value' => $viewcari );
    		                                        echo form_input($data);
    		                                     ?>
    		                                    <span class="input-group-btn">
    		                                        <button type="submit" class="btn btn-sm btn-primary"> Go!</button> 
    		                                    </span>
    		                                </div>
    		                            <?php echo form_close(); ?> 
    		                        </div>
    		                        <div class="col-sm-8 m-b-xs column-title">
    		                            <div class="btn-group">
    		                                <?php echo anchor(strtolower($subtitle).'/add','Add',array('class' => 'btn btn-sm btn-white','type' => 'botton')); ?>
    		                                <?php echo anchor(strtolower($subtitle).'/prt','Print',array('class' => 'btn btn-sm btn-white','type' => 'botton')); ?>
    		                                <button type="botton" class="btn btn-sm btn-white" disabled>Delete</button>
    		                            </div>
    		                        </div>
    		                        <div class="col-sm-4 bulk-actions">
    		                            <div class="input-group anto">
    		                                <?php 
    		                                    	$urione = $this->uri->segment(2);
                                            		if($urione == 'src'){
                                            			$viewcari = $tampilcari;
                                            		}
                                            		else{
                                            			$viewcari = '';
                                            		}
                                            		$data = array('type' => 'text',
    		                                                      'placeholder' => 'Name Pages/Urisegment',
    		                                                      'class' => 'input-sm form-control',
    		                                                      'name' => 'cari',
    		                                                      'value' => $viewcari,
    		                                                  	  'disabled' => 'true');
    		                                        echo form_input($data);
    		                                     ?>
    		                                <span class="input-group-btn">
    		                                    <button type="button" class="btn btn-sm btn-primary" disabled> Go!</button> 
    		                                </span>
    		                            </div>
    		                        </div>
    		                        <?php $attributes = array("name" => "flatihan", 'method' => 'post');
    			                        echo form_open(strtolower($subtitle)."/dlm", $attributes);
    			                    ?>
    			                        <div class="col-sm-8 m-b-xs bulk-actions">
    			                            <div class="btn-group anto">
    			                                <button type="botton" class="btn btn-sm btn-white" disabled>Add</button>
    			                                <button type="botton" class="btn btn-sm btn-white" disabled>Print</button>
    			                                <?php $data = array('type' => 'submit', 'class' => 'btn btn-sm btn-white ', 'content' => 'Delete', 'onclick' => "return confirm('are you sure want to delete?');");
    			                                    echo form_button($data);
    			                                ?>
    			                            </div>
    			                        </div>
    			                    <?php echo form_close(); ?>
    		                    </div>
                            
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="checkall" class="checkitems">
                                    <label>
                                       
                                    </label>
                                </div>

                                <!-- <input type="checkbox" id="checkall" class="checkitems"> -->
                                <input type="submit" id="btn" class="btn btn-sm btn-white" value="Deleted" disabled>


    	                        <div class="lightBoxGallery">
    	                        	<?php 
                                        if(empty($results))
                                        {
                                        	echo"Empty File <br><br>";
                                        }
                                        else
                                        {
                                            foreach ($results as $p) {

                                                $unall = explode("uploads/images/", $p->avatar);
                                                foreach($unall as $v) {
                                                    // echo $v;<input type='checkbox' style='position:absolute; margin:10px;' class='checkitem' name='table_records[]'>
                                                }

                                                echo"
                                                <div class='btn-group'>
                                                    




                                                    <div class='checkbox checkbox-inline' style='position:absolute; margin:10px; widht:0px;'>
                                                        <input type='checkbox' name='table_records[]' class='checkitem' >
                                                        <label>
                                                           
                                                        </label>
                                                    </div>
                                                    <a class='dropdown-toggle' data-toggle='dropdown' href='#' style='position:absolute; margin-left:85px; margin-top:10px; background:transparent;border:none;'>
                                                        <i class='fa fa-chevron-down'></i>
                                                    </a>
                                                    <ul class='dropdown-menu dropdown-user'>
                                                        <li><a href='#'>Edit</a>
                                                        </li>
                                                        <li><a href='#'>Delete</a>
                                                        </li>
                                                        <li><a href='".base_url()."uploadimages/delpermanent/$v'>Permanent Delete</a>
                                                        </li>
                                                    </ul>
        				                            <a href='".base_url()."$p->avatar' title='$p->name_image' data-gallery=''>
        				                            	<img src='".base_url()."$p->small_avatar' >
        				                            </a>
                                                </div>";
                                            }
                                        }
                                    ?>
    	                            

    	                            <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
    	                            <div id="blueimp-gallery" class="blueimp-gallery">
    	                                <div class="slides"></div>
    	                                <h3 class="title"></h3>
    	                                <a class="prev">‹</a>
    	                                <a class="next">›</a>
    	                                <a class="close">×</a>
    	                                <a class="play-pause"></a>
    	                                <ol class="indicator"></ol>
    	                            </div>
    	                        </div>

                            
	                       <!--  <div style="margin-top:10px; margin-bottom: 10px;">
                                <label style="padding-top:5px; font-weight: 100;">
                                    <?php
                                    	if($row>10){
                                    		echo"Showing $sjadi to $tot of $row entries"; 
                                    	} 
                                    ?>  
                                </label>
                                <label class="active pull-right">-->
                                    <!-- untuk pagination -->
                                    <!-- <ul class="pagination" style="padding:0px; margin:inherit; font-weight: 100; ">
                                        <?php 
                                            echo $this->pagination->create_links();
                                        ?>
                                    </ul> -->
                                    <!-- sampai sini pagination -->
                                <!-- </label>
                            </div> --> 
                            <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


		<?php echo $this->session->flashdata('infosave'); ?>
		<?php echo $this->session->flashdata('infodeleted'); ?>


        <!-- pace.min merupakan cara untuk menghindari error pada chat/time gitu lah -->
        <!-- <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script> -->
		<!-- blueimp gallery -->
    	<script src="<?php echo base_url(); ?>assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/icheck/icheck.min.js"></script><!-- ditambahkan untuk tabel pagination dan bulk -->
		<script src="<?php echo base_url(); ?>assets/js/custom.js"></script><!-- ditambahkan untuk tabel pagination dan bulk -->

        
        <script>
            $("#checkall").change(function(){
                $(".checkitem").prop("checked", $(this).prop("checked"));
                if($(".checkitem:checked").length > 0){
                    $('#btn').prop('disabled', false);
                }
                else if($(".checkitem:checked").length == 0){
                    $(".checkitems").prop("checked", false);
                    $('#btn').prop('disabled', true);
                }
                else{
                    $('#btn').prop('disabled', true);
                }
            })
            $(".checkitem").change(function(){
                if($(".checkitem:checked").length > 0){
                    $('#btn').prop('disabled', false);
                    if($(".checkitem:checked").length == $(".checkitem").length){
                        $(".checkitems").prop("checked", true);
                    }
                    else if($(".checkitem:checked").length < $(".checkitem").length){
                        $(".checkitems").prop("checked", false);
                    }
                }
                else if($(".checkitem:checked").length == 0){
                    $(".checkitems").prop("checked", false);
                    $('#btn').prop('disabled', true);
                }
                else{
                    $('#btn').prop('disabled', true);
                }
            });
            $('#btn').click(function(){
                alert('Hello');
            });
            

            
        </script>

        

        
