<?php defined('BASEPATH') or exit('No direct script access allowed');
class Managementusers_m extends CI_Model{
    public $_tq         = "t_managementusers";//tabel query
    public $_orderby    = "ASC";
    public $_usv        = "t_userview";
    public $_usvd       = "t_userview_detail";
    public $_usvdm      = "t_userviewmanu_detail";
    public $_manuuser   = "t_managementusers";
    public $_tqd        = "t_manu_users";
    public $_tqu        = "t_users";


    public function changePerpageValue($perpageValue,$id){
        $update = array('perpage' => $perpageValue);
        $this->db->where('id',$id);
        $this->db->update($this->_usvd,$update);
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
    public function get_index($number,$offset){
        $query = $this->db
            ->select("m.id,m.name,m.description,m.active,m.date_created,m.created_byname")
            ->select("IF(m.active='1','<i class=\"fa fa-check text-navy\"></i>','<i class=\"fa fa-times text-danger\"></i>') activeicon")
            ->select("IF(COUNT(s.nm_lengkap)=0,'-',
                        IF(COUNT(s.nm_lengkap)=1,IF(LENGTH(s.nm_lengkap)<12,s.nm_lengkap,CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:120px;\">
                            <div class=\"panel panel-default\" style=\"border:none;background: transparent;\">
                                    <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'\">',LEFT(s.nm_lengkap,11),' ...','</a>
                                <div id=\"',m.id,'\" class=\"panel-collapse collapse\">
                                    <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">',
                                        CONCAT('<li>',s.nm_lengkap,'</li>'),'
                                    </ol>
                                </div>
                            </div>
                        </div>')),
                        CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:120px;\">
                            <div class=\"panel panel-default\" style=\"border:none;background: transparent;\">
                                    <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'\">',LEFT(s.nm_lengkap,11),' ...','</a>
                                <div id=\"',m.id,'\" class=\"panel-collapse collapse\">
                                    <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">
                                        
                                        ',GROUP_CONCAT('<li>',s.nm_lengkap SEPARATOR '</li>'),
                                    '</ol>
                              
                              </div>
                            </div>
                        </div>')
                        ))countnmlengkap")
            ->select("(SELECT IF(COUNT(us.name)=0,'-',
                        IF(COUNT(us.name)=1,IF(LENGTH(us.name)<12,CONCAT('<div style=\"margin-bottom:0px;width:160px;\">',us.name,IF(d.hide_as_permission_on='1','<i class=\"fa fa-flag pull-right text-navy\" style=\"margin-top:3px;\"></i>',''),'</div>'),CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:135px;\">
                            <div class=\"panel panel-default\" style=\"border:none;background: transparent;\">
                                    <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'s','\">',LEFT(us.name,11),' ...','</a>
                                <div id=\"',m.id,'s','\" class=\"panel-collapse collapse\">
                                    <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">',
                                        CONCAT('<li>',us.name,'</li>'),'
                                    </ol>
                                </div>
                            </div>
                        </div>')),
                        CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:135px;\">
                            <div class=\"panel panel-default\" style=\"border:none;background: transparent; \">
                                    <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'s','\">',LEFT(us.name,11),' ...','</a>
                                <div id=\"',m.id,'s','\" class=\"panel-collapse collapse\">
                                <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">
                                    
                                        ',GROUP_CONCAT('<li>',us.name,IF(d.hide_as_permission_on='1','<i class=\"fa fa-flag pull-right text-navy\" style=\"margin-top:3px;\"></i>','') SEPARATOR '</li>'),'
                                </ol>
                              </div>
                            </div>
                        </div>')
                        )) FROM t_userviewmanu_detail ud,t_userview us LEFT JOIN t_userview_detail d ON us.id = d.id WHERE m.id= ud.managementuser_id AND ud.userview_id=us.id)groupuserview")
            ->join($this->_tqd." u",'m.id=u.managementuser_id','left')
            ->join($this->_tqu." s",'u.user_id=s.id','left')
            ->where('m.deleted','0')
            ->group_by("m.id")
            ->order_by('date_created',$this->_orderby)
            ->get($this->_tq." m",$number,$offset);
        return $query->result();
    }
    public function jumlah_data(){  //jang pagination
      return $this->db
            ->select("id")
            ->where('deleted','0')
            ->get($this->_tq)
            ->num_rows();
    }
    public function jumlah_data_cari(){
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
                        ->where("(name like '%".$tampil."%' or description like '%".$tampil."%')")
                        ->get($this->_tq)
                        ->num_rows();
        }
        else{
            return $this->db
                        ->select('id')
                        ->where('deleted','0')
                        ->where("(name like '%".$datacari."%' or description like '%".$datacari."%')")
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
            $query = $this->db->select("m.*")
                                ->select("IF(m.active='1','<i class=\"fa fa-check text-navy\"></i>','<i class=\"fa fa-times text-danger\"></i>') activeicon")
                                ->select("IF(COUNT(s.nm_lengkap)=0,'-',
                                            IF(COUNT(s.nm_lengkap)=1,IF(LENGTH(s.nm_lengkap)<12,s.nm_lengkap,CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:120px;\">
                                                <div class=\"panel panel-default\" style=\"border:none;background: transparent;\">
                                                        <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'\">',LEFT(s.nm_lengkap,11),' ...','</a>
                                                    <div id=\"',m.id,'\" class=\"panel-collapse collapse\">
                                                        <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">',
                                                            CONCAT('<li>',s.nm_lengkap,'</li>'),'
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>')),
                                            CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:120px;\">
                                                <div class=\"panel panel-default\" style=\"border:none;background: transparent;\">
                                                        <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'\">',LEFT(s.nm_lengkap,11),' ...','</a>
                                                    <div id=\"',m.id,'\" class=\"panel-collapse collapse\">
                                                        <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">
                                                            
                                                            ',GROUP_CONCAT('<li>',s.nm_lengkap SEPARATOR '</li>'),
                                                        '</ol>
                                                  
                                                  </div>
                                                </div>
                                            </div>')
                                            ))countnmlengkap")
                               ->select("(SELECT IF(COUNT(us.name)=0,'-',
                                            IF(COUNT(us.name)=1,IF(LENGTH(us.name)<12,CONCAT('<div style=\"margin-bottom:0px;width:160px;\">',us.name,IF(d.hide_as_permission_on='1','<i class=\"fa fa-flag pull-right text-navy\" style=\"margin-top:3px;\"></i>',''),'</div>'),CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:135px;\">
                                                <div class=\"panel panel-default\" style=\"border:none;background: transparent;\">
                                                        <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'s','\">',LEFT(us.name,11),' ...','</a>
                                                    <div id=\"',m.id,'s','\" class=\"panel-collapse collapse\">
                                                        <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">',
                                                            CONCAT('<li>',us.name,'</li>'),'
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>')),
                                            CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:135px;\">
                                                <div class=\"panel panel-default\" style=\"border:none;background: transparent; \">
                                                        <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'s','\">',LEFT(us.name,11),' ...','</a>
                                                    <div id=\"',m.id,'s','\" class=\"panel-collapse collapse\">
                                                    <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">
                                                        
                                                            ',GROUP_CONCAT('<li>',us.name,IF(d.hide_as_permission_on='1','<i class=\"fa fa-flag pull-right text-navy\" style=\"margin-top:3px;\"></i>','') SEPARATOR '</li>'),'
                                                    </ol>
                                                  </div>
                                                </div>
                                            </div>')
                                            )) FROM t_userviewmanu_detail ud,t_userview us LEFT JOIN t_userview_detail d ON us.id = d.id WHERE m.id= ud.managementuser_id AND ud.userview_id=us.id)groupuserview")
                                ->join($this->_tqd." u",'m.id=u.managementuser_id','left')
                                ->join($this->_tqu." s",'u.user_id=s.id','left')
                                ->where('m.deleted','0')
                                ->where("(m.name like '%".$tampil."%' or m.description like '%".$tampil."%')")
                                ->group_by("m.id")
                                ->order_by("m.date_created", $this->_orderby)
                                ->get($this->_tq." m",$number,$offset);
            return $query->result();
        }
        else{
            $query = $this->db->select("m.*")
                                
                                ->select("IF(m.active='1','<i class=\"fa fa-check text-navy\"></i>','<i class=\"fa fa-times text-danger\"></i>') activeicon")
                                ->select("IF(COUNT(s.nm_lengkap)=0,'-',
                                            IF(COUNT(s.nm_lengkap)=1,IF(LENGTH(s.nm_lengkap)<12,s.nm_lengkap,CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:135px;\">
                                                <div class=\"panel panel-default\" style=\"border:none;background: transparent;\">
                                                        <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'\">',LEFT(s.nm_lengkap,11),' ...','</a>
                                                    <div id=\"',m.id,'\" class=\"panel-collapse collapse\">
                                                        <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">',
                                                            CONCAT('<li>',s.nm_lengkap,'</li>'),'
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>')),
                                            CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:135px;\">
                                                <div class=\"panel panel-default\" style=\"border:none;background: transparent;\">
                                                        <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'\">',LEFT(s.nm_lengkap,11),' ...','</a>
                                                    <div id=\"',m.id,'\" class=\"panel-collapse collapse\">
                                                        <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">
                                                            
                                                            ',GROUP_CONCAT('<li>',s.nm_lengkap SEPARATOR '</li>'),
                                                        '</ol>
                                                  
                                                  </div>
                                                </div>
                                            </div>')
                                            ))countnmlengkap")
                                ->select("(SELECT IF(COUNT(us.name)=0,'-',
                                            IF(COUNT(us.name)=1,IF(LENGTH(us.name)<12,CONCAT('<div style=\"margin-bottom:0px;width:160px;\">',us.name,IF(d.hide_as_permission_on='1','<i class=\"fa fa-flag pull-right text-navy\" style=\"margin-top:3px;\"></i>',''),'</div>'),CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:135px;\">
                                                <div class=\"panel panel-default\" style=\"border:none;background: transparent;\">
                                                        <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'s','\">',LEFT(us.name,11),' ...','</a>
                                                    <div id=\"',m.id,'s','\" class=\"panel-collapse collapse\">
                                                        <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">',
                                                            CONCAT('<li>',us.name,'</li>'),'
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>')),
                                            CONCAT('<div class=\"panel-group\" id=\"accordion\" style=\"margin-bottom:0px;width:135px;\">
                                                <div class=\"panel panel-default\" style=\"border:none;background: transparent; \">
                                                        <a data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#',m.id,'s','\">',LEFT(us.name,11),' ...','</a>
                                                    <div id=\"',m.id,'s','\" class=\"panel-collapse collapse\">
                                                    <ol style=\"margin-left:-26px;margin-right:-26px;margin-bottom:0px;\">
                                                        
                                                            ',GROUP_CONCAT('<li>',us.name,IF(d.hide_as_permission_on='1','<i class=\"fa fa-flag pull-right text-navy\" style=\"margin-top:3px;\"></i>','') SEPARATOR '</li>'),'
                                                    </ol>
                                                  </div>
                                                </div>
                                            </div>')
                                            )) FROM t_userviewmanu_detail ud,t_userview us LEFT JOIN t_userview_detail d ON us.id = d.id WHERE m.id= ud.managementuser_id AND ud.userview_id=us.id)groupuserview")
                                ->join($this->_tqd." u",'m.id=u.managementuser_id','left')
                                ->join($this->_tqu." s",'u.user_id=s.id','left')
                                ->where('m.deleted','0')
                                ->where("(m.name like '%".$datacari."%' or m.description like '%".$datacari."%')")
                                ->group_by("m.id")
                                ->order_by("m.date_created", $this->_orderby)
                                ->get($this->_tq." m",$number,$offset);
            return $query->result();
        }  
    }
    public function get_users(){
        $query = $this->db
            ->select("id,nm_lengkap")
            ->from('t_users')
            ->where('deleted','0')
            ->get();
        return $query->result();
    }
    public function checkdouble($name){
        return $this->db
            ->select("id")
            ->where('deleted','0')
            ->where('name',$name)
            ->get($this->_tq)
            ->num_rows();
    }
    public function createManlu($insert){
        $this->db->insert($this->_tq,$insert);
    }
    public function createManluv($insert_manu){
        $this->db->insert($this->_tqd,$insert_manu);
    }
    public function deletes($deletes_id){
        $update = array('deleted' => '1');
        $this->db->where('id',$deletes_id);
        $this->db->update($this->_tq,$update);
    }
    public function perpageAndId($dataactiveclass){
        $query = $this->db
            ->select("u.id,u.name,d.perpage")
            ->from($this->_usvd." d")
            ->where("u.name",$dataactiveclass)
            ->where("u.id=d.id")
            ->limit(1)
            ->get($this->_usv." u");
        return $query->row_array();
    }
    public function checkItManagementUsers($id){
        return $this->db
            ->select("id")
            ->where('deleted','0')
            ->where('id',$id)
            ->get($this->_tq)
            ->num_rows();
    }

    public function get_idview($id){
        $query = $this->db
            ->select('m.*')
            ->select("IF(COUNT(s.nm_lengkap)=0,'<span style='\"margin-left:25px;\"'>-</span>',CONCAT('<ol>',GROUP_CONCAT('<li>',s.nm_lengkap,'</li>' SEPARATOR ''),'</ol>'))groupuser")
            ->select("IF(COUNT(s.nm_lengkap)=0,'',GROUP_CONCAT(s.id SEPARATOR ','))groupiduser")
            ->select("(SELECT IF(COUNT(us.name)=0,'<span style='\"margin-left:25px;\"'>-</span>',CONCAT('<ol>',GROUP_CONCAT('<li>',us.name,'</li>' SEPARATOR ''),'</ol>')) 
                        FROM t_userviewmanu_detail ud,t_userview us 
                        WHERE m.id= ud.managementuser_id 
                        AND ud.userview_id=us.id)groupuserview")
            ->from($this->_tq." m")
            ->join($this->_tqd." u",'m.id=u.managementuser_id','left')
            ->join($this->_tqu. " s",'u.user_id=s.id','left')
            ->where('m.id',$id)
            ->where('m.deleted','0')
            ->group_by("m.id")
            ->get();
        return $query;
    }
    public function get_selectleveluser(){
      
        $query = $this->db->select('id,nm_lengkap');
        $query = $this->db->where('deleted','0');
        $query = $this->db->order_by('date_created',$this->_orderby);
        $query = $this->db->get($this->_tqu);
        $result = $query->result();

        $id_levu = array();//before array();
        $name = array();//before array('...');
        
        for ($i = 0; $i < count($result); $i++)
        {
            array_push($id_levu, $result[$i]->id);
            array_push($name, $result[$i]->nm_lengkap);
        }
        return array_combine($id_levu, $name);
    }

    public function get_selectedleveluser($id)
    {
        $this->db->select('user_id');
        $this->db->where('managementuser_id', $id);
        $ret = $this->db->get($this->_tqd);
        $group = array();
        foreach ($ret->result() as $r) {
            array_push($group, $r->user_id);
        }
        return $group;
    }
    public function get_selectedleveluser2($id){
        $this->db->select("GROUP_CONCAT(user_id) user_ids");
        $this->db->where('managementuser_id',$id);
        $this->db->group_by('managementuser_id');
        $query = $this->db->get($this->_tqd);
        return $query->row_array();
    }

    public function update($update){
        $this->db->where('id',$this->input->post('id'));
        $this->db->update($this->_tq,$update);
    }
    public function deleteBeforeUpdate($id){
        $this->db->where('managementuser_id',$id);
        $this->db->delete($this->_tqd);
    }
    public function updateManluv($insert_manu){
        $this->db->insert($this->_tqd,$insert_manu);
    }
    public function deleteManu($id){
        $update = array('deleted'  => '1');
        $this->db->where('id',$id);
        $this->db->update($this->_tq,$update);
    }
    public function count_all($search=null){
        $this->db->select('id');
        $this->db->from('t_users');
        $this->db->where('deleted','0');
        if(!empty($search)){
            $this->db->where("(nm_lengkap like '%".$search."%' 
                               or NIK like '%".$search."%'
                               or pendidikan like '%".$search."%'
                              )");
        }
        $this->db->order_by('nm_lengkap','ASC');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function fetch_details($limit, $search, $start,$id){
        $output = '';
        $this->db->select('*');
        $this->db->from('t_users');
        $this->db->where('deleted','0');
        if(!empty($search)){
            $this->db->where("(nm_lengkap like '%".$search."%' 
                               or NIK like '%".$search."%'
                               or pendidikan like '%".$search."%'
                              )");
        }
        $this->db->order_by('nm_lengkap','ASC');
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
                                <input type="checkbox" id="checkall_users" style="">
                                <label>
                                </label>
                            </div>
                        </th>
                        <th>No.</th>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>Tempat, Tgl. Lahir</th>
                        <th>Pendidikan</th>
                    </tr>
                    </thaead>
                    <tbody>
            ';
        $no = $start+1;
        if(empty($query->result())){
                $output.='
                    <tr>
                        <td colspan="7">
                            No matching records found
                        </td>
                    </tr>
                ';
            }
        foreach ($query->result() as $row) {
            $resultChecked = $this->get_selectedleveluser2($id);
            $tampil = '';
            if($resultChecked!=''){
                $arr_kalimat = explode(',', $resultChecked['user_ids']);
                foreach ($arr_kalimat as $v) {
                    if($v!=''){
                        if($row->id==$v){
                            $checked = 'checked';
                        }
                        else{
                            $checked = '';
                        }

                        if(empty($tampil)){
                            $tampil = $checked;
                        }
                        else{
                            $tampil = $tampil."".$checked;
                        }
                    }
                }
            }
            
            $output .='
            <tr>
                <td>
                    <div class="checkbox checkbox-inline" >
                        <input type="checkbox" name="table_records[]" id="table_records" class="checkitem_users" value="'.$row->id.'" '.$tampil.'>
                        <label>
                        </label>
                    </div>
                </td>
                <td>'.$no.'</td>
                <td>'.$row->nm_lengkap.'</td>
                <td>'.$row->NIK.'</td>
                <td>'.$row->tmp_lahir.', '.date_convert($row->tgl_lahir).'</td>
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
    

}
?>