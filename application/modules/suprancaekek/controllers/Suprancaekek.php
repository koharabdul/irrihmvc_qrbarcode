<?php defined('BASEPATH') or exit('No direct script access allowed');
class Suprancaekek extends MY_Controller
{
  	public function __construct()
  	{
    		parent::__construct();
  	}
  	public function index()
  	{
  		$data['subtitle'] = 'Home';
        $data['content_view'] = 'suprancaekek/suprancaekek_v';
        $this->template->template($data);
    }


}
?>