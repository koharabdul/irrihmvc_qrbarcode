<?php defined('BASEPATH') or exit('No direct script access allowed');
class Forms extends MY_Controller{
	public function __construct()
  	{
        parent::__construct();
        $this->load->model('Forms_m');//model
        $this->susbtitle = 'Forms';//subtitle
        $dataactiveclass = $this->susbtitle;
        $idAndPerpage = $this->Forms_m->perpageAndId($dataactiveclass);
        $this->id = $idAndPerpage['id'];
        $this->linkwithoutspace = $idAndPerpage['link'];
        $this->actived_Class($dataactiveclass);
    }
   public function actived_Class($dataactiveclass){
        $activeclass = $this->Forms_m->get_activedclass($dataactiveclass);
        if(!empty($activeclass)){
            if($activeclass['tit_actclass']!=''){
                $arr_actclass = explode('/', $activeclass['tit_actclass']);
                foreach ($arr_actclass as $actclass) {
                    $this->session->set_tempdata($actclass,"active",0,1);//class active nanti diteruskan di navbar// echo $actclass;//bisa ditampilkan kalau bukan anak dari 0
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
        $datarunlink = $this->Forms_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Forms_m->content_runlink($showrun);
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
        
        $data['subtitle'] = $this->susbtitle;
        $data['results'] = $this->Forms_m->get_index();
        $data['content_view'] = strtolower($this->susbtitle).'/'.strtolower($this->susbtitle).'_v';
        $this->template->hygienic_template($data);
    }
    public function nestable(){
        // $data['count'] =  $this->Form_m->showcount_chat();
        $this->load->view(strtolower($this->susbtitle).'/nestablelist');
    }
    public function save(){
        // var_dump($_POST);
        // var_dump($_GET);
        $this->Forms_m->saveform();
    }
    public function createnext($id){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $ds = $this->susbtitle;
        $datarunlink = $this->Forms_m->get_runlink($ds);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Forms_m->content_runlink($showrun);
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
        
        

        $data['namaform'] = $this->Forms_m->checkidfromsql($id);
        // var_dump($data['namaform']);
        // die();
        if(count($data['namaform'])!=1){
            redirect(strtolower($this->susbtitle));
        }
        else{
            $data['content_view'] = strtolower($this->susbtitle).'/'.'create_v';
            $this->template->hygienic_template($data);
        }
    }

    public function createid(){
        // var_dump($_POST);
        // var_dump($_FILES);
        $form_id = $this->input->post('id');
        $this->Forms_m->deletedetilform($form_id);
        $content = $this->input->post('nestable2-output');
        // var_dump($form_id,$content);

        $no = 1;
        $arr_kalimat = explode('}', $content);
        foreach ($arr_kalimat as $vo) {
            if($vo!=']')
            {
                $arr_kalimat2 = explode('[{', $vo);
                foreach ($arr_kalimat2 as $v) {
                    if($v!='')
                    {
                        $arr_kalimat3 = explode(',{', $v);
                        foreach ($arr_kalimat3 as $v1) {
                            if($v1!='')
                            {
                                // var_dump($v1);
                                $arr_kalimat4 = explode(',', $v1);
                                foreach ($arr_kalimat4 as $v2) {
                                    if($v2!='')
                                    {
                                        // var_dump($v2);
                                        // if(substr($v2,0, 8)=='"type":"'){
                                        //     $arr2 = explode('"type":"', $v2);
                                        //     foreach ($arr2 as $a2) {
                                        //         if($a2!=''){
                                        //             // var_dump($g1);
                                        //             $jum = strlen($a2)-1;
                                        //             $stype = substr($a2,0,$jum);
                                        //         }
                                        //     }
                                        // }
                                        // else 
                                        if(substr($v2,0, 6)=='"id":"'){
                                            $arr1 = explode('"id":"', $v2);
                                            foreach ($arr1 as $a1) {
                                                if($a1!=''){
                                                    // var_dump($g1);
                                                    $jum = strlen($a1)-1;
                                                    $sid = substr($a1,0,$jum);
                                                }
                                            }
                                        }
                                    }
                                }
                                // var_dump($sid. ' -'.$no.' '.$stype.' '.$form_id);
                                if($sid!=''){
                                    $this->Forms_m->insertdetailform($sid,$form_id,$no);
                                }
                            }
                        }
                    }
                }
                
            }
            $no++; 
        }
    }

    public function showAllForm($data_uri){
        $result = $this->Forms_m->showAllForm($data_uri);
        echo json_encode($result);
    }

    public function createproperties($id_properties){

        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $ds = $this->susbtitle;
        $datarunlink = $this->Forms_m->get_runlink($ds);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Forms_m->content_runlink($showrun);
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

        //////////////////////////////////////////////////////////////////
        if(substr($id_properties, 0,3)=="txt"){
            $propertyEditor = "Text Filed";
        }
        else if(substr($id_properties, 0,3)=="hid"){
            $propertyEditor = "Hidden Filed";   
        }
        else if(substr($id_properties, 0,3)=="dte"){
            $propertyEditor = "Date Picker";   
        }
        else if(substr($id_properties, 0,3)=="pas"){
            $propertyEditor = "Password Field";   
        }
        else if(substr($id_properties, 0,3)=="txa"){
            $propertyEditor = "Text Area";   
        }
        else if(substr($id_properties, 0,3)=="opt"){
            $propertyEditor = "Select Box";   
        }
        else if(substr($id_properties, 0,3)=="chx"){
            $propertyEditor = "Check Box";   
        }
        else if(substr($id_properties, 0,3)=="rad"){
            $propertyEditor = "Radio";   
        }
        else if(substr($id_properties, 0,3)=="fil"){
            $propertyEditor = "File Upload";   
        }
        else if(substr($id_properties, 0,3)=="cos"){
            $propertyEditor = "Costume HTML";   
        }
        else {
            $propertyEditor = "";   
        }
        $data['propertiesEditor'] = $propertyEditor;
        //////////////////////////////////////////////////////////////////
        

        $data['results'] = $this->Forms_m->check_propertiesidfromdetail($id_properties);
        // var_dump(count($this->Forms_m->check_propertiesidfromdetail($id_properties)));
        // die();
        if(count($this->Forms_m->check_propertiesidfromdetail($id_properties))==3){
            if($this->Forms_m->check_propertiesidfromchilddetail($id_properties)==1){
                $data['content_view'] = strtolower($this->susbtitle).'/'.'createproperties_v';
                $this->template->hygienic_template($data);
            }
            else{
                $data['content_view'] = strtolower($this->susbtitle).'/'.'createproperties_v';
                $this->template->hygienic_template($data);
            }
        }
        else{
            redirect(strtolower($this->susbtitle));
        }
        
        
    }


    public function savepropertieseditor(){
        
    }



    
   


}
?>