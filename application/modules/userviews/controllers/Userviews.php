<?php defined('BASEPATH') or exit('No direct script access allowed');
class Userviews extends MY_Controller{
	public function __construct()
  	{
        parent::__construct();
        $this->load->model('Userviews_m');//model
        $this->susbtitle = 'Userviews';//subtitle
        $dataactiveclass = $this->susbtitle;
        $this->actived_Class($dataactiveclass);
        $this->linkwithoutspace = strtolower(str_replace(' ','',$this->susbtitle));
    }
    public function actived_Class($dataactiveclass){
        $activeclass = $this->Userviews_m->get_activedclass($dataactiveclass);
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
        $datarunlink = $this->Userviews_m->get_activedclass($this->susbtitle);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Userviews_m->content_runlink($showrun);
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

        

        $data['results'] = $this->Userviews_m->get_index();
        $data['menuuserview'] = $this->Userviews_m->getMenuUserview();

        $data['content_view'] = strtolower($this->susbtitle).'/'.strtolower($this->susbtitle).'_v';
        $this->template->hygienic_template($data);
    }
    public function getuiid(){
        echo 'Uv-'.str_pad(rand(0,999999999),9,0,STR_PAD_LEFT).'-'.get_uuid();;
    }
    public function save(){
        $datacontent = $this->input->post('content');


        $this->Userviews_m->insertToConfig($datacontent);//insert ke database lain yaitu t_config
        
        $nomor = 0;
        $this->db->truncate('t_userview');
        if($datacontent!='[]'){
        
            $arr_kalimat = explode('{', $datacontent);
            foreach ($arr_kalimat as $vo) {
                if($vo!='['){
                    $arr_kalimat2 = explode(',', $vo);
                    foreach ($arr_kalimat2 as $k) {
                        if($k!=''){
                        
                            if(empty($tampil)){
                                $tampil = $k;
                            }
                            else{
                                $tampil = $tampil.",".$k;
                            }
                        }
                    }
                }
            }
            // var_dump($tampil);
            // die();
            $arr_kalimat2 = explode('"link"', $tampil);
            foreach ($arr_kalimat2 as $a) {
                if($a!=''){
                    // var_dump($a);
                    if(substr($a, -13)=='"children":[,'){
                        $status = "Mamah";
                    }
                    else if (substr($a, -2)=='},') {
                        if(substr($a, -12)=='}]}]}]}]}]},'){
                            $status = "Ayah Level 5";
                        }
                        else if(substr($a, -10)=='}]}]}]}]},'){
                            $status = "Ayah Level 4";
                        }
                        else if(substr($a, -8)=='}]}]}]},'){
                            $status = "Ayah Level 3";
                        }
                        else if(substr($a, -6)=='}]}]},'){
                            $status = "Ayah Level 2";
                        }
                        else if(substr($a, -4)=='}]},'){
                            $status = "Ayah Level 1";
                        }
                        else{
                            $status = "Anak";
                        }
                    }
                    else if(substr($a, -2)=='}]'){
                        if(substr($a, -12)=='}]}]}]}]}]}]'){
                            $status = "Ayah Level 5";
                        }
                        else if(substr($a, -10)=='}]}]}]}]}]'){
                            $status = "Ayah Level 4";
                        }
                        else if(substr($a, -8)=='}]}]}]}]'){
                            $status = "Ayah Level 3";
                        }
                        else if(substr($a, -6)=='}]}]}]'){
                            $status = "Ayah Level 2";
                        }
                        else if(substr($a, -4)=='}]}]'){
                            $status = "Ayah Level 1";
                        }
                        else if(substr($a, -2)=='}]'){
                            $status = "Anak";
                        }
                        else{
                            $status = "Anak";
                        }
                    }
                    else{
                        $status = "Anak";
                    }

                    // var_dump($a);
                    // die();




                    $results = '"no":"'.$nomor.'","status":"'.$status.'","link"'.$a;
                    // var_dump($results);
                    // die();
                    $arrk = explode(',"children":[,', $results);
                    foreach ($arrk as $b) {
                        if($b!=''){
                            // var_dump($b);
                            
                            $arrk2 = explode('},', $b);
                            foreach ($arrk2 as $c) {
                                if($c!=''){
                                    // var_dump($c);
                                    // die();
                                    $arrk3 = explode('}]}]', $c);
                                    foreach ($arrk3 as $d) {
                                        if($d!=''){
                                            // var_dump($d);
                                            $arrk4 = explode('}]', $d);
                                            foreach ($arrk4 as $e) {
                                                if($e!=''){
                                                    // var_dump($e);
                                                    $arr5 = explode(',', $e);
                                                    foreach ($arr5 as $f) {
                                                        if($f!=''){
                                                            if(substr($f, 0,10)=='"status":"'){
                                                                $arr6 = explode('"status":"', $f);
                                                                foreach ($arr6 as $g1) {
                                                                    if($g1!=''){
                                                                        // var_dump($g1);
                                                                        $jum = strlen($g1)-1;
                                                                        $fstaus= substr($g1,0,$jum);
                                                                    }
                                                                }
                                                            }
                                                            else if(substr($f, 0,6)=='"no":"'){
                                                                $arr6 = explode('"no":"', $f);
                                                                foreach ($arr6 as $g1) {
                                                                    if($g1!=''){
                                                                        // var_dump($g1);
                                                                        $jum = strlen($g1)-1;
                                                                        $fno= substr($g1,0,$jum);
                                                                    }
                                                                }
                                                            }
                                                            else if(substr($f, 0,8)=='"link":"'){
                                                                $arr6 = explode('"link":"', $f);
                                                                foreach ($arr6 as $g1) {
                                                                    if($g1!=''){
                                                                        // var_dump($g1);
                                                                        $jum = strlen($g1)-1;
                                                                        $flink= substr($g1,0,$jum);
                                                                    }
                                                                }
                                                            }
                                                            else if(substr($f, 0,8)=='"name":"'){
                                                                $arr6 = explode('"name":"', $f);
                                                                foreach ($arr6 as $g1) {
                                                                    if($g1!=''){

                                                                        $jum = strlen($g1)-1;
                                                                        $fname= substr($g1,0,$jum);
                                                                    }
                                                                }
                                                            }
                                                            else if(substr($f, 0,8)=='"icon":"'){
                                                                $arr6 = explode('"icon":"', $f);
                                                                foreach ($arr6 as $g1) {
                                                                    if($g1!=''){
                                                                        // var_dump($g1);
                                                                        $jum = strlen($g1)-1;
                                                                        $ficon= substr($g1,0,$jum);
                                                                    }
                                                                }
                                                            }
                                                            else if(substr($f, 0,6)=='"id":"'){
                                                                $arr6 = explode('"id":"', $f);
                                                                foreach ($arr6 as $g1) {
                                                                    if($g1!=''){
                                                                        // var_dump($g1);
                                                                        $jum = strlen($g1)-1;
                                                                        $fid= substr($g1,0,$jum);
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }

                                                    





                                                    if($fstaus=="Mamah"){
                                                        $son = "Anak ".$flink;
                                                       
                                                    }//pembuatan
                                                    else if(substr($fstaus, 0,4)=="Ayah"){
                                                        $son = "";
                                                        
                                                    }//penghapusan
                                                    else{
                                                    }
                                                    if(empty($son)){
                                                        $son = "";
                                                    }
                                                    else{
                                                        $son = $son;
                                                    }

                                                    if(empty($chi)){
                                                        $chi = "";
                                                    }
                                                    else{
                                                        $chi = $chi;
                                                    }


                                                    


                                                   

                                                    if($fstaus=="Mamah"){
                                                        $mom = 1 + $mom;
                                                        $chi = $flink;
                                                        if($mom==1){
                                                            $momi1 =  $flink;
                                                        }
                                                        else if($mom==2){
                                                            $momi2 =  $flink;
                                                        }
                                                        else if($mom==3){
                                                            $momi3 =  $flink;
                                                        }
                                                        else if($mom==4){
                                                            $momi4 =  $flink;
                                                        }
                                                        else if($mom==5){
                                                            $momi5 =  $flink;
                                                        }
                                                    }
                                                    else if($fstaus=="Ayah Level 5"){
                                                        $mom = $mom -5;
                                                        if($mom<0){
                                                            $mom =0;
                                                        }
                                                        $chi = $chi;
                                                    }
                                                    else if($fstaus=="Ayah Level 4"){
                                                        $mom = $mom -4;
                                                        if($mom<0){
                                                            $mom =0;
                                                        }
                                                        $chi = $chi;
                                                    }
                                                    else if($fstaus=="Ayah Level 3"){
                                                        $mom = $mom -3;
                                                        if($mom<0){
                                                            $mom =0;
                                                        }
                                                        $chi = $chi;
                                                    }
                                                    else if($fstaus=="Ayah Level 2"){
                                                        $mom = $mom -2;
                                                        if($mom<0){
                                                            $mom =0;
                                                        }
                                                        $chi = $chi;
                                                    }
                                                    else if($fstaus=="Ayah Level 1"){
                                                        $mom = $mom -1;
                                                        if($mom<0){
                                                            $mom =0;
                                                        }
                                                        $chi = $chi;
                                                    }
                                                    else{
                                                        if(empty($mom))
                                                        {
                                                            $mom = 0;
                                                        }
                                                        else{
                                                            $mom = $mom;
                                                        }
                                                        $chi = $chi;
                                                    }

                                                  

                                                    $status_no = $mom;

                                                   
                                                  
                                                    if(empty($mom))
                                                    {
                                                        $mom = 0;
                                                    }
                                                    else{
                                                        $mom = $mom;
                                                    }
                                                    if(($mom==0)and(($fstaus=="Mamah")or($fstaus=="Anak"))){
                                                        $momies =  "";
                                                    }
                                                    else if(($mom==0)and($fstaus=="Ayah Level 1")){
                                                        $momies =  $momi1;
                                                    }
                                                    else if(($mom==0)and($fstaus=="Ayah Level 2")){
                                                        $momies =  $momi1."/".$momi2;
                                                    }
                                                    else if(($mom==0)and($fstaus=="Ayah Level 3")){
                                                        $momies =  $momi1."/".$momi2."/".$momi3;
                                                    }
                                                    else if(($mom==0)and($fstaus=="Ayah Level 4")){
                                                        $momies =  $momi1."/".$momi2."/".$momi3."/".$momi4;
                                                    }
                                                    else if(($mom==0)and($fstaus=="Ayah Level 5")){
                                                        $momies =  $momi1."/".$momi2."/".$momi3."/".$momi4."/".$momi5;
                                                    }

                                                    else if(($mom==1)and(($fstaus=="Mamah")or($fstaus=="Anak"))){
                                                        $momies =  $momi1;
                                                    }
                                                    else if(($mom==1)and($fstaus=="Ayah Level 1")){
                                                        $momies =  $momi1."/".$momi2;
                                                    }//hasil editan januari 2020
                                                    else if(($mom==1)and($fstaus=="Ayah Level 2")){//can fix -14 pebruari 2020->fix 14 pebruari 2020
                                                        $momies =  $momi1."/".$momi2."/".$momi3;
                                                    }
                                                    else if(($mom==2)and(($fstaus=="Mamah")or($fstaus=="Anak"))){
                                                        $momies =  $momi1."/".$momi2;
                                                    } 
                                                    else if(($mom==2)and($fstaus=="Ayah Level 1")){
                                                        $momies =  $momi1."/".$momi2."/".$momi3;
                                                    }//hasil editan januari 2020
                                                    else if(($mom==3)and(($fstaus=="Mamah")or($fstaus=="Anak"))){
                                                        $momies =  $momi1."/".$momi2."/".$momi3;
                                                    }
                                                    else if(($mom==3)and($fstaus=="Ayah Level 1")){
                                                        $momies =  $momi1."/".$momi2."/".$momi3."/".$momi4;
                                                    }//hasil editan januari 2020
                                                    else if(($mom==4)and(($fstaus=="Mamah")or($fstaus=="Anak"))){
                                                        $momies =  $momi1."/".$momi2."/".$momi3."/".$momi4;
                                                    }
                                                    else if(($mom==5)and(($fstaus=="Mamah")or($fstaus=="Anak"))){
                                                        $momies =  $momi1."/".$momi2."/".$momi3."/".$momi4."/".$momi5;
                                                    }


                                                    if(empty($momies))
                                                    {
                                                        $momies = "";
                                                    }
                                                    else{
                                                        $momies = $momies;   
                                                    }


                                                    
                                                    // var_dump($flink.':'.$fstaus.' '.$mom.'        '.$momies);
                                                    
                                                    // var_dump($fstaus.' '.$son.'                         link: '.$flink);

                                                    // die();
                                                  
                                                   
                                                   

                                                    if($fstaus=="Mamah"){
                                                        $this->Userviews_m->insert($fid,$fno,$fname,$fstaus,$flink,$ficon,$status_no,$momies);
                                                    }
                                                    else if(($fstaus=="Anak")and(substr($son, 0,4)!="Anak")){
                                                        if($mom!=0){
                                                            $this->Userviews_m->insert($fid,$fno,$fname,$fstaus.' '.$chi,$flink,$ficon,$status_no,$momies);
                                                        }
                                                        else{
                                                            $this->Userviews_m->insert($fid,$fno,$fname,$fstaus,$flink,$ficon,$status_no,$momies);
                                                        }
                                                    }
                                                    else if(substr($fstaus, 0,4)=="Ayah"){
                                                        $this->Userviews_m->insert($fid,$fno,$fname,$fstaus.' '.$chi,$flink,$ficon,$status_no,$momies);
                                                    }
                                                    else{
                                                        $this->Userviews_m->insert($fid,$fno,$fname,$son,$flink,$ficon,$status_no,$momies);
                                                    }


                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }



                    
                }
                $nomor++;
            }
        }
        ///////////////////////////////////////////////////////// sekat untuk delete di bawah




        $idDeleted = $this->input->post('idDeleted');
        if($idDeleted!='[]')
        {
            $arr_kalimatz = explode('{', $idDeleted);
            foreach ($arr_kalimatz as $vz) {
                if($vz!='['){
                    $arr_kalimatz2 = explode(',', $vz);
                    foreach ($arr_kalimatz2 as $kz) {
                        if($kz!=''){
                        
                            if(empty($tampilz)){
                                $tampilz = $kz;
                            }
                            else{
                                $tampilz = $tampilz.",".$kz;
                            }
                        }
                    }
                }
            }
            // var_dump($tampil);
            $arrkz = explode(',', $tampilz);
            foreach ($arrkz as $bz) {
                if($bz!=''){
                    if(substr($bz,0,5)=='"id":'){
                        $arrkz1 = explode('}', $bz);
                        foreach ($arrkz1 as $cz) {
                            if($cz!=''){
                                if($cz!=']'){
                                    var_dump(substr($cz, 6));
                                    $dz = substr($cz, 6);
                                    $arrkz2 = explode('"', $dz);
                                    foreach ($arrkz2 as $ez) {
                                        if($ez!=''){
                                            $this->Userviews_m->deleteUserviewDetail($ez);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }






        // $this->Userviews_m->delete();
        redirect(strtolower($this->susbtitle));
        
    }

   
    public function settings($id=null){
        $data['subtitle'] = $this->susbtitle;
        $data['mylink'] = $this->linkwithoutspace;
        $ds = $this->susbtitle;
        $datarunlink = $this->Userviews_m->get_runlink($ds);
        if($datarunlink['tit_actclass']!=''){
            $arr_runlink = explode('/', $datarunlink['tit_actclass']);
            foreach ($arr_runlink as $showrun) {
                $contrunlink = $this->Userviews_m->content_runlink($showrun);
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
        /////////////////////////////////////////////////////////////////////////////////////////////////////////sekat
        if($this->Userviews_m->setting($id)->row_array())
        {
            $data['results'] = $this->Userviews_m->get_idsetting($id)->row_array();
            $data['resultsD'] = $this->Userviews_m->get_idsettings($id)->row_array();
            $select = $this->Userviews_m->get_selectleveluser();
           
     
            $data['levu_options'] = $select;

        
            $data['levu_selected'] = $this->Userviews_m->get_selectedleveluser($id);
           
           
           

            $data['content_view'] = strtolower($this->susbtitle).'/setting_v';
            $this->template->hygienic_template($data);
        }else{
            redirect(strtolower($this->susbtitle));
        }
    }

    public function updated(){
        // var_dump($_POST);
        // var_dump($_GET);
        // die();
        $field = array(
            'name'                      => ucfirst($this->input->post('userview')),
            'icon'                      => $this->input->post('icon')
         );
        $fields = array(
            'perpage'                   => $this->input->post('perpage'),
            'show_numberrow'            => $this->input->post('numRow'),
            'hide_as_permission_on'     => $this->input->post('hiddenUserview')
        );

        $this->Userviews_m->deletepermision();//delete untuk mengupdate

        $permision = $this->input->post('permision');
        if($permision!=''){
            $arr_kalimat = explode(',', $permision);
            foreach ($arr_kalimat as $k) {
                if($k!=''){
                   $this->Userviews_m->inputpermition($k);
                }
            }
        }
        $this->Userviews_m->sendingupdated($field,$fields);
    }
    public function delete_detail(){
        // var_dump($_POST);
        // var_dump($_GET);
        // die();
        // $idDeleted = $this->input->post('idDeleted');
        // if($idDeleted!='[]')
        // {
        //     $arr_kalimatz = explode('{', $idDeleted);
        //     foreach ($arr_kalimatz as $vz) {
        //         if($vz!='['){
        //             $arr_kalimatz2 = explode(',', $vz);
        //             foreach ($arr_kalimatz2 as $kz) {
        //                 if($kz!=''){
                        
        //                     if(empty($tampilz)){
        //                         $tampilz = $kz;
        //                     }
        //                     else{
        //                         $tampilz = $tampilz.",".$kz;
        //                     }
        //                 }
        //             }
        //         }
        //     }
        //     // var_dump($tampil);
        //     $arrkz = explode(',', $tampilz);
        //     foreach ($arrkz as $bz) {
        //         if($bz!=''){
        //             if(substr($bz,0,5)=='"id":'){
        //                 $arrkz1 = explode('}', $bz);
        //                 foreach ($arrkz1 as $cz) {
        //                     if($cz!=''){
        //                         if($cz!=']'){
        //                             var_dump(substr($cz, 6));
        //                             $dz = substr($cz, 6);
        //                             $arrkz2 = explode('"', $dz);
        //                             foreach ($arrkz2 as $ez) {
        //                                 if($ez!=''){
        //                                     $this->Userviews_m->deleteUserviewDetail($ez);
        //                                 }
        //                             }
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
    }



   



}
?>