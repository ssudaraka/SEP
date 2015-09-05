<?php

class Inbox extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('messages_model');
        $this->load->helper('messages_helper');
    }

    public function index() {
        $data['navbar'] = 'messages';
        $data['user_type'] = $this->session->userdata['user_type'];
        $data['page_title'] = "Profile Settings";
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);
        $this->load->view('inbox/index', $data);
        $this->load->view('templates/footer');
    }

}
