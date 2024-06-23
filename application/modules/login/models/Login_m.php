<?php defined('BASEPATH') or exit('No direct script access allowed');
class Login_m extends CI_Model
{	
	public $_conf = "t_config";
	public $_pers = "t_personil";

	public function login_user($username, $password)
	{
		$query = $this->db
						->select('t_personil.id,t_personil.nm_lengkap,t_config.company_name,t_config.id as idconfig')
						->from($this->_pers)
						->from($this->_conf)
						->where('t_personil.username', $username)
						->where('t_personil.password', $password)
						->where('t_personil.deleted',0)
						->where('t_config.publish','1')
						->limit(1)
						->get();
		return $query;
	}



}
?>