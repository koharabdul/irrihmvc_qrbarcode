<?php defined('BASEPATH') or exit('No direct script access allowed');
class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_m');
    }
    public function index()
    {
        $data['subtitle'] = 'Login';//title
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->template->notemplate($data);
        }
        else
        {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $user_id = $this->Login_m->login_user($username,$password)->row_array();
            if(count($user_id)>0)
            {
                  $this->session->set_userdata($user_id);
                  redirect('dashboards');
                  // $this->session->set_tempdata('home','active',0,1);
            }
            else
            {

                $data['content_view'] = 'login/login_v';
                $this->template->notemplate($data);
            }
        }
       
            
    }

    // public function login()
    // {
        
    // }


    public function logout()
    {
      session_destroy();
      redirect('login');




    }
    
    



}
?>