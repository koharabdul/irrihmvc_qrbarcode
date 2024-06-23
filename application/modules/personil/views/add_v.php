            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Data Personil</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>home">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>personil">Personil</a>
                        </li>
                        <li class="active">
                            <strong>Tambah Data</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
           

            <div class="ibox">
                 <div class="ibox-title">
                    <h5>Formulir Tambah Data Penduduk</h5>
                </div>
                <div class="ibox-content">
                    <div class="row wrapper white-bg page-heading">
                        <?php $attributes = array("name" => "flatihan", "class" => "form-horizontal m-t-md");
                            echo form_open("personil/add", $attributes);
                        ?> 
                            <div class="col-lg-6 b-r">
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-3 control-label">NIK</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <?php 
                                                    echo form_input('nik', 
                                                                     set_value('nik'), 
                                                                     array('class' => 'form-control',
                                                                           'type' => 'text',
                                                                           'placeholder' => '...',
                                                                           'data-mask' => '9999999999999999')); 
                                                ?>
                                                <span class="input-group-addon">
                                                    <i class="fa fa-address-card"></i>
                                                </span>
                                            </div>
                                            <span class="help-block" style="color:red;">
                                                <?php echo form_error('nik'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-3 control-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <?php 
                                                    echo form_input('nm_lengkap', 
                                                                     set_value('nm_lengkap'), 
                                                                     array('class' => 'form-control',
                                                                           'type' => 'text',
                                                                           'placeholder' => '...')); 
                                                ?>
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user-circle" style="width: 16px;"></i>
                                                </span>
                                            </div>
                                            <span class="help-block" style="color:red;">
                                                <?php echo form_error('nm_lengkap'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-3 control-label">Tempat Lahir</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <?php 
                                                    echo form_input('tmp_lahir', 
                                                                     set_value('tmp_lahir'), 
                                                                     array('class' => 'form-control',
                                                                           'type' => 'text',
                                                                           'placeholder' => '...')); 
                                                ?>
                                                <span class="input-group-addon">
                                                    <i class="fa fa-address-book" style="width: 16px;"></i>
                                                </span>
                                            </div>
                                            <span class="help-block" style="color:red;">
                                                <?php echo form_error('tmp_lahir'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="data_1">
                                        <label class="col-sm-3 col-sm-3 control-label">Tanggal Lahir</label>
                                        <div class="col-sm-9">
                                            <div class="input-group date">
                                                <?php 
                                                    echo form_input('tgl_lahir', 
                                                                     set_value('tgl_lahir'), 
                                                                     array('class' => 'form-control',
                                                                           'type' => 'text',
                                                                           'data-mask' => '99/99/9999',
                                                                           'placeholder' => 'dd/mm/yyyy')); 
                                                ?>
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                            <span class="help-block" style="color:red;">
                                                <?php echo form_error('tgl_lahir'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-3 control-label">Jenis Kelamin</label>
                                        <div class="col-sm-9">
                                            <div class="radio radio-info radio-inline">
                                                <?php echo form_radio('jns_kelamin','P'); ?>
                                                <label for="inlineRadio1"> Perempuan </label>
                                            </div>
                                            <div class="radio radio-info radio-inline">
                                                <?php echo form_radio('jns_kelamin','L'); ?>
                                                <label for="inlineRadio2"> Laki-laki </label>
                                            </div>
                                            <span class="help-block warning" style="color:red;">
                                                <?php echo form_error('jns_kelamin'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 col-sm-3 control-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <?php 
                                                    echo form_input('alamat', 
                                                                     set_value('alamat'), 
                                                                     array('class' => 'form-control',
                                                                           'type' => 'text',
                                                                           'placeholder' => '...')); 
                                                ?>
                                                <span class="input-group-addon">
                                                    <i class="fa fa-map-marker" style="width: 16px;"></i>
                                                </span>
                                            </div>
                                            <span class="help-block" style="color:red;">
                                                <?php echo form_error('alamat'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">RT</label>
                                    <div class="col-sm-9">
                                        <select class="select2_demo_1 form-control" style="padding-left: 7px;" name="rt">
                                            <?php 
                                                for($rt=1; $rt<=30; $rt++)
                                                {
                                                    echo"<option value='$rt'>$rt</option>";
                                                }
                                            ?>
                                        </select>
                                        <span class="help-block" style="color:red;">
                                            <?php echo form_error('rt'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">RW</label>
                                    <div class="col-sm-9">
                                        <select class="select2_demo_1 form-control" style="padding-left: 7px;" name="rw">
                                            <?php 
                                                for($rw=1; $rw<=30; $rw++)
                                                {
                                                    echo"<option value='$rw'>$rw</option>";
                                                }
                                            ?>
                                        </select>
                                        <span class="help-block" style="color:red;">
                                            <?php echo form_error('rw'); ?>
                                        </span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-6 b-r">
                               
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Desa/Kelurahan</label>
                                    <div class="col-sm-9">
                                        <?php 
                                            echo form_dropdown('id_desa', 
                                                               $desa, 
                                                     set_value('id_desa'), 
                                                     array('placeholder' => '-Pilih-',
                                                           'class' => 'select2_demo_1 form-control'
                                            )); 
                                        ?>
                                        <span class="help-block" style="color:red;">
                                            <?php echo form_error('id_desa'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Agama</label>
                                    <div class="col-sm-9">
                                        <?php 
                                            $options = array(
                                                    'Islam'                                     => 'Islam',
                                                    'Kristen'                                   => 'Kristen',
                                                    'Katholik'                                  => 'Katholik',
                                                    'Budha'                                     => 'Budha',
                                                    'Hindu'                                     => 'Hindu',
                                                    'Kong Hucu'                                 => 'Kong Hucu',
                                                    'Kepercayaan Terhadap Tuhan Yang Maha Esa'  => 'Kepercayaan Terhadap Tuhan Yang Maha Esa'
                                            );

                                            echo form_dropdown('agama',$options, set_value('agama'),array('class' => 'select2_demo_1 form-control', 'style' => 'padding-left: 7px;'));
                                        ?>
                                        <span class="help-block" style="color:red;">
                                            <?php echo form_error('agama'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Status Perkawinan</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="radio radio-info">
                                                    <?php echo form_radio('sts_perkawinan','Belum Kawin'); ?>
                                                    <label for="radio1">
                                                        Belum Kawin
                                                    </label>
                                                </div>
                                                <div class="radio radio-info">
                                                    <?php echo form_radio('sts_perkawinan','Kawin'); ?>
                                                    <label for="radio2">
                                                        Kawin
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="radio radio-info">
                                                    <?php echo form_radio('sts_perkawinan','Cerai Hidup'); ?>
                                                    <label for="radio3">
                                                        Cerai Hidup
                                                    </label>
                                                </div>
                                                <div class="radio radio-info">
                                                    <?php echo form_radio('sts_perkawinan','Cerai Mati'); ?>
                                                    <label for="radio4">
                                                        Cerai Mati
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="help-block" style="color:red;">
                                            <?php echo form_error('sts_perkawinan'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label">Pekerjaan</label>
                                    <div class="col-sm-9">
                                        <?php 
                                            $options = array(
                                                'Belum/Tidak Bekerja'                           => 'Belum/Tidak Bekerja',
                                                'Mengurus Rumah Tangga'                         => 'Mengurus Rumah Tangga',
                                                'Pelajar/Mahasiswa'                             => 'Pelajar/Mahasiswa',
                                                'Pensiunan'                                     => 'Pensiunan',
                                                'Pegawai Negri Sipil (PNS)'                     => 'Pegawai Negri Sipil (PNS)',
                                                'Tentara Nasional Indonesia'                    => 'Tentara Nasional Indonesia',
                                                'Kepolisian RI (POLRI)'                         => 'Kepolisian RI (POLRI)',
                                                'Perdagangan'                                   => 'Perdagangan',
                                                'Petani/Pekebun'                                => 'Petani/Pekebun',
                                                'Peternak'                                      => 'Peternak',
                                                'Nelayan/Perikanan'                             => 'Nelayan/Perikanan',
                                                'Industri'                                      => 'Industri',
                                                'Kontruksi'                                     => 'Kontruksi',
                                                'Transportasi'                                  => 'Transportasi',
                                                'Karyawan Swasta'                               => 'Karyawan Swasta',
                                                'Karyawan BUMN'                                 => 'Karyawan BUMN',
                                                'Karyawan Honorer'                              => 'Karyawan Honorer',
                                                'Buruh Harian Lepas'                            => 'Buruh Harian Lepas',
                                                'Buruh Tani/Perkebunan'                         => 'Buruh Tani/Perkebunan',
                                                'Buruh Nelayan/Perikanan'                       => 'Buruh Nelayan/Perikanan',
                                                'Buruh Peternakan'                              => 'Buruh Peternakan',
                                                'Pembantu Rumah Tangga'                         => 'Pembantu Rumah Tangga',
                                                'Tukang Cukur'                                  => 'Tukang Cukur',
                                                'Tukang Listrik'                                => 'Tukang Listrik',
                                                'Tukang Batu'                                   => 'Tukang Batu',
                                                'Tukang Kayu'                                   => 'Tukang Kayu',
                                                'Tukang Sol Sepatu'                             => 'Tukang Sol Sepatu',
                                                'Tukang Las / Pandai Besi'                      => 'Tukang Las / Pandai Besi',
                                                'Tukang Jahit'                                  => 'Tukang Jahit',
                                                'Tukang Gigi'                                   => 'Tukang Gigi',
                                                'Penata Rias'                                   => 'Penata Rias',
                                                'Penata Busana'                                 => 'Penata Busana',
                                                'Penata Rambut'                                 => 'Penata Rambut',
                                                'Makanik'                                       => 'Mekanik',
                                                'Seniman'                                       => 'Seniman',
                                                'Tabib'                                         => 'Tabib',
                                                'Peraji'                                        => 'Peraji',
                                                'Perancang Busana'                              => 'Perancang Busana',
                                                'Penterjemah'                                   => 'Penterjemah',
                                                'Imam Mesjid'                                   => 'Imam Mesjid',
                                                'Pendeta'                                       => 'Pendeta',
                                                'Pastor'                                        => 'Pastor',
                                                'Wartawan'                                      => 'Wartawan',
                                                'Ustadz/Mubalig'                                => 'Ustadz/Mubalig',
                                                'Juru Masak'                                    => 'Juru Masak',
                                                'Promotor Acara'                                => 'Promotor Acara',
                                                'Anggota DPR RI'                                => 'Anggota DPR RI',
                                                'Anggota DPD'                                   => 'Anggota DPD',
                                                'Anggota BPK'                                   => 'Anggota BPK',
                                                'Presiden'                                      => 'Presiden',
                                                'Wakil Presiden'                                => 'Wakil Presiden',
                                                'Anggota Mahkamah Konstitusi'                   => 'Anggota Mahkamah Konstitusi',
                                                'Anggota Kabinet / Kementrian'                  => 'Anggota Kabinet / Kementrian',
                                                'Duta Besar'                                    => 'Duta Besar',
                                                'Gubernur'                                      => 'Gubernur',
                                                'Wakil Gubernur'                                => 'Wakil Gubernur',
                                                'Bupati'                                        => 'Bupati',
                                                'Wakil Bupati'                                  => 'Wakil Bupati',
                                                'Walikota'                                      => 'Walikota',
                                                'Wakil Walikota'                                => 'Wakil Walikota',
                                                'Anggota DPRD Prov.'                            => 'Anggota DPRD Prov.',
                                                'Anggota DPRD Kab/Kota PROFESI SELAIN PEGAWAI NEGRI DAN MANDIRI' => 'Anggota DPRD Kab/Kota PROFESI SELAIN PEGAWAI NEGRI DAN MANDIRI',
                                                'Dosen'                                         => 'Dosen',
                                                'Guru'                                          => 'Guru',
                                                'Pilot'                                         => 'Pilot',
                                                'Pengacara'                                     => 'Pengacara',
                                                'Notaris'                                       => 'Notaris',
                                                'Arsitek'                                       => 'Arsitek',
                                                'Akuntan'                                       => 'Akuntan',
                                                'Konsultan'                                     => 'Konsultan',
                                                'Dokter'                                        => 'Dokter',
                                                'Bidan'                                         => 'Bidan',
                                                'Perawat'                                       => 'Perawat',
                                                'Apoteker'                                      => 'Apoteker',
                                                'Psikiater/Psikolog'                            => 'Psikiater/Psikolog',
                                                'Penyiar Televisi'                              => 'Penyiar Televisi',
                                                'Penyiar Radio'                                 => 'Penyiar Radio',
                                                'Pelaut'                                        => 'Pelaut',
                                                'Peneliti'                                      => 'Peneliti',
                                                'Sopir'                                         => 'Sopir',
                                                'Pialang'                                       => 'Pialang',
                                                'Paranormal'                                    => 'Paranormal',
                                                'Pedagang'                                      => 'Pedagang',
                                                'Perangkat Desa'                                => 'Perangkat Desa',
                                                'Biarawati'                                     => 'Biarawati',
                                                'Wiraswasta'                                    => 'Wiraswasta'

                                            );

                                            echo form_dropdown('pekerjaan',$options, set_value('pekerjaan'),array('class' => 'select2_demo_1 form-control'));
                                        ?>
                                        <span class="help-block" style="color:red;">
                                            <?php echo form_error('pekerjaan'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                        <button class="btn btn-sm btn-default m-t-n-xs" type="button" onclick="self.history.back()">Kembali</button>
                                        <button class="btn btn-sm btn-primary m-t-n-xs" type="submit">Save</button>
                                    </div>
                                </div>

                                

                               
                            </div>
                        <?php echo form_close(); ?> 
                    </div>
                </div>
            </div>









        </div>
        <?php echo $this->session->flashdata('infowarning'); ?>
       
       