<?php defined('BASEPATH') or exit('No direct script access allowed');
class Employee extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Employee_m');
		$this->session->set_tempdata("employee","active",0,1);
	}
	public function index()
	{
		$data['subtitle'] = 'Employee';
        $data['content_view'] = 'employee/employee_v';
        $this->template->admin_template($data);
	}
	public function showAllEmployee(){
		$result = $this->Employee_m->showAllEmployee();
		echo json_encode($result);
	}
	public function addEmployee(){
		$result = $this->Employee_m->addEmployee();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
	public function editEmployee(){
		$result = $this->Employee_m->editEmployee();
		echo json_encode($result);
	}
	public function updateEmployee(){
		$result = $this->Employee_m->updateEmployee();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;	
		}
		echo json_encode($msg);
	}
	public function deleteEmployee(){
		$result = $this->Employee_m->deleteEmployee();
		$msg['success'] = true;
		if($result){
			$msg['success'] = false;
		}
		echo json_encode($msg);
	}









}
?>