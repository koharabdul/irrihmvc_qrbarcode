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
		            <li class="active">
		                <strong><?php echo $subtitle; ?></strong>
		            </li>
		        </ol>
		    </div>
		</div>

		<div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $subtitle; ?></h5>
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
                                    <option value="TMS">Pemilih TMS</option>
                                    <option value="Pemilih Ubah Data">Pemilih Ubah Data</option>
                                    <option value="Belum Vervali">Belum Vervali</option>
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
                                <div class="btn-group verval" style="display: none;">
                                    <button type="botton" id="btn_cocok" class="btn btn-sm btn-primary btn-outline vervals" disabled="true"><i class="fa fa-check"></i> Cocok</button>
                                    <button type="botton" id="btn_move" class="btn btn-sm btn-info btn-outline vervals" disabled="true">Pindah TPS</button>
                                    <!-- <button type="botton" id="btn_add" class="btn btn-sm btn-white">Import Baru</button> -->
                                    <button type="button" id="btn_deleted" class="btn btn-sm btn-warning btn-outline vervals" disabled="true"><i class="fa fa-ban"></i> TMS</button>
                                </div>
                                <div class="btn-group pull-right" >
                                    <button type="botton" id="btn_add" class="btn btn-sm btn-white"><i class="fa fa-plus"></i> Import Pemilih Baru</button>
                                    <button type="botton" id="btn_adds" class="btn btn-sm btn-white">Import Ulang</button>
                                    <button type="botton" id="btn_rekap" class="btn btn-sm btn-white">Rekap PPDP</button>
                                    <!-- <button type="botton" id="btn_aa3_kwk" class="btn btn-sm btn-white" disabled="true">A.A.3-KWK</button> -->
                                    <button type="botton" id="btn_deleteds" class="btn btn-sm btn-white" disabled="true">Delete Pemilih Baru</button>
                                    <button type="botton" id="btn_export" class="btn btn-sm btn-white">Export Excel</button>
                                    <button type="botton" id="btn_mutakhir" class="btn btn-sm btn-success"><i class="fa fa-clipboard"></i> Mutakhir</button>
                                    
                                </div>
                            </div>             
                        </div>
                        

                        
                    </div>
                </div>
            </div>
        </div>


        <div class="row wrapper wrapper-content animated fadeInRight" style="margin-top: -75px; padding-bottom: 60px;">
            <div class="col-lg-3">
                <div class="ibox-content" >
                    <ol style="margin-left: -25px;">
                        <li id="jum_cocok" style="color: #1ab394f7;"></li>
                        <li id="jum_ubah_data" style="color: #bee22d;"></li>
                        <li id="jum_baru" style="color: #4967d4;"></li>
                        <li id="jum_tms" style="color: #d44949;"></li>
                        <li id="jum_belum_rekam_ektp"></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox-content" >
                    <ol style="margin-left: -25px;">
                        <li id="jum_meninggal"></li>
                        <li id="jum_ditemukan_ganda"></li>
                        <li id="jum_dibawah_umur"></li>
                        <li id="jum_pindah_domisili"></li>
                        <li id="jum_tidak_ditemukan"></li>
                        <li id="jum_tni"></li>
                        <li id="jum_polri"></li>
                        <li id="jum_hilang_ingatan"></li>
                        <li id="jum_hak_pilihdicabut"></li>
                        <li id="jum_bukan_penduduk"></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox-content" >
                    <ol style="margin-left: -25px;">
                        <li id="disabilitas_fisik"></li>
                        <li id="disabilitas_intelektual"></li>
                        <li id="tuna_mental"></li>
                        <li id="disabilitas_sensorik"></li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <h4>List Double NIK</h4>
                        <div id="content_double">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        


        <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-ban modal-icon"></i>
                        <h5 class="modal-title">Modal title</h5>
                    </div>
                    <div class="modal-body">
                        <label class="msg_tms"label></label>
                        <div class="form-group">
                            <label>Kategori TMS</label> 
                                <select id="pilih_tms" data-placeholder="Choose" class="chosen-select form-control">
                                    <option value="">Pilih</option>
                                    <option value="Meninggal Dunia">1. Meninggal Dunia</option>
                                    <option value="Ditemukan Data Ganda">2. Ditemukan Data Ganda</option>
                                    <option value="Dibawah Umur">3. Dibawah Umur</option>
                                    <option value="Pindah Domisili">4. Pindah Domisili</option>
                                    <option value="Tidak Ditemukan">5. Tidak Ditemukan</option>
                                    <option value="TNI">6. TNI</option>
                                    <option value="POLRI">7. POLRI</option>
                                    <option value="Hilang Ingatan">8. Hilang Ingatan</option>
                                    <option value="Hak Pilih Dicabut">9. Hak Pilih Dicabut</option>
                                    <option value="Bukan Penduduk">10. Bukan Penduduk</option>
                                </select>                                
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-white cancel" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-warning" id="save_tms" disabled="true" ><i class="fa fa-ban"></i> Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Modal title</h4>
                        <p class="msg_tms2"></p class="msg_tms2">
                    </div>
                    <div class="modal-body">
                       <div class="form-group">
                            <label>Pindah ke TPS</label> 
                                <select class="chosen-select" tabindex="9" id="pindah_tps">
                                    <option value="">TPS</option>
                                    <?php 
                                        foreach ($tps as $k) {
                                            echo"<option value=".$k->id.">".$k->tps."</option>";
                                        }
                                    ?>
                                </select>                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-sm" id="save_pindah" disabled="true">Save changes</button>
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
                formData.append('NIK_OR_KK',$('#NIK_OR_KK').val());
                formData.append('RT',$('#RT').val());
                formData.append('RW',$('#RW').val());
                formData.append('jns_kelamin',$('#jns_kelamin').val());
                formData.append('jns_variansi',$('#jns_variansi').val());
                $.ajax({
                    url:"<?php echo base_url().$mylink; ?>/pagination/"+page,
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
                        $('#jum_tms').html('TMS = '+data.jum_tms);
                        $('#jum_belum_rekam_ektp').html('Belum Rekam KTP-el = '+data.jum_belum_rekam_ektp);

                        $('#jum_meninggal').html('Meninggal Dunia = '+data.jum_meninggal);
                        $('#jum_ditemukan_ganda').html('Ditemukan Data Ganda = '+data.jum_ditemukan_ganda);
                        $('#jum_dibawah_umur').html('Dibawah Umur = '+data.jum_dibawah_umur);
                        $('#jum_pindah_domisili').html('Pindah Domisili = '+data.jum_pindah_domisili);
                        $('#jum_tidak_ditemukan').html('Tidak Ditemukan = '+data.jum_tidak_ditemukan);
                        $('#jum_tni').html('TNI = '+data.jum_tni);
                        $('#jum_polri').html('POLRI = '+data.jum_polri);
                        $('#jum_hilang_ingatan').html('Hilang Ingatan = '+data.jum_hilang_ingatan);
                        $('#jum_hak_pilihdicabut').html('Hak Pilih Dicabut = '+data.jum_hak_pilihdicabut);
                        $('#jum_bukan_penduduk').html('Bukan Penduduk = '+data.jum_bukan_penduduk);
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
            $(document).on("change","#checkall", function(){
                $(".checkitem").prop("checked", $(this).prop("checked"));
                if($(".checkitem:checked").length > 0){
                    $(".infochecked").text("("+$(".checkitem:checked").length + " records selected)");
                    $(".verval").css('display','block');
                    $(".vervals").prop('disabled', false);
                    $("#btn_deleteds").prop('disabled',false);
                }
                else if($(".checkitem:checked").length == 0){
                    $(".checkitems").prop("checked", false);
                    $(".infochecked").text("");
                    $(".verval").css('display','none');
                    $(".vervals").prop('disabled', true);
                    $("#btn_deleteds").prop('disabled',true);
                }
            });
            $(document).on("change",".checkitem", function(){
                if($(".checkitem:checked").length > 0){
                    $(".verval").css('display','block');
                    $(".vervals").prop('disabled', false);
                    $("#btn_deleteds").prop('disabled',false);
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
                    $(".verval").css('display','none');
                    $(".vervals").prop('disabled', true);
                    $("#btn_deleteds").prop('disabled',true);
                }
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
           
            $('#btn_cocok').click(function(){
                var data = ($(".checkitem:checked").length);
                swal({
                    title: "Apakah Anda yankin?",
                    text: data+" Data Terpilih Dikategorikan Cocok!",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#18a689",
                    confirmButtonText: "Ya', Data Cocok!",
                    closeOnConfirm: true
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
                    formData.append('table_records',checkedit);
                    $.ajax({
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        url: '<?php echo base_url().$mylink ?>/data_cocok',
                        success: function(){
                            <?php echo sweat_toastr_js('Selamat Data Berhasil Vervali!','Data terpilih menjadi Pemilih Cocok!','success','toast-top-right') ?>
                            load_country_data(1);
                        },
                        error: function(){
                            alert('Could not add data');
                        }
                    }); 
                });
            });
            $('#pilih_tms').on('change', function(){
                var pilih_tms = $('#pilih_tms').val();
                if(pilih_tms!=''){
                    $('#save_tms').prop('disabled',false);
                }
                else{
                    $('#save_tms').prop('disabled',true);   
                }
            });
             $('#pindah_tps').on('change', function(){
                var pilih_tms = $('#pindah_tps').val();
                if(pilih_tms!=''){
                    $('#save_pindah').prop('disabled',false);
                }
                else{
                    $('#save_pindah').prop('disabled',true);   
                }
            });
            $('#save_tms').on('click',function(){
                var formData = new FormData();
                    
                var checkedit = [];
                $('.checkitem').each(function(){
                    if($(this).is(":checked"))
                    {
                         checkedit.push($(this).val());
                    }
                });
                checkedit = checkedit.toString();
                formData.append('table_records',checkedit);
                formData.append('category',$('#pilih_tms').val());
                $.ajax({
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: '<?php echo base_url().$mylink ?>/data_tms',
                    success: function(){
                        $('#myModal5').modal('hide');
                        <?php echo sweat_toastr_js('Selamat Data Berhasil Vervali!','Data terpilih menjadi TMS!','warning','toast-top-left') ?>
                        load_country_data(1);
                        $('#save_tms').prop('disabled',true);
                    },
                    error: function(){
                        alert('Could not add data');
                    }
                }); 
            });
            $('#save_pindah').on('click',function(){
                var formData = new FormData();
                    
                var checkedit = [];
                $('.checkitem').each(function(){
                    if($(this).is(":checked"))
                    {
                         checkedit.push($(this).val());
                    }
                });
                checkedit = checkedit.toString();
                formData.append('table_records',checkedit);
                formData.append('tps',$('#pindah_tps').val());
                $.ajax({
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: '<?php echo base_url().$mylink ?>/data_pindah_tps',
                    success: function(){
                        $('#myModal4').modal('hide');
                        <?php echo sweat_toastr_js('Selamat Data Berhasil Diubah!','Data terpilih menjadi Pemilih Ubah Data Pindah TPS!','info','toast-top-right') ?>
                        load_country_data(1);
                        $('#save_pindah').prop('disabled',true);
                    },
                    error: function(){
                        alert('Could not add data');
                    }
                }); 
            });

            $('#btn_add').on('click', function(){
                 window.location.href="<?php echo base_url().$mylink; ?>/create";
            });
            $('#btn_adds').on('click', function(){
                 window.location.href="<?php echo base_url().$mylink; ?>/creates";
            });
            $('#btn_mutakhir').on('click', function(){
                 window.location.href="<?php echo base_url().$mylink; ?>/mutakhir";
            });
            $('#btn_rekap').on('click', function(){
                 // window.location.href="<?php echo base_url().$mylink; ?>/rekap";
                 window.open("<?php echo base_url().$mylink; ?>/rekap","_blank");
            });
            $('#btn_deleted').on('click',function(){
                var data_tms = ($(".checkitem:checked").length);
                $('#myModal5').find('.modal-title').text('Tidak Memenuhi Syarat (TMS)');
                $('#myModal5').find('.msg_tms').text(data_tms+' Data Terpilih Tidak Memenuhi Syarat (TMS)!');
                $('#myModal5').modal({backdrop: "static"});
                $('#myModal5').modal('show');
            });
            $('#btn_move').on('click',function(){
                var data_tms = ($(".checkitem:checked").length);
                $('#myModal4').find('.modal-title').text('Pindah Data TPS');
                $('#myModal4').find('.msg_tms2').text(data_tms+' Data Terpilih akan Segera Dipindahkan!');
                $('#myModal4').modal({backdrop: "static"});
                $('#myModal4').modal('show');
            });
            $('#btn_deleteds').on('click',function(){
                var data = ($(".checkitem:checked").length);
                swal({
                    title: "Apakah Anda yankin?",
                    text: data+" Data Terpilih akan Dihapus!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f8ac59",
                    confirmButtonText: "Delete!",
                    closeOnConfirm: true
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
                    formData.append('table_records',checkedit);
                    $.ajax({
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        url: '<?php echo base_url().$mylink ?>/soft_delete',
                        success: function(){
                            <?php echo sweat_toastr_js('Selamat Data Berhasil Dihapus!','Data terpilih Telah Dihapus!','success','toast-top-right') ?>
                            load_country_data(1);
                        },
                        error: function(){
                            alert('Could not add data');
                        }
                    }); 
                });
            });
            $('#btn_export').on('click',function(){
                $('#btn_export').html('Export Excel <span class="loading bullet"></span>');
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
                    url: '<?php echo base_url().$mylink ?>/export_excel'
                   
                }).done(function(data){
                    var $a = $("<a>");
                    $a.attr("href",data.file);
                    $("body").append($a);
                    $a.attr("download","<?php echo $mylink?>.xls");
                    $a[0].click();
                    $a.remove();
                    $('#btn_export').prop('disabled', false);
                    $('#btn_export').html('Export Excel');
                }); 
            });


            
        });
    </script>
