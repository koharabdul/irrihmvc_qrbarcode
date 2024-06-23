        <!-- Text spinners style -->
        <link href="<?php echo base_url(); ?>assets/css/plugins/textSpinners/spinners.css" rel="stylesheet">     
        <link href="<?php echo base_url(); ?>assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
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
                    <li  class="active">
                        <strong>Mutakhir</strong>
                    </li>
		        </ol>
		    </div>
		</div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Data Mutakhir <?php echo $subtitle; ?></h5>
                    <div class="ibox-tools">
                        <span id="jum_laki"></span> |
                        <span id="jum_perempuan"></span> |
                        <span id="jum_double"></span> |
                        <span id="jum_keluarga"></span>
                        <a class="fullscreen-link">
                            <i class="fa fa-expand" id="expand"></i>
                        </a> 
                    </div>
                        <!-- <label style="font-weight: 100; padding-top: 6px; padding-bottom: 5px;">
                            
                        </label> -->
                </div>
                
                
            

                <div class="ibox-content" style="padding-bottom: 5px; padding-top: 5px;">
                    <div class="row wrapper white-bg page-heading tooltip-demo" style="padding-bottom: 0px; padding-top: 5px;">
                        <div class="row" style="padding-bottom: 0px;">
                            <div class="col-sm-3">
                                <?php 
                                    select_perpage_nolabel('perpage','Perpage',$perpage,false,'');
                                 ?> 
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="nama_alamat" id="nama_alamat" class="form-control input-sm" placeholder="Nama Lengkap / Alamat" style="border-top: none;border-left: none;border-right: none;">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" name="NIK_OR_KK" id="NIK_OR_KK" class="form-control input-sm" placeholder="NIK / No. KK" data-mask="9999999999999999" style="border-top: none;border-left: none;border-right: none;" >
                            </div>
                            <div class="col-sm-1">
                                <div class="input-group">
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="RT" id="RT" class="form-control input-sm" placeholder="RT" style="border-top: none;border-left: none;border-right: none;padding-right: 0px;padding-left: 2px;" />
                                    <span class="input-group-addon" style="padding-right: 0px;padding-left: 0px; border: 1px dashed #e7eaec; border-left: none;"></span>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="RW" id="RW" class="form-control input-sm" placeholder="RW" style="border-top: none;border-left: none;border-right: none;padding-right: 0px;padding-left: 2px;">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <select class="chosen-select" tabindex="9" id="jns_kelamin">
                                    <option value="">TPS</option>
                                    <?php 
                                        foreach ($tps as $k) {
                                            echo"<option value=".$k->id.">".$k->tps."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="chosen-select" tabindex="9" id="jns_variansi">
                                    <option value="">Variansi Data</option>
                                    <option value="Pemilih Cocok">Pemilih Cocok</option>
                                    <option value="Pemilih Baru">Pemilih Baru</option>
                                    <option value="Pemilih Ubah Data">Pemilih Ubah Data</option>
                                </select>
                            </div>
                        </div>
                        <!-- <hr style="margin-top: 0px;margin-bottom: 0px;" class="hr-line-dashed"> -->

                        <!-- <button id="iconExample1">oke</button>  -->
            	    	<div style="margin-top: 2px;">
                            <div class="table-responsive x_panel" id="dpt_table">
                               
                            </div>
                        </div>
                        
                        <div>
                            <label style="font-weight: 100; padding-top: 8px; padding-bottom: 30px;" class="showCountData"></label> <span class="infochecked" id="infochecked"></span>
                            <label class="pull-right" id="pagination_link" style="font-weight: 100;margin-top: -17px;"></label>
                        </div>

                        <div class="row">
                            <div class="col-sm-12" style="margin-top: -25px;">
                                <div class="btn-group" >
                                    <button type="botton" id="btn_final" class="btn btn-sm btn-success">Rekap Final Data Pemutakhiran</button>
                                    <button type="botton" id="btn_export" class="btn btn-sm btn-info">Export Data Pemutakhiran</button>                                    
                                </div>
                            </div>             
                        </div>
                        

                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row wrapper wrapper-content animated fadeInRight" style="margin-top: -75px; padding-bottom: 60px;">
            <div class="col-lg-4">
                <div class="ibox-content" >
                    <ol style="margin-left: -25px;">
                        <li id="jum_cocok" style="color: #1ab394f7;"></li>
                        <li id="jum_ubah_data" style="color: #bee22d;"></li>
                        <li id="jum_baru" style="color: #4967d4;"></li>
                        <li id="jum_belum_rekam_ektp"></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox-content" >
                    <ol style="margin-left: -25px;">
                        <li id="disabilitas_fisik"></li>
                        <li id="disabilitas_intelektual"></li>
                        <li id="tuna_mental"></li>
                        <li id="disabilitas_sensorik"></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <h4>List Double NIK</h4>
                        <div id="content_double">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Chosen -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/chosen/chosen.jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.chosen-select').chosen({width: "100%"});
            function load_country_data(page){
                var formData = new FormData();
                formData.append('nama_alamat',$('#nama_alamat').val());
                formData.append('NIK_OR_KK',$('#NIK_OR_KK').val());
                formData.append('RT',$('#RT').val());
                formData.append('RW',$('#RW').val());
                formData.append('jns_kelamin',$('#jns_kelamin').val());
                formData.append('jns_variansi',$('#jns_variansi').val());
                $.ajax({
                    url:"<?php echo base_url().$mylink; ?>/paginations/"+page,
                    method:"POST",
                    dataType:"json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $('#dpt_table').html(data.dpt_table);
                        $('#content_double').html(data.content_double);
                        $('#pagination_link').html(data.pagination_link);
                        $('#jum_laki').html('<i class="fa fa-male" style="color: #1ab394b5;"></i> : '+data.jum_laki+ ' Laki-Laki');
                        $('#jum_perempuan').html('<i class="fa fa-female" style="color:#f703cea3;"></i> : '+data.jum_perempuan+ ' Perempuan');
                        $('#jum_keluarga').html('<i class="fa fa-group"></i> : '+data.jum_keluarga+ ' KK');
                        $('#jum_double').html('<i class="fa fa-male"></i><i class="fa fa-male"  style="color:#56575861;"></i> : '+data.jum_double+ ' Double NIK');
                        $('#jum_cocok').html('Pemilih Cocok = '+data.jum_cocok);
                        $('#jum_ubah_data').html('Pemilih Ubah Data = '+data.jum_ubah_data);
                        $('#jum_baru').html('Pemilih Baru = '+data.jum_baru);
                        $('#jum_belum_rekam_ektp').html('Belum Rekam KTP-el = '+data.jum_belum_rekam_ektp);

                        $('#disabilitas_fisik').html('Disabilitas Fisik = '+data.jum_disabilitas_fisik);
                        $('#disabilitas_intelektual').html('Disabilitas Intelektual = '+data.jum_disabilitas_intelektual);
                        $('#tuna_mental').html('Tuna Mental = '+data.jum_tuna_mental);
                        $('#disabilitas_sensorik').html('Disabilitas Sensorik = '+data.jum_disabilitas_sensorik);

                        $('#infochecked').text('');
                        $('.showCountData').html(data.showCountData);
                        $('#perpage').val(data.perpage);
                        $(".verval").css('display','none');
                        $(".vervals").prop('disabled', true);
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
            $(document).on("keyup","#nama_alamat,#NIK_OR_KK,#RT,#RW", function(event){
                load_country_data(1);
            });
            $('#jns_kelamin').on('change', function(){
                load_country_data(1);
                var jns_kelamin = $('#jns_kelamin').val();
                if(jns_kelamin!=''){
                    $('#btn_aa3_kwk').prop('disabled',false);
                }else{
                    $('#btn_aa3_kwk').prop('disabled',true);
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
                        load_country_data(1);
                    },
                    error: function(){
                        alert('Could not add data');
                    }
                });            
            });
            $('#jns_variansi').on('change', function(){
                 load_country_data(1);
            });
            $('.fa-expand').on('click', function(){
                $('#perpage').prop('disabled', false);
            });
            $(document).on("click",".fa-compress",function(){
                $('#perpage').prop('disabled', true);
            });
            $('#btn_final').on('click',function(){
                window.open("<?php echo base_url().$mylink; ?>/rekap_final","_blank");
            });
            $('#btn_export').on('click',function(){
                $('#btn_export').html('Export Data Pemutakhiran <span class="loading bullet"></span>');
                $('#btn_export').prop('disabled',true);
                var nama_alamat = $('#nama_alamat').val();
                var NIK_OR_KK = $('#NIK_OR_KK').val();
                var RT = $('#RT').val();
                var RW = $('#RW').val();
                var jns_kelamin = $('#jns_kelamin').val();
                var jns_variansi = $('#jns_variansi').val();
                $.ajax({
                    type: "POST",
                    data: {nama_alamat : nama_alamat, NIK_OR_KK:NIK_OR_KK, RT: RT, RW:RW,jns_kelamin:jns_kelamin,jns_variansi:jns_variansi},
                    dataType:'json',
                    url: '<?php echo base_url().$mylink ?>/export_excel_mutakhir'
                   
                }).done(function(data){
                    var $a = $("<a>");
                    $a.attr("href",data.file);
                    $("body").append($a);
                    $a.attr("download","DPTMutakhir.xls");
                    $a[0].click();
                    $a.remove();
                    $('#btn_export').prop('disabled', false);
                    $('#btn_export').html('Export Data Pemutakhiran');
                }); 
            });
        });
    </script>
