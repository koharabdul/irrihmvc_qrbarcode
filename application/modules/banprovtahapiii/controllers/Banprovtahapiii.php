<?php defined('BASEPATH') or exit('No direct script access allowed');
class Banprovtahapiii extends MY_Controller{
	public function __construct()
  	{
  		parent::__construct();
        $this->load->model('Banprovtahapiii_m');//model
        $this->susbtitle = 'Banprov September';//subtitle
        $dataactiveclass = $this->susbtitle;
        $idAndPerpage = $this->Banprovtahapiii_m->perpageAndId($dataactiveclass);
        $this->id = $idAndPerpage['id'];
        $this->sumof_perpage = $idAndPerpage['perpage'];
        $this->linkwithoutspace = $idAndPerpage['link'];
        $this->actived_Class($dataactiveclass);
        $this->gallery_path = realpath(APPPATH . '../uploads/documents');
        $this->load->helper('file');
        $this->load->library('excel');
  	}
  	public function actived_Class($dataactiveclass){
        $activeclass = $this->Banprovtahapiii_m->get_activedclass($dataactiveclass);
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
        $datarunlink = $this->Banprovtahapiii_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Banprovtahapiii_m->content_runlink($showrun);
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
        $nikkk          = trim($this->input->post('nik_or_kk'));
        $rt             = trim($this->input->post('rt'));
        $rw             = trim($this->input->post('rw'));
        $terealisasi    = $this->input->post('terealisasi');
        
        $config = array();
        $config['base_url']    = "#";
        $config['total_rows']  = $this->Banprovtahapiii_m->count_all($namaalamat,$nikkk,$rt,$rw,$terealisasi);
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
        if($config['total_rows']=='1'){
            $jumlahnomorurut = $this->Banprovtahapiii_m->jumlahnomorurut($namaalamat,$nikkk,$rt,$rw,$terealisasi);
        }
        else{
            $jumlahnomorurut['num'] = "";
            $jumlahnomorurut['nm_lengkap'] = "";
            $jumlahnomorurut['alamat'] = "";
            $jumlahnomorurut['nik'] = "";
            $jumlahnomorurut['id'] = "";
            $jumlahnomorurut['terdistribusi'] = "";
            $jumlahnomorurut['rts'] = "";
            $jumlahnomorurut['rws'] = "";
            $jumlahnomorurut['nm_desa'] = "";
        }

        
        $output = array(
            'pagination_link'  => $this->pagination->create_links(),
            'table_content'    => $this->Banprovtahapiii_m->fetch_details($config["per_page"],$start,$namaalamat,$nikkk,$rt,$rw,$terealisasi),
            'showCountData'    => $showCountData,
            'perpage'          => $this->sumof_perpage,
            'total_rows'       => $jumlahnomorurut['num'],
            'nama_penerima'    => $jumlahnomorurut['nm_lengkap'],
            'alamat'           => ucwords(strtolower($jumlahnomorurut['alamat'])),
            'nomornik'         => $jumlahnomorurut['nik'],
            'viewid'           => $jumlahnomorurut['id'],
            'distrib'          => $jumlahnomorurut['terdistribusi'],
            'jum_tersalurkan'  => $this->Banprovtahapiii_m->countofTersalurkan(),
            'jum_ditunda'      => $this->Banprovtahapiii_m->countofDitunda(),
            'jum_belum'        => $this->Banprovtahapiii_m->countofBelumTersalurkan(),
            'rt_s'             => $jumlahnomorurut['rts'],
            'rw_s'             => $jumlahnomorurut['rws'],
            'namadesa'         => ucwords(strtolower($jumlahnomorurut['nm_desa']))
        );
        echo json_encode($output);
    }
    public function changeperpage(){
        $id = $this->id;
        $perpageValue = $this->input->post('perpage');
        $this->Banprovtahapiii_m->changePerpageValue($perpageValue,$id);
    }

    public function create(){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        
        $datarunlink = $this->Banprovtahapiii_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Banprovtahapiii_m->content_runlink($showrun);
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
        $data = $this->Banprovtahapiii_m->select();
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
                    $no_urut        = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $no_kk          = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    // $nik            = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nm_lengkap     = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    // $nm_pasangan    = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    // $nm_anggotakel  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    // $nodanom        = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $alamat         = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $rt             = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $rw             = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $nm_desa        = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $nm_kec         = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    


                    if($no_kk !=''){
                        $data[] = array(
                            'id'                => 'BanProv-'.get_uuid(),
                            'no_urut'           => $no_urut,
                            'no_kk'             => $no_kk,
                            'nik'               => $no_kk,
                            'nm_lengkap'        => trim(strtoupper($nm_lengkap)),
                            'nm_pasangan'       => trim(strtoupper($nm_lengkap)),
                            'nm_anggotakel'     => trim(strtoupper($nm_lengkap)),
                            'nodanom'           => $no_urut,
                            'alamat'            => strtoupper($alamat),
                            'rt'                => $rt,
                            'rw'                => $rw,
                            'nm_desa'           => strtoupper($nm_desa),
                            'nm_kec'            => strtoupper($nm_kec),
                            'date_created'      => date("Y-m-d H:i:s", time()),
                            'created_by'        => $this->session->userdata('id'),
                            'created_byname'    => $this->session->userdata('nm_lengkap')
                        );
                    }
                }
            }
            $this->Banprovtahapiii_m->insert($data);
            echo 'Data Imported Successfully';
        }
        else{
            echo "oke error";
        }
    }
    public function update(){
        $viewid = $this->input->post('viewid');
        if($viewid!=''){
            $this->Banprovtahapiii_m->updateswam($viewid);
        }
    }
    public function accepted(){
        $id = $this->input->post('id');
        if($id!=''){
            $arr_kalimat = explode(',', $id);
            foreach ($arr_kalimat as $detail_id) {
                if($detail_id!=''){
                    $this->Banprovtahapiii_m->updateid($detail_id);
                }
            }
        }
    }
    public function denied(){
        $id = $this->input->post('id');
        $remark = $this->input->post('remark');
        if($id!='' and $remark!=''){
            $arr_kalimat = explode(',', $id);
            foreach ($arr_kalimat as $detail_id) {
                if($detail_id!=''){
                    $this->Banprovtahapiii_m->denied($detail_id,$remark);
                }
            }
        }
    }
    public function view($id){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $datarunlink = $this->Banprovtahapiii_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Banprovtahapiii_m->content_runlink($showrun);
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
        if($this->Banprovtahapiii_m->checkItManagementUsers($id)!=1){
            redirect($this->linkwithoutspace);
        }
        else{
            $data['results'] = $this->Banprovtahapiii_m->get_idview($id)->row_array();
            $data['content_view'] = $this->linkwithoutspace.'/view_v';
            $this->template->hygienic_template($data);
        }

        
    }

    public function prints(){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $datarunlink = $this->Banprovtahapiii_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Banprovtahapiii_m->content_runlink($showrun);
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
        $this->load->Library('Pdf_Library');
        $data['content_view'] = $this->linkwithoutspace.'/print_v';
        $this->template->hygienic_template($data);
    }
    public function printviews(){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $this->load->Library('Pdf_Library');
        $this->load->Library('ciqrcode');
        $params['data'] = base_url().'puskesos sauyunan';
        $params['level'] = 'M';
        $params['size'] = 2;
        $params['savename'] = FCPATH.'tes.png';
        $this->ciqrcode->generate($params);


        // echo '<img src="'.base_url().'tes.png" />';

        $data['pageresult'] = $this->Banprovtahapiii_m->printviews();
        $this->load->view($this->linkwithoutspace.'/report_v',$data);
    }
    


























    





}
?>