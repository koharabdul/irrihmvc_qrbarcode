<?php defined('BASEPATH') or exit('No direct script access allowed');
class Errors extends MY_Controller{
	public function __construct()
  	{
        parent::__construct();
        // $this->load->model('Errors_m');//model
        $this->susbtitle = '404';//subtitle
        $dataactiveclass = $this->susbtitle;
        
    }
    public function index(){
    	$data['subtitle'] = $this->susbtitle;
    	$this->template->error_template($data);
    }


}
?>


