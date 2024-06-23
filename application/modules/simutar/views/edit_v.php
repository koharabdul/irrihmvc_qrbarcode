    <link href="<?php echo base_url(); ?>assets/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
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
		            	<strong>Pemilih Ubah Data</strong>
		            </li>
		        </ol>
		    </div>
		</div>

		
                
                
            

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox">
                     
                        
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        <div class="btn-group pull-right">
                                            <button class="btn btn-primary btn-sm" type="button" id="btnUpdatedDPT" disabled="true"><i class="fa fa-check" style="margin-right: 5px;"></i>  Save</button>
                                            <button class="btn btn-white btn-sm" type="reset" id="reset" onclick="self.history.back()">Kembali</button>
                                        </div>
                                        <h2>Pemilih Ubah Data</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="row wrapper white-bg page-heading">
                        <?php $attributes = array("name" => "flatihan", "class" => "form-horizontal m-t-md");
                            echo form_open("personil/add", $attributes);
                        ?> 
                            <div class="col-lg-6 b-r">
                                <div class="form-group">
                                    <input type="hidden" name="idDPT" id="idDPT" value="<?php echo $results['id'] ?>">
                                        <label class="col-sm-3 col-sm-3 control-label">No. KK <span style="color:red;">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                
                                                <input type="text" name="no_kk" id="no_kk" class="form-control input-sm" placeholder="..." data-mask="9999999999999999" value="<?php echo $results['no_kk'] ?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-address-card"></i>
                                                </span>
                                                <input type="hidden" name="no_kk_h" id="no_kk_h" value="<?php echo $results['no_kk'] ?>">

                                            </div>
                                            <span class="help-block no_kk" style="color:red;">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-3 control-label">NIK <span style="color:red;">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" name="nik" id="nik" class="form-control input-sm" placeholder="..." data-mask="9999999999999999" value="<?php echo $results['nik'] ?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-address-card"></i>
                                                </span>
                                                <input type="hidden" name="nik_h" id="nik_h" value="<?php echo $results['nik'] ?>">
                                            </div>
                                            <span class="help-block nik" style="color:red;">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-3 control-label">Nama Lengkap <span style="color:red;">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" name="nm_lengkap" id="nm_lengkap" class="form-control input-sm" placeholder="..."  value="<?php echo $results['nm_lengkap'] ?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user-circle" style="width: 16px;"></i>
                                                </span>
                                                <input type="hidden" name="nm_lengkap_h" id="nm_lengkap_h" value="<?php echo $results['nm_lengkap'] ?>">
                                            </div>
                                            <span class="help-block nm_lengkap" style="color:red;">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-3 control-label">Tempat Lahir <span style="color:red;">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" name="tmp_lahir" id="tmp_lahir" class="form-control input-sm" placeholder="..." value="<?php echo $results['tmp_lahir'] ?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-address-book" style="width: 16px;"></i>
                                                </span>
                                                <input type="hidden" name="tmp_lahir_h" id="tmp_lahir_h" eholder="..." value="<?php echo $results['tmp_lahir'] ?>">
                                            </div>
                                            <span class="help-block tmp_lahir" style="color:red;">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="data_1">
                                        <label class="col-sm-3 col-sm-3 control-label">Tanggal Lahir <span style="color:red;">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="input-group date">
                                                <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control input-sm" placeholder="..." data-mask="99/99/9999" placeholder="dd/mm/yyyy" value="<?php echo $results['tgllahir'] ?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                
                                            </div>
                                            <span class="help-block tgl_lahir" style="color:red;">
                                            </span>
                                        </div>
                                        <input type="hidden" name="tgl_lahir_hs" id="tgl_lahir_hs" value="<?php echo $results['tgllahir'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-3 control-label">Jenis Kelamin <span style="color:red;">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="radio radio-info radio-inline">
                                                <?php 
                                                    if($results['jns_kelamin']=='P'){
                                                            echo "<input type='radio' name='jns_kelamin' class='jns_kelamin' value='P' checked='checked'>";
                                                        }else{
                                                            echo "<input type='radio' name='jns_kelamin' class='jns_kelamin' value='P'>";
                                                        }
                                                    
                                                ?>
                                                <label for="inlineRadio1"> Perempuan </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <?php 
                                                    if($results['jns_kelamin']=='L'){
                                                        echo "<input type='radio' name='jns_kelamin' class='jns_kelamin' value='L' checked='checked'>";
                                                    }else{
                                                        echo "<input type='radio' name='jns_kelamin' class='jns_kelamin' value='L'>";
                                                    }
                                                ?>
                                                <label for="inlineRadio2"> Laki-laki </label>
                                            </div>
                                            <input type="hidden" name="jns_kelamin_h" id="jns_kelamin_h" value="<?php echo $results['jns_kelamin'] ?>">
                                            <span class="help-block jns_kelamin" style="color:red;">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-3 control-label">Status Perkawinan <span style="color:red;">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="radio radio-info">
                                                       <?php 
                                                            if($results['sts_perkawinan']=='B'){
                                                                echo "<input type='radio' name='sts_perkawinan' class='sts_perkawinan' value='B' checked='checked'>";
                                                            }else{
                                                                echo "<input type='radio' name='sts_perkawinan' class='sts_perkawinan' value='B'>";
                                                            }
                                                        ?>
                                                        <label for="radio1">
                                                            Belum Kawin
                                                        </label>
                                                    </div>
                                                    <div class="radio radio-info">
                                                        <?php 
                                                            if($results['sts_perkawinan']=='P'){
                                                                echo "<input type='radio' name='sts_perkawinan' class='sts_perkawinan' value='P' checked='checked'>";
                                                            }else{
                                                                echo "<input type='radio' name='sts_perkawinan' class='sts_perkawinan' value='P'>";
                                                            }
                                                        ?>
                                                        <label for="radio3">
                                                            Pernah Kawin
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="radio radio-info">
                                                        <?php 
                                                            if($results['sts_perkawinan']=='S'){
                                                                echo "<input type='radio' name='sts_perkawinan' class='sts_perkawinan' value='S' checked='checked'>";
                                                            }else{
                                                                echo "<input type='radio' name='sts_perkawinan' class='sts_perkawinan' value='S'>";
                                                            }
                                                        ?>
                                                        <label for="radio2">
                                                            Sudah Kawin
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="sts_perkawinan_h" id="sts_perkawinan_h" value="<?php echo $results['sts_perkawinan'] ?>">
                                            </div>
                                            <span class="help-block sts_perkawinan" style="color:red;">
                                            </span>
                                        </div>
                                    </div>

                                
                            </div>
                            <div class="col-lg-6 b-r">

                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Alamat <span style="color:red;">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="dusun" id="dusun" class="form-control input-sm" placeholder="..." placeholder="..." value="<?php echo $results['dusun'] ?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-map-marker" style="width: 16px;"></i>
                                            </span>
                                            <input type="hidden" name="dusun_h" id="dusun_h" value="<?php echo $results['dusun'] ?>">
                                        </div>
                                        <span class="help-block dusun" style="color:red;">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">RT <span style="color:red;">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="RT" id="rt" class="form-control input-sm" placeholder="RT" value="<?php echo $results['rt'] ?>">
                                        <span class="help-block" style="color:red;">
                                            <?php echo form_error('rt'); ?>
                                        </span>
                                        <input type="hidden" name="rt_h" id="rt_h" value="<?php echo $results['rt'] ?>">
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">RW <span style="color:red;">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="rw" id="rw" class="form-control input-sm" placeholder="RW" value="<?php echo $results['rw'] ?>">
                                        <span class="help-block" style="color:red;">
                                            <?php echo form_error('rw'); ?>
                                        </span>
                                        <input type="hidden" name="rw_h" id="rw_h" value="<?php echo $results['rw'] ?>">
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Disabilitas <span style="color:red;">*</span></label>
                                    <div class="col-sm-9">
                                        <?php 
                                            $options = array(
                                                    '0'                                  => 'Tidak Disabilitas',
                                                    '1'                                  => '1. Disabilitas Fisik',
                                                    '2'                                  => '2. Disabilitas Intelektual',
                                                    '3'                                  => '3. Tuna Mental',
                                                    '4'                                  => '4. Disabilitas Sensorik'
                                            );

                                            echo form_dropdown('disabilitas',$options, $results['disabilitas'],array('class' => 'select2_demo_1 form-control', 'style' => 'padding-left: 7px;','id'=>'disabilitas'));
                                        ?>
                                        <input type="hidden" name="disabilitas_h" id="disabilitas_h" value="<?php echo $results['disabilitas'] ?>">
                                        <span class="help-block disabilitas" style="color:red;">
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Sts. Prekaman KTP-el <span style="color:red;">*</span></label>
                                    <div class="col-sm-9">
                                        <?php 
                                            $options = array(
                                                    'b'                                  => 'Belum Rekam',
                                                    's'                                  => 'Sudah Rekam (Suket)',
                                                    'k'                                  => 'Sudah Rekam (KTP-el)'
                                            );

                                            echo form_dropdown('prekaman_ektp',$options, $results['prekaman_ektp'],array('class' => 'select2_demo_1 form-control', 'style' => 'padding-left: 7px;','id'=>'prekaman_ektp'));
                                        ?>
                                        <input type="hidden" name="prekaman_ektp_h" id="prekaman_ektp_h" value="<?php echo $results['prekaman_ektp'] ?>">
                                        <input type="hidden" name="kets_details" id="kets_details" value="<?php echo $results['ket_details'] ?>">
                                        <span class="help-block" style="color:red;">
                                            <?php echo form_error('sts_ktpelma'); ?>
                                        </span>
                                    </div>
                                </div>
                                
                                
                                

                               
                            </div>
                        <?php echo form_close(); ?> 
                    </div>
                    <p>Catatan :</p>
                    <p><?php echo $results['ket_details'] ?></p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
         


        <!-- Input Mask-->
    <script src="<?php echo base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
    <!-- Chosen -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/chosen/chosen.jquery.js"></script>


     <!-- Data picker -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Color picker -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/clockpicker/clockpicker.js"></script>

   
    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>
   
    <script>
        
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#data_2 .input-group.date').datepicker({
            startView: 1,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "dd/mm/yyyy"
        });

        $('#data_3 .input-group.date').datepicker({
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        $('#data_4 .input-group.date').datepicker({
            minViewMode: 1,
            keyboardNavigation: false,
            forceParse: false,
            forceParse: false,
            autoclose: true,
            todayHighlight: true
        });

        $('#data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

       

        

        $('.demo1').colorpicker();

      

        $('.clockpicker').clockpicker();

        $('input[name="daterange"]').daterangepicker();

        
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#btnUpdatedDPT').on('click',function(){
                var formData = new FormData();
                result = '';
                var no_kk       = $('#no_kk').val();
                var no_kk_h     = $('#no_kk_h').val();

                if(no_kk==no_kk_h){
                    result += '';
                }
                else{
                    result += ' kk:'+no_kk_h+' -> '+no_kk;
                }
                
                var nik         = $('#nik').val();
                var nik_h       = $('#nik_h').val();

                if(nik==nik_h){
                    result += '';
                }
                else{
                    result += ' nik:'+nik_h+'->'+nik;
                }

                

                var nm_lengkap         = $('#nm_lengkap').val();
                var nm_lengkap_h       = $('#nm_lengkap_h').val();
                if(nm_lengkap==nm_lengkap_h){
                    result += '';
                }
                else{
                    result += ' nm:'+nm_lengkap_h+'->'+nm_lengkap;
                }
                
                var tmp_lahir         = $('#tmp_lahir').val();
                var tmp_lahir_h       = $('#tmp_lahir_h').val();

                if(tmp_lahir==tmp_lahir_h){
                    result += '';
                }
                else{
                    result += ' tmp:'+tmp_lahir_h+'->'+tmp_lahir;
                }

                var tgl_lahir         = $('#tgl_lahir').val();
                var tgl_lahir_h       = $('#tgl_lahir_hs').val();
                if(tgl_lahir==tgl_lahir_h){
                    result += '';
                }
                else{
                    result += ' tgl:'+tgl_lahir_h+'->'+tgl_lahir;
                }


                
                var jns_kelamin_h       = $('#jns_kelamin_h').val();

                var jns_kelamins = [];
                $('.jns_kelamin').each(function(){
                    if($(this).is(":checked"))
                    {
                         jns_kelamins.push($(this).val());
                    }
                });
                jns_kelamins = jns_kelamins.toString();
                
                if(jns_kelamins==jns_kelamin_h){
                    result += '';
                }
                else{
                    result += ' jns:'+jns_kelamin_h+'->'+jns_kelamins;
                }
                

                
                var sts_perkawinan_h       = $('#sts_perkawinan_h').val();

                var sts_perkawinan = [];
                $('.sts_perkawinan').each(function(){
                    if($(this).is(":checked"))
                    {
                         sts_perkawinan.push($(this).val());
                    }
                });
                sts_perkawinan = sts_perkawinan.toString();
                if(sts_perkawinan_h==sts_perkawinan){
                    result += '';
                }
                else{
                    result += ' sts:'+sts_perkawinan_h+'->'+sts_perkawinan;
                }

                var dusun         = $('#dusun').val();
                var dusun_h       = $('#dusun_h').val();
                if(dusun_h==dusun){
                    result += '';
                }
                else{
                    result += ' sts:'+dusun_h+'->'+dusun;
                }
                var rt         = $('#rt').val();
                var rt_h       = $('#rt_h').val();
                if(rt_h==rt){
                    result += '';
                }
                else{
                    result += ' rt:'+rt_h+'->'+rt;
                }

                var rw         = $('#rw').val();
                var rw_h       = $('#rw_h').val();
                if(rw_h==rw){
                    result += '';
                }
                else{
                    result += ' rw:'+rw_h+'->'+rw;
                }

                var disabilitas         = $('#disabilitas').val();
                var disabilitas_h       = $('#disabilitas_h').val();
                if(disabilitas_h==disabilitas){
                    result += '';
                }
                else{
                    result += ' dis:'+disabilitas_h+'->'+disabilitas;
                }

                var prekaman_ektp         = $('#prekaman_ektp').val();
                var prekaman_ektp_h       = $('#prekaman_ektp_h').val();
                if(prekaman_ektp_h==prekaman_ektp){
                    result += '';
                }
                else{
                    result += ' dis:'+prekaman_ektp_h+'->'+prekaman_ektp;
                }
                                
                              
                formData.append('id',$('#idDPT').val());
                formData.append('no_kk',$('#no_kk').val());
                formData.append('nik',$('#nik').val());
                formData.append('nm_lengkap',$('#nm_lengkap').val());
                formData.append('tmp_lahir',$('#tmp_lahir').val());
                formData.append('tgl_lahir',$('#tgl_lahir').val());
                formData.append('jns_kelamin',jns_kelamins);
                formData.append('sts_perkawinan',sts_perkawinan);
                formData.append('dusun',$('#dusun').val());
                formData.append('rt',$('#rt').val());
                formData.append('rw',$('#rw').val());
                formData.append('disabilitas',$('#disabilitas').val());
                formData.append('prekaman_ektp',$('#prekaman_ektp').val());
                formData.append('ket_details',$('#kets_details').val()+' [<?php echo date("Y-m-d H:i:s", time()) ?>] : '+result+';');
                
                if(no_kk!=''&&nik!=''&&tmp_lahir!=''&&tgl_lahir!=''&&dusun!=''&&rt!=''&&rw!=''&&sts_perkawinan!=''&&jns_kelamins!=''){
                    $.ajax({
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        url: '<?php echo base_url().$mylink ?>/saveupdate',
                        success: function(){
                            <?php echo sweat_toastr_js('Selamat Data Berhasil Diubah!','Untuk Memastikan Cek Ulang!','info','toast-top-left') ?>
                            $('#btnUpdatedDPT').prop('disabled',true);
                        },
                        error: function(){
                            alert('Could not add data');
                        }
                    });
                }
                else{
                    alert('Jangan Ada yang Kosong!');
                }
                
            });
            $(document).on("change","#no_kk,#nik,#nm_lengkap,#tmp_lahir,#tgl_lahir,.jns_kelamin,.sts_perkawinan,#dusun,#rt,#rw,#disabilitas,#prekaman_ektp", function(event){
                
                var no_kk       = $('#no_kk').val();
                var no_kk_h     = $('#no_kk_h').val();

                
                var nik         = $('#nik').val();
                var nik_h       = $('#nik_h').val();
                

                var nm_lengkap         = $('#nm_lengkap').val();
                var nm_lengkap_h       = $('#nm_lengkap_h').val();
               
                
                var tmp_lahir         = $('#tmp_lahir').val();
                var tmp_lahir_h       = $('#tmp_lahir_h').val();


                var tgl_lahir         = $('#tgl_lahir').val();
                var tgl_lahir_h       = $('#tgl_lahir_hs').val();
               
                
                var jns_kelamin_h       = $('#jns_kelamin_h').val();

                var jns_kelamins = [];
                $('.jns_kelamin').each(function(){
                    if($(this).is(":checked"))
                    {
                         jns_kelamins.push($(this).val());
                    }
                });
                jns_kelamins = jns_kelamins.toString();
                
                               
                var sts_perkawinan_h       = $('#sts_perkawinan_h').val();

                var sts_perkawinan = [];
                $('.sts_perkawinan').each(function(){
                    if($(this).is(":checked"))
                    {
                         sts_perkawinan.push($(this).val());
                    }
                });
               

                var dusun         = $('#dusun').val();
                var dusun_h       = $('#dusun_h').val();
                
                var rt         = $('#rt').val();
                var rt_h       = $('#rt_h').val();
               

                var rw         = $('#rw').val();
                var rw_h       = $('#rw_h').val();
                

                var disabilitas         = $('#disabilitas').val();
                var disabilitas_h       = $('#disabilitas_h').val();
                

                var prekaman_ektp         = $('#prekaman_ektp').val();
                var prekaman_ektp_h       = $('#prekaman_ektp_h').val();
               
                
                var keterangan         = $('#keterangan').val();
                var keterangan_h       = $('#keterangan_h').val();
                if(no_kk==''||nik==''||tmp_lahir==''||tgl_lahir==''||dusun==''||rt==''||rw==''||sts_perkawinan==''||jns_kelamins==''){
                    $('#btnUpdatedDPT').prop('disabled', true);
                }
                else if(no_kk!=no_kk_h||nik!=nik_h||nm_lengkap!=nm_lengkap_h||tmp_lahir!=tmp_lahir_h||tgl_lahir!=tgl_lahir_hs||jns_kelamins!=jns_kelamin_h||sts_perkawinan!=sts_perkawinan_h||rt!=rt_h||rw!=rw_h||dusun!=dusun_h||disabilitas!=disabilitas_h||prekaman_ektp!=prekaman_ektp_h||keterangan!=keterangan_h){
                    $('#btnUpdatedDPT').prop('disabled', false);
                }
                else{
                    $('#btnUpdatedDPT').prop('disabled', true);
                }
            });
           
        });
    </script>

   