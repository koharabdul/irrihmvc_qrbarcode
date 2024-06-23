
	<link href="<?php echo base_url(); ?>assets/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <!-- Text spinners style -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/textSpinners/spinners.css" rel="stylesheet">
	   <div class="row wrapper border-bottom white-bg page-heading">
		    <div class="col-lg-10">
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
		            	<strong>Import Data Pemilih Baru</strong>
		            </li>
		        </ol>
		    </div>
		</div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Import Data Pemilih Baru dari File Excel <?php echo $subtitle; ?></h5>
                </div>
                
                
            

                <div class="ibox-content" style="padding-bottom: 5px; padding-top: 5px;">
                    <div class="row wrapper white-bg page-heading" style="padding-bottom: 0px; padding-top: 5px;">

                	    <form method="post" id="import_form" enctype="multipart/form-data">
                	    	<div class="fileinput fileinput-new" data-provides="fileinput">
							    <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span>
							    <span class="fileinput-exists">Change</span><input type="file" name="file" id="file"></span>
							    <span class="fileinput-filename"></span>
							    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
							</div> 
							<button type="submit" name="import" id="import" disabled="true" class="btn btn-primary">Import </button>  
							<label class="center" id="customer_data"></label>

						</form>







                	    
                	</div>
                </div>
            </div>
        </div>



     <!-- Jasny -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        	load_data();
            function load_data(){
                $.ajax({
                    url:"<?php echo base_url().$mylink ?>/import",
                    method:"POST",
                    success:function(data){
                        $('#customer_data').html(data);
                    },
                })
            }
            $('#file').on('change', function(){
                var file = $('#file').val();
                if(file!=''){
                    $('#import').prop('disabled', false);
                }
            });
            $('#import_form').on('submit', function(event){
                $('#import').prop('disabled', true);
                event.preventDefault();
                $('#import').html('Import <span class="loading bullet"></span>');
                $.ajax({
                    url:"<?php echo base_url().$mylink ?>/save",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){
                        load_data();
                        // alert(data);
                        
                        $('#file').val('');
                        $('#import').html('Import');

                        setTimeout(function() {
                           toastr.options = {
                                'closeButton': true,
                                'debug': false,
                                'progressBar': true,
                                'preventDuplicates': false,
                                'positionClass': 'toast-top-right',
                                'onclick': null,
                                'showDuration': '400',
                                'hideDuration': '1000',
                                'timeOut': '7000',
                                'extendedTimeOut': '1000',
                                'showEasing': 'swing',
                                'hideEasing': 'linear',
                                'showMethod': 'show',
                                'hideMethod': 'fadeOut'
                            };
                            toastr.success('Import Data Has Been Done', data);
                        }, 1300);
                    },
                    error: function (data){
                        load_data();
                        $('#import').prop('disabled', true);
                        $('#file').val('');
                        $('#import').html('Import');
                        alert(data);
                    }
                })

            });
        });
    </script>
   


   