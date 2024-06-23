<?php defined('BASEPATH') or exit('No direct script access allowed');
class Config extends MY_Controller{
	public function __construct()
  	{
        parent::__construct();
        $this->load->model('Config_m');//model
    }
    public function index(){
    	
    }
    public function savetheme(){
        // var_dump($_POST);
        // var_dump($_FILES);
        // die();
        
        $themes = $this->input->post('theme');
        $this->Config_m->savethemes($themes);

    }
    public function saveconfignav(){
        // var_dump($_POST);
        // var_dump($_FILES);
        // die();

        $fixednav = $this->input->post('fixednav');
        $boxedlayout = $this->input->post('boxedlayout');
        $fixednavbasic = $this->input->post('fixednavbasic');
        $fixedsidebar = $this->input->post('fixedsidebar');
        $mininavbar = $this->input->post('mininavbar');
        $fixed = $this->input->post('fixed');
        $navbar_static_top = $this->input->post('navbar_static_top');

        $this->Config_m->saveconfignav($fixednav,$boxedlayout,$fixednavbasic,$fixedsidebar,$mininavbar,$fixed,$navbar_static_top);

    }
    



}
?>