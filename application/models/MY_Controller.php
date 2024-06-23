<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Tarkiman <tarkiman.zone@gmail.com  | 085222241987 | https://www.linkedin.com/in/tarkiman | http://www.tarkiman.com >
 */
 

class MY_Controller extends CI_Controller
{
    protected $models = array();

    public function __construct()
    {
        parent::__construct();
        $this->_load_models();
        $this->load_config();
        $this->form_validation->set_error_delimiters('<p class="text-danger" style="color:red" >', '</p>');
        $this->lang->load('tarkiman_lang', $this->session->userdata('logged_in')['language']);
    }

    public function _load_models()
    {
        $this->load->model($this->models);
    }

    public function load_config()
    {
        $this->load->model( array('config/config_m'));
        $ret = $this->config_m->getConfig();

        $this->template->set('title', $ret->title);
        $this->template->set('system_name', $ret->system_name);
        $this->template->set('description', $ret->description);
        $this->template->set('keywords', $ret->keywords);
        $this->template->set('company_name', $ret->company_name);
        $this->template->set('logo', $ret->image);
        $this->template->set('footer', $ret->footer_content);
        $this->template->set('analytics_visitor', $ret->analytics_visitor);
        $this->template->set('page_data', $this->group_m->get_authorize_pages($this->session->userdata('logged_in')['id']));

    }

    public function checking()
    {
        $no_redirect = array(
            'login',
            'user/login',
            ''
        );
        if ($this->session->userdata('logged_in') == false && !in_array(uri_string(), $no_redirect)) {
            redirect('login', 'refresh');
        }
    }

    public function allowed_to_update($id = '', $table = '')
    {
        $allow = true;
        $queryNumberofActive = "select count(*) as active from ".$table." where active = '1'";
        $queryGetActiveId = "select id from ".$table." where active = '1' ";
        log_message('error',$queryNumberofActive);
        log_message('error',$queryGetActiveId);
        // cek jumlah config yang aktif
        $numberOfActive = $this->db->query($queryNumberofActive)->row();
        if ($numberOfActive->active <= '1') { // jika ada 1 config aktif
            $active_id = $this->db->query($queryGetActiveId)->result(); // cek apakah config itu adalah id yang akan dirubah valuenya
            foreach ($active_id as $c) {
                if ($c->id == $id) {
                    $allow = false;
                    break;
                }
            }
        }
        if ($allow) {
            return true;
        } else {
            return false;
        }
    }

    public function _delete($id = '' , $table = '', $url = '')
    {
        $this->generic_m->setTable($table);

        if ($this->generic_m->delete($id)) {
            $this->session->set_flashdata('success', 'Success Delete Data');
        }else{
            $this->session->set_flashdata('error', 'Failed to Delete Data');
        };
        redirect($url);
    }

    public function _auth()
    {
        $authorize_uri = $this->group_m->get_authorize_pages($this->session->userdata('logged_in')['id']);
        return $authorize_uri;
    }

    public function uri_check()
    {
        $uri = $this->uri->segment(1);
        //$action = array('create','save','edit','remove','view','update');

        $action = array();
        if($this->uri->segment(2) != null && !in_array($this->uri->segment(2), $action)){
            $uri.= '/'.$this->uri->segment(2);
        }
        return $uri;
    }

    public function authorize()
    {
        if ($this->uri_check() != 'login' && $this->uri_check() != 'user/login' && $this->uri_check() != 'user/logout' && $this->uri_check() != '' && $this->uri->segment(1) != 'redirect' && $this->uri_check() != 'lockscreen' && $this->uri_check() != 'user/change_language') {
            if (in_array($this->uri_check(), $this->_auth()) == false) {
                //redirect('access_denied');
                redirect('not-found');
            }
        }
    }

}
