<?php defined('BASEPATH') or exit('No direct script access allowed');
class Import_excel_m extends CI_Model
{
	public function select(){
		$this->db->select('*');
		$query = $this->db->get('t_import_excel');
		return $query->num_rows();
	}
	public function insert($data){
		$this->db->insert_batch('t_import_excel',$data);
	}
}
?>