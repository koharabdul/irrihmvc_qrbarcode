<?php defined('BASEPATH') or exit('No direct script access allowed');
class Provinsi extends MY_Controller{
	 public function __construct()
  	{
        parent::__construct();
        $this->load->model('Provinsi_m');//model
        $this->session->set_tempdata("masterwilayah","active",0,1);//class active
        $this->susbtitle = 'Provinsi';//subtitle
        $this->sumof_perpage = 10;
    }
    public function index()
    {
        $data['subtitle'] = $this->susbtitle;
        $jumlah_data = $this->Provinsi_m->jumlah_data();
        $config['base_url'] = base_url().strtolower($this->susbtitle).'/index/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = $this->sumof_perpage;
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

        
        $fr = $from + 1;
        $to = $from + $config['per_page'];
        if($jumlah_data != 0){
            if($to > $jumlah_data){
                $data['numberofpage'] = 'Showing '.$fr.' to '.$jumlah_data.' of '.$jumlah_data.' entries';
            }
            else{
                $data['numberofpage'] = 'Showing '.$fr.' to '.$to.' of '.$jumlah_data.' entries';
            }
        }
        else{
            $data['numberofpage'] = '';
        }

        $get_subtitle = strtolower($data['subtitle']);

        $data['results'] = $this->Provinsi_m->get_index($config['per_page'],$from);
        $data['content_view'] = strtolower($this->susbtitle).'/'.strtolower($this->susbtitle).'_v';

        $this->template->hygienic_template($data);
    }
    public function search() 
    {//cari data
        $data['subtitle'] = $this->susbtitle;
        $datacari = (trim($this->input->post('cari')))? trim($this->input->post('cari')) : '';
        $datacari = ($this->uri->segment(3)) ? $this->uri->segment(3) : $datacari;
        if($datacari == ''){
            redirect($data['subtitle']);
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
            
            
            
            $jumlah_data = $this->Provinsi_m->jumlah_data_cari();
            $config['base_url'] = base_url().strtolower($this->susbtitle).'/search/'.$datacari;
            $config['total_rows'] = $jumlah_data;
            $config['per_page'] = $this->sumof_perpage;
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

            $fr = $from + 1;
            $to = $from + $config['per_page'];
            if($jumlah_data != 0){
                if($to > $jumlah_data){
                  $data['numberofpage'] = 'Showing '.$fr.' to '.$jumlah_data.' of '.$jumlah_data.' entries';
                }
                else{
                  $data['numberofpage'] = 'Showing '.$fr.' to '.$to.' of '.$jumlah_data.' entries';
                }
            }
            else{
              $data['numberofpage'] = '';
            }
                $data['results'] = $this->Provinsi_m->get_cari($config['per_page'],$from,$datacari);
                $data['content_view'] = strtolower($this->susbtitle).'/'.strtolower($this->susbtitle).'_v';
                $this->template->hygienic_template($data);
        }
    }
    public function add(){
        $data['subtitle'] = $this->susbtitle;//ambil subtitle
        $data['content_view'] = strtolower($this->susbtitle).'/add_v';
        $this->template->hygienic_template($data);
    }
    public function save(){
        if ($this->form_validation->run(strtolower($this->susbtitle).'/save') == FALSE)
        {
            $this->session->set_flashdata("infosaveadd","<script>
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
                                                                toastr.error('Silahkan Cek Kembali', 'Ada Kekeliruan Data!');
                                                            }, 1300);
                                                            </script>
                                                          ");
            $this->add();
             
        }
        else{

            $this->Provinsi_m->save();
            $this->session->set_flashdata("infosaveadd","<script>
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
                                                        toastr.success('Tambah Data Sukses', 'Data Berhasil Disimpan!');
                                                    }, 1300);
                                                    </script>
                                                  ");
       
            redirect(strtolower($this->susbtitle));
        }
    }
    public function view($view_id){
        $data['subtitle'] = $this->susbtitle;
        if($this->Provinsi_m->get_id($view_id)->row_array()){
            $data['results'] = $this->Provinsi_m->get_id($view_id)->row_array();
        }
        else{
            redirect('not_found');
        }
        $data['content_view'] = strtolower($this->susbtitle).'/view_v';
        $this->template->hygienic_template($data);
    }
    public function update($update_id){
        if ($this->form_validation->run(strtolower($this->susbtitle).'/update') == FALSE)
        {
            $this->session->set_flashdata("infoupdate","<script>
                                                          setTimeout(function() {
                                                            toastr.options = {
                                                                  'closeButton': true,
                                                                  'debug': false,
                                                                  'progressBar': true,
                                                                  'preventDuplicates': false,
                                                                  'positionClass': 'toast-top-left',
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
                                                            toastr.warning('Update Data Gagal', 'Silahkan Cek Kembali!');
                                                        }, 1300);
                                                        </script>");
                                                          
            $this->view($update_id);
             
        }
        else{

            $this->Provinsi_m->updated($update_id);
            $this->session->set_flashdata("infoupdate","<script>
                                                     setTimeout(function() {
                                                       toastr.options = {
                                                          'closeButton': true,
                                                          'debug': false,
                                                          'progressBar': true,
                                                          'preventDuplicates': false,
                                                          'positionClass': 'toast-top-left',
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
                                                        toastr.info('Update Data Sukses', 'Data Berhasil Disimpan!');
                                                    }, 1300);
                                                    </script>
                                                  ");
       
            redirect(strtolower($this->susbtitle));
        }
    }
    public function delete($delete_id){
        $this->Provinsi_m->deleted($delete_id);
        redirect(strtolower($this->susbtitle));
    }
    public function delete_multiple(){
        $this->Provinsi_m->deleted_multiple();
        redirect(strtolower($this->susbtitle));
    }
    public function prints(){
        $data['subtitle'] = $this->susbtitle;
        $this->load->Library('Pdf_Library');
        $data['content_view'] = strtolower($this->susbtitle).'/report_v';
        $this->template->hygienic_template($data);

    }
    public function generateReport(){
        $data['subtitle'] = $this->susbtitle;//title
        $this->load->Library('Pdf_Library');
        // $this->load->Library('ciqrcode');
        // $params['data'] = base_url().strtolower($this->susbtitle).'/generateReport';
        // $params['level'] = 'M';
        // $params['size'] = 2;
        // $params['savename'] = FCPATH.'tes.png';
        // $this->ciqrcode->generate($params);


        // echo '<img src="'.base_url().'tes.png" />';

        $data['pageresult'] = $this->Provinsi_m->select_groups();
        $this->load->view($this->susbtitle.'/reportfile_v',$data);
    }







}
?>