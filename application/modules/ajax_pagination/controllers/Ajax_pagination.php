<?php defined('BASEPATH') or exit('No direct script access allowed');
class Ajax_pagination extends MY_Controller{
	public function __construct()
  	{
  		parent::__construct();
        $this->load->model('Ajax_pagination_m');//model
        $this->susbtitle = 'Ajax Pagination';//subtitle
        $dataactiveclass = $this->susbtitle;
        $idAndPerpage = $this->Ajax_pagination_m->perpageAndId($dataactiveclass);
        $this->id = $idAndPerpage['id'];
        $this->sumof_perpage = $idAndPerpage['perpage'];
        $this->linkwithoutspace = strtolower(str_replace(' ','',$this->susbtitle));
        $this->actived_Class($dataactiveclass);
  	}
  	public function actived_Class($dataactiveclass){
        $activeclass = $this->Ajax_pagination_m->get_activedclass($dataactiveclass);
        // var_dump($activeclass);
        if(!empty($activeclass)){
            if($activeclass['tit_actclass']!=''){
                $arr_actclass = explode('/', $activeclass['tit_actclass']);
                foreach ($arr_actclass as $actclass) {
                    $this->session->set_tempdata($actclass,"active",0,1);//class active nanti diteruskan di navbar
                    // echo $actclass;//bisa ditampilkan kalau bukan anak dari 0
                }
            }
        }
        else{
            redirect('errors');//buat permission
        }
    }
    public function index()
    {
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $data['perpage'] = $this->sumof_perpage;
        $datarunlink = $this->Ajax_pagination_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Ajax_pagination_m->content_runlink($showrun);
                $runlink = "<li>".ucwords($contrunlink['name'])."</li>";
                if(empty($data['runlink'])){
                    $data['runlink'] = $runlink;
                }
                else{
                    $data['runlink'] = $data['runlink'].$runlink;
                }
            }
        }
        else{
            $data['runlink'] = "";
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        
        $data['content_view'] = 'Ajax_pagination/ajax_pagination';
        $this->template->hygienic_template($data);
    }

    public function pagination(){
    	$search = trim($this->input->post('search'));
        $config = array();
    	$config['base_url']    = "#";
    	$config['total_rows']  = $this->Ajax_pagination_m->count_all($search);
    	$config['per_page']    = $this->sumof_perpage;
    	$config['uri_segment'] = 3;
    	$config['use_page_numbers'] = true;
    	$config['full_tag_open'] = '<ul class="pagination">';
    	$config['full_tag_close'] = '</ul>';
    	$config['first_tag_open'] = '<li>';
    	$config['first_tag_close'] = '</li>';
    	$config['last_tag_open'] = '<li>';
    	$config['last_tag_close'] = '</li>';
    	$config['next_link'] = '&gt';
    	$config['next_tag_open'] = '<li>';
    	$config['next_tag_close'] = '</li>';
    	$config['prev_link'] = '&lt';
    	$config['prev_tag_open'] = '<li>';
    	$config['prev_tag_close'] = '</li>';
    	$config['cur_tag_open'] = "<li class='active' ><a href='#'>";
    	$config['cur_tag_close'] = "</a></li>";
    	$config['num_tag_open'] = "<li>";
    	$config['num_tag_close'] = "</li>";
    	$config['num_links'] = 1;
    	$this->pagination->initialize($config);
    	$page = $this->uri->segment(3);
    	$start = ($page - 1) * $config["per_page"];

        

        $lastpage = (($start)+($config['per_page']));
        if($lastpage>=($config['total_rows'])){
            $lastpage = $config['total_rows'];
        }
        else{
            $lastpage = (($start)+($config['per_page']));
        }
        
        if($config['total_rows']==''){
            $showCountData = '';
        }
        else{
            $showCountData = 'Showing '.($start+1).' to '.$lastpage.' of '.($config['total_rows']).' entries';
        }
    	$output = array(
    		'pagination_link'  => $this->pagination->create_links(),
    		'country_table'	   => $this->Ajax_pagination_m->fetch_details($config["per_page"],$search,$start),
            'showCountData'    => $showCountData,
            'perpage'          => $this->sumof_perpage
    	);
    	echo json_encode($output);
    }
    public function changeperpage(){
        $id = $this->id;
        $perpageValue = $this->input->post('perpage');
        $this->Ajax_pagination_m->changePerpageValue($perpageValue,$id);
    }

}
?>