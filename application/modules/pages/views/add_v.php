	<link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/select2/select2/select2.min.css"> -->

   


            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Pages</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>pages">Pages</a>
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
	                <h5>Create New Page</h5>
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

	                <?php $attributes = array("name" => "formaddPages", "method" => "post");
                        echo form_open("pages/sad", $attributes);
                    ?> 
		                <div class="table-responsive">
		                    <table class="table table-striped" id="dynamic_field" style="margin-bottom: 15px;">
		                        <thead>
			                        <tr>
			                            <th>Active </th>
			                            <th>Page Name </th>
			                            <th>Uri </th>
			                            <!-- <th width="350px">Group </th> -->
			                        </tr>
		                        </thead>
		                        <tbody>
			                        <tr>
			                        	<td>
											<input type="checkbox" class="i-checks" checked name="active[]" value="1" >
			                            </td>
			                            <td style="padding-top: 4px; padding-bottom: 0px;">
			                            	<div class="col-lg-12 input-group">
			                            		<input type="text" name="name[]" placeholder="..." class="input-sm form-control" style="background-color: transparent; border: none; padding-left: 0px; padding-right: 0px;" required="true"> 
			                            	</div>
			                            </td>
			                            <td style="padding-top: 4px; padding-bottom: 0px;">
			                            	<div class="col-lg-12 input-group">
			                            		<input type="text" name="uri[]" placeholder="..." class="input-sm form-control" style="background-color: transparent; border: none; padding-left: 0px; padding-right: 0px;" required="true" > 
			                            	</div>
			                            </td>
			                            
			                            <td style="padding-top: 4px; padding-bottom: 0px; width: 30px;">
			                            	<div class="col-lg-12 input-group">
			                            		<button type="button" class="btn btn-sm btn-info pull-right" style="width: 30px;" name="add" id="add"><strong>+</strong></button>
			                            	</div>
			                            </td>
			                        </tr>
		                        </tbody>
		                        <tfoot>
		                        	<tr>
		                        		<td colspan="4" style="padding-top: 0px; padding-right: 0px; padding-left: 0px; height: 32px; padding-bottom: 0px; margin-bottom: 0px; background-color: #f3f3f4;">
		                        			<div class="col-lg-12 input-group" style="padding:none; margin:none; padding-bottom: 0px; margin-bottom: 0px;">
                								<?php 
		                                            echo form_multiselect('group[]', 
		                                                               $datagroups, 
		                                                     set_value('group[]'), 
		                                                     array('class' => 'chosen-select input-sm form-control',
		                                                           'style' => 'padding-left:5px;',
		                                                           'required' => 'true',
		                                                           'vertical-align' => 'top'
		                                            )); 
		                                        ?> 
			                            	</div>
		                        		</td>
		                        	</tr>
		                        </tfoot>
		                    </table>
		                    <div class="form-group pull-right">
		                        <div class="col-sm-12">
		                            <button class="btn btn-sm btn-default m-t-n-xs" type="button" onclick="self.history.back()">Kembali</button>
		                            <button class="btn btn-sm btn-primary m-t-n-xs" type="submit">Save</button>
		                        </div>
		                    </div>
		                </div>

		            <?php echo form_close(); ?>

	                

	            </div>
	        </div>



        </div>

	<script>
		$(document).ready(function(){
			$('.chosen-select').chosen({width: "100%"});//penting untuk multiselect
			$('.i-checks').iCheck({//penting untuk class i-checks
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
			var i = 1;
			$("#add").click(function(){
				i++;
				$("#dynamic_field").append("<tr id='row"+i+"'>"+
				                            "<td>"+
					                            "<input type='checkbox' class='i-checks' checked name='active[]' value='1' required='true'>"+
				                            "</td>"+
				                            "<td style='padding-top: 4px; padding-bottom: 0px;'>"+
				                            	"<div class='col-lg-12 input-group'>"+
				                            		"<input type='text' name='name[]' placeholder='...' class='input-sm form-control' style='background-color: transparent; border: none; padding-left: 0px; padding-right: 0px;' required='true'>"+
				                            	"</div>"+
				                            "</td>"+
				                            "<td style='padding-top: 4px; padding-bottom: 0px;'>"+
				                            	"<div class='col-lg-12 input-group'>"+
				                            		"<input type='text' name='uri[]' placeholder='...' class='input-sm form-control' style='background-color: transparent; border: none; padding-left: 0px; padding-right: 0px;' required='true'>"+
				                            	"</div>"+
				                            "</td>"+
				                            "<td style='padding-top: 4px; padding-bottom: 0px;'>"+
				                            	"<div class='col-lg-12 input-group'>"+
				                            		"<button type='button' class='btn btn-sm btn-danger pull-right btn-remove' style='width: 30px;' name='remove' id='"+i+"'><strong>-</strong</button>"+
				                            	"</div>"+
				                            "</td>"+
				                        "</tr>");
				$('.i-checks').iCheck({//penting untuk class i-checks
	                checkboxClass: 'icheckbox_square-green',
	                radioClass: 'iradio_square-green'
	            });

			});
			$(document).on("click", ".btn-remove", function(){
				var button_id = $(this).attr("id");
				$("#row"+button_id+"").remove();
			});

			// $(document).ready(function(){
			// 	$("h2").append("<p>Di DUMET School</p>");
			// 	$(".inner").append("<div>Digital Marketing</div>");
			// });
		});
	</script>

	<!-- pace.min merupakan cara untuk menghindari error pada chat/time gitu lah -->
	<script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>

	<!-- ini di bawah tambahan untuk form terbaru -->
    <!-- catatan switchery, touchspin sama nouislider dikomen hela -->
    <!-- Chosen -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>

    

    
   
    
       
       