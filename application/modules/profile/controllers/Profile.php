<?php defined('BASEPATH') or exit('No direct script access allowed');
class Profile extends MY_Controller{
	public function __construct()
  	{
        parent::__construct();
        $this->load->model('Profile_m');//model
        $this->susbtitle = 'Profile';//subtitle
        $this->linkwithoutspace = strtolower(str_replace(' ','',$this->susbtitle));
    }
    public function index()
    {
        $id = $this->uri->segment(3);
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;

        $data['content_view'] = $this->linkwithoutspace.'/'.$this->linkwithoutspace.'_v';
        $this->template->hygienic_template($data);
    }
    public function view($id=null){
        $id = $this->uri->segment(3);

        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;

        $data['content_view'] = $this->linkwithoutspace.'/'.$this->linkwithoutspace.'_v';
        $this->template->hygienic_template($data);
    }


}
?>