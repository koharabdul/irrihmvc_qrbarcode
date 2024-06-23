<?php defined('BASEPATH') or exit('No direct script access allowed');
class Programbansos_m extends CI_Model{
	public $_tq         = "penduduk";//tabel query
    public $_tq_detail  = "penduduk_detail";
    public $_orderby    = "ASC";
    public $_usv        = "t_userview";
    public $_usvd       = "t_userview_detail";
    public $_usvdm      = "t_userviewmanu_detail";
    public $_manuuser   = "t_managementusers";
    public $_tqd        = "t_manu_users";
    public $_tqu        = "t_users";

	public function get_activedclass($dataactiveclass){
        $valuePermission = $this->get_PermissionOn($dataactiveclass);
        if(!empty($valuePermission['countPermission'])){
            $query = $this->db
                ->select("u.*")
                ->from($this->_usv." u")
                ->join($this->_usvd." d","u.id=d.id","left")
                ->join($this->_usvdm." m","u.id=m.userview_id","left")
                ->join($this->_manuuser." s","m.managementuser_id=s.id","left")
                ->join($this->_tqd." mn","s.id=mn.managementuser_id","left")
                ->join($this->_tqu." us","mn.user_id=us.id","left")
                ->where("(u.name='".$dataactiveclass."' or u.name='".strtolower($dataactiveclass)."')")
                ->where("us.id",$this->session->userdata('id'))
                ->limit(1)
                ->get();
            return $query->row_array();
        }
        else{
            $query = $this->db
                ->select("u.*,d.hide_as_permission_on")
                ->from($this->_usv." u")
                ->join($this->_usvd." d","u.id=d.id","left")
                ->where("(u.name='".$dataactiveclass."' or u.name='".strtolower($dataactiveclass)."')")
                ->limit(1)
                ->get();
            return $query->row_array();
        }    
    }
    public function get_PermissionOn($dataactiveclass){
        $query = $this->db->select("COUNT(mn.managementuser_id) countPermission");
        $query = $this->db->from($this->_usv." u");
        $query = $this->db->from($this->_usvdm." mn");
        $query = $this->db->where("u.id = mn.userview_id");
        $query = $this->db->where("(u.name='".$dataactiveclass."' or u.name='".strtolower($dataactiveclass)."')");
        $query = $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function content_runlink($showrun){
        $query = $this->db
            ->select("id,name")
            ->where("link",$showrun)
            ->or_where("link",strtolower($showrun))
            ->limit(1)
            ->get($this->_usv);
        return $query->row_array();
    }
    public function perpageAndId($dataactiveclass){
        $query = $this->db
            ->select("u.id,u.name,u.link,d.perpage")
            ->from($this->_usvd." d")
            ->where("u.name",$dataactiveclass)
            ->where("u.id=d.id")
            ->limit(1)
            ->get($this->_usv." u");
        return $query->row_array();
    }
    public function select(){
        $this->db->select('*');
        $query = $this->db->get($this->_tq);
        return $query->num_rows();
    }
    public function insertpenduduk($data_detail){
        $this->db->insert($this->_tq_detail,$data_detail);
    }
    public function insertkk($data){
        $this->db->insert($this->_tq,$data);
    }
    public function cek_input($no_kk){
        $query = $this->db
                        ->select('id,no_kk')
                        ->where('no_kk',$no_kk)
                        ->get($this->_tq);
        return $query->result();
    }
    public function check_nokk($no_kk){
        $query = $this->db
            ->select("id,no_kk")
            ->where("no_kk",$no_kk)
            ->limit(1)
            ->get($this->_tq);
        return $query->row_array();
    }
    public function count_all($nama_alamat,$nik_or_kk,$rt,$rw,$jns_kelamin,$set_umur,$umur,$smpumur,$sampaiTanggal){
        $this->db->select("a.id");
        if(($sampaiTanggal==0) or (empty($sampaiTanggal)) or ($sampaiTanggal=='')){
             $this->db->select("CASE
                            WHEN ((MID(DATE_FORMAT(NOW(),'%Y%m%d'),5,2))<(MID(DATE_FORMAT(tgl_lahir,'%Y%m%d'),5,2)))
                            THEN ((LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))-1))
                            WHEN (MID(DATE_FORMAT(NOW(),'%Y%m%d'),5,2)=MID(DATE_FORMAT(tgl_lahir,'%Y%m%d'),5,2))
                            THEN (CASE
                                WHEN (RIGHT(DATE_FORMAT(NOW(),'%Y%m%d'),2)<RIGHT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),2))
                                THEN ((LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))-1))
                                ELSE ((LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4)))) END
                                  ) 
                            ELSE (LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))) END AS age");
        }
        else{
            $this->db->select("CASE
                            WHEN ((MID(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),5,2))<(MID(DATE_FORMAT(tgl_lahir,'%Y%m%d'),5,2)))
                            THEN ((LEFT(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))-1))
                            WHEN (MID(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),5,2)=MID(DATE_FORMAT(tgl_lahir,'%Y%m%d'),5,2))
                            THEN (CASE
                                WHEN (RIGHT(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),2)<RIGHT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),2))
                                THEN ((LEFT(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))-1))
                                ELSE ((LEFT(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4)))) END
                                  ) 
                            ELSE (LEFT(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))) END AS age");
        }
        
        $this->db->from($this->_tq." a");
        $this->db->from($this->_tq_detail." b");
        $this->db->where("a.id=b.idkk");

        if(!empty($nama_alamat)){
            $this->db->where("(b.nm_lengkap like '%".$nama_alamat."%' or a.alamat like '%".$nama_alamat."%')");
        }
        if(!empty($nik_or_kk)){
            $this->db->where("(b.nik like '%".$nik_or_kk."%' or a.no_kk like '%".$nik_or_kk."%')");
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
      
        if(!empty($rw)){
            $this->db->where("a.rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("b.jns_kelamin",$jns_kelamin);
        }

        


        $this->db->where('a.deleted','0');
        $this->db->where('b.deleted','0');
        if(!empty($umur)){
            if(!empty($smpumur)){
                if($set_umur=='BETWEEN'){
                    $this->db->having("age BETWEEN '".$umur."' AND '".$smpumur."'");
                }else{
                    $this->db->having("age ".$set_umur.$umur);
                }
            }
            else{
                if($set_umur=='BETWEEN'){
                    $this->db->having("age >='".$umur."'");
                }
                else{
                    $this->db->having("age ".$set_umur.$umur);
                }
            }
        }
        $this->db->order_by("a.rw ASC, a.rt ASC, a.no_kk ASC");
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function fetch_details($limit, $start, $nama_alamat,$nik_or_kk,$rt,$rw,$jns_kelamin,$set_umur,$umur,$smpumur,$sampaiTanggal){
        $output = '';
        $this->db->select("*,b.id idD ,DATE_FORMAT(b.tgl_lahir,'%d/%m/%Y') tgl");
        if(($sampaiTanggal==0) or (empty($sampaiTanggal)) or ($sampaiTanggal=='')){
             $this->db->select("CASE
                            WHEN ((MID(DATE_FORMAT(NOW(),'%Y%m%d'),5,2))<(MID(DATE_FORMAT(tgl_lahir,'%Y%m%d'),5,2)))
                            THEN ((LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))-1))
                            WHEN (MID(DATE_FORMAT(NOW(),'%Y%m%d'),5,2)=MID(DATE_FORMAT(tgl_lahir,'%Y%m%d'),5,2))
                            THEN (CASE
                                WHEN (RIGHT(DATE_FORMAT(NOW(),'%Y%m%d'),2)<RIGHT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),2))
                                THEN ((LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))-1))
                                ELSE ((LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4)))) END
                                  ) 
                            ELSE (LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))) END AS age");
        }
        else{
            $this->db->select("CASE
                            WHEN ((MID(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),5,2))<(MID(DATE_FORMAT(tgl_lahir,'%Y%m%d'),5,2)))
                            THEN ((LEFT(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))-1))
                            WHEN (MID(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),5,2)=MID(DATE_FORMAT(tgl_lahir,'%Y%m%d'),5,2))
                            THEN (CASE
                                WHEN (RIGHT(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),2)<RIGHT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),2))
                                THEN ((LEFT(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))-1))
                                ELSE ((LEFT(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4)))) END
                                  ) 
                            ELSE (LEFT(DATE_FORMAT('".$sampaiTanggal."','%Y%m%d'),4)-(LEFT(DATE_FORMAT(tgl_lahir,'%Y%m%d'),4))) END AS age");
        }
        $this->db->select("IF(b.jns_kelamin='P','<i class=\"fa fa-female pull-right\" style=\"color:#f703cea3\"></i>','<i class=\"fa fa-male pull-right\" style=\"color: #1ab394b5;\"></i>')gender");
        $this->db->from($this->_tq." a");
        $this->db->from($this->_tq_detail." b");
        $this->db->where("a.id=b.idkk");

        if(!empty($nama_alamat)){
            $this->db->where("(b.nm_lengkap like '%".$nama_alamat."%' or a.alamat like '%".$nama_alamat."%')");
        }
        if(!empty($nik_or_kk)){
            $this->db->where("(b.nik like '%".$nik_or_kk."%' or a.no_kk like '%".$nik_or_kk."%')");
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
      
        if(!empty($rw)){
            $this->db->where("a.rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("b.jns_kelamin",$jns_kelamin);
        }
        


        

        $this->db->where('a.deleted','0');
        $this->db->where('b.deleted','0');
        // $this->db->having("age>80");
        if(!empty($umur)){
            if(!empty($smpumur)){
                if($set_umur=='BETWEEN'){
                    $this->db->having("age BETWEEN '".$umur."' AND '".$smpumur."'");
                }else{
                    $this->db->having("age ".$set_umur.$umur);
                }
            }
            else{
                if($set_umur=='BETWEEN'){
                    $this->db->having("age >='".$umur."'");
                }
                else{
                    $this->db->having("age ".$set_umur.$umur);
                }
            }
        }
        $this->db->order_by("a.rw ASC, a.rt ASC, a.no_kk ASC,age DESC");
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        $output .='
            <link href="'.base_url().'assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 
            <div class="x_content">
                <table class="table table-striped table-hover responsive-utilities jambo_table bulk_action" style="margin-bottom: 3px;min-width:1600px;" >
                    <thead>
                    <tr>
                        <th width="1px">
                            <div class="checkbox checkbox-inline checkbox-info">
                                <input type="checkbox" id="checkall" class="checkitems" style="">
                                <label>
                                </label>
                            </div>
                        </th>
                        <th>No.</th>
                        <th>No. KK</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Tempat Lahir</th>
                        <th>Tgl. Lahir</th>
                        <th>Umur</th>
                        <th>Status</th>
                        <th>alamat</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Dusun</th>
                        <th>Status</th>
                        <th>Pekerjaan</th>
                        <th>Pendidikan</th>
                    </tr>
                    </thaead>
                    <tbody>
            ';
        $no = $start+1;
        if(empty($query->result())){
                $output.='
                    <tr>
                        <td colspan="13">
                            No matching records found
                        </td>
                    </tr>
                ';
            }
        foreach ($query->result() as $row) {
            $output .='
            <tr>
                <td>
                    <div class="checkbox checkbox-inline checkbox-info" >
                        <input type="checkbox" name="table_records[]" id="table_records" class="checkitem" value="'.$row->idD.'">
                        <label> 
                        </label>
                    </div>
                </td>
                <td>'.$no.'</td>
                <td>'.$row->no_kk.'</td>
                <td>'.$row->nik.'</td>
                <td>'.$row->nm_lengkap.$row->gender.'</td>
                <td>'.ucwords(strtolower($row->tmp_lahir)).'</td>
                <td>'.$row->tgl.'</td>
                <td>'.$row->age.'</td>
                <td>'.$row->sts_perkawinan.'</td>
                <td>'.$row->alamat.'</td>
                <td>'.$row->rt.'</td>
                <td>'.$row->rw.'</td>
                <td>'.$row->dusun.'</td>
                <td>'.$row->sts_perkawinan.'</td>
                <td>'.$row->pekerjaan.'</td>
                <td>'.$row->pendidikan.'</td>
            </tr>
            ';
            $no++;
        }
        $output .= '</tbody>
                </table>
            </div>';
        return $output;
    }
    public function changePerpageValue($perpageValue,$id){
        $update = array('perpage' => $perpageValue);
        $this->db->where('id',$id);
        $this->db->update($this->_usvd,$update);
    }


}
?>