<?php

class Admin extends CI_Controller{
    
    function __construct() {
        parent::__construct();
    }
    
    function index(){
        if ($this->session->userdata('user_type') !== "A") {
            redirect('login', 'refresh');
        }
        $data['page_title'] = "Profile Settings";
        $data['first_name'] = $this->session->userdata('first_name');
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub');                
        $this->load->view('admin/profile_settings');
        $this->load->view('templates/footer');
    }
}