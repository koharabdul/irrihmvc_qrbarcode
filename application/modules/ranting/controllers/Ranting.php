<?php defined('BASEPATH') or exit('No direct script access allowed');
class Ranting extends MY_Controller
{
  	public function __construct()
  	{
        parent::__construct();
        $this->load->model('Ranting_m');
        $this->session->set_tempdata("ranting","active",0,1);
  	}
  	public function index()
  	{
        $data['subtitle'] = 'Ranting';
        $jumlah_data = $this->Ranting_m->jumlah_data();
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
        $data['results'] = $this->Ranting_m->get_ranting($config['per_page'],$from);
        $data['row'] = $this->Ranting_m->jumlah_data();
        $data['content_view'] = 'ranting/ranting_v';
        $this->template->admin_template($data);
    }


}
?>