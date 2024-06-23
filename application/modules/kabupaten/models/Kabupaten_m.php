<?php defined('BASEPATH') or exit('No direct script access allowed');
class Kabupaten_m extends CI_Model{
	public $_tq = "t_kabupaten";//tabel query
  public $_tqr = "t_provinsi";//tabel query relation
	public $_orderby = "DESC";
  public $_usv = "t_userview";

  public function get_index($number,$offset){
      $query = $this->db
          ->select("*")
          ->select("(SELECT IF(COUNT(t_kecamatan.id)=0,'',
                      CONCAT('<span class=\"label label-default pull-right\">',COUNT(t_kecamatan.id),' Kec.</span>'))
                      FROM t_kecamatan
                      WHERE t_kecamatan.kabupaten_id=t_kabupaten.id 
                      AND t_kecamatan.deleted='0') AS jumlah")
          ->from($this->_tqr)
          ->where($this->_tq.'.'.substr($this->_tqr, 2).'_id='.$this->_tqr.'.id')
          ->where($this->_tq.'.deleted','0')
          ->order_by($this->_tq.'.date_created',$this->_orderby)
          ->get($this->_tq,$number,$offset);
      return $query->result();
  }
  function jumlah_data(){  //jang pagination
      return $this->db
          ->select($this->_tq.'.id')
          ->from($this->_tqr)
          ->where($this->_tq.'.'.substr($this->_tqr, 2).'_id='.$this->_tqr.'.id')
          ->where($this->_tq.'.deleted','0')
          ->order_by($this->_tq.'.date_created',$this->_orderby)
          ->get($this->_tq)
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
                        ->select($this->_tq.'.id')
                        ->from($this->_tqr)
                        ->where($this->_tq.'.'.substr($this->_tqr, 2).'_id='.$this->_tqr.'.id')
                        ->where($this->_tq.'.deleted','0')
                        ->where("(".$this->_tqr.".provinsi like '%".$tampil."%' OR ".$this->_tq.".kabupaten like '%".$tampil."%')")
                        ->order_by($this->_tq.".".substr($this->_tq, 2),"ASC")
                        ->get($this->_tq)
                        ->num_rows();
        }
        else{
            return $this->db
                        ->select($this->_tq.'.id')
                        ->from($this->_tqr)
                        ->where($this->_tq.'.'.substr($this->_tqr, 2).'_id='.$this->_tqr.'.id')
                        ->where($this->_tq.'.deleted','0')
                        ->where("(".$this->_tqr.".provinsi like '%".$datacari."%' OR ".$this->_tq.".kabupaten like '%".$datacari."%')")
                        ->order_by($this->_tq.".".substr($this->_tq, 2),"ASC")
                        ->get($this->_tq)
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
                            ->select("(SELECT IF(COUNT(t_kecamatan.id)=0,'',
                                    CONCAT('<span class=\"label label-default pull-right\">',COUNT(t_kecamatan.id),' Kec.</span>'))
                                    FROM t_kecamatan
                                    WHERE t_kecamatan.kabupaten_id=t_kabupaten.id 
                                    AND t_kecamatan.deleted='0') AS jumlah")
                            ->from($this->_tqr)
                            ->where($this->_tq.'.'.substr($this->_tqr, 2).'_id='.$this->_tqr.'.id')
                            ->where($this->_tq.'.deleted','0')
                            ->where("(".$this->_tqr.".provinsi like '%".$tampil."%' OR ".$this->_tq.".kabupaten like '%".$tampil."%')")
                            ->order_by($this->_tq.".".substr($this->_tq, 2),"ASC")
                            ->get($this->_tq,$number,$offset);
          return $query->result();
      }
      else{
          $query = $this->db->select("*")
                            ->select("(SELECT IF(COUNT(t_kecamatan.id)=0,'',
                                    CONCAT('<span class=\"label label-default pull-right\">',COUNT(t_kecamatan.id),' Kec.</span>'))
                                    FROM t_kecamatan
                                    WHERE t_kecamatan.kabupaten_id=t_kabupaten.id 
                                    AND t_kecamatan.deleted='0') AS jumlah")
                            ->from($this->_tqr)
                            ->where($this->_tq.'.'.substr($this->_tqr, 2).'_id='.$this->_tqr.'.id')
                            ->where($this->_tq.'.deleted','0')
                            ->where("(".$this->_tqr.".provinsi like '%".$datacari."%' OR ".$this->_tq.".kabupaten like '%".$datacari."%')")
                            ->order_by($this->_tq.".".substr($this->_tq, 2),"ASC")
                            ->get($this->_tq,$number,$offset);
          return $query->result();
      }  
  }
  public function get_dropdowndata(){
    $query = $this->db->select('id,provinsi')
              ->order_by('provinsi','ASC')
              ->where('deleted','0')
              ->get($this->_tqr);
    $result = $query->result();

    $data_id = array();
    $data_name = array();

    for ($i = 0; $i < count($result); $i++)
    {
      array_push($data_id, $result[$i]->id);
      array_push($data_name, $result[$i]->provinsi);
    }
    return array_combine($data_id, $data_name);
  }
	public function save(){
      $kabupaten = strtolower($this->input->post('nama_kabupaten'));
	    
      $insert = array(
                      'id'               => ucwords(substr($this->_tq, 2,3)).'-'.get_uuid(),
                      'kabupaten'        => ucwords($kabupaten),
                      'provinsi_id'      => $this->input->post('provinsi_id'),
                      'date_created'     => date("Y-m-d H:i:s", time()),
                      'date_modified'    => date("Y-m-d H:i:s", time()),
                      'created_by'       => $this->session->userdata('id'),
                      'modified_by'		   => $this->session->userdata('id'),
                      'created_byname'   => $this->session->userdata('nm_lengkap'),
                      'modified_byname'  => $this->session->userdata('nm_lengkap'),
                      'deleted'          => '0'
                      );
      $this->db->insert($this->_tq,$insert);
	}
  public function get_id($view_id){
      $query = $this->db
              ->select('*')
              ->from($this->_tqr)
              ->where($this->_tq.'.'.substr($this->_tqr, 2).'_id='.$this->_tqr.'.id')
              ->where($this->_tq.'.deleted','0')
              ->where($this->_tq.'.id',$view_id)
              ->get($this->_tq);
      return $query;
  }
  public function updated($update_id){
      $kabupaten = strtolower($this->input->post('nama_kabupaten'));
      $update = array(
                      'kabupaten'        => ucwords($kabupaten),
                      'provinsi_id'      => $this->input->post('provinsi_id'),
                      'date_modified'    => date("Y-m-d H:i:s", time()),
                      'modified_by'      => $this->session->userdata('id'),
                      'modified_byname'  => $this->session->userdata('nm_lengkap')
                      );
      $this->db->where('id',$update_id);
      $this->db->update($this->_tq,$update);
  }
  public function deleted($delete_id){
      $data = array('deleted'=>'1');
      $this->db->where('id', $delete_id);
      $this->db->update($this->_tq,$data);

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
          $this->db->update($this->_tq,$data);
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
          ->get($this->_tq);
      return $query->result();
  }
  public function getselect($view_id){
      $query = $this->db
                      ->select("t_provinsi.id, t_provinsi.provinsi name,
                                (SELECT GROUP_CONCAT(CONCAT(k.kabupaten)SEPARATOR ', ') FROM t_kabupaten k WHERE k.provinsi_id = t_provinsi.id AND k.id = '".$view_id."') AS selected")
                      ->where($this->_tqr.'.deleted','0')
                      ->order_by($this->_tqr.'.provinsi', 'ASC')
                      ->get($this->_tqr);
      return $query->result();

  }

  public function get_activedclass($dataactiveclass){
        $query = $this->db
            ->select("*")
            ->where("name",$dataactiveclass)
            ->or_where("name",strtolower($dataactiveclass))
            ->limit(1)
            ->get($this->_usv);
        return $query->row_array();
  }
  




}
?>