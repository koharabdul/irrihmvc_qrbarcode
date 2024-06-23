<?php defined('BASEPATH') or exit('No direct script access allowed');
class Kecamatan_m extends CI_Model{
	public $_table = "t_kecamatan";
  public $_table_relation = "t_kabupaten";
	public $_orderby = "DESC";

  public function get_index($number,$offset){
      $query = $this->db
          ->select("*")
          ->select("CONCAT((SELECT IF(COUNT(t_kelurahan.id)=0,
                            '',CONCAT('<span class=\"label pull-right\" style=\"background-color:#8c867f;color:#fff;\">',COUNT(t_kelurahan.id),' Kel. </span>'))
                            FROM t_kelurahan
                            WHERE t_kelurahan.kecamatan_id=t_kecamatan.id 
                            AND t_kelurahan.type_kelurahan = 'Kelurahan'
                            AND t_kelurahan.deleted='0'),
                            (SELECT IF(COUNT(t_kelurahan.id)=0,'',CONCAT('<span class=\"label label-default pull-right\">',COUNT(t_kelurahan.id),' Des. </span>'))
                            FROM t_kelurahan
                            WHERE t_kelurahan.kecamatan_id=t_kecamatan.id 
                            AND t_kelurahan.type_kelurahan = 'Desa'
                            AND t_kelurahan.deleted='0')) AS jumlah")
          ->from($this->_table_relation)
          ->where($this->_table.'.'.'kabupaten_id='.$this->_table_relation.'.'.'id')
          ->where($this->_table.'.'.'deleted','0')
          ->order_by($this->_table.'.'.'date_created',$this->_orderby)
          ->get($this->_table,$number,$offset);
      return $query->result();
  }
  function jumlah_data(){  //jang pagination
      return $this->db
          ->select($this->_table.'.'.'id')
          ->from($this->_table_relation)
          ->where($this->_table.'.'.'kabupaten_id='.$this->_table_relation.'.'.'id')
          ->where($this->_table.'.'.'deleted','0')
          ->order_by($this->_table.'.'.'date_created',$this->_orderby)
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
                        ->select($this->_table.'.'.'id')
                        ->from($this->_table_relation)
                        ->where($this->_table.'.'.'kabupaten_id='.$this->_table_relation.'.'.'id')
                        ->where($this->_table.'.'.'deleted','0')
                        ->where("(".$this->_table_relation."."."kabupaten like '%".$tampil."%' OR ".$this->_table."."."kecamatan like '%".$tampil."%')")
                        ->order_by($this->_table."."."kecamatan", "ASC")
                        ->get($this->_table)
                        ->num_rows();
        }
        else{
            return $this->db
                        ->select($this->_table.'.'.'id')
                        ->from($this->_table_relation)
                        ->where($this->_table.'.'.'kabupaten_id='.$this->_table_relation.'.'.'id')
                        ->where($this->_table.'.'.'deleted','0')
                        ->where("(".$this->_table_relation."."."kabupaten like '%".$datacari."%' OR ".$this->_table."."."kecamatan like '%".$datacari."%')")
                        ->order_by($this->_table."."."kecamatan", "ASC")
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
          $query = $this->db->select("*")
                            ->select("CONCAT((SELECT IF(COUNT(t_kelurahan.id)=0,
                                        '',CONCAT('<span class=\"label pull-right\" style=\"background-color:#8c867f;color:#fff;\">',COUNT(t_kelurahan.id),' Kel. </span>'))
                                        FROM t_kelurahan
                                        WHERE t_kelurahan.kecamatan_id=t_kecamatan.id 
                                        AND t_kelurahan.type_kelurahan = 'Kelurahan'
                                        AND t_kelurahan.deleted='0'),
                                        (SELECT IF(COUNT(t_kelurahan.id)=0,'',CONCAT('<span class=\"label label-default pull-right\">',COUNT(t_kelurahan.id),' Des. </span>'))
                                        FROM t_kelurahan
                                        WHERE t_kelurahan.kecamatan_id=t_kecamatan.id 
                                        AND t_kelurahan.type_kelurahan = 'Desa'
                                        AND t_kelurahan.deleted='0')) AS jumlah")
                            ->from($this->_table_relation)
                            ->where($this->_table.'.'.'kabupaten_id='.$this->_table_relation.'.'.'id')
                            ->where($this->_table.'.'.'deleted','0')
                            ->where("(".$this->_table_relation."."."kabupaten like '%".$tampil."%' OR ".$this->_table."."."kecamatan like '%".$tampil."%')")
                            ->order_by($this->_table."."."kecamatan", "ASC")
                            ->get($this->_table,$number,$offset);
          return $query->result();
      }
      else{
          $query = $this->db->select("*")
                            ->select("CONCAT((SELECT IF(COUNT(t_kelurahan.id)=0,
                                        '',CONCAT('<span class=\"label pull-right\" style=\"background-color:#8c867f;color:#fff;\">',COUNT(t_kelurahan.id),' Kel. </span>'))
                                        FROM t_kelurahan
                                        WHERE t_kelurahan.kecamatan_id=t_kecamatan.id 
                                        AND t_kelurahan.type_kelurahan = 'Kelurahan'
                                        AND t_kelurahan.deleted='0'),
                                        (SELECT IF(COUNT(t_kelurahan.id)=0,'',CONCAT('<span class=\"label label-default pull-right\">',COUNT(t_kelurahan.id),' Des. </span>'))
                                        FROM t_kelurahan
                                        WHERE t_kelurahan.kecamatan_id=t_kecamatan.id 
                                        AND t_kelurahan.type_kelurahan = 'Desa'
                                        AND t_kelurahan.deleted='0')) AS jumlah")
                            ->from($this->_table_relation)
                            ->where($this->_table.'.'.'kabupaten_id='.$this->_table_relation.'.'.'id')
                            ->where($this->_table.'.'.'deleted','0')
                            ->where("(".$this->_table_relation."."."kabupaten like '%".$datacari."%' OR ".$this->_table."."."kecamatan like '%".$datacari."%')")
                            ->order_by($this->_table."."."kecamatan", "ASC")
                            ->get($this->_table,$number,$offset);
          return $query->result();
      }  
  }
  public function get_dropdowndata(){
    $query = $this->db->select('id,kabupaten')
              ->order_by('kabupaten','ASC')
              ->where('deleted','0')
              ->get($this->_table_relation);
    $result = $query->result();

    $data_id = array();
    $data_name = array();

    for ($i = 0; $i < count($result); $i++)
    {
      array_push($data_id, $result[$i]->id);
      array_push($data_name, $result[$i]->kabupaten);
    }
    return array_combine($data_id, $data_name);
  }
	public function save(){
      $kecamatan = strtolower($this->input->post('nama_kecamatan'));
	    
      $insert = array(
                      'id'               => ucwords(substr($this->_table, 2,3)).'-'.get_uuid(),
                      'kecamatan'        => ucwords($kecamatan),
                      'kabupaten_id'     => $this->input->post('kabupaten_id'),
                      'date_created'     => date("Y-m-d H:i:s", time()),
                      'date_modified'    => date("Y-m-d H:i:s", time()),
                      'created_by'       => $this->session->userdata('id'),
                      'modified_by'		   => $this->session->userdata('id'),
                      'created_byname'   => $this->session->userdata('nm_lengkap'),
                      'modified_byname'  => $this->session->userdata('nm_lengkap'),
                      'deleted'          => '0'
                      );
      $this->db->insert($this->_table,$insert);
	}
  public function get_id($view_id){
      $query = $this->db
              ->select('*')
              ->from($this->_table_relation)
              ->where($this->_table.'.'.'kabupaten_id='.$this->_table_relation.'.'.'id')
              ->where($this->_table.'.'.'deleted','0')
              ->where($this->_table.'.'.'id',$view_id)
              ->get($this->_table);
      return $query;
  }
  public function updated($update_id){
      $kecamatan = strtolower($this->input->post('nama_kecamatan'));
      $update = array(
                      'kecamatan'        => ucwords($kecamatan),
                      'kabupaten_id'     => $this->input->post('kabupaten_id'),
                      'date_modified'    => date("Y-m-d H:i:s", time()),
                      'modified_by'      => $this->session->userdata('id'),
                      'modified_byname'  => $this->session->userdata('nm_lengkap')
                      );
      $this->db->where('id',$update_id);
      $this->db->update($this->_table,$update);
  }
  public function deleted($delete_id){
      $data = array('deleted'=>'1');
      $this->db->where('id', $delete_id);
      $this->db->update($this->_table,$data);

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
                                                                  'timeOut': '7000',
                                                                  'extendedTimeOut': '1000',
                                                                  'showEasing': 'swing',
                                                                  'hideEasing': 'linear',
                                                                  'showMethod': 'fadeIn',
                                                                  'hideMethod': 'fadeOut'
                                                          };
                                                          toastr.info('Berhasil Dihapus', 'Data Tersebut!');
                                                      }, 1300);
                                                      </script>
                                                    ");
  }
  public function deleted_multiple(){
      $delete = $this->input->post('table_records');
      $jumlahdata = count($delete);       
      for ($i=0; $i < count($delete); $i++){
          $data = array('deleted'         =>  '1',
                        'date_modified'   =>  date("Y-m-d H:i:s", time()),
                        'modified_by'     =>  $this->session->userdata('id'),
                        'modified_byname' =>  $this->session->userdata('nm_lengkap'));
          $this->db->where('id', $delete[$i]);
          $this->db->update($this->_table,$data);
          $this->session->set_flashdata("inforemovechecked","<script>
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

  public function select_groups(){
      $query = $this->db
          ->select("*")
          ->where('deleted','0')
          ->order_by('date_created','ASC')
          ->get($this->_table);
      return $query->result();
  }
  public function getselect($view_id){
      $query = $this->db
                      ->select("t_kabupaten.id, 
                                t_kabupaten.kabupaten name,
                                  (SELECT GROUP_CONCAT(CONCAT(k.kecamatan)SEPARATOR ', ') 
                                  FROM t_kecamatan k WHERE k.kabupaten_id = t_kabupaten.id AND k.id = '".$view_id."') 
                                  AS selected")
                      ->where('t_kabupaten.deleted','0')
                      ->order_by('t_kabupaten.kabupaten', 'ASC')
                      ->get('t_kabupaten');
      return $query->result();

  }
  public function cek_double($nama_kecamatan,$kabupaten_id){
      $query = $this->db
                      ->select('id,kecamatan')
                      ->where('deleted','0')
                      ->where("(kecamatan ='".$nama_kecamatan."' AND kabupaten_id ='".$kabupaten_id."')")
                      ->get($this->_table);
      return $query->result();
  }
  public function input_multiple(){
      $nama_kecamatan = $this->input->post('nama_kecamatan');
      $kabupaten_id = $this->input->post('kabupaten_id');
      for ($i=0; $i < count($nama_kecamatan); $i++){
          if(($nama_kecamatan[$i]=='')and($kabupaten_id[$i]=='')or(($nama_kecamatan[$i]=='')and($kabupaten_id[$i]==''))){
              $this->session->set_flashdata("infosaveadd","<script>
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
              if(count($nama_kecamatan)==0){
                  $this->session->set_flashdata("infosaveadd","<script>
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
                  $cekinput = $this->Kecamatan_m->cek_double($nama_kecamatan[$i],$kabupaten_id);
                  if(count($cekinput)==0)
                  {
                      $countdata = count($nama_kecamatan);
                      $datainput = array(
                          'id'             => ucwords(substr($this->_table, 2,3)).'-'.get_uuid(),
                          'kecamatan'      => ucwords(strtolower($nama_kecamatan[$i])),
                          'kabupaten_id'   => $kabupaten_id,
                          'date_created'   => date("Y-m-d H:i:s", time()),
                          'date_modified'  => date("Y-m-d H:i:s", time()),
                          'created_by'     => $this->session->userdata('id'),
                          'modified_by'    => $this->session->userdata('id'),
                          'created_byname' => $this->session->userdata('nm_lengkap'),
                          'modified_byname'=> $this->session->userdata('nm_lengkap'),
                          'deleted'        => '0'
                       );
                      $this->db->insert($this->_table,$datainput);
                      $this->session->set_flashdata("infosaveadd","<script>
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
                                                      toastr.success('Input Data Sukses', '$countdata Data Berhasil Disimpan!');
                                                  }, 1300);
                                                  </script>
                                                ");
                  }
                      
              }
          } 
      }
  }
  




}
?>