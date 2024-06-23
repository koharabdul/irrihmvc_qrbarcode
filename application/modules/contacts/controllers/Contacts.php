<?php defined('BASEPATH') or exit('No direct script access allowed');
class Contacts extends MY_Controller{
	public function __construct()
  	{
        parent::__construct();
        $this->load->model('Contacts_m');//model
        $this->susbtitle = 'Contacts';//subtitle
        $this->linkwithoutspace = strtolower(str_replace(' ','',$this->susbtitle));
    }
    public function index()
    {
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;

        $data['content_view'] = $this->linkwithoutspace.'/'.$this->linkwithoutspace.'_v';
        $this->template->hygienic_template($data);
    }


}
?>