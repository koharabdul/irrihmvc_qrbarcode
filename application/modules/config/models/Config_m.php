<?php defined('BASEPATH') or exit('No direct script access allowed');
class Config_m extends CI_Model{
    public $_tq = "t_config";//tabel query
    public $_orderby = "ASC";

    public function savethemes($themes){
    	$field = array(
            'theme'             => $themes
         );
        $this->db->where('id',$this->session->userdata("idconfig"));
        $this->db->update($this->_tq, $field);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function saveconfignav($fixednav,$boxedlayout,$fixednavbasic,$fixedsidebar,$mininavbar,$fixed,$navbar_static_top){
        $field = array(
            'fixed_nav'         => $fixednav,
            'boxed_layout'      => $boxedlayout,
            'fixed_nav_basic'   => $fixednavbasic,
            'fixed_sidebar'     => $fixedsidebar,
            'mini_navbar'       => $mininavbar,
            'fixed_footer'      => $fixed,
            'nav_static_top'    => $navbar_static_top
         );
        $this->db->where('id',$this->session->userdata("idconfig"));
        $this->db->update($this->_tq, $field);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


}
?>