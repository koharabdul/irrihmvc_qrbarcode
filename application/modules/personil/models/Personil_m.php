<?php defined('BASEPATH') or exit('No direct script access allowed');
class Personil_m extends CI_Model{
	public function get_personil($number,$offset){
		$query = $this->db
						->select('t_personil.id,t_personil.NIK,t_personil.nm_lengkap,t_personil.jns_kelamin,
                                  t_personil.alamat,LPAD(t_personil.rt,3,"0") AS rt, 
                                  LPAD(t_personil.rw,3,"0") AS rw,t_desa.nm_desa,
								  LEFT(DATE_FORMAT(NOW(),"%Y%m%d"),4)-LEFT(t_personil.tgl_lahir,4) AS umur,
								  LEFT(t_personil.tgl_lahir,4) AS ta_lahir,
								  MID(t_personil.tgl_lahir,6,2) AS b_lahir,
								  RIGHT(t_personil.tgl_lahir,2) AS t_lahir,
       							  MID(DATE_FORMAT(NOW(),"%Y%m%d"),5,2) AS b_post,
       							  RIGHT(DATE_FORMAT(NOW(),"%Y%m%d"),2) AS t_post
								 ')
						->from('t_desa')
						->where('t_personil.id_desa=t_desa.id')
                        ->where('t_personil.deleted=0')
						->order_by('t_personil.date_created','DESC')
						->get('t_personil',$number,$offset);
		return $query->result();
	}
	function jumlah_data(){  //jang pagination
		return $this->db
            ->select('id')
            ->where('deleted=0')
            ->get('t_personil')
            ->num_rows();
	}
	public function get_dropdowndesa(){
        $query = $this->db->get('t_desa');
        $result = $query->result();

        $desa_id = array('');
        $desa_nama = array('...');
        
        for ($i = 0; $i < count($result); $i++)
        {
            array_push($desa_id, $result[$i]->id);
            array_push($desa_nama, $result[$i]->nm_desa);
        }
        return array_combine($desa_id, $desa_nama);
    }
    public function get_id($personil_id){
    	$query = $this->db
    					->select('t_personil.NIK,
                                    t_personil.nm_lengkap,
                                    t_personil.jns_kelamin,
                                    t_personil.tgl_lahir,
                                    t_personil.tmp_lahir,
                                    LEFT(DATE_FORMAT(NOW(),"%Y%m%d"),4)-LEFT(t_personil.tgl_lahir,4) AS umur,
                                    LEFT(t_personil.tgl_lahir,4) AS ta_lahir,
                                    MID(t_personil.tgl_lahir,6,2) AS b_lahir,
                                    RIGHT(t_personil.tgl_lahir,2) AS t_lahir,
                                    MID(DATE_FORMAT(NOW(),"%Y%m%d"),5,2) AS b_post,
                                    RIGHT(DATE_FORMAT(NOW(),"%Y%m%d"),2) AS t_post,
                                    t_personil.agama,
                                    t_personil.pekerjaan,
                                    t_personil.sts_perkawinan,
                                    t_desa.nm_desa,
                                    t_desa.kecamatan,
                                    t_desa.kabupaten, 
                                    LPAD(t_personil.rt,3,"0") AS rt,
                                    LPAD(t_personil.rw,3,"0") AS rw,
                                    t_personil.alamat,
                                    t_personil.id AS id_p, 
                                    RIGHT(t_personil.tgl_lahir,2) AS Tanggal,
                                    MID(t_personil.tgl_lahir,6,2) AS Bulan,
                                    LEFT(t_personil.tgl_lahir,4) AS Tahun ')
    					->from('t_personil')
    					->where('t_personil.id_desa=t_desa.id')
    					->where('t_personil.id',$personil_id)
    					->get('t_desa');
		return $query;
	}
    public function edit_id($personil_id){
        $query = $this->db
                        ->select('t_personil.NIK,
                                    t_personil.nm_lengkap,
                                    t_personil.jns_kelamin,
                                    t_personil.tgl_lahir,
                                    t_personil.tmp_lahir,
                                    LEFT(DATE_FORMAT(NOW(),"%Y%m%d"),4)-LEFT(t_personil.tgl_lahir,4) AS umur,
                                    LEFT(t_personil.tgl_lahir,4) AS ta_lahir,
                                    MID(t_personil.tgl_lahir,6,2) AS b_lahir,
                                    RIGHT(t_personil.tgl_lahir,2) AS t_lahir,
                                    MID(DATE_FORMAT(NOW(),"%Y%m%d"),5,2) AS b_post,
                                    RIGHT(DATE_FORMAT(NOW(),"%Y%m%d"),2) AS t_post,
                                    t_personil.agama,
                                    t_personil.pekerjaan,
                                    t_personil.sts_perkawinan,
                                    t_desa.id AS id_d,
                                    t_desa.nm_desa,
                                    t_desa.kecamatan,
                                    t_desa.kabupaten, 
                                    t_personil.rt,
                                    t_personil.rw,
                                    t_personil.alamat,
                                    t_personil.id AS id_p, 
                                    RIGHT(t_personil.tgl_lahir,2) AS Tanggal,
                                    MID(t_personil.tgl_lahir,6,2) AS Bulan,
                                    LEFT(t_personil.tgl_lahir,4) AS Tahun ')
                        ->from('t_personil')
                        ->where('t_personil.id_desa=t_desa.id')
                        ->where('t_personil.id',$personil_id)
                        ->get('t_desa');
        return $query;
    }
    
    public function remove_checked(){
        $delete = $this->input->post('table_records');
        for ($i=0; $i < count($delete); $i++){
            $datapenduduk = array('deleted'=>'1');
            $this->db->where('id', $delete[$i]);
            $this->db->update('t_personil',$datapenduduk);
        }
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
                        ->where("deleted=0")
                        ->where("(nm_lengkap like '%".$tampil."%'OR NIK like'%".$tampil."%')")
                        ->get("t_personil")
                        ->num_rows();
        }
        else{
            return $this->db
                        ->select('id')
                        ->where("deleted=0")
                        ->where("(nm_lengkap like '%".$datacari."%'OR NIK like'%".$datacari."%')")
                        ->get("t_personil")
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
            $query = $this->db->select("t_personil.id,t_personil.NIK,t_personil.nm_lengkap,t_personil.jns_kelamin,
                                        t_personil.alamat,LPAD(t_personil.rt,3,'0') AS rt, 
                                        LPAD(t_personil.rw,3,'0') AS rw,t_desa.nm_desa,
                                        LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-LEFT(t_personil.tgl_lahir,4) AS umur,
                                        LEFT(t_personil.tgl_lahir,4) AS ta_lahir,
                                        MID(t_personil.tgl_lahir,6,2) AS b_lahir,
                                        RIGHT(t_personil.tgl_lahir,2) AS t_lahir,
                                        MID(DATE_FORMAT(NOW(),'%Y%m%d'),5,2) AS b_post,
                                        RIGHT(DATE_FORMAT(NOW(),'%Y%m%d'),2) AS t_post
                                        ")
                              ->from("t_desa")
                              ->where("(t_personil.id_desa=t_desa.id AND t_personil.deleted = 0)")
                              ->where("(t_personil.nm_lengkap like '%".$tampil."%' OR t_personil.NIK like '%".$tampil."%')")
                              ->order_by("t_personil.date_created", "DESC")
                              ->get("t_personil",$number,$offset);
            return $query->result();

        }
        else{
            $query = $this->db->select("t_personil.id,t_personil.NIK,t_personil.nm_lengkap,t_personil.jns_kelamin,
                                        t_personil.alamat,LPAD(t_personil.rt,3,'0') AS rt, 
                                        LPAD(t_personil.rw,3,'0') AS rw,t_desa.nm_desa,
                                        LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-LEFT(t_personil.tgl_lahir,4) AS umur,
                                        LEFT(t_personil.tgl_lahir,4) AS ta_lahir,
                                        MID(t_personil.tgl_lahir,6,2) AS b_lahir,
                                        RIGHT(t_personil.tgl_lahir,2) AS t_lahir,
                                        MID(DATE_FORMAT(NOW(),'%Y%m%d'),5,2) AS b_post,
                                        RIGHT(DATE_FORMAT(NOW(),'%Y%m%d'),2) AS t_post
                                        ")
                              ->from("t_desa")
                              ->where("(t_personil.id_desa=t_desa.id AND t_personil.deleted = 0)")
                              ->where("(t_personil.nm_lengkap like '%".$datacari."%' OR t_personil.NIK like '%".$datacari."%')")
                              ->order_by("t_personil.date_created", "DESC")
                              ->get("t_personil",$number,$offset);
            return $query->result();
        }  
    }

    public function edit_desa(){
        $query = $this->db
                       ->select('id,nm_desa')
                       ->get('t_desa');
        return $query->result();
    }


    public function cek_input($no_nik){
        $query = $this->db
                        ->select('NIK,nm_lengkap,username')
                        ->where('NIK',$no_nik)
                        ->get('t_personil');
        return $query->result();
    }




    

}
?>