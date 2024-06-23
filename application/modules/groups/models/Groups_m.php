<?php defined('BASEPATH') or exit('No direct script access allowed');
class Groups_m extends CI_Model
{
	public function get_groups($number,$offset){
    $this->db->query("SET SESSION group_concat_max_len = 1000000;");
		$query = $this->db
						->select("t_groups.*,
								(SELECT COUNT(t_group_pages.page_id) FROM t_pages,t_group_pages WHERE t_pages.id=t_group_pages.page_id AND t_group_pages.group_id=t_groups.id AND t_pages.deleted='0') AS pages,
                (SELECT GROUP_CONCAT(CONCAT(t_pages.name,' (<i style=\"text-decoration:underline;color:green;\">',t_pages.uri,'</i>)')SEPARATOR ', <br>') FROM t_pages,t_group_pages WHERE t_pages.id=t_group_pages.page_id AND t_group_pages.group_id=t_groups.id AND t_pages.deleted='0') AS allpage
							")
            ->where('t_groups.deleted=0')
						->order_by('t_groups.date_created','ASC')
						->get('t_groups',$number,$offset);
		return $query->result();
	}
	function jumlah_data_groups(){  //jang pagination
		return $this->db
            ->select("t_groups.*,
								(SELECT COUNT(t_group_pages.page_id) FROM t_pages,t_group_pages WHERE t_pages.id=t_group_pages.page_id AND t_group_pages.group_id=t_groups.id AND t_pages.deleted='0') AS pages,
                (SELECT GROUP_CONCAT(CONCAT(t_pages.name,' (<i style=\"text-decoration:underline;color:green;\">',t_pages.uri,'</i>)')SEPARATOR ', <br>') FROM t_pages,t_group_pages WHERE t_pages.id=t_group_pages.page_id AND t_group_pages.group_id=t_groups.id AND t_pages.deleted='0') AS allpage
							")
            ->where('t_groups.deleted=0')
			->order_by('t_groups.date_created','ASC')
			->get('t_groups')
			->num_rows();
	}
	public function get_dropdownpages(){
		$query = $this->db->select('id,name')
						  ->order_by('name','ASC')
						  ->where('deleted','0')
						  ->get('t_pages');
		$result = $query->result();

		$groups_id = array();
		$groups_name = array();

		for ($i = 0; $i < count($result); $i++)
		{
		  array_push($groups_id, $result[$i]->id);
		  array_push($groups_name, $result[$i]->name);
		}
		return array_combine($groups_id, $groups_name);
	}
	public function cek_name($name){
		$query = $this->db
                      ->select('id,name')
                      ->where('deleted',0)
                      ->where('name',$name)
                      ->get('t_groups');
      	return $query->result();

	}
	public function SaveAdd(){
		    $name = $this->input->post('name');
        $description = $this->input->post('description');
        $active = $this->input->post('active');
        $pages = $this->input->post('pages');
        $landing_page = $this->input->post('landing_page');
        
        if($active=='1'){
          $prsactive = 1;
        }else{
          $prsactive = 0;
        }
        $cekinput = $this->cek_name($name);
        if(count($cekinput)==0){
          	$datainput = array(
  	              'id' => 'GP-'.get_uuid(),
  	              'name' => ucwords(strtolower($name)),
  	              'description' => ucwords(strtolower($description)),
  	              'landing_page' => ucwords(strtolower($landing_page)),
  	              'active' => $prsactive,
  	              'date_created' => date("Y-m-d H:i:s", time()),
  	              'created_by' => $this->session->userdata('id')
  	           );
  	        $this->db->insert('t_groups',$datainput);
  	        ////////////////////////////////////////////////////////////////
  	        for ($j=0; $j < count($pages); $j++){
          				$datagroup = array(
          				  'page_id' => $pages[$j],
          				  'group_id' => $datainput['id'],
          				  'created_by' => $this->session->userdata('id'),
          				  'date_created' => date("Y-m-d H:i:s", time())
          				);
          				$this->db->insert('t_group_pages',$datagroup);
            }
              $this->session->set_flashdata("infosave","<script>
                                                           setTimeout(function() {
                                                             toastr.options = {
                                                                    'closeButton': true,
                                                                    'debug': false,
                                                                    'progressBar': true,
                                                                    'preventDuplicates': false,
                                                                    'positionClass': 'toast-top-right',
                                                                    'onclick': null,
                                                                    'showDuration': '400',
                                                                    'hideDuration': '1000',
                                                                    'timeOut': '4000',
                                                                    'extendedTimeOut': '1000',
                                                                    'showEasing': 'swing',
                                                                    'hideEasing': 'linear',
                                                                    'showMethod': 'fadeIn',
                                                                    'hideMethod': 'fadeOut'
                                                              };
                                                              toastr.success('Input Data Sukses', 'Data Berhasil Disimpan!');
                                                          }, 1300);
                                                          </script>
                                                        ");

        }
        else{
            $this->session->set_flashdata("infosave","<script>
                                                     setTimeout(function() {
                                                       toastr.options = {
                                                            'closeButton': true,
                                                            'debug': false,
                                                            'progressBar': true,
                                                            'preventDuplicates': false,
                                                            'positionClass': 'toast-top-right',
                                                            'onclick': null,
                                                            'showDuration': '400',
                                                            'hideDuration': '1000',
                                                            'timeOut': '4000',
                                                            'extendedTimeOut': '1000',
                                                            'showEasing': 'swing',
                                                            'hideEasing': 'linear',
                                                            'showMethod': 'show',
                                                            'hideMethod': 'fadeOut'
                                                        };
                                                        toastr.error('Silahkan Cek Kembali', 'Nama Ada yang Sama!');
                                                    }, 1300);
                                                    </script>
                                                  ");
        } 

	}
	public function select_groups(){
        $query = $this->db
            ->select("t_groups.*,
								(SELECT COUNT(t_group_pages.page_id) FROM t_pages,t_group_pages WHERE t_pages.id=t_group_pages.page_id AND t_group_pages.group_id=t_groups.id AND t_pages.deleted='0') AS pages
					")
            ->where('t_groups.deleted=0')
			->order_by('t_groups.date_created','ASC')
            ->get('t_groups');
        return $query->result();
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
                        ->where("(name like '%".$tampil."%'OR description like'%".$tampil."%' OR landing_page like'%".$tampil."%')")
                        ->get("t_groups")
                        ->num_rows();
        }
        else{
            return $this->db
                        ->select('id')
                        ->where("deleted=0")
                        ->where("(name like '%".$datacari."%'OR description like'%".$datacari."%' OR landing_page like'%".$datacari."%')")
                        ->get("t_groups")
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
            $this->db->query("SET SESSION group_concat_max_len = 1000000;");            
            $query = $this->db
	                        ->select("t_groups.*,
									                   (SELECT COUNT(t_group_pages.page_id) FROM t_pages,t_group_pages WHERE t_pages.id=t_group_pages.page_id AND t_group_pages.group_id=t_groups.id AND t_pages.deleted='0') AS pages,
                                     (SELECT GROUP_CONCAT(CONCAT(t_pages.name,' (<i style=\"text-decoration:underline;color:green;\">',t_pages.uri,'</i>)')SEPARATOR ', <br>') FROM t_pages,t_group_pages WHERE t_pages.id=t_group_pages.page_id AND t_group_pages.group_id=t_groups.id AND t_pages.deleted='0') AS allpage")
	                        ->where("(name like '%".$tampil."%'OR description like'%".$tampil."%' OR landing_page like'%".$tampil."%')")
	                        ->where('t_groups.deleted=0')
							->order_by('t_groups.date_created','ASC')
							->get('t_groups',$number,$offset);
            return $query->result();

        }
        else{
            $this->db->query("SET SESSION group_concat_max_len = 1000000;");
            $query = $this->db
	                        ->select("t_groups.*,
									                   (SELECT COUNT(t_group_pages.page_id) FROM t_pages,t_group_pages WHERE t_pages.id=t_group_pages.page_id AND t_group_pages.group_id=t_groups.id AND t_pages.deleted='0') AS pages,
                                     (SELECT GROUP_CONCAT(CONCAT(t_pages.name,' (<i style=\"text-decoration:underline;color:green;\">',t_pages.uri,'</i>)')SEPARATOR ', <br>') FROM t_pages,t_group_pages WHERE t_pages.id=t_group_pages.page_id AND t_group_pages.group_id=t_groups.id AND t_pages.deleted='0') AS allpage")
	                        ->where("(name like '%".$datacari."%'OR description like'%".$datacari."%' OR landing_page like'%".$datacari."%')")
	                        ->where('t_groups.deleted=0')
							->order_by('t_groups.date_created','ASC')
							->get('t_groups',$number,$offset);
            return $query->result();
        }  
    }
  public function remove_checked(){
      $delete = $this->input->post('table_records');
      var_dump($delete);
      die();
      $jumlahdata = count($delete);       
      for ($i=0; $i < count($delete); $i++){
          $data = array('deleted'=>'1',
                        'date_modified'=>date("Y-m-d H:i:s", time()),
                        'modified_by'=>$this->session->userdata('id'));
          $this->db->where('id', $delete[$i]);
          $this->db->update('t_groups',$data);
          $this->db->where('group_id', $delete[$i]);
          $this->db->update('t_group_pages',$data);
          $this->session->set_flashdata("infodeleted","<script>
                                                       setTimeout(function() {
                                                          toastr.options = {
                                                            'closeButton': true,
                                                            'debug': false,
                                                            'progressBar': true,
                                                            'preventDuplicates': false,
                                                            'positionClass': 'toast-bottom-left',
                                                            'onclick': null,
                                                            'showDuration': '400',
                                                            'hideDuration': '1000',
                                                            'timeOut': '4000',
                                                            'extendedTimeOut': '1000',
                                                            'showEasing': 'swing',
                                                            'hideEasing': 'linear',
                                                            'showMethod': 'fadeIn',
                                                            'hideMethod': 'fadeOut'
                                                          }
                                                          toastr.info('Berhasil Dihapus', '$jumlahdata Data Terpilih');
                                                      }, 1300);
                                                      </script>
                                                    ");
      }
  }
  public function view_edit($groups_id){
      $query = $this->db
                      ->select("t_groups.*,t_personil.nm_lengkap,
                                  (SELECT GROUP_CONCAT(CONCAT(t_pages.name) SEPARATOR ', ') 
                                   FROM t_group_pages, t_pages
                                         WHERE t_groups.id = t_group_pages.group_id 
                                         AND t_group_pages.page_id = t_pages.id
                                         AND t_group_pages.deleted='0'
                                         GROUP BY t_group_pages.group_id) datapage,
                                  (SELECT COUNT(t_pages.name) 
                                   FROM t_group_pages, t_pages
                                         WHERE t_groups.id = t_group_pages.group_id 
                                         AND t_group_pages.page_id = t_pages.id
                                         AND t_group_pages.deleted='0'
                                         GROUP BY t_group_pages.group_id) countgroups")
                      ->from('t_personil')
                      ->where('t_groups.created_by=t_personil.id')
                      ->where('t_groups.id',$groups_id)
                      ->get('t_groups');
      return $query;
  }
  public function getselectpages($groups_id){
      $query = $this->db
                      ->select("t_pages.id,t_pages.name,
                                (SELECT GROUP_CONCAT(CONCAT(t_groups.name) SEPARATOR ', ') 
                                                   FROM t_groups,t_group_pages 
                                                   WHERE t_groups.id=t_group_pages.group_id 
                                                   AND t_group_pages.page_id=t_pages.id 
                                                   AND t_groups.deleted='0'
                                                   AND t_group_pages.group_id = '".$groups_id."') AS groups")
                      ->where('t_pages.deleted',0)
                      ->order_by('t_pages.name','ASC')
                      ->get('t_pages');
      return $query->result();

  }
  public function view_mdfi($groups_id){
      $query = $this->db
                      ->select('t_groups.modified_by, t_personil.nm_lengkap')
                      ->from('t_personil')
                      ->where('t_groups.modified_by=t_personil.id')
                      ->where('t_groups.id',$groups_id)
                      ->get('t_groups');
      return $query;
  }
  public function saveupdate($groups_id){
      $name = $this->input->post('name');
      $description = $this->input->post('description');
      $landing_page = $this->input->post('landing_page');
      $active = $this->input->post('active');
      $pages = $this->input->post('pages');
      
      if($active=='1'){
        $prsactive = 1;
      }else{
        $prsactive = 0;
      }
      $this->db->where('group_id',$groups_id);
      $this->db->delete('t_group_pages');

      $datagetcreate = $this->db->select('*')
                                ->where('id',$groups_id)
                                ->get('t_groups')->row_array();
      $result = $datagetcreate;//jang nunda tanggal nu awal jadi dipakai


      $datapages = array('name' => ucwords(strtolower($name)),
                            'description' => ucwords(strtolower($description)),
                            'landing_page' => ucwords(strtolower($landing_page)),
                            'active' => $prsactive,
                            'date_modified' => date("Y-m-d H:i:s", time()),
                            'modified_by' => $this->session->userdata('id'));
      $this->db->where('id',$groups_id);
      $this->db->update('t_groups',$datapages);


      for ($j=0; $j < count($pages); $j++)
      {
          $datagroup = array(
              'group_id' => $groups_id,
              'page_id' => $pages[$j],
              'created_by' => $result['created_by'],
              'date_created' => $result['date_created'],
              'modified_by' => $this->session->userdata('id'),
              'date_modified' => date("Y-m-d H:i:s", time())
          );
          $this->db->insert('t_group_pages',$datagroup);
      }
      

      
      
  }
  public function dlt($groups_id){
      $data = array('deleted'=>'1');
      $this->db->where('id', $groups_id);
      $this->db->update('t_groups',$data);

      $this->db->where('group_id',$groups_id);
      $this->db->update('t_group_pages',$data);
      $this->session->set_flashdata("infosave","<script>
                                                       setTimeout(function() {
                                                         toastr.options = {
                                                                'closeButton': true,
                                                                'debug': false,
                                                                'progressBar': true,
                                                                'preventDuplicates': false,
                                                                'positionClass': 'toast-top-right',
                                                                'onclick': null,
                                                                'showDuration': '400',
                                                                'hideDuration': '1000',
                                                                'timeOut': '4000',
                                                                'extendedTimeOut': '1000',
                                                                'showEasing': 'swing',
                                                                'hideEasing': 'linear',
                                                                'showMethod': 'fadeIn',
                                                                'hideMethod': 'fadeOut'
                                                          };
                                                          toastr.success('Berhasil Dihapus', 'Data Tersebut!');
                                                      }, 1300);
                                                      </script>
                                                    ");

  }




}
?>