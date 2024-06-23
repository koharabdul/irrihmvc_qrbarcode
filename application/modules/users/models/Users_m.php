<?php defined('BASEPATH') or exit('No direct script access allowed');
class Users_m extends CI_Model{
	public $_table = "t_users";
	public $_orderby = "DESC";
	public function get_users($number,$offset){
		$query = $this->db
						->select("id,NIK,nm_lengkap, IF(LENGTH(nm_lengkap)>15,CONCAT('<span style=\"border:none; background:transparent;cursor: pointer;\" data-toggle=\"popover\" data-placement=\"auto right\" data-content=\"',nm_lengkap,'\">',LEFT(nm_lengkap,11),'...','</span>'),nm_lengkap)AS scat,IF(jns_kelamin='Laki-laki',CONCAT('<i class=\"fa fa-male\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"',jns_kelamin,'\"></i>'),CONCAT('<i class=\"fa fa-female\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"',jns_kelamin,'\"></i>')) AS jns_kelamin,sts_perkawinan,agama,pendidikan,
							IF(LENGTH(pendidikan)>15,CONCAT('<span style=\"border:none; background:transparent;cursor: pointer;\" data-toggle=\"popover\" data-placement=\"auto right\" data-content=\"',pendidikan,'\">',LEFT(pendidikan,11),'...','</span>'),pendidikan)AS scatpendidikan,
							pekerjaan,tmp_lahir,tgl_lahir,
								  LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-LEFT(tgl_lahir,4) AS umur,
								  LEFT(tgl_lahir,4) AS ta_lahir,
								  MID(tgl_lahir,6,2) AS b_lahir,
								  RIGHT(tgl_lahir,2) AS t_lahir,
       							  MID(DATE_FORMAT(NOW(),'%Y%m%d'),5,2) AS b_post,
       							  RIGHT(DATE_FORMAT(NOW(),'%Y%m%d'),2) AS t_post,
       							  date_created,IF(username!='',1,0)AND IF(password!='',1,0) AS user_active,
       							  CONCAT(RIGHT(tgl_lahir,2),'-',MID(tgl_lahir,6,2),'-',LEFT(tgl_lahir,4)) AS tgllahir,
       							  IF(LENGTH(pekerjaan)>15,CONCAT('<span style=\"border:none; background:transparent;cursor: pointer;\" data-toggle=\"popover\" data-placement=\"auto left\" data-content=\"',pekerjaan,'\">',LEFT(pekerjaan,11),'...','</span>'),pekerjaan)AS scatpekerjaan
								 ")
                        ->where('deleted=0')
						->order_by('date_created',$this->_orderby)
						->get($this->_table,$number,$offset);
		return $query->result();
	}
	function jumlah_data(){  //jang pagination
		return $this->db
            ->select('id')
            ->where('deleted=0')
            ->get($this->_table)
            ->num_rows();
	}
	public function jumlah_data_cari(){  //jang pagination
        $datacari = (trim($this->input->post('cari')))? trim($this->input->post('cari')) : '';
        $datacari = ($this->uri->segment(3)) ? $this->uri->segment(3) : $datacari;
        $arr_kalimat = explode("%", $datacari);
        foreach ($arr_kalimat as $v) {
            if(substr($v,0,2)=="20"){
                $t = substr($v, 2);
            }
            else{
                $t = $v;
            }
            if(empty($tampil)){
                $tampil = $t;
            }
            else{
                $tampil = $tampil." ".$t;
            }                   
        }
        $data = count($arr_kalimat);
        if($data>1){
            return $this->db
                        ->select('id')
                        ->where('deleted=0')
                        ->where("(nm_lengkap like'%".$tampil."%'OR NIK like'%".$tampil."%' OR agama like'%".$tampil."%' OR sts_perkawinan like'%".$tampil."%' OR pendidikan like'%".$tampil."%' OR pekerjaan like'%".$tampil."%' OR jns_kalamin like'%".$tampil."%')")
                        ->get($this->_table)
                        ->num_rows();
        }
        else{
            return $this->db
                        ->select('id')
                        ->where('deleted=0')
                        ->where("(nm_lengkap like'%".$datacari."%'OR NIK like'%".$datacari."%' OR agama like'%".$datacari."%' OR sts_perkawinan like'%".$datacari."%' OR pendidikan like'%".$datacari."%' OR pekerjaan like'%".$datacari."%' OR jns_kelamin like'%".$datacari."%')")
                        ->get($this->_table)
                        ->num_rows();
        }
  	}
	public function get_cari($number,$offset){
	  $datacari = (trim($this->input->post('cari')))? trim($this->input->post('cari')) : '';
	  $datacari = ($this->uri->segment(3)) ? $this->uri->segment(3) : $datacari;

	  $arr_kalimat = explode("%", $datacari);
	  foreach ($arr_kalimat as $v) {
			if(substr($v,0,2)=="20"){
			    $t = substr($v, 2); 
			}
			else{
			  	$t = $v;
			}
			if(empty($tampil)){
			 	 $tampil = $t;
			}
			else{
			  	$tampil = $tampil." ".$t;
			}                   
	  }
	  $data = count($arr_kalimat);
	  if($data>1){
	        $query = $this->db->select("id,NIK,nm_lengkap,IF(LENGTH(nm_lengkap)>15,CONCAT('<span style=\"border:none; background:transparent;cursor: pointer;\" data-toggle=\"popover\" data-placement=\"auto right\" data-content=\"',nm_lengkap,'\">',LEFT(nm_lengkap,11),'...','</span>'),nm_lengkap)AS scat,IF(jns_kelamin='Laki-laki',CONCAT('<i class=\"fa fa-male\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"',jns_kelamin,'\"></i>'),CONCAT('<i class=\"fa fa-female\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"',jns_kelamin,'\"></i>')) AS jns_kelamin,sts_perkawinan,agama,pendidikan,IF(LENGTH(pendidikan)>15,CONCAT('<span style=\"border:none; background:transparent;cursor: pointer;\" data-toggle=\"popover\" data-placement=\"auto right\" data-content=\"',pendidikan,'\">',LEFT(pendidikan,11),'...','</span>'),pendidikan)AS scatpendidikan,pekerjaan,tmp_lahir,tgl_lahir,
	                                    LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-LEFT(tgl_lahir,4) AS umur,
	                                    LEFT(tgl_lahir,4) AS ta_lahir,
	                                    MID(tgl_lahir,6,2) AS b_lahir,
	                                    RIGHT(tgl_lahir,2) AS t_lahir,
	                                    MID(DATE_FORMAT(NOW(),'%Y%m%d'),5,2) AS b_post,
	                                    RIGHT(DATE_FORMAT(NOW(),'%Y%m%d'),2) AS t_post,
	                                    date_created, IF(username!='',1,0)AND IF(password!='',1,0) AS user_active,
	                                    CONCAT(RIGHT(tgl_lahir,2),'-',MID(tgl_lahir,6,2),'-',LEFT(tgl_lahir,4)) AS tgllahir,
	                                    IF(LENGTH(pekerjaan)>15,CONCAT('<span style=\"border:none; background:transparent;cursor: pointer;\" data-toggle=\"popover\" data-placement=\"auto left\" data-content=\"',pekerjaan,'\">',LEFT(pekerjaan,11),'...','</span>'),pekerjaan)AS scatpekerjaan
	                                    ")
	                          ->where("(deleted = 0)")
	                          ->where("(nm_lengkap like '%".$tampil."%' OR NIK like '%".$tampil."%' OR agama like'%".$tampil."%' OR sts_perkawinan like'%".$tampil."%' OR pendidikan like'%".$tampil."%' OR pekerjaan like'%".$tampil."%' OR jns_kalamin like'%".$tampil."%')")
	                          ->order_by("date_created", $this->_orderby)
	                          ->get($this->_table,$number,$offset);
	        return $query->result();
	    }
	    else{
	        $query = $this->db->select("id,NIK,nm_lengkap,IF(LENGTH(nm_lengkap)>15,CONCAT('<span style=\"border:none; background:transparent;cursor: pointer;\" data-toggle=\"popover\" data-placement=\"auto right\" data-content=\"',nm_lengkap,'\">',LEFT(nm_lengkap,11),'...','</span>'),nm_lengkap)AS scat,IF(jns_kelamin='Laki-laki',CONCAT('<i class=\"fa fa-male\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"',jns_kelamin,'\"></i>'),CONCAT('<i class=\"fa fa-female\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"',jns_kelamin,'\"></i>')) AS jns_kelamin,sts_perkawinan,agama,pendidikan,IF(LENGTH(pendidikan)>15,CONCAT('<span style=\"border:none; background:transparent;cursor: pointer;\" data-toggle=\"popover\" data-placement=\"auto right\" data-content=\"',pendidikan,'\">',LEFT(pendidikan,11),'...','</span>'),pendidikan)AS scatpendidikan,pekerjaan,tmp_lahir,tgl_lahir,
	                                    LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-LEFT(tgl_lahir,4) AS umur,
	                                    LEFT(tgl_lahir,4) AS ta_lahir,
	                                    MID(tgl_lahir,6,2) AS b_lahir,
	                                    RIGHT(tgl_lahir,2) AS t_lahir,
	                                    MID(DATE_FORMAT(NOW(),'%Y%m%d'),5,2) AS b_post,
	                                    RIGHT(DATE_FORMAT(NOW(),'%Y%m%d'),2) AS t_post,
	                                    date_created, IF(username!='',1,0)AND IF(password!='',1,0) AS user_active,
	                                    CONCAT(RIGHT(tgl_lahir,2),'-',MID(tgl_lahir,6,2),'-',LEFT(tgl_lahir,4)) AS tgllahir,
	                                    IF(LENGTH(pekerjaan)>15,CONCAT('<span style=\"border:none; background:transparent;cursor: pointer;\" data-toggle=\"popover\" data-placement=\"auto left\" data-content=\"',pekerjaan,'\">',LEFT(pekerjaan,11),'...','</span>'),pekerjaan)AS scatpekerjaan
	                                    ")
	                          ->where("(deleted = 0)")
	                          ->where("(nm_lengkap like '%".$datacari."%' OR NIK like '%".$datacari."%' OR agama like'%".$datacari."%' OR sts_perkawinan like'%".$datacari."%' OR pendidikan like'%".$datacari."%' OR pekerjaan like'%".$datacari."%' OR jns_kelamin like'%".$datacari."%')")
	                          ->order_by("date_created", $this->_orderby)
	                          ->get($this->_table,$number,$offset);
	        return $query->result();
	    }  
	}
	public function insert(){
		$name = strtolower($this->input->post('nm_lengkap'));
		$tempat = strtolower($this->input->post('tmp_lahir'));
		
		


		$hari = substr($this->input->post('tgl_lahir'),0,2);
        $bulan = substr($this->input->post('tgl_lahir'), 3,2);
        $tahun = substr($this->input->post('tgl_lahir'),6);

        $insert_users = array(
                          'id'               => 'U-'.get_uuid(),
      					  'nik'              => $this->input->post('nik'),
                          'nm_lengkap'       => ucwords($name),
                          'tmp_lahir'        => ucwords($tempat),
                          'tgl_lahir'        => "$tahun-$bulan-$hari",
                          'jns_kelamin'      => $this->input->post('jns_kelamin'),
                          'agama'            => $this->input->post('agama'),
                          'sts_perkawinan'   => $this->input->post('sts_perkawinan'),
                          'pendidikan'       => $this->input->post('pendidikan'),
                          'pekerjaan'        => $this->input->post('pekerjaan'),
                          'date_created'     => date("Y-m-d H:i:s", time()),
                          'created_by'       => $this->session->userdata('id'),
                          'deleted'          => 0
                          );
        $this->db->insert($this->_table,$insert_users);


	}
	public function get_id($user_id){
    	$query = $this->db
    					->select('id,NIK,
                                    nm_lengkap,
                                    jns_kelamin,
                                    tgl_lahir,
                                    tmp_lahir,
                                    LEFT(DATE_FORMAT(NOW(),"%Y%m%d"),4)-LEFT(tgl_lahir,4) AS umur,
                                    LEFT(tgl_lahir,4) AS ta_lahir,
                                    MID(tgl_lahir,6,2) AS b_lahir,
                                    RIGHT(tgl_lahir,2) AS t_lahir,
                                    MID(DATE_FORMAT(NOW(),"%Y%m%d"),5,2) AS b_post,
                                    RIGHT(DATE_FORMAT(NOW(),"%Y%m%d"),2) AS t_post,
                                    agama,
                                    pekerjaan,
                                    sts_perkawinan,
                                    RIGHT(tgl_lahir,2) AS Tanggal,
                                    MID(tgl_lahir,6,2) AS Bulan,
                                    LEFT(tgl_lahir,4) AS Tahun ')
    					->where('id',$user_id)
    					->get($this->_table);
		return $query;
	}



}
?>