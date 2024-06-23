<?php defined('BASEPATH') or exit('No direct script access allowed');
class Employee_m extends CI_Model
{
	public function showAllEmployee(){
		
		$query = $this->db->where('deleted','0');
		$query = $this->db->get('t_employee');
		return $query->result();

	}
	public function addEmployee(){
		$field = array(
			'name' => $this->input->post('nameemployee'),
			'address' => $this->input->post('addressemployee'),
			'date_created' => date('Y-m-d H:i:s')
		 );
		$this->db->insert('t_employee', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function editEmployee(){
		$id = $this->input->get('id');
		$this->db->where('id',$id);
		$query = $this->db->get('t_employee');
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}

	}

	public function updateEmployee(){
		$id = $this->input->post('txtId');
		$field = array(
			'name' => $this->input->post('nameemployee'),
			'address' => $this->input->post('addressemployee'),
			'date_modified' => date('Y-m-d H:i:s')
		 );
		$this->db->where('id',$id);
		$this->db->update('t_employee', $field);
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function deleteEmployee(){
		$id = $this->input->get('id');
		$this->db->where('id', $id);
		$this->db->delete('t_employee');
		if($this->db->affected_rows() > 0){
			return true;
		}
		else
		{
			return false;
		}
	}

	




}
?>