<?php defined('BASEPATH') or exit('No direct script access allowed');
class Userviews_m extends CI_Model{
    public $_usv        = "t_userview";//tabel query
    public $_usvd       = "t_userview_detail";// tabel query detail
    public $_usvm       = "t_managementusers";// tabel query detail
    public $_usvdm      = "t_userviewmanu_detail";// tabel query detail
    public $_orderby    = "ASC";
    public $_manuuser   = "t_managementusers";
    public $_manuusers  = "t_manu_users";
    public $_tquser     = "t_users";

    public function get_index(){
        $query = $this->db
            ->select("u.*")
            ->select("IF(d.hide_as_permission_on='1','<span class=\"pull-right text-navy\" style=\"margin-top:12px; margin-right:3px;\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Permission Has Been Actived\" ><strong><i class=\"fa fa-flag\"></i></strong></span>','')flag")
            ->from($this->_usv." u")
            ->join($this->_usvd." d","u.id=d.id","left")
            ->order_by('u.no',$this->_orderby)
            ->get();
        return $query->result();
    }

    public function getMenuUserview(){
        $query = $this->db
            ->select("menu_userview")
            ->limit('1')
            ->where('deleted','0')
            ->get('t_config');
        return $query->row_array();
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
                ->join($this->_tquser." us","mn.user_id=us.id","left")
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
    

    public function insert($fid,$fno,$fname,$fstaus,$flink,$ficon,$status_no,$momies){
        // $name = strtolower($fname);
        $arrlink = explode(' ', $flink);
        foreach ($arrlink as $k) {
            if($k!=''){
                if(empty($tampil)){
                    $tampil = $k;
                }
                else{
                    $tampil = $tampil.$k;
                }
            }
        }
        if(empty($momies)){
            $momies = "";
        }
        else{
            $momies = $momies;
        }
        $arrmomies= explode(' ', $momies);
        foreach ($arrmomies as $kk) {
            if($kk!=''){
                if(empty($smomies)){
                    $smomies = $kk;
                }
                else{
                    $smomies = $smomies.$kk;
                }
            }
        }
        if(empty($smomies)){
            $smomies = "";
        }
        else{
            $smomies = $smomies;
        }

        $datainput = array(
            "id"               => $fid,
            "no"               => $fno,
            "name"             => $fname,
            "status"           => $fstaus,
            "tit_actclass"     => strtolower($smomies),
            "s_no"             => $status_no,
            "link"             => strtolower($tampil),
            "icon"             => $ficon,
            "date_created"     => date("Y-m-d H:i:s", time()),
            "created_by"       => $this->session->userdata('id'),
            "created_byname"   => $this->session->userdata('nm_lengkap')
         );
        
        $this->db->insert($this->_usv,$datainput);
        ///tambahan untuk mengisi detail userviewnya supaya otomatis ke isi oleh userview ketika ngecreate
        $jumlah = $this->jumlah_data_id($fid);
        if($jumlah==0){
            $datainputid = array('id' => $fid );
            $this->db->insert($this->_usvd,$datainputid);
        }
    }

    function jumlah_data_id($fid){  //jang pagination
        return $this->db
            ->select("id")
            ->where('id',$fid)
            ->get($this->_usvd)
            ->num_rows();
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

    public function content_runlink($showrun){
        $query = $this->db
            ->select("id,name")
            ->where("link",$showrun)
            ->or_where("link",strtolower($showrun))
            ->limit(1)
            ->get($this->_usv);
        return $query->row_array();
    }

    public function get_max(){
        $query = $this->db
            ->select_max('no')
            ->get($this->_usv);
            return $query->result();

    }
    
   
   public function get_idsetting($id){
        $query = $this->db
                        ->select('*')
                        ->where('id',$id)
                        ->get($this->_usv);
        return $query;
    }
    public function get_idsettings($id){
        $query = $this->db
                        ->select('*')
                        ->where('id',$id)
                        ->get($this->_usvd);
        return $query;
    }
    public function get_selectleveluser(){
      
        $query = $this->db->select('id,name');
        $query = $this->db->where('deleted','0');
        $query = $this->db->order_by('date_created',$this->_orderby);
        $query = $this->db->get($this->_usvm);
        $result = $query->result();

        $id_levu = array();//before array();
        $name = array();//before array('...');
        
        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id_levu, $result[$i]->id);
            array_push($name, $result[$i]->name);
        }
        return array_combine($id_levu, $name);
    }
   

    public function get_selectedleveluser($id)
    {
        $this->db->select('managementuser_id');
        $this->db->where('userview_id', $id);
        $ret = $this->db->get($this->_usvdm);
        $group = array();
        foreach ($ret->result() as $r) {
            array_push($group, $r->managementuser_id);
        }
        return $group;
    }

    public function deletepermision(){
        $id = $this->input->post('idSet');
        $this->db->where('userview_id',$id);
        $this->db->delete($this->_usvdm);
        if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
    }

    public function inputpermition($k){
        $id = $this->input->post('idSet');
        $datainput = array(
            "userview_id"           => $id,
            "managementuser_id"     => $k,
            "date_created"          => date("Y-m-d H:i:s", time()),
            "created_by"            => $this->session->userdata('id'),
            "created_byname"        => $this->session->userdata('nm_lengkap')
         );
        
        $this->db->insert($this->_usvdm,$datainput);
    }

    public function delete($deleteid){
        $this->db->where('id',$deleteid);
        $this->db->where("status!='Mamah'");
        $this->db->delete($this->_usv);

        $this->db->where('id',$deleteid);
        $this->db->delete($this->_usvd);

        $this->db->where('userview_id',$deleteid);
        $this->db->delete($this->_usvdm);
        if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
    }

    public function setting($id){
        $query = $this->db
              ->select('*')
              ->where('id',$id)
              ->get($this->_usv);
        return $query;
    }
    public function sendingupdated($field,$fields){
        $id = $this->input->post('idSet');
        
        $this->db->where('id',$id);
        $this->db->update($this->_usv, $field);

        $this->db->where('id',$id);
        $this->db->update($this->_usvd, $fields);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function checkDualId($deleted){
        $query = $this->db
            ->select("no,s_no,link,status,tit_actclass")
            ->from($this->_usv)
            ->where("id",$deleted)
            ->get();
        return $query->row_array();
    }
    public function checkStatus($deleted){
        $query = $this->db
            ->select("status")
            ->from($this->_usv)
            ->where("id",$deleted)
            ->get();
        return $query->row_array();
    }
    public function checkjumlah($k){
        return $this->db
          ->select('id')
          ->where("tit_actclass!=''")
          ->where('tit_actclass',$k)
          ->get($this->_usv)
          ->num_rows();
    }
    public function checkMomies($k){
        $query = $this->db
            ->select("*")
            ->from($this->_usv)
            ->where("id",$deleted)
            ->get();
        return $query->row_array();
    }
    public function checkStatusMom($i){
        $query = $this->db
            ->select("id,name,no,s_no,status,tit_actclass")
            ->from($this->_usv)
            ->where("no",$i)
            ->get();
        return $query->row_array();
    }
    public function checkStatusNo($showNoMinOne,$statusUv,$showNoOrg){
        $update = array('status'  => $statusUv);
        $this->db->where('no',$showNoMinOne);//
        $this->db->update($this->_usv,$update);
        //////////////////////////////////////////////////////top update, down delete
        $this->db->where('no',$showNoOrg);
        $this->db->delete($this->_usv);
        if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }

    }
    public function deleteStatusMamah($tit_actclass){
        $this->db->like('tit_actclass',$tit_actclass);
        $this->db->delete($this->_usv);
        if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
    }


    public function countStatusMom2($tit_actclass){
        return $this->db
          ->select('id')
          ->where('tit_actclass',$tit_actclass)
          ->get($this->_usv)
          ->num_rows();
    }
   

    public function finalMaxMom($w){
        $query = $this->db
            ->select("*")
            ->select("max(no)nilai_max")
            ->from($this->_usv)
            ->like("tit_actclass",$w)
            ->like('status','Ayah')
            ->get();
        return $query->row_array();
    }


    public function finalMax(){
        $query = $this->db
            ->select("max(no) max")
            ->from($this->_usv)
            ->get();
        return $query->row_array();
    }

    public function editStatus($id,$status,$s_no,$tit_actclass){
        $update = array('status'  => $status,
                        'tit_actclass' => $tit_actclass,
                        's_no' => $s_no);
        $this->db->where('id',$id);//
        $this->db->update($this->_usv,$update);
    }
    public function editStatus2($id,$status){
        $update = array('status'  => $status);
        $this->db->where('id',$id);//
        $this->db->update($this->_usv,$update);
    }

    public function insertToConfig($datacontent){
        $update = array('menu_userview'  => $datacontent);
        $this->db->where('id', 'COMP-f558ef00-d9d7-7c46-b90c-6871c954e9f3');//
        $this->db->where('deleted','0');
        $this->db->update('t_config',$update);

    }
    public function deleteUserviewDetail($e){
        $this->db->where('id',$e);
        $this->db->delete($this->_usvd);

        $this->db->where('userview_id',$e);
        $this->db->delete($this->_usvdm);
        if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
    }
    

    
}
?>