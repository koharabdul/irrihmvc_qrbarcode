<?php defined('BASEPATH') or exit('No direct script access allowed');
class Mailbox extends MY_Controller{
	public function __construct()
  	{
        parent::__construct();
        $this->load->model('Mailbox_m');//model
        $this->susbtitle = 'Mailbox';//subtitle
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