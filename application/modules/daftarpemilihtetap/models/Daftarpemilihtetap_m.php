<?php defined('BASEPATH') or exit('No direct script access allowed');
class Daftarpemilihtetap_m extends CI_Model{
	public $_tq         = "daftarpemilihtetap";//tabel query
    public $_tq_s       = "dptmutakhir";
    public $_orderby    = "ASC";
    public $_usv        = "t_userview";
    public $_usvd       = "t_userview_detail";
    public $_usvdm      = "t_userviewmanu_detail";
    public $_manuuser   = "t_managementusers";
    public $_tqd        = "t_manu_users";
    public $_tqu        = "t_users";
    public $_tps        = "tps";

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

    public function jum_double($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("COUNT(nik) AS gva");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }
        $this->db->group_by("nik");
        $this->db->having("gva>1");


        $query = $this->db->get();
        return $query->num_rows();
    }

    public function jum_perempuan($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where("jns_kelamin","P");

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function jum_disabilitas_fisik($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where("disabilitas",1);


        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_disabilitas_intelektual($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where("disabilitas",2);


        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_tuna_mental($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where("disabilitas",3);


        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_disabilitas_sensorik($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where("disabilitas",4);


        $query = $this->db->get();
        return $query->num_rows();
    }

    public function jum_cocok($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where("verval","MS");
        $this->db->where("variansi_data","Pemilih Cocok");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_ubah_data($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where("verval","MS");
        $this->db->where("variansi_data","Pemilih Ubah Data");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_baru($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where("verval","MS");
        $this->db->where("variansi_data","Pemilih Baru");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_tms($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where("verval","TMS");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_belum_rekam_ektp($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where("prekaman_ektp","b");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_meninggal($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where('verval','TMS');
        $this->db->where("variansi_data","Meninggal Dunia");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_ditemukan_ganda($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where('verval','TMS');
        $this->db->where("variansi_data","Ditemukan Data Ganda");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_dibawah_umur($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where('verval','TMS');
        $this->db->where("variansi_data","Dibawah Umur");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_pindah_domisili($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where('verval','TMS');
        $this->db->where("variansi_data","Pindah Domisili");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_tidak_ditemukan($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where('verval','TMS');
        $this->db->where("variansi_data","Tidak Ditemukan");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_tni($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where('verval','TMS');
        $this->db->where("variansi_data","TNI");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_polri($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where('verval','TMS');
        $this->db->where("variansi_data","POLRI");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_hilang_ingatan($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where('verval','TMS');
        $this->db->where("variansi_data","Hilang Ingatan");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_hak_pilihdicabut($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where('verval','TMS');
        $this->db->where("variansi_data","Hak Pilih Dicabut");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function jum_bukan_penduduk($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where('verval','TMS');
        $this->db->where("variansi_data","Bukan Penduduk");

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function jum_keluarga($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->group_by('no_kk');

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function jum_laki($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }

        $this->db->where("jns_kelamin","L");

        $query = $this->db->get();
        return $query->num_rows();
    }


    public function count_all($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("a.id");
        $this->db->from($this->_tq." a,".$this->_tps." s");
        $this->db->where("a.id_tps=s.id");

        if(!empty($namaalamat)){
            $this->db->where("(a.nm_lengkap like '%".$namaalamat."%' or a.dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(a.nik like '%".$nikkk."%' or a.no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("a.rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("a.id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("a.verval",$jns_variansi);    
            }
            else if($jns_variansi=='Belum Vervali'){
                $this->db->where("a.verval",null); 
                $this->db->where("a.variansi_data",null);
            }
            else{
                $this->db->where("a.variansi_data",$jns_variansi);
            }
        }

       
        
       

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function fetch_details($limit, $start, $namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$mylink,$jns_variansi){
        $output = '';
        $this->db->select("a.id,a.id oke,a.no_kk,a.nik, a.nm_lengkap, LPAD(s.no_tps,2,0)tps,s.no_tps,s.petugas,
                             a.tmp_lahir, DATE_FORMAT(a.tgl_lahir,'%d/%m/%Y') tgl,
                             a.sts_perkawinan, a.jns_kelamin,a.prekaman_ektp,
                             IF(LENGTH(a.dusun)>=14,CONCAT(LEFT(a.dusun,13),'...'),a.dusun)dus, LPAD(a.rt,2,0)rt, LPAD(a.rw,2,0)rw, IF(a.disabilitas='0','-',a.disabilitas)dis,
                             if(a.verval='MS' AND a.variansi_data='','',if(a.verval='MS' AND a.variansi_data='Pemilih Baru','info',if(a.verval='MS' AND a.variansi_data='Pemilih Ubah Data','warning',if(a.verval='MS' AND a.variansi_data='Pemilih Cocok','success',if(a.verval='TMS','danger','')))))vars,
                             if(a.variansi_data='Pemilih Cocok','<span class=\"label label-success\">Cocok</span>',
                             if(a.variansi_data='Pemilih Baru','<span class=\"label label-info\">Baru</span>',
                             if(a.variansi_data='Pemilih Ubah Data','<span class=\"label label-warning\">Ubah</span>',
                             if(a.variansi_data='Meninggal Dunia','<span class=\"label label-danger\">Meninggal</span>',
                             if(a.variansi_data='Ditemukan Data Ganda','<span class=\"label label-danger\">Ganda</span>',
                             if(a.variansi_data='Dibawah Umur','<span class=\"label label-danger\">Bwh. Umur</span>',
                             if(a.variansi_data='Pindah Domisili','<span class=\"label label-danger\">Pindah</span>',
                             if(a.variansi_data='Tidak Ditemukan','<span class=\"label label-danger\">Tdk. Dikenal</span>',
                             if(a.variansi_data='TNI','<span class=\"label label-danger\">TNI</span>',
                             if(a.variansi_data='POLRI','<span class=\"label label-danger\">POLRI</span>',
                             if(a.variansi_data='Hilang Ingatan','<span class=\"label label-danger\">Hlg. Ingatan</span>',
                             if(a.variansi_data='Hak Pilih Dicabut','<span class=\"label label-danger\">Dicabut</span>',
                             if(a.variansi_data='Bukan Penduduk','<span class=\"label label-danger\">Bkn. Penduduk</span>','')))))))))))))variansi,
                             IF(a.keterangan!='',a.keterangan,'-')ket");
        $this->db->select("IF(a.jns_kelamin='P','<i class=\"fa fa-female pull-right\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Perempuan\" style=\"color:#f703cea3\"></i>','<i class=\"fa fa-male pull-right\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Laki-laki\" style=\"color: #1ab394b5;\"></i>')gender");
        $this->db->select("CASE
                            WHEN ((MID(DATE_FORMAT(NOW(),'%Y%m%d'),5,2))<(MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2)))
                            THEN ((LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                            WHEN (MID(DATE_FORMAT(NOW(),'%Y%m%d'),5,2)=MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2))
                            THEN (CASE
                                WHEN (RIGHT(DATE_FORMAT(NOW(),'%Y%m%d'),2)<RIGHT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),2))
                                THEN ((LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                                ELSE ((LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4)))) END
                                  ) 
                            ELSE (LEFT(DATE_FORMAT(NOW(),'%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))) END AS age");
        $this->db->select("CASE
                            WHEN ((MID(DATE_FORMAT('2020-12-09','%Y%m%d'),5,2))<(MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2)))
                            THEN ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                            WHEN (MID(DATE_FORMAT('2020-12-09','%Y%m%d'),5,2)=MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2))
                            THEN (CASE
                                WHEN (RIGHT(DATE_FORMAT('2020-12-09','%Y%m%d'),2)<RIGHT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),2))
                                THEN ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                                ELSE ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4)))) END
                                  ) 
                            ELSE (LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))) END AS ages");
        // $this->db->select("(SELECT IF(COUNT(b.nik)>1,CONCAT('<span class=\"badge badge-warning pull-right\" style=\"padding-bottom:-3px;\">',COUNT(b.nik),'</span>'),CONCAT('<span class=\"badge badge-primary pull-right\" style=\"padding-bottom:-3px;\">',COUNT(b.nik),'</span>')) FROM daftarpemilihtetap b WHERE b.nik = a.nik GROUP BY a.nik )couble");
        // $this->db->select("(SELECT CONCAT('<span class=\"badge pull-right\" style=\"padding-bottom:-3px;\">',COUNT(b.no_kk),'</span>') FROM daftarpemilihtetap b WHERE b.no_kk = a.no_kk GROUP BY a.no_kk )coubles");
        $this->db->from($this->_tq." a,".$this->_tps." s");
        $this->db->where("a.id_tps=s.id");

        if(!empty($namaalamat)){
            $this->db->where("(a.nm_lengkap like '%".$namaalamat."%' or a.dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(a.nik like '%".$nikkk."%' or a.no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("a.rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("a.id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("a.verval",$jns_variansi);    
            }
            else if($jns_variansi=='Belum Vervali'){
                $this->db->where("a.verval",null); 
                $this->db->where("a.variansi_data",null);
            }
            else{
                $this->db->where("a.variansi_data",$jns_variansi);
            }
        }

        // $this->db->order_by('s.no_tps ASC');
        $this->db->order_by("s.no_tps ASC,a.rw ASC, a.rt ASC, a.no_kk ASC, age DESC");
        

        

        
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        $output .='
            <link href="'.base_url().'assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 
            <div class="x_content">
                <table class="table table-striped table-hover responsive-utilities jambo_table bulk_action" style="margin-bottom: 3px;min-width:1500px;" >
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
                        <th width="10px;">No. KK</th>
                        <th width="10px;">NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Tgl. Lahir</th>
                        <th>Umur</th>
                        <th>Hari H</th>
                        <th>Sts.</th>
                        <th>Dusun</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Disabilitas</th>
                        <th>KTP-el</th>
                        <th>Ket.</th>
                        <th>Variansi</th>
                        <th>TPS</th>
                        <th>Petugas</th>
                    </tr>
                    </thaead>
                    <tbody>
            ';
        $no = $start+1;
        if(empty($query->result())){
                $output.='
                    <tr>
                        <td colspan="18">
                            No matching records found
                        </td>
                    </tr>
                ';
            }
        foreach ($query->result() as $row) {
            $output .='
            <tr class="'.$row->vars.'">
                <td>
                    <div class="checkbox checkbox-inline" >
                        <input type="checkbox" name="table_records[]" id="table_records" class="checkitem" value="'.$row->id.'">
                        <label> 
                        </label>
                    </div>
                </td>
                <td>'.$no.'</td>
                <td>'.$row->no_kk.'</td>
                <td>'.$row->nik.'</td>
                <td>'.$row->nm_lengkap.' <a href="'.base_url().$mylink.'/edit/'.$row->oke.'" class="btn btn-xs btn-default btn-outline pull-right" style="margin-top:-4px; margin-left:10px; margin-bottom:0px;paddin-top:-2px; padding-bottom:0px;" data-toggle="tooltip" data-placement="top" title="Ubah Data"><i class="fa fa-pencil"></i> </a> '.$row->gender.'</td>
                <td>'.$row->tgl.'</td>
                <td>'.$row->age.'</td>
                <td>'.$row->ages.'</td>
                <td>'.$row->sts_perkawinan.'</td>
                <td>'.ucwords(strtolower($row->dus)).'</td>
                <td>'.$row->rt.'</td>
                <td>'.$row->rw.'</td>
                <td>'.$row->dis.'</td>
                <td>'.$row->prekaman_ektp.'</td>
                <td>'.$row->ket.'</td>
                <td>'.$row->variansi.'</td>
                <td>'.$row->tps.'</td>
                <td>'.ucwords(strtolower($row->petugas)).'</td>
            </tr>
            ';
            $no++;
        }
        $output .= '</tbody>
                </table>
            </div>';
        return $output;
    }
    public function fetch_double($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $output = '';
        $this->db->select("COUNT(nik)niks,nik");
        
        $this->db->from($this->_tq);
        

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("verval",$jns_variansi);    
            }
            else if($jns_variansi='Belum Vervali'){
                $this->db->where("verval","");
                $this->db->where("variansi_data","");
            }
            else{
                $this->db->where("variansi_data",$jns_variansi);
            }
        }
        $this->db->group_by('nik');

        $this->db->having("niks >=2");

       

        
        $this->db->limit(10);
        $query = $this->db->get();
        $output .='
            <link href="'.base_url().'assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 
            <div class="x_content">
                <table class="table table-striped table-hover responsive-utilities jambo_table bulk_action">
                    <thead>
                    <tr>
                        
                        <th width="3px;">No.</th>
                        <th>NIK</th>
                    </tr>
                    </thaead>
                    <tbody>
            ';
        $no = 1;
        if(empty($query->result())){
                $output.='
                    <tr>
                        <td colspan="3">
                            No doule data
                        </td>
                    </tr>
                ';
            }
        foreach ($query->result() as $rows) {
            $output .='
            <tr>
                
                <td>'.$no.'</td>
                <td>'.$rows->nik.'</td>
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
    public function checktps($tps){
        $query = $this->db
            ->select("id,no_tps")
            ->where("no_tps",$tps)
            ->limit(1)
            ->get($this->_tps);
        return $query->row_array();
    }
    public function insert($data){
        $this->db->insert_batch($this->_tq,$data);
    }
    public function get_tps(){
        $query = $this->db
                        ->select('id,LPAD(no_tps,2,0)tps')
                        ->from($this->_tps)
                        ->order_by('no_tps','ASC')
                        ->get();
        return $query->result();
    }
    public function cocok($id){
        $update = array(
            'verval'           => 'MS',
            'variansi_data'    => 'Pemilih Cocok',
            'keterangan'       => '<i class="fa fa-check text-navy"></i>',
            'date_modified'    => date("Y-m-d H:i:s", time()),
            'modified_by'      => $this->session->userdata('id'),
            'modified_byname'  => $this->session->userdata('nm_lengkap')
        );
        $this->db->where('id',$id);
        // $this->db->where("variansi_data!='Pemilih Baru'");
        $this->db->update($this->_tq,$update);
    }
    public function tms($id,$category,$categories){
        $update = array(
            'verval'           => 'TMS',
            'variansi_data'    => $category,
            'keterangan'       => $categories,
            'date_modified'    => date("Y-m-d H:i:s", time()),
            'modified_by'      => $this->session->userdata('id'),
            'modified_byname'  => $this->session->userdata('nm_lengkap')
        );
        $this->db->where('id',$id);
        // $this->db->where("variansi_data!='Pemilih Baru'");
        $this->db->update($this->_tq,$update);
    }
    public function chekinno_tps($id){
        $query = $this->db
            ->select("a.id,LPAD(b.no_tps,2,0)tps,a.ket_details")
            ->from($this->_tq." a")
            ->from($this->_tps." b")
            ->where("a.id_tps=b.id")
            ->where("a.id",$id)
            ->where("a.deleted","0")
            ->get();
        return $query->row_array();
    }
    public function chekcoutno_tps($tps){
        $query = $this->db
            ->select("id,LPAD(no_tps,2,0)tps")
            ->from($this->_tps)
            ->where("id",$tps)
            ->where("deleted","0")
            ->get();
        return $query->row_array();
    }
    public function pindahtps($id,$tps,$ket,$tps_akhir){


        $update = array(
            'verval'           => 'MS',
            'variansi_data'    => 'Pemilih Ubah Data',
            'pindah_tps'       => $tps,
            'keterangan'       => 'U/'.$tps_akhir,
            'ket_details'      => $ket,
            'date_modified'    => date("Y-m-d H:i:s", time()),
            'modified_by'      => $this->session->userdata('id'),
            'modified_byname'  => $this->session->userdata('nm_lengkap')
        );
        $this->db->where('id',$id);
        
        $this->db->update($this->_tq,$update);
    }
    public function get_rekap(){
        $query = $this->db
            ->select("a.id,a.petugas,LPAD(a.no_tps,2,0)tps,a.jum_kk,a.jum_laki,a.jum_perempuan,(a.jum_laki+a.jum_perempuan)akwklp")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='TMS'
                        AND c.jns_kelamin='L'
                        GROUP BY b.id)tmsl")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='TMS'
                        AND c.jns_kelamin='P'
                        GROUP BY b.id)tmsp")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='TMS'
                        GROUP BY b.id)tms")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='MS'
                        AND c.jns_kelamin='L'
                        AND c.variansi_data='Pemilih Baru'
                        GROUP BY b.id)barul")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='MS'
                        AND c.jns_kelamin='P'
                        AND c.variansi_data='Pemilih Baru'
                        GROUP BY b.id)barup")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='MS'
                        AND c.variansi_data='Pemilih Baru'
                        GROUP BY b.id)baru")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='MS'
                        AND c.jns_kelamin='L'
                        AND c.variansi_data='Pemilih Ubah Data'
                        GROUP BY b.id)ubahl")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='MS'
                        AND c.jns_kelamin='P'
                        AND c.variansi_data='Pemilih Ubah Data'
                        GROUP BY b.id)ubahp")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='MS'
                        AND c.variansi_data='Pemilih Ubah Data'
                        GROUP BY b.id)ubah")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='MS'
                        AND c.jns_kelamin='L'
                        AND c.variansi_data='Pemilih Cocok'
                        GROUP BY b.id)cocokl")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='MS'
                        AND c.jns_kelamin='P'
                        AND c.variansi_data='Pemilih Cocok'
                        GROUP BY b.id)cocokp")
            ->select("(SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='MS'
                        AND c.variansi_data='Pemilih Cocok'
                        GROUP BY b.id)cocok")
            ->select("CONCAT(ROUND(((
                        IFNULL((SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='MS'
                        AND c.variansi_data='Pemilih Cocok'
                        GROUP BY b.id),0)+
                        IFNULL((SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='MS'
                        AND c.variansi_data='Pemilih Ubah Data'
                        GROUP BY b.id),0)+
                        IFNULL((SELECT COUNT(c.variansi_data)
                        FROM tps b 
                        LEFT JOIN daftarpemilihtetap c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.verval='TMS'
                        GROUP BY b.id),0))/(a.jum_laki+a.jum_perempuan))*100),'%')persen")
            ->from($this->_tps." a")
            ->where('a.deleted','0')
            ->order_by('a.no_tps','ASC')
            ->get();
        return $query->result();
    }
    public function checkedit($id){
        $this->db->select("id");
        $this->db->from($this->_tq);


        $this->db->where("deleted","0");
        $this->db->where("id",$id);

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_viewubahdata($id){
        $query = $this->db
            ->select('*,CONCAT(RIGHT(tgl_lahir,2),"/",MID(tgl_lahir,6,2),"/",LEFT(tgl_lahir,4))tgllahir')
            ->from($this->_tq)
            ->where('id',$id)
            ->get();
        return $query;
    }
    public function updateubahdata($id,$data){
        $this->db->where('id',$id);
        $this->db->update($this->_tq,$data);
    }

    public function checked($id){
        $this->db->select("id");
        $this->db->from($this->_tq);
        
        $this->db->where("id",$id);
        $this->db->where("verval","MS");
        $this->db->where("variansi_data","Pemilih Baru");

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function deleted($id){
        $this->db->where('id',$id);
        $this->db->delete($this->_tq);
    }
    public function show_data($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("a.*,b.no_tps");
        $this->db->select("CASE
                            WHEN ((MID(DATE_FORMAT('2020-12-09','%Y%m%d'),5,2))<(MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2)))
                            THEN ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                            WHEN (MID(DATE_FORMAT('2020-12-09','%Y%m%d'),5,2)=MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2))
                            THEN (CASE
                                WHEN (RIGHT(DATE_FORMAT('2020-12-09','%Y%m%d'),2)<RIGHT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),2))
                                THEN ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                                ELSE ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4)))) END
                                  ) 
                            ELSE (LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))) END AS age");
        $this->db->from($this->_tq." a");
        $this->db->from($this->_tps." b");
        $this->db->where("a.id_tps=b.id");
        

        if(!empty($nama_alamat)){
            $this->db->where("(a.nm_lengkap like '%".$nama_alamat."%' or a.alamat like '%".$nama_alamat."%')");
        }
        if(!empty($nik_or_kk)){
            $this->db->where("(a.nik like '%".$nikkk."%' or a.no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
      
        if(!empty($rw)){
            $this->db->where("a.rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("a.id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            if($jns_variansi=='TMS'){
                $this->db->where("a.verval",$jns_variansi);    
            }
            else if($jns_variansi=='Belum Vervali'){
                $this->db->where("a.verval",null); 
                $this->db->where("a.variansi_data",null);
            }
            else{
                $this->db->where("a.variansi_data",$jns_variansi);
            }
        }


        

        $this->db->where('a.deleted','0');


        $this->db->order_by("b.no_tps ASC,a.rw ASC,a.rt ASC,a.no_kk ASC,age DESC");
        
        $query = $this->db->get();
        return $query->result();
    }
    public function show_data_mutakhir($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("a.*,b.no_tps");
        $this->db->select("CASE
                            WHEN ((MID(DATE_FORMAT('2020-12-09','%Y%m%d'),5,2))<(MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2)))
                            THEN ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                            WHEN (MID(DATE_FORMAT('2020-12-09','%Y%m%d'),5,2)=MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2))
                            THEN (CASE
                                WHEN (RIGHT(DATE_FORMAT('2020-12-09','%Y%m%d'),2)<RIGHT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),2))
                                THEN ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                                ELSE ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4)))) END
                                  ) 
                            ELSE (LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))) END AS age");
        $this->db->from($this->_tq_s." a");
        $this->db->from($this->_tps." b");
        $this->db->where("a.id_tps=b.id");
        

        if(!empty($nama_alamat)){
            $this->db->where("(a.nm_lengkap like '%".$nama_alamat."%' or a.alamat like '%".$nama_alamat."%')");
        }
        if(!empty($nik_or_kk)){
            $this->db->where("(a.nik like '%".$nikkk."%' or a.no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
      
        if(!empty($rw)){
            $this->db->where("a.rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("a.id_tps",$jns_kelamin);
        }
        // if(!empty($jns_variansi)){
        //     if($jns_variansi=='TMS'){
        //         $this->db->where("a.verval",$jns_variansi);    
        //     }
        //     else if($jns_variansi=='Belum Vervali'){
        //         $this->db->where("a.verval",null); 
        //         $this->db->where("a.variansi_data",null);
        //     }
        //     else{
        //         $this->db->where("a.variansi_data",$jns_variansi);
        //     }
        // }

        if(!empty($jns_variansi)){
            if($jns_variansi=='Pemilih Cocok'){
                $this->db->where("(a.verval='' or a.verval='MS')"); 
                $this->db->where("(a.variansi_data='' or a.variansi_data='".$jns_variansi."')");
            }
            else{
                $this->db->where("a.variansi_data",$jns_variansi);
            }
        }


        

        $this->db->where('a.deleted','0');


        $this->db->order_by("b.no_tps ASC,a.rw ASC,a.rt ASC,a.no_kk ASC,age DESC");
        
        $query = $this->db->get();
        return $query->result();
    }

    public function show_mutakhir(){
        $this->db->select("a.*,b.no_tps");
        $this->db->select("CASE
                            WHEN ((MID(DATE_FORMAT('2020-12-09','%Y%m%d'),5,2))<(MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2)))
                            THEN ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                            WHEN (MID(DATE_FORMAT('2020-12-09','%Y%m%d'),5,2)=MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2))
                            THEN (CASE
                                WHEN (RIGHT(DATE_FORMAT('2020-12-09','%Y%m%d'),2)<RIGHT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),2))
                                THEN ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                                ELSE ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4)))) END
                                  ) 
                            ELSE (LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))) END AS age");
        $this->db->from($this->_tq." a");
        $this->db->from($this->_tps." b");
        $this->db->where("a.id_tps=b.id");
        $this->db->where('a.deleted','0');
        $this->db->order_by("b.no_tps ASC,a.rw ASC,a.rt ASC,a.no_kk ASC,age DESC");
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_mutakhir($data){
        $this->db->insert_batch($this->_tq_s,$data);
    }
    public function fetch_details2($limit, $start, $namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$mylink,$jns_variansi){
        $output = '';
        $this->db->select("a.id,a.id oke,a.no_kk,a.nik, a.nm_lengkap, LPAD(s.no_tps,2,0)tps,s.no_tps,s.petugas,
                             a.tmp_lahir, DATE_FORMAT(a.tgl_lahir,'%d/%m/%Y') tgl,
                             a.sts_perkawinan, a.jns_kelamin,a.prekaman_ektp,
                             IF(LENGTH(a.dusun)>=14,CONCAT(LEFT(a.dusun,13),'...'),a.dusun)dus, LPAD(a.rt,2,0)rt, LPAD(a.rw,2,0)rw, IF(a.disabilitas='0','-',a.disabilitas)dis,
                             if(a.variansi_data='Pemilih Cocok','<span class=\"label label-success\">Cocok</span>',
                             if(a.variansi_data='Pemilih Baru','<span class=\"label label-info\">Baru</span>',
                             if(a.variansi_data='Pemilih Ubah Data','<span class=\"label label-warning\">Ubah</span>',
                             if(a.variansi_data='Meninggal Dunia','<span class=\"label label-danger\">Meninggal</span>',
                             if(a.variansi_data='Ditemukan Data Ganda','<span class=\"label label-danger\">Ganda</span>',
                             if(a.variansi_data='Dibawah Umur','<span class=\"label label-danger\">Bwh. Umur</span>',
                             if(a.variansi_data='Pindah Domisili','<span class=\"label label-danger\">Pindah</span>',
                             if(a.variansi_data='Tidak Ditemukan','<span class=\"label label-danger\">Tdk. Dikenal</span>',
                             if(a.variansi_data='TNI','<span class=\"label label-danger\">TNI</span>',
                             if(a.variansi_data='POLRI','<span class=\"label label-danger\">POLRI</span>',
                             if(a.variansi_data='Hilang Ingatan','<span class=\"label label-danger\">Hlg. Ingatan</span>',
                             if(a.variansi_data='Hak Pilih Dicabut','<span class=\"label label-danger\">Dicabut</span>',
                             if(a.variansi_data='Bukan Penduduk','<span class=\"label label-danger\">Bkn. Penduduk</span>','')))))))))))))variansi,
                             IF(a.keterangan!='',a.keterangan,'-')ket");
        $this->db->select("IF(a.jns_kelamin='P','<i class=\"fa fa-female pull-right\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Perempuan\" style=\"color:#f703cea3\"></i>','<i class=\"fa fa-male pull-right\" data-toggle=\"tooltip\" data-placement=\"left\" title=\"Laki-laki\" style=\"color: #1ab394b5;\"></i>')gender");
        $this->db->select("CASE
                            WHEN ((MID(DATE_FORMAT('2020-12-09','%Y%m%d'),5,2))<(MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2)))
                            THEN ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                            WHEN (MID(DATE_FORMAT('2020-12-09','%Y%m%d'),5,2)=MID(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),5,2))
                            THEN (CASE
                                WHEN (RIGHT(DATE_FORMAT('2020-12-09','%Y%m%d'),2)<RIGHT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),2))
                                THEN ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))-1))
                                ELSE ((LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4)))) END
                                  ) 
                            ELSE (LEFT(DATE_FORMAT('2020-12-09','%Y%m%d'),4)-(LEFT(DATE_FORMAT(a.tgl_lahir,'%Y%m%d'),4))) END AS age");

        $this->db->from($this->_tq_s." a,".$this->_tps." s");
        $this->db->where("a.id_tps=s.id");

        if(!empty($namaalamat)){
            $this->db->where("(a.nm_lengkap like '%".$namaalamat."%' or a.dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(a.nik like '%".$nikkk."%' or a.no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("a.rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("a.id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("a.variansi_data",$jns_variansi);
        }

        // $this->db->order_by('s.no_tps ASC');
        $this->db->order_by("s.no_tps ASC,a.rw ASC, a.rt ASC, a.no_kk ASC, age DESC");
        

        

        
        $this->db->limit($limit,$start);
        $query = $this->db->get();
        $output .='
            <div class="x_content">
                <table class="table table-bordered table-hover responsive-utilities jambo_table bulk_action" style="margin-bottom: 3px;min-width:1500px;" >
                    <thead>
                    <tr>
                        <th width="8px;">No.</th>
                        <th width="10px;">No. KK</th>
                        <th width="10px;">NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Tgl. Lahir</th>
                        <th>Umur</th>
                        <th>Sts.</th>
                        <th>Dusun</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Disabilitas</th>
                        <th>KTP-el</th>
                        <th>Ket.</th>
                        <th>Variansi</th>
                        <th>TPS</th>
                        <th>Petugas</th>
                    </tr>
                    </thaead>
                    <tbody>
            ';
        $no = $start+1;
        if(empty($query->result())){
                $output.='
                    <tr>
                        <td colspan="17">
                            No matching records found
                        </td>
                    </tr>
                ';
            }
        foreach ($query->result() as $row) {
            $output .='
            <tr>
                <td align="right">'.$no.'</td>
                <td>'.$row->no_kk.'</td>
                <td>'.$row->nik.'</td>
                <td>'.$row->nm_lengkap.$row->gender.'</td>
                <td>'.$row->tgl.'</td>
                <td>'.$row->age.'</td>
                <td>'.$row->sts_perkawinan.'</td>
                <td>'.ucwords(strtolower($row->dus)).'</td>
                <td>'.$row->rt.'</td>
                <td>'.$row->rw.'</td>
                <td>'.$row->dis.'</td>
                <td>'.$row->prekaman_ektp.'</td>
                <td>'.$row->ket.'</td>
                <td>'.$row->variansi.'</td>
                <td>'.$row->tps.'</td>
                <td>'.ucwords(strtolower($row->petugas)).'</td>
            </tr>
            ';
            $no++;
        }
        $output .= '</tbody>
                </table>
            </div>';
        return $output;
    }



    public function veri2_jum_double($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("COUNT(nik) AS gva");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }
        $this->db->group_by("nik");
        $this->db->having("gva>1");


        $query = $this->db->get();
        return $query->num_rows();
    }

    public function veri2_jum_perempuan($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

        $this->db->where("jns_kelamin","P");

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function veri2_jum_disabilitas_fisik($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

        $this->db->where("disabilitas",1);


        $query = $this->db->get();
        return $query->num_rows();
    }
    public function veri2_jum_disabilitas_intelektual($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
       if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

        $this->db->where("disabilitas",2);


        $query = $this->db->get();
        return $query->num_rows();
    }
    public function veri2_jum_tuna_mental($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

        $this->db->where("disabilitas",3);


        $query = $this->db->get();
        return $query->num_rows();
    }
    public function veri2_jum_disabilitas_sensorik($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

        $this->db->where("disabilitas",4);


        $query = $this->db->get();
        return $query->num_rows();
    }

    public function veri2_jum_cocok($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

        $this->db->where("verval","MS");
        $this->db->where("variansi_data","Pemilih Cocok");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function veri2_jum_ubah_data($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

        $this->db->where("verval","MS");
        $this->db->where("variansi_data","Pemilih Ubah Data");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function veri2_jum_baru($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

        $this->db->where("verval","MS");
        $this->db->where("variansi_data","Pemilih Baru");

        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function veri2_jum_belum_rekam_ektp($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

        $this->db->where("prekaman_ektp","b");

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function veri2_jum_keluarga($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

        $this->db->group_by('no_kk');

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function veri2_jum_laki($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("id");
        $this->db->from($this->_tq_s);

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

        $this->db->where("jns_kelamin","L");

        $query = $this->db->get();
        return $query->num_rows();
    }


    public function veri2_count_all($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $this->db->select("a.id");
        $this->db->from($this->_tq_s." a,".$this->_tps." s");
        $this->db->where("a.id_tps=s.id");

        if(!empty($namaalamat)){
            $this->db->where("(a.nm_lengkap like '%".$namaalamat."%' or a.dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(a.nik like '%".$nikkk."%' or a.no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("a.rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("a.rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("a.id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }

       
        
       

        $query = $this->db->get();
        return $query->num_rows();
    }
    public function veri2_fetch_double($namaalamat,$nikkk,$rt,$rw,$jns_kelamin,$jns_variansi){
        $output = '';
        $this->db->select("COUNT(nik)niks,nik");
        
        $this->db->from($this->_tq_s);
        

        if(!empty($namaalamat)){
            $this->db->where("(nm_lengkap like '%".$namaalamat."%' or dusun like '%".$namaalamat."%')");
        }
        if(!empty($nikkk)){
            $this->db->where("(nik like '%".$nikkk."%' or no_kk like '%".$nikkk."%')");
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rt)){
            $this->db->where("rt",$rt);
        }
        if(!empty($rw)){
            $this->db->where("rw",$rw);
        }
        if(!empty($jns_kelamin)){
            $this->db->where("id_tps",$jns_kelamin);
        }
        if(!empty($jns_variansi)){
            $this->db->where("variansi_data",$jns_variansi);
        }
        $this->db->group_by('nik');

        $this->db->having("niks >=2");

       

        
        $this->db->limit(10);
        $query = $this->db->get();
        $output .='
            <link href="'.base_url().'assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet"> 
            <div class="x_content">
                <table class="table table-striped table-hover responsive-utilities jambo_table bulk_action">
                    <thead>
                    <tr>
                        
                        <th width="3px;">No.</th>
                        <th>NIK</th>
                    </tr>
                    </thaead>
                    <tbody>
            ';
        $no = 1;
        if(empty($query->result())){
                $output.='
                    <tr>
                        <td colspan="3">
                            No doule data
                        </td>
                    </tr>
                ';
            }
        foreach ($query->result() as $rows) {
            $output .='
            <tr>
                
                <td>'.$no.'</td>
                <td>'.$rows->nik.'</td>
            </tr>
            ';
            $no++;
        }
        $output .= '</tbody>
                </table>
            </div>';
        return $output;
    }
    public function get_rekap_final(){
        $query = $this->db
            ->select("a.id,a.petugas,LPAD(a.no_tps,2,0)tps,a.jum_kk,a.jum_laki,a.jum_perempuan,(a.jum_laki+a.jum_perempuan)akwklp")
            ->select("(SELECT COUNT(c.jns_kelamin)
                        FROM tps b 
                        LEFT JOIN dptmutakhir c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.jns_kelamin='L'
                        GROUP BY b.id)jnsl")
            ->select("(SELECT COUNT(c.jns_kelamin)
                        FROM tps b 
                        LEFT JOIN dptmutakhir c ON b.id=c.id_tps
                        WHERE a.id = b.id 
                        AND c.jns_kelamin='P'
                        GROUP BY b.id)jnsp")
            ->select("(SELECT COUNT(c.jns_kelamin)
                        FROM tps b 
                        LEFT JOIN dptmutakhir c ON b.id=c.id_tps
                        WHERE a.id = b.id
                        GROUP BY b.id)jnsk")
            ->from($this->_tps." a")
            ->where('a.deleted','0')
            ->order_by('a.no_tps','ASC')
            ->get();
        return $query->result();
    }
    public function jumlah_kk(){
        $this->db->select("SUM(a.jum_kk)kk, SUM(a.jum_laki)laki, SUM(a.jum_perempuan)perempuan,(SUM(a.jum_laki)+SUM(a.jum_perempuan))tot");
        $this->db->from($this->_tps." a");
        $query = $this->db->get();
        return $query->row_array();
    }
    public function jumlah_laki(){
        $this->db->select("COUNT(jns_kelamin)laki");
        $this->db->from($this->_tq_s);
        $this->db->where('jns_kelamin','L');


        $query = $this->db->get();
        return $query->row_array();
    }
    public function jumlah_perempuan(){
        $this->db->select("COUNT(jns_kelamin)perempuan");
        $this->db->from($this->_tq_s);
        $this->db->where('jns_kelamin','P');


        $query = $this->db->get();
        return $query->row_array();
    }
    public function jumlah_jnstot(){
        $this->db->select("COUNT(jns_kelamin)kelamintot");
        $this->db->from($this->_tq_s);


        $query = $this->db->get();
        return $query->row_array();
    }
    // public function jumlah_perempuan(){
    //     $this->db->select("SUM(jum_perempuan)perempuan");
    //     $this->db->from($this->_tps);


    //     $query = $this->db->get();
    //     return $query->row_array();
    // }






    

}
?>