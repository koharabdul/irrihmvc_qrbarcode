<?php defined('BASEPATH') or exit('No direct script access allowed');
class Template extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Template_m');
	}
	public function admin_template($data = NULL)
	{
		$data['title'] = 'SUP Rancaekek';
		$usersession =  $this->session->userdata('nm_lengkap');
		if($usersession != null)
		{
			$this->load->view('template/main', $data);
		}
		else
		{
			$this->load->view('login/notfound_v', $data);
		}
	}
	public function template($data = NULL)
	{
		$data['title'] = 'SUP Rancaekek';
		$this->load->view('template/main2', $data);
	}
	public function notemplate($data = NULL)
	{
		$data['title'] = 'SUP Rancaekek';
		$this->load->view('login/login_v', $data);
	}
	public function hygienic_template($data = NULL)
	{
		$data['title'] = 'SUP Rancaekek';
		$idsession =  $this->session->userdata('id');
		$nmsession =  $this->session->userdata('nm_lengkap');

		$data['userview'] = $this->Template_m->get_userview();
		$data['publish_app'] = $this->Template_m->get_theme();

		
		$data['jumlahsubprov'] = $this->Template_m->jumlah_data_provinsi();
		$data['jumlahsubkab'] = $this->Template_m->jumlah_data_kabupaten();
		$data['jumlahsubkec'] = $this->Template_m->jumlah_data_kecamatan();
		$data['jumlahsubkel'] = $this->Template_m->jumlah_data_kelurahan();
		if(($idsession != null) && ($nmsession != null))
		{
			$datalog = $this->Template_m->cekitem($idsession,$nmsession);
			if(count($datalog)==1){
				$this->load->view('template/hygienic_main', $data);
			}
			else{
				session_destroy();
				$this->load->view('login/notfound_v', $data);
			}
			
		}
		else
		{
			$this->load->view('login/notfound_v', $data);
		}
	}
	public function error_template($data = null){
		$data['title'] = 'SUP Rancaekek';
		$this->load->view('errors/errors_v', $data);
	}
	public function count_chat($data = NULL){
		$data['count'] =  $this->Template_m->showcount_chat();
		$this->load->view('template/load', $data);
	}
	public function selectchat($data = NULL){
		$data['chosen'] =  $this->Template_m->showselectchat();
		$this->load->view('template/select_chat', $data);
	}
	public function show_chats($data = NULL){
		$awal = $this->Template_m->showcount_chat();
		if($awal>=10){
			$awals = $awal - 10;
		}
		else{
			$awals = 0;
		}
		$jumlah = 10;
		$data['chats'] = $this->Template_m->showlimitchat();
		$this->load->view('template/content_chat', $data);
	}
	public function count_chats2($data = NULL){
		$data['chats2'] = $this->Template_m->showcount_chat();
		$this->load->view('template/loadnavbar', $data);
	}
	public function save($data = NULL){
		$result = $this->Template_m->sendingmessage();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
	

}
?>