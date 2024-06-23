    
    <link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 
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
	                                                      'placeholder' => 'Searching for '.$subtitle.'',
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
	                                <button type="botton" id="btnAdd" class="btn btn-sm btn-white">Add</button>
	                                <button type="botton" id="btn_print" class="btn btn-sm btn-white">Print</button>
                        <?php $attributes = array("name" => "flatihan", 'method' => 'post', 'class' => 'btn-group');
                            echo form_open($mylink."/delete_multiple", $attributes);
                        ?>
    	                            <button type="submit" id="btn_deleted" class="btn btn-sm btn-white" disabled>Delete</button>
    	                                
    	                       </div>
    	                    </div>
	                    </div>

                        
                        	       <div class='row'>
                                        <div class='col-md-4'>
                                            <ul class='list-unstyled file-list'>
                               
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
                                                foreach ($results as $p) {
                                                   echo"<li class='tooltip-demo'>
                                                        <a href='".base_url().$mylink."/createnext/$p->id'>
                                                            <div class='checkbox checkbox-inline' style='padding-top: 4px;' >
                                                                <input type='checkbox' name='table_records[]' class='checkitem' value='$p->id'>
                                                                <label> 
                                                                </label>
                                                            </div>
                                                            <label>$no. $p->name</label><span class='pull-right' style='margin-right: 25px'><button class='btn-sm btn-outline btn-default pull-right' type='button' style='position: absolute; margin-top: -3px; border: none;' data-toggle='tooltip' data-placement='top' title='Properties'><i class='fa fa-gear'></i></button></span>
                                                        </a>
                                                    </li>";
                                                    $no++;
                                                }
                                            ?>
                                            </ul>
                                        </div>
                                    </div>

                                <div style="padding-top: 2px;">
                                    <label style="font-weight: 100; padding-top: 4px; padding-bottom: 5px;">
                                        <!-- <?php echo $numberofpage; ?> <span class="infochecked"></span> -->
                                    </label>
                                    <label class="active pull-right">
                                        <!-- untuk pagination -->
                                        <ul class="pagination" style="padding:0px; margin:inherit; font-weight: 100;">
                                           <!--  <?php 
                                                echo $this->pagination->create_links();
                                            ?> -->
                                        </ul>
                                        <!-- sampai sini pagination -->
                                    </label>
                                </div>
                                  

                        <?php echo form_close(); ?>

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
                                <label for="name">Nama <span style="color: red;">*</span></label> 
                                
                                <?php input_hidden('idForm','FO-'.get_uuid()); ?>
                                <?php 
                                    echo form_input('name', 
                                                     set_value('name'), 
                                                     array('class' => 'form-control input-sm ',
                                                           'type' => 'text',
                                                           'id' => 'name',
                                                           'placeholder' => 'Nama Form')); 
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
                                                           'placeholder' => 'Description',
                                                           'style' => 'height:60px')); 
                                ?>
                               
                                

                                <span class="addressval" style="color: red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="uri">Copy From</label> 
                                <select class="form-control" style="padding-left: 8px;">
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Australia">Australia</option>
                                    <option selected value="Austria">Austria</option>
                                    <option selected value="Bahamas">Bahamas</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                </select>
                            </div>


                         
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal" style="margin-bottom: 0px;">Close</button>
                        <button type="button" class="btn btn-primary btn-sm" id="btnSimpan">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

   
    <script type="text/javascript">
        $(function(){
        

            $('#btnAdd').click(function(){
                $('#myForm')[0].reset();
                $('#myModal').modal({backdrop: false});
                // $('#myModal').modal({backdrop: "static"});
                $('#myModal').modal('show');
                $('#myModal').find('.modal-title').text('Create New Form');
                $('#myForm').attr('action', '<?php echo base_url(); ?>employee/addEmployee');
            });
            $('#btnSimpan').click(function(){
                var formData = new FormData();
                formData.append('idForm',$('input[name=idForm]').val());
                formData.append('name',$('input[name=name]').val());

                var id = $('input[name=idForm]').val();
                var name = $('input[name=name]').val()
                if(name==''){
                    $('.name').parent().addClass('has-error'); 
                    $('.name').text('Nama Form Tidak Boleh Kosong');
                }
                else if(name.length<3){
                    $('.name').parent().addClass('has-error'); 
                    $('.name').text('Min Karacter, Have to Long');
                }
                else{
                    $('#name').parent().removeClass('has-error');
                    $('.name').text('');
                    result ='1';
                }
                if(result=='1'){
                    $.ajax({
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            url: '<?php echo base_url().$mylink; ?>/save',
                            success: function(){
                                 window.location.href="<?php echo base_url().$mylink; ?>/createnext/"+id;
                            },
                            error: function(){
                                alert('Could not add data');
                            }
                        }); 
                }
            });

           
        });
    </script>