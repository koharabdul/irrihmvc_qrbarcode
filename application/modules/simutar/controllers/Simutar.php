<?php defined('BASEPATH') or exit('No direct script access allowed');
class Simutar extends MY_Controller{
	public function __construct()
  	{
  		parent::__construct();
        $this->load->model('Simutar_m');//model
        $this->susbtitle = 'Simutar';//subtitle
        $dataactiveclass = $this->susbtitle;
        $idAndPerpage = $this->Simutar_m->perpageAndId($dataactiveclass);
        $this->id = $idAndPerpage['id'];
        $this->sumof_perpage = $idAndPerpage['perpage'];
        $this->linkwithoutspace = $idAndPerpage['link'];
        $this->actived_Class($dataactiveclass);
        $this->gallery_path = realpath(APPPATH . '../uploads/documents');
        $this->load->helper('file');
        $this->load->library('excel');
  	}
  	public function actived_Class($dataactiveclass){
        $activeclass = $this->Simutar_m->get_activedclass($dataactiveclass);
        // var_dump($activeclass);
        if(!empty($activeclass)){
            if($activeclass['tit_actclass']!=''){
                $arr_actclass = explode('/', $activeclass['tit_actclass']);
                foreach ($arr_actclass as $actclass) {
                    $this->session->set_tempdata($actclass,"active",0,1);//class active nanti diteruskan di navbar
                    // echo $actclass;//bisa ditampilkan kalau bukan anak dari 0
                }
            }
        }
        else{
            redirect('errors');//buat permission
        }
    }
    public function index()
    {
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $data['perpage'] = $this->sumof_perpage;
        $data['tps'] = $this->Simutar_m->get_tps();
        $datarunlink = $this->Simutar_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Simutar_m->content_runlink($showrun);
                $runlink = "<li>".ucwords($contrunlink['name'])."</li>";
                if(empty($data['runlink'])){
                    $data['runlink'] = $runlink;
                }
                else{
                    $data['runlink'] = $data['runlink'].$runlink;
                }
            }
        }
        else{
            $data['runlink'] = "";
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        
        $data['content_view'] = $this->linkwithoutspace.'/'.$this->linkwithoutspace.'_v';
        $this->template->hygienic_template($data);
    }
    public function pagination(){
        $namaalamat     = trim($this->input->post('nama_alamat'));
        $nikkk          = trim($this->input->post('NIK_OR_KK'));
        $rt             = trim($this->input->post('RT'));
        $rw             = trim($this->input->post('RW'));
        $jns_kelamin    = $this->input->post('jns_kelamin');
        $jns_variansi   = $this->input->post('jns_variansi');
        $config = array();
        $config['base_url']    = "#";
        $config['total_rows']  = $this->Simutar_m->count_all($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi);
        $config['per_page']    = $this->sumof_perpage;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='active' ><a href='#'>";
        $config['cur_tag_close'] = "</a></li>";
        $config['num_tag_open'] = "<li>";
        $config['num_tag_close'] = "</li>";
        $config['num_links'] = 1;
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        $start = ($page - 1) * $config["per_page"];

        
        $mylink = $this->linkwithoutspace;
        $lastpage = (($start)+($config['per_page']));
        if($lastpage>=($config['total_rows'])){
            $lastpage = $config['total_rows'];
        }
        else{
            $lastpage = (($start)+($config['per_page']));
        }
        
        if($config['total_rows']==''){
            $showCountData = '';
        }
        else{
            $showCountData = 'Showing '.($start+1).' to '.$lastpage.' of '.($config['total_rows']).' entries';
        }
        $output = array(
            'pagination_link'           => $this->pagination->create_links(),
            'dpt_table'                 => $this->Simutar_m->fetch_details($config["per_page"],$start,$namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$mylink,$jns_variansi),
            'content_double'            => $this->Simutar_m->fetch_double($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'showCountData'             => $showCountData,
            'perpage'                   => $this->sumof_perpage,
            'jum_laki'                  => $this->Simutar_m->jum_laki($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_perempuan'             => $this->Simutar_m->jum_perempuan($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_keluarga'              => $this->Simutar_m->jum_keluarga($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_double'                => $this->Simutar_m->jum_double($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_cocok'                 => $this->Simutar_m->jum_cocok($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_ubah_data'             => $this->Simutar_m->jum_ubah_data($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_baru'                  => $this->Simutar_m->jum_baru($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_tms'                   => $this->Simutar_m->jum_tms($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_belum_rekam_ektp'      => $this->Simutar_m->jum_belum_rekam_ektp($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),

            'jum_meninggal'             => $this->Simutar_m->jum_meninggal($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_ditemukan_ganda'       => $this->Simutar_m->jum_ditemukan_ganda($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_dibawah_umur'          => $this->Simutar_m->jum_dibawah_umur($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_pindah_domisili'       => $this->Simutar_m->jum_pindah_domisili($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_tidak_ditemukan'       => $this->Simutar_m->jum_tidak_ditemukan($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_tni'                   => $this->Simutar_m->jum_tni($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_polri'                 => $this->Simutar_m->jum_polri($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_hilang_ingatan'        => $this->Simutar_m->jum_hilang_ingatan($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_hak_pilihdicabut'      => $this->Simutar_m->jum_hak_pilihdicabut($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_bukan_penduduk'        => $this->Simutar_m->jum_bukan_penduduk($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_disabilitas_fisik'     => $this->Simutar_m->jum_disabilitas_fisik($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_disabilitas_intelektual'=> $this->Simutar_m->jum_disabilitas_intelektual($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_tuna_mental'           => $this->Simutar_m->jum_tuna_mental($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_disabilitas_sensorik'  => $this->Simutar_m->jum_disabilitas_sensorik($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_pindah_tps'            => $this->Simutar_m->jum_pindah_tps($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi)
        );
        echo json_encode($output);
    }
    public function changeperpage(){
        $id = $this->id;
        $perpageValue = $this->input->post('perpage');
        $this->Simutar_m->changePerpageValue($perpageValue,$id);
    }

    public function create(){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        
        $datarunlink = $this->Simutar_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Simutar_m->content_runlink($showrun);
                $runlink = "<li>".ucwords($contrunlink['name'])."</li>";
                if(empty($data['runlink'])){
                    $data['runlink'] = $runlink;
                }
                else{
                    $data['runlink'] = $data['runlink'].$runlink;
                }
            }
        }
        else{
            $data['runlink'] = "";
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        
        $data['content_view'] = $this->linkwithoutspace.'/create_v';
        $this->template->hygienic_template($data);
    }
    public function creates(){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        
        $datarunlink = $this->Simutar_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Simutar_m->content_runlink($showrun);
                $runlink = "<li>".ucwords($contrunlink['name'])."</li>";
                if(empty($data['runlink'])){
                    $data['runlink'] = $runlink;
                }
                else{
                    $data['runlink'] = $data['runlink'].$runlink;
                }
            }
        }
        else{
            $data['runlink'] = "";
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        
        $data['content_view'] = $this->linkwithoutspace.'/creates_v';
        $this->template->hygienic_template($data);
    }

    public function import(){
        $data = $this->Simutar_m->select();
        $output = '
        <span align="center"> Total Data - '.$data.'</span>';
        echo $output;

    }
    public function save(){
        if(isset($_FILES["file"]["name"])){
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);

            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for($row=2; $row<=$highestRow; $row++){
                    $no_kk          = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nik            = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $nm_lengkap     = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $tmp_lahir      = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $tgl_lahir      = $worksheet->getCellByColumnAndRow(5, $row)->getValue();


                    // $cellValue = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                    // $dateValue      = PHPExcel_Shared_Date::ExcelToPHP($tgl_lahir);                        
                    // $dob            =  date('Y-m-d',$dateValue);    
                  
                    $sts_perkawinan = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $jns_kelamin    = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $dusun          = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $rt             = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $rw             = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $disabilitas    = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $prekaman_ektp  = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    // $keterangan     = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $tps            = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $tps2           = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $verval         = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    $variansi       = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                    $variansis      = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                    $dp_id          = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                    $sumeber_data   = $worksheet->getCellByColumnAndRow(19, $row)->getValue();


                    
                    if($dp_id!='DPID tidak ditemukan'){
                        $dp_ids = $dp_id;
                    }
                    else{
                        $dp_ids = "";   
                    }
                    
                    if($variansi=='TMS_DPS'){
                        if($variansis=='1. MENINGGAL'){
                            $varian = "1. Meninggal Dunia";
                            $ktrngn = "1";
                        }
                        else if($variansis=='2. GANDA'){
                            $varian = "2. Ditemukan Data Ganda";
                            $ktrngn = "2";
                        }
                        else if($variansis=='3. DIBAWAH UMUR'){
                            $varian = "3. Dibawah Umur";
                            $ktrngn = "3";
                        }
                        else if($variansis=='4. PINDAH DOMISILI'){
                            $varian = "4. Pindah Domisili";
                            $ktrngn = "4";
                        }
                        else if($variansis=='5. TIDAK DIKENAL'){
                            $varian = "5. Tidak Dikenal";
                            $ktrngn = "5";
                        }
                        else if($variansis=='6. TNI'){
                            $varian = "6. TNI";
                            $ktrngn = "6";
                        }
                        else if($variansis=='7. POLRI'){
                            $varian = "7. POLRI";
                            $ktrngn = "7";
                        }
                        else if($variansis=='8. HILANG INGATAN'){
                            $varian = "8. Hilang Ingatan";
                            $ktrngn = "8";
                        }
                        else if($variansis=='9. HAK PILIH DICABUT'){
                            $varian = "9. Hak Pilih Dicabut";
                            $ktrngn = "9";
                        }
                        else if($variansis=='10. BUKAN PENDUDUK SETEMPAT'){
                            $varian = "10. Bukan Penduduk";
                            $ktrngn = "10";
                        }
                        else{
                            $varian = "";
                            $ktrngn = "";
                        }
                    }
                    else if($variansi=='UBAH_DPS'){
                        $varian = "Pemilih Ubah Data";
                        $ktrngn = "U";
                    }
                    else if($variansi=='TAMBAH_DPS'){
                        $varian = "Pemilih Baru";
                        $ktrngn = "B";
                    }
                    else if($variansi=='PINDAH_TPS_DPS'){
                        $id_tps2 = $this->Simutar_m->checktps2($tps2);
                        $varian = "Pemilih Pindah TPS";
                        $ktrngn = "U/".$id_tps2['notps'];
                    }
                    else{
                        $varian = "";
                        $ktrngn = "";
                    }

                    

                    if($verval=='Lengkap'){
                        $vervals = "MS";
                    }
                    else if($verval=='TMS'){
                        $vervals = "TMS";
                    }
                    else{
                        $vervals = "";   
                    }

                    if($tps==''){
                        $id_tps = $this->Simutar_m->checktps2($tps2);
                        $id_tps2['id'] = "";
                    }
                    else{
                        $id_tps = $this->Simutar_m->checktps($tps);
                        if($tps==$tps2){
                            $id_tps2['id'] = "";
                        }
                        else{
                            
                            $id_tps2 = $this->Simutar_m->checktps2($tps2);
                        }
                    }
                    


               
                    


                    if(($no_kk !='')and($nik!='')){
                        $data[] = array(
                            'id'                => 'DPT-'.get_uuid(),
                            'no_kk'             => $no_kk,
                            'nik'               => $nik,
                            'nm_lengkap'        => trim(strtoupper($nm_lengkap)),
                            'tmp_lahir'         => trim(strtoupper($tmp_lahir)),
                            'tgl_lahir'         => $tgl_lahir,
                            'sts_perkawinan'    => trim(strtoupper($sts_perkawinan)),
                            'jns_kelamin'       => trim(strtoupper($jns_kelamin)),
                            'dusun'             => trim(strtoupper($dusun)),
                            'rt'                => $rt,
                            'rw'                => $rw,
                            'disabilitas'       => $disabilitas,
                            'prekaman_ektp'     => $prekaman_ektp,
                            'id_tps'            => $id_tps['id'],
                            'pindah_tps'        => $id_tps2['id'],
                            'verval'            => $vervals,
                            'keterangan'        => $ktrngn,
                            'variansi_data'     => $varian,
                            'dp_id'             => $dp_ids,
                            'sumber_data'       => $sumeber_data,
                            'date_created'      => date("Y-m-d H:i:s", time()),
                            'created_by'        => $this->session->userdata('id'),
                            'created_byname'    => $this->session->userdata('nm_lengkap')
                        );
                    }
                }
            }
            $this->Simutar_m->insert($data);
            echo 'Data Imported Successfully';
        }
        else{
            echo "oke error";
        }
    }
    public function save_new(){
        if(isset($_FILES["file"]["name"])){
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);

            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for($row=2; $row<=$highestRow; $row++){
                    $no_kk          = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nik            = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $nm_lengkap     = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $tmp_lahir      = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $tgl_lahir      = $worksheet->getCellByColumnAndRow(5, $row)->getValue();


                    // $cellValue = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                    // $dateValue      = PHPExcel_Shared_Date::ExcelToPHP($tgl_lahir);                        
                    // $dob            =  date('Y-m-d',$dateValue);    
                  
                    $sts_perkawinan = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $jns_kelamin    = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $dusun          = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $rt             = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $rw             = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $disabilitas    = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $prekaman_ektp  = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    // $keterangan     = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $tps            = $worksheet->getCellByColumnAndRow(14, $row)->getValue();

                    $id_tps = $this->Simutar_m->checktps($tps);
                    


                    if(($no_kk !='')and($nik!='')){
                        $data[] = array(
                            'id'                => 'DPTb-'.get_uuid(),
                            'no_kk'             => $no_kk,
                            'nik'               => $nik,
                            'nm_lengkap'        => $nm_lengkap,
                            'tmp_lahir'         => $tmp_lahir,
                            'tgl_lahir'         => $tgl_lahir,
                            'sts_perkawinan'    => $sts_perkawinan,
                            'jns_kelamin'       => $jns_kelamin,
                            'dusun'             => $dusun,
                            'rt'                => $rt,
                            'rw'                => $rw,
                            'disabilitas'       => $disabilitas,
                            'prekaman_ektp'     => $prekaman_ektp,
                            'keterangan'        => 'B',
                            'id_tps'            => $id_tps['id'],
                            'variansi_data'     => 'Pemilih Baru',
                            'verval'            => 'MS',
                            'date_created'      => date("Y-m-d H:i:s", time()),
                            'created_by'        => $this->session->userdata('id'),
                            'created_byname'    => $this->session->userdata('nm_lengkap')
                        );
                    }
                }
            }
            $this->Simutar_m->insert($data);
            echo 'Data Imported Successfully';
        }
        else{
            echo "oke error";
        }
    }
    public function data_cocok(){
        $selected = $this->input->post('table_records');
        if($selected!=''){
            $arr_kalimat = explode(',', $selected);
            foreach ($arr_kalimat as $id) {
                if($id!=''){
                    $this->Simutar_m->cocok($id);
                }
            }
        }
    }
    public function data_tms(){
        $selected = $this->input->post('table_records');
        $category = $this->input->post('category');
        if($category=='Meninggal Dunia'){
            $categories = '1';
        }
        else if($category=='Ditemukan Data Ganda'){
            $categories = '2';
        }
        else if($category=='Dibawah Umur'){
            $categories = '3';
        }
        else if($category=='Pindah Domisili'){
            $categories = '4';
        }
        else if($category=='Tidak Ditemukan'){
            $categories = '5';
        }
        else if($category=='TNI'){
            $categories = '6';
        }
        else if($category=='POLRI'){
            $categories = '7';
        }
        else if($category=='Hilang Ingatan'){
            $categories = '8';
        }
        else if($category=='Hak Pilih Dicabut'){
            $categories = '9';
        }
        else if($category=='Bukan Penduduk'){
            $categories = '10';
        }
        else{
            $categories = "";
        }

        if($selected!=''){
            $arr_kalimat = explode(',', $selected);
            foreach ($arr_kalimat as $id) {
                if($id!=''){
                    $this->Simutar_m->tms($id,$category,$categories);
                }
            }
        }
    }
    public function data_pindah_tps(){
        $selected = $this->input->post('table_records');
        $tps = $this->input->post('tps');
        if($selected!=''){
            $arr_kalimat = explode(',', $selected);
            foreach ($arr_kalimat as $id) {
                if($id!=''){
                    $no_tps = $this->Simutar_m->chekinno_tps($id);
                    $tps_awal = $no_tps['tps'];
                    $no_tps2 = $this->Simutar_m->chekcoutno_tps($tps);
                    $tps_akhir = $no_tps2['tps'];
                    if($tps_awal!=$tps_akhir){
                        $ket = $no_tps['ket_details']." [".date("Y-m-d H:i:s", time())."] : TPS ".$tps_awal." -> TPS ".$tps_akhir.";";
                        $this->Simutar_m->pindahtps($id,$tps,$ket,$tps_akhir);
                    }
                }
            }
        }
    }
    public function rekap(){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        
        $datarunlink = $this->Simutar_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Simutar_m->content_runlink($showrun);
                $runlink = "<li>".ucwords($contrunlink['name'])."</li>";
                if(empty($data['runlink'])){
                    $data['runlink'] = $runlink;
                }
                else{
                    $data['runlink'] = $data['runlink'].$runlink;
                }
            }
        }
        else{
            $data['runlink'] = "";
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        

        $data['result'] = $this->Simutar_m->get_rekap();
        
        
        $data['content_view'] = $this->linkwithoutspace.'/rekap_v';
        $this->template->hygienic_template($data);
    }

    public function edit($id){
        if($this->Simutar_m->checkedit($id)==1){
            $data['subtitle'] = $this->susbtitle;
            $data['mylink'] = $this->linkwithoutspace;
            
            $datarunlink = $this->Simutar_m->get_activedclass($this->susbtitle);
            if($datarunlink['tit_actclass']!=''){
                $arr_runlink = explode('/', $datarunlink['tit_actclass']);
                foreach ($arr_runlink as $showrun) {
                    $contrunlink = $this->Simutar_m->content_runlink($showrun);
                    $runlink = "<li>".ucwords($contrunlink['name'])."</li>";
                    if(empty($data['runlink'])){
                        $data['runlink'] = $runlink;
                    }
                    else{
                        $data['runlink'] = $data['runlink'].$runlink;
                    }
                }
            }
            else{
                $data['runlink'] = "";
            }
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            

            $data['results'] = $this->Simutar_m->get_viewubahdata($id)->row_array();
            

            $data['content_view'] = $this->linkwithoutspace.'/edit_v';
            $this->template->hygienic_template($data);
        }
        else{
            redirect('errors');//buat permission
        }
    }
    public function saveupdate(){
        $id = $this->input->post('id');
        $tgl = $this->input->post('tgl_lahir');
        $tgls = substr($tgl, 6,4).'-'.substr($tgl,3,2).'-'.substr($tgl,0,2);
        $data = array(
            'no_kk'             => $this->input->post('no_kk'),
            'nik'               => $this->input->post('nik'),
            'nm_lengkap'        => strtoupper($this->input->post('nm_lengkap')),
            'tmp_lahir'         => strtoupper($this->input->post('tmp_lahir')),
            'tgl_lahir'         => $tgls,
            'sts_perkawinan'    => $this->input->post('sts_perkawinan'),
            'jns_kelamin'       => $this->input->post('jns_kelamin'),
            'dusun'             => strtoupper($this->input->post('dusun')),
            'rt'                => $this->input->post('rt'),
            'rw'                => $this->input->post('rw'),
            'disabilitas'       => $this->input->post('disabilitas'),
            'prekaman_ektp'     => $this->input->post('prekaman_ektp'),
            'keterangan'        => 'U',
            'ket_details'       => $this->input->post('ket_details'),
            'verval'            => 'MS',
            'variansi_data'     => 'Pemilih Ubah Data',
            'date_modified'     => date("Y-m-d H:i:s", time()),
            'modified_by'       => $this->session->userdata('id'),
            'modified_byname'   => $this->session->userdata('nm_lengkap')
        );
        $this->Simutar_m->updateubahdata($id,$data);

    }

    public function soft_delete(){
        $selected = $this->input->post('table_records');
        if($selected!=''){
            $arr_kalimat = explode(',', $selected);
            foreach ($arr_kalimat as $id) {
                if($id!=''){
                    $checked = $this->Simutar_m->checked($id);
                    if($checked>0){
                        $this->Simutar_m->deleted($id);
                    }
                }
            }
        }
    }

    public function export_excel(){
    
        $namaalamat     = trim($this->input->post('nama_alamat'));
        $nikkk          = trim($this->input->post('NIK_OR_KK'));
        $rt             = trim($this->input->post('RT'));
        $rw             = trim($this->input->post('RW'));
        $jns_kelamin    = $this->input->post('jns_kelamin');
        $jns_variansi   = $this->input->post('jns_variansi');

        
        $object = new PHPExcel();

        

        $object->setActiveSheetIndex(0)
        ->setCellValue('A1', 'No.')
        ->setCellValue('B1', 'No. KK')
        ->setCellValue('C1', 'NIK')
        ->setCellValue('D1', 'Nama Lengkap')
        ->setCellValue('E1', 'Tempat Lahir')
        ->setCellValue('F1', 'Tanggal Lahir')
        ->setCellValue('G1', 'Status Perkawinan')
        ->setCellValue('H1', 'Jenis Kelamin')
        ->setCellValue('I1', 'Alamat')
        ->setCellValue('J1', 'RT')
        ->setCellValue('K1', 'RW')
        ->setCellValue('L1', 'disabilitas')
        ->setCellValue('M1', 'Prekaman KTP-El')
        ->setCellValue('N1', 'Sumber Data')
        ->setCellValue('O1', 'TPS');
        $object->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);
        $object->getActiveSheet()->getColumnDimension('A')->setWidth(6);
        $object->getActiveSheet()->getColumnDimension('B')->setWidth(17);
        $object->getActiveSheet()->getColumnDimension('C')->setWidth(17);
        $object->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $object->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $object->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $object->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $object->getActiveSheet()->getColumnDimension('J')->setWidth(5);
        $object->getActiveSheet()->getColumnDimension('K')->setWidth(5);
        $object->getActiveSheet()->getColumnDimension('L')->setWidth(9);
        $object->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('O')->setWidth(6);

        $object->getActiveSheet()->getStyle('A1:O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $object->getActiveSheet()->setShowGridlines(true);

        $object->getActiveSheet()->getStyle('A1:O1')->applyFromArray(
        array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFFF00')
            )
        )); 

        $results = $this->Simutar_m->show_data($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi);
        $excel_row =2;
        $no = 1;
        $sumberdata = "-";
        foreach ($results as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0,$excel_row,$no);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1,$excel_row,$row->no_kk);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2,$excel_row,$row->nik);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3,$excel_row,$row->nm_lengkap);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4,$excel_row,$row->tmp_lahir);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row,$row->tgl_lahir);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row,$row->sts_perkawinan);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row,$row->jns_kelamin);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,$row->dusun);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,$row->rt);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row,$row->rw);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row,$row->disabilitas);
            $object->getActiveSheet()->setCellValueByColumnAndRow(12,$excel_row,$row->prekaman_ektp);
            $object->getActiveSheet()->setCellValueByColumnAndRow(13,$excel_row,$sumberdata);
            $object->getActiveSheet()->setCellValueByColumnAndRow(14,$excel_row,$row->no_tps);
            $excel_row++;
            $no++;
        }
        
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="01simple.xlsx"');
        // header('Cache-Control: max-age=0');
        // $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        // $objWriter->save('php://output');
        // // set_time_limit(30);
        // exit;
        $objWriter = new PHPExcel_Writer_Excel5($object);
        ob_start();
        $objWriter->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();

        $response =  array(
                'op' => 'ok',
                'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
            );
        
        die(json_encode($response));
        // echo json_encode($response);


    }
    public function export_excel_mutakhir(){
    
        $namaalamat     = trim($this->input->post('nama_alamat'));
        $nikkk          = trim($this->input->post('NIK_OR_KK'));
        $rt             = trim($this->input->post('RT'));
        $rw             = trim($this->input->post('RW'));
        $jns_kelamin    = $this->input->post('jns_kelamin');
        $jns_variansi   = $this->input->post('jns_variansi');

        
        $object = new PHPExcel();

        

        $object->setActiveSheetIndex(0)
        ->setCellValue('A1', 'No.')
        ->setCellValue('B1', 'No. KK')
        ->setCellValue('C1', 'NIK')
        ->setCellValue('D1', 'Nama Lengkap')
        ->setCellValue('E1', 'Tempat Lahir')
        ->setCellValue('F1', 'Tanggal Lahir')
        ->setCellValue('G1', 'Status Perkawinan')
        ->setCellValue('H1', 'Jenis Kelamin')
        ->setCellValue('I1', 'Alamat')
        ->setCellValue('J1', 'RT')
        ->setCellValue('K1', 'RW')
        ->setCellValue('L1', 'disabilitas')
        ->setCellValue('M1', 'Prekaman KTP-El')
        ->setCellValue('N1', 'Sumber Data')
        ->setCellValue('O1', 'TPS');
        $object->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);
        $object->getActiveSheet()->getColumnDimension('A')->setWidth(6);
        $object->getActiveSheet()->getColumnDimension('B')->setWidth(17);
        $object->getActiveSheet()->getColumnDimension('C')->setWidth(17);
        $object->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $object->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $object->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $object->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $object->getActiveSheet()->getColumnDimension('J')->setWidth(5);
        $object->getActiveSheet()->getColumnDimension('K')->setWidth(5);
        $object->getActiveSheet()->getColumnDimension('L')->setWidth(9);
        $object->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('O')->setWidth(6);

        $object->getActiveSheet()->getStyle('A1:O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $object->getActiveSheet()->setShowGridlines(true);

        $object->getActiveSheet()->getStyle('A1:O1')->applyFromArray(
        array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFFF00')
            )
        )); 

        $results = $this->Simutar_m->show_data_mutakhir($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi);
        $excel_row =2;
        $no = 1;
        $sumberdata = "-";
        foreach ($results as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0,$excel_row,$no);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1,$excel_row,$row->no_kk);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2,$excel_row,$row->nik);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3,$excel_row,$row->nm_lengkap);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4,$excel_row,$row->tmp_lahir);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row,$row->tgl_lahir);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row,$row->sts_perkawinan);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row,$row->jns_kelamin);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,$row->dusun);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,$row->rt);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row,$row->rw);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row,$row->disabilitas);
            $object->getActiveSheet()->setCellValueByColumnAndRow(12,$excel_row,$row->prekaman_ektp);
            $object->getActiveSheet()->setCellValueByColumnAndRow(13,$excel_row,$sumberdata);
            $object->getActiveSheet()->setCellValueByColumnAndRow(14,$excel_row,$row->no_tps);
            $excel_row++;
            $no++;
        }
        
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="01simple.xlsx"');
        // header('Cache-Control: max-age=0');
        // $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        // $objWriter->save('php://output');
        // // set_time_limit(30);
        // exit;
        $objWriter = new PHPExcel_Writer_Excel5($object);
        ob_start();
        $objWriter->save("php://output");
        $xlsData = ob_get_contents();
        ob_end_clean();

        $response =  array(
                'op' => 'ok',
                'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
            );
        
        die(json_encode($response));
        // echo json_encode($response);


    }

    public function mutakhir(){
        // $data['subtitle'] = $this->susbtitle;
        // $data['mylink'] = $this->linkwithoutspace;
        
        // $datarunlink = $this->Simutar_m->get_activedclass($this->susbtitle);
        // if($datarunlink['tit_actclass']!=''){
        //     $arr_runlink = explode('/', $datarunlink['tit_actclass']);
        //     foreach ($arr_runlink as $showrun) {
        //         $contrunlink = $this->Simutar_m->content_runlink($showrun);
        //         $runlink = "<li>".ucwords($contrunlink['name'])."</li>";
        //         if(empty($data['runlink'])){
        //             $data['runlink'] = $runlink;
        //         }
        //         else{
        //             $data['runlink'] = $data['runlink'].$runlink;
        //         }
        //     }
        // }
        // else{
        //     $data['runlink'] = "";
        // }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
        $this->db->truncate('dptmutakhir');
        $results = $this->Simutar_m->show_mutakhir();
        foreach ($results as $k) {
            if($k->verval!='TMS'){
                if($k->keterangan=='<i class="fa fa-check text-navy"></i>'){
                    $kets = "Cocok";
                }
                else{
                    $kets = $k->keterangan;
                }
                if($k->verval=='' and $k->variansi_data==''){
                    $verval = 'MS';
                    $variansi_data = 'Pemilih Cocok';
                }
                else{
                    $verval = $k->verval;
                    $variansi_data = $k->variansi_data;
                }
                if(substr($k->keterangan,0,2)=='U/'){
                    $pindahtps = $k->pindah_tps;
                }
                else{
                    $pindahtps = $k->id_tps;
                }
                $data[] = array(
                    'id'                => $k->id,
                    'no_kk'             => $k->no_kk,
                    'nik'               => $k->nik,
                    'nm_lengkap'        => $k->nm_lengkap,
                    'tmp_lahir'         => $k->tmp_lahir,
                    'tgl_lahir'         => $k->tgl_lahir,
                    'sts_perkawinan'    => $k->sts_perkawinan,
                    'jns_kelamin'       => $k->jns_kelamin,
                    'dusun'             => $k->dusun,
                    'rt'                => $k->rt,
                    'rw'                => $k->rw,
                    'disabilitas'       => $k->disabilitas,
                    'prekaman_ektp'     => $k->prekaman_ektp,
                    'keterangan'        => $kets,
                    'ket_details'       => $k->ket_details,
                    'id_tps'            => $pindahtps,
                    'variansi_data'     => $variansi_data,
                    'verval'            => $verval,
                    'date_created'      => date("Y-m-d H:i:s", time()),
                    'created_by'        => $this->session->userdata('id'),
                    'created_byname'    => $this->session->userdata('nm_lengkap')
                );
            }
        }
        $this->Simutar_m->insert_mutakhir($data);

        // $data['content_view'] = $this->linkwithoutspace.'/mutakhir_v';
        // $this->template->hygienic_template($data);
        redirect($this->linkwithoutspace.'/mutakhir_data');
    }
    public function mutakhir_data(){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $data['perpage'] = $this->sumof_perpage;
        $data['tps'] = $this->Simutar_m->get_tps();
        $datarunlink = $this->Simutar_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Simutar_m->content_runlink($showrun);
                $runlink = "<li>".ucwords($contrunlink['name'])."</li>";
                if(empty($data['runlink'])){
                    $data['runlink'] = $runlink;
                }
                else{
                    $data['runlink'] = $data['runlink'].$runlink;
                }
            }
        }
        else{
            $data['runlink'] = "";
        }





        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
        $data['content_view'] = $this->linkwithoutspace.'/mutakhir_v';
        $this->template->hygienic_template($data);     
    }
    public function paginations(){
        $namaalamat     = trim($this->input->post('nama_alamat'));
        $nikkk          = trim($this->input->post('NIK_OR_KK'));
        $rt             = trim($this->input->post('RT'));
        $rw             = trim($this->input->post('RW'));
        $jns_kelamin    = $this->input->post('jns_kelamin');
        $jns_variansi   = $this->input->post('jns_variansi');
        $config = array();
        $config['base_url']    = "#";
        $config['total_rows']  = $this->Simutar_m->veri2_count_all($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi);
        $config['per_page']    = $this->sumof_perpage;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='active' ><a href='#'>";
        $config['cur_tag_close'] = "</a></li>";
        $config['num_tag_open'] = "<li>";
        $config['num_tag_close'] = "</li>";
        $config['num_links'] = 1;
        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        $start = ($page - 1) * $config["per_page"];

        
        $mylink = $this->linkwithoutspace;
        $lastpage = (($start)+($config['per_page']));
        if($lastpage>=($config['total_rows'])){
            $lastpage = $config['total_rows'];
        }
        else{
            $lastpage = (($start)+($config['per_page']));
        }
        
        if($config['total_rows']==''){
            $showCountData = '';
        }
        else{
            $showCountData = 'Showing '.($start+1).' to '.$lastpage.' of '.($config['total_rows']).' entries';
        }
        $output = array(
            'pagination_link'           => $this->pagination->create_links(),
            'dpt_table'                 => $this->Simutar_m->fetch_details2($config["per_page"],$start,$namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$mylink,$jns_variansi),
            'content_double'            => $this->Simutar_m->veri2_fetch_double($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'showCountData'             => $showCountData,
            'perpage'                   => $this->sumof_perpage,
            'jum_laki'                  => $this->Simutar_m->veri2_jum_laki($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_perempuan'             => $this->Simutar_m->veri2_jum_perempuan($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_keluarga'              => $this->Simutar_m->veri2_jum_keluarga($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_double'                => $this->Simutar_m->veri2_jum_double($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_cocok'                 => $this->Simutar_m->veri2_jum_cocok($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_ubah_data'             => $this->Simutar_m->veri2_jum_ubah_data($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_baru'                  => $this->Simutar_m->veri2_jum_baru($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_belum_rekam_ektp'      => $this->Simutar_m->veri2_jum_belum_rekam_ektp($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),

            'jum_disabilitas_fisik'     => $this->Simutar_m->veri2_jum_disabilitas_fisik($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_disabilitas_intelektual'=> $this->Simutar_m->veri2_jum_disabilitas_intelektual($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_tuna_mental'           => $this->Simutar_m->veri2_jum_tuna_mental($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi),
            'jum_disabilitas_sensorik'  => $this->Simutar_m->veri2_jum_disabilitas_sensorik($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi)
        );
        echo json_encode($output);
    }

    public function rekap_final(){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        
        $datarunlink = $this->Simutar_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Simutar_m->content_runlink($showrun);
                $runlink = "<li>".ucwords($contrunlink['name'])."</li>";
                if(empty($data['runlink'])){
                    $data['runlink'] = $runlink;
                }
                else{
                    $data['runlink'] = $data['runlink'].$runlink;
                }
            }
        }
        else{
            $data['runlink'] = "";
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $jum_kk = $this->Simutar_m->jumlah_kk();
        $data['jum_kk'] = $jum_kk['kk'];
        $data['jum_laki'] = $jum_kk['laki'];
        $data['jum_p'] = $jum_kk['perempuan'];
        $data['tot'] = $jum_kk['tot'];
        
        $jum_laki = $this->Simutar_m->jumlah_laki();
        $data['jumlahlaki'] = $jum_laki['laki'];
        $jum_perempuan = $this->Simutar_m->jumlah_perempuan();
        $data['jumlahperempuan'] = $jum_perempuan['perempuan'];
        $jum_tot = $this->Simutar_m->jumlah_jnstot();
        $data['kelamintot'] = $jum_tot['kelamintot'];
        $data['result'] = $this->Simutar_m->get_rekap_final();
        
        $data['content_view'] = $this->linkwithoutspace.'/final_v';
        $this->template->hygienic_template($data);
    }








}
?>