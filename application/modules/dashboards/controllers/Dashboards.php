<?php defined('BASEPATH') or exit('No direct script access allowed');
class Dashboards extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->session->set_tempdata('dashboards','active',0,1);
	}
	public function index()
	{
		$data['subtitle'] = 'Dashboards';
		$data['content_view'] = 'dashboards/dashboards_v';
		$this->template->hygienic_template($data);
	}
	










}
?>