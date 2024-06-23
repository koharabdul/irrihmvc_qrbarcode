<?php defined('BASEPATH') or exit('No direct script access allowed');
class Forms_m extends CI_Model{
    public $_tq         = "t_form";
    public $_tqd        = "t_form_detail";
    public $_tqcd       = "t_form_child_detail";
    public $_usv        = "t_userview";
    public $_usvd       = "t_userview_detail";
    public $_usvdm      = "t_userviewmanu_detail";
    public $_manuuser   = "t_managementusers";
    public $_manuusers  = "t_manu_users";
    public $_tqu        = "t_users";
    public $_orderby    = "ASC";

    public function get_index(){
        $query = $this->db
            ->select("*")
            ->get($this->_tq);
        return $query->result();
    }
    public function get_activedclass($dataactiveclass){
        $valuePermission = $this->get_PermissionOn($dataactiveclass);
        if(!empty($valuePermission['countPermission'])){
            $query = $this->db
                ->select("u.*")
                ->from($this->_usv." u")
                ->join($this->_usvd." d","u.id=d.id","left")
                ->join($this->_usvdm." m","u.id=m.userview_id","left")
                ->join($this->_manuuser." s","m.managementuser_id=s.id","left")
                ->join($this->_manuusers." mn","s.id=mn.managementuser_id","left")
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
    public function get_runlink($ds){
        $query = $this->db
            ->select("id,tit_actclass")
            ->where("name",$ds)
            ->or_where("name",strtolower($ds))
            ->limit(1)
            ->get($this->_usv);
        return $query->row_array();
    }

    public function saveform(){
        $field = array(
            'id'                => $this->input->post('idForm'),
            'name'              => ucfirst($this->input->post('name')),
            'date_created'      => date("Y-m-d H:i:s", time()),
            'date_modified'     => date("Y-m-d H:i:s", time()),
            'created_by'        => $this->session->userdata('id'),
            'modified_by'       => $this->session->userdata('id'),
            'created_byname'    => $this->session->userdata('nm_lengkap'),
            'modified_byname'   => $this->session->userdata('nm_lengkap')
         );
        $this->db->insert($this->_tq, $field);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function deletedetilform($form_id){
        $this->db->where('form_id', $form_id);
        $this->db->delete($this->_tqd);
    }

    public function insertdetailform($sid,$form_id,$no){
        
        $datainput = array(
            "id"               => $sid,
            "form_id"          => $form_id,
            "no"               => $no
         );
        
        $this->db->insert($this->_tqd,$datainput);        
    }

    public function showAllForm($data_uri){
        $query = $this->db
            ->select("d.id,d.form_id,d.no,IF(c.label!='',label,'Label')label,
                          IF(LEFT(d.id,3)='txt','text',
                          IF(LEFT(d.id,3)='pas','password',
                          IF(LEFT(d.id,3)='dte','date',
                          IF(LEFT(d.id,3)='opt','option',
                          IF(LEFT(d.id,3)='rad','radio',
                          IF(LEFT(d.id,3)='chx','checkbox',
                          IF(LEFT(d.id,3)='txa','textarea',
                          IF(LEFT(d.id,3)='hid','hidden',
                          IF(LEFT(d.id,3)='fil','file upload',
                          IF(LEFT(d.id,3)='cos','Costume HTML','0'))))))))))`type`")
            ->from($this->_tqd." d")
            ->join($this->_tqcd." c",'d.id=c.id','left')
            ->where('d.form_id',$data_uri)
            ->order_by('d.no',$this->_orderby)
            ->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function checkidfromsql($id){
        return $this->db
            ->select("name")
            ->from($this->_tq)
            ->where("id",$id)
            ->where('deleted','0')
            ->get()
            ->row_array();
    }

    public function check_propertiesidfromdetail($id_properties){
        return $this->db
            ->select("f.id,f.name,d.id id_detail")
            ->from($this->_tq. " f")
            ->from($this->_tqd. " d")
            ->where('f.id=d.form_id')
            ->where("d.id",$id_properties)
            ->get()
            ->row_array();
    }
    public function check_propertiesidfromchilddetail($id_properties){
        return $this->db
            ->select("id")
            ->where("id",$id_properties)
            ->get($this->_tqcd)
            ->num_rows();
    }
   
   
}
?>