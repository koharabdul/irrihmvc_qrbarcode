<?php defined('BASEPATH') or exit('No direct script access allowed');
class Personil extends MY_Controller
{
  	public function __construct()
  	{
    		parent::__construct();
    		$this->load->model('Personil_m');
        $this->session->set_tempdata("datamaster","active",0,1);
        $this->session->set_tempdata("personil","active",0,1);
  	}
  	public function index()
  	{
        $data['subtitle'] = 'Personil';//title
        $jumlah_data = $this->Personil_m->jumlah_data();
        $config['base_url'] = base_url().'personil/index/';
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
        $data['results'] = $this->Personil_m->get_personil($config['per_page'],$from);
        $data['row'] = $this->Personil_m->jumlah_data();
        $data['content_view'] = 'personil/personil_v';
        $this->template->admin_template($data);
  	}
  	public function add()
  	{
        $data['subtitle'] = 'Personil';//title
    		$data['desa'] = $this->Personil_m->get_dropdowndesa();
       
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|min_length[16]|max_length[16]|numeric');
        $this->form_validation->set_rules('nm_lengkap', 'Name', 'trim|required');
        $this->form_validation->set_rules('tmp_lahir', 'birth', 'trim|required');
        $this->form_validation->set_rules('tgl_lahir', 'date birth', 'trim|required');
        $this->form_validation->set_rules('jns_kelamin', 'gender', 'trim|required');
        $this->form_validation->set_rules('alamat', 'address', 'trim|required');
        $this->form_validation->set_rules('id_desa', 'filage', 'trim|required');
        $this->form_validation->set_rules('agama', 'religius', 'trim|required');
        $this->form_validation->set_rules('sts_perkawinan', 'status', 'trim|required');
        $this->form_validation->set_rules('pekerjaan', 'job', 'trim|required');

        if ($this->form_validation->run() === FALSE)
        {
            $data['content_view'] = 'personil/add_v';
    	      $this->template->admin_template($data);
            $this->session->set_flashdata("infowarning","<script>
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
                                                            toastr.error('Silahkan Isi Kembali', 'Data Ada yang Kosong!');
                                                        }, 1300);
                                                        </script>
                                                      ");
        }
        else
        {    
            $hari = substr($this->input->post('tgl_lahir'),0,2);
            $bulan = substr($this->input->post('tgl_lahir'), 3,2);
            $tahun = substr($this->input->post('tgl_lahir'),6);

            $kecilnama = strtolower($this->input->post('nm_lengkap'));
            $capitalnama = ucwords($kecilnama);

            $no_nik = $this->input->post('nik');

            $alamatkecil = strtolower($this->input->post('alamat'));
            $capitalalamat = ucwords($alamatkecil);

            $keciltmplhr = strtolower($this->input->post('tmp_lahir'));
            $captmplhr = ucwords($keciltmplhr);

            $cekinput = $this->Personil_m->cek_input($no_nik);
            if(count($cekinput)==0)
            {
                $datapenduduk = array(
                                      'id'               => 'PER-'.get_uuid(),
                  					          'nik'              => $no_nik,
                                      'nm_lengkap'       => $capitalnama,
                                      'tmp_lahir'        => $captmplhr,
                                      'tgl_lahir'        => "$tahun-$bulan-$hari",
                                      'jns_kelamin'      => $this->input->post('jns_kelamin'),
                                      'alamat'           => $capitalalamat,
                                      'rt'               => $this->input->post('rt'),
                                      'rw'               => $this->input->post('rw'),
                                      'id_desa'          => $this->input->post('id_desa'),
                                      'agama'            => $this->input->post('agama'),
                                      'sts_perkawinan'   => $this->input->post('sts_perkawinan'),
                                      'pekerjaan'        => $this->input->post('pekerjaan')
                                      );
                $this->db->insert('t_personil',$datapenduduk);
                $this->session->set_flashdata("info","<script>
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
                                                            toastr.success('Berhasil Disimpan', 'Data : $capitalnama');
                                                        }, 1300);
                                                        </script>
                                                      ");

                redirect('personil');
            }
            else
            {
                $this->session->set_flashdata("infowarningnik","<script>
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
                                                            toastr.error('Silahkan Koreksi Kembali', 'Nomor NIK Sudah Ada!');
                                                        }, 1300);
                                                        </script>
                                                      ");
                redirect('personil');
            }
        }
  	}
    public function delete_multiple() 
    {
        $data['subtitle'] = 'Personil';//title
        $delete = $this->input->post('table_records');
        $jumlahdata = count($delete);       
        $this->Personil_m->remove_checked();
        $this->session->set_flashdata("infodeleted","<script>
                                                         setTimeout(function() {
                                                            toastr.options = {
                                                              'closeButton': true,
                                                              'debug': false,
                                                              'progressBar': true,
                                                              'preventDuplicates': false,
                                                              'positionClass': 'toast-bottom-left',
                                                              'onclick': null,
                                                              'showDuration': '400',
                                                              'hideDuration': '1000',
                                                              'timeOut': '7000',
                                                              'extendedTimeOut': '1000',
                                                              'showEasing': 'swing',
                                                              'hideEasing': 'linear',
                                                              'showMethod': 'fadeIn',
                                                              'hideMethod': 'fadeOut'
                                                            }
                                                            toastr.info('Berhasil Dihapus', '$jumlahdata Data Terpilih');
                                                        }, 1300);
                                                        </script>
                                                      ");
        
        redirect('personil');
    }
    public function src() 
    {//cari data
        $data['subtitle'] = 'Personil';//title
        $datacari = (trim($this->input->post('cari')))? trim($this->input->post('cari')) : '';
        $datacari = ($this->uri->segment(3)) ? $this->uri->segment(3) : $datacari;
        if($datacari == ''){
            redirect('personil');
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
            
            
            
            $jumlah_data = $this->Personil_m->jumlah_data_cari();
            $config['base_url'] = base_url().'personil/src/'.$datacari;
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
            $data['results'] = $this->Personil_m->get_cari($config['per_page'],$from,$datacari);
            $data['row'] = $this->Personil_m->jumlah_data_cari();
            $data['content_view'] = 'personil/search_v';
            $this->template->admin_template($data);
        }
    }




    public function vie($personil_id)
    {
        $data['subtitle'] = 'Personil';//title
        $data['results'] = $this->Personil_m->get_id($personil_id)->row_array();
        $data['content_view'] = 'personil/view_v';
        $this->template->admin_template($data);
    }

    public function dlt($personil_id)
    {
        $data['subtitle'] = 'Personil';//title
        $datapenduduk = array('deleted'=>'1');
        $this->db->where('id',$personil_id);
        $this->db->update('t_personil',$datapenduduk);
        $this->session->set_flashdata("infodeleted","<script>
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
                                                            }
                                                            toastr.info('Berhasil Dihapus', 'Data Tersebut');
                                                        }, 1300);
                                                        </script>
                                                      ");
        redirect('personil');

    }

    public function edt($personil_id)
    {
        $data['subtitle'] = 'Personil';//title
        $data['results2'] = $this->Personil_m->edit_desa();
        $data['desa'] = $this->Personil_m->get_dropdowndesa();
        $data['results'] = $this->Personil_m->edit_id($personil_id)->row_array();
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|min_length[16]|max_length[16]|numeric');
        $this->form_validation->set_rules('nm_lengkap', 'Name', 'trim|required');
        $this->form_validation->set_rules('tmp_lahir', 'birth', 'trim|required');
        $this->form_validation->set_rules('tgl_lahir', 'date birth', 'trim|required');
        $this->form_validation->set_rules('jns_kelamin', 'gender', 'trim|required');
        $this->form_validation->set_rules('alamat', 'address', 'trim|required');
        $this->form_validation->set_rules('id_desa', 'filage', 'trim|required');
        $this->form_validation->set_rules('agama', 'religius', 'trim|required');
        $this->form_validation->set_rules('sts_perkawinan', 'status', 'trim|required');
        $this->form_validation->set_rules('pekerjaan', 'job', 'trim|required');

        if ($this->form_validation->run() === FALSE)
        {
            $data['content_view'] = 'personil/edit_v';
            $this->template->admin_template($data);
            $this->session->set_flashdata("infowarning","<script>
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
                                                            toastr.error('Silahkan Isi Kembali', 'Data Ada yang Kosong!');
                                                        }, 1300);
                                                        </script>
                                                      ");
        }
        else
        {    
            $hari = substr($this->input->post('tgl_lahir'),0,2);
            $bulan = substr($this->input->post('tgl_lahir'), 3,2);
            $tahun = substr($this->input->post('tgl_lahir'),6);

            $kecilnama = strtolower($this->input->post('nm_lengkap'));
            $capitalnama = ucwords($kecilnama);

            $alamatkecil = strtolower($this->input->post('alamat'));
            $capitalalamat = ucwords($alamatkecil);

            $keciltmplhr = strtolower($this->input->post('tmp_lahir'));
            $captmplhr = ucwords($keciltmplhr);

            $datapenduduk = array(
                                'nik'              => $this->input->post('nik'),
                                'nm_lengkap'       => $capitalnama,
                                'tmp_lahir'        => $captmplhr,
                                'tgl_lahir'        => "$tahun-$bulan-$hari",
                                'jns_kelamin'      => $this->input->post('jns_kelamin'),
                                'alamat'           => $capitalalamat,
                                'rt'               => $this->input->post('rt'),
                                'rw'               => $this->input->post('rw'),
                                'id_desa'          => $this->input->post('id_desa'),
                                'agama'            => $this->input->post('agama'),
                                'sts_perkawinan'   => $this->input->post('sts_perkawinan'),
                                'pekerjaan'        => $this->input->post('pekerjaan'));
                        $this->db->where('id',$personil_id);
                        $this->db->update('t_personil',$datapenduduk);
                        $this->session->set_flashdata("info","<script>
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
                                                            toastr.info('Berhasil Diubah', 'Data : $capitalnama');
                                                        }, 1300);
                                                        </script>
                                                      ");
            redirect('personil');
        }
    }
     
	

	










}
?>