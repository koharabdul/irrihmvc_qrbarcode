<?php defined('BASEPATH') or exit('No direct script access allowed');
class Uploadimages_m extends CI_Model
{
	public function get_uploadimages(){

		$query = $this->db
						->select("*")
            			->where('deleted','0')
						->order_by('date_created','ASC')
						->get('t_images');
		return $query->result();
	}
	public function insertImage($data){
		return $this->db->insert('t_images',$data);
	}
	
	public function remove_checked_permanen(){
        $delete = $this->input->post('table_records');
        for ($i=0; $i < count($delete); $i++){
            $this->db->where('id', $delete[$i]);
            $this->db->delete('t_images');
        }
    }

    public function cekone($nm_image){
    	$query = $this->db
                      ->select("avatar,small_avatar")
                      ->where('avatar',$nm_image)
                      ->get('t_images');
      	return $query;
    }

    public function deleted($results){
    	$this->db->where('avatar','uploads/images/'.$results.'.jpg');
    	$this->db->where('small_avatar','uploads/images/thumbs/'.$results.'.png');
        $this->db->delete('t_images');
    }

}
?>