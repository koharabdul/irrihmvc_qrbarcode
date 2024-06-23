<?php defined('BASEPATH') or exit('No direct script access allowed');
class Import_excel extends MY_Controller
{
  	public function __construct()
  	{
		parent::__construct();
		$this->load->model('Import_excel_m');
		$this->session->set_tempdata("datamaster","active",0,1);
    	$this->session->set_tempdata("import_excel","active",0,1);
    	$this->susbtitle = 'Import Excel';
    	$this->gallery_path = realpath(APPPATH . '../uploads/documents');
    	$this->load->helper('file');
        $this->load->library('excel');
    	
        
    }
    public function index(){
        $data['subtitle'] = $this->susbtitle;
        $data_subtitle = strtolower($data['subtitle']);
        $datanampil = explode(" ", $data_subtitle);
            foreach ($datanampil as $dt) {
                if(empty($datatampil)){
                    $datatampil = $dt;
                }
                else{
                    $datatampil = $datatampil."_".$dt;
                }  
            }
            $data['datatampil'] = $datatampil;

        $data['content_view'] = $datatampil.'/'.$datatampil.'_v';
        $this->template->hygienic_template($data);
    }
    public function create(){
    	$data['subtitle'] = $this->susbtitle;
        
        $data_subtitle = strtolower($data['subtitle']);
        $datanampil = explode(" ", $data_subtitle);
            foreach ($datanampil as $dt) {
                if(empty($datatampil)){
                    $datatampil = $dt;
                }
                else{
                    $datatampil = $datatampil."_".$dt;
                }  
            }
            $data['datatampil'] = $datatampil;

        $data['content_view'] = $datatampil.'/create_v';
        $this->template->hygienic_template($data);
    } 
    

    public function import(){
        $data = $this->Import_excel_m->select();
        $output = '
        <h3 align="center"> Total Data - '.$data.'</h3>';
        // <table class="table table-striped table-hover">
        //     <tr>
        //         <th>Nama</th>
        //         <th>Alamat</th>
        //         <th>Kontak</th>
        //     </tr>
        // ';
        // foreach ($data->result() as $row) {
        //     $output .= '
        //         <tr>
        //             <td>'.$row->nama.'</td>
        //             <td>'.$row->alamat.'</td>
        //             <td>'.$row->kontak.'</td>
        //         </tr>';
        // }
        // $output .= '</table>';
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
                    $no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $no_kk = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nik = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $nm_lengkap = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $tmp_lahir = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $tgl_lahir = $worksheet->getCellByColumnAndRow(5, $row)->getValue();


                    // $cellValue = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                    $dateValue = PHPExcel_Shared_Date::ExcelToPHP($tgl_lahir);                        
                    $dob =  date('Y-m-d',$dateValue);    
                  
                    $sts_perkawinan = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $jns_kelamin = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $dusun = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $rt = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $rw = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $disabilitas = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $keterangan = $worksheet->getCellByColumnAndRow(12, $row)->getValue();

                    if(($no_kk !='')and($nik!='')){
                        $data[] = array(
                            'no' => $no, 
                            'no_kk' => $no_kk,
                            'nik' => $nik,
                            'nm_lengkap' => $nm_lengkap,
                            'tmp_lahir' => $tmp_lahir,
                            'tgl_lahir' => $dob,
                            'sts_perkawinan' => $sts_perkawinan,
                            'jns_kelamin' => $jns_kelamin,
                            'dusun' => $dusun,
                            'rt' => $rt,
                            'rw' => $rw,
                            'disabilitas' => $disabilitas,
                            'keterangan' => $keterangan
                        );
                    }
                }
            }
            $this->Import_excel_m->insert($data);
            echo 'Data Imported Successfully';
        }
        else{
            echo "oke error";
        }
    }


    
}
?>