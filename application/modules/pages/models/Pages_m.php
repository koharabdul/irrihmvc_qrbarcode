<?php defined('BASEPATH') or exit('No direct script access allowed');
class Pages_m extends CI_Model
{
	public function get_pages($number,$offset){
    // $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
		$query = $this->db
						->select("t_pages.id,t_pages.`name`,t_pages.uri,t_pages.active,t_pages.date_created,
                        (SELECT GROUP_CONCAT(CONCAT('<button class=\"btn btn-primary btn-xs\" type=\"button\" style=\"padding-bottom:0px; padding-top:0px; margin-bottom:0px;\">',t_groups.name,'</button>') SEPARATOR ' ') 
                        FROM t_group_pages, t_groups
                        WHERE t_group_pages.page_id=t_pages.id 
                        AND t_group_pages.group_id=t_groups.id
                        AND t_group_pages.deleted='0'
                        GROUP BY t_group_pages.page_id ORDER BY t_groups.name ASC) AS countpage")
            ->where('deleted',0)
            ->order_by('name','ASC')
						->get('t_pages',$number,$offset);

		return $query->result();
	}
	public function jumlah_data_pages(){  //jang pagination
		return $this->db
          ->select("t_pages.id,t_pages.`name`,t_pages.uri,t_pages.active,t_pages.date_created,
                        (SELECT GROUP_CONCAT(CONCAT(t_groups.name) SEPARATOR ' ') 
                        FROM t_group_pages, t_groups
                        WHERE t_group_pages.page_id=t_pages.id 
                        AND t_group_pages.group_id=t_groups.id
                        AND t_group_pages.deleted='0'
                        GROUP BY t_group_pages.page_id ORDER BY t_groups.name ASC) AS countpage")
          ->where('deleted',0)
          ->order_by('name','ASC')
          ->get('t_pages')
          ->num_rows();
	}
  public function input_multiple(){
      $activewe = $this->input->post('active');
      $name = $this->input->post('name');
      $uri = $this->input->post('uri');
      $group = $this->input->post('group');
      for ($i=0; $i < count($activewe); $i++){
          if(($uri[$i]=='')or($name[$i]=='')or($activewe[$i]==0)or(($uri[$i]=='')and($name[$i]=='')and($activewe[$i]==0))){
              $this->session->set_flashdata("infosave","<script>
                                                             setTimeout(function() {
                                                               toastr.options = {
                                                                    'closeButton': true,
                                                                    'debug': false,
                                                                    'progressBar': true,
                                                                    'preventDuplicates': false,
                                                                    'positionClass': 'toast-top-left',
                                                                    'onclick': null,
                                                                    'showDuration': '400',
                                                                    'hideDuration': '1000',
                                                                    'timeOut': '4000',
                                                                    'extendedTimeOut': '1000',
                                                                    'showEasing': 'swing',
                                                                    'hideEasing': 'linear',
                                                                    'showMethod': 'slideDown',
                                                                    'hideMethod': 'fadeOut'
                                                                };
                                                                toastr.warning('Silahkan Isi Kembali', 'Data Ada yang Kosong!');
                                                            }, 1300);
                                                            </script>
                                                          ");
          }
          else{
              if(count($group)==0){
                  $this->session->set_flashdata("infosave","<script>
                                                             setTimeout(function() {
                                                               toastr.options = {
                                                                    'closeButton': true,
                                                                    'debug': false,
                                                                    'progressBar': true,
                                                                    'preventDuplicates': false,
                                                                    'positionClass': 'toast-top-left',
                                                                    'onclick': null,
                                                                    'showDuration': '400',
                                                                    'hideDuration': '1000',
                                                                    'timeOut': '4000',
                                                                    'extendedTimeOut': '1000',
                                                                    'showEasing': 'swing',
                                                                    'hideEasing': 'linear',
                                                                    'showMethod': 'slideDown',
                                                                    'hideMethod': 'fadeOut'
                                                                };
                                                                toastr.warning('Silahkan Isi Kembali', 'Data Group Ada yang Kosong!');
                                                            }, 1300);
                                                            </script>
                                                          ");

              }
              else{
                  $cekinput = $this->Pages_m->cek_uri($uri[$i]);
                  if(count($cekinput)==0){
                      $datainput = array(
                          'id' => 'PG-'.get_uuid(),
                          'name' => ucwords(strtolower($name[$i])),
                          'uri' => strtolower($uri[$i]),
                          'date_created' => date("Y-m-d H:i:s", time()),
                          'created_by' => $this->session->userdata('id')
                       );
                      $this->db->insert('t_pages',$datainput);
                      // -----------------------------------------------------------------
                      $arraydatapage = array(
                          'id' => 'PG-'.get_uuid(),
                          'name' => $datainput['name'].' - Create',
                          'uri' => $datainput['uri'].'/add',
                          'date_created' => date("Y-m-d H:i:s", time()),
                          'created_by' => $datainput['created_by']
                      );
                      $this->db->insert('t_pages',$arraydatapage);
                      // -----------------------------------------------------------------
                      $arraydatapage2 = array(
                          'id' => 'PG-'.get_uuid(),
                          'name' => $datainput['name'].' - Save Add',
                          'uri' => $datainput['uri'].'/sad',
                          'date_created' => date("Y-m-d H:i:s", time()),
                          'created_by' => $datainput['created_by']
                      );
                      $this->db->insert('t_pages',$arraydatapage2);
                      // -----------------------------------------------------------------
                      $arraydatapage3 = array(
                          'id' => 'PG-'.get_uuid(),
                          'name' => $datainput['name'].' - View',
                          'uri' => $datainput['uri'].'/vew',
                          'date_created' => date("Y-m-d H:i:s", time()),
                          'created_by' => $datainput['created_by']
                      );
                      $this->db->insert('t_pages',$arraydatapage3);
                      // -----------------------------------------------------------------
                      $arraydatapage4 = array(
                          'id' => 'PG-'.get_uuid(),
                          'name' => $datainput['name'].' - Print',
                          'uri' => $datainput['uri'].'/prt',
                          'date_created' => date("Y-m-d H:i:s", time()),
                          'created_by' => $datainput['created_by']
                      );
                      $this->db->insert('t_pages',$arraydatapage4);
                      // -----------------------------------------------------------------
                      $arraydatapage5 = array(
                          'id' => 'PG-'.get_uuid(),
                          'name' => $datainput['name'].' - Delete Multiple',
                          'uri' => $datainput['uri'].'/dlm',
                          'date_created' => date("Y-m-d H:i:s", time()),
                          'created_by' => $datainput['created_by']
                      );
                      $this->db->insert('t_pages',$arraydatapage5);
                      // -----------------------------------------------------------------
                      $arraydatapage6 = array(
                          'id' => 'PG-'.get_uuid(),
                          'name' => $datainput['name'].' - Generate Report',
                          'uri' => $datainput['uri'].'/gnr',
                          'date_created' => date("Y-m-d H:i:s", time()),
                          'created_by' => $datainput['created_by']
                      );
                      $this->db->insert('t_pages',$arraydatapage6);
                      // -----------------------------------------------------------------
                      $arraydatapage7 = array(
                          'id' => 'PG-'.get_uuid(),
                          'name' => $datainput['name'].' - Delete',
                          'uri' => $datainput['uri'].'/dlt',
                          'date_created' => date("Y-m-d H:i:s", time()),
                          'created_by' => $datainput['created_by']
                      );
                      $this->db->insert('t_pages',$arraydatapage7);
                      // -----------------------------------------------------------------
                      $arraydatapage8 = array(
                          'id' => 'PG-'.get_uuid(),
                          'name' => $datainput['name'].' - Update',
                          'uri' => $datainput['uri'].'/edt',
                          'date_created' => date("Y-m-d H:i:s", time()),
                          'created_by' => $datainput['created_by']
                      );
                      $this->db->insert('t_pages',$arraydatapage8);
                      // -----------------------------------------------------------------
                      // -----------------------------------------------------------------
                      // -----------------------------------------------------------------
                      for ($j=0; $j < count($group); $j++)
                      {
                          $datagroup = array(
                              'page_id' => $datainput['id'],
                              'group_id' => $group[$j],
                              'created_by' => $this->session->userdata('id'),
                              'date_created' => date("Y-m-d H:i:s", time())
                          );
                          $this->db->insert('t_group_pages',$datagroup);
                          // -----------------------------------------------------------------
                          $datagroup2 = array(
                              'page_id' => $arraydatapage['id'],
                              'group_id' => $group[$j],
                              'created_by' => $this->session->userdata('id'),
                              'date_created' => date("Y-m-d H:i:s", time())
                          );
                          $this->db->insert('t_group_pages',$datagroup2);
                          // -----------------------------------------------------------------
                          $datagroup3 = array(
                              'page_id' => $arraydatapage2['id'],
                              'group_id' => $group[$j],
                              'created_by' => $this->session->userdata('id'),
                              'date_created' => date("Y-m-d H:i:s", time())
                          );
                          $this->db->insert('t_group_pages',$datagroup3);
                          // -----------------------------------------------------------------
                          $datagroup4 = array(
                              'page_id' => $arraydatapage3['id'],
                              'group_id' => $group[$j],
                              'created_by' => $this->session->userdata('id'),
                              'date_created' => date("Y-m-d H:i:s", time())
                          );
                          $this->db->insert('t_group_pages',$datagroup4);
                          // -----------------------------------------------------------------
                          $datagroup5 = array(
                              'page_id' => $arraydatapage4['id'],
                              'group_id' => $group[$j],
                              'created_by' => $this->session->userdata('id'),
                              'date_created' => date("Y-m-d H:i:s", time())
                          );
                          $this->db->insert('t_group_pages',$datagroup5);
                          // -----------------------------------------------------------------
                          $datagroup6 = array(
                              'page_id' => $arraydatapage5['id'],
                              'group_id' => $group[$j],
                              'created_by' => $this->session->userdata('id'),
                              'date_created' => date("Y-m-d H:i:s", time())
                          );
                          $this->db->insert('t_group_pages',$datagroup6);
                          // -----------------------------------------------------------------
                          $datagroup7 = array(
                              'page_id' => $arraydatapage6['id'],
                              'group_id' => $group[$j],
                              'created_by' => $this->session->userdata('id'),
                              'date_created' => date("Y-m-d H:i:s", time())
                          );
                          $this->db->insert('t_group_pages',$datagroup7);
                          // -----------------------------------------------------------------
                          $datagroup8 = array(
                              'page_id' => $arraydatapage7['id'],
                              'group_id' => $group[$j],
                              'created_by' => $this->session->userdata('id'),
                              'date_created' => date("Y-m-d H:i:s", time())
                          );
                          $this->db->insert('t_group_pages',$datagroup8);
                          // -----------------------------------------------------------------
                          $datagroup9 = array(
                              'page_id' => $arraydatapage8['id'],
                              'group_id' => $group[$j],
                              'created_by' => $this->session->userdata('id'),
                              'date_created' => date("Y-m-d H:i:s", time())
                          );
                          $this->db->insert('t_group_pages',$datagroup9);
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
                                                                toastr.error('Silahkan Cek Kembali', 'Data Urisegment Ada yang Sama!');
                                                            }, 1300);
                                                            </script>
                                                          ");
                  }  

              }
          } 
      }
      redirect('pages');
  }
  public function get_dropdowngroups(){
      $query = $this->db->select('id,name')
                        ->order_by('name','ASC')
                        ->where('deleted','0')
                        ->get('t_groups');
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
  public function cek_uri($uri){
      $query = $this->db
                      ->select('id,name,uri')
                      ->where('deleted',0)
                      ->where('uri',$uri)
                      ->get('t_pages');
      return $query->result();
  }
  public function select_pages(){
      $query = $this->db
            ->select("t_pages.id,t_pages.`name`,t_pages.uri,t_pages.active,t_pages.date_created,
                        (SELECT GROUP_CONCAT(CONCAT(t_groups.name) SEPARATOR ', ') 
                        FROM t_group_pages, t_groups
                        WHERE t_group_pages.page_id=t_pages.id 
                        AND t_group_pages.group_id=t_groups.id
                        AND t_group_pages.deleted='0'
                        GROUP BY t_group_pages.page_id) AS countpage")
            ->where('deleted',0)
            ->order_by('name','ASC')
            ->get('t_pages');
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
                        ->where("(name like '%".$tampil."%'OR uri like'%".$tampil."%')")
                        ->get("t_pages")
                        ->num_rows();
        }
        else{
            return $this->db
                        ->select('id')
                        ->where("deleted=0")
                        ->where("(name like '%".$datacari."%'OR uri like'%".$datacari."%')")
                        ->get("t_pages")
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
          $query = $this->db->select("t_pages.id,t_pages.`name`,t_pages.uri,t_pages.active,t_pages.date_created,
                                      (SELECT GROUP_CONCAT(CONCAT('<button class=\"btn btn-primary btn-xs\" type=\"button\" style=\"padding-bottom:0px; padding-top:0px; margin-bottom:0px;\">',t_groups.name,'</button>') SEPARATOR ' ') 
                                      FROM t_group_pages, t_groups
                                      WHERE t_group_pages.page_id=t_pages.id 
                                      AND t_group_pages.group_id=t_groups.id
                                      AND t_group_pages.deleted='0'
                                      GROUP BY t_group_pages.page_id) AS countpage")
                            ->where("(name like '%".$tampil."%' OR uri like '%".$tampil."%')")
                            ->where("deleted",0)
                            ->order_by("name", "ASC")
                            ->get("t_pages",$number,$offset);
          return $query->result();

      }
      else{
          $query = $this->db->select("t_pages.id,t_pages.`name`,t_pages.uri,t_pages.active,t_pages.date_created,
                                      (SELECT GROUP_CONCAT(CONCAT('<button class=\"btn btn-primary btn-xs\" type=\"button\" style=\"padding-bottom:0px; padding-top:0px; margin-bottom:0px;\">',t_groups.name,'</button>') SEPARATOR ' ') 
                                      FROM t_group_pages, t_groups
                                      WHERE t_group_pages.page_id=t_pages.id 
                                      AND t_group_pages.group_id=t_groups.id
                                      AND t_group_pages.deleted='0'
                                      GROUP BY t_group_pages.page_id) AS countpage")
                            ->where("(name like '%".$datacari."%' OR uri like '%".$datacari."%')")
                            ->where("deleted",0)
                            ->order_by("name", "ASC")
                            ->get("t_pages",$number,$offset);
          return $query->result();
      }  
  }
  public function remove_checked(){
      $delete = $this->input->post('table_records');
      $jumlahdata = count($delete);       
      for ($i=0; $i < count($delete); $i++){
          $data = array('deleted'=>'1',
                        'date_modified'=>date("Y-m-d H:i:s", time()),
                        'modified_by'=>$this->session->userdata('id'));
          $this->db->where('id', $delete[$i]);
          $this->db->update('t_pages',$data);
          $this->db->where('page_id', $delete[$i]);
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

  public function view_edit($pages_id){
      $query = $this->db
                      ->select("t_pages.id,t_pages.`name`,t_pages.uri,t_pages.active,t_pages.date_created as datecreatedpages,t_pages.date_modified as datemodifiedpages, t_personil.nm_lengkap,t_pages.modified_by,
                                (SELECT GROUP_CONCAT(CONCAT(t_groups.name) SEPARATOR ', ') 
                                FROM t_group_pages, t_groups
                                WHERE t_group_pages.page_id=t_pages.id 
                                AND t_group_pages.group_id=t_groups.id
                                AND t_group_pages.deleted ='0'
                                GROUP BY t_group_pages.page_id) AS countpage")
                      ->from('t_personil')
                      ->where('t_pages.created_by=t_personil.id')
                      ->where('t_pages.id',$pages_id)
                      ->get('t_pages');
      return $query;
  }
  public function view_mdfi($pages_id){
      $query = $this->db
                      ->select('t_pages.modified_by, t_personil.nm_lengkap')
                      ->from('t_personil')
                      ->where('t_pages.modified_by=t_personil.id')
                      ->where('t_pages.id',$pages_id)
                      ->get('t_pages');
      return $query;
  }
  public function getselectgroup($pages_id){
      $query = $this->db
                      ->select("t_groups.id,t_groups.name,
                               (SELECT GROUP_CONCAT(CONCAT(t_pages.name) SEPARATOR ', ') 
                                FROM t_pages,t_group_pages 
                                WHERE t_pages.id=t_group_pages.page_id 
                                AND t_group_pages.group_id=t_groups.id 
                                AND t_pages.deleted='0'
                                AND t_group_pages.page_id = '".$pages_id."') AS pages")
                      ->where('t_groups.deleted',0)
                      ->order_by('t_groups.name','ASC')
                      ->get('t_groups');
      return $query->result();

  }
  public function saveupdate($pages_id){
      $name = $this->input->post('name');
      $uri = $this->input->post('uri');
      $active = $this->input->post('active');
      $group = $this->input->post('group');
      
      if($active=='1'){
        $prsactive = 1;
      }else{
        $prsactive = 0;
      }
      $this->db->where('page_id',$pages_id);
      $this->db->delete('t_group_pages');

      $datagetcreate = $this->db->select('*')
                                ->where('id',$pages_id)
                                ->get('t_pages')->row_array();
      $result = $datagetcreate;//jang nunda tanggal nu awal jadi dipakai


      $datapages = array('name' => ucwords(strtolower($name)),
                            'uri' => strtolower($uri),
                            'active' => $prsactive,
                            'date_modified' => date("Y-m-d H:i:s", time()),
                            'modified_by' => $this->session->userdata('id'));
      $this->db->where('id',$pages_id);
      $this->db->update('t_pages',$datapages);


      for ($j=0; $j < count($group); $j++)
      {
          $datagroup = array(
              'page_id' => $pages_id,
              'group_id' => $group[$j],
              'created_by' => $result['created_by'],
              'date_created' => $result['date_created'],
              'modified_by' => $this->session->userdata('id'),
              'date_modified' => date("Y-m-d H:i:s", time())
          );
          $this->db->insert('t_group_pages',$datagroup);
      }
      

      
      
  }
  public function dlt($pages_id){
      $data = array('deleted'=>'1');
      $this->db->where('id', $pages_id);
      $this->db->update('t_pages',$data);

      $this->db->where('page_id',$pages_id);
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