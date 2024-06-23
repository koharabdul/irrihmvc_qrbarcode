<?php

/**
 * @author Abdul Kohar <koharabdul90@gmail.com  | +28973749166 | https://www.linkedin.com/in/abdulkohar | http://www.abdulkohar.com >
 */


function input_button($name='',$label='',$value='',$class='btn btn-success btn-sm')
{
    echo '<button type="button" id="'.$name.'" name="'.$name.'" $value="'.$value.'" class="'.$name.'">'.$label.'</button>';
}

function button_submit($label)
{
    echo '<button type="submit" id="send" class="btnSubmit btn btn-success btn-sm">'.$label.'</button>';
}

function btn_view($uri)
{
    return anchor($uri, '<i class="fa fa-folder"></i> View ',
        array(
            'title' => 'View Data',
            'class' => 'btn btn-primary btn-xs'
        ));
}

function btn_save()
{
    echo '<button type="submit" id="send" class="btn btn-success"><span class="fa fa-floppy-o fa-right"></span> Submit</button>';
}

function btn_edit($uri)
{
    return anchor($uri, '<i class="fa fa-pencil"></i> Edit ',
        array(
            'title' => 'Edit Data',
            'class' => 'btn btn-info btn-xs',
            'data-toggle' => 'tooltip',
            'data-placement' => 'left'
        ));
}


function btn_delete($uri)
{
    return anchor($uri, '<i class="fa fa-trash-o"></i> Delete ',
        array(
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Sure to remove data?');",
            'title' => 'Delete'
        ));
}

function btn_active($uri)
{
    return anchor($uri, 'Active',
        array(
            'onclick' => "return confirm('Are you sure?');",
            'title' => 'Set Active',
            'class' => 'btn btn-flat btn-success '
        ));
}

function btn_nonactive($uri)
{
    return anchor($uri, 'Inactive',
        array(
            'onclick' => "return confirm('Are you sure?');",
            'title' => 'Set Inactive',
            'class' => 'btn btn-flat btn-danger '
        ));
}

function btn_back($uri)
{
    // echo anchor($uri, 'Cancel',
    //     array(
    //         'title' => 'Back',
    //         'class' => 'btn'
    //     ));
    
    echo '<a href="'.base_url($uri).'" class="btn btn-danger"><span class="fa fa-reply"></span> Back</a>';
}

function permission_link($uri,$title,$class,$id=null)
{

    $id= !is_null($id) ? "/".$id : "";

    $page_data = get_pagedata();

    if (in_array($uri, $page_data)){

        return anchor($uri.$id, $title,
        array(
            'class' => $class
        ));

    }
    else{
        return "";
    }
}

function link_new($uri)
{

    $page_data = get_pagedata();

    if (in_array($uri, $page_data)){

        return anchor($uri, 'Create New',
        array(
            'class' => 'btn btn-danger btn-condensed'
        ));

    }
    else{
        return "";
    }
}

function link_view($uri,$id)
{

    $page_data = get_pagedata();

    if (in_array($uri, $page_data)){

        return anchor($uri.'/'.$id, '<i class="glyphicon glyphicon-zoom-in"></i>',
        array(
            'class' => 'btn btn-success btn-condensed',
            'data-original-title'=>'View'
        ));

    }
    else{
        return "";
    }
}

function link_edit($uri,$id)
{

    $page_data = get_pagedata();

    if (in_array($uri, $page_data)){

        return anchor($uri.'/'.$id, '<i class="glyphicon glyphicon-edit"></i>',
        array(
            'class' => 'btn btn-info btn-condensed',
            'data-original-title'=>'Edit'
        ));

    }
    else{
        return "";
    }

}

function link_remove($uri,$id)
{

    $page_data = get_pagedata();

    if (in_array($uri, $page_data)){

        return anchor($uri.'/'.$id, '<i class="glyphicon glyphicon-trash"></i>',
        array(
            'class' => 'btn btn-danger btn-condensed',
            'onclick' => "return confirm('Sure to remove data?');",
            'data-original-title'=>'Remove'
        ));

    }
    else{
        return "";
    }
}

function load_notif()
{
    $CI = &get_instance();
    if ($CI->session->flashdata('error')) {
        // echo '<div class="alert alert-dismissible alert-danger">';
        // echo '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>';
        // echo $CI->session->flashdata('error');
        // echo '</div>';
      echo "<script>$(document).ready(function(){t_alert('error','".$CI->session->flashdata('error')."');});</script>";
    } elseif ($CI->session->flashdata('success')) {
        // echo '<div class="alert alert-dismissible alert-success">';
        // echo '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>';
        // echo $CI->session->flashdata('success');
        // echo '</div>';
        echo "<script>$(document).ready(function(){t_alert('success','".$CI->session->flashdata('success')."');});</script>";
    }
}

function simple_load_notif()
{
    $CI = &get_instance();
    if ($CI->session->flashdata('error')) {
        echo '<div class="alert alert-dismissible alert-danger">';
        echo '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>';
        echo $CI->session->flashdata('error');
        echo '</div>';
    } elseif ($CI->session->flashdata('success')) {
        echo '<div class="alert alert-dismissible alert-success">';
        echo '<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>';
        echo $CI->session->flashdata('success');
        echo '</div>';
    }
}

function btn_print($uri)
{
    return anchor($uri, '<i class="fa fa-print"></i> Print',
        array(
            'title' => 'Print',
            'class' => 'btn btn-flat btn-default '
        ));
}

function active_status($status)
{
    if ($status == 1) {
        $ret = '<center><span class="text-success"><strong>Active</strong></span></center>';
    } else {
        $ret = '<center><span class="text-error"><strong>Inactive</strong></span></center>';
    }
    return $ret;
}

function btn_saveAndback($value1,$url,$name,$value2)
{
    echo'<div class="form-group">';
        echo'<div class="col-lg-2">';
        echo'</div>';
        echo'<div class="col-lg-10">';
            echo anchor($url,$value1,array('class' => 'btn btn-sm btn-default m-t-n-xs','type' => 'botton'));
            echo' ';
            $data = array('type' => 'submit', 'name' => $name, 'class' => 'btn btn-sm btn-primary m-t-n-xs', 'content' => $value2);
                echo form_button($data);
        echo'</div>';
            
        
   echo' </div>';    
}

function select_gender($field_name, $label, $required = false, $readonly=false )
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group">
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-sm-10">
                <div class="radio radio-info radio-inline">';
                        echo form_radio($attribut,'Perempuan');
                    echo'<label for="inlineRadio1"> Perempuan </label>
                </div>
                <div class="radio radio-info radio-inline">';
                    echo form_radio($attribut,'Laki-laki'); 
                    echo'<label for="inlineRadio2"> Laki-laki </label>
                </div>
                <span class="help-block warning" style="color:red;">';
                    echo form_error($field_name); 
                echo'</span>
            </div>
        </div>';
}

function select_maritalstatus($field_name, $label,$required = false, $readonly=false )
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group">
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="radio radio-info">';
                            echo form_radio($field_name,'Belum Kawin');
                        echo'<label for="radio1">
                                Belum Kawin
                            </label>
                        </div>
                        <div class="radio radio-info">';
                            echo form_radio($field_name,'Kawin');
                        echo'<label for="radio2">
                                Kawin
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="radio radio-info">';
                            echo form_radio($field_name,'Cerai Hidup');
                        echo'<label for="radio3">
                                Cerai Hidup
                            </label>
                        </div>
                        <div class="radio radio-info">';
                            echo form_radio($field_name,'Cerai Mati');
                        echo'<label for="radio4">
                                Cerai Mati
                            </label>
                        </div>
                    </div>
                </div>
                <span class="help-block" style="color:red;">';
                    echo form_error($field_name);
            echo'</span>
            </div>
        </div>';
}

function select_religion($field_name, $label,$required = false, $readonly=false)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group">
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-sm-10">';
                 
                    $options = array(
                            'Islam'                                     => 'Islam',
                            'Kristen'                                   => 'Kristen',
                            'Katholik'                                  => 'Katholik',
                            'Budha'                                     => 'Budha',
                            'Hindu'                                     => 'Hindu',
                            'Kong Hucu'                                 => 'Kong Hucu',
                            'Kepercayaan Terhadap Tuhan Yang Maha Esa'  => 'Kepercayaan Terhadap Tuhan Yang Maha Esa'
                    );

                    echo form_dropdown($field_name, $options, '' ,array('class' => 'select2_demo_1 form-control'));
               
            echo'<span class="help-block" style="color:red;">';
                     echo form_error($field_name); 
            echo'</span>
            </div>
        </div>';
}

function select_perpage($field_name, $label,$selected = '',$required='',$disabled=false)
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
    

    $attribut = array(
        'class'        =>   'form-control select2_demo_1',
        'placeholder'  =>   'Choose '.$label,
        'id'           =>   $field_name
    );

    
    $options = array('10' => 10,
                    '20' => 20,
                    '25' => 25,
                    '50' => 50,
                    '75' => 75,
                    '100' => 100,
                    '1'  => 1,
                    '2'  => 2,
                    '5'  => 5);

    !$disabled ?: $attribut['disabled'] = true;

    echo'<div class="form-group">
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-sm-10">';
                 
                echo form_dropdown($field_name, $options, $selected ,$attribut);
               
            echo'<span class="help-block" style="color:red;">';
                     echo form_error($field_name); 
            echo'</span>
            </div>
        </div>';
}

function select_perpage_nolabel($field_name, $label,$selected = '',$required='',$disabled=false)
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
    

    $attribut = array(
        'class'        =>   'select2_demo_1 input-sm input-s-sm',
        'placeholder'  =>   'Choose '.$label,
        'id'           =>   $field_name
    );

    
    $options = array('10' => 10,
                    '25' => 25,
                    '50' => 50,
                    '75' => 75,
                    '100' => 100
                    // '1'  => 1,
                    // '2'  => 2,
                    // '5'  => 5
                );

    !$disabled ?: $attribut['disabled'] = true;

    echo'<div class="form-group">Show ';
        echo form_dropdown($field_name, $options, $selected ,$attribut);
    echo'entries</div>';
}


// function select_chosen($field_name, $label,$selected = '',$required='',$disabled=false)
// {
//     $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
    

//     $attribut = array(
//         'class'        =>   'chosen-select',
        
//         'id'           =>   $field_name
//     );

    
//     $options = array('10' => 10,
//                     '25' => 25,
//                     '50' => 50,
//                     '75' => 75,
//                     '100' => 100
//                 );

//     !$disabled ?: $attribut['disabled'] = true;

//     echo'<div>Show ';
//         echo form_dropdown($field_name, $options, $selected ,$attribut);
//     echo'entries</div>';

// }



function last_education($field_name, $label,$required = false, $readonly=false)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group">
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-sm-10">';
                 
                    $options = array(
                            'Tidak/Belum Sekolah'                 => 'Tidak/Belum Sekolah',
                            'Belum Tamat SD/Sederajat'            => 'Belum Tamat SD/Sederajat',
                            'Tamat SD/Sederajat'                  => 'Tamat SD/Sederajat',
                            'SLTP/Sederajat'                      => 'SLTP/Sederajat',
                            'SLTA/Sederajat'                      => 'SLTA/Sederajat',
                            'Diploma I/II'                        => 'Diploma I/II',
                            'Akademi/Diploma III/Sarjana Muda'    => 'Akademi/Diploma III/Sarjana Muda',
                            'Diploma IV/Strata I'                 => 'Diploma IV/Strata I',
                            'Strata II'                           => 'Strata II',
                            'Strata III'                          => 'Strata III'
                    );

                    echo form_dropdown($field_name, $options, '' ,array('class' => 'select2_demo_1 form-control'));
               
            echo'<span class="help-block" style="color:red;">';
                     echo form_error($field_name); 
            echo'</span>
            </div>
        </div>';
}

function perpage($field_name, $label,$required = false, $readonly=false)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group">
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-sm-10">';
                 
                    $options = array(
                            '10'                 => '10',
                            '20'                 => '20',
                            '25'                 => '25',
                            '50'                 => '50',
                            '75'                 => '75',
                            '100'                => '100',
                            '1'                  => '1',
                            '2'                  => '2',
                            '3'                  => '3',
                            '4'                  => '4',
                            '5'                  => '5',
                            '6'                  => '6',
                            '7'                  => '7',
                            '8'                  => '8',
                            '9'                  => '9'
                    );

                    echo form_dropdown($field_name, $options, '' ,array('class' => 'select2_demo_1 form-control'));
               
            echo'<span class="help-block" style="color:red;">';
                     echo form_error($field_name); 
            echo'</span>
            </div>
        </div>';
}



function select_employement($field_name, $label,$required = false, $readonly=false)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group">
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-sm-10">';
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
            echo'<span class="help-block" style="color:red;">';
                    echo form_error($field_name); 
            echo'</span>
            </div>
        </div>';
}
        

function input_text($field_name, $label, $value = '',$required = false, $readonly=false,$class='', $icon='fa fa-pencil')
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control '.$class,
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group" >
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-lg-10">                                           
                <div class="input-group">';
                echo form_input( $attribut, set_value($field_name, $value));
                    echo'<span class="input-group-addon"><span class="'.$icon.'" style="width:15px;"></span></span>
                </div>                                            
                <span class="help-block '.$field_name.'" style="color:red;">';
            echo form_error($field_name);
            echo'</span>
            </div>
        </div>';
}
function input_textarea($field_name, $label, $value = '',$required = false, $readonly=false,$class='',$style='')
{
    $req = ($required) ? '<font color="red"> * </font>' : '';
    if(empty($style)){$style='height:80px;';}else{$style=$style;}
    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control  '.$class,
                    'placeholder' => 'Enter '.$label,
                    'style'       => $style
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group" >
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-lg-10">                                           
                <div class="media-body">';
                echo form_textarea( $attribut, set_value($field_name, $value));
                    echo'
                </div>                                            
                <span class="help-block '.$field_name.'" style="color:red;">';
            echo form_error($field_name);
            echo'</span>
            </div>
        </div>';
}
function label_view($label, $value = '')
{
    
    ($value) ? "<i class='fa fa-check text-navy'></i>" : "<i class='fa fa-times text-danger'></i>";
        
    echo'<div class="form-group" style="margin-top:5px;">
            <label class="col-lg-2 control-label">'.$label.' :</label>
            <div class="col-lg-10">                                           
                <div class="media-body">'; echo($value) ? "<i class='fa fa-check text-navy' style='padding-top:10px;margin-left:12px;'></i>" : "<i class='fa fa-times text-danger' style='padding-top:10px;margin-left:12px;'></i>";echo'
                </div>                                            
            </div>
        </div>';
}
function label_view_array($label, $value = '')
{
    
   
        
    echo'<div class="form-group" style="margin-bottom:-10px;">
            <label class="col-lg-2 control-label" style="margin-top:-7px;">'.$label.' :</label>
            <div class="col-lg-10">                                           
                <div class="form-group">
                    <span>'.$value.'</span>
                </div>                                            
            </div>
        </div>';
}
function input_hidden($field_name, $value = '')
{
    
    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'type' => 'hidden',
                );
    echo form_input( $attribut, set_value($field_name, $value));
                
}
function sweat_toastr_js($headernotif = '',$contentnotif='', $toastr='success',$positionClass= 'toast-top-right'){
    echo" setTimeout(function() {
               toastr.options = {
                    'closeButton': true,
                    'debug': false,
                    'progressBar': true,
                    'preventDuplicates': false,
                    'positionClass': '".$positionClass."',
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
                toastr.".$toastr."('".$contentnotif."', '".$headernotif."');
            }, 1300);
            ";
}
function table_tr($label,$value='',$titik='',$styleborder=''){
    echo'<tr style="'.$styleborder.'">
            <td style="width: 20%;">'.$label.'</td>
            <td style="width: 5px;">'.$titik.'</td>
            <td>'.$value.'</td>
        </tr>';
}
function input_text2($field_name, $label, $value = '',$required = false, $readonly=false)
{
    
    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'placeholder' => 'Enter '.$label,
                    'disabled' => true,
                    'style' => 'border-top: none; border-left:none; border-right:none;background: transparent;border-bottom-style: dashed;'
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group" style="margin-bottom: 0px;margin-top: 0px;">
            <label class="col-lg-2 control-label">'.$label.' :</label>
            <div class="col-lg-10">                                           
                <div class="media-body" >';
                echo form_input( $attribut, set_value($field_name, $value));
                    echo'
                </div>                                            
            </div>
        </div>';
}

function input_date($field_name, $label, $value = '',$required = false, $readonly=false, $icon='fa fa-calendar')
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'type' => 'text',
                    'data-mask' => '99/99/9999',
                    'placeholder' => 'dd/mm/yyyy'
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group" id="data_1">
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-sm-10">
                <div class="input-group date">';
                       echo form_input( $attribut, set_value($field_name, $value));
                    echo'<span class="input-group-addon">
                        <i class="fa fa-calendar" style="width:15px;"></i>
                    </span>
                </div>
                <span class="help-block" style="color:red;">';
                    echo form_error($field_name);
                echo'</span>
            </div>
        </div>';
}

function input_mask($field_name, $label, $value = '',$required = false, $readonly=false, $data_mask,$icon='fa fa-pencil')
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'placeholder' => 'Enter '.$label,
                    'data-mask' => $data_mask
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group">
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-lg-10">                                            
                <div class="input-group">';
                echo form_input( $attribut, set_value($field_name, $value));
                    echo'<span class="input-group-addon"><span class="'.$icon.'" style="width:15px;"></span></span>
                </div>                                            
                <span class="help-block" style="color:red;">';
            echo form_error($field_name);

            echo'</span>
            </div>
        </div>';
}



function input_file($field_name, $label, $value = '',$required = false,$readonly=false,$class='col-lg-10')
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'value' => $value
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group">';
        echo'<label class="col-lg-2 control-label">'.$label.$req.'</label>';
        echo'<div class="'.$class.'">';
            echo'<div class="fileinput fileinput-new input-group" data-provides="fileinput">';
                echo'<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>';
                echo'<span class="input-group-addon btn btn-default btn-file">';
                    echo'<span class="fileinput-new"><span class="fa fa-file-image-o"></span></span>';
                    echo'<span class="fileinput-exists">Change</span>';
                        echo form_upload($attribut, set_value($field_name, $value));
                echo'</span>';
                echo'<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>';
                echo'<span class="help-block" style="color:red;">';
                echo form_error($field_name);

                echo'</span>';
            echo'</div>';
        echo'</div>';
    echo'</div>';
}

  
function input_multiselect($field_name, $label, $options,$selected = '',$required='',$readonly=false)
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
   
        echo'<div class="form-group">';
            echo'<label class="col-lg-2 control-label">'.$label.$req.'</label>';
                echo'<div class="col-lg-10" >';   
                            echo form_dropdown($field_name, $options, $selected,array(
                                'class' => 'select2_demo_3 form-control',
                                'placeholder'=>'Pilih '.$label,
                                'multiple'=> 'true',
                                'style'=>'width:100%;'
                            ));
                        echo'<span class="help-block" style="color:red;">';
                            echo form_error($field_name);
                        echo'</span>';
                    echo'</div>';
        echo'</div>';


   
}

function input_checkbox_switch($field_name, $label, $checked='', $readonly=false){

    $data = array(
            'name'          => $field_name,
            'id'            => $field_name,
            'checked'       => $checked,
            'class'         => 'onoffswitch-checkbox'
    );

                        

    echo'<div class="form-group '.$field_name.'" >
            <label class="col-lg-2 control-label" style="margin-top: -7px;">'.$label.'</label>
            <div class="col-lg-10">                                           
                <div class="input-group">
                   <div class="switch">
                        <div class="onoffswitch">';
                            echo form_checkbox($data);
                            echo'
                            <label class="onoffswitch-label" for="'.$field_name.'">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>                                            
                <span class="help-block" style="color:red;"></span>
            </div>
        </div>';
}

function input_multiselect2($field_name, $label, $options,$selected = '',$required='',$readonly=false)
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
   
        echo'<div class="form-group">';
            echo'<label class="col-lg-2 control-label">'.$label.$req.'</label>';
                echo'<div class="col-lg-10" >';   
                            echo form_dropdown($field_name, $options, $selected,array(
                                'class' => 'select2_demo_2 form-control',
                                'placeholder'=>'Pilih '.$label,
                                'multiple'=> 'true',
                                'style'=>'width:100%;',
                                'id' => $field_name
                            ));
                        echo'<span class="help-block" style="color:red;">';
                            echo form_error($field_name);
                        echo'</span>';
                    echo'</div>';
        echo'</div>';


   
}

// function input_multiselect_2($field_name, $label, $options,$selected = '',$required='',$readonly=false)
// {
//     $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
   
//         echo'<div class="form-group">';
//             echo'<label class="col-lg-2 control-label">'.$label.$req.'</label>';
//                 echo'<div class="col-lg-10" >';   
//                             echo form_dropdown($field_name, $options, $selected,array(
//                                 'class' => 'select2_demo_2 form-control',
//                                 'placeholder'=>'Pilih '.$label,
//                                 'multiple'=> 'true',
//                                 'style'=>'width:100%;'
//                             ));
//                         echo'<span class="help-block" style="color:red;">';
//                             echo form_error($field_name);
//                         echo'</span>';
//                     echo'</div>';
//         echo'</div>';


   
// }
function input_select($field_name, $label, $options,$selected = '',$required='',$readonly=false)
{
    $req = ($required) ? '<font color="red"> &nbsp; * </font>' : '';
   
        echo'<div class="form-group">';
            echo'<label class="col-lg-2 control-label">'.$label.$req.'</label>';
                echo'<div class="col-lg-10" >';   
                            echo form_dropdown($field_name, $options, $selected,array(
                                'class' => 'select2_demo_2 form-control',
                                'placeholder'=>'Pilih '.$label,
                                'style'=>'width:100%;'
                            ));
                        echo'<span class="help-block" style="color:red;">';
                            echo form_error($field_name);
                        echo'</span>';
                    echo'</div>';
        echo'</div>';


   
}


function select_kewarganegaraan($field_name, $label,$required = false, $readonly=false)
{
    $req = ($required) ? '<font color="red"> * </font>' : '';

    $attribut = array(
                    'name' => $field_name,
                    'id' => $field_name,
                    'class' => 'form-control',
                    'placeholder' => 'Enter '.$label,
                );

    !$readonly ?: $attribut['readonly'] = true;
    
    echo'<div class="form-group">
            <label class="col-lg-2 control-label">'.$label.$req.'</label>
            <div class="col-sm-10">';
                 
                    $options = array(
                            'WNI'                 => 'WNI',
                            'WNA'                 => 'WNA'
                    );

                    echo form_dropdown($field_name, $options, '' ,array('class' => 'select2_demo_1 form-control','style' => 'width:100%;'));
               
            echo'<span class="help-block" style="color:red;">';
                     echo form_error($field_name); 
            echo'</span>
            </div>
        </div>';
}

                                      

function input_checkboxichecks($field_name, $label,$value,$class)
{
        
        echo'<div class="form-group">';
            echo'<label class="col-lg-2 control-label">'.$label.'</label>';
                echo'<div class="col-lg-10" >';   
                        $data = array(
                                'name'          => $field_name,
                                'id'            => $field_name,
                                'value'         => $value,
                                'checked'       => TRUE,
                                'class'         => $class
                        );

                        echo form_checkbox($data);
                        echo'<span class="help-block" style="color:red;">';
                            echo form_error($field_name);
                        echo'</span>';
                    echo'</div>';
        echo'</div>';


   
}










?>
