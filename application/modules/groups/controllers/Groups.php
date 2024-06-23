<?php defined('BASEPATH') or exit('No direct script access allowed');
class Groups extends MY_Controller
{
  	public function __construct()
  	{
		parent::__construct();
		$this->load->model('Groups_m');
    	$this->session->set_tempdata("groups","active",0,1);
    }
    public function index()
    {
    	$jumlah_data = $this->Groups_m->jumlah_data_groups();
        $config['base_url'] = base_url().'groups/index/';
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
        $data['results'] = $this->Groups_m->get_groups($config['per_page'],$from);
        $data['row'] = $this->Groups_m->jumlah_data_groups();
        //skat
        $data['subtitle'] = 'Groups';
        $data['content_view'] = 'groups/groups_v';
        $this->template->hygienic_template($data);
    }
    public function add(){
        $data['subtitle'] = 'Groups';//title

        $data['datapages'] = $this->Groups_m->get_dropdownpages();
        $data['content_view'] = 'groups/add_v';
        $this->template->hygienic_template($data);
       
    }
    public function sad(){
        $data['subtitle'] = 'Groups';//title


        if ($this->form_validation->run('groups') == FALSE)
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
            $this->add();
             
        }
        else{

                $this->Groups_m->SaveAdd();
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
           
                redirect('groups');
        }
    }
    public function gnr(){
        $data['subtitle'] = 'Groups';//title
        $this->load->Library('Pdf_Library');
        $this->load->Library('ciqrcode');
        $params['data'] = base_url().'groups/gnr';
        $params['level'] = 'M';
        $params['size'] = 2;
        $params['savename'] = FCPATH.'tes.png';
        $this->ciqrcode->generate($params);


        // echo '<img src="'.base_url().'tes.png" />';

        $data['pageresult'] = $this->Groups_m->select_groups();
        $this->load->view('groups/report_v',$data);
    }
    public function gnr2(){
        $data['subtitle'] = 'Groups';//title
        $this->load->Library('Pdf_Library');
        $data['pageresult'] = $this->Groups_m->select_groups();
        $this->load->view('groups/report2_v',$data);
    }
    public function prt(){
        $data['subtitle'] = 'Groups';//title
        $this->load->Library('Pdf_Library');
        $data['content_view'] = 'groups/reportfile_v';
        $this->template->hygienic_template($data);
    }
    public function src() 
    {//cari data
        $data['subtitle'] = 'Groups';//title
        $datacari = (trim($this->input->post('cari')))? trim($this->input->post('cari')) : '';
        $datacari = ($this->uri->segment(3)) ? $this->uri->segment(3) : $datacari;
        if($datacari == ''){
            redirect('groups');
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
            
            
            
            $jumlah_data = $this->Groups_m->jumlah_data_cari();
            $config['base_url'] = base_url().'groups/src/'.$datacari;
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
            $data['results'] = $this->Groups_m->get_cari($config['per_page'],$from,$datacari);
            $data['row'] = $this->Groups_m->jumlah_data_cari();
            $data['content_view'] = 'groups/groups_v';
            $this->template->hygienic_template($data);
        }
    }
    public function dlm() 
    {
        $data['subtitle'] = 'Groups';//title
        $this->Groups_m->remove_checked();
        redirect('groups');
    }
    public function advanced(){
        $data['subtitle'] = 'Groups';
        $data['content_view'] = 'groups/form_advanced';
        $this->template->hygienic_template($data);
    }
    public function vew($groups_id){
        $data['subtitle'] = 'Groups';//title
        
        if($this->Groups_m->view_edit($groups_id)->row_array()){
            $data['groupid'] = $this->Groups_m->getselectpages($groups_id);
            $data['results'] = $this->Groups_m->view_edit($groups_id)->row_array();
            $data['nm_lengkap'] = $this->Groups_m->view_mdfi($groups_id)->row_array();
        }
        else{
            redirect('not_found');
        }

        $data['content_view'] = 'groups/view_v';
        $this->template->hygienic_template($data);

        
    }
    public function edt($groups_id){
        $data['subtitle'] = 'Groups';//title
        
       
        if ($this->form_validation->run('groups') == FALSE)
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
            $this->vew($groups_id);
        }
        else{
            $this->Groups_m->saveupdate($groups_id);
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
            redirect('groups');
        }
    }

    public function dlt($groups_id){
        $this->Groups_m->dlt($groups_id);
        redirect('groups');
    }





}
?>