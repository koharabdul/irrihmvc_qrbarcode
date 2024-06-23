<?php defined('BASEPATH') or exit('No direct script access allowed');
class Provinsi_m extends CI_Model{
	public $_tq = "t_provinsi";
	public $_orderby = "DESC";

  public function get_index($number,$offset){
      $query = $this->db
          ->select("*")
          ->select("(SELECT IF(COUNT(t_kabupaten.id)=0,'',
                    CONCAT('<span class=\"label label-info pull-right\">',COUNT(t_kabupaten.id),' Kab.</span>'))
                      FROM t_kabupaten
                      WHERE t_kabupaten.provinsi_id=t_provinsi.id 
                      AND t_kabupaten.deleted='0') AS jumlah")
          ->where('deleted','0')
          ->order_by('date_created',$this->_orderby)
          ->get($this->_tq,$number,$offset);
      return $query->result();
  }
  function jumlah_data(){  //jang pagination
      return $this->db
          ->select('id')
          ->where('deleted','0')
          ->order_by('date_created',$this->_orderby)
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
                        ->select('id')
                        ->where('deleted','0')
                        ->where("provinsi like '%".$tampil."%'")
                        ->get($this->_tq)
                        ->num_rows();
        }
        else{
            return $this->db
                        ->select('id')
                        ->where('deleted','0')
                        ->where("provinsi like '%".$datacari."%'")
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
                            ->select("(SELECT IF(COUNT(t_kabupaten.id)=0,'',
                                      CONCAT('<span class=\"label label-info pull-right\">',COUNT(t_kabupaten.id),' Kab.</span>'))
                                        FROM t_kabupaten
                                        WHERE t_kabupaten.provinsi_id=t_provinsi.id 
                                        AND t_kabupaten.deleted='0') AS jumlah")
                            ->where("deleted","0")
                            ->where("provinsi like '%".$tampil."%'")
                            ->order_by("date_created", $this->_orderby)
                            ->get($this->_tq,$number,$offset);
          return $query->result();
      }
      else{
          $query = $this->db->select("*")
                            ->select("(SELECT IF(COUNT(t_kabupaten.id)=0,'',
                                      CONCAT('<span class=\"label label-info pull-right\">',COUNT(t_kabupaten.id),' Kab.</span>'))
                                        FROM t_kabupaten
                                        WHERE t_kabupaten.provinsi_id=t_provinsi.id 
                                        AND t_kabupaten.deleted='0') AS jumlah")
                            ->where("deleted","0")
                            ->where("provinsi like '%".$datacari."%'")
                            ->order_by("date_created", $this->_orderby)
                            ->get($this->_tq,$number,$offset);
          return $query->result();
      }  
  }
	public function save(){
	    $provinsi = strtolower($this->input->post('nama_provinsi'));

      $insert = array(
                      'id'               => ucwords(substr($this->_tq, 2,4)).'-'.get_uuid(),
                      'provinsi'         => ucwords($provinsi),
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
              ->where('id',$view_id)
              ->get($this->_tq);
      return $query;
  }
  public function updated($update_id){
      $update = array(
                      'provinsi'         => $this->input->post('nama_provinsi'),
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
  




}
?>