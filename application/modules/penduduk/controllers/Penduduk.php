<?php defined('BASEPATH') or exit('No direct script access allowed');
class Penduduk extends MY_Controller{
	public function __construct()
  	{
  		parent::__construct();
        $this->load->model('Penduduk_m');//model
        $this->susbtitle = 'Data Penduduk';//subtitle
        $dataactiveclass = $this->susbtitle;
        $idAndPerpage = $this->Penduduk_m->perpageAndId($dataactiveclass);
        $this->id = $idAndPerpage['id'];
        $this->sumof_perpage = $idAndPerpage['perpage'];
        $this->linkwithoutspace = $idAndPerpage['link'];
        $this->actived_Class($dataactiveclass);
        $this->gallery_path = realpath(APPPATH . '../uploads/documents');
        $this->load->helper('file');
        $this->load->library('excel');
        
  	}
  	public function actived_Class($dataactiveclass){
        $activeclass = $this->Penduduk_m->get_activedclass($dataactiveclass);
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
    public function changeperpage(){
        $id = $this->id;
        $perpageValue = $this->input->post('perpage');
        $this->Penduduk_m->changePerpageValue($perpageValue,$id);
    }
    public function index()
    {
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $data['perpage'] = $this->sumof_perpage;
        $datarunlink = $this->Penduduk_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Penduduk_m->content_runlink($showrun);
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
        
        $datarunlink = $this->Penduduk_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Penduduk_m->content_runlink($showrun);
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
        $data = $this->Penduduk_m->select();
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
                    $rw                 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $rt                 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $dusun              = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $alamat             = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    
                    
                    $no_kk              = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $nik                = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $nm_lengkap         = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $jns_kelamin        = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $sts_hub            = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $tmp_lahir          = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $tgl_lahir          = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $sts_perkawinan     = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $agama              = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $gol_darah          = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $kewarganegaraan    = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $etnis              = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    $pendidikan         = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                    $pekerjaan          = $worksheet->getCellByColumnAndRow(17, $row)->getValue();


                    
                    // $dateValue      = PHPExcel_Shared_Date::ExcelToPHP($tgl_lahir);
                    // $dob            =  date('Y-m-d',$dateValue);    
                  
                    


                    if(($no_kk !='')and($nik!='')){
                        $checkinput = $this->Penduduk_m->cek_input($no_kk);
                        if(count($checkinput)==0){
                            $nokk_check = $this->Penduduk_m->check_nokk($no_kk);
                            if($no_kk==$nokk_check['no_kk']){
                                $idkk = $nokk_check['id'];
                            }
                            else{
                                $data = array(
                                    'id'                => 'KK-'.get_uuid(),
                                    'no_kk'             => $no_kk,   
                                    'alamat'            => $alamat,                     
                                    'dusun'             => $dusun,
                                    'rt'                => $rt,
                                    'rw'                => $rw,
                                    'date_created'      => date("Y-m-d H:i:s", time()),
                                    'created_by'        => $this->session->userdata('id'),
                                    'created_byname'    => $this->session->userdata('nm_lengkap')
                                );
                                $this->Penduduk_m->insertkk($data);
                                $idkk = $data['id'];
                            }
                        }
                        
                        $data_detail  = array(
                            'id'                => 'nik-'.get_uuid(),
                            'idkk'              => $idkk,
                            'nik'               => $nik,
                            'nm_lengkap'        => $nm_lengkap,
                            'tmp_lahir'         => $tmp_lahir,
                            'tgl_lahir'         => $tgl_lahir,
                            'jns_kelamin'       => $jns_kelamin,
                            'sts_hub'           => $sts_hub,
                            'sts_perkawinan'    => $sts_perkawinan,
                            'agama'             => $agama,
                            'gol_darah'         => $gol_darah,
                            'kewarganegaraan'   => $kewarganegaraan,
                            'etnis'             => $etnis,
                            'pendidikan'        => $pendidikan,
                            'pekerjaan'         => $pekerjaan,                            
                            'date_created'      => date("Y-m-d H:i:s", time()),
                            'created_by'        => $this->session->userdata('id'),
                            'created_byname'    => $this->session->userdata('nm_lengkap')

                        );
                        $this->Penduduk_m->insertpenduduk($data_detail);
                    }
                }
            }

            echo 'Data Imported Successfully';
        }
        else{
            echo "oke error";
        }
    }

    public function pagination(){
        $nama_alamat    = trim($this->input->post('nama_alamat'));
        $nik_or_kk      = trim($this->input->post('nik_or_kk'));
        $rt             = trim($this->input->post('rt'));
        $rw             = trim($this->input->post('rw'));
        $jns_kelamin    = trim($this->input->post('jns_kelamin'));
        $set_umur       = trim($this->input->post('set_umur'));
        $umur           = trim($this->input->post('umur'));
        $smpumur        = trim($this->input->post('smpumur'));
        $sampaiTanggal = $this->input->post('sampaiTanggal');

      
        if(!empty($sampaiTanggal)){
            $tahun = substr($sampaiTanggal, 6,9);
            $bulan = substr($sampaiTanggal, 3,2);
            $tanggal = substr($sampaiTanggal, 0,2);
            $sampaiTanggal  = $tahun."-".$bulan."-".$tanggal;
        }

        $config = array();
        $config['base_url']    = "#";
        $config['total_rows']  = $this->Penduduk_m->count_all($nama_alamat,$nik_or_kk,$rt,$rw,$jns_kelamin,$set_umur,$umur,$smpumur,$sampaiTanggal);
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
            'content_table'    => $this->Penduduk_m->fetch_details($config["per_page"],$start,$nama_alamat,$nik_or_kk,$rt,$rw,$jns_kelamin,$set_umur,$umur,$smpumur,$sampaiTanggal),
            'showCountData'    => $showCountData,
            'perpage'          => $this->sumof_perpage
        );
        echo json_encode($output);
    }
    public function export_excel(){
    
        $nama_alamat    = trim($this->input->post('nama_alamat'));
        $nik_or_kk      = trim($this->input->post('nik_or_kk'));
        $rt             = trim($this->input->post('rt'));
        $rw             = trim($this->input->post('rw'));
        $jns_kelamin    = trim($this->input->post('jns_kelamin'));
        $set_umur       = trim($this->input->post('set_umur'));
        $umur           = trim($this->input->post('umur'));
        $smpumur        = trim($this->input->post('smpumur'));
        $sampaiTanggal = $this->input->post('sampaiTanggal');

        
        
        $object = new PHPExcel();

        

        $object->setActiveSheetIndex(0)
        ->setCellValue('A1', 'No.')
        ->setCellValue('B1', 'No. KK')
        ->setCellValue('C1', 'NIK')
        ->setCellValue('D1', 'Nama Lengkap')
        ->setCellValue('E1', 'Tempat Lahir')
        ->setCellValue('F1', 'Tanggal Lahir')
        ->setCellValue('G1', 'Jenis Kelamin')
        ->setCellValue('H1', 'Status Perkawinan')
        ->setCellValue('I1', 'Alamat')
        ->setCellValue('J1', 'RT')
        ->setCellValue('K1', 'RW')
        ->setCellValue('L1', 'Pendidikan')
        ->setCellValue('M1', 'Pekerjaan');
        $object->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true);
        $object->getActiveSheet()->getColumnDimension('A')->setWidth(6);
        $object->getActiveSheet()->getColumnDimension('B')->setWidth(17);
        $object->getActiveSheet()->getColumnDimension('C')->setWidth(17);
        $object->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $object->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $object->getActiveSheet()->getColumnDimension('F')->setWidth(12);
        $object->getActiveSheet()->getColumnDimension('G')->setWidth(13);
        $object->getActiveSheet()->getColumnDimension('H')->setWidth(17);
        $object->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $object->getActiveSheet()->getColumnDimension('J')->setWidth(5);
        $object->getActiveSheet()->getColumnDimension('K')->setWidth(5);
        $object->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $object->getActiveSheet()->getColumnDimension('M')->setWidth(20);

        $object->getActiveSheet()->getStyle('A1:M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $object->getActiveSheet()->setShowGridlines(true);

        $object->getActiveSheet()->getStyle('A1:M1')->applyFromArray(
        array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFFF00')
            )
        )); 

        $results = $this->Penduduk_m->show_data($nama_alamat,$nik_or_kk,$rt,$rw,$jns_kelamin,$set_umur,$umur,$smpumur,$sampaiTanggal);
        $excel_row =2;
        $no = 1;
        foreach ($results as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0,$excel_row,''.$no++);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1,$excel_row,$row->no_kk);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2,$excel_row,$row->nik);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3,$excel_row,$row->nm_lengkap);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4,$excel_row,$row->tmp_lahir);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row,$row->createdAt);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row,$row->jns_kelamin);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row,$row->sts_perkawinan);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,$row->alamat);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,$row->rt);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row,$row->rw);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row,$row->pendidikan);
            $object->getActiveSheet()->setCellValueByColumnAndRow(12,$excel_row,$row->pekerjaan);
            $excel_row++;
            // $no++;
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
    



}
?>