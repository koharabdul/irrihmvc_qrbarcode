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
                            <div class="col-sm-5">
                                <?php 
                                    select_perpage_nolabel('perpage','Perpage',$perpage,false,'');
                                 ?>
                                    
                            </div>
                            <div class="col-sm-4">
                                <div class="btn-group">
                                    <button type="botton" id="btn_add" class="btn btn-sm btn-white">Add</button>
                                    <!-- <button type="botton" id="btn_print" class="btn btn-sm btn-white">Print</button> -->
                                    <button type="button" id="btn_deleted" class="btn btn-sm btn-white" disabled>Delete</button>
                                    
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="search" id="search" class="form-control input-sm" placeholder="Search of Kelurahan and Kecamatan">
                            </div>
                        </div>


            	    	<div>
                            <div class="table-responsive x_panel" id="country_table">
                               
                            </div>
                        </div>
                        
                        <div>
                            <label style="font-weight: 100; padding-top: 6px; padding-bottom: 5px;" class="showCountData"></label> <span class="infochecked" id="infochecked"></span>
                            <label class="pull-right" id="pagination_link" style="font-weight: 100;margin-top: -20px;"></label>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    <script type="text/javascript">
    	$(document).ready(function(){
    		function load_country_data(page){
                var formData = 'search='+$('#search').val();
    			$.ajax({
    				url:"<?php echo base_url(); ?>ajax_pagination/pagination/"+page,
    				method:"POST",
    				dataType:"json",
                    data: formData,
    				success:function(data){
    					$('#country_table').html(data.country_table);
    					$('#pagination_link').html(data.pagination_link);
                        $('#infochecked').text('');
                        $('.showCountData').html(data.showCountData);
                        $('#perpage').val(data.perpage);
                        $('#btn_deleted').prop('disabled', true);
                        $('#btn_add').prop('disabled', false);
                        $('#search').prop('disabled', false);
    				}
    			});
    		}
    		load_country_data(1);
    		$(document).on("click",".pagination li a", function(event){
    			event.preventDefault();
    			var page = $(this).data("ci-pagination-page");
	    		load_country_data(page);
	    	});
            $(document).on("change","#checkall", function(){
                $(".checkitem").prop("checked", $(this).prop("checked"));
                if($(".checkitem:checked").length > 0){
                    $(".infochecked").text("("+$(".checkitem:checked").length + " records selected)");
                    $('#btn_deleted').prop('disabled', false);
                    $('#btn_add').prop('disabled', true);
                    $('#search').prop('disabled', true);
                }
                else if($(".checkitem:checked").length == 0){
                    $(".checkitems").prop("checked", false);
                    $(".infochecked").text("");
                    $('#btn_deleted').prop('disabled', true);
                    $('#btn_add').prop('disabled', false);
                    $('#search').prop('disabled', false);
                }
            });
            $(document).on("change",".checkitem", function(){
                if($(".checkitem:checked").length > 0){
                    $('#btn_deleted').prop('disabled', false);
                    $('#btn_add').prop('disabled', true);
                    $('#btn_print').prop('disabled', true);
                    $('#search').prop('disabled', true);
                    if($(".checkitem:checked").length == $(".checkitem").length){
                        $(".checkitems").prop("checked", true);
                        $(".infochecked").text("("+$(".checkitem:checked").length + " records selected)");
                    }
                    else if($(".checkitem:checked").length < $(".checkitem").length){
                        $(".checkitems").prop("checked", false);
                        $(".infochecked").text("("+$(".checkitem:checked").length + " records selected)");
                    }
                }
                else if($(".checkitem:checked").length == 0){
                    $(".checkitems").prop("checked", false);
                    $(".infochecked").text("");
                    $('#btn_deleted').prop('disabled', true);
                    $('#btn_add').prop('disabled', false);
                    $('#btn_print').prop('disabled', false);
                    $('#search').prop('disabled', false);
                }
            });
            $(document).on("keyup","#search", function(event){
                load_country_data(1);
            });
            $('#perpage').on('change', function(){
                var formData2 = new FormData();
                formData2.append('perpage',$('#perpage').val());
                $.ajax({
                    method: "POST",
                    data: formData2,
                    processData: false,
                    contentType: false,
                    url: '<?php echo base_url() ?>ajax_pagination/changeperpage',
                    success: function(){
                        load_country_data(1);
                    },
                    error: function(){
                        alert('Could not add data');
                    }
                });            
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
                    
                    var checkedit = [];
                    $('.checkitem').each(function(){
                        if($(this).is(":checked"))
                        {
                             checkedit.push($(this).val());
                        }
                    });
                    checkedit = checkedit.toString();
                    alert(checkedit);
                    // formData.append('table_records',checkedit);
                    // $.ajax({
                    //     method: "POST",
                    //     data: formData,
                    //     processData: false,
                    //     contentType: false,
                    //     url: '<?php echo base_url().$mylink ?>/delete_multiple',
                    //     success: function(){
                    //         window.location.href="<?php echo base_url().$mylink; ?>";

                    //     },
                    //     error: function(){
                    //         alert('Could not add data');
                    //     }
                    // }); 
                });
            });
            
	    	
    	});
    </script>
 