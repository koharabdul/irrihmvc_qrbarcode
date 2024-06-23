	   <link href="<?php echo base_url(); ?>assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
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
                    <div class="row wrapper white-bg page-heading tooltip-demo" style="padding-bottom: 0px; padding-top: 5px;">

                    	<div class="row" >
                    		<div class="col-sm-2">
                                <input type="text" name="nik_or_kk" id="nik_or_kk" class="form-control input-sm" placeholder="NIK / No. KK" data-mask="9999999999999999" style="border-top: none;border-left: none;border-right: none;">
                            </div>
                    		<div class="col-sm-2">
                                <input type="text" name="nama_alamat" id="nama_alamat" class="form-control input-sm" placeholder="Nama Lengkap / Alamat" style="border-top: none;border-left: none;border-right: none;">
                            </div>
							<div class="col-sm-2">
                                <select class="chosen-select" tabindex="9" id="id_desa">
                                    <option value="">Desa / Kelurahan</option>
                                    <option value="013">Nanjung Mekar</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="chosen-select" tabindex="9" id="id_kecamatan">
                                    <option value="">Kecamatan</option>
                                    <option value="Rancaekek">Rancaekek</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                            	<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="id_pengurus" id="id_pengurus" class="form-control input-sm" placeholder="ID DTKS/ID Pengurus" style="border-top: none;border-left: none;border-right: none;padding-right: 0px;padding-left: 2px;" />
                            </div>
                            <div class="col-sm-2">
                                <select class="chosen-select" tabindex="9" id="bantuan">
                                    <option value="">Bantuan</option>
                                    <option value="L">PKH</option>
                                </select>
                            </div>
                    	</div>
                    	<hr style="margin-top: 10px;margin-bottom: 10px;" class="hr-line-dashed">
                	    <div class="row">  
                            <div class="col-sm-3">
                                <?php 
                                    select_perpage_nolabel('perpage','Perpage',$perpage,false,'');
                                 ?> 
                            </div>
                            <div class="col-sm-9">
                                <div class="btn-group pull-right">
                                    <button type="botton" id="btn_addmanual" class="btn btn-sm btn-white">Add</button>
                                    <button type="botton" id="btn_import" class="btn btn-sm btn-white">Import Data</button>
                                    <!-- <button type="button" id="btn_deleted" class="btn btn-sm btn-white" disabled>Delete</button> -->
                                </div>
                            </div>
                        </div>


            	    	<div style="margin-top: 2px;">
                            <div class="table-responsive x_panel" id="content_table">       
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
    <!-- Input Mask-->
    <script src="<?php echo base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
    <!-- Chosen -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/chosen/chosen.jquery.js"></script>
     <script type="text/javascript">
        $(document).ready(function(){
            $('.chosen-select').chosen({width: "100%"});
            function load_country_data(page){
                var formData = new FormData();
                formData.append('nama_alamat',$('#nama_alamat').val());
                formData.append('nik_or_kk',$('#nik_or_kk').val());
                formData.append('id_desa',$('#id_desa').val());
                formData.append('id_kecamatan',$('#id_kecamatan').val());
                formData.append('id_pengurus',$('#id_pengurus').val());
                formData.append('bantuan',$('#bantuan').val());
                $.ajax({
                    url:"<?php echo base_url().$mylink; ?>/pagination/"+page,
                    method:"POST",
                    dataType:"json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $('#content_table').html(data.content_table);
                        $('#pagination_link').html(data.pagination_link);
                        $('#infochecked').text('');
                        $('.showCountData').html(data.showCountData);
                        $('#perpage').val(data.perpage);
                        $('#btn_deleted').prop('disabled', true);
                        $('#btn_addmanual').prop('disabled', false);
                        // $('#search').prop('disabled', false);
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
            $(document).on("keyup","#nama_alamat,#nik_or_kk,#id_pengurus,#id_kecamatan,#id_desa", function(event){
                load_country_data(1);
            });
            $('#jns_kelamin').on('change', function(){
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
                    url: '<?php echo base_url().$mylink ?>/changeperpage',
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

            $('#btn_import').on('click', function(){
                 window.location.href="<?php echo base_url().$mylink; ?>/create";
            });
            
            
        });
    </script>
