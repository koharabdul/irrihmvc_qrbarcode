<?php defined('BASEPATH') or exit('No direct script access allowed');
class Uploadimages extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Uploadimages_m');
        $this->session->set_tempdata("uploadimages", "active", 0, 1);
        $this->gallery_path = realpath(APPPATH . '../uploads/images');
        $this->load->helper('file');
        $this->session->set_tempdata("datamaster", "active", 0, 1);
        $this->session->set_tempdata("uploadimages", "active", 0, 1);
    }
    public function index()
    {

        $data['results'] = $this->Uploadimages_m->get_uploadimages();

        // var_dump($data['results']);

        $data['subtitle'] = 'Uploadimages';
        $data['content_view'] = 'uploadimages/uploadimages_v';
        $this->template->hygienic_template($data);
    }
    public function add()
    {
        $data['subtitle'] = 'Uploadimages'; //title

        $data['content_view'] = $data['subtitle'] . '/add_v';
        $this->template->hygienic_template($data);
    }
    // public function sad(){
    // 	#1
    //     $config = array(
    //         'upload_path' => $this->gallery_path,
    //         'allowed_types' => 'gif|png|jpg|jpeg',
    //         'encrypt_name' => true
    //     );
    //     $this->load->library('upload',$config);
    //     $this->upload->do_upload('userfile');

    //     $image_data = $this->upload->data();


    //     $config2 = array(
    //         'source_image' => $image_data['full_path'],
    //         'new_image' => $this->gallery_path . '/thumbs',
    //         'maintain_ratio' => true,
    //         'width' => 100,
    //         'height' => 100
    //     );
    //     $this->load->library('image_lib', $config2);
    //     $this->image_lib->resize();
    //     // $this->image_lib->crop();


    //     // $data[] = $this->input->post();
    //     $data['name_image'] = $this->input->post('nameImage');

    //     $image_path = 'uploads/'.$image_data['raw_name'].$image_data['file_ext'];
    //     $image_path2 = 'uploads/thumbs/'.$image_data['raw_name'].$image_data['file_ext'];
    //     // var_dump($image_data['full_path']);
    //     // var_dump($info);

    //     // $imagebase64 = file_get_contents($image_path);
    //     // $base64 = base64_encode($imagebase64);
    //     // var_dump($base64); 

    //     // echo '<img src="data:'.$info['file_type'].';base64,'.$base64.'">';//alhamdulillah



    //     $data['avatar'] = $image_path;
    //     $data['small_avatar'] = $image_path2;
    //     $data['date_created'] = date("Y-m-d H:i:s", time());
    //     $data['date_modified'] = null;
    //     $data['created_by'] = $this->session->userdata('id');
    //     $data['modified_by'] = '';
    //     $data['deleted'] = '0';



    //     // var_dump($info);

    //     if($this->upload->data()){

    //         $this->Uploadimages_m->insertImage($data);
    //         redirect('uploadimages');
    //     }
    //     else{
    //         $this->add();
    //     }

    // }

    public function upload()
    {

        // var_dump($_POST);
        // var_dump($_FILES);
        // die();


        #1
        $config = array(
            'upload_path' => $this->gallery_path,
            'allowed_types' => 'gif|png|jpg|jpeg',
            'encrypt_name' => true,
            'file_name' => '.jpg'
        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('userfile')) {
            $image_data = $this->upload->data();
            // $image_path = 'uploads/'.$image_data['raw_name'].$image_data['file_ext'];
            $image_path = 'uploads/images/' . $image_data['raw_name'] . '.jpg';

            //sekat
            $croppedImage = $_FILES['croppedImage'];
            // $type = $croppedImage[count($croppedImage)-1];
            $to_be_upload = $croppedImage['tmp_name'];
            // $new_file = 'uploads/thumbs/'.uniqid(rand()).'.png';
            $new_file = 'uploads/images/thumbs/' . $image_data['raw_name'] . '.png';
            move_uploaded_file($to_be_upload, $new_file);
        }


        $data['avatar'] =  $image_path;

        $data['name_image'] = $this->input->post('nameImage'); //$_POST['nameImage']
        $data['small_avatar'] = $new_file;
        $data['date_created'] = date("Y-m-d H:i:s", time());
        $data['date_modified'] = null;
        $data['created_by'] = $this->session->userdata('id');
        $data['modified_by'] = '';
        $data['deleted'] = '0';

        $this->Uploadimages_m->insertImage($data);
    }


    public function delpermanent($nm_image)
    {
        var_dump($nm_image);
        $withoutfileext = explode(".", $nm_image);
        foreach ($withoutfileext as $r) {
            if ($r == 'jpg' or $r == 'png' or $r == 'gif' or $r == 'jpeg') {
            } else {
                $results = $r;
            }
            // var_dump($r);
        }

        $this->Uploadimages_m->deleted($results);

        @unlink('uploads/images/' . $results . '.jpg');
        @unlink('uploads/images/thumbs/' . $results . '.png');

        redirect('Uploadimages');
    }
}
