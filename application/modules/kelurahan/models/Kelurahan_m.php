<?php defined('BASEPATH') or exit('No direct script access allowed');
class Kelurahan_m extends CI_Model{
  public $_tq = "t_kelurahan";//tabel query
  public $_tqr = "t_kecamatan";//table relationship
  public $_tqrprov = "t_provinsi";
  public $_tqrkab = "t_kabupaten";
  public $_orderby = "DESC";

  public function get_index($number,$offset){
      $query = $this->db
          ->select("*")
          ->from("t_kabupaten,t_provinsi,t_kecamatan")
          ->where("t_kabupaten.provinsi_id=t_provinsi.id and t_kecamatan.kabupaten_id=t_kabupaten.id and t_kelurahan.kecamatan_id=t_kecamatan.id")
          ->where($this->_tq.'.'.'deleted','0')
          ->where($this->_tqr.'.'.'deleted','0')
          ->where($this->_tqrprov.'.'.'deleted','0')
          ->where($this->_tqrkab.'.'.'deleted','0')
          ->order_by($this->_tq.'.'.'date_created',$this->_orderby)
          ->get($this->_tq,$number,$offset);
      return $query->result();
  }
  function jumlah_data(){  //jang pagination
      return $this->db
          ->select($this->_tq.'.'.'id')
          ->from("t_kabupaten,t_provinsi,t_kecamatan")
          ->where("t_kabupaten.provinsi_id=t_provinsi.id and t_kecamatan.kabupaten_id=t_kabupaten.id and t_kelurahan.kecamatan_id=t_kecamatan.id")
          ->where($this->_tq.'.'.'deleted','0')
          ->where($this->_tqr.'.'.'deleted','0')
          ->where($this->_tqrprov.'.'.'deleted','0')
          ->where($this->_tqrkab.'.'.'deleted','0')
          ->order_by($this->_tq.'.'.'date_created',$this->_orderby)
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
                        ->select($this->_tq.'.'.'id')
                        ->from($this->_tqr)
                        ->from("t_kabupaten,t_provinsi")
                        ->where("t_kabupaten.provinsi_id=t_provinsi.id and t_kecamatan.kabupaten_id=t_kabupaten.id and t_kelurahan.kecamatan_id=t_kecamatan.id")
                        ->where($this->_tq.'.'.'deleted','0')
                        ->where($this->_tqr.'.'.'deleted','0')
                        ->where($this->_tqrprov.'.'.'deleted','0')
                        ->where($this->_tqrkab.'.'.'deleted','0')
                        ->where("(".$this->_tqr."."."kecamatan like '%".$tampil."%' OR ".$this->_tq."."."type_kelurahan like '%".$tampil."%' OR ".$this->_tq."."."kelurahan like '%".$tampil."%' OR ".$this->_tqrkab."."."kabupaten like '%".$tampil."%' OR ".$this->_tqrprov."."."provinsi like '%".$tampil."%')")
                        ->order_by($this->_tq.'.'.'kelurahan', 'ASC')
                        ->get($this->_tq)
                        ->num_rows();
        }
        else{
            return $this->db
                        ->select($this->_tq.'.'.'id')
                        ->from($this->_tqr)
                        ->from("t_kabupaten,t_provinsi")
                        ->where("t_kabupaten.provinsi_id=t_provinsi.id and t_kecamatan.kabupaten_id=t_kabupaten.id and t_kelurahan.kecamatan_id=t_kecamatan.id")
                        ->where($this->_tq.'.'.'deleted','0')
                        ->where($this->_tqr.'.'.'deleted','0')
                        ->where($this->_tqrprov.'.'.'deleted','0')
                        ->where($this->_tqrkab.'.'.'deleted','0')
                        ->where("(".$this->_tqr."."."kecamatan like '%".$datacari."%' OR ".$this->_tq."."."type_kelurahan like '%".$datacari."%' OR ".$this->_tq."."."kelurahan like '%".$datacari."%' OR ".$this->_tqrkab."."."kabupaten like '%".$datacari."%' OR ".$this->_tqrprov."."."provinsi like '%".$datacari."%')")
                        ->order_by($this->_tq.'.'.'kelurahan', 'ASC')
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
                              ->from("t_kabupaten,t_provinsi,t_kecamatan")
                              ->where("t_kabupaten.provinsi_id=t_provinsi.id and t_kecamatan.kabupaten_id=t_kabupaten.id and t_kelurahan.kecamatan_id=t_kecamatan.id")
                              ->where($this->_tq.'.'.'deleted','0')
                              ->where($this->_tqr.'.'.'deleted','0')
                              ->where($this->_tqrprov.'.'.'deleted','0')
                              ->where($this->_tqrkab.'.'.'deleted','0')
                              ->where("(".$this->_tqr."."."kecamatan like '%".$tampil."%' OR ".$this->_tq."."."type_kelurahan like '%".$tampil."%' OR ".$this->_tq."."."kelurahan like '%".$tampil."%' OR ".$this->_tqrkab."."."kabupaten like '%".$tampil."%' OR ".$this->_tqrprov."."."provinsi like '%".$tampil."%')")
                            ->order_by($this->_tq."."."kelurahan", "ASC")
                            ->get($this->_tq,$number,$offset);
          return $query->result();
      }
      else{
          $query = $this->db->select("*")
                            ->from("t_kabupaten,t_provinsi,t_kecamatan")
                            ->where("t_kabupaten.provinsi_id=t_provinsi.id and t_kecamatan.kabupaten_id=t_kabupaten.id and t_kelurahan.kecamatan_id=t_kecamatan.id")
                            ->where($this->_tq.'.'.'deleted','0')
                            ->where($this->_tqr.'.'.'deleted','0')
                            ->where($this->_tqrprov.'.'.'deleted','0')
                            ->where($this->_tqrkab.'.'.'deleted','0')
                            ->where("(".$this->_tqr."."."kecamatan like '%".$datacari."%' OR ".$this->_tq."."."type_kelurahan like '%".$datacari."%' OR ".$this->_tq."."."kelurahan like '%".$datacari."%' OR ".$this->_tqrkab."."."kabupaten like '%".$datacari."%' OR ".$this->_tqrprov."."."provinsi like '%".$datacari."%')")
                            ->order_by($this->_tq."."."kelurahan", "ASC")
                            ->get($this->_tq,$number,$offset);
          return $query->result();
      }  
  }
  public function get_dropdowndata(){
    // $query = $this->db->select('id,provinsi')
    //           ->order_by('provinsi','ASC')
    //           ->where('deleted','0')
    //           ->get('t_provinsi');
    // $result = $query->result();

    // $data_id = array();
    // $data_name = array();

    // for ($i = 0; $i < count($result); $i++)
    // {
    //   array_push($data_id, $result[$i]->id);
    //   array_push($data_name, $result[$i]->provinsi);
    // }
    // return array_combine($data_id, $data_name);
    $this->db->order_by('provinsi','ASC');
    $this->db->where('deleted','0');
    $query = $this->db->get('t_provinsi');
    return $query->result();
  }
  public function save(){
      $kelurahan = strtolower($this->input->post('nama_kelurahan'));
      $type_kelurahan = $this->input->post('type_kelurahan');
      $provinsi_id = $this->input->post('provinsi_id');
      $kecamatan_id = $this->input->post('kecamatan_id');
      $kabupaten_id = $this->input->post('kabupaten_id');
      $cekada = $this->Kelurahan_m->cek_ada($provinsi_id,$kabupaten_id,$kecamatan_id);
      if(count($cekada)==1){
          $insert = array(
                          'id'               => ucwords(substr($this->_tq, 2,3)).'-'.get_uuid(),
                          'kelurahan'        => ucwords($kelurahan),
                          'type_kelurahan'   => $type_kelurahan,
                          'kecamatan_id'     => $this->input->post('kecamatan_id'),
                          'date_created'     => date("Y-m-d H:i:s", time()),
                          'date_modified'    => date("Y-m-d H:i:s", time()),
                          'created_by'       => $this->session->userdata('id'),
                          'modified_by'      => $this->session->userdata('id'),
                          'created_byname'   => $this->session->userdata('nm_lengkap'),
                          'modified_byname'  => $this->session->userdata('nm_lengkap'),
                          'deleted'          => '0'
                          );
          $this->db->insert($this->_tq,$insert);
      }
      else{
        $eta = count($cekada);
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
                                                          toastr.info('Berhasil Dihapus $eta', 'Data Tersebut!');
                                                      }, 1300);
                                                      </script>
                                                    ");
      }
  }
  public function cek_ada($provinsi_id,$kabupaten_id,$kecamatan_id){
      $query = $this->db
                      ->select('*')
                      ->from("t_kabupaten,t_provinsi")
                      ->where("t_kabupaten.provinsi_id=t_provinsi.id and t_kecamatan.kabupaten_id=t_kabupaten.id")
                      ->where($this->_tqr.'.'.'deleted','0')
                      ->where($this->_tqrprov.'.'.'deleted','0')
                      ->where($this->_tqrkab.'.'.'deleted','0')
                      ->where($this->_tqr.'.'.'id',$kecamatan_id)
                      ->where($this->_tqrprov.'.'.'id',$provinsi_id)
                      ->where($this->_tqrkab.'.'.'id',$kabupaten_id)
                      ->get($this->_tqr);
      return $query->result();
  }
  public function get_id($view_id){
      $query = $this->db
              ->select('*')
              ->from($this->_tqr)
              ->where($this->_tq.'.'.substr($this->_tqr, 2).'_id='.$this->_tqr.'.'.'id')
              ->where($this->_tq.'.'.'deleted','0')
              ->where($this->_tq.'.'.'id',$view_id)
              ->get($this->_tq);
      return $query;
  }
  public function updated($update_id){
      $kelurahan = strtolower($this->input->post('nama_kelurahan'));
      $update = array(
                      'kelurahan'        => ucwords($kelurahan),
                      'kecamatan_id'     => $this->input->post('kecamatan_id'),
                      'type_kelurahan'   => $this->input->post('type_kelurahan'),
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
                      ->select($this->_tqr.".id")
                      ->select($this->_tqr.".kecamatan name")
                      ->select("(SELECT GROUP_CONCAT(CONCAT(k.kelurahan)SEPARATOR ', ') 
                                  FROM t_kelurahan k WHERE k.kecamatan_id = t_kecamatan.id AND k.id = '".$view_id."') 
                                  AS selected")
                      ->where($this->_tqr.'.deleted','0')
                      ->order_by($this->_tqr.'.kecamatan', 'ASC')
                      ->get($this->_tqr);
      return $query->result();

  }
  public function cek_double($nama_kelurahan,$kecamatan_id){
      $query = $this->db
                      ->select('id,kelurahan')
                      ->where('deleted','0')
                      ->where("(kelurahan ='".$nama_kelurahan."' AND kecamatan_id ='".$kecamatan_id."')")
                      ->get($this->_tq);
      return $query->result();
  }
  public function input_multiple(){
      $nama_kelurahan = $this->input->post('nama_kelurahan');
      $kecamatan_id = $this->input->post('kecamatan_id');
      $type_kelurahan = $this->input->post('type_kelurahan');
      $provinsi_id = $this->input->post('provinsi_id');
      $kabupaten_id = $this->input->post('kabupaten_id');
      $no = 0;
      for ($i=0; $i < count($nama_kelurahan); $i++){
          if((($nama_kelurahan[$i]=='')and
            ($kecamatan_id=='')and
            ($kabupaten_id=='')and
            ($provinsi_id=='')and
            ($type_kelurahan==''))
            or(($nama_kelurahan[$i]=='')or
              ($kecamatan_id=='')or
              ($kabupaten_id=='')or
              ($provinsi_id=='')or
              ($type_kelurahan==''))){
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
              if(count($nama_kelurahan[$i])==0){
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
                  $cekinput = $this->Kelurahan_m->cek_double($nama_kelurahan[$i],$kecamatan_id);
                  if(count($cekinput)==0)
                  {
                      $cekada = $this->Kelurahan_m->cek_ada($provinsi_id,$kabupaten_id,$kecamatan_id);
                      if(count($cekada)==1){
                          $no++;
                          $datainput = array(
                              'id'             => ucwords(substr($this->_tq, 2,3)).'-'.get_uuid(),
                              'kelurahan'      => ucwords(strtolower($nama_kelurahan[$i])),
                              'type_kelurahan' => $type_kelurahan,
                              'kecamatan_id'   => $kecamatan_id,
                              'date_created'   => date("Y-m-d H:i:s", time()),
                              'date_modified'  => date("Y-m-d H:i:s", time()),
                              'created_by'     => $this->session->userdata('id'),
                              'modified_by'    => $this->session->userdata('id'),
                              'created_byname' => $this->session->userdata('nm_lengkap'),
                              'modified_byname'=> $this->session->userdata('nm_lengkap'),
                              'deleted'        => '0'
                           );
                          $this->db->insert($this->_tq,$datainput);
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
                                                          toastr.success('Input Data Sukses', '$no Data Berhasil Disimpan!');
                                                      }, 1300);
                                                      </script>
                                                    ");
                      }
                      else{
                          $eta = count($cekada);
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
                                                                            toastr.info('Berhasil Dihapus $eta', 'Data Tersebut!');
                                                                        }, 1300);
                                                                        </script>
                                                                      ");
                      }
                  }
                      
              }
          } 
      }
  }

  public function fetch_kab($provinsi_id){
      $this->db->where('provinsi_id',$provinsi_id);
      $this->db->where('deleted','0');
      $this->db->order_by('kabupaten', 'ASC');
      $query = $this->db->get('t_kabupaten');

      $output = '<option value>Pilih Kabupaten</option>';
      foreach ($query->result() as $row) {
        $output .= '<option value="'.$row->id.'">'.$row->kabupaten.'</option>';
      }
      return $output;
  }
  public function fetch_kec($kabupaten_id){
      $this->db->where('kabupaten_id',$kabupaten_id);
      $this->db->where('deleted','0');
      $this->db->order_by('kecamatan', 'ASC');
      $query = $this->db->get('t_kecamatan');

      $output = '<option value>Pilih Kecamatan</option>';
      foreach ($query->result() as $row) {
        $output .= '<option value="'.$row->id.'">'.$row->kecamatan.'</option>';
      }
      return $output;
  }
  
  
  




}
?>