<?php defined('BASEPATH') or exit('No direct script access allowed');
class Ranting_m extends CI_Model{
	public function get_ranting($number,$offset)
	{
		$query = $this->db
						->select('*')
                        ->where('deleted=0')
						->order_by('date_created','DESC')
						->get('t_ranting',$number,$offset);
		return $query->result();
	}
	public function jumlah_data(){  //jang pagination
		return $this->db
            ->select('id')
            ->where('deleted=0')
            ->get('t_ranting')
            ->num_rows();
	}
}
?>