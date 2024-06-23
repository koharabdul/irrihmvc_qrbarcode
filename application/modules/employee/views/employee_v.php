		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Employee</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>employee">Employee</a>
                    </li>
                    <li class="active">
                        <strong>Tampil Data</strong>
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
	                        <h5>Striped Table </h5>
	                        <div class="ibox-tools">
	                            <a class="collapse-link">
	                                <i class="fa fa-chevron-up"></i>
	                            </a>
	                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                                <i class="fa fa-wrench"></i>
	                            </a>
	                            <ul class="dropdown-menu dropdown-user">
	                                <li><a href="#">Config option 1</a>
	                                </li>
	                                <li><a href="#">Config option 2</a>
	                                </li>
	                            </ul>
	                            <a class="close-link">
	                                <i class="fa fa-times"></i>
	                            </a>
	                        </div>
	                    </div>
	                    <div class="ibox-content">
	                    	<div class="row">
                                <div class="col-sm-12 m-b-xs">
                                	<div data-toggle="buttons" class="btn-group pull-right" style="padding:none; margin-top: none; margin-bottom: none;">
                                        <?php echo form_button('#btnAdd','Add',array('class' => 'btn btn-sm btn-white','type' => 'botton', 'id' => 'btnAdd')); ?>
                                        <label class="btn btn-sm btn-white active"> <input type="radio" id="option2" name="options"> Views </label>
                                        <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options"> Delete </label>
                                    </div>
                                </div>
                            </div>
	                        <table class="table table-striped">
	                            <thead>
	                            <tr>
	                                <th>No.</th>
	                                <th>Name</th>
	                                <th>Address</th>
	                                <th>Action</th>
	                            </tr>
	                            </thead>
	                            <tbody id="showdata">
		                            
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
        </div>

        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-dialog">
            	<div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                        	<span aria-hidden="true">&times;</span>
                        	<span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Form Tambah Data Pages</h4>
                    </div>
                    
                    <div class="modal-body">
                    	<form id="myForm" action="" method="post" class="form-horizontal">
	                        <div class="form-group">
	                        	<label for="namepage">Nama</label> 
	                        	<input type="hidden" name="txtId" value="0">
	                        	<?php 
	                                echo form_input('nameemployee', 
	                                                 set_value('nameemployee'), 
	                                                 array('class' => 'form-control input-sm ',
	                                                       'type' => 'text',
	                                                       'placeholder' => 'Masukan Nama Employee')); 
	                            ?>
	                            <span class="nameval" style="color: red;"></span>
	                        </div>
	                        <div class="form-group">
	                        	<label for="uri">Address</label> 
	                        	<?php 
	                                echo form_input('addressemployee', 
	                                                 set_value('addressemployee'), 
	                                                 array('class' => 'form-control input-sm',
	                                                       'type' => 'text',
	                                                       'placeholder' => 'Masukan Alamat Employee')); 
	                            ?>
	                            <span class="addressval" style="color: red;"></span>
	                        </div>
	                       <!--  <div class="form-group">
	                        	<label>Active</label> 
	                        	<div class="switch">
	                                <div class="onoffswitch">
	                                    <input type="checkbox" class="onoffswitch-checkbox" id="example2" checked="" name="active" value="1">
	                                    <label class="onoffswitch-label" for="example2">
	                                        <span class="onoffswitch-inner"></span>
	                                        <span class="onoffswitch-switch"></span>
	                                    </label>
	                                </div>
	                            </div>
	                        </div> -->
	                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal" style="margin-bottom: 0px;">Close</button>
                        <button type="button" class="btn btn-primary btn-sm" id="btnSave">Save changes</button>
                    </div>
                </div>
	        </div>
	    </div>




	     <div class="modal inmodal" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-dialog">
            	<div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                        	<span aria-hidden="true">&times;</span>
                        	<span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Confirm Delete</h4>
                    </div>
                    
                    <div class="modal-body">
                    	Do you want to delete this record?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal" style="margin-bottom: 0px;">Close</button>
                        <button type="button" class="btn btn-primary btn-sm" id="btnDelete">Delete</button>
                    </div>
                </div>
	        </div>
	    </div>


<script>
	$(function(){
		showAllEmployee();

		$('#btnAdd').click(function(){
			$('#myForm')[0].reset();
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Add New Employee');
			$('#myForm').attr('action', '<?php echo base_url(); ?>employee/addEmployee');
    	});
    	$('#btnSave').click(function(){
    		var url = $('#myForm').attr('action');
    		var data = $('#myForm').serialize();
    		//
    		var nameemployee = $('input[name=nameemployee]');
    		var addressemployee = $('input[name=addressemployee]');
    		var result = '';
    		if(nameemployee.val()=='')
    		{
    			nameemployee.parent().addClass('has-error');
    			$('#myModal').find('.nameval').text('Nama Tidak Boleh Kosong!');
    		}
    		else
    		{
    			nameemployee.parent().removeClass('has-error');
    			result +='1';
    			$('#myModal').find('.nameval').text('');
    		}

    		if(addressemployee.val()=='')
    		{
    			addressemployee.parent().addClass('has-error');
    			$('#myModal').find('.addressval').text('Alamat Tidak Boleh Kosong!');
    		}
    		else
    		{
    			addressemployee.parent().removeClass('has-error');
    			result +='2';
    			$('#myModal').find('.addressval').text('');
    		}

    		if(result=='12')
    		{
    			$.ajax({
    				type: 'ajax',
    				method: 'post',
    				url: url,
    				data: data,
    				async: false,
    				dataType: 'json',
    				success: function(response){
    					if(response.success){
    						$('#myModal').modal('hide');
    						$('#myForm')[0].reset();
    							//
    						 	setTimeout(function() {
					                toastr.options = {
					                    closeButton: true,
					                    progressBar: true,
					                    showMethod: 'slideDown',
					                    timeOut: 4000
					                };
					                toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');
					            }, 500);
    					}else{	
    						alert('Error');
    					}
    					showAllEmployee();
    				},
    				error: function(){
    					alert('Could not add data');
    				}
    			});
    			// alert('ok');
    		}

    	});

    	//edit
    	$('#showdata').on('click','.item-edit', function(){
    		var id = $(this).attr('data');
    		$('#myModal').modal('show');
    		$('#myModal').find('.modal-title').text('Edit Employee');
    		$('#myForm').attr('action', '<?php echo base_url() ?>employee/updateEmployee');
    		$.ajax({
    			type: 'ajax',
    			method: 'get',
    			url: '<?php echo base_url() ?>employee/editEmployee',
    			data: {id: id},
    			async: false,
    			dataType: 'json',
    			success: function(data){
    				$('input[name=nameemployee]').val(data.name);
    				$('input[name=addressemployee]').val(data.address);
    				$('input[name=txtId]').val(data.id);

    			},
    			error: function(){
    				alert('Could not Edit Data');
    			}
    		});
    	});

    	//delete
    	$('#showdata').on('click', '.item-delete', function(){
    		var id = $(this).attr('data');
    		$('#deleteModal').modal('show');
    		//prevent previous handler - unbind()
    		$('#btnDelete').unbind().click(function(){
    			$.ajax({
    				type: 'ajax',
    				method: 'get',
    				async: false,
    				url: '<?php echo base_url() ?>employee/deleteEmployee',
    				data:{id:id},
    				dataType: 'json',
    				success: function(response){
    					$('#deleteModal').modal('hide');
    					showAllEmployee();
    				},
    				error: function(){
    					alert('Error deleting');
    				}
    			});
    		});
    	});

		//function
		function showAllEmployee(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url() ?>employee/showAllEmployee',
				async: false,
				dataType: 'json',
				success: function(data){
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html +='<tr>'+
									'<td>'+data[i].id+'</td>'+
                                    '<td>'+data[i].name+'</td>'+
                                    '<td>'+data[i].address+'</td>'+
                                    '<td>'+
                                        '<a href="#" class="btn btn-info btn-sm item-edit" style="padding-bottom:0px; margin-bottom:0px;" data="'+data[i].id+'">Edit</a>'+
                                        '<a href="#" class="btn btn-danger btn-sm item-delete" style="padding-bottom:0px; margin-bottom:0px;" data="'+data[i].id+'">Delete</a>'+
                                    '</td>'+
								'</tr>';
					}
					$('#showdata').html(html);
				},
				error: function(){
					alert('Could not get Data from Database');
				}
			});
		}
	})
</script>