<?php defined('BASEPATH') or exit('No direct script access allowed');
class Dtks_m extends CI_Model{
	public $_tq         = "dtks";//tabel query
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
    public function insert($data){
        $this->db->insert_batch($this->_tq,$data);
    }
    public function count_all($namaalamat,$nikkk,$id_desa,$id_kecamatan,$id_pengurus,$bantuan){
        $this->db->select("id");
        $this->db->from($this->_tq);


        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or alamat_pengurus like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($id_desa)){
            $this->db->where("kd_desa",$id_desa);
        }
        if(!empty($id_kecamatan)){
            $this->db->where("id_kec",$id_kecamatan);
        }
        if(!empty($id_pengurus)){
             $this->db->where("(id_bdt like '%".$id_pengurus."%' or id_pengurus like '%".$id_pengurus."%')");
        }
        if(!empty($bantuan)){
            $this->db->where("id_kec",$bantuan);
        }

        $this->db->order_by('hub_krt', 'ASC');
        $this->db->group_by('id_bdt');           

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function fetch_details($limit, $start, $namaalamat,$nikkk,$id_desa,$id_kecamatan,$id_pengurus,$bantuan){
        $output = '';
        $this->db->select("id,kd_kec,nm_lengkap,nik,no_kk,alamat_pengurus,tgl_lahir,id_bdt,count(id)jml_art,max(nuk)jml_keluarga,DATE_FORMAT(tgl_lahir,'%d/%m/%Y') tgl");
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
        $this->db->from($this->_tq);
        

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or alamat_pengurus like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($id_desa)){
            $this->db->where("kd_desa",$id_desa);
        }
        if(!empty($id_kecamatan)){
            $this->db->where("id_kec",$id_kecamatan);
        }
        if(!empty($id_pengurus)){
             $this->db->where("(id_bdt like '%".$id_pengurus."%' or id_pengurus like '%".$id_pengurus."%')");
        }
        if(!empty($bantuan)){
            $this->db->where("id_kec",$bantuan);
        }


        $this->db->order_by('hub_krt', 'ASC');
        $this->db->group_by('id_bdt');           

        
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        $output .='
            <link href="'.base_url().'assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 
            <div class="x_content">
                <table class="table table-striped table-hover responsive-utilities jambo_table bulk_action" style="margin-bottom: 3px;" >
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID BDT</th>
                        <th>NIK</th>
                        <th>Nama KRT</th>
                        <th>Tgl. Lahir</th>
                        <th>Umur</th>
                        <th>Alamat</th>
                        <th>Jml. Kel.</th>
                        <th>Jml. ART</th>
                        <th>Action</th>
                    </tr>
                    </thaead>
                    <tbody>
            ';
        $no = $start+1;
        if(empty($query->result())){
                $output.='
                    <tr>
                        <td colspan="10">
                            No matching records found
                        </td>
                    </tr>
                ';
            }
        foreach ($query->result() as $row) {
            $output .='
            <tr>
                <td>'.$no.'</td>
                <td>'.$row->id_bdt.'</td>
                <td>'.$row->nik.'</td>
                <td>'.$row->nm_lengkap.'</td>
                <td>'.$row->tgl.'</td>
                <td>'.$row->age.'</td>
                <td>'.ucwords(strtolower($row->alamat_pengurus)).'</td>
                <td>'.$row->jml_keluarga.'</td>
                <td>'.$row->jml_art.'</td>
                <td><a href="'.base_url().'dtks/view/'.$row->id.'">View</a></td>
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