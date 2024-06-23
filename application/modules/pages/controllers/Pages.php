<?php defined('BASEPATH') or exit('No direct script access allowed');
class Pages extends MY_Controller
{
  	public function __construct()
  	{
		parent::__construct();
		$this->load->model('Pages_m');
    	$this->session->set_tempdata("pages","active",0,1);
    }
    public function index()
    {
    	$jumlah_data = $this->Pages_m->jumlah_data_pages();
        $config['base_url'] = base_url().'pages/index/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 10;
        $config['first_tag_open'] = '<li>';//paginataion awal
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';//paginataion akhir
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);    
        $data['results'] = $this->Pages_m->get_pages($config['per_page'],$from);
        $data['row'] = $this->Pages_m->jumlah_data_pages();
        // var_dump($data['results']);

        $data['subtitle'] = 'Pages';
        $data['content_view'] = 'pages/pages_v';
        $this->template->hygienic_template($data);
    }

    public function add()
    {
        $data['subtitle'] = 'Pages';//title

        $data['datagroups'] = $this->Pages_m->get_dropdowngroups();
        $data['content_view'] = 'pages/add_v';
        $this->template->hygienic_template($data);
       
    }
    public function sad(){
        // var_dump($_POST);
        // var_dump($_GET);
        // var_dump($_FILES);
        // die();
        
        $this->Pages_m->input_multiple();
    }
    public function gnr(){
        $data['subtitle'] = 'Pages';//title
        $this->load->Library('Pdf_Library');
        $this->load->Library('ciqrcode');
        $params['data'] = base_url().'pages/gnr';
        $params['level'] = 'M';
        $params['size'] = 2;
        $params['savename'] = base64_encode(FCPATH.'tes.png');
        $this->ciqrcode->generate($params);


        // $imagebase64 = file_get_contents($image_path); base 64
        // $base64 = base64_encode($imagebase64);
        // var_dump($base64); 

        // echo '<img src="'.base_url().'tes.png" />'; explorer

        $data['pageresult'] = $this->Pages_m->select_pages();
        $this->load->view('pages/report_v',$data);
    }
    public function gnr2(){
        $data['subtitle'] = 'Pages';//title
        $this->load->Library('Pdf_Library');
        $data['pageresult'] = $this->Pages_m->select_pages();
        $this->load->view('pages/report2_v',$data);
    }
    public function prt(){
        $data['subtitle'] = 'Pages';//title
        $this->load->Library('Pdf_Library');
        $data['content_view'] = 'pages/reportfile_v';
        $this->template->hygienic_template($data);
    }
    public function src() 
    {//cari data
        $data['subtitle'] = 'Pages';//title
        $datacari = (trim($this->input->post('cari')))? trim($this->input->post('cari')) : '';
        $datacari = ($this->uri->segment(3)) ? $this->uri->segment(3) : $datacari;
        if($datacari == ''){
            redirect('pages');
        }
        else{
            // $arr_kalimat = explode("%", $datacari);
            // var_dump($arr_kalimat);
            

            $arr_kalimat = explode("%", $datacari);
            foreach ($arr_kalimat as $v) {
                if(substr($v,0,2)=="20"){
                    if((substr($v,0,1)=="0")or
                       (substr($v,0,1)=="1")or 
                       (substr($v,0,1)=="2")or 
                       (substr($v,0,1)=="3")or 
                       (substr($v,0,1)=="4")or
                       (substr($v,0,1)=="5")or
                       (substr($v,0,1)=="6")or
                       (substr($v,0,1)=="7")or
                       (substr($v,0,1)=="8")or
                       (substr($v,0,1)=="9")
                      )
                    {
                        $t = "20".substr($v,2);
                        // var_dump($t);
                    }
                    else
                    {
                        $t = substr($v, 2);
                    }
                }
                else{
                    $t = $v;
                }
                if(empty($tampil)){
                    $tampil = $t;
                }
                else{
                    $tampil = $tampil." ".$t;
                }                   
            }

            //$data['tampilcari'] = $tampil; ieu dikomen karena aya keneh 20
            $datanampil = explode(" 20", $tampil);
            foreach ($datanampil as $dt) {
                if(empty($datatampil)){
                    $datatampil = $dt;
                }
                else{
                    $datatampil = $datatampil." ".$dt;
                }  
            }
            // var_dump($datatampil);
            $data['tampilcari'] = $datatampil;
            // // $data['eusi'] = count($arr_kalimat);
            // var_dump($tampil);
            // var_dump($arr_kalimat);
            
            
            
            $jumlah_data = $this->Pages_m->jumlah_data_cari();
            $config['base_url'] = base_url().'pages/src/'.$datacari;
            $config['total_rows'] = $jumlah_data;
            $config['per_page'] = 10;
            $config['first_tag_open'] = '<li>';//paginataion awal
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';//paginataion akhir
            $from = $this->uri->segment(4);
            $this->pagination->initialize($config);
            $data['results'] = $this->Pages_m->get_cari($config['per_page'],$from,$datacari);
            $data['row'] = $this->Pages_m->jumlah_data_cari();
            $data['content_view'] = 'pages/pages_v';
            $this->template->hygienic_template($data);
        }
    }
    public function dlm() 
    {
        $data['subtitle'] = 'Pages';//title
        $this->Pages_m->remove_checked();
        redirect('pages');
    }
    public function vew($pages_id){
        $data['subtitle'] = 'Pages';//title
        
        if($this->Pages_m->view_edit($pages_id)->row_array()){
            $data['groupid'] = $this->Pages_m->getselectgroup($pages_id);
            $data['results'] = $this->Pages_m->view_edit($pages_id)->row_array();
            $data['nm_lengkap'] = $this->Pages_m->view_mdfi($pages_id)->row_array();
        }
        else{
            redirect('not_found');
        }

        $data['content_view'] = 'pages/view_v';
        $this->template->hygienic_template($data);

        
    }
    public function edt($pages_id){
        $data['subtitle'] = 'Pages';//title
        
       
        if ($this->form_validation->run('pages') == FALSE)
        {
            $this->session->set_flashdata("infosaveupdate","<script>
                                                             setTimeout(function() {
                                                               toastr.options = {
                                                                    'closeButton': true,
                                                                    'debug': false,
                                                                    'progressBar': true,
                                                                    'preventDuplicates': false,
                                                                    'positionClass': 'toast-top-right',
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
                                                                toastr.error('Silahkan Cek Kembali', 'Data Ada yang Kosong!');
                                                            }, 1300);
                                                            </script>
                                                          ");
            $this->vew($pages_id);
        }
        else{
            $this->Pages_m->saveupdate($pages_id);
            $this->session->set_flashdata("infosave","<script>
                                                         setTimeout(function() {
                                                           toastr.options = {
                                                                  'closeButton': true,
                                                                  'debug': false,
                                                                  'progressBar': true,
                                                                  'preventDuplicates': false,
                                                                  'positionClass': 'toast-top-right',
                                                                  'onclick': null,
                                                                  'showDuration': '400',
                                                                  'hideDuration': '1000',
                                                                  'timeOut': '7000',
                                                                  'extendedTimeOut': '1000',
                                                                  'showEasing': 'swing',
                                                                  'hideEasing': 'linear',
                                                                  'showMethod': 'fadeIn',
                                                                  'hideMethod': 'fadeOut'
                                                            };
                                                            toastr.success('Update Data Sukses', 'Data Berhasil Disimpan!');
                                                        }, 1300);
                                                        </script>
                                                      ");
            redirect('pages');
        }
    }

    public function dlt($pages_id){
        $this->Pages_m->dlt($pages_id);
        redirect('pages');
    }








    




}
?>