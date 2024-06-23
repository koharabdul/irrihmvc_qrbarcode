        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Penduduk</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url(); ?>home">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>personil">Personil</a>
                        </li>
                        <li class="active">
                            <strong>Lihat Data</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row m-b-lg m-t-lg">
                <div class="col-md-4">

                    <div class="profile-image">
                        <img src="<?php echo base_url();?>assets/img/a4.jpg" class="img-circle circle-border m-b-md" alt="profile">
                    </div>
                    <div class="profile-info">
                        <div class="">
                            <div>
                                <h2 class="no-margins">
                                    <?php 
                                        echo $results['nm_lengkap'];
                                    ?>
                                </h2>
                                <h4>
                                    <?php 
                                        echo $results['pekerjaan'];
                                    ?>        
                                </h4>
                                <small><i class="fa fa-map-marker" style="width: 16px;"></i>
                                    <?php 
                                        echo $results['alamat'], 
                                        " RT. ", $results['rt'], 
                                        " RW. ", $results['rw'],
                                        "</br>Desa ", $results['nm_desa'],
                                        " Kecamatan ", $results['kecamatan'],
                                        " Kabupaten ", $results['kabupaten'],".";
                                    ?>    
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <table class="table small m-b-xs">
                        <tbody>
                            <tr>
                                <td width="25%">
                                    NIK
                                </td>
                                <td width="2%">
                                    :
                                </td>
                                <td>
                                    <?php 
                                        echo $results['NIK'];
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tempat, Tgl. Lahir
                                </td>
                                <td width="2%">
                                    :
                                </td>
                                <td width="40%">
                                    <?php 
                                        $tahun = substr($results['tgl_lahir'],0,4);
                                        $hari = substr($results['tgl_lahir'],8);
                                        $bulan = substr($results['tgl_lahir'],5,2);
                                        if(substr($results['tgl_lahir'],5,2)==1)
                                        {
                                            $stringbulan = "Januari";
                                        }
                                        else if(substr($results['tgl_lahir'],5,2)==2)
                                        {
                                            $stringbulan = "Februari";
                                        }
                                        else if(substr($results['tgl_lahir'],5,2)==3)
                                        {
                                            $stringbulan = "Maret";
                                        }
                                        else if(substr($results['tgl_lahir'],5,2)==4)
                                        {
                                            $stringbulan = "April";
                                        }
                                        else if(substr($results['tgl_lahir'],5,2)==5)
                                        {
                                            $stringbulan = "Mei";
                                        }
                                        else if(substr($results['tgl_lahir'],5,2)==6)
                                        {
                                            $stringbulan = "Juni";
                                        }
                                        else if(substr($results['tgl_lahir'],5,2)==7)
                                        {
                                            $stringbulan = "Juli";
                                        }
                                        else if(substr($results['tgl_lahir'],5,2)==8)
                                        {
                                            $stringbulan = "Agustus";
                                        }
                                        else if(substr($results['tgl_lahir'],5,2)==9)
                                        {
                                            $stringbulan = "September";
                                        }
                                        else if(substr($results['tgl_lahir'],5,2)==10)
                                        {
                                            $stringbulan = "Oktober";
                                        }
                                        else if(substr($results['tgl_lahir'],5,2)==11)
                                        {
                                            $stringbulan = "Nopember";
                                        }
                                        else if(substr($results['tgl_lahir'],5,2)==12)
                                        {
                                            $stringbulan = "Desember";
                                        }
                                        else
                                        {
                                            $stringbulan = "Tidak Ada";
                                        }

                                        if(($results['ta_lahir'] == 0) || ($results['ta_lahir'] == null) || ($results['ta_lahir'] == ''))
                                        {
                                            $q = "-";
                                        }
                                        else
                                        {
                                            if($results['b_post'] > $results['b_lahir'])
                                            {
                                                $q = $results['umur'];
                                            }
                                            else if($results['b_post'] == $results['b_lahir'])
                                            {
                                                if($results['t_post'] >= $results['t_lahir'])
                                                {
                                                    $q = $results['umur'];
                                                }
                                                else
                                                {
                                                    $q = $results['umur']-1;
                                                }
                                            }
                                            else
                                            {
                                                $q = $results['umur']-1;
                                            }
                                        }


                                       
                                        echo $results['tmp_lahir'],", ",$hari," ",$stringbulan," ", $tahun, "<label class='pull-right' style='font-weight: normal;'> ($q Tahun)</label>";



                                    ?> 


                                </td>
                            </tr>
                            <tr>
                                <td width="25%">
                                    Jenis Kelamin
                                </td>
                                <td width="2%">
                                    :
                                </td>
                                <td>
                                    <?php 
                                        if($results['jns_kelamin']=='P')
                                        {
                                            $kelamin = "Perempuan";
                                        }
                                        else
                                        {
                                            $kelamin = "Laki-laki";
                                        }
                                        echo $kelamin;
                                    ?>  
                                </td>


                            </tr>
                            <tr>
                                <td width="25%">
                                    Agama
                                </td>
                                <td width="2%">
                                    :
                                </td>
                                <td>
                                    <?php 
                                        echo $results['agama'];
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td width="25%">
                                    Status Perkawinan
                                </td>
                                <td width="2%">
                                    :
                                </td>
                                <td>
                                    <?php 
                                        echo $results['sts_perkawinan'];
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td width="25%">
                                    Nama Ibu
                                </td>
                                <td width="2%">
                                    :
                                </td>
                                <td>
                                    Yoyoh Rokayah
                                    <label class="pull-right" style="font-weight: normal;">(32042844069600006)</label>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%">
                                    Nama Ayah
                                </td>
                                <td width="2%">
                                    :
                                </td>
                                <td>
                                    H. Amin (Alm)
                                    <label class="pull-right" style="font-weight: normal;">(32042803039300011)</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2">
                    <div class="btn-group pull-right">
                        
                        <button class="btn btn-sm btn-default m-t-n-xs" type="button" onclick="self.history.back()" title="Reply">
                            <i class="fa fa-reply"></i>
                        </button>
                        <?php echo anchor('personil/edt/'.$results['id_p'],'<i class="fa fa-pencil"></i>',array('class' => 'btn btn-sm btn-default m-t-n-xs','type' => 'botton','title' => 'Edit')); ?>
                        <?php echo anchor('personil/dlt/'.$results['id_p'],'<i class="fa fa-trash"></i>',array('class' => 'btn btn-sm btn-default m-t-n-xs','type' => 'botton','title' => 'Delete', 'onclick' => "return confirm('are you sure want to delete?');")); ?>

                        
                    </div>
                </div>
            </div>
        </div>