<?php defined('BASEPATH') or exit('No direct script access allowed');
class Template_m extends CI_Model
{
	public $_usv 	 	= "t_userview";
	public $_usvd 	 	= "t_userview_detail";
	public $_usvmanu 	= "t_userviewmanu_detail";
	public $_mngtuser	= "t_managementusers";
	public $_mnusers	= "t_manu_users";
	public $_user 		= "t_users";

	public function cekitem($idsession,$nmsession){
		$query = $this->db
						->select('*')
						->where('id',$idsession)
						->where('nm_lengkap',$nmsession)
						->get('t_personil');
		return $query->result();				
	}
	public function showcount_chat(){
		return $this->db
                      ->select('id')
                      ->where('deleted',0)
                      ->get('t_group_chats')
                      ->num_rows();
	}
	public function showselectchat(){
		$firstviews =  $this->db->select("t_chats.id,MAX(t_group_chats.date_created) as lastdate,MAX(t_group_chats.content)as lastcontent")
						->from('t_group_chats')
						->where("t_chats.id=t_group_chats.chat_id")
						->where('t_chats.personil_id',$this->session->userdata('id'))
						->group_by('t_chats.id')
						->order_by("MAX(t_group_chats.date_created) DESC")
						->get('t_chats',1)
						->row_array();

		$query = $this->db
						->select("t_chats.id,GROUP_CONCAT(CONCAT(t_personil.nm_lengkap)SEPARATOR ', ')AS person_chats")
						->from('t_personil')
						->where("t_chats.personil_id=t_personil.id")
						->where('t_chats.personil_id!=',$this->session->userdata('id'))
						->where('t_chats.id',$firstviews['id'])
						->where('t_chats.deleted',0)
						->group_by('t_chats.id')
						->get('t_chats');
		return $query->result();

	}
	public function showresultselect(){
		$query = $this->db
						->select("t_chats.id, GROUP_CONCAT(CONCAT(t_personil.nm_lengkap)SEPARATOR ', ')AS person_chats, 
									IF(GROUP_CONCAT(t_chats.personil_id)LIKE '%".$this->session->userdata('id')."%',
										(SELECT GROUP_CONCAT(CONCAT(t_personil.nm_lengkap)SEPARATOR ', ') 
										FROM t_personil,t_group_chats
										WHERE t_chats.id=t_group_chats.chat_id
										AND t_group_chats.deleted='0'
										AND t_group_chats.chat_from!='".$this->session->userdata('id')."'
										AND t_group_chats.chat_from=t_personil.id),'0')AS optoinchats")
						->from('t_personil')
						->where("t_chats.personil_id=t_personil.id")
						->where('t_chats.deleted',0)
						->group_by('t_chats.id')
						->get('t_chats');
		return $query->result();
	}
	public function showlimitchat(){
		$results =  $this->db->select("t_chats.id,MAX(t_group_chats.date_created) as lastdate,MAX(t_group_chats.content)as lastcontent")
						->from('t_group_chats')
						->where("t_chats.id=t_group_chats.chat_id")
						->where('t_chats.personil_id',$this->session->userdata('id'))
						->group_by('t_chats.id')
						->order_by("MAX(t_group_chats.date_created) DESC")
						->get('t_chats',1)
						->row_array();
		$query = $this->db->select("t_chats.id,t_personil.nm_lengkap,t_chats.admin_gchat,t_group_chats.content,
									(SELECT GROUP_CONCAT(CONCAT(t_personil.nm_lengkap,' (',t_groupchat_detail.readat,')')SEPARATOR ', ') 
										FROM t_groupchat_detail,t_personil 
										WHERE t_groupchat_detail.groupchat_id=t_group_chats.id 
										AND t_groupchat_detail.readby=t_personil.id AND t_personil.deleted='0')AS read_by,
									(SELECT GROUP_CONCAT(CONCAT(t_personil.nm_lengkap)SEPARATOR ', ') 
										FROM t_groupchat_detail,t_personil 
										WHERE t_groupchat_detail.groupchat_id=t_group_chats.id 
										AND t_groupchat_detail.readby=t_personil.id AND t_personil.deleted='0')AS sentto")
						  ->from("t_personil,t_group_chats")
						  ->where("t_chats.personil_id = t_personil.id")
						  ->where("t_chats.id = t_group_chats.chat_id")
						  ->where("t_chats.personil_id = t_group_chats.chat_from")
						  ->where('t_chats.deleted',0)
						  ->where('t_personil.deleted',0)
						  ->where('t_group_chats.deleted',0)
						  ->where('t_chats.id',$results['id'])
						  ->get('t_chats');
		return $query->result();
	}
	public function sendingmessage(){
		$field = array(
			'chat_from' => $this->session->userdata('id'),
			'chat_id' => $this->input->post('chat_id'),
			'content' => $this->input->post('textmessage'),
			'date_created' => date('Y-m-d H:i:s'),
			'deleted' => '0'
		 );
		$this->db->insert('t_group_chats', $field);

		// $query = $this->db->select('id,personil_id')
		// 				  ->where('deleted',0)
		// 				  ->where('id','chat_pertama')
		// 				  ->get('t_chats')->result();

		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function jumlah_data_provinsi(){
		return $this->db
				->select('id')
				->where('deleted','0')
				->get('t_provinsi')
				->num_rows();
  	} 
  	public function jumlah_data_kabupaten(){
		return $this->db
				->select('id')
				->where('deleted','0')
				->get('t_kabupaten')
				->num_rows();
  	}
  	public function jumlah_data_kecamatan(){
		return $this->db
				->select('id')
				->where('deleted','0')
				->get('t_kecamatan')
				->num_rows();
  	} 
  	public function jumlah_data_kelurahan(){
		return $this->db
				->select('id')
				->where('deleted','0')
				->get('t_kelurahan')
				->num_rows();
  	}



  	public function get_userview(){
		$query = $this->db
						->select("u.*")
						->select("IF(`u`.`status`='Anak',u.link,
									IF(SUBSTR(`u`.`status`,1,5)='Anak',SUBSTR(`u`.`status`,6),
									IF(SUBSTR(`u`.`status`,1,5)='Mamah',u.link,
									IF(SUBSTR(`u`.`status`,1,10)='Ayah Level',SUBSTR(`u`.`status`,14),
									'tidak ada')))) sts_link")
						// ->select("IF(d.hide_as_permission_on='1',
						// 			IF(s.active='1',
						// 				IF(us.id = '".$this->session->userdata('id')."','','display:none;'),
						// 			''),
						// 		'')enablepermission")
						->select("GROUP_CONCAT(s.name) eta, COUNT(s.name) countname,
  									IF(d.hide_as_permission_on='1',GROUP_CONCAT(IF(us.id = '".$this->session->userdata('id')."','1','')SEPARATOR ''),'-')ada")
						->from($this->_usv." u")
						->join($this->_usvd." d",'u.id=d.id','left')
						->join($this->_usvmanu." m",'u.id = m.userview_id','left')
						->join($this->_mngtuser." s",'m.managementuser_id = s.id','left')
						->join($this->_mnusers." mn",'s.id = mn.managementuser_id','left')
						->join($this->_user." us",'mn.user_id = us.id','left')
						->group_by('u.id')
						->order_by('u.no','ASC')
						->get();
		return $query->result();
	}

	public function get_theme(){
		$query = $this->db
						->select("theme")
						->select("TRIM(CONCAT(IF(fixed_nav!='',CONCAT(fixed_nav,' '),''),'',
									 IF(boxed_layout!='',CONCAT(boxed_layout,' '),''),'',
									 IF(fixed_nav_basic!='',CONCAT(fixed_nav_basic,' '),''),'',
									 IF(fixed_sidebar!='',CONCAT(fixed_sidebar,' '),''),'',
									 IF(mini_navbar!='',CONCAT(mini_navbar,' '),''),''))AS confnav")
						->select("fixed_footer")
						->select("nav_static_top")
						->from('t_config')
						->where('id',$this->session->userdata('idconfig'))
						->get();
		return $query->row_array();
	}
	

}
?>