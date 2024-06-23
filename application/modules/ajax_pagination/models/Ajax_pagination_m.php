<?php defined('BASEPATH') or exit('No direct script access allowed');
class Ajax_pagination_m extends CI_Model{
	public $_tq         = "t_kelurahan";//tabel query
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
    public function count_all($search=null){
    	$this->db->select('kl.id,kl.kelurahan');
        $this->db->from('t_kelurahan kl');
        $this->db->from('t_kecamatan kc');
        $this->db->from('t_kabupaten kb');
        $this->db->from('t_provinsi pr');
        $this->db->where('kl.kecamatan_id = kc.id');
        $this->db->where('kc.kabupaten_id = kb.id');
        $this->db->where('kb.provinsi_id = pr.id');
        if(!empty($search)){
            $this->db->where("(kl.kelurahan like '%".$search."%' or kc.kecamatan like '%".$search."%')");
        }
        $this->db->order_by('kl.date_created','DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
    public function fetch_details($limit, $search, $start){
    	$output = '';
    	$this->db->select('kl.*,kc.kecamatan,kb.kabupaten,pr.provinsi');
    	$this->db->from('t_kelurahan kl');
    	$this->db->from('t_kecamatan kc');
    	$this->db->from('t_kabupaten kb');
    	$this->db->from('t_provinsi pr');
    	$this->db->where('kl.kecamatan_id = kc.id');
		$this->db->where('kc.kabupaten_id = kb.id');
		$this->db->where('kb.provinsi_id = pr.id');
        if(!empty($search)){
            $this->db->where("(kl.kelurahan like '%".$search."%' or kc.kecamatan like '%".$search."%')");
        }
    	$this->db->order_by('kl.date_created','DESC');
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
	    				<th>Nama Kel./Desa</th>
	    				<th>Nama Kecamatan</th>
	    				<th>Nama Kabupaten</th>
	    				<th>Nama Provinsi</th>
	    				<th>Date Created</th>
	    				<th>Created By</th>
	    				<th>Action</th>
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
    			<td>'.$row->kelurahan.'</td>
    			<td>'.$row->kecamatan.'</td>
    			<td>'.$row->kabupaten.'</td>
    			<td>'.$row->provinsi.'</td>
    			<td>'.$row->date_created.'</td>
    			<td>'.$row->created_byname.'</td>
    			<td><a href="'.base_url().'ajax_pagination/view/'.$row->id.'">View</a></td>
    		</tr>
    		';
    		$no++;
    	}
    	$output .= '</tbody>
    			</table>
    		</div>';
    	return $output;
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
    public function changePerpageValue($perpageValue,$id){
        $update = array('perpage' => $perpageValue);
        $this->db->where('id',$id);
        $this->db->update($this->_usvd,$update);
    }
}
?>