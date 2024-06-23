<?php defined('BASEPATH') or exit('No direct script access allowed');
class Dtks extends MY_Controller{
	public function __construct()
  	{
  		parent::__construct();
        $this->load->model('Dtks_m');//model
        $this->susbtitle = 'DTKS';//subtitle
        $dataactiveclass = $this->susbtitle;
        $idAndPerpage = $this->Dtks_m->perpageAndId($dataactiveclass);
        $this->id = $idAndPerpage['id'];
        $this->sumof_perpage = $idAndPerpage['perpage'];
        $this->linkwithoutspace = $idAndPerpage['link'];
        $this->actived_Class($dataactiveclass);
        $this->gallery_path = realpath(APPPATH . '../uploads/documents');
        $this->load->helper('file');
        $this->load->library('excel');
  	}
  	public function actived_Class($dataactiveclass){
        $activeclass = $this->Dtks_m->get_activedclass($dataactiveclass);
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
        $datarunlink = $this->Dtks_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Dtks_m->content_runlink($showrun);
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
    public function create(){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $datarunlink = $this->Dtks_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Dtks_m->content_runlink($showrun);
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

    public function import(){
        $data = $this->Dtks_m->select();
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
                    $id_art_bdt          = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $id_bdt            = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $ruta     = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $no_pbdt      = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $kd_prov      = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $kd_kab      = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $kd_kec      = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $kd_desa      = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $no_ppkh      = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $pkh      = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $no_pkks2016      = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $no_ppbi      = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $no_artpbi      = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $nm_lengkap      = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $jns_kel      = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    $tmp_lahir      = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                    $tgl_lahir      = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                    /////////////////////////////////////////////////////////////////////////
                    // $dateValue      = PHPExcel_Shared_Date::ExcelToPHP(trim($tgl_lahir));                        
                    // $dob            =  date('Y-m-d',$dateValue);    
                    ////////////////////////////////////////////////////////////////////////
                    $nik      = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                    $no_kk      = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                    $hub_krt      = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                    $nuk      = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                    $hub_kel      = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                    $sts_perkawinan      = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                    $akte_nikah      = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                    $di_kk      = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                    $ktp      = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                    $kks      = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                    $sts_hamil      = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                    $jns_cacat      = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                    $penyakit_kronis      = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
                    $partisipasi_sekolah      = $worksheet->getCellByColumnAndRow(31, $row)->getValue();
                    $pendidikan      = $worksheet->getCellByColumnAndRow(32, $row)->getValue();
                    $kelas_tertinggi      = $worksheet->getCellByColumnAndRow(33, $row)->getValue();
                    $ijazah      = $worksheet->getCellByColumnAndRow(34, $row)->getValue();
                    $sts_kerja      = $worksheet->getCellByColumnAndRow(35, $row)->getValue();
                    $jum_jamkerja      = $worksheet->getCellByColumnAndRow(36, $row)->getValue();
                    $lap_usaha      = $worksheet->getCellByColumnAndRow(37, $row)->getValue();
                    $sts_pekerjaan      = $worksheet->getCellByColumnAndRow(38, $row)->getValue();
                    $id_pengurus      = $worksheet->getCellByColumnAndRow(39, $row)->getValue();
                    $alamat_pengurus      = $worksheet->getCellByColumnAndRow(40, $row)->getValue();
                    $masuk_kuota      = $worksheet->getCellByColumnAndRow(41, $row)->getValue();
                    $bps_pengurus_lain      = $worksheet->getCellByColumnAndRow(42, $row)->getValue();
                   
                    


                    if(($id_art_bdt !='')and($id_bdt!='')){
                        $data[] = array(
                            'id'                     =>   'DPT-'.get_uuid(),
                            'id_art_bdt'             =>   trim($id_art_bdt),
                            'id_bdt'                 =>   trim($id_bdt),
                            'ruta'                   =>   trim($ruta),
                            'no_pbdt'                =>   trim($no_pbdt),
                            'kd_prov'                =>   trim($kd_prov),
                            'kd_kab'                 =>   trim($kd_kab),
                            'kd_kec'                 =>   trim($kd_kec),
                            'kd_desa'                =>   trim($kd_desa),
                            'no_ppkh'                =>   trim($no_ppkh),
                            'pkh'                    =>   trim($pkh),
                            'no_pkks2016'            =>   trim($no_pkks2016),
                            'no_ppbi'                =>   trim($no_ppbi),
                            'no_artpbi'              =>   trim($no_artpbi),
                            'nm_lengkap'             =>   trim($nm_lengkap),
                            'jns_kelamin'            =>   trim($jns_kel),
                            'tmp_lahir'              =>   trim($tmp_lahir),
                            'tgl_lahir'              =>   trim($tgl_lahir),
                            'nik'                    =>   trim($nik),
                            'no_kk'                  =>   trim($no_kk),
                            'hub_krt'                =>   trim($hub_krt),
                            'nuk'                    =>   trim($nuk),
                            'hub_kel'                =>   trim($hub_kel),
                            'sts_perkawinan'         =>   trim($sts_perkawinan),
                            'akte_nikah'             =>   trim($akte_nikah),
                            'di_kk'                  =>   trim($di_kk),
                            'ktp'                    =>   trim($ktp),
                            'kks'                    =>   trim($kks),
                            'sts_hamil'              =>   trim($sts_hamil),
                            'jns_cacat'              =>   trim($jns_cacat),
                            'penyakit_kronis'        =>   trim($penyakit_kronis),
                            'partisipasi_sekolah'    =>   trim($partisipasi_sekolah),
                            'pendidikan'             =>   trim($pendidikan),
                            'kelas_tertinggi'        =>   trim($kelas_tertinggi),
                            'ijazah'                 =>   trim($ijazah),
                            'sts_kerja'              =>   trim($sts_kerja),
                            'jum_jamkerja'           =>   trim($jum_jamkerja),
                            'lap_usaha'              =>   trim($lap_usaha),
                            'sts_pekerjaan'          =>   trim($sts_pekerjaan),
                            'id_pengurus'            =>   trim($id_pengurus),
                            'alamat_pengurus'        =>   trim($alamat_pengurus),
                            'masuk_kuota'            =>   trim($masuk_kuota),
                            'bsp_pengurus_lain'      =>   trim($bps_pengurus_lain),
                            'date_created'           =>   date("Y-m-d H:i:s", time()),
                            'created_by'             =>   $this->session->userdata('id'),
                            'created_byname'         =>   $this->session->userdata('nm_lengkap'),
                            'date_modified'          =>   date("Y-m-d H:i:s", time()),
                            'modified_by'            =>   $this->session->userdata('id'),
                            'modified_byname'        =>   $this->session->userdata('nm_lengkap'),
                            'deleted'                =>   '0'
                        );
                    }
                }
            }
            $this->Dtks_m->insert($data);
            echo 'Data Imported Successfully';
        }
        else{
            echo "oke error";
        }
    }
    public function pagination(){
        $namaalamat     = trim($this->input->post('nama_alamat'));
        $nikkk          = trim($this->input->post('nik_or_kk'));
        $id_desa        = trim($this->input->post('id_desa'));
        $id_kecamatan   = trim($this->input->post('id_kecamatan'));
        $id_pengurus    = $this->input->post('id_pengurus');
        $bantuan        = $this->input->post('bantuan');

        $config = array();
        $config['base_url']    = "#";
        $config['total_rows']  = $this->Dtks_m->count_all($namaalamat,$nikkk,$id_desa,$id_kecamatan,$id_pengurus,$bantuan);
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
            'pagination_link'  => $this->pagination->create_links(),
            'content_table'    => $this->Dtks_m->fetch_details($config["per_page"],$start,$namaalamat,$nikkk,$id_desa,$id_kecamatan,$id_pengurus,$bantuan),
            'showCountData'    => $showCountData,
            'perpage'          => $this->sumof_perpage
        );
        echo json_encode($output);
    }
    public function changeperpage(){
        $id = $this->id;
        $perpageValue = $this->input->post('perpage');
        $this->Dtks_m->changePerpageValue($perpageValue,$id);
    }


}
?>