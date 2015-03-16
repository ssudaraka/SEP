<?php

class User_Auth extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('user', '', TRUE);
    }
    
    function index() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_authenticate');
        
        if($this->form_validation->run() == FALSE){
            $data['page_title'] = "Login";
            $this->load->view('/templates/header', $data);
            $this->load->view('login_form');
            $this->load->view('/templates/footer');
        } else {
            redirect('dashboard', 'refresh');
        }
    }
    
    function authenticate($password){
        $username = $this->input->post('username');
        $result = $this->user->login($username, $password);
        
        if($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id' => $row->id,
                    'username' => $row->username,
                    'password' => $row->password,
                    'first_name' => $row->first_name,
                    'last_name' => $row->last_name,
                    'user_type' => $row->user_type
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('authenticate',"Invalid Username or Password.");
            return FALSE;
        }
    }
}
