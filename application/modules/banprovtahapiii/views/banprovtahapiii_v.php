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
                    <div class="ibox-tools">
                        <span id="jum_tersalurkan"></span> |
                        <span id="jum_ditunda"></span> |
                        <span id="jum_belum"></span>
                        <button type="botton" class="btn btn-xs btn-default" id="print"><i class="fa fa-print"></i></button>
                        <a class="fullscreen-link">
                            <i class="fa fa-expand" id="expand"></i>
                        </a>
                    </div>
                </div>
                
                
            

                <div class="ibox-content" style="padding-bottom: 5px; padding-top: 5px;">
                    <div class="row wrapper white-bg page-heading tooltip-demo" style="padding-bottom: 0px; padding-top: 5px;">

                	    <div class="row" style="padding-bottom: 5px;">
                            <div class="col-sm-3">
                                <?php 
                                    select_perpage_nolabel('perpage','Perpage',$perpage,false,'');
                                 ?>
                                    
                            </div>
                            <div class="col-sm-2">
                                <div class="btn-group">
                                    <!-- <button type="botton" id="btn_add" class="btn btn-sm btn-white">Import Data</button> -->
                                    <button type="botton" id="btn_accepted" class="btn btn-sm btn-success" disabled="true">Tersalurkan</button>
                                    <button type="botton" id="btn_denied" class="btn btn-sm btn-warning" disabled="true">Ditunda</button>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" name="nama_alamat" autocomplete="off" autofocus="on" id="nama_alamat" class="form-control input-sm" placeholder="Nama Lengkap / Alamat" style="border-top: none;border-left: none;border-right: none;">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" name="nik_or_kk" id="nik_or_kk" class="form-control input-sm" placeholder="NIK / No. KK" data-mask="9999999999999999" style="border-top: none;border-left: none;border-right: none;">
                            </div>
                            <div class="col-sm-1">
                                <div class="input-group">
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="rt" id="rt" class="form-control input-sm" placeholder="RT" style="border-top: none;border-left: none;border-right: none;padding-right: 0px;padding-left: 2px;" />
                                    <span class="input-group-addon" style="padding-right: 0px;padding-left: 0px; border: 1px dashed #e7eaec; border-left: none;"></span>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="rw" id="rw" class="form-control input-sm" placeholder="RW" style="border-top: none;border-left: none;border-right: none;padding-right: 0px;padding-left: 2px;">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <select class="chosen-select" tabindex="9" id="terealisasi">
                                    <option value="">Pilih</option>
                                    <option value="Tersalurkan">Tersalurkan</option>
                                    <option value="Ditunda">Ditunda</option>
                                    <option value="Belum Tersalurkan">Belum Tersalurkan</option>
                                </select>
                            </div>
                        </div>
                        <!-- <hr style="margin-top: 0px;margin-bottom: 0px;" class="hr-line-dashed"> -->

                        <input type="hidden" name="viewid" id="viewid">
            	    	<div style="margin-top: 2px;">
                            <div class="table-responsive x_panel" id="table_content">
                               
                            </div>
                        </div>
                        
                        <div>
                            <label style="font-weight: 100; padding-top: 8px; padding-bottom: 5px;" class="showCountData"></label> <span class="infochecked" id="infochecked"></span>
                            <label class="pull-right" id="pagination_link" style="font-weight: 100;margin-top: -17px;"></label>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>



        <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Alasan Ditunda</label><span style="color:red;"> *</span> 
                            <textarea placeholder="Alasan Penyaluran Bantuan Ditunda?" class="form-control" id="remark" name="remark"></textarea>
                            <span style="color:red;" class="remark"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white cancel" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="remarksave" >Save changes</button>
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
                var nama_alamat = $('#nama_alamat').val();
                var nik_or_kk = $('#nik_or_kk').val();
                var formData = new FormData();
                formData.append('nama_alamat',$('#nama_alamat').val());
                formData.append('nik_or_kk',$('#nik_or_kk').val());
                formData.append('rt',$('#rt').val());
                formData.append('rw',$('#rw').val());
                formData.append('terealisasi',$('#terealisasi').val());
                $.ajax({
                    url:"<?php echo base_url().$mylink; ?>/pagination/"+page,
                    method:"POST",
                    dataType:"json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $('#table_content').html(data.table_content);
                        $('#pagination_link').html(data.pagination_link);
                        $('#infochecked').text('');
                        $('.showCountData').html(data.showCountData);
                        $('#perpage').val(data.perpage);
                        $('#jum_tersalurkan').html('<i class="fa fa-check success" style="color: #1ab394;"></i> : '+data.jum_tersalurkan+ ' Tersalurkan');
                        $('#jum_ditunda').html('<i class="fa fa-question" style="color: #f8ac59;"></i> : '+data.jum_ditunda+' Ditunda');
                        $('#jum_belum').html('<i class="fa fa-clock-o"></i> : '+data.jum_belum+' Belum Tersalurkan');
                        if(data.total_rows!=''){
                            $('#viewid').val(data.viewid);
                            if(nama_alamat!='' || nik_or_kk!=''){//prken
                                if(data.distrib!='Tersalurkan' && data.distrib!='Ditunda'){
                                    swal({
                                        title: data.total_rows+" - "+data.nama_penerima,
                                        text: "NIK. "+data.nomornik+"\nAlamat di "+data.alamat+" \nRT : "+data.rt_s+" RW : "+data.rw_s+" Desa : "+data.namadesa,
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#F7A54A",
                                        confirmButtonText: "Distribusikan!",
                                        closeOnConfirm: false
                                    },
                                    function(){
                                        swal({
                                            title: "Telah Terdistribusikan!",
                                            text: "Nama : "+data.nama_penerima+" dengan Nomor Urut : "+data.total_rows,
                                            type: "success",
                                        }, 
                                        function(){
                                            formData.append('viewid',$('#viewid').val());
                                            $.ajax({
                                                method: "POST",
                                                data: formData,
                                                processData: false,
                                                contentType: false,
                                                url: '<?php echo base_url().$mylink ?>/update',
                                                success: function(){
                                                    load_country_data(1);
                                                    <?php echo sweat_toastr_js('Data Berhasil Distrubusikan!','Silahkan Cek Data Kembali','success','toast-top-right') ?>
                                                },
                                                error: function(){
                                                    alert('Could not add data');
                                                }
                                            }); 
                                        });
                                    });
                                }
                            }
                        }
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
                    $('#btn_accepted').prop('disabled', false);
                    $('#btn_denied').prop('disabled', false);
                }
                else if($(".checkitem:checked").length == 0){
                    $(".checkitems").prop("checked", false);
                    $(".infochecked").text("");
                    $('#btn_accepted').prop('disabled', true);
                    $('#btn_denied').prop('disabled', true);
                }
            });
            $(document).on("change",".checkitem", function(){
                if($(".checkitem:checked").length > 0){
                    $('#btn_accepted').prop('disabled', false);
                    $('#btn_denied').prop('disabled', false);
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
                    $('#btn_accepted').prop('disabled', true);
                    $('#btn_denied').prop('disabled', true);
                }
            });
            $(document).on("keyup","#nama_alamat,#nik_or_kk,#rt,#rw", function(event){
                load_country_data(1);
            });
            $('#terealisasi').on('change', function(){
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

            $('#btn_add').on('click', function(){
                window.location.href="<?php echo base_url().$mylink; ?>/create";
            });
            $('.fa-expand').on('click', function(){
                $('#perpage').prop('disabled', false);
            });
            $(document).on("click",".fa-compress",function(){
                $('#perpage').prop('disabled', true);
            });
            $('#btn_accepted').on('click', function(){
                var formData = new FormData();
                    
                var checkedit = [];
                $('.checkitem').each(function(){
                    if($(this).is(":checked"))
                    {
                        checkedit.push($(this).val());
                    }
                });
                checkedit = checkedit.toString();
                formData.append('id',checkedit);
                swal({
                    title: "Apakah Anda yankin!",
                    text: "Data yang dipilih didistribusikan?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#F7A54A",
                    confirmButtonText: "Distribusikan!",
                    closeOnConfirm: false
                },
                function(){
                    swal({
                        title: "Telah Didistribusikan!",
                        text: "Records selected Has Been Distributed",
                        type: "success"
                    }, 
                    function(){
                        $.ajax({
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            url: '<?php echo base_url().$mylink ?>/accepted',
                            success: function(){
                                load_country_data(1);
                                $('#btn_accepted').prop('disabled',true);
                                $('#btn_denied').prop('disabled',true);
                                <?php echo sweat_toastr_js('Data Berhasil Distrubusikan!','Silahkan Cek Data Kembali','success','toast-top-right') ?>
                            },
                            error: function(){
                                alert('Could not add data');
                            }
                        }); 
                    });
                });
            });
            $('#btn_denied').on('click', function(){
                $('#myModal5').find('.modal-title').text('Catatan Penyaluran Ditunda');
                $('#myModal5').modal({backdrop: "static"});
                $('#myModal5').modal('show');
            });
            // $(document).on('click','.cancel',function(){
            //     $(".checkitem").prop("checked", false);
            // });
            $('#remark').on('change',function(){
                var remark = $('textarea[name=remark]');
                if(remark.val().length>3){
                    remark.parent().removeClass('has-error');
                    remark.parent().addClass('has-success');
                    $('#myModal5').find('.remark').text('');
                }
            });
            $('#remarksave').on('click',function(){
                var remark = $('textarea[name=remark]');
                if(remark.val()==''){
                    remark.parent().addClass('has-error');
                    $('#myModal5').find('.remark').text('Alasan Ditunda Tidak Boleh Kosong!');
                }
                else if(remark.val().length<=3){
                    remark.parent().addClass('has-error');
                    $('#myModal5').find('.remark').text('Maksimal 4 Karakter!');
                }
                else{
                    var formData = new FormData();
                    
                    var checkedit = [];
                    $('.checkitem').each(function(){
                        if($(this).is(":checked"))
                        {
                            checkedit.push($(this).val());
                        }
                    });
                    checkedit = checkedit.toString();
                    formData.append('id',checkedit);
                    formData.append('remark',$('#remark').val());
                   
                    
                    swal({
                        title: "Telah Ditunda!",
                        text: "Records selected Has Been Denied",
                        type: "success",
                    }, 
                    function(){
                        $.ajax({
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            url: '<?php echo base_url().$mylink ?>/denied',
                            success: function(){
                                remark.parent().removeClass('has-success');
                                $('#remark').val('');
                                $('#myModal5').modal('hide');
                                load_country_data(1);
                                $('#btn_accepted').prop('disabled',true);
                                $('#btn_denied').prop('disabled',true);
                                <?php echo sweat_toastr_js('Data KPM Ditunda!','Silahkan Cek Data Kembali','warning','toast-top-left') ?>
                            },
                            error: function(){
                                alert('Could not add data');
                            }
                        }); 
                    });
                   
                }
            });

            $('#print').on('click',function(){
                window.location.href="<?php echo base_url().$mylink; ?>/prints";
            });



            
        });
    </script>
