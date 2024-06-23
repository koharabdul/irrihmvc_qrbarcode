<?php defined('BASEPATH') or exit('No direct script access allowed');
class Banprovtahapiii_m extends CI_Model{
	public $_tq         = "banprovtahapiii";//tabel query
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

    public function jumlahnomorurut($namaalamat,$nikkk,$rt,$rw,$terealisasi){
        $this->db->select("id,nm_lengkap,alamat,nik,terdistribusi,nm_desa,LPAD(no_urut,4,0)num,LPAD(rt,'3','0')rts,LPAD(rw,'3','0')rws");
        $this->db->from($this->_tq);
        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or alamat like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($terealisasi)){
            $this->db->where("terdistribusi",$terealisasi);
        }
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function countofTersalurkan(){
        $this->db->select("id");
        $this->db->from($this->_tq);
        $this->db->where("terdistribusi","Tersalurkan");

        
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function countofDitunda(){
        $this->db->select("id");
        $this->db->from($this->_tq);
        $this->db->where("terdistribusi","Ditunda");
        

        
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function countofBelumTersalurkan(){
        $this->db->select("id");
        $this->db->from($this->_tq);
        $this->db->where("terdistribusi","Belum Tersalurkan");

        
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($namaalamat,$nikkk,$rt,$rw,$terealisasi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or alamat like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($terealisasi)){
            $this->db->where("terdistribusi",$terealisasi);
        }

        
        $this->db->order_by("rw ASC, rt ASC, nm_lengkap ASC");
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function fetch_details($limit, $start, $namaalamat,$nikkk,$rt,$rw,$terealisasi){
        $output = '';
        $this->db->select("*");
        $this->db->select("IF(terdistribusi='Belum Tersalurkan',CONCAT('<span class=\"label label-default\">',terdistribusi,'</span>'),IF(terdistribusi='Tersalurkan',CONCAT('<span class=\"label label-success\">',terdistribusi,'</span>'),IF(terdistribusi='Ditunda',CONCAT('<span class=\"label label-warning\">',terdistribusi,'</span>'),'')))AS ketdistribusi");
        $this->db->select("LPAD(no_urut,4,0)num");
        $this->db->select("IF(ket!='',ket,'-')kets");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or alamat like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($terealisasi)){
            $this->db->where("terdistribusi",$terealisasi);
        }

        $this->db->order_by("rw ASC, rt ASC, nm_lengkap ASC");
        // $this->db->order_by("no_urut ASC");
        

        
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        $output .='
            <link href="'.base_url().'assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 
            <div class="x_content">
                <table class="table table-striped table-hover responsive-utilities jambo_table bulk_action" style="margin-bottom: 3px;" >
                    <thead>
                    <tr>
                        <th width="1px">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="checkall" class="checkitems" style="">
                                <label>
                                </label>
                            </div>
                        </th>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Distribusi</th>
                        <th>Ket.</th>
                        <th>Aksi</th>
                    </tr>
                    </thaead>
                    <tbody>
            ';
        $no = $start+1;
        if(empty($query->result())){
                $output.='
                    <tr>
                        <td colspan="9">
                            No matching records found
                        </td>
                    </tr>
                ';
            }
        foreach ($query->result() as $row) {
            $output .='
            <tr>
                <td>
                    <div class="checkbox checkbox-inline" >
                        <input type="checkbox" name="table_records[]" id="table_records" class="checkitem" value="'.$row->id.'">
                        <label> 
                        </label>
                    </div>
                </td>
                <td>'.$no.'</td>
                <td>'.$row->nik.'</td>
                <td>'.$row->nm_lengkap.'<i class="pull-right">'.$row->num.'</i></td>
                <td>'.ucwords(strtolower($row->alamat)).'</td>
                <td>'.$row->rt.'</td>
                <td>'.$row->rw.'</td>
                <td>'.$row->ketdistribusi.'</td>
                <td>'.$row->kets.'</td>
                <td><a href="'.base_url().'banprovtahapiii/view/'.$row->id.'">View</a></td>
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
    public function select(){
        $this->db->select('*');
        $query = $this->db->get($this->_tq);
        return $query->num_rows();
    }
    public function insert($data){
        $this->db->insert_batch($this->_tq,$data);
    }
    public function updateswam($viewid){
        $update = array(
            'terdistribusi'    => 'Tersalurkan',
            'date_modified'    => date("Y-m-d H:i:s", time()),
            'modified_by'      => $this->session->userdata('id'),
            'modified_byname'  => $this->session->userdata('nm_lengkap')
        );
        $this->db->where('id',$viewid);
        $this->db->update($this->_tq,$update);
    }
    public function updateid($detail_id){
        $update = array(
            'terdistribusi'    => 'Tersalurkan',
            'date_modified'    => date("Y-m-d H:i:s", time()),
            'modified_by'      => $this->session->userdata('id'),
            'modified_byname'  => $this->session->userdata('nm_lengkap')
        );
        $this->db->where('id',$detail_id);
        $this->db->update($this->_tq,$update);
    }
    public function denied($detail_id,$remark){
        $remarks = ucwords(strtolower($remark));
        $update = array(
            'ket'              => $remarks,
            'terdistribusi'    => 'Ditunda',
            'date_modified'    => date("Y-m-d H:i:s", time()),
            'modified_by'      => $this->session->userdata('id'),
            'modified_byname'  => $this->session->userdata('nm_lengkap')
        );
        $this->db->where('id',$detail_id);
        $this->db->update($this->_tq,$update);
    }
    public function checkItManagementUsers($id){
        return $this->db
            ->select("id")
            ->where('id',$id)
            ->get($this->_tq)
            ->num_rows();
    }
    public function get_idview($id){
        $query = $this->db
            ->select('*,LPAD(no_urut,4,"0")urut,CONCAT("<label style=\"font-size:30px;\">",LPAD(no_urut,4,"0"),"</label>")nourut,LPAD(rt,3,"0")rts,LPAD(rw,3,"0")rws')
            ->from($this->_tq)
            ->where('id',$id)
            ->get();
        return $query;
    }
    public function printviews(){
        $query = $this->db
            ->select("id,nm_lengkap,nik,no_urut,rt,rw,date_modified")
            ->order_by('date_modified','ASC')
            ->get($this->_tq);
        return $query->result();
    }



}
?>