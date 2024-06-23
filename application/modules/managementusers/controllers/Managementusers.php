<?php defined('BASEPATH') or exit('No direct script access allowed');
class Managementusers extends MY_Controller{
	public function __construct()
  	{
        parent::__construct();
        $this->load->model('Managementusers_m');//model
        $this->susbtitle = 'Management Users';//subtitle
        $dataactiveclass = $this->susbtitle;
        $idAndPerpage = $this->Managementusers_m->perpageAndId($dataactiveclass);
        $this->id = $idAndPerpage['id'];
        $this->sumof_perpage = $idAndPerpage['perpage'];
        $this->linkwithoutspace = strtolower(str_replace(' ','',$this->susbtitle));
        $this->actived_Class($dataactiveclass);
    }
    public function actived_Class($dataactiveclass){
        $activeclass = $this->Managementusers_m->get_activedclass($dataactiveclass);
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
    public function changeperpage(){
        $id = $this->id;
        $perpageValue = $this->input->post('perpage');
        $this->Managementusers_m->changePerpageValue($perpageValue,$id);
    }
    public function index()
    {
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $datarunlink = $this->Managementusers_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Managementusers_m->content_runlink($showrun);
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
        $jumlah_data = $this->Managementusers_m->jumlah_data();
        $config['base_url'] = base_url().$this->linkwithoutspace.'/index/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = $this->sumof_perpage;
        $config['first_tag_open'] = '<li>';//paginataion awal
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';//paginataion akhir
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);

        
        $fr = $from + 1;
        $to = $from + $config['per_page'];
        if($jumlah_data != 0){
            if($to > $jumlah_data){
                $data['numberofpage'] = 'Showing '.$fr.' to '.$jumlah_data.' of '.$jumlah_data.' entries';
            }
            else{
                $data['numberofpage'] = 'Showing '.$fr.' to '.$to.' of '.$jumlah_data.' entries';
            }
        }
        else{
            $data['numberofpage'] = '';
        }



        
        $data['perpage'] = $this->sumof_perpage;
        $data['results'] = $this->Managementusers_m->get_index($config['per_page'],$from);
        $data['selectusers'] = $this->Managementusers_m->get_users();//select user for add/create
        
        $data['content_view'] = $this->linkwithoutspace.'/'.$this->linkwithoutspace.'_v';
        $this->template->hygienic_template($data);
    }



    public function search(){

        $data['mylink'] = $this->linkwithoutspace;
        $datarunlink = $this->Managementusers_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Managementusers_m->content_runlink($showrun);
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
        $datacari = (trim($this->input->post('cari')))? trim($this->input->post('cari')) : '';
        $datacari = ($this->uri->segment(3)) ? $this->uri->segment(3) : $datacari;
        if($datacari == ''){
            redirect($this->linkwithoutspace);
        }
        else{
       
            $arr_kalimat = explode("%", $datacari);
            foreach ($arr_kalimat as $v) {
                if(substr($v,0,2)=="20"){
                    if((substr($v,0,1)=="0")or
                       (substr($v,0,1)=="1")or 
                       (substr($v,0,1)=="2")or 
                       (substr($v,0,1)=="3")or 
                       (substr($v,0,1)=="4")or
                       (substr($v,0,1)=="5")or
                       (substr($v,0,1)=="6")or
                       (substr($v,0,1)=="7")or
                       (substr($v,0,1)=="8")or
                       (substr($v,0,1)=="9")
                      )
                    {
                        $t = "20".substr($v,2);
                    }
                    else
                    {
                        $t = substr($v, 2);
                    }
                }
                else{
                    $t = $v;
                }
                if(empty($tampil)){
                    $tampil = $t;
                }
                else{
                    $tampil = $tampil." ".$t;
                }                   
            }

            //$data['tampilcari'] = $tampil; ieu dikomen karena aya keneh 20
            $datanampil = explode(" 20", $tampil);
            foreach ($datanampil as $dt) {
                if(empty($datatampil)){
                    $datatampil = $dt;
                }
                else{
                    $datatampil = $datatampil." ".$dt;
                }  
            }
            $data['tampilcari'] = $datatampil;


            $jumlah_data = $this->Managementusers_m->jumlah_data_cari();
            $config['base_url'] = base_url().$this->linkwithoutspace.'/search/'.$datacari;
            $config['total_rows'] = $jumlah_data;
            $config['per_page'] = $this->sumof_perpage;
            $config['first_tag_open'] = '<li>';//paginataion awal
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';//paginataion akhir
            $from = $this->uri->segment(4);
            $this->pagination->initialize($config);

            $fr = $from + 1;
            $to = $from + $config['per_page'];
            if($jumlah_data != 0){
                if($to > $jumlah_data){
                  $data['numberofpage'] = 'Showing '.$fr.' to '.$jumlah_data.' of '.$jumlah_data.' entries';
                }
                else{
                  $data['numberofpage'] = 'Showing '.$fr.' to '.$to.' of '.$jumlah_data.' entries';
                }
            }
            else{
              $data['numberofpage'] = '';
            }

            $data['perpage'] = $this->sumof_perpage;
            $data['selectusers'] = $this->Managementusers_m->get_users();//select user for add/create
            $data['results'] = $this->Managementusers_m->get_cari($config['per_page'],$from,$datacari);

            $data['content_view'] = $this->linkwithoutspace.'/'.$this->linkwithoutspace.'_v';
            $this->template->hygienic_template($data);
        }
    }

    public function delete_multiple(){
        $delete = $this->input->post('table_records');
        if($delete!=''){
            $arr_kalimat = explode(',', $delete);
            foreach ($arr_kalimat as $deletes_id) {
                if($deletes_id!=''){
                    $this->Managementusers_m->deletes($deletes_id);
                }
            }
          
            $positionClass = 'toast-bottom-left';
            $messages      = 'Data Terpilih Telah Dihapus';
            $tit_msgs      = 'Hapus Data Berhasil!';
            $toastr_type   = 'warning';//success,info,warning,error
            $this->message($positionClass,$toastr_type,$messages,$tit_msgs);
        }
    }
    public function saveAdd(){//message double if input the same value
        $name = $this->input->post('name');
        echo $checkdouble = $this->Managementusers_m->checkdouble($name);
        

    }
    public function insertAdd(){
        $insert = array(
            'id' => 'Mu-'.get_uuid(),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'active' => $this->input->post('active'),
            'date_created' => date("Y-m-d H:i:s", time()),
            'created_by' => $this->session->userdata('id'),
            'created_byname' => $this->session->userdata('nm_lengkap'),
            'date_modified' => date("Y-m-d H:i:s", time()),
            'modified_by' => $this->session->userdata('id'),
            'modified_byname' => $this->session->userdata('nm_lengkap')
        );
        $this->Managementusers_m->createManlu($insert);

        $list_users = $this->input->post('list_users');
        if($list_users!=''){
            $arr_kalimat = explode(',', $list_users);
            foreach ($arr_kalimat as $r) {
                if($r!=''){
                    $insert_manu = array(
                        'managementuser_id' => $insert['id'],
                        'user_id' => $r,
                        'date_created' => date("Y-m-d H:i:s", time()),
                        'created_by' => $this->session->userdata('id'),
                        'created_byname' => $this->session->userdata('nm_lengkap')

                    );
                    $this->Managementusers_m->createManluv($insert_manu);
                }
            }
        }
        $positionClass = 'toast-top-right';
        $messages      = 'Anda Telah Melakukan Input Data';
        $tit_msgs      = 'Berhasil Disimpan';
        $toastr_type   = 'success'; //success,info,warning,error
        $this->message($positionClass,$toastr_type,$messages,$tit_msgs);

    }

    public function view($id){
        if($this->Managementusers_m->checkItManagementUsers($id)!=1){
            redirect($this->linkwithoutspace);
        }
        else{
            $data['subtitle'] = $this->susbtitle;
            $data['mylink'] = $this->linkwithoutspace;
            $datarunlink = $this->Managementusers_m->get_activedclass($this->susbtitle);
            if($datarunlink['tit_actclass']!=''){
                $arr_runlink = explode('/', $datarunlink['tit_actclass']);
                foreach ($arr_runlink as $showrun) {
                    $contrunlink = $this->Managementusers_m->content_runlink($showrun);
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

            $data['results'] = $this->Managementusers_m->get_idview($id)->row_array();
            $data['levu_select'] = $this->Managementusers_m->get_selectleveluser();
            $data['levu_selected'] = $this->Managementusers_m->get_selectedleveluser($id);
           
            // $levu_selected['user_ids'] = $this->Managementusers_m->get_selectedleveluser2($id);
            // var_dump($levu_selected['user_ids']);
            // die();
            $data['content_view'] = $this->linkwithoutspace.'/view_v';
            $this->template->hygienic_template($data);




        }
    }


    public function update(){
        $update = array(
            'name'              => $this->input->post('name'),
            'description'       => $this->input->post('description'),
            'active'            => $this->input->post('active'),
            'date_modified'     => date("Y-m-d H:i:s", time()),
            'modified_by'       => $this->session->userdata('id'),
            'modified_byname'   => $this->session->userdata('nm_lengkap')
        );
        $this->Managementusers_m->update($update);


        $list_users = $this->input->post('list_users');
        // var_dump($list_users);
        // die();
        if($list_users!=''){
            $id = $this->input->post('id');
            $this->Managementusers_m->deleteBeforeUpdate($id);
            $arr_kalimat = explode(',', $list_users);
            foreach ($arr_kalimat as $r) {
                if($r!=''){
                    $insert_manu = array(
                        'managementuser_id' => $this->input->post('id'),
                        'user_id' => $r,
                        'date_created' => date("Y-m-d H:i:s", time()),
                        'created_by' => $this->session->userdata('id'),
                        'created_byname' => $this->session->userdata('nm_lengkap')

                    );
                    $this->Managementusers_m->updateManluv($insert_manu);
                }
            }
        }
        else{
            $id = $this->input->post('id');
            $this->Managementusers_m->deleteBeforeUpdate($id);
        }
        $positionClass = 'toast-top-left';
        $messages      = 'Anda Telah Melakukan Update Data';
        $tit_msgs      = 'Update Data Berhasil';
        $toastr_type   = 'info'; //success,info,warning,error
        $this->message($positionClass,$toastr_type,$messages,$tit_msgs);
    }

    public function delete(){
        $id = $this->input->post('id');
        if($this->Managementusers_m->checkItManagementUsers($id)!=1){
            redirect($this->linkwithoutspace);
        }
        else{
            $this->Managementusers_m->deleteManu($id);
            $positionClass = 'toast-bottom-left';
            $messages      = 'Anda Telah Melakaukan Hapus Data';
            $tit_msgs      = 'Data Berhasil Terdelete';
            $toastr_type   = 'warning'; //success,info,warning,error
            $this->message($positionClass,$toastr_type,$messages,$tit_msgs);            
        }
    }


    public function pagination(){
        $search = trim($this->input->post('search'));
        $id = trim($this->input->post('id'));
        $config = array();
        $config['base_url']    = "#";
        $config['total_rows']  = $this->Managementusers_m->count_all($search);
        $config['per_page']    = 10;
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
            'country_table'    => $this->Managementusers_m->fetch_details($config["per_page"],$search,$start,$id),
            'showCountData'    => $showCountData
        );
        echo json_encode($output);
    }












    public function message($positionClass,$toastr_type,$messages,$tit_msgs){
        if($toastr_type=='success'){
            $this->session->set_flashdata("infomsg","<script>
                setTimeout(function() {
                   toastr.options = {
                          'closeButton': true,
                          'debug': false,
                          'progressBar': true,
                          'preventDuplicates': false,
                          'positionClass': '".$positionClass."',
                          'onclick': null,
                          'showDuration': '400',
                          'hideDuration': '1000',
                          'timeOut': '7000',
                          'extendedTimeOut': '1000',
                          'showEasing': 'swing',
                          'hideEasing': 'linear',
                          'showMethod': 'fadeIn',
                          'hideMethod': 'fadeOut'
                    };
                    toastr.success('".$messages."', '".$tit_msgs."');
                }, 1300);
                </script>
            ");
        }
        else if($toastr_type=='info'){
            $this->session->set_flashdata("infomsg","<script>
                setTimeout(function() {
                   toastr.options = {
                          'closeButton': true,
                          'debug': false,
                          'progressBar': true,
                          'preventDuplicates': false,
                          'positionClass': '".$positionClass."',
                          'onclick': null,
                          'showDuration': '400',
                          'hideDuration': '1000',
                          'timeOut': '7000',
                          'extendedTimeOut': '1000',
                          'showEasing': 'swing',
                          'hideEasing': 'linear',
                          'showMethod': 'fadeIn',
                          'hideMethod': 'fadeOut'
                    };
                    toastr.info('".$messages."', '".$tit_msgs."');
                }, 1300);
                </script>
            ");
        }
        else if($toastr_type=='warning'){
            $this->session->set_flashdata("infomsg","<script>
                setTimeout(function() {
                   toastr.options = {
                          'closeButton': true,
                          'debug': false,
                          'progressBar': true,
                          'preventDuplicates': false,
                          'positionClass': '".$positionClass."',
                          'onclick': null,
                          'showDuration': '400',
                          'hideDuration': '1000',
                          'timeOut': '7000',
                          'extendedTimeOut': '1000',
                          'showEasing': 'swing',
                          'hideEasing': 'linear',
                          'showMethod': 'fadeIn',
                          'hideMethod': 'fadeOut'
                    };
                    toastr.warning('".$messages."', '".$tit_msgs."');
                }, 1300);
                </script>
            ");
        }
        else{
            $this->session->set_flashdata("infomsg","<script>
                setTimeout(function() {
                   toastr.options = {
                          'closeButton': true,
                          'debug': false,
                          'progressBar': true,
                          'preventDuplicates': false,
                          'positionClass': '".$positionClass."',
                          'onclick': null,
                          'showDuration': '400',
                          'hideDuration': '1000',
                          'timeOut': '7000',
                          'extendedTimeOut': '1000',
                          'showEasing': 'swing',
                          'hideEasing': 'linear',
                          'showMethod': 'fadeIn',
                          'hideMethod': 'fadeOut'
                    };
                    toastr.error('".$messages."', '".$tit_msgs."');
                }, 1300);
                </script>
            ");
        }
    }
   

    
    



}
?>