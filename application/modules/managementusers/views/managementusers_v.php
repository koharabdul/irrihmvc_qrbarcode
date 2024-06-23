		<link href="<?php echo base_url(); ?>assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 
        <style type="text/css">
            .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--multiple{
                height: 31px;
                align-items: top;
            }
            .select2-container--default .select2-selection--single .select2-selection__rendered{
                line-height: 31px;
            }

        </style>
        
		<div class="row wrapper border-bottom white-bg page-heading">
		    <div class="col-lg-10">
		        <h2><?php echo $subtitle; ?></h2>
		        <ol class="breadcrumb">
		            <li>
		                <a href="<?php echo base_url(); ?>dashboards">Dashboards</a>
		            </li>
		            <?php echo $runlink; ?>
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
                </div>
                
                
            

                <div class="ibox-content" style="padding-bottom: 5px; padding-top: 5px;">
                    <div class="row wrapper white-bg page-heading" style="padding-bottom: 0px; padding-top: 5px;">

                	    <div class="row">
                            <div class="col-sm-5 m-b-xs column-title">
                                <?php 
                                    select_perpage_nolabel('perpage','Perpage',$perpage,false,'');
                                 ?>
                                    
                            </div>
	                        <div class="col-sm-3 m-b-xs column-title">
	                            <div class="btn-group">
	                                <button type="botton" id="btn_add" class="btn btn-sm btn-white">Add</button>
	                                <!-- <button type="botton" id="btn_print" class="btn btn-sm btn-white">Print</button> -->
	                                <button type="button" id="btn_deleted" class="btn btn-sm btn-white" disabled>Delete</button>
	                                
	                            </div>
	                        </div>
                            <div class="col-sm-4 column-title">
                                <?php $attributes = array("name" => "flatihan", 'method' => 'post');
                                    echo form_open($mylink."/search", $attributes);
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
                                                          'placeholder' => 'Searching for Level Users and Descriptions',
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
                            </div>

                        
                        	<div>
                                <div class="table-responsive x_panel">
                                    <div class="x_content">
                                        <table class="table table-striped table-hover responsive-utilities jambo_table bulk_action" style="margin-bottom: 3px;" >
                                            <thead>
                                            <tr>
                                                <th width="1px">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="checkall" class="checkitems" style="">
                                                        <label>
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>No.</th>
                                                <th>Level Users</th>
                                                <th>Description</th>
                                                <th>List Permission</th>
                                                <th>List Users</th>
                                                <th>Active</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $urione = $this->uri->segment(2);
                                                if($urione == 'search'){
                                                    $offset = $this->uri->segment(4, 0) + 1; //untuk penomoran
                                                    $viewempty = 'No matching records found';
                                                }
                                                else{
                                                    $offset = $this->uri->segment(3, 0) + 1; 
                                                    $viewempty = 'Empty File';
                                                }
                                          
                                                $no = $offset++;
                                                if(empty($results))
                                                {
                                                    echo"<tr class='even pointer'>
                                                            <td colspan='7'>$viewempty<td>
                                                        </tr>";
                                                }
                                                else
                                                {
                                                    foreach ($results as $p) {
                                                        // $datecreated = date_convert($p->date_created,true);
                                                                                                             
                                                        
                                                        echo"
                                                        <tr>
                                                            <td>
                                                                <div class='checkbox checkbox-inline' >
                                                                    <input type='checkbox' name='table_records[]' id='table_records' class='checkitem' value='$p->id'>
                                                                    <label> 
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>$no</td>
                                                            <td>$p->name</td>
                                                            <td>$p->description</td>
                                                            <td>
                                                                $p->groupuserview
                                                            </td>
                                                            <td>
                                                                $p->countnmlengkap
                                                            </td>
                                                            <td>$p->activeicon</td>
                                                            <td>
                                                                <a href='".base_url().$mylink."/view/$p->id'>View</a>
                                                            </td>
                                                        </tr>";
                                                        $no++;
                                                    }
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div style="padding-top: 2px;">
                                    <label style="font-weight: 100; padding-top: 4px; padding-bottom: 5px;">
                                        <?php echo $numberofpage; ?> <span class="infochecked"></span>
                                    </label>
                                    <label class="active pull-right">
                                        <!-- untuk pagination -->
                                        <ul class="pagination" style="padding:0px; margin:inherit; font-weight: 100;">
                                            <?php 
                                                echo $this->pagination->create_links();
                                            ?>
                                        </ul>
                                        <!-- sampai sini pagination -->
                                    </label>
                                </div>
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
                                <label for="name">Name of Level User <span style="color: red;">*</span></label> 
                                
                                <?php 
                                    echo form_input('name', 
                                                     set_value('name'), 
                                                     array('class' => 'form-control input-sm ',
                                                           'type' => 'text',
                                                           'id' => 'name',
                                                           'placeholder' => 'Name of Level User')); 
                                ?>
                                <span class="name" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="uri">Description</label> 
                                <?php 
                                    echo form_textarea('description', 
                                                     set_value('description'), 
                                                     array('class' => 'form-control input-sm',
                                                           'type' => 'text',
                                                           'id'   => 'description',
                                                           'placeholder' => 'Description',
                                                           'style' => 'height:60px')); 
                                ?>
                               
                                

                                <span class="description" style="color: red;"></span>
                            </div>
                            <div class="form-group" >
				            	<label for="active">Active</label>
			                   	<div class="switch">
			                        <div class="onoffswitch">
			                        <?php 
			                        	$data = array(
									            'name'          => 'active',
									            'id'            => 'active',
									            'checked'       => true,
									            'class'         => 'onoffswitch-checkbox'
									    );
			                            echo form_checkbox($data);
			                        ?>
			                            <label class="onoffswitch-label" for="active">
			                                <span class="onoffswitch-inner"></span>
			                                <span class="onoffswitch-switch"></span>
			                            </label>
		                        	</div>
		                    	</div>
			                	<span class="help-block" style="color:red;"></span>
					        </div>
                            <div class="form-group">
                                <label>List Users</label> 
                                <div class="list_users">
                                    <select id="list_users" data-placeholder="Choose" class="chosen-select input-sm" multiple style="width:350px;">
                                        <?php 
                                            foreach ($selectusers as $k) {
                                                echo "<option value='$k->id'>$k->nm_lengkap</option>";
                                            }
                                         ?>
                                    </select>                                
                                </div>
                            </div>

                            




                         
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal" style="margin-bottom: 0px;">Close</button>
                        <button type="button" class="btn btn-primary btn-sm" id="btnSimpan" disabled="true">Save changes</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <input type="hidden" name="uuid" id="uuid" class="uuid">
                        <label class="modal-title"></label>
                    </div>
                    <div class="modal-body" style="padding:15px;">
                       <div class="row">  
                            <div class="col-sm-8">
                                
                            </div>
                            <div class="col-sm-4">
                                <input type="text" name="search" id="search" class="form-control input-sm" placeholder="Cari Nama, NIK, dan Pendidikan">
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive x_panel" id="country_table">
                               
                            </div>
                        </div>
                        
                        <div>
                            <label style="font-weight: 100; padding-top: 6px; padding-bottom: 5px;" class="showCountData"></label> <span class="infocheckeds" id="infocheckeds"></span>
                            <label class="pull-right" id="pagination_link" style="font-weight: 100;margin-top: -20px;"></label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal" >Close</button>
                        <button type="button" class="btn btn-primary btn-sm" id="select_users" >Select Users</button>
                    </div>
                </div>
            </div>
        </div>
    <?php echo $this->session->flashdata('infomsg'); ?>
    <script src="<?php echo base_url(); ?>assets/js/plugins/chosen/chosen.jquery.js"></script>
    <script>
        function load_country_data(page){    
            var formData = 'search='+$('#search').val();        
            $.ajax({
                url:"<?php echo base_url().$mylink; ?>/pagination/"+page,
                method:"POST",
                dataType:"json",
                data: formData,
                success:function(data){
                    $('#country_table').html(data.country_table);
                    $('#pagination_link').html(data.pagination_link);
                    $('#infocheckeds').text('');
                    $('.showCountData').html(data.showCountData);
                }
            });
        }
        load_country_data(1);
        $(document).on("click",".pagination li a", function(event){
            event.preventDefault();
            var page = $(this).data("ci-pagination-page");
            load_country_data(page);
        });
        
        $(document).on("change","#checkall_users", function(){
            $(".checkitem_users").prop("checked", $(this).prop("checked"));
            if($(".checkitem_users:checked").length > 0){
                $(".infocheckeds").text("("+$(".checkitem_users:checked").length + " records selected)");
            }
            else if($(".checkitem_users:checked").length == 0){
                $(".checkitems_users").prop("checked", false);
                $(".infocheckeds").text("");
            }
        });
        $(document).on("change",".checkitem_users", function(event){
            event.preventDefault();
            if($(".checkitem_users:checked").length > 0){
                $('#btn_deleted').prop('disabled', false);
                if($(".checkitem_users:checked").length == $(".checkitem_users").length){
                    $("#checkall_users").prop("checked", true);
                    $(".checkitems_users").prop("checked", true);
                    $(".infocheckeds").text("("+$(".checkitem_users:checked").length + " records selected)");
                }
                else if($(".checkitem_users:checked").length < $(".checkitem_users").length){
                    $(".checkitems_users").prop("checked", false);
                    $(".infocheckeds").text("("+$(".checkitem_users:checked").length + " records selected)");
                }
            }
            else if($(".checkitem_users:checked").length == 0){
                $("#checkall_users").prop("checked", false);
                $(".checkitems_users").prop("checked", false);
                $(".infocheckeds").text("");
            }
        });
        $(document).on("keyup","#search", function(){
            load_country_data(1);
        });


        $("#select_users").on("click",function(){
            var formData = new FormData();
                    
            var checkedit = [];
            $('.checkitem_users').each(function(){
                if($(this).is(":checked"))
                {
                     checkedit.push($(this).val());
                }
            });
            checkedit = checkedit.toString();
            $('#list_users').val(checkedit);
            $('#myModal5').modal('hide');
        });
        $(".list_users").on('click',function(){
            $('#myModal5').find('.modal-title').text('Select Users');
            $('#myModal5').modal({backdrop: "static"});
            $('#myModal5').modal('show');
            $('#uuid').val("<?php echo get_uuid() ?>");
        });

        $(document).on("click",".checkitem_users,#checkall_users",function(){
            var uuids = $('#uuid').val();
            if(uuids!=''){
                var formData = new FormData();   
                var checkedit = [];
                $('.checkitem_users').each(function(){
                    if($(this).is(":checked"))
                    {
                         checkedit.push($(this).val());
                    }
                });
                checkedit = checkedit.toString();

                var checkeditnochecked = [];
                $('.checkitem_users').each(function(){
                    if(this.checked){

                    }else{
                        checkeditnochecked.push($(this).val());
                    }
                    // if($(this).not(":checked"))
                    // {
                    //      checkeditnochecked.push($(this).val());
                    // }
                });
                checkeditnochecked = checkeditnochecked.toString();

                alert(checkeditnochecked);
                

            }
        });
      

       
        $('.chosen-select').chosen({width: "100%"});//penting untuk multiselect
        $("#checkall").change(function(){
            $(".checkitem").prop("checked", $(this).prop("checked"));
            if($(".checkitem:checked").length > 0){
                $('#btn_deleted').prop('disabled', false);
                $(".infochecked").text("("+$('.checkitem:checked').length + " records selected)");
                $('#btn_add').prop('disabled', true);
                $('#btn_print').prop('disabled', true);
                $('#input_search').prop('disabled', true);
                $('#btn_search').prop('disabled', true);
            }
            else if($(".checkitem:checked").length == 0){
                $(".checkitems").prop("checked", false);
                $('#btn_deleted').prop('disabled', true);
                $(".infochecked").text("");
                $('#btn_add').prop('disabled', false);
                $('#btn_print').prop('disabled', false);
                $('#input_search').prop('disabled', false);
                $('#btn_search').prop('disabled', false);
            }
        })
        $(".checkitem").change(function(){
            if($(".checkitem:checked").length > 0){
                $('#btn_deleted').prop('disabled', false);
                $('#btn_add').prop('disabled', true);
                $('#btn_print').prop('disabled', true);
                $('#input_search').prop('disabled', true);
                $('#btn_search').prop('disabled', true);
                if($(".checkitem:checked").length == $(".checkitem").length){
                    $(".checkitems").prop("checked", true);
                    $(".infochecked").text("("+$('.checkitem:checked').length + " records selected)");
                }
                else if($(".checkitem:checked").length < $(".checkitem").length){
                    $(".checkitems").prop("checked", false);
                    $(".infochecked").text("("+$('.checkitem:checked').length + " records selected)");
                }
            }
            else if($(".checkitem:checked").length == 0){
                $(".checkitems").prop("checked", false);
                $('#btn_deleted').prop('disabled', true);
                $(".infochecked").text("");
                $('#btn_add').prop('disabled', false);
                $('#btn_print').prop('disabled', false);
                $('#input_search').prop('disabled', false);
                $('#btn_search').prop('disabled', false);
            }
        });
        $('#btn_deleted').click(function(){
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                var formData = new FormData();
                
                var bahasa = [];
                $('.checkitem').each(function(){
                    if($(this).is(":checked"))
                    {
                         bahasa.push($(this).val());
                    }
                });
                bahasa = bahasa.toString();

                formData.append('table_records',bahasa);
                $.ajax({
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: '<?php echo base_url().$mylink ?>/delete_multiple',
                    success: function(){
                        window.location.href="<?php echo base_url().$mylink; ?>";

                    },
                    error: function(){
                        alert('Could not add data');
                    }
                }); 
            });
        });
        $('#btn_add').click(function(){
            // $('.chosen-drop').hide();
            var results = 0;
            $('#myForm')[0].reset();
            // $('#myModal').modal({backdrop: false});
            $('#myModal').modal({backdrop: "static"});
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Create New Level User');
            $('#myForm').attr('action', '<?php echo base_url().$mylink ?>/addManagementusers');
        });
        $(document).on("click","#list_menuusers",function(){
            // $('.chosen-drop').hide();
            $('#myModal5').modal({backdrop: "static"});
            $('#myModal5').modal('show');
            $('#myModal5').find('.modal-title').text('Select From List Users');
            // $('#myModal').modal({backdrop: false});
           

        });
        $('#name').on('change', function(){
            var namelevu = $('input[name=name]');
            if(namelevu.val().length<=2){
                $('#btnSimpan').prop('disabled', true);
                $('#myModal').find('.name').text('Name of Level User must be least 2 characters in length!');
                namelevu.parent().addClass('has-error');
            }
            else{
                var formData = new FormData();
                

                formData.append('name',$('#name').val());
                $.ajax({
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: '<?php echo base_url().$mylink ?>/saveAdd',
                    success: function(data){
                         if(data>0){
                            $('#myModal').find('.name').text('The name of level user is taken, try another!');
                            namelevu.parent().addClass('has-error');
                            $('#btnSimpan').prop('disabled', true);
                         }
                         else{
                            namelevu.parent().removeClass('has-error');
                            $('#myModal').find('.name').text('');
                            $('#btnSimpan').prop('disabled', false);
                         }

                    },
                    error: function(){
                        alert('Could not add data');
                    }
                }); 
            }
        });
        $('#btnSimpan').click(function(){
            var namelevu = $('input[name=name]');
            if(namelevu.val()==''){
                $('#myModal').find('.name').text('Name of Level User is Required.');
                namelevu.parent().addClass('has-error');
            }
            else if(namelevu.val().length<=2){
                $('#myModal').find('.name').text('Name of Level User must be least 2 characters in length!');
                namelevu.parent().addClass('has-error');
            }
            else{
                var formData = new FormData();
                

                formData.append('name',$('#name').val());
                $.ajax({
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: '<?php echo base_url().$mylink ?>/saveAdd',
                    success: function(data){
                         if(data>0){
                            $('#myModal').find('.name').text('The name of level user is taken, try another!');
                            namelevu.parent().addClass('has-error');
                         }
                         else{
                            namelevu.parent().removeClass('has-error');
                            $('#myModal').find('.name').text('');

                            var formData2 = new FormData();
                

                            formData2.append('name',$('#name').val());
                            formData2.append('description',$('#description').val());
                            formData2.append('list_users',$('#list_users').val());

                            if ($('#active').is(':checked')){
                                formData2.append('active',1);
                            }
                            else{
                                formData2.append('active',0);
                            }

                            $.ajax({
                                method: "POST",
                                data: formData2,
                                processData: false,
                                contentType: false,
                                url: '<?php echo base_url().$mylink ?>/insertAdd',
                                success: function(){
                                     window.location.href="<?php echo base_url().$mylink; ?>";
                                },
                                error: function(){
                                    alert('Could not add data');
                                }

                            });



                         }

                    },
                    error: function(){
                        alert('Could not add data');
                    }
                }); 
            }
        });
        $('#perpage').on('change', function(){
            var formData2 = new FormData();
            formData2.append('perpage',$('#perpage').val());
            $.ajax({
                method: "POST",
                data: formData2,
                processData: false,
                contentType: false,
                url: '<?php echo base_url().$mylink ?>/changeperpage',
                success: function(){
                     window.location.href="<?php echo base_url().$mylink; ?>";
                },
                error: function(){
                    alert('Could not add data');
                }
            });            
        });
        

        
    </script>
